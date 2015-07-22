<?php namespace Vinicius73\Lavatar\Providers;

interface ProvidersInterface
{

   /**
    * @param $identificator
    *
    * @return $this
    */
   public function setIdentificator($identificator);

   /**
    * @param array $options
    *
    * @return string
    */
   public function getUrl(array $options = array());

   /**
    * @param null  $alt
    * @param array $optionsExtra
    * @param array $attr
    *
    * @return string
    */
   public function image($alt = null, array $optionsExtra = array(), array $attr = array());

   /**
    * @param array $options
    *
    * @return void
    */
   public static function setOptions(array $options);

   /**
    * @param array $options
    *
    * @return mixed
    */
   public function setupOptions(array $options);

   /**
    * @param $identificator
    *
    * @return $this
    */
   public static function make($identificator);

   /**
    * @return string
    */
   public function __toString();
}