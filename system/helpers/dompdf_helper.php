<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	function pdf_create($html, $filename='', $tamayo='letter', $orientacion='portrait', $path='', $stream=TRUE) 
	{
	    require_once("dompdf/dompdf_config.inc.php");
	    if (isset($html) ) 
	    {
		    $html = stripslashes($html);
		    $dompdf = new DOMPDF();
		    $dompdf->load_html($html);
		    $dompdf->set_paper($tamayo, $orientacion);
		    $dompdf->render();

		    if ($stream) {
		        $dompdf->stream($filename.".pdf");
		    } else {
		    	//write_file("".$path.$filename.".pdf", $dompdf->output());
		    	return $dompdf->output();
		    }
		}
	} 
