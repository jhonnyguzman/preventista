<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Autocomplete_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('provincias_model');
		$this->load->model('localidades_model');
		$this->load->model('articulos_model');
		$this->load->model('clientes_model');
		$this->load->model('fleteros_model');
		$this->load->model('proveedores_model');
	}
	
	
	/**
	 * This function get the found values of autocomplete
	 *
	 * @access public
	 * @return void
	 */
	function getAutocomplete_c()
	{
		$q = $this->input->post('q');
		if(!$q) return;
		
		//nombre del modelo de datos a usar
		$model = $this->input->post('model');
		//nombre del campo autocompletado
		$nameFieldToSearch = $this->input->post('nameFieldToSearch');
		
		//valor de parámetro extra
		$valExtraParam = $this->input->post('valExtraParam');
		//nombre del campo del parámetro extra
		$nameExtraParam = $this->input->post('nameExtraParam');
		
		//array de campos a mostrar el resultado del autcompletado
		$fieldsToShow = unserialize($this->input->post('arrFieldToShow'));
		
		//si existe el valor de parámetro extra, filtramos los resultados con ese valor agregado como filtro
		if($valExtraParam !='NO'){
			$data = $this->$model->get_m(array($nameFieldToSearch=>$q,$nameExtraParam=>$valExtraParam));
		}else {
			$data = $this->$model->get_m(array($nameFieldToSearch=>$q));
		}
		
		//preguntamos si existe resultado, si existe mostramos resultado, si no existe mostramos cadena vacia 
		if(isset($data) and count($data)>0)
		{
			foreach ($data as $d) {
				$show = $d->$nameFieldToSearch."|";
				foreach($fieldsToShow as $nameField){
					$show.= $d->$nameField."|"; 
				}
				$show.= "\n";
				echo $show;
			}
		}
		else  echo "";						
		
		
		//echo json_encode($data);
	}
	
	
	/**
	 * This function get the found values of autocomplete
	 *
	 * @access public
	 * @return void
	 */
	function getAutocompleteLineas()
	{
		$q = $this->input->post('q');
		if(!$q) return;
		
		//nombre del modelo de datos a usar
		$model = $this->input->post('model');
		//nombre del campo autocompletado
		$nameFieldToSearch = $this->input->post('nameFieldToSearch');
		
		//valor de parámetro extra
		$valExtraParam = $this->input->post('valExtraParam');
		//nombre del campo del parámetro extra
		$nameExtraParam = $this->input->post('nameExtraParam');
		
		//array de campos a mostrar el resultado del autcompletado
		$fieldsToShow = unserialize($this->input->post('arrFieldToShow'));
		foreach($fieldsToShow as $f){
			$arrShow = explode("-", $f);
			$newfieldsToShow[] = $arrShow[0];
		}	
		//si existe el valor de parámetro extra, filtramos los resultados con ese valor agregado como filtro
		if($valExtraParam !='NO'){
			$data = $this->$model->get_m(array($nameFieldToSearch=>$q,$nameExtraParam=>$valExtraParam));
		}else {
			$data = $this->$model->get_m(array($nameFieldToSearch=>$q));
		}
		
		//preguntamos si existe resultado, si existe mostramos resultado, si no existe mostramos cadena vacia 
		if(isset($data) and count($data)>0)
		{
			foreach ($data as $d) {
				$show = $d->$nameFieldToSearch."|";
				foreach($newfieldsToShow as $nameField){
					$show.= $d->$nameField."|"; 
				}
				$show.= "\n";
				echo $show;
			}
		}
		else  echo "";						
		
		
		//echo json_encode($data);
	}
	
	function getPrecio($categoria_clientes)
	{
		if($clientes_categoria == 3) return $articulos_precio1;
		elseif($clientes_categoria == 4) return $articulos_precio2;
		else  return $articulos_precio3; 
	}



	/**
	 * This function get the found values of autocomplete
	 *
	 * @access public
	 * @return void
	 */
	function getAutocompleteClientes_c()
	{
		$q = $this->input->post('q');
		if(!$q) return;
		
		//nombre del modelo de datos a usar
		$model = $this->input->post('model');
		//nombre del campo autocompletado
		$nameFieldToSearch = $this->input->post('nameFieldToSearch');
		
		//valor de parámetro extra
		$valExtraParam = $this->input->post('valExtraParam');
		//nombre del campo del parámetro extra
		$nameExtraParam = $this->input->post('nameExtraParam');
		
		//array de campos a mostrar el resultado del autcompletado
		$fieldsToShow = unserialize($this->input->post('arrFieldToShow'));
		
		//si existe el valor de parámetro extra, filtramos los resultados con ese valor agregado como filtro
		if($valExtraParam !='NO'){
			$data = $this->$model->get_m(array($nameFieldToSearch=>$q,$nameExtraParam=>$valExtraParam));
		}else {
			$data = $this->$model->get_m(array($nameFieldToSearch=>$q));
		}
		
		//preguntamos si existe resultado, si existe mostramos resultado, si no existe mostramos cadena vacia 
		if(isset($data) and count($data)>0)
		{
			foreach ($data as $d) {
				$show = $d->$nameFieldToSearch." ".$d->clientes_nombre."|";
				foreach($fieldsToShow as $nameField){
					$show.= $d->$nameField."|"; 
				}
				$show.= "\n";
				echo $show;
			}
		}
		else  echo "";						
		
		
		//echo json_encode($data);
	}
}
