<?php

namespace video\StreamBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('videoStreamBundle:Default:index.html.twig', array('name' => $name));
    }
}
