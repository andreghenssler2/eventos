document.addEventListener("DOMContentLoaded", function () {

    const btn = document.getElementById("btnMenu");
    const sidebar = document.getElementById("sidebar");

    if (btn) {
        btn.addEventListener("click", function () {
            sidebar.classList.toggle("collapsed");
        });
    }

});