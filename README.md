# Booker Package

The Booking Extension for Twenty Six Digital restaurant clients Content Management Systems.

## Getting Started

`composer require twentysix/booker`

Ensure the autoload is set in composer.json:

```
"autoload": {
    "classmap": [
        "database"
    ],
    "psr-4": {
        "App\\": "app/",
        "Twentysix\\Booker\\": "packages/twentysix/booker/src"
    }
},
```

The run `composer dump-autoload` to sync up the files.

Next you will need to publish the package and it's core files into the project:

`php artisan vendor:publish`

This will copy the views over to resources/backend/booker - so then these can be made accessible through includes etc.

All public assets associated will also be copied over e.g JS and any Styles relating.

### Manual Configuration

#### Scripts

The vue components that are run on certain pages will need to be included into the `backend/layout/default.blade.php` footer just after the X-CRSF-TKEN is set to the Vue Header.

`@include('backend.booker.includes.scripts')`

#### Views

If for whatever reason the view files are changed location, you *must* change the view_path variable in `config/booker.php` to the new path.
(Remember, if you need to publish any new changes from the package, they will need to be copied over to your desired path).

#### Navigation

To include the booking navigation link with the number of bookings, the booking-nav include will need to be included within the `backend.layout.header` view where there will be a pre-defined comment.

`@include('backend.booker.includes.booking-nav')`

