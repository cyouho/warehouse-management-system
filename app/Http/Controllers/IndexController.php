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

    public function searchGoodsAjax(Request $request)
    {
        $postData = $request->post();

        if ($postData['q'] === '') return FALSE;

        $columnName = [
            '*'
        ];

        $conditions = [
            ['user_id', $postData['user_id']],
            ['sub_name', 'like', '%' . $postData['q'] . '%'],
        ];

        $condistionsForOr = [
            ['offical_name', 'like', '%' . $postData['q'] . '%']
        ];

        $goods = new Goods();
        $viewData = $goods->getSearchGoods($columnName, $conditions, $condistionsForOr);

        return view('index.index_search_goods_result', ['search_goods_result' => $viewData]);
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
        $nearExpiredResult = $goods->getNearExpiredGoods($columnName, $conditions);
        $expiredResult = $goods->getExpiredGoods();

        return [
            'near_expired_goods' => $nearExpiredResult,
            'expired_goods' => $expiredResult,
        ];
    }
}
