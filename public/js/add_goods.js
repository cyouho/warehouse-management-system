$(document).ready(function () {
    var token = $('meta[name="csrf-token"]').attr('content');

    $("#purchase-date").datepicker({
        language: "zh-CN",
        autoclose: true,
        clearBtn: true,
        todayBtn: "linked",
        todayHighlight: true,
    });

    $("#expiry-date").datepicker({
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
});