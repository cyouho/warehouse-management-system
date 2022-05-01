$(document).ready(function () {
    $(".checkout-dash").click(function () {
        inputId = $(this).attr("dash-id");
        defaultAmount = $("#" + inputId).val();

        if (defaultAmount > 0) {
            data = parseInt(defaultAmount) - 1;
            $("#" + inputId).val(data);
        }
    });

    $(".checkout-plus").click(function () {
        inputId = $(this).attr("plus-id");
        maxAmount = $("#" + inputId).attr("data-max");
        inputValue = $("#" + inputId).val();

        if (inputValue < maxAmount) {
            data = parseInt(inputValue) + 1;
            $("#" + inputId).val(data);
        }
    });

    $(".checkout-goods-for-expiry").click(function () {
        checkoutTable = $(this).attr("checkout-table-id-for-expiry");
        checkoutId = $(this).attr("checkout-id-for-expiry");
        amount = $("#" + checkoutTable + "-" + checkoutId).val();
        maxAmount = $("#" + checkoutTable + "-" + checkoutId).attr("data-max");

        if (amount == 0) {
            $(this).closest("tr").remove();
            delGoods(checkoutId, checkoutTable);
        } else if (amount != maxAmount) {
            checkoutGoods(checkoutId, checkoutTable, amount);
            $("#" + checkoutTable + "-" + checkoutId).attr("data-max", amount);
        }
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

    function checkoutGoods(goodsId, table, goodsAmount) {
        $.ajax({
            url: "/checkoutGoodsAjax",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'goods_id': goodsId,
                'table': table,
                'goods_amount': goodsAmount,
            },
            success: function (data) {
                if (data) {
                    alert("出库成功");
                }
            },
        });
    }
});