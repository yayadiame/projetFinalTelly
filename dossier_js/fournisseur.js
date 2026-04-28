const formfourni = document.querySelector('.formfourni');
const fournisseur = document.querySelector('.fournisseur');
const btnAnnuler = document.querySelector('.btnAnnuler');


    if(formfourni && fournisseur){
            fournisseur.addEventListener('click', ()=>{
            formfourni.classList.add('show');
            formfourni.style.display = "block";
        })
    }
if (formfourni) {
        btnAnnuler.addEventListener('click', () =>{
        formfourni.classList.remove('show');
        formfourni.style.display = "none";
    }) 
}
       
const formCommande = document.querySelector('.formCommande');
const commande = document.querySelector('commande');
if(formCommande && commande){
    commande.addEventListener('click', () => {
        formCommande.classList.add('show');
        formCommande.style.display = "block";
    })
}