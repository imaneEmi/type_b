/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
$(window).on('scroll',function () {
    if ($(this).scrollTop() > 100) {
        $('.back-to-top').fadeIn('slow');
    } else {
        $('.back-to-top').fadeOut('slow');
    }
});
$('.back-to-top').on('click',function () {
    $('html, body').animate({
        scrollTop: 0
    }, 1500);
    return false;
});
function total() {
    var total = 0;
    var max = $(".totalmontant").attr("max");
    $(".montantOk").each(function () {
        if (!isNaN(parseFloat($(this).val()))) {
            total += parseFloat($(this).val());
            if (total > max) {
                console.log('Total > max')
                $("#errorBudget").css('visibility', 'visible');
                $("#editMontant").prop("disabled",true);
            }else{
                $("#editMontant").prop("disabled",false);
                $("#errorBudget").css('visibility', 'hidden');
            }
        }
    });
    $(".totalmontant").val(total);
}
$(".montantOk").on("input", total());

$(".nbrOk").on("input", function () {
    var montant = 0;
    var forfait = 0;
    if (!isNaN(parseFloat($(this).val()))) {
        forfait = parseFloat($(this).parents("tr").find('input[name="forfait"]').val());
        montant = parseFloat($(this).val() * forfait);
        $(this).parents("tr").find('input.montantOk').val(montant).trigger('change', total());
    }
});
