<?php namespace Vinicius73\Lavatar\Providers;

use HTML;

abstract class AvatarsIO implements ProvidersInterface
{

   protected static $HTTP_URL = '//avatars.io/';
   protected $identificator;
   protected $prefix;
   protected static $options
      = array(
         'size' => 'large'
      );

   public function __construct($identificator = null)
   {
      if (!empty($identificator)) $this->setIdentificator($identificator);
   }

   /**
    * @param $identificator
    *
    * @return $this
    */
   public function setIdentificator($identificator)
   {
      $this->identificator = trim($identificator);
      return $this;
   }

   public function url(array $optionsExtra = array())
   {
      return $this->getUrl($optionsExtra);
   }

   /**
    * @param array $optionsExtra
    *
    * @return string
    */
   public function getUrl(array $optionsExtra = array())
   {
      $url = self::$HTTP_URL . $this->prefix . $this->identificator;

      $query = $this->makeQuery($optionsExtra);

      return $url . '?' . $query;
   }

   /**
    * @param null  $alt
    * @param array $optionsExtra
    * @param array $attr
    *
    * @return string
    */
   public function image($alt = null, array $optionsExtra = array(), array $attr = array())
   {
      $url = $this->getUrl($optionsExtra);

      return HTML::image($url, $alt, $attr);
   }

   /**
    * @param array $options
    *
    * @return void
    */
   public static function setOptions(array $options)
   {
      self::$options = array_merge(self::$options, $options);
   }

   /**
    * @param array $options
    *
    * @return mixed
    */
   public function setupOptions(array $options)
   {
      self::setOptions($options);
   }

   /**
    * @param $identificator
    *
    * @return $this
    */
   public static function make($identificator)
   {
      return new static ($identificator);
   }

   /**
    * @return string
    */
   public function __toString()
   {
      return $this->image();
   }

   /**
    * @param array $optionsExtra
    *
    * @return string
    */
   private function makeQuery(array $optionsExtra = array())
   {
      $options = self::$options;
      if (!empty($optionsExtra)) $options = array_merge(self::$options, $optionsExtra);

      return str_replace(
         array('%E7', '+'),
         array('~', '%20'),
         http_build_query($options, '', '&')
      );
   }
}