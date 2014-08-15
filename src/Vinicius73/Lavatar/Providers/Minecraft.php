<?php namespace Vinicius73\Lavatar\Providers;

use HTML;

class Minecraft implements ProvidersInterface
{

   protected static $HTTP_URL = '//minotar.net/';
   protected $identificator;
   protected static $options
      = array(
         'size' => 100
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


   /**
    * @param array $options
    *
    * @return string
    */
   public function getUrl(array $options = array())
   {
      return $this->getAvatar($options);
   }

   /**
    * @return string
    */
   public function getAvatar(array $options = array())
   {
      return $this->makeUrl('avatar', $options);
   }

   /**
    * @return string
    */
   public function getHelm(array $options = array())
   {
      return $this->makeUrl('helm', $options);
   }

   /**
    * @param array $options
    *
    * @return string
    */
   public function getSkin()
   {
      return $this->makeUrl('skin', array('size' => null, 'extension' => null));
   }

   /**
    * @param       $type
    * @param array $options
    *
    * @return string
    */
   public function makeUrl($type, array $options = array())
   {
      $url = self::$HTTP_URL . $type . '/' . $this->identificator;

      $options = array_merge(self::$options, $options);

      $size      = array_get($options, 'size', null);
      $extension = array_get($options, 'extension', null);

      if (!empty($size)) $url .= '/' . $size;
      if (!empty($extension)) $url .= $extension;

      return $url;
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
}