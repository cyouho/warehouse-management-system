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
    const DRINK_TABLE = 'drink_food';

    public function getNearExpiredFoods(array $columnName = ['*'], array $conditions = [])
    {
        $principal = DB::table(self::PRINCIPAL_FOOD_TABLE)
            ->select($columnName)
            ->where($conditions);

        $result = DB::table(self::SUBSIDIARY_FOOD_TABLE)
            ->select($columnName)
            ->where($conditions)
            ->union($principal)
            ->get();

        return $result;
    }
}
