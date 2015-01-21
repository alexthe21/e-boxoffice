/**
 * Created by Alejandro Jurado on 18/01/15.
 */
$(document)
    .ready(function() {
        var seats = [];
        $('td').hover(function(){
            $(this).addClass('active');
            $(this).css('cursor', 'pointer');
        },function(){
            $(this).removeClass('active');
            $(this).css('cursor', 'auto');
        });

        $('td').click(function(){
            $(this).addClass('positive');
            var seat = $(this).children().data();
            var indexOf = $.inArray(seat, seats);
            if(indexOf > -1){
                seats.splice(indexOf, 1);
                $(this).removeClass('positive');
                $('#seat-list').children().filter(function(index, element){
                    return $(this).data('row') == seat.row && $(this).data('column') == seat.column;
                }).remove();
            } else {
                seats.push(seat);
                $('#seat-list').append('<div class="item" data-row="' +
                seat.row +
                '" data-column="' +
                seat.column +
                '"><div>R: ' +
                seat.row +
                '</div><div>C: ' +
                seat.column +
                '</div></div>');
            }
            var totalAmount = 0;
            seats.forEach(function(element, index, array){
                totalAmount += element.price;
            });
            $('#amount').html('£ ' + totalAmount);
        });
        $('#confirmAndPay').click(function(){
            var data = {
                'seats': seats
            };
            $.ajax({
                type: "post",
                data: data,
                dataType: "html",
                url: Routing.generate('at21_eboxoffice_seat_confirm&pay'),
                crossDomain : true,
                async: true,
                beforeSend : function(){
                    $(this).html('<div class="ui loader"></div>');
                },
                success: function(data) {
                    $(this).html('Seats Confirmed');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $(this).html('Error! ' + textStatus + ' ' + errorThrown);
                }
            });
        });
    })
;