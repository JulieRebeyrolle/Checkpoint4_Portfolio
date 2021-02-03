<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends AbstractController
{
    /**
     * @Route("/curriculum-vitae", name="cv")
     * @return Response
     */
    public function cv(): Response
    {
        return $this->render('cv/cv.html.twig');
    }

}