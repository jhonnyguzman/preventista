<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comprasdetalle_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('comprasdetalle_model');
		$this->config->load('comprasdetalle_settings');
		$data['flags'] = $this->basicauth->getPermissions('comprasdetalle');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->comprasdetalle_model->getFieldsTable_m());
			$this->load->view('comprasdetalle_view/home_comprasdetalle', $data);
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
		$this->form_validation->set_rules('comprasdetalle_id', 'comprasdetalle_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('compras_id', 'compras_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('articulos_id', 'articulos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('comprasdetalle_cantidad', 'comprasdetalle_cantidad', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('comprasdetalle_costo', 'comprasdetalle_costo', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('comprasdetalle_subtotal', 'comprasdetalle_subtotal', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('comprasdetalle_created_at', 'comprasdetalle_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('comprasdetalle_updated_at', 'comprasdetalle_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_comprasdetalle  = array();
			if($this->input->post('compras_id'))
				$data_comprasdetalle['compras_id'] = $this->input->post('compras_id');
			if($this->input->post('articulos_id'))
				$data_comprasdetalle['articulos_id'] = $this->input->post('articulos_id');
			if($this->input->post('comprasdetalle_cantidad'))
				$data_comprasdetalle['comprasdetalle_cantidad'] = $this->input->post('comprasdetalle_cantidad');
			if($this->input->post('comprasdetalle_costo'))
				$data_comprasdetalle['comprasdetalle_costo'] = $this->input->post('comprasdetalle_costo');
			if($this->input->post('comprasdetalle_subtotal'))
				$data_comprasdetalle['comprasdetalle_subtotal'] = $this->input->post('comprasdetalle_subtotal');
			if($this->input->post('comprasdetalle_created_at'))
				$data_comprasdetalle['comprasdetalle_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('comprasdetalle_created_at'));
			if($this->input->post('comprasdetalle_updated_at'))
				$data_comprasdetalle['comprasdetalle_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('comprasdetalle_updated_at'));

			$id_comprasdetalle = $this->comprasdetalle_model->add_m($data_comprasdetalle);
			if($id_comprasdetalle){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('comprasdetalle_flash_add_message')); 
				redirect('comprasdetalle_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('comprasdetalle_flash_error_message')); 
				redirect('comprasdetalle_controller','location');
			}
		}
		$this->load->view('comprasdetalle_view/form_add_comprasdetalle',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($comprasdetalle_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['comprasdetalle'] = $this->comprasdetalle_model->get_m(array('comprasdetalle_id' => $comprasdetalle_id),$flag=1);
		$this->form_validation->set_rules('comprasdetalle_id', 'comprasdetalle_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('compras_id', 'compras_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('articulos_id', 'articulos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('comprasdetalle_cantidad', 'comprasdetalle_cantidad', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('comprasdetalle_costo', 'comprasdetalle_costo', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('comprasdetalle_subtotal', 'comprasdetalle_subtotal', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('comprasdetalle_created_at', 'comprasdetalle_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('comprasdetalle_updated_at', 'comprasdetalle_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_comprasdetalle  = array();
			if($this->input->post('comprasdetalle_id'))
				$data_comprasdetalle['comprasdetalle_id'] = $this->input->post('comprasdetalle_id');
			if($this->input->post('compras_id'))
				$data_comprasdetalle['compras_id'] = $this->input->post('compras_id');
			if($this->input->post('articulos_id'))
				$data_comprasdetalle['articulos_id'] = $this->input->post('articulos_id');
			if($this->input->post('comprasdetalle_cantidad'))
				$data_comprasdetalle['comprasdetalle_cantidad'] = $this->input->post('comprasdetalle_cantidad');
			if($this->input->post('comprasdetalle_costo'))
				$data_comprasdetalle['comprasdetalle_costo'] = $this->input->post('comprasdetalle_costo');
			if($this->input->post('comprasdetalle_subtotal'))
				$data_comprasdetalle['comprasdetalle_subtotal'] = $this->input->post('comprasdetalle_subtotal');
			if($this->input->post('comprasdetalle_created_at'))
				$data_comprasdetalle['comprasdetalle_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('comprasdetalle_created_at'));
			if($this->input->post('comprasdetalle_updated_at'))
				$data_comprasdetalle['comprasdetalle_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('comprasdetalle_updated_at'));

			if($this->comprasdetalle_model->edit_m($data_comprasdetalle)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('comprasdetalle_flash_edit_message')); 
				redirect('comprasdetalle_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('comprasdetalle_flash_error_message')); 
				redirect('comprasdetalle_controller','location');
			}
		}
		$this->load->view('comprasdetalle_view/form_edit_comprasdetalle',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $comprasdetalle_id id of record
	 * @return void
	 */
	function delete_c($comprasdetalle_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->comprasdetalle_model->delete_m($comprasdetalle_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('comprasdetalle_flash_delete_message')); 
			redirect('comprasdetalle_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('comprasdetalle_flash_error_delete_message')); 
			redirect('comprasdetalle_controller','location');
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
		$data_search_comprasdetalle = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_comprasdetalle  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->comprasdetalle_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_comprasdetalle[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_comprasdetalle['limit'] = $this->config->item('pag_perpage');
			$data_search_comprasdetalle['offset'] = $offset;
			$data_search_comprasdetalle['sortBy'] = 'comprasdetalle_id';
			$data_search_comprasdetalle['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'comprasdetalle_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['comprasdetalle'] = $this->comprasdetalle_model->get_m($data_search_comprasdetalle);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'comprasdetalle_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['comprasdetalle'] = $this->comprasdetalle_model->get_m($data_search_comprasdetalle);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->comprasdetalle_model->getFieldsTable_m());
			$this->load->view('comprasdetalle_view/record_list_comprasdetalle',$data);
		}

	}




	/**
	 * This function filter and sends the data to the view
	 * to shows the found result
	 *
	 * @access public
	 * @return void
	 */
	function searchByArticulo_c($offset = 0)
	{
		//code here
		$data = array(); 
		$data_search_comprasdetalle = array(); 
		$data_search_pagination = array(); 
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			if($this->input->post('articulos_descripcion')) 
			{
				$data_search_comprasdetalle['articulos_descripcion'] = $this->input->post('articulos_descripcion');
				$data_search_pagination['articulos_descripcion'] = $this->input->post('articulos_descripcion');
			}
		
			$data_search_pagination['count'] = true;
			$data_search_comprasdetalle['limit'] = $this->config->item('pag_perpage');
			$data_search_comprasdetalle['offset'] = $offset;
			$data_search_comprasdetalle['sortBy'] = 'articulos_descripcion';
			$data_search_comprasdetalle['sortDirection'] = 'asc';

			$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'comprasdetalle_model','nameMethod'=>'getByArticulo_m','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
			$data['comprasdetalle'] = $this->comprasdetalle_model->getByArticulo_m($data_search_comprasdetalle);
		
			
			$this->load->view('comprasdetalle_view/record_listbyarticulo_comprasdetalle',$data);
		}

	}

}