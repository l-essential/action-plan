<?php

namespace App\Http\Controllers\Apps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingController extends Controller
{
    
    public function index()
    {
        # param 
        $data = [];
        $data['site_title'] = 'Listing Apps';

        return view('apps/list')->with($data);
    }

}
