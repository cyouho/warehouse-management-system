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
            <td>
                <button dash-id="search-{{ $value['table_name'] }}-{{ $value['id'] }}" class="btn btn-outline-light custom-inline search-dash" default-value="{{ $value['amount'] }}"><i class="bi-dash-circle"></i></button>
                <input type="text" id="search-{{ $value['table_name'] }}-{{ $value['id'] }}" class="form-control custom-form-control custom-inline" onkeydown="return false" data-max="{{ $value['amount'] }}" data-min="0" value="{{ $value['amount'] }}"></input>
                <button plus-id="search-{{ $value['table_name'] }}-{{ $value['id'] }}" class="btn btn-outline-light custom-inline search-plus"><i class="bi-plus-circle"></i></button>
            </td>
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
                        <button type="button" id="checkOutGoodsForExpiry" class="btn btn-green checkout-goods-for-search" checkout-table-id-for-search="{{ $value['table_name'] }}" checkout-id-for-search="{{ $value['id'] }}" data-toggle="tooltip-checkout" title="出库"><i class="bi-bag-dash"></i></button>&nbsp;&nbsp;
                        <button type="button" id="deleteGoodsForExpiry" class="btn btn-green del-goods-for-expiry" goods-id-for-expiry="{{ $value['id'] }}" table-for-expiry="{{ $value['table_name'] }}" data-toggle="tooltip-delete" title="删除"><i class="bi-x-lg"></i></button>&nbsp;&nbsp;
                        @if (!$value['monitoring'])
                        <button type="button" id="addMonitoringForExpiry" class="btn btn-green monitoring-goods" monitoring-table-id="{{ $value['table_name'] }}" monitorin-id="{{ $value['id'] }}" data-toggle="tooltip-monitoring" title="加入监控"><i class="bi-bell"></i></button>
                        @else
                        <button type="button" id="addMonitoringForExpiry" class="btn btn-green monitoring-goods" monitoring-table-id="{{ $value['table_name'] }}" monitorin-id="{{ $value['id'] }}" data-toggle="tooltip-monitoring" title="移除监控"><i class="bi-bell-slash"></i></button>
                        @endif
                    </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>