<?php

namespace App\Controller;

// use App\Entity\Note;
// use App\Entity\Recette;
// use App\Form\NoteType;
use App\Repository\NoteRepository;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
// use Doctrine\ORM\EntityManagerInterface;
// use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
// use Symfony\Component\HttpFoundation\JsonResponse;



class RecetteController extends AbstractController
{

    //..... MANAGE LIST OF RECEIPES
    #[Route('/recettes', name: 'app_recettes')]
    public function index(RecetteRepository $RecetteRepository,request $request, NoteRepository $NoteRepository): Response
    {
        return $this->render('pages/liste_recettes.html.twig', [
            // 'regimes' => $this->lstRegime(),
            // 'allergenes' => $this->lstAllergene(),
            'lstRecettes' => $this->lstRecettes($RecetteRepository, $NoteRepository),
            'lstNotes' => $NoteRepository->queryLstNotes(),
        ]);
    }

    // private function lstRegime(): array
    // {
    //     $regimes = array();
        
    //     //RECUPERER LE USER CONNECTE
    //     $user = $this->getUser();
        
    //     //IF USER IS CONNECTED
    //     if ($user)
    //     {
    //         //$roles = $user->getRoles();
            
    //         //INITIALISER PUIS RECUPERER LES REGIMES
    //         $user->getRegime()->initialize();
    //         $regimes = $user->getRegime()->getValues();
    //     }
    //     return($regimes);
    // }

    // private function lstAllergene(): array
    // {
    //     $allergene = array();
        
    //     //RECUPERER LE USER CONNECTE
    //     $user = $this->getUser();
        
    //     //IF USER IS CONNECTED
    //     if ($user)
    //     {
    //         //INITIALISER POUR RECUPERER LES REGIMES
    //         $user->getAllergene()->initialize();
    //         $allergene = $user->getAllergene()->getValues();
    //     }
    //     return($allergene);
    // }

    private function lstRecettes(RecetteRepository $repo, NoteRepository $NoteRepository): array
    {
        $recettes = array();

        //RECUPERER LE USER CONNECTE
        $user = $this->getUser();

        //IF USER IS CONNECTED AND IS CLIENT
        if ($user && $user->isEstClient()){
            $user->getAllergene()->initialize();
            $user->getRegime()->initialize();
            $regimes = $user->getRegime()->getValues();

            if (count($regimes) > 0) {
                // The user has some regimes
                $recettes = $repo->queryOkRegime($user->getId());
            
            } else {
                // No regime for this user, some allergies possible
                $recettes = $repo->queryOkAllergene($user->getId());
            }

        } else {
            $recettes = $repo->queryVisitorReceipes();
        }

        $notes = $NoteRepository->queryLstNotes();
        
        //ADD NOTE INFORMATION ON RECEIPES
        $nb = 0;
        foreach($recettes as $recette){
            $id = $recettes[$nb]['id'];
            $nbNotes = 0;
            $avgNotes = 0;

            //search if noes exist for this receipe:
            foreach($notes as $note){
                if ($note['recette_id'] === $id){
                    $nbNotes = $note['nbnote'];
                    $avgNotes = $note['moynote'];
                    break;
                }
            }
            $recettes[$nb]['avgNotes'] = $avgNotes;
            $recettes[$nb]['nbNotes'] = $nbNotes;

            $nb++;
        }
        
        return($recettes);
    } 


    //..... MANAGE THE RECEIPE SHOWING IN DETAIL .........................

    #[Route('/recette/{id}', name: 'app_detail_recette', requirements:['id' => '\d+'])]
    public function detail(
        RecetteRepository $RecetteRepository,
        NoteRepository $NoteRepository,
        request $request,
        ): Response
    {

        $idRecette = $request->attributes->get('id');
        $recette = $RecetteRepository->find($idRecette);
        $comments = $NoteRepository->queryLstComment($idRecette);
        $note = array();

        if ($this->getUser()){

            // look if user already made a note on this receipe
            $user = $this->getUser()->getID();
            
            $note = $NoteRepository->findBy(
                array('recette' => $idRecette, 'user' => $user),null,1,0
            );
            
            $recette->getRegime()->initialize();
            $recette->getAllergene()->initialize();

            // GET CORRESPONDING CREDENTIALS TO LOCAL OR IN LINE
            // if($_SERVER['SERVER_NAME'] === 'localhost')
            // {
            // require_once "db_test_id_local.php";  
            // } else {  
            // require_once "db_test_id_prod.php";
            // }
            
        }
            return $this->render('pages/detail_recette.html.twig', [
                'recette' => $recette,
                'idRecette' => $idRecette,
                'comments' => $comments,
                'notes' => $note
            ]);
        }



}
