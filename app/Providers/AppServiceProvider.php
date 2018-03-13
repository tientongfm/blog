<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Slide;
use App\Typenews;
use App\News;
use App\Comment;
use App\User;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $category = Category::all();
        $slide = Slide::all();
        view()->share('category', $category);
        view()->share('slide', $slide);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
