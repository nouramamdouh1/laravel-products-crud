<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function redirection(bool $status)
    {
        if ($status) {
            return redirect()->back()->with('success','successfull operation');
        }
        else {
            return redirect->back()->with('error','failed operation');
        }
    }
}
