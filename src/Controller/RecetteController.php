<?php

namespace App\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


use App\Repository\RecetteRepository;
use App\Repository\RegimeRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    #[Route('/recettes', name: 'app_recettes')]
    public function index(RecetteRepository $RecetteRepository,request $request): Response
    {
        return $this->render('pages/liste_recettes.html.twig', [
            'controller_name' => 'RecetteController',
            'recettes' => $RecetteRepository->findAll(),
            'regimes' => $this->lstRegime(),
            'allergenes' => $this->lstAllergene(),
            'lstFac' => $this->lstFact($RecetteRepository),
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
            
            //INITIALISER POUR RECUPERER LES REGIMES
            $user->getRegime()->initialize();
            
            // dump ($regimes->getValues());
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
            
            // dump ($regimes->getValues());
            $allergene = $user->getAllergene()->getValues();
        }
        return($allergene);
    }

    private function lstFact(RecetteRepository $repo): array
    {
        $lstFac = array();

        //RECUPERER LE USER CONNECTE
        $user = $this->getUser();

        //IF USER IS CONNECTED
        if ($user)
        $lstFac = $repo->queryOkRegime($user->getId());
        return($lstFac);
    } 


}
