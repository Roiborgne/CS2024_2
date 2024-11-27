<?php
function passgen1($nbChar) {
    $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
    srand(random_int(000000, 999999 ));
    $pass = '';
    for($i=0; $i<$nbChar; $i++){
        $pass .= $chaine[rand()%strlen($chaine)];
    }
    return $pass;
}
//function dico (){
//    $dico = [];
//    for ($i = 0; $i < 999999 ; $i++) {
//        $dico[] = passgen1(10, $i);
//    }
//    return $dico;
//}
//var_dump(dico());
//echo "\n";

//Création de la séquence aléatoire à la base du mot de passe
$octetsAleatoires = openssl_random_pseudo_bytes (8) ;
//Transformation de la séquence binaire en caractères alpha
$motDePasse = sodium_bin2base64($octetsAleatoires, SODIUM_BASE64_VARIANT_ORIGINAL);
echo $motDePasse;

//echo passgen1(10);