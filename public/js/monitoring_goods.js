$(document).ready(function () {
    $('[data-toggle="tooltip-monitoring"]').tooltip();

    $(".monitoring-goods").click(function () {
        tableName = $(this).attr("monitoring-table-id");
        goodsId = $(this).attr("monitorin-id");

        monitoringGoods(tableName, goodsId);
    });

    $("#search-goods-result").on("click", ".monitoring-goods", function () {
        tableName = $(this).attr("monitoring-table-id");
        goodsId = $(this).attr("monitorin-id");

        monitoringGoods(tableName, goodsId);
    });

    function monitoringGoods(tableName, goodsId) {
        $.ajax({
            url: '/monitoringGoodsAjax',
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'goods_id': goodsId,
                'table_name': tableName,
            },
            success: function (data) {
                if (data) {
                    alert("操作成功!");
                }
            },
        });
    }
});