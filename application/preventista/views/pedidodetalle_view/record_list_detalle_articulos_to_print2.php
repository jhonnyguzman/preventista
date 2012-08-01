<?php 
echo $title."\n";
echo str_pad("-", 47, '-', STR_PAD_RIGHT);
echo "\n".str_pad("Articulos", 30)."Cantidad";
echo "\n".str_pad("-", 47, '-', STR_PAD_RIGHT);

foreach($detallearticulos as $f){
 
 echo "\n".str_pad($f->articulos_descripcion, 32, '.', STR_PAD_RIGHT)."".$f->cantidadpedido;
} 
?>