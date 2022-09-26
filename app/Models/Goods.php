<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Goods Model
 * 物品用模型
 */
class Goods extends Model
{
    use HasFactory;

    /**
     * principal_food Table Name.
     * 主食品数据库表名
     */
    const PRINCIPAL_FOOD_TABLE = 'principal_food';

    /**
     * subsidiary_food Table Name.
     * 副食品数据库列表
     */
    const SUBSIDIARY_FOOD_TABLE = 'subsidiary_food';

    /**
     * drink Table Name.
     * 饮品数据库表名
     */
    const DRINK_TABLE = 'drink';

    /**
     * medicin Table Name.
     * 药品数据库表名
     */
    const MEDICINE_TABLE = 'medicines';

    /**
     * daily_chemical_products Table Name.
     * 日用(化)品数据库表名
     */
    const DAILY_CHEMICAL_PRODUCTS = 'daily_chemical_products';

    /**
     * Get Near Expired And Expired Goods.
     * 获取临期和过期物品清单
     * 
     * @param array $columnName <DB column name | 数据库字段名>
     * @param array $conditions <DB where conditions | 数据库 where 检索约束条件>
     * @param array $conditonsForOr <DB where condtions if exists or | 如果存在 or 检索约束时>
     * 
     * @return mix function
     */
    public function getNearExpiredAndExpiredGoods(
        array $columnName = ['*'],
        array $conditions = [],
        array $conditionsForOr = []
    ) {
        return $this->selectGoods($columnName, $conditions, $conditionsForOr);
    }

    /**
     * Get Search Goods.
     * 获取检索物品结果
     * 
     * @param array $columnName <DB column name | 数据库字段名>
     * @param array $conditions <DB where conditions | 数据库 where 检索约束条件>
     * @param array $conditonsForOr <DB where condtions if exists or | 如果存在 or 检索约束时>
     * 
     * @return mix function
     */
    public function getSearchGoods(
        array $columnName = ['*'],
        array $conditions = [],
        array $conditionsForOr = []
    ) {
        return $this->selectGoods($columnName, $conditions, $conditionsForOr);
    }

    /**
     * Get Monitoring Goods.
     * 获取监控中的物品
     * @param array $columnName <DB column name | 数据库字段名>
     * @param array $conditions <DB where conditions | 数据库 where 检索约束条件>
     * @param array $conditonsForOr <DB where condtions if exists or | 如果存在 or 检索约束时>
     * 
     * @return mix function
     */
    public function getMonitoringGoods(
        array $columnName = ['*'],
        array $conditions = [],
        array $conditionsForOr = []
    ) {
        return $this->selectGoods($columnName, $conditions, $conditionsForOr);
    }

    /**
     * Get Goods.
     * 设置物品
     * 
     * @param string $goodsCategory <goods category | 物品类别>
     * @param array $setData <set data | 设置数据>
     * 
     * @return mix function
     */
    public function setGoods(string $goodsCategory, array $setData = [])
    {
        return $this->insertGoods($goodsCategory, $setData);
    }

    public function setMonitoringGoods(
        string $tableName,
        array $updateData = [],
        array $conditions = []
    ) {
        return $this->updateGoods($tableName, $updateData, $conditions);
    }

    public function delGoods(string $tableName, array $conditions = [])
    {
        $this->deleteGoods($tableName, $conditions);
    }

    public function checkoutGoods(
        string $tableName,
        array $updateData = [],
        array $conditions = []
    ) {
        return $this->updateGoods($tableName, $updateData, $conditions);
    }

    private function selectGoods(
        array $columnName = ['*'],
        array $conditions = [],
        array $conditionsForOr = []
    ) {
        $principalResult = DB::table(self::PRINCIPAL_FOOD_TABLE)
            ->select(array_merge($columnName, [DB::raw("'" . self::PRINCIPAL_FOOD_TABLE . "'" . 'as table_name')]))
            ->where($conditions)
            ->orWhere($conditionsForOr)
            ->get();

        $subsidiaryResult = DB::table(self::SUBSIDIARY_FOOD_TABLE)
            ->select(array_merge($columnName, [DB::raw("'" . self::SUBSIDIARY_FOOD_TABLE . "'" . 'as table_name')]))
            ->where($conditions)
            ->orWhere($conditionsForOr)
            ->get();

        $drinkResult = DB::table(self::DRINK_TABLE)
            ->select(array_merge($columnName, [DB::raw("'" . self::DRINK_TABLE . "'" . 'as table_name')]))
            ->where($conditions)
            ->orWhere($conditionsForOr)
            ->get();

        $medicineResult = DB::table(self::MEDICINE_TABLE)
            ->select(array_merge($columnName, [DB::raw("'" . self::MEDICINE_TABLE . "'" . 'as table_name')]))
            ->where($conditions)
            ->orWhere($conditionsForOr)
            ->get();

        $dailyChemicalProductsResult = DB::table(self::DAILY_CHEMICAL_PRODUCTS)
            ->select(array_merge($columnName, [DB::raw("'" . self::DAILY_CHEMICAL_PRODUCTS . "'" . 'as table_name')]))
            ->where($conditions)
            ->orWhere($conditionsForOr)
            ->get();

        return array_merge(
            json_decode($principalResult, TRUE),
            json_decode($subsidiaryResult, TRUE),
            json_decode($drinkResult, TRUE),
            json_decode($medicineResult, TRUE),
            json_decode($dailyChemicalProductsResult, TRUE),
        );
    }

    private function insertGoods(string $goodsCategory, array $setData = [])
    {
        $result = DB::table($goodsCategory)
            ->insert($setData);

        return $result;
    }

    private function deleteGoods(string $tableName, array $conditions = [])
    {
        DB::table($tableName)
            ->where($conditions)
            ->delete();
    }

    private function updateGoods(
        string $tableName,
        array $updateData = [],
        array $conditions = []
    ) {
        $affected = DB::table($tableName)
            ->where($conditions)
            ->update($updateData);

        return $affected;
    }
}
