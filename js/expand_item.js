function openForm(image, name, description, location, dateLost) {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("form-container").style.display = "block";
    document.getElementById("item-image").src = image;
    document.getElementById("item-name").innerHTML = name;
    document.getElementById("item-description").innerHTML = description;
    document.getElementById("item-location").innerHTML = location;
    document.getElementById("item-date-lost").innerHTML = dateLost;
}

function closeForm() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("form-container").style.display = "none";
}

