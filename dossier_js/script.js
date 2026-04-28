const vendeur = document.querySelector('.add-vendeur');
const btnAnnuler= document.querySelectorAll('.btnAnnuler'); //pour annuler les add vendeurs 
const vendeurs = document.querySelector('.vendeurs');

//la partie client 
const formClient = document.querySelector(".formClient");
const client = document.querySelector(".client");
const addClient = document.querySelector(".addClient");

if (vendeurs && vendeur) {
    vendeurs.addEventListener('click', () =>{
        vendeur.classList.add('show');
        vendeur.style.display = "block";
    });
}


if (client && formClient) {
    client.addEventListener('click', () =>{
        formClient.classList.add('show');
        formClient.style.display = "block";
    });
}
//les produit et les categorie ..................
const categorieBtn = document.querySelector('.categorieBtn');
const produitBtn = document.querySelector('.produitBtn');
const stockerBtn = document.querySelector('.stockerBtn');

const formCategorie = document.querySelector('.formCategorie');
const formProduit = document.querySelector('.formProduit');
const formStocker = document.querySelector('.formStocker');

if(formCategorie && categorieBtn){
   categorieBtn.addEventListener('click', ()=>{
    formCategorie.classList.add('show');
    formCategorie.style.display = "block";
   }) 
}

if(formProduit && produitBtn){
   produitBtn.addEventListener('click', ()=>{
    formProduit.classList.add('show');
    formProduit.style.display = "block";
   }) 
}

if(formStocker && stockerBtn){
   stockerBtn.addEventListener('click', ()=>{
    formStocker.classList.add('show');
    formStocker.style.display = "block";
   }) 
}
//la partie annulation

btnAnnuler.forEach(btn => {
    btn.addEventListener('click', () => {
        if (vendeur) {
            vendeur.classList.remove('show');
            vendeur.style.display = "none";
        }
        if (formClient) {
            formClient.classList.remove('show');
            formClient.style.display = "none";
        }
        if (formCategorie) {
            formCategorie.classList.remove('show');
            formCategorie.style.display = "none";
        }
        if (formProduit) {
            formProduit.classList.remove('show');
            formProduit.style.display = "none";
        }
        if (formStocker) {
            formStocker.classList.remove('show');
            formStocker.style.display = "none";
        }
        if (formeProduit) {
            formeProduit.classList.remove('show');
            formeProduit.style.display = "none";
        }
    });
});

//produit

const addProduit = document.querySelector('.addProduit');
const formeProduit = document.querySelector('.formeProduit');

if(formeProduit && addProduit){
    addProduit.addEventListener('click', ()=>{
       formeProduit.classList.add('show');
       formeProduit.style.display = "block"; 
    })
}