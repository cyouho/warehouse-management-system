<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $middlewareData = $request->input();
        $viewData = $this->getIndexData($middlewareData['user_id']); // 获取 临期，过期 物品。
        $goodsData = $this->getDockGoodsData(); // 获取入库时的物品内容。

        return view('index.index_layer', [
            'indexData' => [
                $viewData,
                'goods_data' => $goodsData,
            ]
        ]);
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
            ['offical_name', 'like', '%' . $postData['q'] . '%'],
        ];

        $goods = new Goods();
        $viewData = $goods->getSearchGoods($columnName, $conditions, $condistionsForOr);

        return view('index.index_search_goods_result', ['search_goods_result' => $viewData]);
    }

    public function getGoodsAjax(Request $request)
    {
        $postData = $request->post();
        $category = $postData['category'];

        $goods = $this->getDockGoodsData($category);

        return view('index.index_subsidiary_food', [
            'indexData' => [
                'goods_data' => $goods,
            ]
        ]);
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
            'near_expired_goods' => $nearExpiredResult, // 临期物品
            'expired_goods' => $expiredResult, // 过期物品
        ];
    }

    private function getDockGoodsData(string $category = 'principal_food')
    {
        $dockGoodsData = config('goodscategorys.goods');

        if (!in_array($category, array_keys($dockGoodsData))) {
            $category = 'principal_food';
        }

        $dockGoods = $dockGoodsData[$category];

        return $dockGoods;
    }
}
