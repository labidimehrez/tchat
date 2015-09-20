<?php

namespace MyApp\TchatBundle\Controller;

use MyApp\TchatBundle\Entity\Message;
use MyApp\TchatBundle\Form\MessageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction(Request $request) {

        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $message = new Message();
        $form = $this->createForm(new MessageType, $message);
        $request = $this->get('request_stack')->getCurrentRequest();

        if ($request->isXmlHttpRequest()) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $message = $form->getData();
                if ($user != NULL) {
                    $message->setUser($user);
                }
                $message->setLu(FALSE);
                $em->persist($message);
                $em->flush();
                // exit;
                $messages = $em->getRepository('MyAppTchatBundle:message')->findAll();

                return $this->container->get('templating')->renderResponse('MyAppTchatBundle:Default:index.html.twig', array(
                            'messages' => $messages
                ));
            }
        } elseif ($request->isMethod('Post')) {
            $form->bind($request);
            if ($form->isValid()) {
                $message = $form->getData();
                if ($user != NULL) {
                    $message->setUser($user);
                }
                $message->setLu(FALSE);
                $em->persist($message);
                $em->flush();
                $messages = $em->getRepository('MyAppTchatBundle:message')->findAll();
                return $this->redirect($this->generateUrl('my_app_tchat_homepage'));
            }
        } else {
            $messages = $em->getRepository('MyAppTchatBundle:message')->findAll();
            return $this->render('MyAppTchatBundle:Default:index.html.twig', array('form' => $form->createView(),
                        'user' => $user, 'messages' => $messages));
        }
    }

    public function makevuAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $messages = $em->getRepository('MyAppTchatBundle:message')->findBy(array(), array('datecreation' => 'DESC'));

        if ($request->isXmlHttpRequest()) {
            if (!empty($messages)) {
                $message = $messages[0];  // $message est un objet
                if ($message->getUser() != $user) {
                    $message->setLu(TRUE);
                    $message->setDatelu(new \DateTime());
                    $em->persist($message);
                    $em->flush();
                    //exit;  
                }
            }
            return $this->container->get('templating')->renderResponse('MyAppTchatBundle:Default:index.html.twig', array(
                        'user' => $user
            ));
        }
    }

    public function showAction(Request $request) {
        $user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();
        if ($request->isXmlHttpRequest()) {
            $messages = $em->getRepository('MyAppTchatBundle:message')->findAll();
            return $this->container->get('templating')->renderResponse('MyAppTchatBundle:Default:ajaxresponse.html.twig', array(
                        'messages' => $messages, 'user' => $user
            ));
        } else {
            $messages = $em->getRepository('MyAppTchatBundle:message')->findAll();
            return $this->render('MyAppTchatBundle:Default:index.html.twig', array(
                        'messages' => $messages, 'user' => $user
            ));
        }
    }

    public function entraindecrireAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        $allusers = $em->getRepository('MyAppTchatBundle:user')->findAll();
      
        if ($request->isXmlHttpRequest()) {

            return $this->container->get('templating')->renderResponse('MyAppTchatBundle:Default:entraindecrire.html.twig', array(
                        'user' => $user
            ));
        }
    }

}
