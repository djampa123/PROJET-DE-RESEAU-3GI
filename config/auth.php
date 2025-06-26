<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password reset
    | options for your application. You can change these defaults as needed.
    |
    */
    'defaults' => [
        'guard' => 'web', // Default guard for authentication
        'passwords' => 'users', // Default password reset configuration
    ],

    /*
    |--------------------------------------------------------------------------|
    | Authentication Guards
    |--------------------------------------------------------------------------|
    |
    | Define all authentication guards for your application. Each guard specifies
    | how authentication is handled and which provider it uses to retrieve users.
    |
    | Supported drivers: "session", "token"
    |
    */
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users', // Uses the 'users' provider
        ],
        'eleve' => [
            'driver' => 'session',
            'provider' => 'eleves', // Uses the 'eleves' provider
        ],
    ],

    /*
    |--------------------------------------------------------------------------|
    | User Providers
    |--------------------------------------------------------------------------|
    |
    | Define how users are retrieved from your database or other storage.
    | Each provider maps to a model or table used for authentication.
    |
    | Supported drivers: "database", "eloquent"
    |
    */
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class, // Model for default users
        ],
        'eleves' => [
            'driver' => 'eloquent',
            'model' => App\Models\Eleve::class, // Model for eleves
        ],
    ],

    /*
    |--------------------------------------------------------------------------|
    | Resetting Passwords
    |--------------------------------------------------------------------------|
    |
    | Define password reset configurations for each user provider. Each provider
    | can have its own password reset table and settings.
    |
    | The 'expire' time is the number of minutes a reset token is valid.
    | The 'throttle' time is the number of seconds a user must wait before
    | generating another reset token.
    |
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'eleves' => [
            'provider' => 'eleves',
            'table' => 'password_reset_tokens', // Shared table for simplicity
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------|
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------|
    |
    | Define the duration (in seconds) before a password confirmation times out,
    | prompting the user to re-enter their password.
    |
    */
    'password_timeout' => 10800, // 3 hours

];