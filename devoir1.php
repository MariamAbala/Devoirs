Binome : ABALA Mariam -- HAMDANI Khalid
Groupe : G4

Exercice 1 :

<!DOCTYPE HTML>
<html>
    <head>
        <title>Page d'Accueil </title>
    </head>
    <body>
        <h1 style="text-align:center">Délice des Fruits & Légumes </h1>
        <table width=100%>
            <tr>
                <?php
                      $pictures = array ("image1.jpg", "image2.jpg", "image3.jpg","image4.jpg", "image5.jpg","image6.jpg") ;
                      shuffle($pictures);

                      for ($i=0;$i<3;$i++)
                        {
                            echo "<td align = 'center'> <img  style='margin-top:100px;' src = \"" ;
                            echo $pictures [$i] ;
                            echo " \" width = '200' height = '150' </td>" ;
                        }
                ?>
            </tr>
        </table>
    </body>
</html>

Exercice 2 :

<!DOCTYPE HTML>
<html>
    <head>
        <title>Commandes </title>
    </head>
    <body>
        <?php
            echo "<br/> <br/>" ;
            $Commandes = file ("Commandes.txt") ;
            $Nb_Commandes = count($Commandes) ;

            for ($i=0;$i<$Nb_Commandes;$i++)
            {
                echo "<p> <b>" . $Commandes [$i] . "</b> </p>" ;
            }

        ?>
    </body>
</html>

Exercice 3 :

<!DOCTYPE HTML>
<html>
    <head>
        <title> Centrale d'achats - Commande clients </title>
    </head>
    <body>

        <br/> <br/>     
        <h1>Centrale d'achats</h1>
        <h2> Commande clients </h2>

        <?php
            $Commandes = file ("Commandes.txt") ;
            $Nb_Commandes = count ($Commandes) ;

            echo "<table width=100% border = 1>\n" ;
            echo "<tr><th bgcolor = \"#AED6F7\" <b> Numéro de commande </b></td>
                  <th bgcolor = \"#AED6F7\"> <b> Numéro Client </b></td>
                  <th bgcolor = \"#AED6F7\"> <b> Date de commande  </b></td>
                  <th bgcolor = \"#AED6F7\"> <b> Désignation article</b> </td>
                  <th bgcolor = \"#AED6F7\"> <b> Quantité (Pal)</b></td>
                  <th bgcolor = \"#AED6F7\"> <b> Prix unitaire (Dh)</b> </td>
                  <th bgcolor = \"#AED6F7\"> <b> Date de livraison</b></td>
                  <th bgcolor = \"#AED6F7\"> <b> Adresse Client</b></td>
                  </tr>" ;

                for ($i=0;$i<$Nb_Commandes;$i++)
                    {
                        $line = explode("|", $Commandes[$i]) ;

                        echo "<tr><td  align = center> " .$line[0]. "</td>
                              <td  align = center>" .$line[1]. "</td>
                              <td  align = center>" .$line[2]. "</td>
                              <td  align = center>".$line[3]. "</td>
                              <td  align = center>" .$line[4]. "</td>
                              <td  align = center>" .$line[5]. "</td>
                              <td  align = center>" .$line[6]." </td>
                              <td  align = center>".$line[7]." </td>
                              </tr>" ;
                    }
                echo "</table>" ;
        ?>
    </body>
</html>
