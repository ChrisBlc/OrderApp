window.onscroll = function() {myFunction()};
var navbar = document.querySelector('.main_menu');
var sticky = navbar.offsetTop + 20;
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

//fonction pour faire apparaitre l'accordéon
let doc = document.querySelectorAll('.item_description')
doc.forEach((description) =>{
    description.addEventListener('click', function(){
        let choix = document.querySelectorAll('.item_selections')
        choix.forEach(item => {
            item.style.display = 'none'
        })
            this.nextElementSibling.style.display = 'block' 
    })
})

//fonction pour faire apparaitre les tabs
function openMenu(evt, categorie){
    let menu = document.querySelectorAll(".menu_container")
    menu.forEach((container) => {
        container.style.display = "none"
    })
    let button = document.querySelectorAll(".menu_choice")
    button.forEach((but)=>{
        but.className = but.className.replace("active", '')
    })
    document.getElementById(categorie).style.display = 'block'
    evt.currentTarget.className += " active";
}


/*ajout du bouton panier seulement à l'ajout d'un item
let main = document.querySelector('main')
    let menu = main.querySelectorAll('.menu_choice')
    menu.forEach(ajout =>{
        ajout.setAttribute('onclick', 'afficheBouton()')
    })
function afficheBouton(){
    let boutonPanier = document.querySelector('.boutonPanier')
    boutonPanier.style.display = 'block'
}*/


// recuperations des données
let items = document.querySelectorAll('.item_quantity')
let listItems = new Map()
items.forEach(item => {
    let type = item.getAttribute('id')
    let quantite = item.getAttribute('value')
    listItems.set(type, quantite)
})
console.log(listItems)
