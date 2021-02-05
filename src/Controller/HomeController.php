<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function home(): Response
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/download", name="download")
     * @return Response
     */
    public function downloadCV()
    {
        $pdfPath = $this->getParameter('dir.images').'/CV_JulieRebeyrolle.pdf';
        return $this->file($pdfPath);
    }

}