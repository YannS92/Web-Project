document.addEventListener('DOMContentLoaded', function() {


    document.getElementById("Valider").onclick = function() // Interception du click sur le bouton
        {
            $.ajax({
                url: "http://localhost/Api_Beta/Entreprise/Cree.php",

                type: "POST",

                data: JSON.stringify({

                    Nom_entreprise: $("#nom").val(),
                    secteur_activite: $("#siret").val(),
                    competences_recherchees_dans_les_stages: $("#Comp").val(),
                    nombre_de_stagiaires_CESI_deja_acceptes_en_stage: $("#nTel").val(),
                    evaluation_des_stagiaires: $("#evals").val(),
                    confiance_du_Pilote_de_promotion: $("#evalp").val(),
                    localite_entreprise: $("#ville").val(),
                    ID_Utilisateur: "33"
                }),


                success: function(data) {
                    alert("Entreprise Crée Good job ")
                    console.log(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('#jquery_result').html('Error: ' + xhr.status);
                    console.log(thrownError);

                }
            })
            location.reload()


        };




})