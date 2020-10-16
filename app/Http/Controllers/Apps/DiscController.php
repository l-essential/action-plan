<?php

namespace App\Http\Controllers\Apps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DiscQuestion;

class DiscController extends Controller
{
    
    public function index()
    {
        # param 
        $data = [];
        $data['site_title'] = 'D.I.S.C';

        if( app('request')->input('page') == 1 OR empty(app('request')->input('page')) ){
            $question_order = [1, 2, 3, 4];
        }else if( app('request')->input('page') == 2 ){
            $question_order = [5, 6, 7, 8];
        }else if( app('request')->input('page') == 3 ){
            $question_order = [9, 10, 11, 12];
        }else if( app('request')->input('page') == 4 ){
            $question_order = [13, 14, 15, 16];
        }else if( app('request')->input('page') == 5 ){
            $question_order = [17, 18, 19, 20];
        }else if( app('request')->input('page') == 6 ){
            $question_order = [21, 22, 23, 24];
        }

        # data
        $data['questions'] = new DiscQuestion;
        $data['questions'] = $data['questions']
                                ->orderBy('question_order')
                                ->where('is_active', 'Y')
                                ->whereIn('question_order', $question_order)
                                ->get();

        return view('apps/disc/form')->with($data);
    }

}
