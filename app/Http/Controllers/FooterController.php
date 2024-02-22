<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{

    public function faqs(){

        return view ('footer.faqs');
    }

    public function about(){

        return view ('footer.about');
    }
}
