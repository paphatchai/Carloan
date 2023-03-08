<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\ServiceProvider;
use App\transaction;
use App\maindatum;
use DB;
use Illuminate\Support\Facades\View;
use App\History;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        $NewData = DB::table('histories')
        ->join('maindatas', 'maindatas.id', '=', 'histories.maindata_id')
        ->join('users', 'users.id', '=', 'histories.staff_id')
        ->select('histories.created_at','maindatas.id','maindatas.code','maindatas.type','users.name', 'histories.note')
        ->where('histories.action','=','Create New')
        ->orderBy('histories.created_at', 'desc')
        ->groupBy('histories.maindata_id')
        ->take(5)
        ->get();
        $Editdata = DB::table('histories')
        ->join('maindatas', 'maindatas.id', '=', 'histories.maindata_id')
        ->join('users', 'users.id', '=', 'histories.staff_id')
        ->select('histories.updated_at','maindatas.id','maindatas.code','maindatas.type','users.name', 'histories.note')
        ->where('histories.action','<>','Create New')
        ->orderBy('histories.updated_at', 'desc')
        ->groupBy('histories.maindata_id')
        ->take(5)
        ->get();
        //$Editdata = $Editdata->getcodes()->distinct('maindata_id');
        $notinumber = $NewData->count()+$Editdata->count();
        
         View::share(compact('NewData','Editdata','notinumber'));
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
