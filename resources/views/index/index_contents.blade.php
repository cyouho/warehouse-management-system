<main class="container">
    <div class="jumbotron p-4 p-md-5 text-green rounded bg-green">
        <h2>临期:</h2><br>
        <table class="table tabel-green">
            <thead>
                <tr>
                    <th>物品名</th>
                    <th>数量</th>
                    <th>购入日期</th>
                    <th>保质期限</th>
                    <th>临期期限/天</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>鸡蛋</td>
                    <td>30</td>
                    <td>2022-04-10</td>
                    <td>2022-04-20</td>
                    <td>5</td>
                </tr>
            </tbody>
        </table>
        <h2>过期:</h2><br>
        <table class="table tabel-green">
            <thead>
                <tr>
                    <th>物品名</th>
                    <th>数量</th>
                    <th>购入日期</th>
                    <th>保质期限</th>
                    <th>过期天数/天</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>西瓜</td>
                    <td>1</td>
                    <td>2022-02-10</td>
                    <td>2022-02-12</td>
                    <td>46</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="jumbotron p-4 p-md-5 text-green rounded bg-green">
        <h2>入库:</h2><br>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="sel1">物品名:</label>
                    <select class="form-control" id="sel1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="usr">备注名:</label>
                    <input type="text" class="form-control" id="usr">
                </div>
                <div class="form-group">
                    <label for="usr">数量:</label>
                    <input type="text" class="form-control" id="usr">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="sel1">物品类别:</label>
                    <select class="form-control" id="sel1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">货架号:</label>
                    <select class="form-control" id="sel1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sel1">购买日:</label>
                    <input type="text" class="form-control" id="purchase-date" name="purchaseDate" placeholder="购买日" onkeydown="return false">
                </div>
                <div class="form-group">
                    <label for="sel1">到期日:</label>
                    <input type="text" class="form-control" id="expiry-date" name="expiryDate" placeholder="到期日" onkeydown="return false">
                </div>
            </div>
        </div>
        <div class="dropdown-divider"></div><br>
        <button type="submit" class="btn btn-green">入库提交</button>
    </div>
    <div class="jumbotron p-4 p-md-5 text-green rounded bg-green">
        <h2>检索物品:</h2><br>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-append">
                <button class="btn btn-green" type="submit">检索</button>
            </div>
        </div>
    </div>
</main>