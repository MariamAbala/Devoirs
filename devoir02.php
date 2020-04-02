Binome: Khalid HAMDANI & Mariam ABALA
Groupe : 04


Exercice 1 :

<?php
  function couper_chaine($string, $car) {
      $start=0;
      $array=array();
      for($i=0;$i<strlen($string);$i++){
          $pos=strpos($string,$car,$i);
          if($string[$i]==$car){
              $array[]=substr($string,$start,$pos-$start);
              $start=$pos+1;
          }
      }
      foreach($array as $key => $value){
          echo "{$key} => {$value} <br> ";
      }
  }
  couper_chaine("Créer une fonction qui prend en paramètre une chaîne string et un délimiteur car "," ");
?> 

Exercice 2:

<?php

$myFile = "commandes.txt";
//séparer les lignes de fichier commandes en utilisant une array
$lines = file($myFile);

for ($i=0; $i < count($lines) ; $i++)
{ 
    //séparer les informations de chaque ligne de commande en utilisant une array
    $data = explode("|", $lines[$i]);
    try{
        if($data[1] == "CLI1001")
        {
            //récuperer les informations si elles existent déjà dans le fichier
            $dataFile = file_exists("pscde01_CLI1001.txt") ? file_get_contents("pscde01_CLI1001.txt") : "";
            $dataFile .= $lines[$i] . "\n";
            //ajouter les informations au fichier et les sauvegarder
            file_put_contents("pscde01_CLI1001.txt", $dataFile, LOCK_EX);
        }
        else if($data[1] == "CLI1004")
        {
            //récuperer les informations si elles existent déjà dans le fichier
            $dataFile = file_exists("psccl01_CLI1004.txt") ? file_get_contents("psccl01_CLI1004.txt") : "";
            $dataFile .= $lines[$i] . "\n";
            //ajouter les informations au fichier et les sauvegarder
            file_put_contents("psccl01_CLI1004.txt", $dataFile, LOCK_EX);
        }  else {
            throw new Exception ("C'est un nouveau client .");
        }
    }catch(Exception $e){
        echo "", $e->getMessage(),"\n";
    }  
}
?>
Exercice 3:
--SaisieDate.php--

<!DOCTYPE html>
<html>
    <head>
        <title> Date </title>
    </head>
    <body>
        <form method="post" action="valideDate.php">
            <h1>Choisir une date </h1>
            <label><b>Jour &emsp; </b></label>
            <label><b>Mois &emsp; </b></label> 
            <label><b>Année</b></label><br/>
            <select name="list_jours">
                <?php
                    for ($i=1;$i<=31;$i++)
                        {    
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                ?>
            </select>&emsp; 
            <select name="list_mois">
                <?php
                    for ($i=1;$i<=12;$i++)

                        {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                ?>
            </select>&emsp; 
            <select name="list_annees">
                <?php
                    for ($i=1900;$i<=2020;$i++)    
                        {
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                ?>
            </select> <br/><br/>
            <input type="submit" name="envoi" value="Envoyer" /> 
        </form>         
    </body>
</html>

--valideDate.php--

<!DOCTYPE html>
<html>
    <head>
        <title> Date </title>
    </head>
    <body>
    <h1>Validation de la date </h1>
    <?php
        if ( isset( $_POST['envoi'] ) ) {
            $jour=$_POST["list_jours"];
            $mois=$_POST["list_mois"];
            $annee=$_POST["list_annees"];
            echo'<label>La date saisie est : <b>'.$jour.'/'.$mois.'/'.$annee.'<b/></label><br/>';
            $check=checkdate($mois,$jour,$annee);
            try{
                if(!$check){
                    throw new Exception('Date Invalide.');
                } else {
                    echo'<label><b>La date saisie </b></label><label style="color:green;"> <b>est Valide.</b></label><br/>';
                }
            }
            catch (Exception $e){
                echo 'L\'année '.$annee.' est non bissextile : <label style="color:red;">', $e->getMessage(), "</label>\n";     
            }
        }      
    ?>
    </body>
</html>

Exercice 4:
--Accueil.php--
<!DOCTYPE html>
<html>
    <head>
        <title>Accueil </title>
    </head>
    <body>
        <h1>Accueil </h1>
        <form method="post" action="Authentification.php">
            <label>Email :</Label><br/>
            <input type="email" name="email" /><br/>
            <label>Mot de passe :</Label><br/>
            <input type="password" name="mot_de_passe" /><br/>
            <input type="submit" name="envoi" value="Valider" /> 

        </form>
    </body>
</html>

--Authentification.php--
<!DOCTYPE html>
<html>
    <head>
        <title>Authentification </title>
    </head>
    <body>
        <h1>Authentification </h1>
        <?php
            function validate_password(){
                $password=$_POST['mot_de_passe'];
                $pattern='#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#';
                if(preg_match($pattern, $password)) {
                    return TRUE;
                } else{
                    return FALSE;
                }
            }
            function validate_email(){
                $email=$_POST['email'];
                $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
                if(preg_match($pattern, $email)) {
                    return TRUE;
                } else{
                    return FALSE;
                }
            }
            try{
                if ( isset( $_POST['envoi'] ) ) { 
                    $email=$_POST["email"];
                    $password=$_POST["mot_de_passe"];
                    $fp=file("login.txt");
                    $nb=count($fp);
                    if(!validate_email()){
                        throw new Exception (" Email n'est pas validé.<br>");
                    }else if(!validate_password()){
                        throw new Exception (" Mot de passe n'est pas validé.<br>");
                    }else 
                    {
                        $emailExist = false;
                        $passwordExist = false;
                        $sameOnes = false;
                        for ($i=0;$i<$nb;$i++)
                        {
                            $line = explode("|", $fp[$i]) ;
                            if(strpos($line[0],$email) !== false){
                                $emailExist = true;
                                if(strpos($line[1],$password) !== false){
                                    $passwordExist = true;
                                    $sameOnes = true;
                                    break;
                                }
                                else
                                    $passwordExist = false;
                            }
                            else
                                $emailExist = false;
                        }
                        if($sameOnes)
                        {
                            echo "Authentification réussie. <br>";
                        }
                        else
                        {
                            if(!$emailExist)
                                echo "Email invalide .<br>";
                            else if(!$passwordExist)
                                echo "Mot de passe invalide.<br>";
                        }
                    }
                }
            }catch(Exception $e){
                echo "", $e->getMessage(),"\n";
            }    
      ?>
    </body>
</html>