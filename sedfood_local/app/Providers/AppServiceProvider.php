<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View; // nó được sử dụng để đăng ký một composer view. Composer view cho phép chúng ta thêm dữ liệu vào các view trước khi chúng được hiển thị.
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //View::composer là một cơ chế để chia sẻ dữ liệu giữa các view một cách dễ dàng
        View::composer(['layout.header', 'layout.footer'], function ($view) {
            $view->with('categories', Category::all());
        });

        Paginator::useBootstrap();
    }
}