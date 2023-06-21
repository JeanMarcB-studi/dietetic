<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; //
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;// marche que à partir symf 6.3


class NoteController extends AbstractController
{
  #[Route('/note/', name: 'app_note')]
  public function number(request $request): JsonResponse
  {

      $data = json_decode($request->getContent(), true);
      
      $idReceipe = $data['idReceipe'];
      $note = $data['note'];
      $message = $data['message'];
      $User = ($this->getUser());

      // if (!$User) {
      //   return new JsonResponse([
      //     'message' => "Vous devez être connecté pour mettre un avis sur une recette",
      //     'status' => 'KO'
      //   ]);
      // }

      // if (!$User->est_client){
      //   return new JsonResponse([
      //     'message' => "Vous devez être client pour mettre un avis sur une recette",
      //     'status' => 'KO'
      //   ]);
      // }

      dump($this->getUser());

      dump($idReceipe);

      return new JsonResponse([
        'idReceipe' => $idReceipe,
        'note' => $note,
        'message' => $message,
        'status' => 'OK'
      ]);
  }
}


