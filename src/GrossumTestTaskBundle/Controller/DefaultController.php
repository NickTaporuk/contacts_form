<?php

namespace GrossumTestTaskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GrossumTestTaskBundle:Default:index.html.twig');
    }
}
