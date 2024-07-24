document.addEventListener('DOMContentLoaded', function() {

    // Fonction pour supprimer un délégué
    function Supprimer(i) {

        $.ajax({
            url: "http://localhost:80/Api_Beta/Entreprise/Supprimer.php",

            type: "DELETE",

            data: JSON.stringify({
                id_entreprise: xhr.Entreprise[i].id_entreprise,
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
            url: "http://localhost/Api_Beta/Entreprise/Update.php",

            type: "PUT",

            data: JSON.stringify({

                id_entreprise: xhr.Entreprise[i].id_entreprise,
                Nom_entreprise: $("#nom").val(),
                secteur_activite: $("#siret").val(),
                competences_recherchees_dans_les_stages: $("#Comp").val(),
                nombre_de_stagiaires_CESI_deja_acceptes_en_stage: $("#nTel").val(),
                evaluation_des_stagiaires: $("#evals").val(),
                confiance_du_Pilote_de_promotion: $("#evalp").val(),
                localite_entreprise: $("#ville").val(),
                ID_Utilisateur: xhr.Entreprise[i].ID_Utilisateur
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
    xhr.open("GET", "http://localhost/Api_Beta/Entreprise/Lire.php", true);
    // Fonction éxécuter lors de la requête
    xhr.onload = function() {
        var html = "";
        if (xhr.status == 200) {
            xhr = JSON.parse(xhr.responseText); //fichier objet
        } else {}
        for (let i = 0; i < xhr.Entreprise.length; i++) {
            // mise en page avec balisage Html des données récupérée
            html += '<tr> <td> ' + xhr.Entreprise[i].Nom_entreprise + ' </td> <td> ' + xhr.Entreprise[i].secteur_activite + ' </td> <td > ' + xhr.Entreprise[i].competences_recherchees_dans_les_stages + ' </td> <td>' + xhr.Entreprise[i].nombre_de_stagiaires_CESI_deja_acceptes_en_stage + '</td> <td> ' + xhr.Entreprise[i].evaluation_des_stagiaires + ' </td><td> ' + xhr.Entreprise[i].confiance_du_Pilote_de_promotion + ' </td><td> ' + xhr.Entreprise[i].localite_entreprise + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </tr>';
        }
        // on donne la variable html à un Element Html avec son ID
        document.getElementById("tableau").innerHTML = html;
        // Appel de la fonction Supprimer
        for (let i = 0; i < xhr.Entreprise.length; i++) {
            document.getElementById("Supprimer_" + i + "").onclick = function() // Interception du click sur le bouton
                {
                    Supprimer(i);
                }
        }
        // Appel de la fonction Modifier
        for (let i = 0; i < xhr.Entreprise.length; i++) {
            document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                {
                    $("#nom").val(xhr.Entreprise[i].Nom_entreprise);
                    $("#siret").val(xhr.Entreprise[i].secteur_activite);
                    $("#Comp").val(xhr.Entreprise[i].competences_recherchees_dans_les_stages);
                    $("#nTel").val(xhr.Entreprise[i].nombre_de_stagiaires_CESI_deja_acceptes_en_stage);
                    $("#evals").val(xhr.Entreprise[i].evaluation_des_stagiaires);
                    $("#evalp").val(xhr.Entreprise[i].confiance_du_Pilote_de_promotion);
                    $("#ville").val(xhr.Entreprise[i].localite_entreprise);
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
            xhr.open("GET", "http://localhost/Api_Beta/Entreprise/Lire.php", true);
            xhr.onload = function() {
                var html = "";

                if (xhr.status == 200) {
                    xhr = JSON.parse(xhr.responseText); //fichier objet
                    ;
                } else {}
                for (let i = 0; i < xhr.Entreprise.length; i++) {
                    if (recherche == "") {
                        html += '<tr> <td> ' + xhr.Entreprise[i].Nom_entreprise + ' </td> <td> ' + xhr.Entreprise[i].secteur_activite + ' </td> <td > ' + xhr.Entreprise[i].competences_recherchees_dans_les_stages + ' </td> <td>' + xhr.Entreprise[i].nombre_de_stagiaires_CESI_deja_acceptes_en_stage + '</td> <td> ' + xhr.Entreprise[i].evaluation_des_stagiaires + ' </td><td> ' + xhr.Entreprise[i].confiance_du_Pilote_de_promotion + ' </td><td> ' + xhr.Entreprise[i].localite_entreprise + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </tr>';

                    } else if (recherche == xhr.Entreprise[i].Nom_entreprise || recherche == xhr.Entreprise[i].secteur_activite || recherche == xhr.Entreprise[i].competences_recherchees_dans_les_stages || recherche == xhr.Entreprise[i].nombre_de_stagiaires_CESI_deja_acceptes_en_stage || recherche == xhr.Entreprise[i].localite_entreprise) {
                        html += '<tr> <td> ' + xhr.Entreprise[i].Nom_entreprise + ' </td> <td> ' + xhr.Entreprise[i].secteur_activite + ' </td> <td > ' + xhr.Entreprise[i].competences_recherchees_dans_les_stages + ' </td> <td>' + xhr.Entreprise[i].nombre_de_stagiaires_CESI_deja_acceptes_en_stage + '</td> <td> ' + xhr.Entreprise[i].evaluation_des_stagiaires + ' </td><td> ' + xhr.Entreprise[i].confiance_du_Pilote_de_promotion + ' </td><td> ' + xhr.Entreprise[i].localite_entreprise + '</td> <td> <button type="button" class="btn btn-primary" id="Modifier_' + i + '">Modifier</button> </td> <td> <button type="button" class="btn btn-primary" id="Supprimer_' + i + '">Supprimer</button> </tr>';

                    }


                };
                document.getElementById("tableau").innerHTML = html;
                for (let i = 0; i < xhr.Entreprise.length; i++) {
                    if (recherche == xhr.Entreprise[i].Nom_entreprise || recherche == xhr.Entreprise[i].secteur_activite || recherche == xhr.Entreprise[i].competences_recherchees_dans_les_stages || recherche == xhr.Entreprise[i].nombre_de_stagiaires_CESI_deja_acceptes_en_stage || recherche == xhr.Entreprise[i].localite_entreprise) {

                        document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                            {
                                $("#nom").val(xhr.Entreprise[i].Nom_entreprise);
                                $("#siret").val(xhr.Entreprise[i].secteur_activite);
                                $("#Comp").val(xhr.Entreprise[i].competences_recherchees_dans_les_stages);
                                $("#nTel").val(xhr.Entreprise[i].nombre_de_stagiaires_CESI_deja_acceptes_en_stage);
                                $("#evals").val(xhr.Entreprise[i].evaluation_des_stagiaires);
                                $("#evalp").val(xhr.Entreprise[i].confiance_du_Pilote_de_promotion);
                                $("#ville").val(xhr.Entreprise[i].localite_entreprise);
                                document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
                                    {

                                        Update(i);
                                    }

                            }
                    } else if (recherche == "") {
                        for (let i = 0; i < xhr.Entreprise.length; i++) {
                            document.getElementById("Modifier_" + i + "").onclick = function() // Interception du click sur le bouton
                                {
                                    $("#nom").val(xhr.Entreprise[i].Nom_entreprise);
                                    $("#siret").val(xhr.Entreprise[i].secteur_activite);
                                    $("#Comp").val(xhr.Entreprise[i].competences_recherchees_dans_les_stages);
                                    $("#nTel").val(xhr.Entreprise[i].nombre_de_stagiaires_CESI_deja_acceptes_en_stage);
                                    $("#evals").val(xhr.Entreprise[i].evaluation_des_stagiaires);
                                    $("#evalp").val(xhr.Entreprise[i].confiance_du_Pilote_de_promotion);
                                    $("#ville").val(xhr.Entreprise[i].localite_entreprise);
                                    document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
                                        {

                                            Update(i);
                                        }

                                }
                        }


                        for (let i = 0; i < xhr.Entreprise.length; i++) {
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