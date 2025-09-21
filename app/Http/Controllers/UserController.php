<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentMovie;

class UserController extends Controller
{
    public function create(Request $request){
        $data=$request->validate([
            'name'=>'required',
            'year'=>'required|numeric',
            'director'=>'required'
        ]);

        $newMovie = ContentMovie::create($data);

        return redirect('/');
    }
}
