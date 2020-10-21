<?php

namespace App\Providers;

use TCG\Voyager\Facades\Voyager;
use App\Voyager\DepartmentField;
use App\Voyager\DivisionField;
use App\Voyager\SectionField;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Voyager::addFormField(DivisionField::class);
        Voyager::addFormField(DepartmentField::class);
        Voyager::addFormField(SectionField::class);
    }
}
