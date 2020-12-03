// input nhap tien thu chi
$('number').on('input', function(e) {
    $(this).val(formatCurrency(this.value.replace(/[,VNĐ]/g, '')));
}).on('keypress', function(e) {
    if (!$.isNumeric(String.fromCharCode(e.which))) e.preventDefault();
}).on('paste', function(e) {
    var cb = e.originalEvent.clipboardData || window.clipboardData;
    if (!$.isNumeric(cb.getData('text'))) e.preventDefault();
});

function formatCurrency(number) {
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&,");
    return n2.split('').reverse().join('');
}
// scroll bar 
var myCustomScrollbar = document.querySelector('.my-custom-scrollbar');
var ps = new PerfectScrollbar(myCustomScrollbar);
var scrollbarY = myCustomScrollbar.querySelector('.ps__rail-y');
myCustomScrollbar.onscroll = function() {
        scrollbarY.style.cssText = `top: ${this.scrollTop}px!important; height: 400px; right: ${-this.scrollLeft}px`;
    }
    // input chi cho nhap so 
function validate(evt) {
    var theEvent = evt || window.event;

    // Handle 
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if (!regex.test(key)) {
        theEvent.returnValue = false;
        if (theEvent.preventDefault) theEvent.preventDefault();
    }
}

function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("dnInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("dnTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[4];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function myFunctionLanh() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("dlInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("dlTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[4];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function myFunctionGo() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("goInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("goTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[4];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}