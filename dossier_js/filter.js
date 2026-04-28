
// document.addEventListener("DOMContentLoaded", () => {
   const texte = document.querySelector(".texte");
const lignes = document.querySelectorAll("tbody tr");

texte.addEventListener('keyup', () => {
    let value = texte.value.toLowerCase();

    lignes.forEach(ligne => {
        let nom = ligne.children[1].textContent.toLowerCase();
        let prenom = ligne.children[2].textContent.toLowerCase();

        if (nom.includes(value)) {
            ligne.style.display = "table-row";
        } else {
            ligne.style.display = "none";
        }
    });
});
// });