# The source code of <https://paweldymek.com>

This repository contains the source code of my blog built on [Laravel](https://laravel.com/) with [Laravel Nova](https://nova.laravel.com/) for admin panel.

Please note that this is not something like another boilerplate or even CMS to build your blog from scratch. This is real code of my blog adapted to my personal needs. You are free to use this code but please do not use my design and write your own HTML/CSS code. 

## What’s inside 

* Admin panel built on [Nova](https://nova.laravel.com/)
* Multilanguage support
* Simple RSS 2.0 feed

## Installation

* `git clone git@github.com:czemu/paweldymek.com.git`
* `cd paweldymek.com`
* `composer install`
* Copy `.env.example` to `.env` and fill in your MySQL database settings
* `php artisan key:generate`
* `php artisan migrate`
* Install Nova: <https://nova.laravel.com/docs/2.0/installation.html>
* `php artisan serve`

## Credits

* <https://nova.laravel.com/>
* <https://spatie.be/open-source>
* <https://github.com/InfinetyES/Nova-Filemanager>
* <https://github.com/mcamara/laravel-localization>
* <https://github.com/ebess/advanced-nova-media-library>
* <https://www.pexels.com/>

## License

The MIT License (MIT). Please see the [LICENSE.md](LICENSE.md) file for more information.
