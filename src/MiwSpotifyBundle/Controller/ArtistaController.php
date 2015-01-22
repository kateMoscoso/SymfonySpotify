<?php

namespace MiwSpotifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MiwSpotifyBundle\Form\ArtistaType;
use MiwSpotifyBundle\Entity\Artista;

class ArtistaController extends Controller {

    public function buscarArtistaAction(Request $request) {

        $entity = new Artista();
        $form = $this->createForm(
                new ArtistaType(), $entity, array(
            'action' => $this->generateUrl('artista_buscar'),
            'method' => 'POST',
                )
        );
        $form->handleRequest($request);

        if ($request->getMethod() === 'POST') { // process form
            $entities = $entity->getArtistas($request->get('nombre'));
           // $usr = $this->get('security.context')->getToken()->getUser()->getId();
            //getToken().getRoles()
            if ($this->get('security.context')->getToken()->getRoles() != []) {
                $lista = FavoritoController::obtenerFavoritos(1);
                return $this->render(
                                'MiwSpotifyBundle:Artista:listArtistas.html.twig', array(
                            'entities' => $entities, 'lista' => $lista,
                            'cadena' => $request->get('nombre'),
                                )
                );
            } else {
                return $this->render(
                                'MiwSpotifyBundle:Artista:listArtistas.html.twig', array(
                            'entities' => $entities,
                            'cadena' => $request->get('nombre'),
                                )
                );
            }
        }

        // show form
        return $this->render(
                        'MiwSpotifyBundle:Artista:buscarArtista.html.twig', array(
                    'entity' => $entity,
                    'datos' => $request->get('nombre'),
                        )
        );
    }

    /**
     * Muestra la información de un artista identificado por $artistaId
     * @param string $artistaId Identificador del artista en Spotify
     * @param integer $limite
     */
    public function mostrarArtistaAction($artistaId, $limite) {
        $infoArtista = Artista::obtenerArtista($artistaId);
        $albumes = Artista::getArtistaAlbumes($artistaId, $limite);
        if ($this->get('security.context')->getToken()->getRoles() != []) {
            $lista = FavoritoController::obtenerFavoritos(1);

            return $this->render(
                            'MiwSpotifyBundle:Artista:muestraArtista.html.twig', array(
                        'infoArtista' => $infoArtista, 'lista' => $lista,
                        'albumes' => $albumes,
                        'limite' => $limite,
                            )
            );
        } else {
            return $this->render(
                            'MiwSpotifyBundle:Artista:muestraArtista.html.twig', array(
                        'infoArtista' => $infoArtista,
                        'albumes' => $albumes,
                        'limite' => $limite,
                            )
            );
        }
    }

}
