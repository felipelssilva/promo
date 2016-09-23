
<?php

class Car
{
    var $name;
    var $img;
    var $link;
		
    public function blockCar($name, $img, $link)
    {
		$fiatLink = "http://www.fiat.com.br";
		
        $block = "
        <li>
            <a href=\"{$link}\" target=\"_blank\" title=\"Monte este carro - {$name} \">
                <img src=\"{$fiatLink}{$img}\" alt=\"{$name}\" width=\"200\">
                <span class=\"modelo\"> ".strtoupper($name)." </span>
            </a>
        </li>
        ";

        return $block;
    }

}


$car = new Car;

$initial = 1; // value initial of count cars
$end = 22; // count of cars

$idCar = 1;
$Cars[$idCar][name]  = "Toro";
$Cars[$idCar][link]  = "http://www.fiat.com.br/carros/toro.html";
$Cars[$idCar][img]   = "/content/dam/fiat-brasil/desktop/produtos/modelos/226/thumb-lateral/226-p2.jpg";
.
.
.
$idCar = 22;
$Cars[$idCar][name]  = "Ducato Passageiro";
$Cars[$idCar][link]  = "http://www.fiat.com.br/carros/ducato-passageiro.html";
$Cars[$idCar][img]   = "/content/dam/fiat-brasil/desktop/produtos/modelos/245/thumb-lateral/245-p2.jpg";

?>



<div id="banner"><img src="img/carros_novos/topo.png" width="100%" /></div>

<div id="conteudo">

    <h2>Carros Novos</h2>

    <p>TEXTO DESCRIÇÃO DA PAGINA</p>

    <img src="img/linha.png" />


    <div align="center">

        <ul id="listagem_modelos" class="clearfix">
            <?php
            for ($i=$initial;$i<=$end;$i++)
            {
                print_r ($car->blockCar($Cars[$i][name], $Cars[$i][img], $Cars[$i][link]));
            }
            ?>
        </ul>

    </div>

    <p>&nbsp;</p>

</div>
