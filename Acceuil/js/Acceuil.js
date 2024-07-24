document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("bouton_connexion").onclick = function() // Interception du click sur le bouton
        {
            var Login = $("#Adresse_email").val();
            var Password = $("#mdp").val();
            var boul = true;

            var xhr = new XMLHttpRequest();
            xhr.open("GET", "http://localhost/Api_Beta/Utilisateurs/Administrateur/Lire.php", true);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    xhr = JSON.parse(xhr.responseText); //fichier objet
                } else {}
                for (let i = 0; i < xhr.Administrateur.length; i++) {
                    if (Login == xhr.Administrateur[i].Login && Password == xhr.Administrateur[i].Mot_de_passe) {
                        alert("connexion établie");
                        boul = false;
                        document.location.href = "http://localhost/projet_web-Site-Web/Acceuil/Acceuil_site_Cesi_Emplois.html"
                    }
                };
                if (boul) {
                    alert("Login ou mot de passe incorrecte");

                };

            };
            xhr.send(); //Envoi de la requête au serveur (asynchrone par défaut)

        };
})