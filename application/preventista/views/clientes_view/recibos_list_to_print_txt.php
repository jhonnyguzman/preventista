<?php 

for($i=$nro_from; $i < $nro_to; $i++)
{
	echo str_pad("Recibo N°: ".$i, 27,' ',STR_PAD_RIGHT)."Fecha: .../.../......\n";
	echo str_pad("Recibí de: ", 48,'.',STR_PAD_RIGHT)."\n";
	echo str_pad("La suma de: ", 20,'.',STR_PAD_RIGHT)."En concepto de pago de deuda.\n";
	echo "\n";
	echo str_pad(' ', 17,' ',STR_PAD_RIGHT);
	echo str_pad("Firma: ", 30,'.',STR_PAD_RIGHT)."\n";

	echo "\n".str_pad("-",47,"-");
	echo "\n";
}


?>