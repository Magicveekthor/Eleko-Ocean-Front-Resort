function get_bookings(search = ''){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/new_bookings.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        document.getElementById('table-body').innerHTML = this.responseText;
    }
    xhr.send('get_bookings&search='+search);
}


// assign room function
function assign_room(booking_id) {

    let data = new FormData();
    data.append('assign_room', '');
    data.append('booking_id', booking_id);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/new_bookings.php", true);

    xhr.onload = function() {
        if (this.responseText.trim() == "1") {
            alert('success', 'Booking Confirmed');
            get_bookings();
        } else {
            alert('error', 'Server down!');
        }
    };

    xhr.send(data);
}



function cancel_booking(id) {
    if(confirm("Are you sure, you want to cancel this booking?")) {
        let data = new FormData();
        data.append('booking_id', id);
        data.append('cancel_booking','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","ajax/new_bookings.php",true);

        xhr.onload = function(){
            if(this.responseText.trim() === "1") {
                alert('success', 'Booking Cancelled!');
                get_bookings();
            } else {
                alert('error','User Removal failed. Server Down!');
            }
        }
        xhr.send(data);
    }
}

window.onload = function(){
    get_bookings();
}