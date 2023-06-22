<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\Recette;
use App\Repository\NoteRepository;
use App\Repository\RecetteRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; //
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;// marche que à partir symf 6.3


class NoteController extends AbstractController
{
  #[Route('/note/', name: 'app_note')]
  public function number(request $request, NoteRepository $NoteRepository, RecetteRepository $RecetteRepository): JsonResponse
  {

      $data = json_decode($request->getContent(), true);
      
      $idReceipe = (int)$data['idReceipe'];
      $receipe = ($RecetteRepository->find($idReceipe));
      // $receipe = $data['receipe'];
      $noteVal = (int)$data['note'];
      $message = trim($data['message']);
      $user = ($this->getUser());

      if (!$user) {
        return new JsonResponse([
          'message' => "Vous devez être connecté pour mettre un avis sur une recette",
          'status' => false
        ]);
      }

      if (!$user->isEstClient()){
        return new JsonResponse([
          'message' => "Vous devez être client pour mettre un avis sur une recette",
          'status' => false
        ]);
      }

      if ((!$noteVal) or ($noteVal < '1') or ($noteVal > '5')){
        return new JsonResponse([
          'message' => "Vous devez mettre une note",
          'status' => false
        ]);        
      }

      try {

        // PREPARE RECORDING
        $note = new Note();
        $today = new \DateTime();
        $note->setAvis($message);
        $note->setNote($noteVal);
        $note->setDateAvis($today);
      $note->setRecette($receipe);
      $note->setUser($user);
      
      dump($note);
      dump($request);

      // SAVE THE NOTE
      $NoteRepository->save($note, true);

      return new JsonResponse([
        'message' => 'Merci, la note est enregistrée.',
        'status' => true
      ]);
    }
    catch (Exception $e) {
      // dd($e->getMessage());
      return new JsonResponse([
        'message' => 'Un problème est survenu',
        'status' => false
      ]);
    }
  }
}


