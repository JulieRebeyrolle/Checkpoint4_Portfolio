<?php

namespace App\Controller;

use App\Entity\Skills;
use App\Form\SkillsType;
use App\Repository\SkillsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/competences", name="admin_")
 */
class AdminSkillsController extends AbstractController
{
    /**
     * @Route("/", name="skills_index", methods={"GET"})
     * @param SkillsRepository $skillsRepository
     * @return Response
     */
    public function index(SkillsRepository $skillsRepository): Response
    {
        return $this->render('admin/skills/index.html.twig', [
            'skills' => $skillsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="skills_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $skill = new Skills();
        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($skill);
            $entityManager->flush();
            $this->addFlash('success', 'Tout est ok !');

            return $this->redirectToRoute('admin_skills_index');
        }

        return $this->render('admin/skills/new.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="skills_show", methods={"GET"})
     * @param Skills $skill
     * @return Response
     */
    public function show(Skills $skill): Response
    {
        return $this->render('admin/skills/show.html.twig', [
            'skill' => $skill,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="skills_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Skills $skill
     * @return Response
     */
    public function edit(Request $request, Skills $skill): Response
    {
        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Tout est ok !');


            return $this->redirectToRoute('admin_skills_index');
        }

        return $this->render('admin/skills/edit.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="skills_delete", methods={"DELETE"})
     * @param Request $request
     * @param Skills $skill
     * @return Response
     */
    public function delete(Request $request, Skills $skill): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($skill);
            $entityManager->flush();
            $this->addFlash('success', 'Tout est ok !');
        }

        return $this->redirectToRoute('admin_skills_index');
    }
}
