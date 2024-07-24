document.addEventListener('DOMContentLoaded', function() {

    // Fonction pour supprimer un délégué
    function Supprimer(i) {

        $.ajax({
            url: "http://localhost:80/Api_Beta/Utilisateurs/Pilotes/Supprimer.php",

            type: "DELETE",

            data: JSON.stringify({
                ID_Utilisateur: xhr.Pilotes[i].ID_Utilisateur,
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
            url: "http://localhost:80/Api_Beta/Utilisateurs/Pilotes/Update.php",

            type: "PUT",

            data: JSON.stringify({
                ID_Utilisateur: xhr.Pilotes[i].ID_Utilisateur,
                centre_pilote: $("#adresse").val(),
                promotions_pilote: $("#promotions").val(),
                NOM: $("#nom").val(),
                PRENOM: $("#prenom").val(),
                Login: $("#email").val(),
                Mot_de_passe: xhr.Pilotes[i].Mot_de_passe,
                ID_Utilisateur_Administrateur: xhr.Pilotes[i].ID_Utilisateur_Administrateur,

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
    xhr.open("GET", "http://localhost/Api_Beta/Utilisateurs/Pilotes/Lire.php", true);
    // Fonction éxécuter lors de la requête
    xhr.onload = function() {
        var html = "";
        if (xhr.status == 200) {
            xhr = JSON.parse(xhr.responseText); //fichier objet
        } else {}
        for (let i = 0; i < xhr.Pilotes.length; i++) {
            // mise en page avec balisage Html des données récupérée
            html += '<tr> <td> ' + xhr.Pilotes[i].NOM + ' </td> <td> ' + xhr.Pilotes[i].PRENOM + ' </td> <td > ' + xhr.Pilotes[i].Login + ' </td> <td>' + xhr.Pilotes[i].centre_pilote + '</td><td> ' + xhr.Pilotes[i].promotions_pilote + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </tr>';
        }
        // on donne la variable html à un Element Html avec son ID
        document.getElementById("tableau").innerHTML = html;
        // Appel de la fonction Supprimer
        for (let i = 0; i < xhr.Pilotes.length; i++) {
            document.getElementById("Supprimer_" + i + "").onclick = function() // Interception du click sur le bouton
                {
                    Supprimer(i);
                }
        }
        // Appel de la fonction Modifier
        for (let i = 0; i < xhr.Pilotes.length; i++) {
            document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                {
                    $("#prenom").val(xhr.Pilotes[i].PRENOM);
                    $("#nom").val(xhr.Pilotes[i].NOM);
                    $("#email").val(xhr.Pilotes[i].Login);
                    $("#adresse").val(xhr.Pilotes[i].centre_pilote);
                    $("#promotions").val(xhr.Pilotes[i].promotions_pilote);
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
            xhr.open("GET", "http://localhost/Api_Beta/Utilisateurs/Pilotes/Lire.php", true);
            xhr.onload = function() {
                var html = "";

                if (xhr.status == 200) {
                    xhr = JSON.parse(xhr.responseText); //fichier objet
                    ;
                } else {}
                for (let i = 0; i < xhr.Pilotes.length; i++) {
                    // on regarde si la barre de recherche est vide
                    if (recherche == "") {
                        // la barre de recherche est vide on affiche alors tout les Délégués
                        html += '<tr> <td> ' + xhr.Pilotes[i].NOM + ' </td> <td> ' + xhr.Pilotes[i].PRENOM + ' </td> <td > ' + xhr.Pilotes[i].Login + ' </td> <td>' + xhr.Pilotes[i].centre_pilote + '</td><td> ' + xhr.Pilotes[i].promotions_pilote + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </td> </tr>';
                        //Sinon on affiche seulement les délégués recherché 
                    } else if (recherche == xhr.Pilotes[i].NOM || recherche == xhr.Pilotes[i].PRENOM || recherche == xhr.Pilotes[i].Login || recherche == xhr.Pilotes[i].centre_pilote || recherche == xhr.Pilotes[i].promotions_pilote) {
                        html += '<tr> <td> ' + xhr.Pilotes[i].NOM + ' </td> <td> ' + xhr.Pilotes[i].PRENOM + ' </td> <td > ' + xhr.Pilotes[i].Login + ' </td> <td>' + xhr.Pilotes[i].centre_pilote + '</td><td> ' + xhr.Pilotes[i].promotions_pilote + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </tr>';

                    }


                };
                document.getElementById("tableau").innerHTML = html;
                // Utilisation de la fonction Modifier mais pour Un délégués rechercher
                for (let i = 0; i < xhr.Pilotes.length; i++) {
                    if (recherche == xhr.Pilotes[i].NOM || recherche == xhr.Pilotes[i].PRENOM || recherche == xhr.Pilotes[i].Login || recherche == xhr.Pilotes[i].centre_pilote || recherche == xhr.Pilotes[i].promotions_pilote) {

                        document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                            {
                                $("#prenom").val(xhr.Pilotes[i].PRENOM);
                                $("#nom").val(xhr.Pilotes[i].NOM);
                                $("#email").val(xhr.Pilotes[i].Login);
                                $("#adresse").val(xhr.Pilotes[i].centre_pilote);
                                $("#promotions").val(xhr.Pilotes[i].promotions_pilote);
                                document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
                                    {

                                        Update(i);
                                    }

                            }

                        // fonction Modifier pour tout les délégués
                    } else if (recherche == "") {
                        for (let i = 0; i < xhr.Pilotes.length; i++) {
                            document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                                {
                                    $("#prenom").val(xhr.Pilotes[i].PRENOM);
                                    $("#nom").val(xhr.Pilotes[i].NOM);
                                    $("#email").val(xhr.Pilotes[i].Login);
                                    $("#adresse").val(xhr.Pilotes[i].centre_pilote);
                                    $("#promotions").val(xhr.Pilotes[i].promotions_pilote);
                                    document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
                                        {

                                            Update(i);
                                        }

                                }
                        }

                        //Fonctions Supprimer pour tout les délégués après recherche
                        for (let i = 0; i < xhr.Pilotes.length; i++) {
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