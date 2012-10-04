<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articulos_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('articulos_model');
		$this->load->model('marcas_model');
		$this->load->model('rubros_model');
		$this->load->model('tabgral_model');
		$this->config->load('articulos_settings');
		$data['flags'] = $this->basicauth->getPermissions('articulos');
		$this->flagR = $data['flags']['flag-read'];
		$this->flagI = $data['flags']['flag-insert'];
		$this->flagU = $data['flags']['flag-update'];
		$this->flagD = $data['flags']['flag-delete'];
		$this->flags = array('i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = $this->config->item('recordListTitle');
			$data['rubros'] = $this->rubros_model->get_m();
			$data['marcas'] = $this->marcas_model->get_m(array('marcas_parent' => 0));
			$this->load->view('articulos_view/home_articulos', $data);
			$this->search_c();
		}

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for saving 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function add_c()
	{
		//code here
		if(!$this->flagI){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordAddTitle');
		$data['rubros'] = $this->rubros_model->get_m();
		$data['marcas'] = $this->marcas_model->get_m(array('marcas_parent' => 0));
		$data['estados'] = $this->tabgral_model->get_m(array('grupos_tabgral_id' => 7)); //estados de articulos
		
		$this->form_validation->set_rules('articulos_id', 'articulos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('articulos_descripcion', 'articulos_descripcion', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_preciocompra', 'articulos_preciocompra', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_stockreal', 'articulos_stockreal', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_stockmin', 'articulos_stockmin', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_stockmax', 'articulos_stockmax', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('rubros_id', 'rubros_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('articulos_precio1', 'articulos_precio1', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_precio2', 'articulos_precio2', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_precio3', 'articulos_precio3', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_porcentaje1', 'articulos_porcentaje1', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_porcentaje2', 'articulos_porcentaje2', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_porcentaje3', 'articulos_porcentaje3', 'trim|required|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_articulos  = array();
			$data_articulos['articulos_id'] = $this->preferences->data['articulos_next_id'];
			$data_articulos['articulos_descripcion'] = $this->input->post('articulos_descripcion');
			$data_articulos['articulos_preciocompra'] = $this->input->post('articulos_preciocompra');
			$data_articulos['articulos_stockreal'] = $this->input->post('articulos_stockreal');
			$data_articulos['articulos_stockmin'] = $this->input->post('articulos_stockmin');
			$data_articulos['rubros_id'] = $this->input->post('rubros_id');
			if($this->input->post('articulos_precio1'))
				$data_articulos['articulos_precio1'] = $this->input->post('articulos_precio1');
			if($this->input->post('articulos_precio2'))
				$data_articulos['articulos_precio2'] = $this->input->post('articulos_precio2');
			if($this->input->post('articulos_precio3'))
				$data_articulos['articulos_precio3'] = $this->input->post('articulos_precio3');
			if($this->input->post('articulos_porcentaje1'))
				$data_articulos['articulos_porcentaje1'] = $this->input->post('articulos_porcentaje1');
			if($this->input->post('articulos_porcentaje2'))
				$data_articulos['articulos_porcentaje2'] = $this->input->post('articulos_porcentaje2');
			if($this->input->post('articulos_porcentaje3'))
				$data_articulos['articulos_porcentaje3'] = $this->input->post('articulos_porcentaje3');
			$data_articulos['articulos_estado'] = $this->input->post('articulos_estado');
			$data_articulos['marcas_id'] = $this->basicrud->getOneMarcaToSearch($this->input->post('marcas_id'));
			$data_articulos['articulos_created_at'] = $this->basicrud->formatDateToBD();
			$data_articulos['articulos_updated_at'] = $this->basicrud->formatDateToBD();

			$id_articulos = $this->articulos_model->add_m($data_articulos);
			if($id_articulos){ 
				$this->preferences->editNextId('articulos_next_id',$id_articulos);
				$this->session->set_flashdata('flashConfirm', $this->config->item('articulos_flash_add_message')); 
				redirect('articulos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('articulos_flash_error_message')); 
				redirect('articulos_controller','location');
			}
		}
		$this->load->view('articulos_view/form_add_articulos',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($articulos_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['articulos'] = $this->articulos_model->get_m(array('articulos_id' => $articulos_id),$flag=1);
		$data['rubros'] = $this->rubros_model->get_m();
		$data['marcas'] = $this->marcas_model->get_m();
		$data['estados'] = $this->tabgral_model->get_m(array('grupos_tabgral_id' => 7)); //estados de articulos

		$this->form_validation->set_rules('articulos_id', 'articulos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('articulos_descripcion', 'articulos_descripcion', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_preciocompra', 'articulos_preciocompra', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_stockreal', 'articulos_stockreal', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_stockmin', 'articulos_stockmin', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_stockmax', 'articulos_stockmax', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('rubros_id', 'rubros_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('articulos_observaciones', 'articulos_observaciones', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_precio1', 'articulos_precio1', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_precio2', 'articulos_precio2', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_precio3', 'articulos_precio3', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_porcentaje1', 'articulos_porcentaje1', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_porcentaje2', 'articulos_porcentaje2', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_porcentaje3', 'articulos_porcentaje3', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('articulos_estado', 'articulos_estado', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('marcas_id', 'marcas_id', 'trim|required|integer|xss_clean');
		if($this->form_validation->run()){
			$data_articulos  = array();
			
			$data_articulos['articulos_id'] = $this->input->post('articulos_id');
			$data_articulos['articulos_descripcion'] = $this->input->post('articulos_descripcion');
			$data_articulos['articulos_preciocompra'] = $this->input->post('articulos_preciocompra');
			$data_articulos['articulos_stockreal'] = $this->input->post('articulos_stockreal');
			$data_articulos['articulos_stockmin'] = $this->input->post('articulos_stockmin');
			$data_articulos['articulos_stockmax'] = $this->input->post('articulos_stockmax');
			$data_articulos['rubros_id'] = $this->input->post('rubros_id');
			$data_articulos['articulos_observaciones'] = $this->input->post('articulos_observaciones');
			$data_articulos['articulos_precio1'] = $this->input->post('articulos_precio1');
			$data_articulos['articulos_precio2'] = $this->input->post('articulos_precio2');
			$data_articulos['articulos_precio3'] = $this->input->post('articulos_precio3');
			$data_articulos['articulos_porcentaje1'] = $this->input->post('articulos_porcentaje1');
			$data_articulos['articulos_porcentaje2'] = $this->input->post('articulos_porcentaje2');
			$data_articulos['articulos_porcentaje3'] = $this->input->post('articulos_porcentaje3');
			$data_articulos['articulos_estado'] = $this->input->post('articulos_estado');
			$data_articulos['marcas_id'] = $this->input->post('marcas_id');
			$data_articulos['articulos_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->articulos_model->edit_m($data_articulos)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('articulos_flash_edit_message')); 
				redirect('articulos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('articulos_flash_error_message')); 
				redirect('articulos_controller','location');
			}
		}
		$this->load->view('articulos_view/form_edit_articulos',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $articulos_id id of record
	 * @return void
	 */
	function delete_c($articulos_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		//baja logica de articulo cambio estado a 27 que es 'No disponible'
		if($this->articulos_model->edit_m(array('articulos_id' => $articulos_id, 'articulos_estado' => 21))){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('articulos_flash_delete_message')); 
			redirect('articulos_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('articulos_flash_error_delete_message')); 
			redirect('articulos_controller','location');
		}

	}


	/**
	 * This function filter and sends the data to the view
	 * to shows the found result
	 *
	 * @access public
	 * @return void
	 */
	function search_c($offset = 0)
	{
		//code here
		$data = array(); 
		$fieldSearch = array(); 
		$data_search_articulos = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_articulos  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->articulos_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					if($field == "marcas_id" ){
						$data_search_articulos[$field] = $this->basicrud->getOneMarcaToSearch($this->input->post('marcas_id'));
						$data_search_pagination[$field] = $this->basicrud->getOneMarcaToSearch($this->input->post('marcas_id'));
					}else{
						$data_search_articulos[$field] = $this->input->post($field);
						$data_search_pagination[$field] = $this->input->post($field);
					}
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_pagination['articulos_estado'] = 20;	
			$data_search_articulos['articulos_estado'] = 20;
			$data_search_articulos['limit'] = $this->config->item('pag_perpage');
			$data_search_articulos['offset'] = $offset;
			$data_search_articulos['sortBy'] = 'articulos_descripcion';
			$data_search_articulos['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'articulos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['articulos'] = $this->articulos_model->get_m($data_search_articulos);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'articulos_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['articulos'] = $this->articulos_model->get_m($data_search_articulos);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->articulos_model->getFieldsTable_m());
			$this->load->view('articulos_view/record_list_articulos',$data);
		}

	}


	/**
	 * Esta función muestra el formulario de edicion general 
	 * de parametros de articulos
	 *
	 * @access public
	 * @return void
	 */
	function showFormEditGeneral_c()
	{
		$data['articulos_ids'] = explode(",", $this->uri->segment(3));
		$data['cantSeleccionados'] = count($data['articulos_ids']);
		$this->load->view("articulos_view/form_editshort_articulos", $data);
	}


	/**
	 * Esta función edita los cambios los porcentajes y precios
	 * de articulos
	 *
	 * @access public
	 * @return void
	 */
	function editFastGeneral_c()
	{
		$articulos_ids = $this->input->post('articulos_ids');
		if(count($articulos_ids) > 0)
		{
			for($i=0; $i<count($articulos_ids); $i++)
			{
				$articulo = $this->articulos_model->get_m(array('articulos_id' => $articulos_ids[$i]));
				if($articulo)
				{
					$data_articulos['articulos_id'] = $articulo[0]->articulos_id; 
					$data_articulos['articulos_precio1'] = $this->basicrud->getPrecio1($articulo[0]->articulos_preciocompra, $articulo[0]->articulos_porcentaje1, $this->input->post('articulos_porcentaje1'), $this->input->post('radioPorcentaje1'));
					$data_articulos['articulos_precio2'] = $this->basicrud->getPrecio1($articulo[0]->articulos_preciocompra, $articulo[0]->articulos_porcentaje2, $this->input->post('articulos_porcentaje2'), $this->input->post('radioPorcentaje2'));
					$data_articulos['articulos_precio3'] = $this->basicrud->getPrecio1($articulo[0]->articulos_preciocompra, $articulo[0]->articulos_porcentaje3, $this->input->post('articulos_porcentaje3'), $this->input->post('radioPorcentaje3'));
					$data_articulos['articulos_porcentaje1'] = $this->basicrud->getPorcentaje1($articulo[0]->articulos_porcentaje1, $this->input->post('articulos_porcentaje1'), $this->input->post('radioPorcentaje1'));
					$data_articulos['articulos_porcentaje2'] = $this->basicrud->getPorcentaje1($articulo[0]->articulos_porcentaje2, $this->input->post('articulos_porcentaje2'), $this->input->post('radioPorcentaje2'));
					$data_articulos['articulos_porcentaje3'] = $this->basicrud->getPorcentaje1($articulo[0]->articulos_porcentaje3, $this->input->post('articulos_porcentaje3'), $this->input->post('radioPorcentaje3'));
					if(!$this->articulos_model->edit_m($data_articulos)) $check_errors[] = 1;
				}
			}

			if(count($check_errors) > 0){
				$this->session->set_flashdata('flashError', $this->config->item('articulos_flash_x2_message')); 
				redirect('articulos_controller','location'); 
			}
			else{ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('articulos_flash_x1_message')); 
				redirect('articulos_controller','location'); 
			}
		}

	}

	/**
	 * Esta función edita los precios de compra,precio de vneta, porcentajes 
	 * de articulos
	 *
	 * @access public
	 * @return void
	 */
	function editFastGeneralPrecio_c()
	{
		$articulos_ids = $this->input->post('articulos_ids');
		if(count($articulos_ids) > 0)
		{
			for($i=0; $i<count($articulos_ids); $i++)
			{
				$articulo = $this->articulos_model->get_m(array('articulos_id' => $articulos_ids[$i]));
				if($articulo)
				{
					$data_articulos['articulos_id'] = $articulo[0]->articulos_id; 
					
					if($this->input->post('articulos_porcentaje_preciocompra'))
					{
						if($this->input->post('flag_p') == 'sumar')
							$data_articulos['articulos_preciocompra'] = $this->basicrud->calcPrecioCompra($this->input->post('articulos_porcentaje_preciocompra'), $articulo[0]->articulos_preciocompra,'+');
						elseif($this->input->post('flag_p') == 'restar')
							$data_articulos['articulos_preciocompra'] = $this->basicrud->calcPrecioCompra($this->input->post('articulos_porcentaje_preciocompra'), $articulo[0]->articulos_preciocompra,'-');						
						
						$data_articulos['articulos_precio1'] = $this->basicrud->getPrecio2($data_articulos['articulos_preciocompra'], $articulo[0]->articulos_porcentaje1);
						$data_articulos['articulos_precio2'] = $this->basicrud->getPrecio2($data_articulos['articulos_preciocompra'], $articulo[0]->articulos_porcentaje2);
						$data_articulos['articulos_precio3'] = $this->basicrud->getPrecio2($data_articulos['articulos_preciocompra'], $articulo[0]->articulos_porcentaje3);
						if(!$this->articulos_model->edit_m($data_articulos)) $check_errors[] = 1;
					}

					if($this->input->post('flag') == 'porcentaje')
					{
						if ($this->input->post('articulos_precio1')){
							$data_articulos['articulos_precio1'] = $this->input->post('articulos_precio1');
							$data_articulos['articulos_porcentaje1'] = $this->basicrud->getPorcentaje2($articulo[0]->articulos_preciocompra, $this->input->post('articulos_precio1'));
						}
						if ($this->input->post('articulos_precio2')){
							$data_articulos['articulos_precio2'] = $this->input->post('articulos_precio2');
							$data_articulos['articulos_porcentaje2'] = $this->basicrud->getPorcentaje2($articulo[0]->articulos_preciocompra, $this->input->post('articulos_precio2'));
						}
						if ($this->input->post('articulos_precio3')){
							$data_articulos['articulos_precio3'] = $this->input->post('articulos_precio3');
							$data_articulos['articulos_porcentaje3'] = $this->basicrud->getPorcentaje2($articulo[0]->articulos_preciocompra, $this->input->post('articulos_precio3'));
						}
						if(!$this->articulos_model->edit_m($data_articulos)) $check_errors[] = 1;
					}
					elseif($this->input->post('flag') == 'precio')
					{
						if ($this->input->post('articulos_precio1')){
							$data_articulos['articulos_preciocompra'] = $this->basicrud->getPrecioCompra($this->input->post('articulos_precio1'), $articulo[0]->articulos_porcentaje1);
							$data_articulos['articulos_precio1'] = $this->input->post('articulos_precio1');
							$data_articulos['articulos_precio2'] = $this->basicrud->getPrecio2($data_articulos['articulos_preciocompra'], $articulo[0]->articulos_porcentaje2);
							$data_articulos['articulos_precio3'] = $this->basicrud->getPrecio2($data_articulos['articulos_preciocompra'], $articulo[0]->articulos_porcentaje3);
						}
						if ($this->input->post('articulos_precio2')){
							$data_articulos['articulos_preciocompra'] = $this->basicrud->getPrecioCompra($this->input->post('articulos_precio2'), $articulo[0]->articulos_porcentaje2);
							$data_articulos['articulos_precio2'] = $this->input->post('articulos_precio2');
							$data_articulos['articulos_precio1'] = $this->basicrud->getPrecio2($data_articulos['articulos_preciocompra'], $articulo[0]->articulos_porcentaje1);
							$data_articulos['articulos_precio3'] = $this->basicrud->getPrecio2($data_articulos['articulos_preciocompra'], $articulo[0]->articulos_porcentaje3);
						}
						if ($this->input->post('articulos_precio3')){
							$data_articulos['articulos_preciocompra'] = $this->basicrud->getPrecioCompra($this->input->post('articulos_precio3'), $articulo[0]->articulos_porcentaje3);
							$data_articulos['articulos_precio3'] = $this->input->post('articulos_precio3');
							$data_articulos['articulos_precio1'] = $this->basicrud->getPrecio2($data_articulos['articulos_preciocompra'], $articulo[0]->articulos_porcentaje1);
							$data_articulos['articulos_precio2'] = $this->basicrud->getPrecio2($data_articulos['articulos_preciocompra'], $articulo[0]->articulos_porcentaje2);
						}
						if(!$this->articulos_model->edit_m($data_articulos)) $check_errors[] = 1;
					}
				}
			}

			if(count($check_errors) > 0){
				$this->session->set_flashdata('flashError', $this->config->item('articulos_flash_x2_message')); 
				redirect('articulos_controller','location'); 
			}
			else{ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('articulos_flash_x1_message')); 
				redirect('articulos_controller','location'); 
			}
		}
	}

	/**
	 * Esta función edita todos los parametros que se han editado en la grilla
	 * de articulos
	 *
	 * @access public
	 * @return void
	 */
	function updateparcial_c()
	{

		$articulos_ids = $this->input->get('art_ids');
		$articulos_sts = $this->input->get('art_sts');
		$articulos_stv = $this->input->get('art_stsv');
		$comentarios = $this->input->get('comments');
		$articulos_pcs = $this->input->get('art_pcs');
		$articulos_pv1 = $this->input->get('art_pv1');
		$articulos_pv2 = $this->input->get('art_pv2');
		$articulos_pv3 = $this->input->get('art_pv3');
		$articulos_p1 = $this->input->get('art_p1');
		$articulos_p2 = $this->input->get('art_p2');
		$articulos_p3 = $this->input->get('art_p3');

		if(count($articulos_ids) > 0)
		{
			for($i=0; $i<count($articulos_ids); $i++)
			{
				$articulo = $this->articulos_model->get_m(array('articulos_id' => $articulos_ids[$i]));
				if($articulo)
				{
					$data_articulos['articulos_id'] = $articulo[0]->articulos_id; 
					$data_articulos['articulos_preciocompra'] = $articulos_pcs[$i]; 
					$data_articulos['articulos_stockreal'] = $articulos_sts[$i]; 
					$data_articulos['articulos_precio1'] =  $articulos_pv1[$i]; 
					$data_articulos['articulos_precio2'] = $articulos_pv2[$i]; 
					$data_articulos['articulos_precio3'] = $articulos_pv3[$i]; 
					$data_articulos['articulos_porcentaje1'] = $articulos_p1[$i]; 
					$data_articulos['articulos_porcentaje2'] = $articulos_p2[$i]; 
					$data_articulos['articulos_porcentaje3'] = $articulos_p3[$i]; 
					if($this->articulos_model->edit_m($data_articulos)){
						if($comentarios[$i] != 'F'){  //F: no se hizo cambios, N: se hizo cambios pero nose agrego comentario
							$cambiodirecto = $this->setCambioDirecto($articulos_ids[$i],$articulos_sts[$i], $articulos_stv[$i],$comentarios[$i]);
						}
					}else $check_errors[] = 1;
				}

			}

			if(count($check_errors) > 0){
				$this->session->set_flashdata('flashError', $this->config->item('articulos_flash_x2_message')); 
				redirect('articulos_controller','location'); 
			}
			else{ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('articulos_flash_x1_message')); 
				redirect('articulos_controller','location'); 
			}
		}

		echo "<pre>";
		print_r($this->input->get());
		echo "</pre>";

	}


	/**
	 * Esta función genera un pdf con todos los articulos 
	 * de la bd del sistema
	 *
	 * @access public
	 * @return void
	 */
	function printall_c()
	{
		$this->load->helper(array('dompdf', 'file'));
		$data["fieldstoprint"] = $this->input->post('toprint');
		$data["articulos"] = $this->articulos_model->get_m(array('sortBy'=>'articulos_descripcion', 'sortDirection' => 'asc'));
		$data["title"] = "Listado de Articulos";
		$data["todayDate"] = $this->basicrud->formatDateToHuman($this->basicrud->getDateToBDWithOutTime());
	    //page info here, db calls, etc.     
	    $html = $this->load->view('articulos_view/record_list_to_print', $data, true);
	    pdf_create($html, 'Listado','a5',$this->input->post('orientacion'));
	}


	/**
	 * Esta función genera un txt con todos los articulos 
	 * de la bd del sistema
	 *
	 * @access public
	 * @return void
	 */
	function printall2_c()
	{
		$this->load->helper('download');
		$data["fieldstoprint"] = $this->input->post('toprint');
		$data["articulos"] = $this->articulos_model->get_m(array('sortBy'=>'articulos_descripcion', 'sortDirection' => 'asc'));
		$data["title"] = "Listado de Articulos";
		$data["todayDate"] = $this->basicrud->formatDateToHuman($this->basicrud->getDateToBDWithOutTime());
	    //page info here, db calls, etc.     
	    $html = $this->load->view('articulos_view/record_list_to_print2', $data, true);
	    $data = $html;
		$name = $this->basicrud->setFileName('ListadoArticulos').".txt";
		force_download($name, $data);
	}


	/**
	 * Esta función genera un pdf con todos los articulos filatrados
	 * de la bd del sistema
	 *
	 * @access public
	 * @return void
	 */
	function printfilter_c()
	{
		$this->load->helper(array('dompdf', 'file'));
		$data["fieldstoprint"] = $this->input->post('toprint');
		
		if($this->input->post('articulos_descripcion_f'))
			$data_search['articulos_descripcion'] = $this->input->post('articulos_descripcion_f');
		if($this->input->post('rubros_id_f'))
			$data_search['rubros_id'] = $this->input->post('rubros_id_f');
		if($this->input->post('marcas_id_f'))
			$data_search['marcas_id'] = $this->input->post('marcas_id_f');
		$data_search['sortBy'] ='articulos_descripcion';
		$data_search['sortDirection'] ='asc';
		
		$data["articulos"] = $this->articulos_model->get_m($data_search);
		$data["title"] = "Listado de Articulos";
		$data["todayDate"] = $this->basicrud->formatDateToHuman($this->basicrud->getDateToBDWithOutTime());
	   
	    //page info here, db calls, etc.     
	    $html = $this->load->view('articulos_view/record_list_to_print', $data, true);
	    pdf_create($html, 'Listado','a5',$this->input->post('orientacion'));
	}


	/**
	 * Esta función genera un txt con todos los articulos filatrados
	 * de la bd del sistema
	 *
	 * @access public
	 * @return void
	 */
	function printfilter2_c()
	{
		$this->load->helper('download');
		$data["fieldstoprint"] = $this->input->post('toprint');
		
		if($this->input->post('articulos_descripcion_f'))
			$data_search['articulos_descripcion'] = $this->input->post('articulos_descripcion_f');
		if($this->input->post('rubros_id_f'))
			$data_search['rubros_id'] = $this->input->post('rubros_id_f');
		if($this->input->post('marcas_id_f'))
			$data_search['marcas_id'] = $this->input->post('marcas_id_f');
		$data_search['sortBy'] ='articulos_descripcion';
		$data_search['sortDirection'] ='asc';
		
		$data["articulos"] = $this->articulos_model->get_m($data_search);
		$data["title"] = "Listado de Articulos";
		$data["todayDate"] = $this->basicrud->formatDateToHuman($this->basicrud->getDateToBDWithOutTime());
	   
	    $html = $this->load->view('articulos_view/record_list_to_print2', $data, true);
	    $data = $html;
		$name = $this->basicrud->setFileName('ListadoArticulos').".txt";
		force_download($name, $data);
	}
	
	/**
	 * Esta función permita realizar la alta de un cambio directo producido
	 * en  la grilla de articulos con respecto al stock 
	 *
	 * @access public
	 * @return void
	 */
	function setCambioDirecto($articulos_id, $articulos_stockreal_nuevo, $articulos_stockreal_antiguo, $comentario)
	{
		$this->load->model("cambiodirectostock_model");
		$cambiodirecto['articulos_id'] = $articulos_id;
		$cambiodirecto['cambiodirectostock_stockantiguo'] = $articulos_stockreal_antiguo;
		$cambiodirecto['cambiodirectostock_stocknuevo'] = $articulos_stockreal_nuevo;
		$cambiodirecto['usuarios_id'] = $this->session->userdata("usuarios_id");
		$cambiodirecto['cambiodirectostock_comentario'] = $comentario;
		$cambiodirecto['cambiodirectostock_created_at'] = $this->basicrud->formatDateToBD();
		$cambiodirecto['cambiodirectostock_updated_at'] = $this->basicrud->formatDateToBD();
		$cambiodirectostock_id = $this->cambiodirectostock_model->add_m($cambiodirecto);
		if($cambiodirectostock_id) return true;
		else return false;
	}


	function showStockDinero_c()
	{
		$data['stock_en_dinero_preciocompra'] = 0;
		$data['stock_en_dinero_precio1'] = 0;
		$data['stock_en_dinero_precio2'] = 0;
		$data['stock_en_dinero_precio3'] = 0;

		$articulos = $this->articulos_model->get_m(array('articulos_estado' => 20)); //traer todos los articulos con estado 'Disponible'
		if(count($articulos) > 0)
		{
			foreach ($articulos as $f) {
				$data['stock_en_dinero_preciocompra']+=$f->articulos_preciocompra * $f->articulos_stockreal;
				$data['stock_en_dinero_precio1']+=$f->articulos_precio1 * $f->articulos_stockreal;
				$data['stock_en_dinero_precio2']+=$f->articulos_precio2 * $f->articulos_stockreal;
				$data['stock_en_dinero_precio3']+=$f->articulos_precio3 * $f->articulos_stockreal;
			}
		}

		$this->load->view("articulos_view/form_stock_en_dinero", $data);
	}
}
