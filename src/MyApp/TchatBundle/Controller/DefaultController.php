<?php

namespace MyApp\TchatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MyAppTchatBundle:Default:index.html.twig');
    }
}
