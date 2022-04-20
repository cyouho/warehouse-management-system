<table class="table tabel-green">
    <thead>
        <tr>
            <th>物品名</th>
            <th>备注名</th>
            <th>数量</th>
            <th>单位</th>
            <th>购入日期</th>
            <th>保质期限</th>
            <th>过期天数/天</th>
        </tr>
    </thead>
    <tbody>
        @foreach($search_goods_result as $value)
        @if(!empty($value))
        <tr>
            <td>{{ isset($value['offical_name']) ? $value['offical_name'] : NULL}}</td>
            <td>{{ isset($value['sub_name']) ? $value['sub_name'] : NULL}}</td>
            <td>{{ isset($value['amount']) ? $value['amount'] : NULL}}</td>
            <td>{{ isset($value['unit']) ? $value['unit'] : NULL}}</td>
            <td>{{ isset($value['purchase_date']) ? $value['purchase_date'] : NULL}}</td>
            <td>{{ isset($value['expiry_date']) ? $value['expiry_date'] : NULL}}</td>
            <td>0</td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>