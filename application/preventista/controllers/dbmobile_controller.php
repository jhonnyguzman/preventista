<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dbmobile_Controller extends CI_Controller {

	private $file_name = "basedbmobile";
    private $database;

    private $file_name_cloud = "log_sql_cloud";
	private $status_file_cloud = FALSE;

	function __construct()
	{
		parent::__construct();
		$this->load->model('grupos_tabgral_model');
		$this->load->model('tabgral_model');
		$this->load->model('perfiles_model');
		$this->load->model('usuarios_model');
		$this->load->model('clientescategoria_model');
		$this->load->model('tramites_model');
		$this->load->model('rubros_model');
		$this->load->model('marcas_model');
		$this->load->model('fleteros_model');
		$this->load->model('clientes_model');
		$this->load->model('cuentacorriente_model');
		$this->load->model('articulos_model');
		$this->load->model('pedidos_model');
		$this->load->model('pedidodetalle_model');
		$this->load->model('hojaruta_model');
		$this->load->model('hojarutadetalle_model');
		$this->load->model('remitos_model');
		$this->load->model('pagos_model');
		$this->load->model('pagospedidos_model');
	}

	function index()
	{
		$data["subtitle"] = "Gesti&oacute;n de bases de datos m&oacute;viles";
		$this->load->view("dbmobile_view/home_dbmobile",$data);

	}

	/**
	* Esta función crea una base de datos sqlite versión 3
	*/ 
	function crearDB()
	{
		//verificamos si existe la bd
		$this->checkExistsDB();

		/*creamos la base de datos sqlite movil*/
		try 
		{
		  //crear o abre una base de datos sqlite
		  $this->database = new SQLite3('./bd/dbmobile/preventista');
		}
		catch(Exception $e) 
		{
		  die($e);
		}
	}


	/**
	* Esta función permite verificar si ya existe una base de datos sqlite
	* creada con anterioridad. Si existe la elimina.
	*/
	function checkExistsDB()
	{
		$filename = './bd/dbmobile/preventista';

		if (file_exists($filename)) {
		    unlink($filename);
		} 
	}


	/**
	* Esta función se encarga de cargar la base de datos creada con el ḿétodo crearDB() con
	* datos iniciales que se encuentran en el archivo de  texto plano  basedbmobile.txt.
	* Este archivo contiene las instruccines de creación de todas las tablas del sistema.
	* Una vez que los datos iniciales son cargados, se llama a la función cargarSqlInserts().
	*/
	function cargarDatosIniciales()
	{

		//creamos la base de datos
		$this->crearDB();

		//verficamos que exista la base de datos
		if($this->database)
		{
			/*leemos el archivo que contiene las tablas bases con datos bases y 
			creamos las tablas bases */
			try{
				if(!$file = fopen("./logsql/".$this->file_name.".txt","r"))
			    	throw new Exception("Problem with File");

			  	while (!feof($file))
			  	{
		    		$row_query=fgets($file);
		    		//ejecutamos cada linea leida
					if(!$this->database->exec($row_query))
					{
					  die("Error al crear la tabla o insertar los datos ");
					}
			    	
			  	}
			  	fclose($file);

			

		  	}catch(Exception $e) {
	    		 die($e);
			}

			$this->cargarSqlInserts();
			$this->deleteLinesFronFileCloud();
			$this->session->set_flashdata('flashConfirm', "La base de datos se ha creado correctamente!"); 
			redirect('dbmobile_controller','location');
			//$this->index();
		}else{
			$this->session->set_flashdata('flashError', "Hubo un error al crear la base de datos"); 
			redirect('dbmobile_controller','location');
			//$this->index();
		}
		
	}


	/**
	* Esta función se encarga de obtener cada registro de cada tabla del sistema e
	* insertar esos registros leidos en la base de datos sqlite creada con anterioridad.
	*/
	function cargarSqlInserts()
	{
		$nameModels = $this->getNameModels();
		foreach ($nameModels as $key => $value) 
		{
			$records = $this->$value->getMobile();
			if(count($records) > 0){
				foreach ($records as $f) 
				{
					$str_sql = $this->getFormatSqlInsert($f, $value);
					if(!$this->database->exec($str_sql))
					{
					  die("Error al crear la tabla o insertar los datos ");
					}
					//echo " Sentencia: ".$str_sql."<br>";
				}
			}
		}
	}


	/**
	* Esta función se encarga de formatear de forma correcta una sentencia sql insert.
	* @param Object  $f 	objeto que contiene una registro completo.
	* @param String  $nameModel 	Contiene el nombre de la tabla con el cual construir la sentencia insert.
	* @return String Sentencia sql insert formateada. 
	*/
	function getFormatSqlInsert($f, $nameModel)
	{	
		$fields = $this->$nameModel->getFieldsMobile_m();
		$string = "INSERT INTO ".$this->getFormatNameModel($nameModel)." VALUES (";
		
		foreach ($fields as $key => $value) {
			$string.= "'".$f->$value."',";
		}

		$string = substr($string, 0,-1);
		$string.=");\n";
		return $string;

	}


	function getNameModels()
	{
		//code here
		$models=array();
		$models[] = "grupos_tabgral_model";
		$models[] = "tabgral_model";
		$models[] = "perfiles_model";
		$models[] = "usuarios_model";
		$models[] = "clientescategoria_model";
		$models[] = "tramites_model";
		$models[] = "rubros_model";
		$models[] = "marcas_model";
		$models[] = "fleteros_model";
		$models[] = "clientes_model";
		$models[] = "cuentacorriente_model";
		$models[] = "articulos_model";
		$models[] = "pedidos_model";
		$models[] = "pedidodetalle_model";
		$models[] = "hojaruta_model";
		$models[] = "hojarutadetalle_model";
		$models[] = "remitos_model";
		$models[] = "pagos_model";
		$models[] = "pagospedidos_model";
		
		return $models;
			
	}

	function getFormatNameModel($nameModel)
	{
		substr($nameModel, 0,-6);
		return substr($nameModel, 0,-6);
	}


	/**
	 * Este método elimina todas las sentencias sql que se encuentran en el
	 * archivo de texto plano log_sql_cloud.txt. Es llamado desde el móvil cuando
	 * en el mismo se termina de ejecutar todas las sentencias sql que se encuentran
	 * en este archivo.
	 */
	function deleteLinesFronFileCloud()
	{
		try{
			if(!$file = fopen("./logsql/".$this->file_name_cloud.".txt","wb"))
		    	throw new Exception("Problem with File");
		    else {
		    	fclose($file);
		    	$this->status_file_cloud = TRUE;
		    }
		}catch(Exception $e) {
    		 $this->status_file_cloud = FALSE;
		}		
	}

}