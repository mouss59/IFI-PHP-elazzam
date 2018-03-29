<?php


namespace App\Controller;
use App\Entity\Tournament;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class HomePageController extends AbstractController
{

    /**
     * @Route("/homepage",name="homepage")
     */

    public function index(Request $request)
    {
        $tournaments = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Tournament::class)
            ->findAll()
            ;

        /*[
            ['name' => 'Tournament 1'],
            ['name' => 'Tournament 2'],
        ];*/

        return $this->render(
            'homepage.html.twing',
            [
                            'tournaments' => $tournaments,
                            'message' => $request->query->get('message','pas de message')
        ]);
    }

}


