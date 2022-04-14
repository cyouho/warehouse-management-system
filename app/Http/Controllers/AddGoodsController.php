<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddGoodsController extends Controller
{
    public function index()
    {
        return view('add_food.add_food_layer');
    }

    public function addGoodsAction(Request $request)
    {
        $data = $request->post();
        dd($data);
    }
}
