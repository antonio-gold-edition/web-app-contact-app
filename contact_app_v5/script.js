document.addEventListener("DOMContentLoaded", function(){

// ADD CONTACT
const form = document.getElementById("contactForm");

if(form){
form.addEventListener("submit", function(e){
e.preventDefault();

let formData = new FormData(this);

fetch("add.php",{
method:"POST",
body:formData
})
.then(res=>res.text())
.then(data=>{
alert(data);
location.reload();
});
});
}


// SEARCH CONTACT
const search = document.getElementById("search");
const container = document.getElementById("contactsContainer");

if(search && container){

search.addEventListener("keyup", function(){

let value = this.value.toLowerCase();
let cards = Array.from(container.querySelectorAll(".contact-card"));

let matches=[];

cards.forEach(card=>{

if(card.innerText.toLowerCase().includes(value)){
card.style.display="block";
matches.push(card);
}else{
card.style.display="none";
}

});

// move matches to top
matches.forEach(card=>{
container.prepend(card);
});

});

}


// PHONE ONLY NUMBERS
document.addEventListener("input", function(e){

if(e.target.name==="phone"){

e.target.value=e.target.value
.replace(/[^0-9]/g,'')   // remove letters
.slice(0,10);            // limit to 10 digits

}

});


// EMAIL NO SPACES
document.addEventListener("input", function(e){
if(e.target.name==="email"){
e.target.value=e.target.value.replace(/\s/g,'');
}
});


// DARK MODE
const toggleBtn=document.getElementById("darkToggle");

if(toggleBtn){

if(localStorage.getItem("darkMode")==="enabled"){
document.body.classList.add("dark-mode");
toggleBtn.innerText="☀ Light Mode";
}

toggleBtn.addEventListener("click", function(){

document.body.classList.toggle("dark-mode");

if(document.body.classList.contains("dark-mode")){
localStorage.setItem("darkMode","enabled");
toggleBtn.innerText="☀ Light Mode";
}else{
localStorage.setItem("darkMode","disabled");
toggleBtn.innerText="🌙 Dark Mode";
}

});

}

});