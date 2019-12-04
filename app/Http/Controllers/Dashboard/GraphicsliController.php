<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraphicsliController extends Controller
{
  
  public function consultagraphicslitros_view()
  {
    return view('dashboard.graphics.consultagraphicslitros_view');

  }

  
  public function respuestagraphicslitros_view()
  {
    return view('dashboard.graphics.respuestagraphicslitros_view');

  }


  
}
