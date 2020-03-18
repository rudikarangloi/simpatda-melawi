<?php

class Dompdf_lib {
    
	var $_dompdf = NULL;
	
	function __construct()
	{
		require_once(BASEPATH."libraries/dompdf/dompdf_config.inc.php");
		if(is_null($this->_dompdf)){
			$this->_dompdf = new DOMPDF();
		}
	}
	
	function convert_html_to_pdf($html, $filename ='', $stream = TRUE) 
	{
		$this->_dompdf->load_html($html);
		$this->_dompdf->render();
		if ($stream) {
			$this->_dompdf->stream($filename);
		} else {
			return $this->_dompdf->output();
		}
	}



        function pdf_create($html, $filename, $stream=TRUE){
//            require_once(APPPATH."third_party/dompdf/dompdf_config.inc.php");
            require_once(BASEPATH."libraries/dompdf/dompdf_config.inc.php");
            spl_autoload_register('DOMPDF_autoload');

            $dompdf = new DOMPDF();
            $dompdf->load_html($html);
            $dompdf->render();
            if ($stream) {
            $dompdf->stream($filename.".pdf");
            } else {
            $CI =& get_instance();
            $CI->load->helper('file');
            write_file($filename, $dompdf->output());
            }
        }

	
}
?>
