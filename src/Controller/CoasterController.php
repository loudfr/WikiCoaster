<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Coaster;
use App\Form\CoasterType;
use App\Repository\CoasterRepository;

class CoasterController extends AbstractController
{
    #[Route(path: '/coaster/add')]
    public function add(EntityManagerInterface $em, Request $request): Response
    {
        $entity = new Coaster();
        $form = $this->createForm(CoasterType::class, $entity);

        $coaster = new Coaster();
        $coaster->setName('Blue Fire')
            ->setmaxHeight(38)
            ->setMaxSpeed(100)
            ->setLength(1050)
            ->setOperating(true) 
        ;

        $form = $this->createForm(CoasterType::class, $coaster);

        // active ap
        $form->handleRequest($request);

        // ap
        if ($form->isSubmitted() && $form->isValid()) {
            // ajoute la nouvelle entité dans le manager Doctrine
            $em->persist($coaster);

            // Met à jour la DB
            $em->flush();

            return $this->redirectToRoute('app_coaster_index');
        }

        
        // ajoute la nouvelle entité dans le manager Doctrine
        //$em->persist($coaster);

        // Met à jour la DB
        //$em->flush();

        //return new Response('Coaster crée');

        // après
        return $this->render('coaster/add.html.twig', [
            'coasterForm' => $form,
        ]);  
        
    }

    #[Route('/coaster/')]
    public function index(CoasterRepository $coasterRepository): Response
    {
        $coasters = $coasterRepository->findAll();
        return $this->render('coaster/index.html.twig', [
            'coasters' => $coasters,
        ]);
    }

}