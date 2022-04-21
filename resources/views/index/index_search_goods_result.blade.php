<table class="table tabel-green">
    <thead>
        <tr>
            <th>物品名</th>
            <th>备注名</th>
            <th>数量</th>
            <th>单位</th>
            <th>购入日期</th>
            <th>保质期限</th>
            <th>临期天数/天</th>
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
            <td>{{ isset($value['purchase_date']) ? $value['purchase_date'] : NULL}}</td>
            <td>{{ isset($value['expiry_date']) ? $value['expiry_date'] : NULL}}</td>
            @if ($value['expiry_day'] > 0)
            <td>{{ $value['expiry_day'] < $search_goods_result['expiry_level_days'][$value['expiry_level']] ? $value['expiry_day'] : NULL}}</td>
            @else
            <td>{{ $value['expiry_day'] }} ( 过期 )</td>
            @endif
        </tr>
        @endif
        @endforeach
    </tbody>
</table>