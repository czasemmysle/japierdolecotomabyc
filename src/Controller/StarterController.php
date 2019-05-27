<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\VM;

class StarterController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        $vMs = $this->getDoctrine()
        ->getRepository(VM::class)
        ->findAll();

        return $this->render('starter.html.twig', [
            'vMs' => $vMs,
        ]);
    }
}