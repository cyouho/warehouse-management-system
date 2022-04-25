$(document).ready(function () {
    var token = $('meta[name="csrf-token"]').attr('content');

    $("#purchaseDate").datepicker({
        language: "zh-CN",
        autoclose: true,
        clearBtn: true,
        todayBtn: "linked",
        todayHighlight: true,
    });

    $("#expiryDate").datepicker({
        language: "zh-CN",
        autoclose: true,
        clearBtn: true,
        todayBtn: "linked",
        todayHighlight: true,
    });

    $("#goodsCategory").change(function () {
        goodsCategory = $("#goodsCategory option:selected").val();

        $("#goodsName").load('/getGoodsAjax', { 'category': goodsCategory, '_token': token });
    });

    $("#dockSubmit").click(function () {
        goodsCategory = $("#goodsCategory option:selected").val();
        expiryLevel = $("#expiryLevel option:selected").attr("value");
        goodsName = $("#goodsName option:selected").val();
        subName = $("#subName").val();
        amount = $("#amount").val();
        unit = $("#unit").val();
        shelves = $("#shelves option:selected").val();
        numberOfPlies = $("#numberOfPlies option:selected").val();
        purchaseDate = $("#purchaseDate").val();
        expiryDate = $("#expiryDate").val();
        isMonitoring = $("input[type='radio']:checked").val();

        $.ajax({
            url: "/setGoodsAjax",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                "goods_category": goodsCategory,
                "expiry_level": expiryLevel,
                "goods_name": goodsName,
                "sub_name": subName,
                "amount": amount,
                "unit": unit,
                "shelves": shelves,
                "number_of_plies": numberOfPlies,
                "purchase_date": purchaseDate,
                "expiry_date": expiryDate,
                "is_monitoring": isMonitoring,
            },
            success: function (data) {
                if (data) {
                    alert('添加物品成功！');
                } else {
                    alert('添加物品失败！');
                }
            },
        });
    });
});