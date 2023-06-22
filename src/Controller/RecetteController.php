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
use Symfony\Component\HttpFoundation\JsonResponse;

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


    //..... MANAGE THE RECEIPE SHOWING IN DETAIL .........................

    #[Route('/recette/{id}', name: 'app_detail_recette', requirements:['id' => '\d+'])]
    public function detail(
        RecetteRepository $RecetteRepository,
        request $request,
        NoteRepository $NoteRepository,
        EntityManagerInterface $entityManager
        ): Response
    {
        // dump($request);

        $idRecette = $request->attributes->get('id');
        $recette = $RecetteRepository->find($idRecette);

        // look if user already made a note on this receipe
        $user = $this->getUser()->getID();

        $note = $NoteRepository->findBy(
            array('recette' => $idRecette, 'user' => $user),null,1,0
        );

        $recette->getRegime()->initialize();
        $recette->getAllergene()->initialize();

        return $this->render('pages/detail_recette.html.twig', [
            'recette' => $recette,
            'idRecette' => $idRecette,
            'notes' => $note
        ]);
    }

    // #[Route('/note/{idRecette}{note}{message}', 
//     #[Route('/note2/{idRecette}{note}', 
//         name: 'app_note_recette', 
//         // requirements:['idRecette' => '\d+', 'note' => '\d+'],
//         methods: ['GET'])]

//     public function createNote(
//         RecetteRepository $RecetteRepository,
//         request $request,
//         EntityManagerInterface $entityManager
//         ): JsonResponse
//     {
// // dd($request->attributes);
// dd($request);
//         $idRecette = $request->attributes->get('idRecette');
//         // dump($idRecette);
//         // $req = $request->request;
//         // $message = trim($req->get('message'));
//         // $noteVal = (int)$req->get('note');
//         // $today = new \DateTime();
//         // $user = $this->getUser();
//         // $idUser = $user->getId();
        
//         // $note = new Note();
//         // $note->setAvis($message);
//         // $note->setNote($noteVal);
//         // $note->setDateAvis($today);
//         // $note->setRecette($idRecette);
//         // $note->setUser($idUser);
        

//         // $entityManager->persist($note);
//         // $entityManager->flush();

//         return new JsonResponse([
//             'message' => 'Note enregistrée '.$idRecette,
//             'path' => 'src/Controller/RecetteController.php',
//         ]);
//     }


    // // #[Route('/api/createnote/{idRecette}', name: 'app_createnote', methods: ['POST'])]

    // #[Route('/api/createnote/{id}', name: 'app_createnote', methods: ['POST'])]
    // public function addNote(int $idRecette): JsonResponse
    // {

    //     return new JsonResponse([
    //         'message' => 'welcome to your new controller!',
    //     ]);
    // }




}
