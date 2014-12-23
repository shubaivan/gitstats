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

class StudentController extends Controller
{
    /**
     * @Template(template=":AppBundle/Student:new.html.twig")
     * @Route("/new")
     * @Method(methods={"GET", "POST"})
     *
     * @param Request $request
     * @return array
     */
    public function newAction(Request $request)
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

    /**
     * @Template(":AppBundle/Student:get.html.twig")
     * @Route("/{slug}")
     * @Method({"GET"})
     *
     * @param $slug
     * @return array
     */
    public function getAction($slug)
    {
        $client = new Client();

        return [
            'student'   => $this->container->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Student')->findOneBySlug($slug),
            'stats'     => $client->users()->find($slug),
            'git'       => $client->users()->show($slug),
        ];
    }
}
