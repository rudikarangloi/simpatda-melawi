<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
    public function __construct() {
        parent::__construct();
        //require_once (APPPATH . "/libraries/connector/dataprocessor.php");
        require_once (APPPATH . "/libraries/connector/combo_connector.php");
        //require_once (APPPATH . "/libraries/connector/grid_config.php");
        require_once (APPPATH . "/libraries/connector/grid_connector.php");
		require_once (APPPATH . "/libraries/connector/treegrid_connector.php");
		//require_once(APPPATH . "/3rdparty/tcpdf/tcpdf.php");
		
        
        $this->load->model(array('msistem'));
		$this->load->model(array('model_user'));
        
		if($this->session->userdata('username')=="") {
			 redirect('home/logout');	
		}
        /* if(!self::_check_access())
        {
            $this->session->set_flashdata('error','Anda harus login terlebih dahulu');
            //redirect('home/login');
			//header("location:http://localhost/dms_sim/index.php/home/login");
        } */
        
//        if(!$this->session->sess_read()){
//            redirect('home/login');
//        }
    }
    
   /* private function _check_access()
    {
        if($this->session->userdata('idmenu') =='1')
        {
            return TRUE;
        }
        return FALSE;
    } */
}
