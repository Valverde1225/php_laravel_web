<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraphicsteController extends Controller
{
  
  public function consultagraphicstemperatura_view()
  {
    return view('dashboard.graphics.consultagraphicstemperatura_view');

  }

  
  public function respuestagraphicstemperatura_view()
  {
    return view('dashboard.graphics.respuestagraphicstemperatura_view');

  }


  
}
