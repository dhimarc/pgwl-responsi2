<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingpageController extends Controller
{
    //
    public function index()
    {
        $data=[
        "title" =>"Peta Anu",
    ];

        return view('landingpage', $data);

    }

}
