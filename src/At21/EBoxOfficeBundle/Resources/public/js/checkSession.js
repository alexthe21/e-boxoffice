/**
 * Created by Alejandro Jurado on 18/01/15.
 */
var seats = []
$(document)
    .ready(function() {
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
                var seatObj = $(this).children();
                if(!seatObj.attr('data-user')) {
                    var indexOf = $.inArray(seat, seats);
                    if (indexOf > -1) {
                        seats.splice(indexOf, 1);
                        removeSeatFromSelectedSeatsList(seat);
                        seatObj.children('img').attr('src', '/bundles/at21eboxoffice/images/seat.png');
                        seatObj.removeClass('selected');
                    } else {
                        seatObj.addClass('selected');
                        seatObj.children('img').attr('src', '/bundles/at21eboxoffice/images/selected-seat.png');
                        seats.push(seat);
                        $('#seat-list').append('<div class="item" data-id="' +
                        seat.id +
                        '" data-row="' +
                        seat.row +
                        '" data-column="' +
                        seat.column +
                        '"><div>R: ' +
                        seat.row +
                        '</div><div>C: ' +
                        seat.column +
                        '</div></div>');
                    }
                    recalculateAmount();
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
                    //refreshSession();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $(this).html('Error! ' + textStatus + ' ' + errorThrown);
                }
            });
        });
        //setInterval(refreshSession, 30000);
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
            renderSeats(data.seats);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $(this).html('Error! ' + textStatus + ' ' + errorThrown);
        }
    });
}

var renderSeats = function(seats){
    var userId = $('#userId').val()
    seats.forEach(function(seat, index, array){
        if(seat.is_busy == true){
            $('div[data-id="' + seat.id + '"]').data('is_busy', true);
            removeSeatFromSelectedSeatsList(seat);
            if(seat.user.id != parseInt(userId)){
                $('div[data-id="' + seat.id + '"]')
                    .children('img')
                    .attr('src', '/bundles/at21eboxoffice/images/busy-seat.png')
                    .attr('alt', 'This seat is busy');
            } else {
                $('div[data-id="' + seat.id + '"]')
                    .children('img')
                    .attr('src', '/bundles/at21eboxoffice/images/your-seat.png')
                    .attr('alt', 'This seat is yours');
            }
        } else {
            $('div[data-id="' + seat.id + '"]:not([class="selected"])')
                .children('img')
                .attr('src', '/bundles/at21eboxoffice/images/seat.png')
                .attr('alt', 'This seat is available');
        }
    });
}

var removeSeatFromSelectedSeatsList = function(seat){
    $('#seat-list').children().filter(function (index, element) {
        return $(this).data('id') == seat.id;
    }).remove();
    recalculateAmount();
}

var recalculateAmount = function(){
    var totalAmount = 0;
    seats.forEach(function(element, index, array){
        totalAmount += parseFloat(element.price);
    })
    $('#amount').html('£ ' + totalAmount);
}