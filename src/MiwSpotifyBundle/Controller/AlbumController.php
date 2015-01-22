<?php

namespace MiwSpotifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use MiwSpotifyBundle\Form\AlbumType;
use MiwSpotifyBundle\Entity\Album;

class AlbumController extends Controller {

    public function buscarAlbumAction(Request $request) {

        $entity = new Album();
        $form = $this->createForm(
                new AlbumType(), $entity, array(
            'action' => $this->generateUrl('album_buscar'),
            'method' => 'POST',
                )
        );
        $form->handleRequest($request);

        if ($request->getMethod() === 'POST') { // process form
            $entities = $entity->getAlbumes($request->get('nombre'));
            if ($this->get('security.context')->getToken()->getRoles() != []) {
                $lista = FavoritoController::obtenerFavoritos(2);
                return $this->render(
                                'MiwSpotifyBundle:Album:listAlbumes.html.twig', array(
                            'entities' => $entities, 'lista' => $lista,
                            'cadena' => $request->get('nombre'),
                                )
                );
            } else {
                return $this->render(
                                'MiwSpotifyBundle:Album:listAlbumes.html.twig', array(
                            'entities' => $entities,
                            'cadena' => $request->get('nombre'),
                                )
                );
            }
        }

        // show form
        return $this->render(
                        'MiwSpotifyBundle:Album:buscarAlbum.html.twig', array(
                    'entity' => $entity,
                    'datos' => $request->get('nombre'),
                        )
        );
    }

    /**
     * Muestra la información de un álbum identificado por $albumId
     * @param string $albumId Identificador del álbum en Spotify
     * @param integer $limite
     */
    public function mostrarAlbumAction($albumId, $limite) {
        $infoAlbum = Album::obtenerAlbum($albumId);
        $temas = Album::getAlbumTemas($albumId, $limite);
        if ($this->get('security.context')->getToken()->getRoles() != []) {
            $lista = FavoritoController::obtenerFavoritos(2);
            $listaTemas = FavoritoController::obtenerFavoritos(3);
            return $this->render(
                            'MiwSpotifyBundle:Album:muestraAlbum.html.twig', array(
                        'infoAlbum' => $infoAlbum, 'lista' => $lista, 'listaTemas' => $listaTemas,
                        'temas' => $temas,'limite' => $limite,
                            )
            );
        } else {
            return $this->render(
                            'MiwSpotifyBundle:Album:muestraAlbum.html.twig', array(
                        'infoAlbum' => $infoAlbum,
                        'temas' => $temas,
                        'limite' => $limite,
                            )
            );
        }
    }

    public function obtenerAlbumsFavoritos() {
        $usr = $this->get('security.context')->getToken()->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository('MiwSpotifyBundle:Favorito');
        $resultado = $repository->findBy(array('idTipo' => 2, 'idUsuario' => $usr));
        $lista_etiquetas = "";
        if (!empty($resultado)) {
            foreach ($resultado as $re) {
                $lista_etiquetas[$re->getIdSpotify()] = $re->getIdSpotify();
            }
        }
        return $lista_etiquetas;
    }

}
