<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Student;
use AppBundle\Form\StudentType;
use Github\Client;

class IndexController extends Controller
{
    /**
     * @Template(template=":AppBundle/Index:index.html.twig")
     * @Route("/")
     * @Method(methods={"GET", "POST"})
     *
     * @param $request
     * @return Student
     */
    public function indexAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(new StudentType(), $student);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($form->isValid()) {
                $this->container->get('doctrine.orm.entity_manager')->persist($student);
                $this->container->get('doctrine.orm.entity_manager')->flush();
            }
        }

        return ["form" => $form->createView()];
    }
}
