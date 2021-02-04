<?php

namespace App\Controller;

use App\Entity\CurriculumVitae;
use App\Form\CurriculumVitaeType;
use App\Repository\CurriculumVitaeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminCvController extends AbstractController
{
    /**
     * @Route("/cv", name="cv_index", methods={"GET"})
     * @param CurriculumVitaeRepository $curriculumVitaeRepository
     * @return Response
     */
    public function index(CurriculumVitaeRepository $curriculumVitaeRepository): Response
    {

        return $this->render('admin/curriculum_vitae/index.html.twig', [
            'curriculum_vitaes' => $curriculumVitaeRepository->findBy([], ['startingDate' => 'DESC']),
        ]);
    }

    /**
     * @Route("/cv/new", name="cv_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $curriculumVitae = new CurriculumVitae();
        $form = $this->createForm(CurriculumVitaeType::class, $curriculumVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($curriculumVitae);
            $entityManager->flush();
            $this->addFlash('success', 'Tout est ok !');

            return $this->redirectToRoute('admin_cv_index');
        }

        return $this->render('admin/curriculum_vitae/new.html.twig', [
            'curriculum_vitae' => $curriculumVitae,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cv/{id}", name="cv_show", methods={"GET"})
     * @param CurriculumVitae $curriculumVitae
     * @return Response
     */
    public function show(CurriculumVitae $curriculumVitae): Response
    {
        return $this->render('admin/curriculum_vitae/show.html.twig', [
            'curriculum_vitae' => $curriculumVitae,
        ]);
    }

    /**
     * @Route("/cv/{id}/edit", name="cv_edit", methods={"GET","POST"})
     * @param Request $request
     * @param CurriculumVitae $curriculumVitae
     * @return Response
     */
    public function edit(Request $request, CurriculumVitae $curriculumVitae): Response
    {
        $form = $this->createForm(CurriculumVitaeType::class, $curriculumVitae);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Tout est ok !');

            return $this->redirectToRoute('admin_cv_index');
        }

        return $this->render('admin/curriculum_vitae/edit.html.twig', [
            'curriculum_vitae' => $curriculumVitae,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cv/{id}", name="cv_delete", methods={"DELETE"})
     * @param Request $request
     * @param CurriculumVitae $curriculumVitae
     * @return Response
     */
    public function delete(Request $request, CurriculumVitae $curriculumVitae): Response
    {
        if ($this->isCsrfTokenValid('delete'.$curriculumVitae->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($curriculumVitae);
            $entityManager->flush();

        }
        $this->addFlash('success', 'Tout est ok !');

        return $this->redirectToRoute('admin_cv_index');
    }
}
