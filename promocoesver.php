<?php

require_once('../admin/Connections/localhost.php'); // chamada de banco de dados
setlocale(LC_MONETARY, 'pt_BR', 'ptb'); // mudança de moeda

$query_promo = @mysql_query("SELECT * FROM promo p INNER JOIN promocoes_galeria pg ON p.CD_ID=pg.ID_CARRO WHERE p.CD_ID = '".$_GET['idCarro']."'  AND p.CD_LIXO='0'  ") or die('ERR 001');
$arrPromo = array();
$PromoVerNumRows = mysql_num_rows($query_promo);
$PromoVer = mysql_fetch_array($query_promo);
$arrPromo[] = $PromoVer;

$query_promo_galeria = @mysql_query("SELECT * FROM promocoes_galeria WHERE ID_CARRO = '".$_GET['idCarro']."' ") or die('ERR 002');
$arrPromoGallery = array();
while ($PromoVerGlaeria = mysql_fetch_array($query_promo_galeria)) 
{
  $arrPromoGallery[] = $PromoVerGlaeria;
}

?>

<style>
    .de { font-size:1.2em; }
    .por { font-size:2em; }
    h2 { font-size:2.2em; }
</style>

<div id="banner">
    <!-- img src="img/banner4novo.png" width="100%" / -->
</div>

<div id="conteudo">
    <?php

    if($_GET['idCarro'] === $arrPromo[0][0])
    {
        foreach ($arrPromo as $Promocao)
        {
            $desconto = $Promocao[8] - $Promocao[9];
            echo
            ""
            . "<h2 style=\"font-size:1.5em\">" .htmlentities($Promocao[1])."</h2>"
            . "
            <article style=\"float:left; width:50%;\">
                ";

                if ($PromoVerNumRows > 1)
                {
                    echo "
                    <div class=\"cycle-slideshow\"
                    style=\"width:95%;\"
                    data-cycle-fx=scrollHorz
                    data-cycle-timeout=5000
                    data-cycle-pager=\"#adv-custom-pager\"
                    data-cycle-pager-template=\"<a href='#'><img src='{{src}}' width=80 style=padding:5px;></a>\"
                    >
                    ";

                    foreach ($arrPromoGallery as $galeria)
                    {
                        echo " <img src=\"".$galeria[2]."\" style=\"padding:5px; margin:5px;\" />";
                    }

                    echo "
                </div>
                <!-- empty element for pager links -->
                <div id=adv-custom-pager class=\"center external\"></div>";

            }
            else
            {
                echo " <img src=\"".$Promocao[17]."\" style=\"width:95%; padding:5px; margin:5px;\" />";
            }

            echo "
        </article>"
        . "<article style=\"float: left; width: 50%; padding: 25px 0; \">"
        . "<p> <strong>Marca:</strong> ".$PromoVer[2]." </p>"
        . "<p> <strong>Modelo:</strong> ".$PromoVer[3]." </p>"
        . "<p> <strong>Ano:</strong> ".$PromoVer[4]." / ". $PromoVer[5]." </p>"
        . "<p> <strong>Combustível:</strong> ".$PromoVer[10]."</p>"
        . "<p> <strong>Câmbio:</strong> ".$PromoVer[11]."</p>"
        . "<p> <strong>Quilometragem (Km):</strong> ". $PromoVer[12]."</p> "
        . "<img src=\"img/linha.png\">"
        . "<p> <strong>Descrição:</strong> </p> <p>".$PromoVer[6]."</p>"
        . '<img src="img/linha.png">';
        if ($PromoVer[8] == $PromoVer[9])
        {
            echo "<p> Por:  <strong class=\"por\">".money_format('%n', $PromoVer[9])."</strong></p>";
        }
        else
        {
            echo
            "<p> De: <strike class=\"de\" style=\"color:red;\"> " . money_format('%n', $PromoVer[8])." </strike> </p>"
            . "<p> Por: <strong class=\"por\">" .money_format('%n', $PromoVer[9])."</strong> </p>"
            . "<p style=\"color:green;\"> <strong>Bônus: ".money_format('%n', $desconto)."</strong> </p>";
        }
        echo "</article>";

    }
}
else
{
    echo "<h1 style=\"margin: 80px 5px ;\">Esta promoção não existe mais.</h1>";
}

?>

<img src="img/linha.png">

<p>&nbsp;</p>

<a href="?p=Promocoes">< Voltar</a>

<p>&nbsp;</p>

</div>

<!-- include jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<!-- include Cycle2 -->
<script src="js/jquery.cycle2.min.js"></script>
