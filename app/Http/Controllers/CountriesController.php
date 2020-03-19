<?php

namespace App\Http\Controllers;

use App\Countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
   
    /**
     * Display the specified resource.
     *
     * @param  \App\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return Countries::get();
    }

}
