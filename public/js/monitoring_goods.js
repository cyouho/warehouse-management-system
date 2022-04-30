$(document).ready(function () {
    $('[data-toggle="tooltip-monitoring"]').tooltip();

    $("#monitoringSubmit").click(function () {

    });

    function monitoringGoods(arr) {
        $.ajax({
            url: '/monitoringGoodsAjax',
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'goods_id': arr,
            },
            success: function (data) {

            },
        });
    }
});