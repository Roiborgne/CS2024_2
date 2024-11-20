<?php
namespace App\Fonctions;
    use function PHPUnit\Framework\throwException;

    function Redirect_Self_URL():void{
        unset($_REQUEST);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }

function GenereMDP($nbChar) :string{

    return "secret";
}

function CalculComplexiteMdp($mdp):int{
    $longueur = strlen($mdp)                                                                                                                         ;
    $point_min = 0;
    $point_maj = 0;
    $point_chiffre = 0;
    $point_caracteres= 0;

// On fait une boucle pour lire chaque lettre
    for($i = 0; $i < $longueur; $i++) 	{

        // On sélectionne une à une chaque lettre
        // $i étant à 0 lors du premier passage de la boucle
        $lettre = $mdp[$i];

        if ($lettre>='a' && $lettre<='z'){
            // On rajoute le bonus pour une minuscule
            $point_min = 26;
        }
        else if ($lettre>='A' && $lettre <='Z'){
            // On rajoute le bonus pour une majuscule
            $point_maj = 26;
        }
        else if ($lettre>='0' && $lettre<='9'){
            // On rajoute le bonus pour un chiffre
            $point_chiffre = 10;
        }
        else {
            // On rajoute le bonus pour un caractère autre
            $point_caracteres = 23;
        }
    }

// Calcul du coefficient de la diversité des types de caractères...
    $etape2 = $point_min + $point_maj + $point_chiffre + $point_caracteres;
// Multiplication du résultat par la longueur de la chaîne
    return round($longueur * log($etape2, 2));
}

function changerMDP($mdp) :string{
        if (CalculComplexiteMdp($mdp)< 90){
            throw new \InvalidArgumentException("Le mot de passe doit être plus sécurisé");
        } else {
            $_SESSION['success'] = "Le mdp est suffisament sécurisé !";
            return $mdp;
        }
}