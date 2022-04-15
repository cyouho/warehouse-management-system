$(document).ready(function () {
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
});