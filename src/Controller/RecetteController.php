<?php

namespace App\Controller;

use App\Repository\NoteRepository;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


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

    private function lstRecettes(RecetteRepository $repo, NoteRepository $NoteRepository): array
    {
        $recettes = array();

        //INITIALIZE 
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
        $urlApi = '';

        //TO BE ABLE TO SEND A COMMENT, THE USER MUST BE REGISTERED AS CUSTOMER AND CONNECTED
        if ($this->getUser() and $this->getUser()->isEstClient()){

            // look if user already made a note on this receipe
            $user = $this->getUser()->getID();
            
            $note = $NoteRepository->findBy(
                array('recette' => $idRecette, 'user' => $user),null,1,0
            );
            
            $recette->getRegime()->initialize();
            $recette->getAllergene()->initialize();

            //GET API URL FOR LOCAL ENVIRONMENT OR ON LINE ENVIRONMENT
            if($_SERVER['SERVER_NAME'] === '127.0.0.1:8000')
            {
                $urlApi = 'https://127.0.0.1:8000/note/'; //LOCAL
            } else {  
                $urlApi = 'https://diete.piramida.fr/note/'; //ON LINE
            }
            
        }

        return $this->render('pages/detail_recette.html.twig', [
            'recette' => $recette,
            'idRecette' => $idRecette,
            'comments' => $comments,
            'notes' => $note,
            'urlApi' => $urlApi
        ]);
        }



}
