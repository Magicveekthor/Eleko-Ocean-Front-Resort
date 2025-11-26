const  allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i=> {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});



// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .menus');
const sidebar  = document.querySelector('#sidebar');

menuBar.addEventListener('click', () => {
    sidebar.classList.toggle('hide');
});


const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

    searchButton.addEventListener('click', (e) => {
        if (window.innerWidth < 576) {
            e.preventDefault();
            searchForm.classList.toggle('show');

            if(searchForm.classList.contains('show')){
                searchButtonIcon.classList.replace('bx-search', 'bx-x');
            } else {
                searchButtonIcon.classList.replace('bx-x', 'bx-search');
            }
        }
        
    });



if(window.innerWidth > 768) {
    sidebar.classList.remove('hide');
} else if(window.innerWidth < 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search');
    searchForm.classList.remove('show');
}


window.addEventListener('resize', () => {
    if(this.innerWidth < 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
})

document.querySelectorAll("#sidebar .drop-toggle").forEach(function(toggle){
    toggle.addEventListener("click", function(e){
        e.preventDefault();
        this.parentElement.classList.toggle("open");
    });
});


// Alert for the website
function alert(type, msg, position='body') {
    let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show alert-container" role="alert" id="autoDismissAlert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `; 
    if(position=='body') {
        document.body.append(element);
        // element.classList.add('alert-container');
    } else {
        document.getElementById(position).appendChild(element);
    }

    // Automatically close after 2 seceonds
    setTimeout(() => {
        let alertEl = element.querySelector('.alert');
        if(alertEl) {
            let bsAlert = bootstrap.Alert.getOrCreateInstance(alertEl);
            bsAlert.close();
        }
    }, 3000);
}
