<?php 
	echo str_pad("Remito N°: ".$remito[0]->remitos_id,31)."Fecha: ".$remito[0]->remitos_created_at."\n";
	echo "Cliente: ".$pedido[0]->clientes_apellido." ".$pedido[0]->clientes_nombre."\n";
	echo "Fletero: ".$hojaruta->fleteros_apellnom."\n";

	if(isset($pedidodetalle) && is_array($pedidodetalle) && count($pedidodetalle)>0)
	{
		
		echo str_pad("Articulo", 20, ' ', STR_PAD_RIGHT);
		echo str_pad("Cant.", 6, ' ', STR_PAD_RIGHT);
		echo str_pad("Precio U.", 12, ' ', STR_PAD_RIGHT);
		echo "Subt.";
		//echo "\n".str_pad(".",56,".");
		echo "\n";	
		
		foreach($pedidodetalle as $f){
			echo "\n";	
			echo str_pad(word_limiter($f->articulos_descripcion, 4), 20, ' ', STR_PAD_RIGHT);
			echo str_pad($f->pedidodetalle_cantidad, 6, ' ', STR_PAD_RIGHT);
			echo str_pad("$ ".$f->articulos_precio, 12, ' ', STR_PAD_RIGHT);
			echo "$ ".$f->pedidodetalle_subtotal;
		} 
		echo "\n".str_pad(' ', 29)."Total: $ ".$pedido[0]->peididos_montototal;

		//remitos adeudados
		if(count($pedidosadeudados) > 0)
		{
			echo "\nRemitos Adeudados";
			foreach($pedidosadeudados as $f){
				echo "\n";
				echo str_pad(' ', 4,' ', STR_PAD_RIGHT);
				echo str_pad($f->remitos_id, 8, ' ', STR_PAD_RIGHT);
				echo str_pad($this->basicrud->formatDateToHuman($f->remitos_created_at), 16, ' ', STR_PAD_RIGHT);
				if($f->pedidos_montoadeudado > 0)
					echo "$ ".$f->pedidos_montoadeudado;
				else
					"$ ".$f->peididos_montototal;
			}
		}

		echo "\n".str_pad(' ', 17)."Saldo C/C: $ ".$saldocliente;
		echo "\n".str_pad(' ', 6)."Saldo + Total Pedido: $ ".($saldocliente + $pedido[0]->peididos_montototal);

		echo "\n".str_pad(".",47,".");

		//Comprobante de entrega
		echo "\n";
		echo str_pad("Remito N°: ".$remito[0]->remitos_id, 31)."Fecha: ".$remito[0]->remitos_created_at."\n";
		echo "Cliente: ".$pedido[0]->clientes_apellido." ".$pedido[0]->clientes_nombre."\n";
		echo str_pad("Fletero: ".$hojaruta->fleteros_apellnom, 39)."\n";
		echo str_pad(' ', 20)."Total Pedido: $ ".$pedido[0]->peididos_montototal."\n";
		echo str_pad(' ', 23)."Saldo C/C: $ ".$saldocliente."\n";
		echo str_pad(' ', 27)."Deuda: $ ".($saldocliente + $pedido[0]->peididos_montototal)."\n";
		echo str_pad("Firma Cliente: ", 30,'.')."\n";

		echo "\n".str_pad("-",47,"-");

	}else{
		echo "\nNo results!";
	}

	echo "\n";

?>