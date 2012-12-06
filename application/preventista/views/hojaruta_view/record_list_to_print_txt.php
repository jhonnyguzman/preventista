<?php 
	echo "Hoja de Ruta N°: ".$hojaruta->hojaruta_id."\n";
	echo str_pad("Fletero: ".$hojaruta->fleteros_apellnom, 39)."Fecha: ".$this->basicrud->formatDateToHuman($hojaruta->hojaruta_created_at)."\n";

	if(isset($hojarutadetalle) && is_array($hojarutadetalle) && count($hojarutadetalle)>0){
		
		echo str_pad("Cliente", 20, ' ', STR_PAD_RIGHT);
		echo str_pad("Trám.", 9, ' ', STR_PAD_RIGHT);
		echo str_pad("Imp.", 9, ' ', STR_PAD_RIGHT);
		echo str_pad("Mto. Recib.", 11, ' ', STR_PAD_RIGHT);
		//echo str_pad("Deudas", 8, ' ', STR_PAD_LEFT);
		echo "\n".str_pad("-",56,"-");

		foreach($hojarutadetalle as $f){
			echo "\n";	
			echo str_pad(word_limiter($f->clientes_apellido." ".$f->clientes_nombre, 4), 20, ' ', STR_PAD_RIGHT);
			echo str_pad($f->tramites_descripcion, 8, ' ', STR_PAD_RIGHT);
			echo str_pad("$ ".$f->peididos_montototal, 11, ' ', STR_PAD_RIGHT);
			echo str_pad(".", 6, '.', STR_PAD_RIGHT);

			/*if(is_array($f->tramites_id) && count($f->tramites_id) > 0){
				$i = 1;
				foreach ($f->tramites_id as $g) {
					if($i == 1){
						echo str_pad("$ ".$g->pedidos_montoadeudado, 11, ' ', STR_PAD_LEFT);	
					}else{
						echo "\n";
						echo str_pad("$ ".$g->pedidos_montoadeudado, 56, ' ', STR_PAD_LEFT);	
					}	
					$i++;
				}
				
			}*/

			echo "\n";
			echo " ".$f->clientes_direccion;	
		} 
		echo "\n\n".str_pad("-",56,"-");
	}else{
		echo "\nNo results!";
	}

	echo "\n";
?>