document.addEventListener('DOMContentLoaded', function() {

    // Fonction pour supprimer un délégué
    function Supprimer(i) {

        $.ajax({
            url: "http://localhost:80/Api_Beta/Utilisateurs/Etudiants/Supprimer.php",

            type: "DELETE",

            data: JSON.stringify({
                ID_Utilisateur: xhr.Etudiants[i].ID_Utilisateur,
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
            url: "http://localhost:80/Api_Beta/Utilisateurs/Etudiants/Update.php",

            type: "PUT",

            data: JSON.stringify({
                ID_Utilisateur: xhr.Etudiants[i].ID_Utilisateur,
                centre_etudiant: $("#adresse").val(),
                promotion_etudiant: $("#promotions").val(),
                NOM: $("#nom").val(),
                PRENOM: $("#prenom").val(),
                Login: $("#email").val(),
                Mot_de_passe: xhr.Etudiants[i].Mot_de_passe,
                ID_Utilisateur__CREE: xhr.Etudiants[i].ID_Utilisateur__CREE
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
    xhr.open("GET", "http://localhost/Api_Beta/Utilisateurs/Etudiants/Lire.php", true);
    // Fonction éxécuter lors de la requête
    xhr.onload = function() {
        var html = "";
        if (xhr.status == 200) {
            xhr = JSON.parse(xhr.responseText); //fichier objet
        } else {}
        for (let i = 0; i < xhr.Etudiants.length; i++) {
            // mise en page avec balisage Html des données récupérée
            html += '<tr> <td> ' + xhr.Etudiants[i].NOM + ' </td> <td> ' + xhr.Etudiants[i].PRENOM + ' </td> <td > ' + xhr.Etudiants[i].Login + ' </td> <td>' + xhr.Etudiants[i].centre_etudiant + '</td><td> ' + xhr.Etudiants[i].promotion_etudiant + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </tr>';
        }
        // on donne la variable html à un Element Html avec son ID
        document.getElementById("tableau").innerHTML = html;
        // Appel de la fonction Supprimer
        for (let i = 0; i < xhr.Etudiants.length; i++) {
            document.getElementById("Supprimer_" + i + "").onclick = function() // Interception du click sur le bouton
                {
                    Supprimer(i);
                }
        }
        // Appel de la fonction Modifier
        for (let i = 0; i < xhr.Etudiants.length; i++) {
            document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                {
                    $("#prenom").val(xhr.Etudiants[i].PRENOM);
                    $("#nom").val(xhr.Etudiants[i].NOM);
                    $("#email").val(xhr.Etudiants[i].Login);
                    $("#adresse").val(xhr.Etudiants[i].centre_etudiant);
                    $("#promotions").val(xhr.Etudiants[i].promotion_etudiant);
                    document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
                        {

                            Update(i);
                        }

                }

        }
    };

    xhr.send(); //Envoi de la requête au serveur (asynchrone par défaut)
    document.getElementById("chercher").onclick = function() // Interception du click sur le bouton
        {


            var recherche = $("#rechercher").val();
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://localhost/Api_Beta/Utilisateurs/Etudiants/Lire.php", true);
            xhr.onload = function() {
                var html = "";

                if (xhr.status == 200) {
                    xhr = JSON.parse(xhr.responseText); //fichier objet
                    ;
                } else {}
                for (let i = 0; i < xhr.Etudiants.length; i++) {
                    if (recherche == "") {
                        html += '<tr> <td> ' + xhr.Etudiants[i].NOM + ' </td> <td> ' + xhr.Etudiants[i].PRENOM + ' </td> <td > ' + xhr.Etudiants[i].Login + ' </td> <td>' + xhr.Etudiants[i].centre_etudiant + '</td><td> ' + xhr.Etudiants[i].promotion_etudiant + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </td> </tr>';

                    } else if (recherche == xhr.Etudiants[i].NOM || recherche == xhr.Etudiants[i].PRENOM || recherche == xhr.Etudiants[i].Login || recherche == xhr.Etudiants[i].centre_etudiant || recherche == xhr.Etudiants[i].promotion_etudiant) {
                        html += '<tr> <td> ' + xhr.Etudiants[i].NOM + ' </td> <td> ' + xhr.Etudiants[i].PRENOM + ' </td> <td > ' + xhr.Etudiants[i].Login + ' </td> <td>' + xhr.Etudiants[i].centre_etudiant + '</td><td> ' + xhr.Etudiants[i].promotion_etudiant + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </tr>';

                    }


                };
                document.getElementById("tableau").innerHTML = html;
                for (let i = 0; i < xhr.Etudiants.length; i++) {
                    if (recherche == xhr.Etudiants[i].NOM || recherche == xhr.Etudiants[i].PRENOM || recherche == xhr.Etudiants[i].Login || recherche == xhr.Etudiants[i].centre_etudiant || recherche == xhr.Etudiants[i].promotion_etudiant) {

                        document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                            {
                                $("#prenom").val(xhr.Etudiants[i].PRENOM);
                                $("#nom").val(xhr.Etudiants[i].NOM);
                                $("#email").val(xhr.Etudiants[i].Login);
                                $("#adresse").val(xhr.Etudiants[i].centre_etudiant);
                                $("#promotions").val(xhr.Etudiants[i].promotion_etudiant);
                                document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
                                    {

                                        Update(i);
                                    }

                            }


                    } else if (recherche == "") {
                        for (let i = 0; i < xhr.Etudiants.length; i++) {
                            document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                                {
                                    $("#prenom").val(xhr.Etudiants[i].PRENOM);
                                    $("#nom").val(xhr.Etudiants[i].NOM);
                                    $("#email").val(xhr.Etudiants[i].Login);
                                    $("#adresse").val(xhr.Etudiants[i].centre_etudiant);
                                    $("#promotions").val(xhr.Etudiants[i].promotion_etudiant);
                                    document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
                                        {

                                            Update(i);
                                        }

                                }
                        }


                        for (let i = 0; i < xhr.Etudiants.length; i++) {
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