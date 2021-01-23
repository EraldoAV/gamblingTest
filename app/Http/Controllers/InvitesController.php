<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvitesController extends Controller
{       
    public function homeView()
    {
        //reading file affiliates.tx from archives/affiliates.txt
        $contents = file_get_contents(base_path('archives/affiliates.txt'));

        //setting every data before \n one element inside $array
        $array = explode("\n", $contents);

        //converting all data from json to php obj and puting inside $arrayObj
        foreach ($array as $key => $value){
            $arrayObj[$key] = json_decode($value);
        }
        
        //sending it to laravel blade file home.blade.php
        return view('home', ['arrayObj' => $arrayObj]);
    }
    
    
}
