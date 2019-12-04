<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapsController extends Controller
{

  public function maps_view()
  {
    return view('dashboard.maps.maps_view');

  }

  
}
