<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**               
     * csvトップ画面の表示
     * @return View
     */
    public function show()
    {
        return view('admin');
    }
}
