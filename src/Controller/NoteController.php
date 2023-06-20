<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; //
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;// marche que à partir symf 6.3


// class LuckyController
// {
//     #[Route('/toto/', name: 'app_lucky_number')]
//     public function number(request $request): Response
//     {
//         $req = $request->query;
//         $id = $req->get('id');
//         $name = $req->get('name');

//         return new Response(
//             "<html><body>id $id name $name</body></html>"
//         );
//     }
// }
class LuckyController
{
    #[Route('/toto/', name: 'app_lucky_number')]
    public function number(request $request): JsonResponse
    {
        $req = $request->query;
        $id = $req->get('id');
        $name = $req->get('name');

      // dd($req);

        return new JsonResponse([
            'id' => $id,
            // 'id' => 'jjjj',
            'name' => $name,
            'toto' => 'yy'
        ]);
    }
}




class NoteController extends AbstractController
{
    #[Route('/note/{id}', name: 'app_note')]
    public function showNote(Request $request): JsonResponse
    {
        $idRecette = $request->attributes->get('id');
            return new JsonResponse([
            'message' => 'This is the note with id '.$idRecette,
        ]);
    }
}
