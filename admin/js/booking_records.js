function get_bookings(search = '', page = 1){
    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/booking_records.php",true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        let data = JSON.parse(this.responseText);
        document.getElementById('table-body').innerHTML = data.table_body;
        document.getElementById('table-pagination').innerHTML = data.pagination;
    }
    xhr.send('get_bookings&search='+search+'&page='+page);
}

function change_page(page) {
    get_bookings(document.getElementById('search_input').value, page);
}

window.onload = function(){
    get_bookings();
}