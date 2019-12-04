<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GraphicsrealhsController extends Controller
{
  
  public function consultagraphicsrealhs_view()
  {
    return view('dashboard.graphics.consultagraphicsrealhs_view');

  }
  
}
