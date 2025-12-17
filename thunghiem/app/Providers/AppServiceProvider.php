<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Property;
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
        // 🌟 CODE VIEW COMPOSER DỨT ĐIỂM 🌟
        // Chia sẻ biến $listingCount với TẤT CẢ các View (*)
        View::composer('*', function ($view) {
            $listingCount = 0;
            
            // Chỉ lấy số lượng nếu người dùng đã đăng nhập
            if (Auth::check()) {
                // Đếm số lượng tin đăng thuộc về user hiện tại
                $listingCount = Property::where('user_id', Auth::id())->count();
            }
            
            // Truyền biến 'listingCount' vào tất cả các View
            $view->with('listingCount', $listingCount);
        });
        
        // Em có thể thêm các cấu hình khác của Laravel ở đây
        // Ví dụ: Paginator::useBootstrapFive(); 
    }
}
