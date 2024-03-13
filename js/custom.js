/* global $, alert, console */

$(function () {
    'use strict';
    $('.username').blur(function () {
        if ($(this).val().length < 4) {
            $(this).css('border', '1px solid $F00')
            $(this).parent().find('.custom-alert').fadeIn(200);
        } else {
            $(this).css('border', '1px solid #080');
            $(this).parent().find('.custom-alert').fadeOut(200);
        }
    });
})