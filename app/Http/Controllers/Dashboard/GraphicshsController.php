<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraphicshsController extends Controller
{
  
  public function consultagraphicshumedads_view()
  {
    return view('dashboard.graphics.consultagraphicshumedads_view');

  }

  
  public function respuestagraphicshumedads_view()
  {
    return view('dashboard.graphics.respuestagraphicshumedads_view');

  }


  
}
