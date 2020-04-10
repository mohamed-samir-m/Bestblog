<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title='welcom to index page';
        return view ('pages.index')->with('title',$title);

    }
    public function services(){
        $data=['title' => 'the following services are provided',
        'services' => ['programming',
                        'automation',
                        'embedded system']];
        return view ('pages.services')->with($data);
        
    }
    public function about(){
        return view ('pages.about');
        
    }
}
