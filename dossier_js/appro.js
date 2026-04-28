const formAppro = document.querySelector('.formAppro');
const addappro = document.querySelector('.addappro');

const supp = document.querySelector('.supp');

    if(formAppro && addappro){
        addappro.addEventListener('click', () => {
           formAppro.classList.add('show');
           formAppro.style.display= "block";
        })
    }
    if(formAppro && supp){
        supp.addEventListener('click', () => {
           formAppro.classList.remove('show');
           formAppro.style.display= "none";
        })
    }
function ajouterLigne(){
    let ligne = document.querySelector(".ligne").cloneNode(true);
    // reset valeur
    ligne.querySelector("select").value = "";
    ligne.querySelector("input").value = "";

    document.getElementById("listeProduits").appendChild(ligne);
}

// Supprimer ligne
function supprimerLigne(btn){
    let lignes = document.querySelectorAll(".ligne");
    if(lignes.length > 1){
        btn.parentElement.remove();
    }
}

