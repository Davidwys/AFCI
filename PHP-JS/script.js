//je fais une requete à mon fichier php

fetch("produits.php").then(res=>{
    //si tout est ok
    if(res.ok){
        //je traduis les données json
        res.json().then(data=>{
            console.log(data);
            data.forEach(prod => {
                //concaténation de tous les products name dans le body
                document.body.innerHTML += `<h2>${$prod.productName}</h2>`;
                /* OU document.body.innerHTML = document.body.innerHTML + `<h2></h2>`    */
                        });
        })
    }
})