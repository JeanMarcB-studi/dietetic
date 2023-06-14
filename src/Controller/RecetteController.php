<?php

namespace App\Controller;
use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function detail(RecetteRepository $RecetteRepository,request $request): Response
    {

        $idRecette = $request->attributes->get('id');

        $recette = ($RecetteRepository->find($idRecette));

        $recette->getAllergene()->initialize();
        $allergenes = $recette->getAllergene()->getValues();
        // dump($allergene);
        
        $recette->getRegime()->initialize();
        $regimes = $recette->getRegime()->getValues();
        // dd($regime);

        return $this->render('pages/detail_recette.html.twig', [
            'allergenes' => $this->lstAllergene(),
            'recette' => $RecetteRepository->find($idRecette),
            'recetteAllergenes' => $allergenes,
            'recetteRegimes' => $regimes,
        ]);
    }

//     // private function RecettelstRegime(Recette $Recette, $idRecette): array
//     private function RecettelstRegime($idRecette): array
//     {
//         $recette = $this->getRecette;
// dd($recette);

//         $regimes = array();
        
//         //IF USER IS CONNECTED
//         if ($idRecette)
//         {
//             $recette= new Recette();
//             dd($recette);
//             dd($recette->getRegime($idRecette));
//             //INITIALISER POUR RECUPERER LES REGIMES
//             $RecetteRepository->getRegime()->initialize();
            
//             dd ($RecetteRepository->getRegime()->getValues());
//             $regimes = $RecetteRepository->getRegime()->getValues();
//         }
//         return($regimes);
//     }

}
