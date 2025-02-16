<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\PermissionGateAndPolicyAccess;
use Illuminate\Support\Facades\Gate;
use Illuminate\Pagination\Paginator;

use App\Policies\CategoryPolicy;
use App\Policies\MenuPolicy;
use App\Policies\ProductPolicy;
use App\Policies\SliderPolicy;
use App\Policies\SettingPolicy;

use App\Models\User;

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
        Paginator::useBootstrap();
        // $this->defineGateCategory();
        $permissionGateAndPolicy = new PermissionGateAndPolicyAccess();
        $permissionGateAndPolicy->setGateAndPolicyAccess(); 
        // //menu
        // Gate::define('menu-list', function (User $user) {
        //     return $user->checkPermissionAccess(config('permissions.access.list-menu'));
        // });
        // Gate::define('product-list', function (User $user) {
        //     return $user->checkPermissionAccess('product_list');
        // });
        // //kiểm tra user theo id người tạo sp
        // Gate::define('product-edit', function (User $user, $id) {
        //     $product = Product::find($id);
        //     if ( $user->checkPermissionAccess('product_edit') && $user->id === $product->user_id){
        //         return true;
        //     }
        //     return false;
        // });
    }



}
