<?php

namespace MiwSpotifyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
// use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MiwSpotifyExtension extends Extension // implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        // $container->setParameter('miw_spotify.spotify_url_api', $config['spotify_url_api']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * {@inheritdoc}
     */
//    public function prepend(ContainerBuilder $container)
//    {
//      // get all bundles
//      $bundles = $container->getParameter('kernel.bundles');
//      // determine if MiwSpotifyBundle is registered
//      if (!isset($bundles['MiwSpotifyBundle'])) {
//          // disable MiwSpotifyBundle in bundles
//          // $config = array('use_acme_goodbye' => false);
//          foreach ($container->getExtensions() as $name => $extension) {
//              switch ($name) {
//                  case 'acme_something':
//                  case 'miw_spotify':
//                      // set use_acme_goodbye to false in the config of acme_something and acme_other
//                      // note that if the user manually configured use_acme_goodbye to true in the
//                      // app/config/config.yml then the setting would in the end be true and not false
//                      $container->prependExtensionConfig($name, $config);
//                      break;
//              }
//          }
//      }
//
//      // process the configuration of MiwSpotifyExtension
//      $configs = $container->getExtensionConfig($this->getAlias());
//      // use the Configuration class to generate a config array with the settings "miw_spotify"
//      $config = $this->processConfiguration(new Configuration(), $configs);
//
//      // check if spotify_url_api is set in the "miw_spotify" configuration
//      if (isset($config['spotify_url_api'])) {
//          // prepend the spotify_url_api settings with the spotify_url_api
//          $config = array('spotify_url_api' => $config['spotify_url_api']);
//          $container->prependExtensionConfig('miw_spotify', $config);
//      }
//    }
}