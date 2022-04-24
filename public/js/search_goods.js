$(document).ready(function () {
    var userId = $("#navbardroplogin").attr("user-id");
    var token = $('meta[name="csrf-token"]').attr('content');

    $("#search-goods").click(function () {
        q = $("#search-input").val();

        if (q != '') {
            $("#search-goods-result").load('/searchGoodsAjax', { 'user_id': userId, 'q': q, '_token': token });
        } else {
            $("#search-goods-result").html("");
        }
    });
});