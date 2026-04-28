const formCommande = document.querySelector('.formCommande');
const commande = document.querySelector('.commande');
const btnAnnuler = document.querySelector('.x');

if (formCommande && commande) {
    commande.addEventListener('click', () => {
        formCommande.classList.add('show');
        formCommande.style.display = "flex";
    });
}

if (formCommande && btnAnnuler) {
    btnAnnuler.addEventListener('click', () => {
        formCommande.classList.remove('show');
        formCommande.style.display = "none";
    });
}

// Ajouter une ligne produit
function ajouterLigne() {
    let div = document.createElement("div");
    div.classList.add("ligne");
    let selectOptions = '<option value="">-- Produit --</option>';
    produits.forEach(function(prod) {
        selectOptions += '<option value="' + prod.id + '">' + prod.nom + '</option>';
    });

    div.innerHTML = `
        <select name="produits[]">${selectOptions} </select>
        <input type="number" name="quantites[]" placeholder="quantité">
        <button type="button" class="supprimer" onclick="supprimerLigne(this)">X</button>
    `;
    document.getElementById("listeProduits").appendChild(div);
}

// Supprimer une ligne
function supprimerLigne(btn) {
    btn.parentElement.remove();
}
// Vérification client
document.querySelector("form").addEventListener("submit", function(e) {
    let client = document.getElementById("client").value;
    if (client === "") {
        alert("Choisissez un client !");
        e.preventDefault();
    }
});