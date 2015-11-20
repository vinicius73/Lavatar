<?php namespace Vinicius73\Lavatar\Facade;

use Illuminate\Support\Facades\Facade;

class LavatarFacade extends Facade
{
   protected static function getFacadeAccessor() { return 'lavatar'; }
}
