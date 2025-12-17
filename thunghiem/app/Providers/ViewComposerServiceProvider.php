<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\City; 

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // ⭐️ ĐỊNH NGHĨA VIEW COMPOSER ⭐️
        // 'layouts.navigation' là tên file view của bạn
        View::composer('layouts.navigation', function ($view) {
            // Lấy tất cả Cities từ database
            $cities = City::all(); 
            
            // Truyền biến $cities vào view. Biến này sẽ truy cập được bằng $cities
            $view->with('cities', $cities);
        });
        // ⭐️ KẾT THÚC VIEW COMPOSER ⭐️
    }
}