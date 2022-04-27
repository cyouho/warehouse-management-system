<div>
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
            @foreach ($indexData['monitoring_goods'] as $value)
            @if (!empty($value['offical_name']))
            <tr>
                <td>{{ $value['offical_name'] }}</td>
                <td>{{ $value['sub_name'] }}</td>
                <td>{{ $value['amount'] }}</td>
                <td>{{ $value['unit'] }}</td>
                <td>{{ $value['shelves'] }} - {{ $value['number_of_plies'] }}</td>
                <td>{{ $value['purchase_date'] }}</td>
                <td>{{ $value['expiry_date'] }}</td>
                @if ($value['expiry_day'] > 0 && ($value['expiry_day'] < $indexData['expiry_level_days'][$value['expiry_level']])) <td>{{ $value['expiry_day'] }}&nbsp;&nbsp;<span class="badge badge-warning">已临期</span></td>
                    @elseif ($value['expiry_day'] <= 0) <td>{{ abs($value['expiry_day']) }}&nbsp;&nbsp;<span class="badge badge-danger">已过期</span></td>
                        @else
                        <td>{{ NULL }}</td>
                        @endif
                        <td>
                            <button type="button" id="checkOutGoodsForMonitoring" class="btn btn-warning btn-sm">出库</button>&nbsp;&nbsp;
                            <button type="button" id="deleteGoodsForMonitoring" class="btn btn-danger btn-sm">删除</button>
                        </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>