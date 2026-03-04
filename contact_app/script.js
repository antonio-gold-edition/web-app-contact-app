document.getElementById("contactForm").addEventListener("submit", function(e){
    e.preventDefault();

    let formData = new FormData(this);

    fetch("add.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        alert(data);
        location.reload();
    });
});

// Search filter
document.getElementById("search").addEventListener("keyup", function(){
    let value = this.value.toLowerCase();
    let cards = document.querySelectorAll(".card");

    cards.forEach(card => {
        card.style.display = 
            card.innerText.toLowerCase().includes(value) 
            ? "block" : "none";
    });
});

// Allow only numbers while typing
document.addEventListener("input", function(e) {
    if (e.target.name === "phone") {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    }
});