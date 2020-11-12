<?php

namespace App\Listeners;

use App\Models\Reker\RekerPeriode;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AfterLoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $objPeriode = new RekerPeriode();
        $query = $objPeriode->get();
        foreach ($query as $key => $value) 
        {
            \Session::put('periode_'. $value->id, $value->is_closed);
        }
    }
}
