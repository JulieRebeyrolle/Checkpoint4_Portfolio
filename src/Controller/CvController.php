<?php


namespace App\Controller;


use App\Repository\CurriculumVitaeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends AbstractController
{
    /**
     * @Route("/curriculum-vitae", name="cv")
     * @param CurriculumVitaeRepository $curriculumVitaeRepository
     * @return Response
     */
    public function cv(CurriculumVitaeRepository $curriculumVitaeRepository): Response
    {
        return $this->render('cv/cv.html.twig', [
            'cv' => $curriculumVitaeRepository->findBy([], ['startingDate' => 'DESC']),
        ]);
    }

}