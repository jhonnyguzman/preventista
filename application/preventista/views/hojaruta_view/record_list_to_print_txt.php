<?php 
	echo str_pad("Hoja de Ruta N°: ".$hojaruta->hojaruta_id, 39)."\n";
	echo str_pad("Fletero: ".$hojaruta->fleteros_apellnom, 39)."Fecha: ".$this->basicrud->formatDateToHuman($hojaruta->hojaruta_created_at)."\n";

	if(isset($hojarutadetalle) && is_array($hojarutadetalle) && count($hojarutadetalle)>0){
		
		echo str_pad("Cliente", 23, ' ', STR_PAD_RIGHT);
		echo str_pad("Trám.", 10, ' ', STR_PAD_RIGHT);
		echo str_pad("Imp.", 10, ' ', STR_PAD_RIGHT);
		echo str_pad("Monto Recib.", 10, ' ', STR_PAD_RIGHT);
		echo "\n".str_pad("-",56,"-");

		foreach($hojarutadetalle as $f){
			echo "\n";	
			echo str_pad($f->clientes_apellido." ".$f->clientes_nombre, 23, ' ', STR_PAD_RIGHT);
			echo str_pad($f->tramites_descripcion, 10, ' ', STR_PAD_RIGHT);
			echo str_pad("$ ".$f->peididos_montototal, 10, ' ', STR_PAD_RIGHT);
			echo str_pad(".", 6, '.', STR_PAD_RIGHT);
			echo "\n";	
			echo $f->clientes_direccion;
		} 
		echo "\n".str_pad("-",56,"-");
	}else{
		echo "\nNo results!";
	}

	echo "\n";
?>