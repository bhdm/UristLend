<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template();
     */
    public function indexAction(Request $request)
    {

        $news = $this->getDoctrine()->getRepository('AppBundle:Publication')->findBy([],['id' => 'DESC'],3);
        return $this->render('AppBundle:Default:index.html.twig', ['news' => $news]);
    }

    /**
     * @Route("/news", name="news")
     * @Template();
     */
    public function newsAction(Request $request){
        $news = $this->getDoctrine()->getRepository('AppBundle:Publication')->findBy(['created' => 'DESC']);
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $news,
            $request->query->get('page', 1),
            15
        );
        return ['news' => $pagination];
    }

    /**
     * @Route("/news/{id}", name="new")
     * @Template();
     */
    public function newAction($id){
        $new = $this->getDoctrine()->getRepository('AppBundle:Publication')->findOneBy(['id' => $id]);
        return ['new' => $new];
    }
}
