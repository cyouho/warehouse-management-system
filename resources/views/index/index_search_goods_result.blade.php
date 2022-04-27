<table class="table tabel-green">
    <thead>
        <tr>
            <th>物品名</th>
            <th>备注名</th>
            <th>数量</th>
            <th>单位</th>
            <th>货架号</th>
            <th>购入日期</th>
            <th>保质期限</th>
            <th>临过期天数/天</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($search_goods_result['viewData'] as $value)
        @if(!empty($value))
        <tr>
            <td>{{ isset($value['offical_name']) ? $value['offical_name'] : NULL}}</td>
            <td>{{ isset($value['sub_name']) ? $value['sub_name'] : NULL}}</td>
            <td>{{ isset($value['amount']) ? $value['amount'] : NULL}}</td>
            <td>{{ isset($value['unit']) ? $value['unit'] : NULL}}</td>
            <td>{{ $value['shelves'] }} - {{ $value['number_of_plies'] }}</td>
            <td>{{ isset($value['purchase_date']) ? $value['purchase_date'] : NULL}}</td>
            <td>{{ isset($value['expiry_date']) ? $value['expiry_date'] : NULL}}</td>
            @if ($value['expiry_day'] > 0 && ($value['expiry_day'] < $search_goods_result['expiry_level_days'][$value['expiry_level']])) <td>{{ $value['expiry_day'] }}&nbsp;&nbsp;<span class="badge badge-warning">已临期</span></td>
                @elseif ($value['expiry_day'] <= 0) <td>{{ abs($value['expiry_day']) }}&nbsp;&nbsp;<span class="badge badge-danger">已过期</span></td>
                    @else
                    <td>{{ NULL }}</td>
                    @endif
                    <td>
                        <button type="button" id="checkOutGoodsForSearch" class="btn btn-warning btn-sm">出库</button>&nbsp;&nbsp;
                        <button type="button" id="deleteGoodsForSearch" class="btn btn-danger btn-sm del-goods-for-search" goods-id="{{ $value['id'] }}" table="{{ $value['table_name'] }}">删除</button>
                    </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>