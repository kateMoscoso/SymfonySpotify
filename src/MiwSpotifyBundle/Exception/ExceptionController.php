<?php

namespace MiwSpotifyBundle\Exception;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;
use Symfony\Component\HttpKernel\FlattenException;

class ExceptionController extends Controller
{
    public function showAction(FlattenException $exception, DebugLoggerInterface $logger)
    {
        return $this->render('MiwSpotifyBundle:Exception:show.html.twig', array(
            ));    }

}
