<?php

namespace MiwSpotifyBundle\Entity;

/**
 * Album
 */
class Album
{
    /**
     * URL del proveedor de servicios (Spotify API REST)
     */
    const SPOTIFY_URL_API = 'https://api.spotify.com';

    /**
     * @var string Título del Álbum
     */
    private $nombre;

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return string Album
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string Album
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    /**
     * Obtiene un listado de álbumes coincidentes con la cadena $album
     * 
     * @param string $album Cadena de caracteres
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/search-item/ API Info
     */
    public function getAlbumes($album)
    {
        $peticion = (self::SPOTIFY_URL_API) . '/v1/search?q='.urlencode($album).'&type=album&market=ES';
        $datos = file_get_contents($peticion);

        return json_decode($datos, true);
    }

    /**
     * Obtiene la información de un álbum concreto (identificado por $albumId)
     * @param string $albumId Identificador del álbum en Spotify
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/get-album/ API Info
     */
    public static function obtenerAlbum($albumId)
    {
        $peticion = (self::SPOTIFY_URL_API) . '/v1/albums/' .$albumId;
        $datos = @file_get_contents($peticion);

        return json_decode($datos, true);
    }

    /**
     * Obtiene la lista de temas de un álbum en Spotify
     * @param string $albumId Identificador del álbum en Spotify
     * @return array() Catálogo de temas
     * @link https://developer.spotify.com/web-api/get-albums-tracks/ API Info
     */
    public static function getAlbumTemas($albumId)
    {
        $peticion = (self::SPOTIFY_URL_API) . '/v1/albums/'.$albumId.'/tracks';
        $datos = @file_get_contents($peticion);
        $info = json_decode($datos, true);

        return $info['items'];
    }
  
}
