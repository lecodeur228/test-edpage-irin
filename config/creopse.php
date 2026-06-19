<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Creopse Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration options for the Creopse package.
    | You can customize these settings to suit your application's needs.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | Specifies the user model class that the package should use.
    | This is typically used for authentication, relationships, or other
    | user-related functionality.
    |
    | Default: \App\Models\User::class
    |
    */
    'user_model' => User::class,

    /*
    |--------------------------------------------------------------------------
    | Seed Default Data
    |--------------------------------------------------------------------------
    |
    | Determines whether the package should seed default data into the database
    | when running migrations or seeders.
    |
    | Set this to `true` to enable seeding of default data, or `false` to
    | disable it.
    |
    | Default: true
    |
    */
    'seed_default_data' => true,

    /*
    |--------------------------------------------------------------------------
    | Rate Limit
    |--------------------------------------------------------------------------
    |
    | Specifies the maximum number of requests allowed per minute for routes
    | or features protected by rate limiting.
    |
    | This value can be overridden by the `CREOPSE_RATE_LIMIT` environment
    | variable.
    |
    | Default: 600 (requests per minute)
    |
    */
    'rate_limit' => env('CREOPSE_RATE_LIMIT', 600),

    /*
    |--------------------------------------------------------------------------
    | Rate Limit By
    |--------------------------------------------------------------------------
    |
    | Specifies the criteria for applying rate limits. This can be either:
    | - 'ip': Rate limit by the client's IP address.
    | - 'user': Rate limit by the authenticated user.
    |
    | Default: 'ip'
    |
    */
    'rate_limit_by' => 'ip', // or 'user'

    /*
    |--------------------------------------------------------------------------
    | Response Compression
    |--------------------------------------------------------------------------
    |
    | Controls automatic HTTP response compression. When enabled, the middleware
    | negotiates the best available algorithm (Brotli > Gzip > Deflate) based
    | on the client's Accept-Encoding header.
    |
    | Brotli requires the ext-brotli PECL extension and HTTPS.
    | Gzip and Deflate require ext-zlib (bundled with PHP by default).
    |
    */
    'compression' => [

        /*
        | Enable or disable response compression entirely.
        | Set to false if compression is already handled upstream (Nginx, Caddy, CloudFront...).
        */
        'enabled' => env('CREOPSE_COMPRESSION', true),

        /*
        | Compression level applied to all algorithms.
        |
        | Gzip / Deflate : 0 (no compression) → 9 (maximum)
        | Brotli         : 0 (no compression) → 11 (maximum)
        |
        | Level 5 is the recommended sweet spot for real-time PHP responses.
        | Higher levels yield diminishing returns and increase CPU overhead.
        */
        'level' => env('CREOPSE_COMPRESSION_LEVEL', 5),

        /*
        | Minimum response size in bytes required to trigger compression.
        |
        | Compressing small payloads is counterproductive — the compression
        | headers alone can outweigh the size reduction.
        | Default: 1024 bytes (1 KB).
        */
        'min_length' => env('CREOPSE_COMPRESSION_MIN_LENGTH', 1024),

    ],

];
