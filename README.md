# Description
- This package is built to ease the so much works developers do. 

# Installation

`composer require yanah/laravel-ease-crud`

- Add `EaseServiceProvider` in `app.php` 

`'providers' => [
    // Other providers...
    Yanah\LaravelEase\EaseServiceProvider::class,
]
`

`$ php artisan vendor:publish --tag=config`
