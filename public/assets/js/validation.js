//cible tous les <select> de notre form
var allSelect = document.querySelectorAll("#home-edit-form select");

//fonction qui est appelée quand on change la valeur d'un select
function handleChange(event){
    //par défaut, on dit que tout est ok, on met les bordures en gris
    for(var i = 0; i < allSelect.length; i++){
        allSelect[i].style.borderColor = "#ced4da";
    }

    //on chercher parmi tous les select...
    for(var i = 0; i < allSelect.length; i++){
        //et on refait une deuxième pour pouvoir les comparer
        for(var k = 0; k < allSelect.length; k++){
            if (allSelect[i].value === allSelect[k].value && i !== k){
                allSelect[i].style.borderColor = "#F0F";
                allSelect[k].style.borderColor = "#F0F";
            }
        }
    }
}

//met tous nos select sous écoute de l'événement "change"
for(var i = 0; i < allSelect.length; i++){
    allSelect[i].addEventListener("change", handleChange);
}

