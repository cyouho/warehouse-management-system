<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $middlewareData = $request->input();
        $viewData = $this->getIndexData($middlewareData['user_id']);

        return view('index.index_layer', ['indexData' => $viewData]);
    }

    private function getIndexData($userId)
    {
        $columnName = [
            '*'
        ];

        $conditions = [
            ['user_id', $userId],
        ];

        $goods = new Goods();
        $result = $goods->getNearExpiredFoods($columnName, $conditions);

        return $result;
    }
}
