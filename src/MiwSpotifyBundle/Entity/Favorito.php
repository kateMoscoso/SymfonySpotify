<?php

namespace MiwSpotifyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Favorito
 */
class Favorito {

    /**
     * URL del proveedor de servicios (Spotify API REST)
     */
    const SPOTIFY_URL_API = 'https://api.spotify.com';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $idSpotify;

    /**
     * @var integer
     */
    private $idTipo;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="Favorito")
     * @ORM\JoinColumn(name="idUsuario", referencedColumnName="id")
     * @return integer
     */
    private $idUsuario;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set idSpotify
     *
     * @param string $idSpotify
     * @return Favorito
     */
    public function setIdSpotify($idSpotify) {
        $this->idSpotify = $idSpotify;

        return $this;
    }

    /**
     * Get idSpotify
     *
     * @return string 
     */
    public function getIdSpotify() {
        return $this->idSpotify;
    }

    /**
     * Set idTipo
     *
     * @param integer $idTipo
     * @return Favorito
     */
    public function setIdTipo($idTipo) {
        $this->idTipo = $idTipo;

        return $this;
    }

    /**
     * Get idTipo
     *
     * @return integer 
     */
    public function getIdTipo() {
        return $this->idTipo;
    }

    /**
     * Set idUsuario
     *
     * @param integer $idUsuario
     * @return Favorito
     */
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario() {
        return $this->idUsuario;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     * @return Favorito
     */
    public function setEtiqueta($etiqueta) {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get idSpotify
     *
     * @return string 
     */
    public function getEtiqueta() {
        return $this->etiqueta;
    }

    /**
     * Obtiene un listado de los temas Favoritos
     * 
     * @param string $lista Cadena de identificadores de Spotify
     * @return array Resultado de la búsquedam/ 
     * @link https://developer.spotify.com/web-api/console/get-several-tracks/ API Info
     */
    public function getFavoritos($lista, $tipo) {
        $peticion = (self::SPOTIFY_URL_API) . '/v1/' . $tipo . '?ids=' . $lista;
        $datos = file_get_contents($peticion);

        return json_decode($datos, true);
    }

     
    

}
