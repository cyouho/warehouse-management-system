<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    private $_goods_category_keys = [];

    public function __construct()
    {
        $this->_goods_category_keys = array_keys(config('goodscategorys.goods_category'));
    }

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
            'expiry_level',
            'offical_name',
            'sub_name',
            'amount',
            'unit',
            DB::raw('DATE_FORMAT(purchase_date, "%Y-%m-%d") as purchase_date'), // 'purchase_date'
            DB::raw('DATE_FORMAT(expiry_date, "%Y-%m-%d") as expiry_date'), // 'expiry_date'
            DB::raw('datediff(date_format(expiry_date, "%Y-%m-%d"), date_format(now(), "%Y-%m-%d")) as expiry_day'), // 'expiry_day'
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

        return view('index.index_search_goods_result', [
            'search_goods_result' => [
                'viewData' => $viewData,
                'expiry_level_days' => config('goodscategorys.expiry_level'),
            ]
        ]);
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

    public function setGoodsAjax(Request $request)
    {
        $postData = $request->post();
        $userId = $request->input('user_id');
        $goodsCategory = $request->input('goods_category');

        if (!in_array($goodsCategory, $this->_goods_category_keys)) {
            return FALSE;
        }

        // 生成临期当天日期
        $expiredLevelForDate = config('goodscategorys.expiry_level'); // 不同临期等级对应天数
        $expiredDate = date(
            'Y-m-d',
            strtotime(
                $postData['expiry_date'] . '-' . $expiredLevelForDate[$postData['expiry_level']] . 'day'
            )
        );

        $setData = [
            'user_id' => $userId,
            'expiry_level' => $postData['expiry_level'], // 临期等级
            'offical_name' => $postData['goods_name'],
            'sub_name' => $postData['sub_name'],
            'amount' => $postData['amount'], // 数量
            'unit' => $postData['unit'],
            'shelves' => $postData['shelves'],
            'number_of_plies' => $postData['number_of_plies'],
            'purchase_date' => $postData['purchase_date'],
            'expired_date' => $expiredDate,
            'expiry_date' => $postData['expiry_date'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $goods = new Goods();
        $result = $goods->setGoods($goodsCategory, $setData);

        return response()->json($result);
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
