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

        $post = false;
        if ($request->getMethod() == 'POST'){
            $message = \Swift_Message::newInstance()
                ->setSubject('Запрос сайта')
                ->setFrom('urist@urist.ru')
                ->setTo('admin@pristav77.ru')
                ->setBody(
                    $this->renderView(
                        '@App/registration.html.twig',
                        array(
                            'name' => $request->request->get('name'),
                            'phone' => $request->request->get('phone'),
                            'text' => $request->request->get('text'),
                        )
                    ),
                    'text/html'
                );
                $this->get('mailer')->send($message);


            $post = true;
        }
        $contents = $this->getDoctrine()->getRepository('AppBundle:Content')->findAll();
        $content = [];
        foreach ($contents as $k => $v){
            $content[$v->getId()] = $v->getBody();
        }
        $news = $this->getDoctrine()->getRepository('AppBundle:Publication')->findBy([],['id' => 'DESC'],4);
        return $this->render('AppBundle:Default:index.html.twig', ['news' => $news, 'content' => $content, 'post' => $post]);
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
