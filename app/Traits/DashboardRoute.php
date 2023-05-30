<?php 
namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

/**
 * DashboardRoute
 */
trait DashboardRoute
{
    public function getDashboardRoute()
    {
        if (Auth::user()->isAdmin) {
            return RouteServiceProvider::ADMINHOME;
        }elseif (Auth::user()->isUser) {
            return RouteServiceProvider::HOME;
        }
    }
}


?>