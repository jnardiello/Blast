<?php 

/////
// TESTING ENVIRONMENT
/////
require_once("../lib/URLParser.class.php");

define("__DEFAULT__", "Prova");

class Prova{
	public static $events=array("jacopo","veronica","rossella", "vito");

}


class error{
	public static $events=array("errore","alert");

}
if($_GET[error]!=true){
	$url="http://localhost/prova/jacopo/errore";
	$urlparser=new URLParser($url);
	$model=$urlparser->getModel();
}


/////
// END TESTING ENVIRONMENT
/////

echo "<pre>";
?>

<h1 style="margin-bottom: -20px;">URLParser Test</h1>

<table>
	<tr>
		<td></td>
		<td style="padding: 0 10px 0 10px;"><b>Type</b></td>
		<td><b>Var</b></td>
	</tr>
	<tr>
		<td><b>Input:</b></td>
		<td style="padding: 0 10px 0 10px;">String</td>
		<td>$url</td>
	</tr>
</table>
<h2 style="margin-bottom: -10px;">Public Interface</h2>
<table>
	<tr>
		<td><b>Method name</b></td>
		<td style="padding: 0 10px 0 10px;"><b>Type</b></td>
		<td><b>Args</b></td>
	</tr>
	<tr>
		<td>$object->getModel()</td>
		<td style="padding: 0 10px 0 10px;">String</td>
		<td>NONE</td>
	</tr>
	<tr>
		<td>$object->getEvent()</td>
		<td style="padding: 0 10px 0 10px;">String</td>
		<td>NONE</td>
	</tr>
	<tr>
		<td>$object->getParameters()</td>
		<td style="padding: 0 10px 0 10px;">Array</td>
		<td>NONE</td>
	</tr>
</table>

<h2 style="margin-bottom: -20px;">Communication Methods testing</h2>
<p><b>Input: </b><?php if($_GET[error]!=true) echo $url; ?>
<br /><b>Events Array: </b> <pre> <?php if($_GET[error]!=true)  print_r($model::$events); ?></pre></p>
<table>
	<tr><?php if($_GET[error]!=true)  echo "Modello: ".$urlparser->getModel()."\n"; ?></tr>
	<tr><?php if($_GET[error]!=true) echo "Evento: ".$urlparser->getEvent()."\n"; ?></tr>
	<tr><?php if($_GET[error]!=true){ echo "\nParametri \n"; print_r($urlparser->getParameters());} ?></tr>
	<tr><?php if($_GET[error]==true) echo "404 loaded"; ?></tr>
</table>
<?
echo "</pre>";
?>
<h2>Note:</h2>
<p>- La scelta ed assegnazione dell'evento avviene recuperando un array statico "Events" dal modello indicato nell'url. E' ammesso un solo evento, viene selezionato il primo che si parsa. Se ne seguono altri, vendono scartati.</p>
<p>- L'evento &egrave; letto inizialmente come parametro. Solo durante il parsing viene individuato come metodo, assegnato alla variabile privata "realEvent" e l'array dei parametri viene ricostruito.</p>