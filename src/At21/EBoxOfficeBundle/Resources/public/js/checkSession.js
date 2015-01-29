/**
 * Created by Alejandro Jurado on 18/01/15.
 */
var seats = [];
$(document)
    .ready(function() {
        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
            $('#confirmAndPay').click(function(){
                seats.forEach(function(element, index, array){
                    element.user = $('#userId').val();
                });
                var serializedSeats = JSON.stringify(seats);
                conn.send(serializedSeats);
            });
            conn.onmessage = function(e) {
                console.log(e.data);
                var data = JSON.parse(e.data);
                data.forEach(function(seat, index, array){
                    var seatObj = $('div[data-id="' + seat.id + '"]');
                    seatObj.data('user', seat.user);
                    removeSeatFromSelectedSeatsList(seat);
                    if(seat.user != $('#userId').val()){
                        seatObj.children('img').attr('src', '/bundles/at21eboxoffice/images/busy-seat.png')
                    } else {
                        seatObj.children('img').attr('src', '/bundles/at21eboxoffice/images/your-seat.png')
                    }
                });
            };
        };
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
    })
;

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