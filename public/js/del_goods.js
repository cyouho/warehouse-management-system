$(document).ready(function () {
    $('[data-toggle="tooltip-checkout"]').tooltip();
    $('[data-toggle="tooltip-delete"]').tooltip();

    $(".del-goods-for-expiry").click(function () {
        goodsId = $(this).attr("goods-id-for-expiry");
        table = $(this).attr("table-for-expiry");
        $(this).closest("tr").remove();

        delGoods(goodsId, table);
    });

    $("#search-goods-result").on("click", ".del-goods-for-search", function () {
        goodsId = $(this).attr("goods-id-for-search");
        table = $(this).attr("table-for-search");
        $(this).closest("tr").remove();

        delGoods(goodsId, table);
    });

    $(".del-goods-for-monitoring").click(function () {
        goodsId = $(this).attr("goods-id-for-monitoring");
        table = $(this).attr("table-for-monitoring");
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