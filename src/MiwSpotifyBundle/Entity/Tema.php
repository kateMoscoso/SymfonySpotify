<?php

namespace MiwSpotifyBundle\Entity;

/**
 * Tema
 */
class Tema
{
    /**
     * URL del proveedor de servicios (Spotify API REST)
     */
    const SPOTIFY_URL_API = 'https://api.spotify.com';

    /**
     * @var string Título del Tema
     */
    private $nombre;

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return string Tema
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string Tema
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    /**
     * Obtiene un listado de los temas coincidentes con la cadena $tema
     * 
     * @param string $tema Cadena de caracteres
     * @return array Resultado de la búsquedam/ 
     * @link https://developer.spotify.com/web-api/search-item API Info
     */
    public function getTemas($tema)
    {
        $peticion = (self::SPOTIFY_URL_API) . '/v1/search?q='.urlencode($tema).'&type=track&market=ES';
        $datos = file_get_contents($peticion);

        return json_decode($datos, true);
    }

    /**
     * Obtiene la información de un tema concreto (identificado por $temaId)
     * @param string $temaId Identificador del tema en Spotify
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/get-track/ API Info
     */
    public static function obtenerTema($temaId)
    {
        $peticion = (self::SPOTIFY_URL_API) . '/v1/tracks/' .$temaId;
        $datos = @file_get_contents($peticion);

        return json_decode($datos, true);
    }  
}
