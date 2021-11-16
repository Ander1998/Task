<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function getData(Request $request)
    {
        
        $request->validate($request->all(),[
            'username' => 'required|max:255',
        ]);
        return $request->input();
    }

}