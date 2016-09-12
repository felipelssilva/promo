<?php
require_once('../admin/Connections/localhost.php'); // chamada do banco de dados
setlocale(LC_MONETARY, 'pt_BR', 'ptb'); // mudança monetaria para brasil

$start = 0;
$limit = 6;

if(isset($_GET['page']))
{
    $page = $_GET['page'];
    $start = ($page-1)*$limit;
}

$query_promo = @mysql_query("SELECT * FROM promo p INNER JOIN promocoes_galeria pg ON p.CD_ID=pg.ID_CARRO WHERE pg.CD_CAPA = '1' AND p.CD_LIXO='0'  ORDER BY p.CD_ID DESC LIMIT {$start} , {$limit} ") or die("ERR_PROM_001");
$arrPromo = array();

$total = ceil(mysql_num_rows($query_promo)/$limit);

while ($row = mysql_fetch_array($query_promo))
{
  $arrPromo[] = $row;
}

?>

<style type="text/css">

  #conteudo p {
    padding: 3px;
}  

</style>

<div id="banner"><img src="img/banner4novo.png" width="100%" /></div>

<div id="conteudo" >

    <h2>Promoções</h2>

    <p>Veja as promoções da San Marco Veículos e escolha o seu novo FIAT.</p>

    <p><img src="img/linha.png"></p>    
    
    <?php
	if (mysql_num_rows($query_promo) < 1)
	{
		echo "<h1 style=\"font-size: 2em; color: darkred; margin: 20px 20px 80px 20px; padding: 20px;\"><center>NENHUM RESULTADO FOI ENCONTRADO, VOLTE EM BREVE.</center></h1>";
	}
	else
	{
		
		

		foreach ($arrPromo as $promocoes)
		{
			echo
			"
			<article id=\"promocoes\">
				<h2 style=\"margin-bottom:15px\">
					<a href=\"?p=PromocoesVer&idCarro={$promocoes[0]}\">
						" .htmlentities($promocoes[1])."
					</a>
				</h2>
				<a href=\"?p=PromocoesVer&idCarro={$promocoes[0]}\">
					<div class=\"img-promo\" style=\"background-image:url('".$promocoes[17]."'); \">&nbsp;</div>
					<div class=\"texto-img-promo\">
						<p> Por: <strong>" .money_format('%n', $promocoes[9])."</strong> <br>
							<small> Clique aqui e veja mais sobre este carro </small> </p>
						</div>
					</a>
				</article>
				";
		}
		
		
		
	}

        echo "<img src=\"img/linha.png\"><br clear=\"all\"><br> Páginas: <br> <br clear=\"all\"> ";
		
        if($page>1)
        {
            echo "<a href='?p=Promocoes&page=".($page-1)."' class='button'>Anterior</a>";
        }
		
        if($page!=$total)
        {
            echo "<a href='?p=Promocoes&page=".($page+1)."' class='button'>Próxima</a>";
        }

        echo "<ul class='page'>";
		
        for($i=1;$i<=$total;$i++)
        {
            if($i==$page) 
			{ 
				echo "<li class='current'>".$i."</li>"; 
			}
            else
			{
				echo "<li><a href='?p=Promocoes&page=".$i."'>".$i."</a></li>";
			}
        }
		
        echo "</ul>";
        
		?>

    </div>
