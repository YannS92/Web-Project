document.addEventListener('DOMContentLoaded', function() {
document.getElementById("search").onclick = function() // Interception du click sur le bouton
{

    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/Api_Beta/Utilisateurs/Administrateur/Lire.php", true);
    xhr.onload = function() {
        var html = "";
        var i;
        if (xhr.status == 200) {
            xhr = JSON.parse(xhr.responseText); //fichier objet
        } else {}

        html += '<fieldset><legend>' + xhr.Administrateur[0].ID_Utilisateur + '' + xhr.Administrateur[0].NOM + ' ' + xhr.Administrateur[0].PRENOM + '</legend><p>' + xhr.Administrateur[0].Login + ' ' + xhr.Administrateur[0].Mot_de_passe + ' </p></fieldset>';
        document.getElementById("js_result").innerHTML = html;

    };
    xhr.send(); //Envoi de la requête au serveur (asynchrone par défaut)
});