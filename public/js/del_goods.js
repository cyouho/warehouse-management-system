$(document).ready(function () {
    var token = $('meta[name="csrf-token"]').attr('content');

    $("#search-goods-result").on("click", ".del-goods-for-search", function () {
        goodsId = $(this).attr("goods-id");
        table = $(this).attr("table");
        $(this).closest("tr").remove();

        delGoods(goodsId, table);
    });

    function delGoods(goodsId, table) {
        $.ajax({
            url: "/delGoodsAjax",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'goods_id': goodsId,
                'table': table,
            },
            success: function (data) {

            },
        });
    }
});