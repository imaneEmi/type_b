/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

function total(){
    var total = 0;
    $(".montantOk").each(function () {
        if (!isNaN(parseFloat($(this).val()))) {
            total += parseFloat($(this).val());
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
        $(this).parents("tr").find('input.montantOk').val(montant).trigger('change',total());
    }
});
