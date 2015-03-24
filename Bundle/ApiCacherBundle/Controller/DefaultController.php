<?php

namespace HSpace\Bundle\ApiCacherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('HSpaceApiCacherBundle:Default:index.html.twig', array('name' => $name));
    }
}
