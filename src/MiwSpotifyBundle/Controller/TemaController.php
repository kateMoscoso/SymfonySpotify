<?php

namespace MiwSpotifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MiwSpotifyBundle\Form\TemaType;
use MiwSpotifyBundle\Entity\Tema;

class TemaController extends Controller {

    public function buscarTemaAction(Request $request) {

        $entity = new Tema();
        $form = $this->createForm(new TemaType(), $entity, array('action' => $this->generateUrl('tema_buscar'), 'method' => 'POST'));
        $form->handleRequest($request);

        if ($request->getMethod() === 'POST') { // process form
            $entities = $entity->getTemas($request->get('nombre'));
            if ($this->get('security.context')->getToken()->getRoles() != []) {
                $lista = FavoritoController::obtenerFavoritos(3);
                return $this->render('MiwSpotifyBundle:Tema:listTemas.html.twig', array('entities' => $entities, 'lista' => $lista, 'cadena' => $request->get('nombre')));
            } else {
                return $this->render('MiwSpotifyBundle:Tema:listTemas.html.twig', array('entities' => $entities, 'cadena' => $request->get('nombre')));
            }
        }

        // show form
        return $this->render(
                        'MiwSpotifyBundle:Tema:buscarTema.html.twig', array(
                    'entity' => $entity,
                    'datos' => $request->get('nombre'),)
        );
    }

    /**
     * Muestra la información de un tema identificado por $temaId
     * @param string $temaId Identificador del tema en Spotify
     */
    public function mostrarTemaAction($temaId) {
        $infoTema = Tema::obtenerTema($temaId);
        if ($this->get('security.context')->getToken()->getRoles() != []) {
        $lista = FavoritoController::obtenerFavoritos(3);
        return $this->render(
                        'MiwSpotifyBundle:Tema:muestraTema.html.twig', array(
                    'infoTema' => $infoTema, 'lista' => $lista,
                        )
        );
        }else{
            return $this->render(
                        'MiwSpotifyBundle:Tema:muestraTema.html.twig', array(
                    'infoTema' => $infoTema, )
        ); 
        }
    }

}
