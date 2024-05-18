// Exemple de script JavaScript

// Attend que le document soit prêt
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionne un élément avec l'ID "myButton" et ajoute un écouteur d'événements pour le clic
    var myButton = document.getElementById('myButton');
    if (myButton) {
        myButton.addEventListener('click', function() {
            // Actions à effectuer lorsque le bouton est cliqué
            alert('Le bouton a été cliqué !');
        });
    }

    // Autres scripts JavaScript ...
});
