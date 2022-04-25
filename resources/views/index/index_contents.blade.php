<main class="container">
    <div class="jumbotron p-4 p-md-5 text-green rounded bg-green">
        <div>
            <a class="link-title" data-toggle="collapse" href="#collapseOne">
                在库监控物品一览:
            </a>
        </div>
        <div id="collapseOne" class="collapse">
            <br>
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
                        </tr>
                    </thead>
                    <tbody>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="jumbotron p-4 p-md-5 text-green rounded bg-green">
        <div>
            <a class="link-title" data-toggle="collapse" href="#expiryAndexpiredGoods">
                临过期:
            </a>
        </div>
        <div id="expiryAndexpiredGoods" class="collapse">
            <br>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indexData['near_expired_and_expired_goods'] as $value)
                        @if(!empty($value) && $value['expiry_day'] < $indexData['expiry_level_days'][$value['expiry_level']]) <tr>
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
                                    </tr>
                                    @endif
                                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="jumbotron p-4 p-md-5 text-green rounded bg-green">
        <div>
            <a class="link-title" data-toggle="collapse" href="#setDock">
                入库:
            </a>
        </div>
        <div id="setDock" class="collapse">
            <br>
            <div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="goodsCategory">物品类别:</label>
                                    <select class="form-control" id="goodsCategory">
                                        <option id="principal_food" value="principal_food">主食</option>
                                        <option id="subsidiary_food" value="subsidiary_food">副食</option>
                                        <option id="drink" value="drink">饮料</option>
                                        <option id="medicines" value="medicines">药品</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="expiryLevel">临期等级:</label>
                                    <select class="form-control" id="expiryLevel">
                                        <option id="lv1" value="1">1年 ~</option>
                                        <option id="lv2" value="2">6个月 ~ 1年</option>
                                        <option id="lv3" value="3">90天 ~ 6个月</option>
                                        <option id="lv4" value="4">30天 ~ 90天</option>
                                        <option id="lv5" value="5">16天 ~ 30天</option>
                                        <option id="lv6" value="6">~ 15天</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="goodsName">物品名:</label>
                            <select class="form-control" id="goodsName">
                                @foreach ($indexData['goods_data'] as $value)
                                <option>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subName">备注名:</label>
                            <input type="text" class="form-control" id="subName">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="amount">数量:</label>
                                    <input type="text" class="form-control" id="amount">
                                </div>
                                <div class="col">
                                    <label for="unit">单位:</label>
                                    <input type="text" class="form-control" id="unit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="shelves">货架号:</label>
                            <select class="form-control" id="shelves">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="numberOfPlies">货架层:</label>
                            <select class="form-control" id="numberOfPlies">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="purchase-date">购买日:</label>
                            <input type="text" class="form-control" id="purchaseDate" name="purchaseDate" placeholder="购买日" onkeydown="return false">
                        </div>
                        <div class="form-group">
                            <label for="expiry-date">到期日:</label>
                            <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="到期日" onkeydown="return false">
                        </div>
                    </div>
                </div>
                <label>是否加入在库监控:</label>&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="optradio" value="1">是</label>&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="optradio" value="0">否</label>
                <div class="dropdown-divider"></div><br>
                <button type="submit" class="btn btn-green" id="dockSubmit">入库提交</button>
            </div>
        </div>
    </div>
    <div class="jumbotron p-4 p-md-5 text-green rounded bg-green">
        <div>
            <a class="link-title" data-toggle="collapse" href="#search">
                检索物品:
            </a>
        </div>
        <div id="search" class="collapse">
            <br>
            <div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="search-input" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-green" type="submit" id="search-goods">检索</button>
                    </div>
                </div>
                <div id="search-goods-result">

                </div>
            </div>
        </div>
    </div>
</main>