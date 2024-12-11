<?php
namespace App\Fonctions;
use App\Modele\Modele_Jeton;
use App\Modele\Modele_Utilisateur;
use App\Vue\Vue_Mail_Confirme;
use App\Vue\Vue_Mail_ReinitMdp;
use PDO;
use function PHPUnit\Framework\throwException;
include "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;

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

function envoyerMail()
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = '127.0.0.1';
    $mail->Port = 1025; //Port non crypté
    $mail->SMTPAuth = false; //Pas d’authentification
    $mail->SMTPAutoTLS = false; //Pas de certificat TLS
    $mail->setFrom('test@labruleriecomtoise.fr', 'admin');
    $mail->addAddress('client@labruleriecomtoise.fr', 'Mon client');
    if ($mail->addReplyTo('test@labruleriecomtoise.fr', 'admin')) {
        $mail->Subject = 'Objet : Nvx mdp';
        $mail->isHTML(false);
        $mail->Body = "secret";//$this->token();

        if (!$mail->send()) {
            $msg = 'Désolé, quelque chose a mal tourné. Veuillez réessayer plus tard.';
        } else {
            $msg = 'Message envoyé ! Merci de nous avoir contactés.';
        }
    } else {
        $msg = 'Il doit manquer qqc !';
    }
    echo $msg;
}
function envoyerMailToken($tokenValeur,  $email)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = '127.0.0.1';
        $mail->Port = 1025; //Port non crypté
        $mail->SMTPAuth = false; //Pas d’authentification
        $mail->SMTPAutoTLS = false; //Pas de certificat TLS

        $mail->setFrom('test@labruleriecomtoise.fr', 'admin');
        $mail->addAddress($email, 'Mon client');
        if ($mail->addReplyTo('test@labruleriecomtoise.fr', 'admin')) {
            $mail->Subject = 'Objet : Nvx mdp';
            $mail->isHTML(true);

            $mail->Body = "Veuillez cliquer sur le lien pour réinitialiser votre mdp : <a href='http://localhost:8000/index.php?action=token&token=".urlencode($tokenValeur)."'>Lien à cliquer </a>"; //$this->token();

            if (!$mail->send()) {
                $msg = 'Désolé, quelque chose a mal tourné. Veuillez réessayer plus tard.';
            } else {
                $msg = 'Message envoyé ! Merci de nous avoir contactés.';
            }
        } else {
            $msg = 'Il doit manquer qqc !';
        }
        echo $msg;
    }
}
