<div class="contentPrinter">
<?php 
echo $title."<br>";
echo str_pad("-", 40, '-', STR_PAD_RIGHT);
echo "<br>".str_pad("Articulos", 30,' ')."Cantidad";
echo "<br>".str_pad("-", 40, '-', STR_PAD_RIGHT);

foreach($detallearticulos as $f){
 
 echo "<br>".str_pad($f->articulos_descripcion, 30, '.', STR_PAD_RIGHT)."".$f->cantidadpedido;
} 
?>

</div>

<style type="text/css">
.contentPrinter{
	font-size: 5pt;
	font-family: monospace;
}
</style>