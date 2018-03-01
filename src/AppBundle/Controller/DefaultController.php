<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('AppBundle::index.html.twig',
            [   'backgroundImg' => 'assets/img/home-bg.jpg',
                'mainTitle' => 'TITRE',
                'subTitle' => 'Bienvenue,'
            ]);
    }

    public function contactAction(Request $request)
    {
        return $this->render('AppBundle::contact.html.twig',
            [   'backgroundImg' => 'assets/img/contact-bg.jpg',
                'mainTitle' => 'Contact',
                'subTitle' => ''
            ]);
    }

    public function aboutAction(Request $request)
    {
        return $this->render('AppBundle::about.html.twig',
            [   'backgroundImg' => 'assets/img/about-bg.jpg',
                'mainTitle' => 'About',
                'subTitle' => ''
            ]);
    }

    public function postAction(Request $request)
    {
        return $this->render('AppBundle::post.html.twig',
            [   'backgroundImg' => 'assets/img/post-bg.jpg',
                'mainTitle' => 'Post',
                'subTitle' => ''
            ]);
    }
}
