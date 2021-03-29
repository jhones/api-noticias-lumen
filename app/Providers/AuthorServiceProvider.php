<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Author\Author;
use App\Repositories\Author\AuthorRepository;
use App\Services\Author\AuthorService;
use Illuminate\Support\ServiceProvider;

class AuthorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AuthorService::class, function ($app) {
           return new AuthorService(new AuthorRepository(new Author()));
        });
    }
}
