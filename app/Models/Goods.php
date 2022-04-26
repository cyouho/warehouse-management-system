<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Goods extends Model
{
    use HasFactory;

    const PRINCIPAL_FOOD_TABLE = 'principal_food';
    const SUBSIDIARY_FOOD_TABLE = 'subsidiary_food';
    const DRINK_TABLE = 'drink';
    const MEDICINE_TABLE = 'medicines';

    public function getNearExpiredAndExpiredGoods(
        array $columnName = ['*'],
        array $conditions = [],
        array $conditionsForOr = []
    ) {
        return $this->selectGoods($columnName, $conditions, $conditionsForOr);
    }

    public function getSearchGoods(
        array $columnName = ['*'],
        array $conditions = [],
        array $conditionsForOr = []
    ) {
        return $this->selectGoods($columnName, $conditions, $conditionsForOr);
    }

    public function getMonitoringGoods(
        array $columnName = ['*'],
        array $conditions = [],
        array $conditionsForOr = []
    ) {
        return $this->selectGoods($columnName, $conditions, $conditionsForOr);
    }

    public function setGoods(string $goodsCategory, array $setData = [])
    {
        return $this->insertGoods($goodsCategory, $setData);
    }

    private function selectGoods(
        array $columnName = ['*'],
        array $conditions = [],
        array $conditionsForOr = []
    ) {
        $principalResult = DB::table(self::PRINCIPAL_FOOD_TABLE)
            ->select($columnName)
            ->where($conditions)
            ->orWhere($conditionsForOr)
            ->get();

        $subsidiaryResult = DB::table(self::SUBSIDIARY_FOOD_TABLE)
            ->select($columnName)
            ->where($conditions)
            ->orWhere($conditionsForOr)
            ->get();

        $drinkResult = DB::table(self::DRINK_TABLE)
            ->select($columnName)
            ->where($conditions)
            ->orWhere($conditionsForOr)
            ->get();

        $medicineResult = DB::table(self::MEDICINE_TABLE)
            ->select($columnName)
            ->where($conditions)
            ->orWhere($conditionsForOr)
            ->get();

        return array_merge(
            json_decode($principalResult, TRUE),
            json_decode($subsidiaryResult, TRUE),
            json_decode($drinkResult, TRUE),
            json_decode($medicineResult, TRUE),
        );
    }

    private function insertGoods(string $goodsCategory, array $setData = [])
    {
        $result = DB::table($goodsCategory)
            ->insert($setData);

        return $result;
    }
}
