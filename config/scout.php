<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Scout Driver
    |--------------------------------------------------------------------------
    |
    | Here you may specify which search driver you would like Scout to use.
    | Laravel Scout supports a variety of drivers, including Algolia. You may
    | also use the "database" driver if you prefer to perform searches using
    | your own database.
    |
    */
    'driver' => env('SCOUT_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Algolia Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Algolia application credentials. You will need
    | an Algolia account to obtain your Application ID and API Key. If you are not
    | using Algolia, you can leave this section blank or set the driver to "database".
    |
    */
    'algolia' => [
        'id' => env('ALGOLIA_APP_ID'),
        'secret' => env('ALGOLIA_SECRET'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Prefix Indexes
    |--------------------------------------------------------------------------
    |
    | If you would like to prefix your indexes with a specific string, you may do so
    | here. This is useful for multi-tenant applications.
    |
    */
    'prefix' => env('SCOUT_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    |
    | You may set the pagination length to a desired value. This controls how many
    | results are returned per page for your search.
    |
    */
    'paginate' => 20,
];
