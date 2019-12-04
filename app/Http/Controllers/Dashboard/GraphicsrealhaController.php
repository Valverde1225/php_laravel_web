<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraphicsrealhaController extends Controller
{
  
  public function consultagraphicsrealha_view()
  {
    return view('dashboard.graphics.consultagraphicsrealha_view');

  }
  
}
