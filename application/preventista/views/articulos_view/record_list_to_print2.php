<?php 
	echo str_pad($title, 39)."Fecha: ".$todayDate."\n";
	if(isset($articulos) && is_array($articulos) && count($articulos)>0){
		foreach($fieldstoprint as $field){
			if($field == "articulos_descripcion")
				echo str_pad($this->config->item($field), 18, ' ', STR_PAD_RIGHT);
			else
				echo str_pad($this->config->item($field), 10, ' ', STR_PAD_RIGHT);
		}
		echo "\n".str_pad("-",56,"-");
		foreach($articulos as $f){
			echo "\n";
			foreach($fieldstoprint as $field){
				if($field == "articulos_descripcion")
					echo str_pad($f->$field, 18, ' ', STR_PAD_RIGHT);
				else
					echo str_pad($f->$field, 10, ' ', STR_PAD_RIGHT);
			} 
		}
	}else{
		echo "\nNo results!";
	}

?>
