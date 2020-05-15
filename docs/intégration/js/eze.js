let submit = {
    formElt : document.getElementById("form__add__book"),
    init: function () {
        //pour être sûr que tout marche bien
        console.log("Run: submit.js");
        submit.formElt.addEventListener('submit', submit.handleSubmit);
    },
    handleSubmit: function (evt) {
        evt.preventDefault();
        submit.addBook();
    },
    //méthode retournant les options du fetch des requêtes ajax
    //on passe la méthode http en argument, et les données
    //méthode retournant les options du fetch des requêtes ajax
    //on passe la méthode http en argument, et les données
    getFetchOptions: function (httpMethod, queryBody) {
        let options = {
            method: httpMethod,
            mode: 'cors',
            cache: 'no-cache',
            'X-CSRF-TOKEN': document.getElementById('tok').getAttribute('content'),
            body: JSON.stringify(queryBody)
        };
        if (httpMethod !== "GET") {
            // On prépare les entêtes HTTP (headers) de le requête
            // afin de spécifier que les données sont en JSON
            let myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");
            options.headers = myHeaders;
            //corps de la requête, passé en argument ici
            let jsonQueryBody = JSON.stringify(queryBody);
            options.body = jsonQueryBody;
        }
        return options;
    },
    addBook: function (evt) {
        let formData = new FormData([submit.formElt]);
        category_name = document.getElementById('category').value;
         let data = {
            title: title,
            resume: resume,
            date_pub: date_pub,
            category_name: category_name,
            imgData: imgData
        }; 
        // Exécuter la requête HTTP via XHR
        fetch('http://localhost:8000/api/add/book', submit.getFetchOptions("POST", formData))
            .then(
                response => {
                    //console.log(response);
                    return response.status == 200 ?
                        //(
                        console.log('opération effectué')//,
                        //  response.json()
                        //)
                        // TODO d'autres choses, certainement
                        :
                        (response.status === 204) ? "Rien à afficher"
                            :
                            console.log("L'opération a échoué")
                })
            .then(
                data => {
                    if (data !== 204) {
                        // console.log("204");
                    }
                })
        //}
    }
}
submit.init();