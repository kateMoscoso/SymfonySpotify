<?php

namespace MiwSpotifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
      // $config = $this->container->getParameter('miw_spotify.spotify_url_api');
      return $this->render('MiwSpotifyBundle:Default:index.html.twig');
    }
}
