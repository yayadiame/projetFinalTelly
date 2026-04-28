const formecetegorie = document.querySelector('.formecetegorie');
const addCategorie = document.querySelector('.addCategorie');

    if(formecetegorie && addCategorie){
            addCategorie.addEventListener('click', () =>{
            formecetegorie.classList.add('show');
            formecetegorie.style.display="block";
        })
    }
        const strong = document.querySelector('.strong');

        if (strong) {
            strong.addEventListener('click', ()=>{
                formecetegorie.classList.remove('showe');
                formecetegorie.style.display = "none";
            })
        }