<?php 

for($i=$nro_from; $i < $nro_to; $i++)
{
	echo str_pad("Recibo N°: ".$i, 36,' ',STR_PAD_RIGHT)."Fecha: .../.../......\n";
	echo str_pad("Recibí de: ", 57,'.',STR_PAD_RIGHT)."\n";
	echo str_pad("La suma de: ", 27,'.',STR_PAD_RIGHT)."En concepto de pago de deuda.\n";
	echo "\n";
	echo str_pad(' ', 20,' ',STR_PAD_RIGHT);
	echo str_pad("Firma: ", 36,'.',STR_PAD_RIGHT)."\n";

	echo "\n".str_pad("-",56,"-");
	echo "\n";
}


?>