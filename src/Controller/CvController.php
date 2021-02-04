<?php


namespace App\Controller;


use App\Repository\CurriculumVitaeRepository;
use App\Repository\SkillsCategoryRepository;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CvController extends AbstractController
{
    /**
     * @Route("/curriculum-vitae", name="cv")
     * @param CurriculumVitaeRepository $curriculumVitaeRepository
     * @param SkillsRepository $skillsRepository
     * @param SkillsCategoryRepository $skillsCategoryRepository
     * @return Response
     */
    public function cv(
        CurriculumVitaeRepository $curriculumVitaeRepository,
        SkillsRepository $skillsRepository,
        SkillsCategoryRepository $skillsCategoryRepository
    ): Response {
        $skills = [];
        $skillsCategories = $skillsCategoryRepository->findAll();

        foreach ($skillsCategories as $skillsCategory) {
            $skills[$skillsCategory->getName()] = $skillsRepository->findBy(
                ['category' => $skillsCategory, 'showOnCv' => true],
                [],
                3,
                0
            );
        }
        return $this->render('cv/cv.html.twig', [
            'skills' => $skills,
            'cv' => $curriculumVitaeRepository->findBy([], ['startingDate' => 'DESC']),
        ]);
    }

}