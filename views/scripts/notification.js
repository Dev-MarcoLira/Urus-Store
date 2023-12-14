var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");

if(modal){
    
    if(modal.classList.contains('active')) {
        modal.style.display = "block";
    }

    modal.onclick = function(event) {
        modal.style.display = "none";
        modal.classList.remove = "active";
    }
}