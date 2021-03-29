<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\News\News;
use App\Repositories\News\NewsRepository;
use App\Services\News\NewsService;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(NewsService::class, function ($app) {
           return new NewsService(new NewsRepository(new News()));
        });
    }
}
