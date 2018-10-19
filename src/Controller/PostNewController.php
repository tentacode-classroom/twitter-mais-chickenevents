<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostNewType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;

class PostNewController extends AbstractController
{
    /**
     * @Route("/post/new", name="post_new")
     */
    public function index(Request $request, UserInterface $user)
    {
        $post = new Post();
        $form = $this->createForm( PostNewType::class, $post );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();

            /**
             * @var UploadedFile $file
             */
            $picture=$post->getPicture();
            $pictureFileName= md5(uniqid()).'.'.$picture->guessExtension();
            $picture->move(
                $this->getParameter('pictures_directory'), $pictureFileName
            );

            $post->setPictureFilename($pictureFileName);

            $post->setUser( $user );
            $post->addUserTimeline( $user );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('components/post-new-form.html.twig', [
            'form'  =>  $form->createView()
        ]);
    }

    public function showPicture(){
        $post=$this->getDoctrine()->getRepository('Post')->find('1');
        return $this->render('components/post-new-form.html.twig',array('post'=>$post));
    }
}
