<?php

namespace App\Modele;

use App\Utilitaire\Singleton_ConnexionPDO;

class Modele_Jeton
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
public function genererValeurToken(){

    $octetsAleatoires = openssl_random_pseudo_bytes(256);
    return sodium_bin2base64($octetsAleatoires, SODIUM_BASE64_VARIANT_ORIGINAL);
}
    // Méthode pour insérer un nouveau jeton
    public function insertJeton($codeAction, $idUtilisateur){

        $valeur = $this->genererValeurToken();
        $sql = "INSERT INTO token (valeur, codeAction, idUtilisateur, dateFin) VALUES (:valeur, :codeAction, :idUtilisateur, :dateFin)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':valeur' => $valeur,
            ':codeAction' => $codeAction,
            ':idUtilisateur' => $idUtilisateur,
            ':dateFin' => date('Y-m-d H:i', strtotime('+2 hour'))
        ]);
        return $valeur;
    }

    // Méthode pour valider un jeton
    public function validerJeton($valeur)
    {
        $sql = "SELECT * FROM token WHERE valeur = :valeur AND dateFin > NOW()";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valeur' => $valeur]);
        return $stmt->fetch();
    }

    // Méthode pour invalider un jeton
    public function invaliderJeton($valeur)
    {
        $sql = "DELETE FROM token WHERE valeur = :valeur";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valeur' => $valeur]);
    }







}