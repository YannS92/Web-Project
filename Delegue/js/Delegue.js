document.addEventListener('DOMContentLoaded', function() {

    // Fonction pour supprimer un délégué
    function Supprimer(i) {

        $.ajax({
            url: "http://localhost:80/Api_Beta/Utilisateurs/Delegue/Supprimer.php",

            type: "DELETE",

            data: JSON.stringify({
                ID_Utilisateur: xhr.Delegue[i].ID_Utilisateur,
            }),

            success: function(data) {
                console.log(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#jquery_result').html('Error: ' + xhr.status);
                console.log(thrownError);
            }
        })
        location.reload()


    };
    //Fonction pour Modifier un Délégué
    function Update(i) {
        $.ajax({
            url: "http://localhost:80/Api_Beta/Utilisateurs/Delegue/Update.php",

            type: "PUT",

            data: JSON.stringify({
                ID_Utilisateur: xhr.Delegue[i].ID_Utilisateur,
                centre_Delegue: $("#adresse").val(),
                promotions_Delegue: $("#promotions").val(),
                Droits_Delegue: xhr.Delegue[i].Droits_Delegue,
                NOM: $("#nom").val(),
                PRENOM: $("#prenom").val(),
                Login: $("#email").val(),
                Mot_de_passe: xhr.Delegue[i].Mot_de_passe,
                ID_Utilisateur__Assigne_DROIT: xhr.Delegue[i].ID_Utilisateur__Assigne_DROIT,
                ID_Utilisateur__CREE: xhr.Delegue[i].ID_Utilisateur__CREE
            }),

            success: function(data) {
                console.log(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                $('#jquery_result').html('Error: ' + xhr.status);
                console.log(thrownError);
            }
        })
        location.reload()

    };
    // On instancie une requête Http
    var xhr = new XMLHttpRequest();
    // On précise la méthode et l'Url
    xhr.open("GET", "http://localhost/Api_Beta/Utilisateurs/Delegue/Lire.php", true);
    // Fonction éxécuter lors de la requête
    xhr.onload = function() {
        var html = "";
        if (xhr.status == 200) {
            xhr = JSON.parse(xhr.responseText); //fichier objet
        } else {}
        for (let i = 0; i < xhr.Delegue.length; i++) {
            // mise en page avec balisage Html des données récupérée
            html += '<tr> <td> ' + xhr.Delegue[i].NOM + ' </td> <td> ' + xhr.Delegue[i].PRENOM + ' </td> <td > ' + xhr.Delegue[i].Login + ' </td> <td>' + xhr.Delegue[i].centre_Delegue + '</td><td> ' + xhr.Delegue[i].promotions_Delegue + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </tr>';
        }
        // on donne la variable html à un Element Html avec son ID
        document.getElementById("tableau").innerHTML = html;
        // Appel de la fonction Supprimer
        for (let i = 0; i < xhr.Delegue.length; i++) {
            document.getElementById("Supprimer_" + i + "").onclick = function() // Interception du click sur le bouton
                {
                    Supprimer(i);
                }
        }
        // Appel de la fonction Modifier
        for (let i = 0; i < xhr.Delegue.length; i++) {
            document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                {
                    $("#prenom").val(xhr.Delegue[i].PRENOM);
                    $("#nom").val(xhr.Delegue[i].NOM);
                    $("#email").val(xhr.Delegue[i].Login);
                    $("#adresse").val(xhr.Delegue[i].centre_Delegue);
                    $("#promotions").val(xhr.Delegue[i].promotions_Delegue);
                    document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
                        {

                            Update(i);
                        }

                }

        }
    };

    xhr.send(); //Envoi de la requête au serveur (asynchrone par défaut)
    // Barre de recherche
    document.getElementById("chercher").onclick = function() // Interception du click sur le bouton
        {

            // on donne la valeur de l'input qui a pour ID rechercher (la barre de recherche)
            var recherche = $("#rechercher").val();
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://localhost/Api_Beta/Utilisateurs/Delegue/Lire.php", true);
            xhr.onload = function() {
                var html = "";

                if (xhr.status == 200) {
                    xhr = JSON.parse(xhr.responseText); //fichier objet
                    ;
                } else {}
                for (let i = 0; i < xhr.Delegue.length; i++) {
                    // on regarde si la barre de recherche est vide
                    if (recherche == "") {
                        // la barre de recherche est vide on affiche alors tout les Délégués
                        html += '<tr> <td> ' + xhr.Delegue[i].NOM + ' </td> <td> ' + xhr.Delegue[i].PRENOM + ' </td> <td > ' + xhr.Delegue[i].Login + ' </td> <td>' + xhr.Delegue[i].centre_Delegue + '</td><td> ' + xhr.Delegue[i].promotions_Delegue + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </td> </tr>';
                        //Sinon on affiche seulement les délégués recherché 
                    } else if (recherche == xhr.Delegue[i].NOM || recherche == xhr.Delegue[i].PRENOM || recherche == xhr.Delegue[i].Login || recherche == xhr.Delegue[i].centre_Delegue || recherche == xhr.Delegue[i].promotions_Delegue) {
                        html += '<tr> <td> ' + xhr.Delegue[i].NOM + ' </td> <td> ' + xhr.Delegue[i].PRENOM + ' </td> <td > ' + xhr.Delegue[i].Login + ' </td> <td>' + xhr.Delegue[i].centre_Delegue + '</td><td> ' + xhr.Delegue[i].promotions_Delegue + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </tr>';

                    }


                };
                document.getElementById("tableau").innerHTML = html;
                // Utilisation de la fonction Modifier mais pour Un délégués rechercher
                for (let i = 0; i < xhr.Delegue.length; i++) {
                    if (recherche == xhr.Delegue[i].NOM || recherche == xhr.Delegue[i].PRENOM || recherche == xhr.Delegue[i].Login || recherche == xhr.Delegue[i].centre_Delegue || recherche == xhr.Delegue[i].promotions_Delegue) {

                        document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                            {
                                $("#prenom").val(xhr.Delegue[i].PRENOM);
                                $("#nom").val(xhr.Delegue[i].NOM);
                                $("#email").val(xhr.Delegue[i].Login);
                                $("#adresse").val(xhr.Delegue[i].centre_Delegue);
                                $("#promotions").val(xhr.Delegue[i].promotions_Delegue);
                                document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
                                    {

                                        Update(i);
                                    }

                            }

                        // fonction Modifier pour tout les délégués
                    } else if (recherche == "") {
                        for (let i = 0; i < xhr.Delegue.length; i++) {
                            document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                                {
                                    $("#prenom").val(xhr.Delegue[i].PRENOM);
                                    $("#nom").val(xhr.Delegue[i].NOM);
                                    $("#email").val(xhr.Delegue[i].Login);
                                    $("#adresse").val(xhr.Delegue[i].centre_Delegue);
                                    $("#promotions").val(xhr.Delegue[i].promotions_Delegue);
                                    document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
                                        {

                                            Update(i);
                                        }

                                }
                        }

                        //Fonctions Supprimer pour tout les délégués après recherche
                        for (let i = 0; i < xhr.Delegue.length; i++) {
                            document.getElementById("Supprimer_" + i + "").onclick = function() // Interception du click sur le bouton
                                {
                                    Supprimer(i);
                                }
                        }
                    }



                }


            };
            xhr.send(); //Envoi de la requête au serveur (asynchrone par défaut)



        };


})