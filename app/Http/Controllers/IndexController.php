<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goods;
use Illuminate\Support\Facades\DB;

/**
 * Index Controller Class.
 * 主页控制器类
 */
class IndexController extends Controller
{
    /**
     * Goods category keys.
     * 物品key
     */
    private $_goods_category_keys = [];

    /**
     * expiry date level.
     * 临过期等级
     */
    private $_expiry_level = [];

    public function __construct()
    {
        $this->_goods_category_keys = array_keys(config('goodscategorys.goods_category'));
        $this->_expiry_level = config('goodscategorys.expiry_level');
    }

    public function index(Request $request)
    {
        $middlewareData = $request->input();
        $viewData = $this->getIndexData($middlewareData['user_id']); // 获取 临期，过期 物品。
        $goodsData = $this->getDockGoodsData(); // 获取入库时显示的物品内容。
        $monitoringData = $this->getMonitoringGoodsData($middlewareData['user_id']); // 首页监控在库

        return view('index.index_layer', [
            'indexData' => [
                'near_expired_and_expired_goods' => $viewData,
                'goods_data' => $goodsData,
                'expiry_level_days' => $this->_expiry_level,
                'monitoring_goods' => $monitoringData,
            ]
        ]);
    }

    public function searchGoodsAjax(Request $request)
    {
        $postData = $request->post();

        if ($postData['q'] === '') return FALSE;

        $columnName = [
            'id',
            'monitoring',
            'expiry_level',
            'offical_name',
            'sub_name',
            'amount',
            'unit',
            'shelves', // 货架号
            'number_of_plies', // 货架层数
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
            'monitoring' => isset($postData['is_monitoring']) ? $postData['is_monitoring'] : 0, // 是否加入在库监控
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

    public function delGoodsAjax(Request $request)
    {
        $postData = $request->post();
        $delData = [
            ['id', $postData['goods_id']],
        ];
        $tableName = $postData['table'];

        $goods = new Goods();
        $goods->delGoods($tableName, $delData);
    }

    public function monitoringGoodsAjax(Request $request)
    {
        $postData = $request->post();

        $updateData = [
            'monitoring' => DB::raw('IF(monitoring = 1, 0, 1)'),
        ];
        $conditions = [
            ['id', $postData['goods_id']],
        ];

        $goods = new Goods();
        $result = $goods->setMonitoringGoods($postData['table_name'], $updateData, $conditions);

        return response()->json($result);
    }

    public function checkoutGoodsAjax(Request $request)
    {
        $postData = $request->post();

        if ($postData['goods_amount'] < 0) {
            return FALSE;
        }

        $tableName = $postData['table'];
        $conditions = [
            ['id', $postData['goods_id']],
        ];
        $updateData = [
            'amount' => $postData['goods_amount'],
        ];

        $goods = new Goods();
        $result = $goods->checkoutGoods($tableName, $updateData, $conditions);

        return response()->json($result);
    }

    private function getIndexData($userId)
    {
        $columnName = [
            'id',
            'monitoring',
            'expiry_level',
            'offical_name', // 物品名
            'sub_name', // 物品自定义名
            'amount', // 数量
            'unit', // 单位
            'shelves', // 货架号
            'number_of_plies', // 货架层数
            DB::raw('DATE_FORMAT(purchase_date, "%Y-%m-%d") as purchase_date'), // 购入日期
            DB::raw('DATE_FORMAT(expiry_date, "%Y-%m-%d") as expiry_date'), // 过期日期
            DB::raw('datediff(date_format(expiry_date, "%Y-%m-%d"), date_format(now(), "%Y-%m-%d")) as expiry_day')
        ];

        $conditions = [
            ['user_id', $userId],
        ];

        $goods = new Goods();
        $nearExpiredAndExpiredResult = $goods->getNearExpiredAndExpiredGoods($columnName, $conditions);

        return  $nearExpiredAndExpiredResult; // 临过期物品
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

    private function getMonitoringGoodsData($userId)
    {
        $columnName = [
            'id',
            'monitoring',
            'expiry_level',
            'offical_name', // 物品名
            'sub_name', // 物品自定义名
            'amount', // 数量
            'unit', // 单位
            'shelves', // 货架号
            'number_of_plies', // 货架层数
            DB::raw('DATE_FORMAT(purchase_date, "%Y-%m-%d") as purchase_date'), // 购入日期
            DB::raw('DATE_FORMAT(expiry_date, "%Y-%m-%d") as expiry_date'), // 过期日期
            DB::raw('datediff(date_format(expiry_date, "%Y-%m-%d"), date_format(now(), "%Y-%m-%d")) as expiry_day')
        ];

        $conditions = [
            ['user_id', $userId],
            ['monitoring', 1],
        ];

        $goods = new Goods();
        $monitoringGoods = $goods->getMonitoringGoods($columnName, $conditions);

        return $monitoringGoods;
    }
}
