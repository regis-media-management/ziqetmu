<?php

namespace App\Providers;

use App\Models\Like;
use App\Models\Album;
use App\Models\Titre;
use App\Models\Recent;
use App\Models\Artiste;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*',function($view){

            $titres = Titre::all();
            $recents = Recent::where('user_id', Auth::user()->id )
                                ->orderBy('id', 'desc')
                                ->get();

            $view->with('titres', $titres)
                    ->with('recents', $recents);
        });
    }
}
