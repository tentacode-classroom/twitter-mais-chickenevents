<?php

namespace App\Controller\Crud;

use App\Entity\Follow;
use App\Form\FollowType;
use App\Repository\FollowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/follow")
 */
class FollowController extends AbstractController
{
    /**
     * @Route("/", name="follow_index", methods="GET")
     */
    public function index(FollowRepository $followRepository): Response
    {
        return $this->render('admin/follow/index.html.twig', ['follows' => $followRepository->findAll()]);
    }

    /**
     * @Route("/new", name="follow_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $follow = new Follow();
        $form = $this->createForm(FollowType::class, $follow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($follow);
            $em->flush();

            return $this->redirectToRoute('follow_index');
        }

        return $this->render('admin/follow/new.html.twig', [
            'follow' => $follow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="follow_show", methods="GET")
     */
    public function show(Follow $follow): Response
    {
        return $this->render('admin/follow/show.html.twig', ['follow' => $follow]);
    }

    /**
     * @Route("/{id}/edit", name="follow_edit", methods="GET|POST")
     */
    public function edit(Request $request, Follow $follow): Response
    {
        $form = $this->createForm(FollowType::class, $follow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('follow_edit', ['id' => $follow->getId()]);
        }

        return $this->render('admin/follow/edit.html.twig', [
            'follow' => $follow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="follow_delete", methods="DELETE")
     */
    public function delete(Request $request, Follow $follow): Response
    {
        if ($this->isCsrfTokenValid('delete'.$follow->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($follow);
            $em->flush();
        }

        return $this->redirectToRoute('follow_index');
    }
}
