<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AppelFormType;
use App\Form\Repository\AppelRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Appel;

class FormController extends AbstractController
{

    /**
     * @Route ("/appel")
     */
    public function AppeList()
    {
        $appel = $this->getDoctrine()
            ->getRepository(Appel::class)
            ->findAll();

        return ($this->render('form/appel.html.twig',
        [
            'appel' => $appel
        ]));
    } 

    /**
     * @Route("/form", name="formPost", methods={"POST"})
     */
    public function traitementForm(Request $request): Response
    {
        $form = $this->createForm(AppelFormType::class);
        $form->handleRequest($request);

        $data = $form->getData();

        $entityManager = $this->getDoctrine()->getManager();

        $appel = new Appel();
        $appel->setNom($data["Nom"]);
        $appel->setPrenom($data["Prenom"]);

        $entityManager->persist($appel);

        $entityManager->flush();

        return $this->render('form/index.html.twig',
        [
            'controller_name' => 'FormController',
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/form", name="form")
     */
    public function index(): Response
    {
        $form = $this->createForm(AppelFormType::class);

        return $this->render('form/index.html.twig', [
            'controller_name' => 'FormController',
            'form' => $form->createView()
        ]);
    }
}
