/**
 * Created by Alejandro Jurado on 18/01/15.
 */
$(document)
    .ready(function() {

        //Custom
        $('td').hover(function(){
            $(this).toggleClass('active');
            $(this).css('cursor', 'pointer');
        },function(){
            $(this).toggleClass('active');
            $(this).css('cursor', 'auto');
        });

    })
;