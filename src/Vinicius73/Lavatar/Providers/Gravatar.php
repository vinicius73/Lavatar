<?php namespace Vinicius73\Lavatar\Providers;

use HTML;

class Gravatar implements ProvidersInterface
{
   protected static $HTTP_URL = '//www.gravatar.com/avatar/';
   private $email;
   protected static $options
      = array(
         's' => 120,
         'r' => 'g',
         'd' => 'identicon'
      );

   public function __construct($email = null)
   {
      if (!empty($email)) $this->setEmail($email);
   }

   /**
    * @param array $options
    */
   public static function setOptions(array $options)
   {
      self::$options = array_merge(self::$options, $options);
   }

   /**
    * @param array $options
    */
   public function setupOptions(array $options)
   {
      self::setOptions($options);
   }

   /**
    * @param $email
    *
    * @return Gravatar
    */
   public static function make($email)
   {
      return new Gravatar($email);
   }


   /**
    * @param $name
    * @param $args
    *
    * @throws \Exception
    */
   public static function __callStatic($name, $args)
   {
      switch ($name):
         case 'setDefault':
            self::$options['d'] = array_get($args, 0);
            break;
         case 'setSize':
            self::$options['s'] = array_get($args, 0);
            break;
         case 'setRating':
            self::$options['r'] = array_get($args, 0);
            break;
         default:
            throw new \Exception('stact function Gravatar::' . $name . '() not found');
            break;

      endswitch;
   }

   /**
    * @param $name
    * @param $args
    *
    * @return Gravatar
    */
   public function __call($name, $args)
   {
      $options = array('default' => 'd', 'size' => 's', 'rating' => 'r');
      if (isset($options[$name])):
         self::$options[$options[$name]] = array_get($args, 0);
      else:
         self::$options[$name] = array_get($args, 0);
      endif;

      return $this;
   }

   /**
    * @return string
    */
   public function __toString()
   {
      return $this->image();
   }

   /**
    * @param $email
    *
    * @return Gravatar
    */
   public function setEmail($email)
   {
      $this->email = md5(mb_strtolower($email));

      return $this;
   }

   /**
    * @return string
    */
   protected function getGravatarURL()
   {
      return self::$HTTP_URL;
   }

   /**
    * @param array $optionsExtra
    *
    * @return string
    */
   public function url(array $optionsExtra = array())
   {
      if (empty($this->email)) return null;

      $url   = $this->getGravatarURL() . $this->email;
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
      $url = $this->url($optionsExtra);

      return HTML::image($url, $alt, $attr);
   }

   /**
    * @param $email
    *
    * @return Gravatar
    */
   public function setIdentificator($email)
   {
      return $this->setEmail($email);
   }

   /**
    * @param array $optionsExtra
    *
    * @return string
    */
   public function getUrl(array $optionsExtra = array())
   {
      return $this->url($optionsExtra);
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