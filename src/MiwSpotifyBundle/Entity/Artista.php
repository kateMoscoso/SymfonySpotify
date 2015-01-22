<?php

namespace MiwSpotifyBundle\Entity;

/**
 * Artista
 */
class Artista
{
    /**
     * URL del proveedor de servicios (Spotify API REST)
     */
    const SPOTIFY_URL_API = 'https://api.spotify.com';

    /**
     * @var string Nombre del Artista
     */
    private $nombre;

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Artista
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    /**
     * Obtiene un listado de artistas coincidentes con la cadena $artista
     * 
     * @param string $artista Cadena de caracteres
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/search-item/ API Info
     */
    public function getArtistas($artista)
    {
        $peticion = (self::SPOTIFY_URL_API) . '/v1/search?q='.urlencode($artista).'&type=artist&market=ES';
        $datos = @file_get_contents($peticion);

        return json_decode($datos, true);
    }

    /**
     * Obtiene la información de un artista concreto (identificado por $artistaId)
     * @param string $artistaId Identificador del artista en Spotify
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/get-artist/ API Info
     */
    public static function obtenerArtista($artistaId)
    {
        $peticion = (self::SPOTIFY_URL_API) . '/v1/artists/'.$artistaId;
        $datos = @file_get_contents($peticion);

        return json_decode($datos, true);
    }
    
    /**
     * Obtiene el catálogo de álbumes de un artista en Spotify
     * @param string $artistaId Identificador del artista en Spotify
     * @param integer $limite El límite debe estar entre 1 y 50
     * @return array() Catálogo de álbumes
     * @link https://developer.spotify.com/web-api/get-artists-albums/ API Info
     */
    public static function getArtistaAlbumes($artistaId, $limite = 5)
    {
        if ($limite < 1):
          $limite =  1;
        elseif ($limite > 50):
          $limite = 50;
        endif;
        $peticion = (self::SPOTIFY_URL_API) .'/v1/artists/'.$artistaId.'/albums?market=ES&limit='.$limite;
        $datos = @file_get_contents($peticion);
        $info = json_decode($datos, true);

        return $info['items'];
    }  
}
