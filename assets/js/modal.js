var modalRegister = document.getElementById("modalRegister");

var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
    modalRegister.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modalRegister) {
        modalRegister.style.display = "none";
    }
}