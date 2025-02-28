function openAl(menuID) {
    var menu = document.getElementById(menuID);
    if (menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}

