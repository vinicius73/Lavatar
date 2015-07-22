<?php namespace Vinicius73\Lavatar;

use Illuminate\Support\Collection;

/**
 * Class Lavatar
 *
 * @package Vinicius73\Lavatar
 * @method  Providers\ProvidersInterface Gravatar($email)
 */
class Lavatar
{
   /**
    * @var Collection
    */
   private $config;

   private $providersAvailable
      = array(
         'gravatar'  => 'Vinicius73\Lavatar\Providers\Gravatar',
         'minecraft' => 'Vinicius73\Lavatar\Providers\Minecraft',
         'twitter'   => 'Vinicius73\Lavatar\Providers\AvatarsIO\Twitter',
         'facebook'  => 'Vinicius73\Lavatar\Providers\AvatarsIO\Facebook',
         'instagram' => 'Vinicius73\Lavatar\Providers\AvatarsIO\Instagram',
      );

   private $providersLoadeds = array();
   private $defaultProvider;

   public function __construct(array $config)
   {
      $this->config = new Collection($config);

      $this->defaultProvider = $this->config->get('default_provider', 'Gravatar');
   }


   /**
    * @param $identificator
    *
    * @return Providers\ProvidersInterface
    */
   public function make($identificator)
   {
      $provider = $this->getProvider($this->defaultProvider);
      return $provider->make($identificator);
   }

   /**
    * @param $provider
    * @param $args
    *
    * @return Providers\ProvidersInterface
    */
   public function __call($provider, $args)
   {
      $provider = mb_strtolower($provider);

      $provider = $this->getProvider($provider);

      if (empty($args)) return $provider;

      return $provider->make(array_get($args, 0));
   }

   /**
    * @param $provider
    *
    * @return Providers\ProvidersInterface
    */
   public function getProvider($provider = null)
   {
      $provider = (is_null($provider)) ? $this->defaultProvider : $provider;
      $provider = mb_strtolower($provider);

      if (isset($this->providersLoadeds[$provider])):
         return $this->providersLoadeds[$provider];
      endif;

      return $this->loadProvider($provider);

   }

   /**
    * @param $provider
    *
    * @return Providers\ProvidersInterface;
    * @throws \Exception
    */
   private function loadProvider($provider)
   {
      if (!isset($this->providersAvailable[$provider])) throw new \Exception('Lavatar provider ' . $provider . ' does not exist.');

      $this->providersLoadeds[$provider] = app($this->providersAvailable[$provider]);

      $options = $this->config->get($provider, array());

      $this->providersLoadeds[$provider]->setupOptions($options);

      return $this->providersLoadeds[$provider];
   }
}