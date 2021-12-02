/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";
$(document).ready(function(){
    $(".montantOk").on("input",function() {
        var total=0;
        $(".montantOk").each(function(){
            if(!isNaN(parseInt($(this).val())))
            {
              total+=parseInt($(this).val());
            }
        });
        $(".totalmontant").val(total);
      });
  })
