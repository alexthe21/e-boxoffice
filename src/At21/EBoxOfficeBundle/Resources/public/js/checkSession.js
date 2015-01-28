/**
 * Created by Alejandro Jurado on 18/01/15.
 */
$(document)
    .ready(function() {
        var seats = [];
        var totalAmount = 0;
        $('td')
            .hover(function(){
                $(this).addClass('active');
                $(this).css('cursor', 'pointer');
            },function(){
                $(this).removeClass('active');
                $(this).css('cursor', 'auto');
            })
            .click(function(){
                var seat = $(this).children().data();
                if(!$(this).hasClass('negative') && !$(this).hasClass('warning')) {
                    $(this).addClass('positive');
                    var indexOf = $.inArray(seat, seats);
                    if (indexOf > -1) {
                        seats.splice(indexOf, 1);
                        $(this).removeClass('positive');
                        $('#seat-list').children().filter(function (index, element) {
                            return $(this).data('id') == seat.id;
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

                    seats.forEach(function (element, index, array) {
                        totalAmount += element.price;
                    });
                    $('#amount').html('£ ' + totalAmount);
                }
            });
        $('#confirmAndPay').click(function(){
            var dataSet = {
                'seats': seats,
                'userId': $('#userId').val()
            };
            $.ajax({
                type: "post",
                data: dataSet,
                url: Routing.generate('at21_eboxoffice_seat_confirm&pay'),
                crossDomain: true,
                async: true,
                beforeSend: function(){
                    $('#confirmAndPay').addClass('ui loading button');
                },
                success: function(data) {
                   $('#confirmAndPay')
                       .html('<i class="checkmark icon"></i>' + data)
                       .removeClass('ui loading button')
                       .addClass('ui green button');

                    seats = [];
                    totalAmount = 0;
                    refreshSession();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $(this).html('Error! ' + textStatus + ' ' + errorThrown);
                }
            });
        });
        setInterval(refreshSession, 30000);
    })
;

var refreshSession = function(){
    var id = $('#sessionId').val();
    var userId = $('#userId').val();
    $.ajax({
        type: "get",
        dataType: "json",
        url: Routing.generate('at21_eboxoffice_session_refresh', {'id': id}),
        crossDomain: true,
        async: true,
        beforeSend: function(){
            $(this).html('<div class="ui loader"></div>');
        },
        success: function(data) {
            data.seats.forEach(function(element, index, array){
                if(element.is_busy == true ){
                    if(element.user.id != userId){
                        $('div[data-id="' + element.id + '"]')
                            .children('img')
                            .attr('src', '/bundles/at21eboxoffice/images/busy-seat.png')
                            .attr('alt', 'This seat is yours');;
                    } else {
                        $('div[data-id="' + element.id + '"]')
                            .children('img')
                            .attr('src', '/bundles/at21eboxoffice/images/your-seat.png')
                            .attr('alt', 'This seat is busy');;
                    }
                } else {
                    $('div[data-id="' + element.id + '"]')
                        .children('img')
                        .attr('src', '/bundles/at21eboxoffice/images/seat.png')
                        .attr('alt', 'This seat is available');
                }
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $(this).html('Error! ' + textStatus + ' ' + errorThrown);
        }
    });
}