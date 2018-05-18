<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Annuaire;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

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

    public function addAction(Request $request, $name, $phone)
    {
        $man = $this->getDoctrine()->getManager();

        $annu = new Annuaire();
        $annu->setName($name);
        $annu->setPhone($phone);

        $man->persist($annu);
        $man->flush();

        return new Response("ok $name $phone"); //todo : renvoyer du json et gêrer l'erreur dans le javascript
    }

    public function searchAction(Request $request, $name, $phone)
    {
        $man = $this->getDoctrine()->getManager();

        $entities = '';
        if (($name != '__') && ($phone != '__')) {
            $entities = $man->getRepository('AppBundle:Annuaire')->findBy([
                "name" => $name,
                "phone" => $phone
            ]);
        } else if ($name != '__') {
            $entities = $man->getRepository('AppBundle:Annuaire')->findBy([
                "name" => $name
            ]);
        } else if ($phone != '__') {
            $entities = $man->getRepository('AppBundle:Annuaire')->findBy([
                "phone" => $phone
            ]);
        }

        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new
        JsonEncoder()));

        $message = $serializer->serialize($entities, 'json');
        return new JsonResponse($message);
    }

    public function searchSoundExAction(Request $request, $name, $phone)
    {
        $man = $this->getDoctrine()->getManager();

        $entities = '';
        if (($name != '__') && ($phone != '__')) {
            $entities = $man->getRepository('AppBundle:Annuaire')->findBy([
                "name" => $name,
                "phone" => $phone
            ]);

        } else if ($name != '__') {

            $queryBuilder = $man->getRepository('AppBundle:Annuaire')->createQueryBuilder('u');

            $queryBuilder->select('u')
                ->from(Annuaire::class, 'name')
                //->where('u.name = :name')
                ->where("SOUNDEX(u.name) LIKE SOUNDEX(:name)")
                ->setParameter('name', $name);

            $query = $queryBuilder->getQuery();

            $entities = $query->getResult();
        } else if ($phone != '__') {
            $entities = $man->getRepository('AppBundle:Annuaire')->findBy([
                "phone" => $phone
            ]);
        }

        $serializer = new Serializer(array(new GetSetMethodNormalizer()), array('json' => new
        JsonEncoder()));

        $message = $serializer->serialize($entities, 'json');
        return new JsonResponse($message);
    }

    public function annuaireAction(Request $request)
    {
        $man = $this->getDoctrine()->getManager();

        return $this->render('AppBundle::annuForm.html.twig',
            [   'backgroundImg' => 'assets/img/home-bg.jpg',
                'mainTitle' => 'Annuaire',
                'subTitle' => 'Votre annuaire,'
            ]);
    }

}
