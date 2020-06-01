let app = {


   
    //on définit ici nos propriétés réutilisables dans notre code
    fetchOptions: {
        method: 'GET',
        mode: 'cors',
        cache: 'no-cache'
    },

    //par défaut c'est un tableau vide, mais quand la requête ajax sera terminée
    //cette propriété contiendra la liste des catégories
    categories: [],
    displayArchives: false,

    //méthode permettant d'initialiser notre application
    init: function () {
        //pour être sûr que tout marche bien
        console.log("coucou depuis l'init");

        
        //met en place toutes nos mises sous écoute
        app.listenForEvents();
    },

    listenForEvents: function () {
        let FormGroupCat = document.querySelector(".category_id");
        FormGroupCat.addEventListener("change", app.handleChangeCategory);
    },

    handleChangeCategory: function (evt) {

        let selectedCategory = evt.currentTarget

        fetch('/api/sub_category', app.fetchOptions)
            .then(
                function (response) {
                    return response.json();
                }
            )
            .then(function (subCategories) {
                    let ValueCat = selectedCategory.value;
                    let formSubCat = document.getElementById("sub_category");
                   
                    optionsToRemove = formSubCat.querySelectorAll('.newOption')
                    console.log(optionsToRemove);
                    
                        optionsToRemove.forEach(
                            function(optionToRemove){
                        optionToRemove.remove();
                        console.log(optionsToRemove[i]);
                    })
                    subCategories.forEach(
                        function (subCategory) {
                          
                            if (subCategory.category_id === ValueCat) {
                                //debugger;
                                let option = document.createElement('option');
                                //console.log(subCategory.name);
                                //console.log(subCategory.id);
                                option.innerHTML = subCategory.name;
                                option.value = subCategory.id;
                                option.className = 'newOption'
                                //console.log(option);
                                formSubCat.querySelector("select").appendChild(option);
                               // console.log(formSubCat.querySelector("select"))

                            }

                        })
                }

            );

    }

}




app.init();