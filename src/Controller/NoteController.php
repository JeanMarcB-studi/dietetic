<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; //
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;// marche que à partir symf 6.3


class tataController
{
    #[Route('/tata/', name: 'app_tata')]
    public function number(request $request): Response
    {
        $req = $request->query;
        $id = $req->get('id');
        $name = $req->get('name');

        $data = json_decode($request->getContent(), true);
        
        $id = $data['id'];
        $name = $data['name'];
        // dump($id);

        return new Response(
            "<html><body>id $id name $name</body></html>"
        );
    }
}

class LuckyController
{
    #[Route('/toto/', name: 'app_lucky_number')]
    public function number(request $request): JsonResponse
    {
        $req = $request->query;
        dump($request);
        $id1 = $req->get('id');
        $id2 = $request->request->get('id');
        // $key1 = $request->request->get('key1');
        $name = $req->get('name');

      // dd($req);

        return new JsonResponse([
            'id1' => $id1,
            'id2' => $id2,
            // 'id' => 'jjjj',
            'name' => $req,
            'toto' => 'yyY'
        ]);
    }
    
    // use Symfony\Component\HttpFoundation\Request;
    // use Symfony\Component\HttpFoundation\Response;
    

    #[Route('/titi/', name: 'app_luck')]   
    public function yourAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        
        $id = $data['id'];
        $name = $data['name'];
        dump($id);
        // ...

    return new Response('Données reçues');
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
