<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_Controller extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->helper("file");
	}

	function index()
	{
		/*$ar=fopen("./pdfs/log_sql.txt","r") or
    		die("No se pudo abrir el archivo");
		
			while (!feof($ar))
			{
			    $linea=fgets($ar);
			    echo $linea."<br>";
			}
			fclose($ar);*/

		/*try 
		{
		  //create or open the database
		  $database = new SQLiteDatabase('myDatabase.sqlite', 0666, $error);
		}
		catch(Exception $e) 
		{
		  die($error);
		}*/
		 echo  phpinfo();

	}
				
			
}