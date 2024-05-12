$(function(){
    'use strict';
    $("select").selectBoxIt();

    $('[placeholder]').focus(function (){
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder','');


    }).blur(function (){
        $(this).attr('placeholder', $(this).attr('data-text'));

    });
    // Add Astrik on required inputs
    $('input').each(function (){
        if($(this).attr('required') === 'required'){
            $(this).after('<span class="asterisk" style= "position: absolute; font-size:30px; right: 30px; top: 8px; color: red"> * </span>');
        }
    });

    // convert password field to text field
    var passField = $('.password');

    $('.show-pass').hover(function(){

        passField.attr('type', 'text');

    }, function (){ // after i leave password will not be visible

        passField.attr('type', 'password');
    });

    // Confirm delete button
    $('.confirm').click(function(){

        return confirm ("Are You Sure ?");
        
    });
    // Category View Options
    $('.cat h3').click(function(){
        
        $this.next('.full-view').fadeToggle(200);
        
    });
    $('.option span').click(function(){
        
        $this.addClass('active').siblings('').removeClass('active');
        
    });
    

});