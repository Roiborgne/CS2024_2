<?php
use App\Modele\Modele_Catalogue;
use App\Modele\Modele_Commande;
use App\Vue\Vue__CategoriesListe;
use App\Vue\Vue_Categories_Liste;
use App\Vue\Vue_Menu_Entreprise_Salarie;
use App\Vue\Vue_Produits_Info_Clients;
use App\Vue\Vue_Structure_BasDePage;
use App\Vue\Vue_Structure_Entete;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rgpd = $_POST["oui"];

}
if (isset($rgpd)){
    header('Location: /index.php?route=visiteur');
    //include "Controleur_visiteur.php";
}else{
    unset($_SESSION);
    session_destroy();
    echo "session détruite";
}