<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraphicsrealteController extends Controller
{
  
  public function consultagraphicsrealte_view()
  {
    return view('dashboard.graphics.consultagraphicsrealte_view');

  }
  
}
