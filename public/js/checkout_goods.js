$(document).ready(function () {
    $(".checkout-dash").click(function () {
        defaultAmount = $(this).attr("default-value");
        console.log(defaultAmount);
        //$(this).val();
    });
});