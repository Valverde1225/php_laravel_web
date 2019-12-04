<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraphicsController extends Controller
{

  public function consultagraphics_view()
  {
    return view('dashboard.graphics.consultagraphics_view');

  }

  
  public function respuestagraphics_view()
  {
    return view('dashboard.graphics.respuestagraphics_view');

  }
  
}
