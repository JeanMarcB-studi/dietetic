<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\Recette;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class RecetteController extends AbstractController
{
    #[Route('/recettes', name: 'app_recettes')]
    public function index(RecetteRepository $RecetteRepository,request $request): Response
    {
        return $this->render('pages/liste_recettes.html.twig', [
            'regimes' => $this->lstRegime(),
            'allergenes' => $this->lstAllergene(),
            'lstRecettes' => $this->lstRecettes($RecetteRepository),
            'lstNotes' => $RecetteRepository->queryNotes(),
        ]);
    }

    private function lstRegime(): array
    {
        $regimes = array();
        
        //RECUPERER LE USER CONNECTE
        $user = $this->getUser();
        
        //IF USER IS CONNECTED
        if ($user)
        {
            //$roles = $user->getRoles();
            
            //INITIALISER PUIS RECUPERER LES REGIMES
            $user->getRegime()->initialize();
            $regimes = $user->getRegime()->getValues();
        }
        return($regimes);
    }

    private function lstAllergene(): array
    {
        $allergene = array();
        
        //RECUPERER LE USER CONNECTE
        $user = $this->getUser();
        
        //IF USER IS CONNECTED
        if ($user)
        {
            //INITIALISER POUR RECUPERER LES REGIMES
            $user->getAllergene()->initialize();
            $allergene = $user->getAllergene()->getValues();
        }
        return($allergene);
    }

    private function lstRecettes(RecetteRepository $repo): array
    {
        $recettes = array();

        //RECUPERER LE USER CONNECTE
        $user = $this->getUser();

        //IF USER IS CONNECTED
        if ($user)
            $recettes = $repo->queryOkRegime($user->getId());
            return($recettes);
    } 


    #[Route('/recette/{id}', name: 'app_detail_recette', requirements:['id' => '\d+'])]
    public function detail(
        RecetteRepository $RecetteRepository,
        request $request,
        EntityManagerInterface $entityManager
        ): Response
    {

        $idRecette = $request->attributes->get('id');
        $recette = ($RecetteRepository->find($idRecette));

        $recette->getRegime()->initialize();
        $recette->getAllergene()->initialize();
        // $allergenes = $recette->getAllergene()->getValues();

        $user = $this->getUser();
        $idUser = $user->getId();

        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);
        
        // if ($form->isSubmitted() && $form->isValid()){
        if ($form->isSubmitted()){
            dd($form);
            
            
            $req = $request->request;
            $avis = trim($req->get('avis'));
            $noteVal = (int)$req->get('note');
            $today = new \DateTime();
            
            $note = new Note();
            $note->setAvis($avis);
            $note->setNote($noteVal);
            $note->setDateAvis($today);
            $note->setRecette($idRecette);
            $note->setUser($idUser);
            
            $entityManager->persist($note);
            $entityManager->flush();
        }

        return $this->render('pages/detail_recette.html.twig', [
            'recette' => $recette,
            'form' => $form->createView(),
        ]);
    }


}
