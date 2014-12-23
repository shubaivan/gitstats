<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Student;

class IndexController extends Controller
{
    /**
     * @Template(template=":AppBundle/Index:index.html.twig")
     * @Route("/")
     * @Method(methods={"GET"})
     */
    public function indexAction()
    {
        $students = $this->container->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Student')->findAll();

        return ['students' => $students];
    }
}
