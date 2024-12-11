<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Coaster;
use App\Form\CoasterType;
use App\Repository\CategoryRepository;
use App\Repository\CoasterRepository;
use App\Repository\ParkRepository;
use Doctrine\ORM\EntityManager;

class CoasterController extends AbstractController
{
    #[Route(path: '/coaster/add')]
    public function add(EntityManagerInterface $entityManager, Request $request): Response
    {
        $entity = new Coaster();
        $form = $this->createForm(CoasterType::class, $entity);

        $coaster = new Coaster();
        /*$coaster->setName('Blue Fire')
            ->setmaxHeight(38)
            ->setMaxSpeed(100)
            ->setLength(1050)
            ->setOperating(true) 
        ;*/

        $form = $this->createForm(CoasterType::class, $coaster);

        // active ap
        $form->handleRequest($request);

        // ap
        if ($form->isSubmitted() && $form->isValid()) {
            // ajoute la nouvelle entité dans le manager Doctrine
            $entityManager->persist($coaster);

            // Met à jour la DB
            $entityManager->flush();

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
    public function index(CoasterRepository $coasterRepository, ParkRepository $parkRepository, CategoryRepository $categoryRepository, Request $request): Response
    {
        $parkId = $request->query->get('park', '');
        $categoryId = $request->query->get('category', '');
        $search = $request->query->get('search', '');
        //$coasters = $coasterRepository->findAll();
        $coasters = $coasterRepository->findByFilters($parkId, $categoryId, $search);

        //dump($coasters);
        
        return $this->render('coaster/index.html.twig', [
            'coasters' => $coasters,
            'parks' => $parkRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    //récupérer un nom à partir d'un id et modifier
    #[Route('/coaster/{id}/edit')]
    public function edit(Coaster $coaster, Request $request, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(CoasterType::class, $coaster);
        $form->handleRequest($request);

        // ap
        if ($form->isSubmitted() && $form->isValid()) {
            
            //maj bd
            $entityManager->flush();

            return $this->redirectToRoute('app_coaster_index');
        }

        return $this->render('coaster/edit.html.twig', [
            'coasterForm' => $form,
        ]);  

        return new Response($coaster->getName());
    }

    //récupérer un nom à partir d'un id et modifier 
    #[Route('/coaster/{id}/delete')]
    public function delete(Coaster $coaster, Request $request, EntityManagerInterface $entityManager): Response
    {
        
        if ($this->isCsrfTokenValid(
            'delete'.$coaster->getId(),
            $request->request->get('_token')
        )) {
            $entityManager->remove($coaster);
            $entityManager->flush();
        
            return $this->redirectToRoute('app_coaster_index');
        }
        
        return $this->render('coaster/delete.html.twig', [
            'coaster' => $coaster,
        ]);
    }
        
}