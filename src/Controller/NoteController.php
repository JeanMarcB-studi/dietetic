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
      
      $id = $data['id'];
      $name = $data['name'];

      return new JsonResponse([
        'id' => $id,
        'name' => $name,
      ]);
  }
}


