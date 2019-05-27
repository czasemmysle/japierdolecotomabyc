<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\VM;
use App\Entity\Plan;
use App\Entity\Backup;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\DateTime;

class PlanController extends AbstractController
{
    /**
     * @Route("/plan/add")
     */
    function addbackup() {
        $entityManager = $this->getDoctrine()->getManager();
        $request = Request::createFromGlobals(); 

        $date = new \DateTime($request->request->get("date")." ".$request->request->get("time"));

        $plan = new Plan();
        $plan->setEtykietaPlan($request->request->get("etykieta"));
        $plan->setIpStorageDB($request->request->get("lokdb"));
        $plan->setIpStorageF($request->request->get("lokf"));
        $plan->setIpStorageVM($request->request->get("lokmv"));
        $plan->setIpFinalStorage($request->request->get("lokfs"));
        $plan->setDataStart($date);
        $plan->setFlag($request->request->get("radio"));

        $plan->setListaVM($request->request->get("machineIds"));
       
        $entityManager->persist($plan);
        $entityManager->flush(); 
        return new Response("DAFAQ działa :o");     
    }
}