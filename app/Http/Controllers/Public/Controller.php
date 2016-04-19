<?php

namespace emutoday\Http\Controllers\Public;

use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{

  public function __construct()
  {
    $this->middleware('auth');
  }
}
