<?php 
	echo "Remito N°: ".$remito[0]->remitos_id."\n";
	echo "Cliente: ".$pedido[0]->clientes_apellido." ".$pedido[0]->clientes_nombre."\n";
	echo str_pad("Fletero: ".$hojaruta->fleteros_apellnom, 39)."Fecha: ".$remito[0]->remitos_created_at."\n";

	if(isset($pedidodetalle) && is_array($pedidodetalle) && count($pedidodetalle)>0)
	{
		
		echo str_pad("Articulo", 23, ' ', STR_PAD_RIGHT);
		echo str_pad("Cant.", 7, ' ', STR_PAD_RIGHT);
		echo str_pad("Precio U.", 10, ' ', STR_PAD_RIGHT);
		echo str_pad("Subt.", 10, ' ', STR_PAD_RIGHT);
		//echo "\n".str_pad(".",56,".");
		echo "\n";	
		
		foreach($pedidodetalle as $f){
			echo "\n";	
			echo str_pad($f->articulos_descripcion, 23, ' ', STR_PAD_RIGHT);
			echo str_pad($f->pedidodetalle_cantidad, 7, ' ', STR_PAD_RIGHT);
			echo str_pad("$ ".$f->articulos_precio, 10, ' ', STR_PAD_RIGHT);
			echo str_pad("$ ".$f->pedidodetalle_subtotal, 10, ' ', STR_PAD_RIGHT);
		} 
		echo "\n".str_pad(' ', 30)."Total: $ ".$pedido[0]->peididos_montototal;

		//remitos adeudados
		if(count($pedidosadeudados) > 0)
		{
			echo "\nRemitos Adeudados";
			foreach($pedidosadeudados as $f){
				echo "\n";
				echo str_pad(' ', 7,' ', STR_PAD_RIGHT);
				echo str_pad($f->remitos_id, 15, ' ', STR_PAD_RIGHT);
				echo str_pad($this->basicrud->formatDateToHuman($f->remitos_created_at), 15, ' ', STR_PAD_RIGHT);
				if($f->pedidos_montoadeudado > 0)
					echo str_pad("$ ".$f->pedidos_montoadeudado, 10, ' ', STR_PAD_RIGHT);
				else
					echo str_pad("$ ".$f->peididos_montototal, 10, ' ', STR_PAD_RIGHT);
			}
		}

		echo "\n".str_pad(' ', 26)."Saldo C/C: $ ".$saldocliente;
		echo "\n".str_pad(' ', 15)."Saldo + Total Pedido: $ ".($saldocliente + $pedido[0]->peididos_montototal);

		echo "\n".str_pad(".",56,".");

		//Comprobante de entrega
		echo "\n";
		echo str_pad("Remito N°: ".$remito[0]->remitos_id, 39)."Fecha: ".$remito[0]->remitos_created_at."\n";
		echo "Cliente: ".$pedido[0]->clientes_apellido." ".$pedido[0]->clientes_nombre."\n";
		echo str_pad("Fletero: ".$hojaruta->fleteros_apellnom, 39)."\n";
		echo str_pad(' ', 33)."Total Pedido: $ ".$pedido[0]->peididos_montototal."\n";
		echo str_pad(' ', 36)."Saldo C/C: $ ".$saldocliente."\n";
		echo str_pad("Firma Cliente: ", 40,'.')."Deuda: $ ".($saldocliente + $pedido[0]->peididos_montototal)."\n";

		echo "\n".str_pad("-",56,"-");

	}else{
		echo "\nNo results!";
	}

	echo "\n";

?>