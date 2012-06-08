<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Execlog extends CI_Controller {
	
	//variables para cuando se ejecuta el txt log_sql.txt
	private $arr_status = array();
	private $status = FALSE;
	private $file_name = "log_sql";
	private $new_file_name;

	//variables para cuando se ejecuta el txt log_sql_cloud.txt
	private $file_name_cloud = "log_sql_cloud";
	private $new_file_name_cloud;
	private $status_file_cloud = FALSE;

	function __construct()
	{
		parent::__construct();
		$this->load->model('execlog_model');
	}


	/**
	 * Este método se llama desde el movil para ejcutar el archivo de texto plano
	 * log_sql.txt que contiene todas las sentencias sql que se ejecutaron
	 * en el movil
	 */
	function index()
	{
		try{
			if(!$file = fopen("./logsql/".$this->file_name.".txt","r"))
		    	throw new Exception("Problem with File");

		  	while (!feof($file))
		  	{
		    	$row_query=fgets($file);
		    	if(!$this->execlog_model->execquery_m($row_query)){
		    		$this->arr_status[] = 1;
		    	}
		  	}
		  	fclose($file);

		  	if(count($this->arr_status) > 0){
		  		$this->status = TRUE;
		  		$this->duplicateFileLog();
		  	}

		  	echo json_encode($this->status); 

	  	}catch(Exception $e) {
    		 die($e);
		}
	}


	/**
	 * Este método crear un copia del archivo de texto plano log_sql.txt en 
	 * el directorio logsql/backup_log_movil/ 
	 */
	function duplicateFileLog()
	{
		try {
			$this->new_file_name = $this->file_name."_".$this->basicrud->formatDateToBD2().".txt";
			copy("./logsql/".$this->file_name.".txt", "logsql/backup_logs_movil/".$this->new_file_name);
		}catch(Exception $e) {
			 die($e);
		}
	}


	/**
	 * Este método elimina todas las sentencias sql que se encuentran en el
	 * archivo de texto plano log_sql_cloud.txt. Es llamado desde el móvil cuando
	 * en el mismo se termina de ejecutar todas las sentencias sql que se encuentran
	 * en este archivo.
	 */
	function deleteLinesFronFileCloud()
	{
		if($this->duplicateFileLogCloud())
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

		echo json_encode($this->status_file_cloud); 
	}


	/**
	 * Este método crea una copia del archivo de texto plano log_sql_cloud.txt en el directorio
	 * logsql/backup_log_cloud/
	 */
	function duplicateFileLogCloud()
	{
		try {
			$this->new_file_name_cloud = $this->file_name_cloud."_".$this->basicrud->formatDateToBD2().".txt";
			if(copy("./logsql/".$this->file_name_cloud.".txt", "logsql/backup_logs_cloud/".$this->new_file_name_cloud)){
				return true;	
			}else{
				return false;
			}
			
		}catch(Exception $e) {
			 return false;
		}
	}
}