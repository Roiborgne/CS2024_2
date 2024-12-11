<?php

use App\Modele\Modele_Jeton;

require_once '../src/Modele/Modele_Jeton.php';

$db = new PDO('mysql:host=localhost;dbname=cs_2024_cafe', 'root', ''); //dbname peut être différent

$modeleJeton = new Modele_Jeton($db);


$modeleJeton->insertJeton(1, 123);

// Valider un jeton
$valeur = "4GM3YjlsYLAwlluoqh/XmtDclxfzkRMbP++34LyvdQTYf4lyO/6eRKWcPcODhGa+GMLxYRpOhR+gHoF3HXBiVToNKPHZLYubBqCZpdTObUCdR8KAyNL0JvXd4hUL8xhQCfU8IO0u/suWCiFaFspC9mEG11o8HYUB5SwjBxpLiyxb/NSXhfS1/vuu91jkQJRU/PP5fO7JngOox9KvHOH9pvWB2HJySmjXadE24xy0WpBCRNaTiFHy3ENa2xp733GimsO3ipuYxCfKDvN8NzbGFnBl7uZhldkwA/FFPQLIrtBg1VzsOE+pkxhd4qggKqTg493o6a0f3ltAomkM/NJr+A==";
$result = $modeleJeton->validerJeton($valeur);
echo $result ? "Jeton valide\n" : "Jeton invalide\n";

// Invalider un jeton
$valeur = "Xl5qmF/Crcw+M/eFzqmC/aBvR1X7HFFGlNHVG8NgoSJbgXKlPQB315fCerH0/ZRiX20NPlAJVI0c0OESCGHSvhc7TJ4XP5+YBhMYjvdtEr9/PH7s4lEplLT9IabADQCJolSfEgzTeVXXGF8NSFWeo4ZbCU1KX3t/cGbWMjDGg+zhO4ADy0f4MdbkAsTzIsSV7l7MN4hWRhr+j5DbJC/PTbgbw9bOgkKy5PD/pQ6OvFuXy2z2QDuhizncZ9H34lx5opR2h+nt+rt9NsszNTQjsXBwC7IAVaR5Sgl1MeMN8i1f7rpKQDjMPK1Z6W7Qmj9yp5062hFrtnsOVY8xkuENmQ==";
$modeleJeton->invaliderJeton($valeur);