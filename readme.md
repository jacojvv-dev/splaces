# Splaces

Splaces is a location based service to find spaces and places around you. It retrieves points of interest, photos and weather reports for locations.

## API Keys needed

[Foursquare](https://developer.foursquare.com/)

[OpenWeatherMap](https://openweathermap.org/api)

[Flickr](https://www.flickr.com/services/api/)

[Google Places](https://developers.google.com/places/)

## Setup

1. clone the repository with `git clone https://github.com/jacojvv-dev/splaces.git`
2. `cd splaces`
3. `composer run-setup`
4. `php artisan key:generate`
5. edit .env file and set your db credentials and api keys
6. make sure your database is created in your local mysql instance, default db name is splaces
7. `php artisan migrate`
8. `npm install`
9. `npm run production`
10. `php artisan serve`

## Running the Dev Server

```bash
> php artisan serve
```

## Working With JavaScript

```bash
> npm run watch
```

## Running PHP Tests

If you want have code coverage output, please install [xdebug](https://xdebug.org/)

```bash
> composer run tests
```

## Licenses

Splaces is licenced under [WTFPL (Do What the Fuck You Want To Public License)](http://www.wtfpl.net/about/)

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Powered By

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>