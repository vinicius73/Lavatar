Lavatar
=======

Have easy access to various services of avatar, like the Gravatar.

[![Latest Stable Version](https://poser.pugx.org/vinicius73/lavatar/v/stable)](https://packagist.org/packages/vinicius73/lavatar) [![Total Downloads](https://poser.pugx.org/vinicius73/lavatar/downloads)](https://packagist.org/packages/vinicius73/lavatar) [![Latest Unstable Version](https://poser.pugx.org/vinicius73/lavatar/v/unstable)](https://packagist.org/packages/vinicius73/lavatar) [![License](https://poser.pugx.org/vinicius73/lavatar/license)](https://packagist.org/packages/vinicius73/lavatar)

## Installation

Run `composer require vinicius73/lavatar` in your console, or add the new required package in your composer.json

```
    "vinicius73/lavatar": "0.6.*"
```

Run `composer update` or `php composer.phar update`.

After composer command, add new service provider in `app/config/app.php` :

```php
    Vinicius73\Lavatar\LavatarServiceProvider::class,
```

Now, add new aliases in `app/config/app.php`.

```php
    'Lavatar' => Vinicius73\Lavatar\Facade\LavatarFacade::class,
```

Finally publish the configuration file of the package `php artisan vendor:publish vinicius73/lavatar`

## Usage

The mechanics of use of the package is quite simple, with it you have access avatars APIs: Gravatar, Minecraft and Avatars.io (Twitter, Facebook and Intagram)

Basic command. With it you create a type `ProvidersInterface` default object, which can be customized in the configuration file.

```php
   $avatar = Lavatar::make($identificator); // Creates standard object (Gravatar|Another)
   $avatar->getUrl(); // Returns the URL of the avatar.
   $avatar->image(); // Returns the image html tag.
   
   $avatar->getUrl($options); // Override the default settings of the object
   
   // @var string $alt      alt img tag
   // @var array $options   Override the default settings of the object
   // @var array $atts      extra img html tags
   $avatar->image($alt,$options,$atts);
```

Access more than one provider avatar is easy, just call him

#### Gravatar

```php
   Lavatar::Gravatar('email@domain.com.br')->getUrl();
   Lavatar::Gravatar('email.another@domain.com.br')->image();
```

#### Twitter

```php
   Lavatar::Twitter('twitterUserName')->getUrl();
   Lavatar::Twitter('twitterOther')->image();
```

#### Instagram

```php
   Lavatar::Instagram('InstagramUserName')->getUrl();
   Lavatar::Instagram('InstagramOther')->image();
```

#### Facebook

```php
   Lavatar::Facebook('FacebookUserName')->getUrl();
   Lavatar::Facebook('FacebookID')->image();
```

#### Minecraft

```php
   Lavatar::Minecraft('MinecraftUserName')->getUrl();
   Lavatar::Minecraft('MinecraftUser')->image();
   
   Lavatar::Minecraft('MinecraftUser')->avatar();
   Lavatar::Minecraft('MinecraftUser')->skin();
   Lavatar::Minecraft('MinecraftUser')->helm();
```

## Credits
- Author
 - [Vinicius73](https://github.com/vinicius73)
- Providers
 - [Gravatar](http://gravatar.com/)
 - [Minecraft (minotar)](https://minotar.net/)
 - [Avatars.io](http://avatars.io/)
    - Facebook
    - Twitter
    - Instagram
