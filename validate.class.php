<?php
class Validate {
    private $email;
    private $pass;
    public $erreur = [];

    function checkEmail($courriel) {
        //$this->email = "E-mail posté => " . $courriel;
        $this->email = trim($courriel);
        // Remplace les caractères spéciaux par leur équivalent en code HTML
        $this->email = htmlspecialchars($courriel);
        // échappe les caractère / et \
        $this->email = stripslashes($courriel);

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            // return false;// Erreur => e-mail invalide
            $this->erreur["email"] = "Veuillez entrer un email valide.";
        } else {
            return $this->email;
        }
    }

    function checkPassword($pass) {
        // La regex suivante pour les mots de passe
        //$regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";
        $regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[a-z]).{6,}$/";
        $this->pass = $this->clean($pass);
        if(!preg_match($regexPass, $this->pass)) {
            //return false;// Erreur => Mot de passe invalide
            $this->erreur["password"] = "Votre mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre et un caractère spécial.";
        } else {
            return password_hash(trim($this->pass), PASSWORD_DEFAULT);
        }
    }

    function clean($str) {
        $str = trim($str);
        // Remplace les caractères spéciaux par leur équivalent en code HTML
        $str = htmlspecialchars($str);
        // échappe les caractère / et \
        $str = stripslashes($str);
        return $str;
    }
}
?>