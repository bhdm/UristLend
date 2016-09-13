<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\SecurityContext;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_main")
     * @Template("@App/Admin/main.html.twig")
     */
    public function indexAction()
    {
        return [];
    }





}
