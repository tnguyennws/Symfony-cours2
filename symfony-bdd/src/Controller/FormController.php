<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AppelFormType;
use Symfony\Component\HttpFoundation\Request;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="formPost", methods={"POST"})
     */
    public function traitementForm(Request $request): Response
    {
        $form = $this->createForm(AppelFormType::class);
        $form->handleRequest($request);

        $data = $form->getData();

        var_dump($data);
        die();

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
