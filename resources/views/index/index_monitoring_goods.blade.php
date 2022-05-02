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
                <td>
                    <button dash-id="monitoring-{{ $value['table_name'] }}-{{ $value['id'] }}" class="btn btn-outline-light custom-inline checkout-dash" default-value="{{ $value['amount'] }}"><i class="bi-dash-circle"></i></button>
                    <input type="text" id="monitoring-{{ $value['table_name'] }}-{{ $value['id'] }}" class="form-control custom-form-control custom-inline" onkeydown="return false" data-max="{{ $value['amount'] }}" data-min="0" value="{{ $value['amount'] }}"></input>
                    <button plus-id="monitoring-{{ $value['table_name'] }}-{{ $value['id'] }}" class="btn btn-outline-light custom-inline checkout-plus"><i class="bi-plus-circle"></i></button>
                </td>
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
                            <button type="button" id="checkOutGoodsForExpiry" class="btn btn-green checkout-goods" button-name="monitoring" checkout-table-id="{{ $value['table_name'] }}" checkout-id="{{ $value['id'] }}" data-toggle="tooltip-checkout" title="出库"><i class="bi-bag-dash"></i></button>&nbsp;&nbsp;
                            <button type="button" id="deleteGoodsForExpiry" class="btn btn-green del-goods-for-monitoring" goods-id-for-monitoring="{{ $value['id'] }}" table-for-monitoring="{{ $value['table_name'] }}" data-toggle="tooltip-delete" title="删除"><i class="bi-x-lg"></i></button>&nbsp;&nbsp;
                            <button type="button" id="addMonitoringForExpiry" class="btn btn-green" data-toggle="tooltip-monitoring" title="加入监控"><i class="bi-bell"></i></button>
                        </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>