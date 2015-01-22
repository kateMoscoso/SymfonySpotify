<?php

namespace MiwSpotifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use MiwSpotifyBundle\Entity\Favorito;

class FavoritoController extends Controller {

    public function indexAction() {
        //$response = new \Symfony\Component\HttpFoundation\Response('Hola mundo!!!');
        return new Response('Hola mundo!!!');
    }

    public function aniadirInterpreteFavoritoAction($artistaId) {
        $favorito = new Favorito();
        $usr = $this->get('security.context')->getToken()->getUser()->getId();
        if (!$this->existeFavorito(1, $artistaId, $usr)) {
            $favorito->setIdSpotify($artistaId);
            $favorito->setIdTipo(1);
            $favorito->setIdUsuario($usr);
            $favorito->setEtiqueta("");
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($favorito);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('favoritos_artistas'));
    }

    public function aniadirAlbumFavoritoAction($albumId) {
        $favorito = new Favorito();
        $usr = $this->get('security.context')->getToken()->getUser()->getId();

        if (!$this->existeFavorito(2, $albumId, $usr)) {

            $favorito->setIdSpotify($albumId);
            $favorito->setIdTipo(2);
            $favorito->setIdUsuario($usr);
            $favorito->setEtiqueta("");
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($favorito);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('favoritos_albumes'));
    }

    public function aniadirTemaFavoritoAction($temaId) {
        $favorito = new Favorito();
        $usr = $this->get('security.context')->getToken()->getUser()->getId();

        if (!$this->existeFavorito(3, $temaId, $usr)) {
            $favorito->setIdSpotify($temaId);
            $favorito->setIdTipo(3);
            $favorito->setIdUsuario($usr);
            $favorito->setEtiqueta("");
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($favorito);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('favoritos_temas'));
    }

    public function mostrarArtistasAction() {
        $entity = new Favorito();
        $lista_etiquetas = "";
        $entities = "";
        $usr = $this->get('security.context')->getToken()->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository('MiwSpotifyBundle:Favorito');
        $resultado = $repository->findBy(array('idTipo' => 1, 'idUsuario' => $usr));
        if (!empty($resultado)) {
            $i = 0;
            foreach ($resultado as $re) {
                $lista_etiquetas[$re->getIdSpotify()] = $re->getEtiqueta();
                if ($i == 0) {
                    $lista = "" . $re->getIdSpotify();
                    $i = 1;
                } else {
                    $lista.="," . $re->getIdSpotify();
                }
            }
            $entities = $entity->getFavoritos($lista, "artists");
        }
        
        return $this->render('MiwSpotifyBundle:Favorito:listArtistaFavorito.html.twig', array('entities' => $entities, 'etiquetas' => $lista_etiquetas));
    }

    public function mostrarAlbumesAction() {
        $entity = new Favorito();
        $usr = $this->get('security.context')->getToken()->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository('MiwSpotifyBundle:Favorito');
        $resultado = $repository->findBy(array('idTipo' => 2, 'idUsuario' => $usr));
        $lista_etiquetas = "";
        $entities = "";
        if (!empty($resultado)) {
            $i = 0;
            foreach ($resultado as $re) {
                $lista_etiquetas[$re->getIdSpotify()] = $re->getEtiqueta();
                if ($i == 0) {
                    $lista = "" . $re->getIdSpotify();
                    $i = 1;
                } else {
                    $lista.="," . $re->getIdSpotify();
                }
            }
            $entities = $entity->getFavoritos($lista, "albums");
        }

        return $this->render('MiwSpotifyBundle:Favorito:listAlbumFavorito.html.twig', array('entities' => $entities, 'etiquetas' => $lista_etiquetas));
    }

    public function mostrarTemasAction() {
        $entity = new Favorito();
        $lista_etiquetas = "";
        $entities = "";
        $usr = $this->get('security.context')->getToken()->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository('MiwSpotifyBundle:Favorito');
        $resultado = $repository->findBy(array('idUsuario' => $usr, 'idTipo' => 3));
        if (!empty($resultado)) {
            $i = 0;
            //
            foreach ($resultado as $re) {
                $lista_etiquetas[$re->getIdSpotify()] = $re->getEtiqueta();
                if ($i == 0) {
                    $lista = "" . $re->getIdSpotify();

                    $i = 1;
                } else {
                    $lista.="," . $re->getIdSpotify();
                }
            }
            $entities = $entity->getFavoritos($lista, "tracks");
        }
        return $this->render('MiwSpotifyBundle:Favorito:listTemaFavorito.html.twig', array('entities' => $entities, 'etiquetas' => $lista_etiquetas));
    }

    public function aniadirEtiquetaAction($etiquetaId, $idSpotify, $idTipo) {
        $usr = $this->get('security.context')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('MiwSpotifyBundle:Favorito');
        $entity = $repository->findOneBy(array('idUsuario' => $usr, 'idSpotify' => $idSpotify));
        $entity->setEtiqueta($etiquetaId);
        $em->persist($entity);
        $em->flush();
        if ($idTipo == 1) {
            return $this->redirect($this->generateUrl('favoritos_artistas'));
        }
        if ($idTipo == 2) {
            return $this->redirect($this->generateUrl('favoritos_albumes'));
        }
        if ($idTipo == 3) {
            return $this->redirect($this->generateUrl('favoritos_temas'));
        }
    }

    public function eliminarFavoritoAction($idSpotify, $idTipo) {

        $usr = $this->get('security.context')->getToken()->getUser()->getId();
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('MiwSpotifyBundle:Favorito');
        $entity = $repository->findOneBy(array('idUsuario' => $usr, 'idSpotify' => $idSpotify));
        $em->remove($entity);
        $em->flush();
        if ($idTipo == 1) {
            return $this->redirect($this->generateUrl('favoritos_artistas'));
        }
        if ($idTipo == 2) {
            return $this->redirect($this->generateUrl('favoritos_albumes'));
        }
        if ($idTipo == 3) {
            return $this->redirect($this->generateUrl('favoritos_temas'));
        }
    }

    public function existeFavorito($tipoFavorito, $idSpotify, $usr) {
        $existe = false;
        $repository = $this->getDoctrine()->getRepository('MiwSpotifyBundle:Favorito');
        $resultado = $repository->findBy(array('idTipo' => $tipoFavorito, 'idUsuario' => $usr, 'idSpotify' => $idSpotify));
        if (!empty($resultado)) {
            $existe = true;
        }
        return $existe;
    }

    public function obtenerFavoritos($idTipo) {
        $usr = $this->get('security.context')->getToken()->getUser()->getId();
        $repository = $this->getDoctrine()->getRepository('MiwSpotifyBundle:Favorito');
        $resultado = $repository->findBy(array('idTipo' => $idTipo, 'idUsuario' => $usr));
        $lista_etiquetas = "";
        if (!empty($resultado)) {
            foreach ($resultado as $re) {
                $lista_etiquetas[$re->getIdSpotify()] = $re->getIdSpotify();
            }
        }
        return $lista_etiquetas;
    }

}
