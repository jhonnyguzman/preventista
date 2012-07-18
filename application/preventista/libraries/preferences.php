<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Preferences {

	public $data = array();
	private $CI;

	public function __construct() 
    {
    	$this->CI =& get_instance(); 
    	$query = $this->CI->db->get('preferences');
        
        if ($query->num_rows())
        {
            foreach ($query->result() as $row)
            {
                $this->data[$row->_key] = $row->_value ;
            }
        }
            
    }

    function editNextId($_key, $_value)
    {
        $this->CI->db->set('_value', $_value + 1);
        $this->CI->db->where('_key', $_key);
        $this->CI->db->update('preferences');
        if($this->CI->db->affected_rows()>0) return true;
        else return false;
    }

    function getNextId($_key)
    {
        $dato = null;
        $this->CI =& get_instance();
        
        $this->CI->db->where("_key", $_key);
        $query = $this->CI->db->get('preferences');
        
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $dato = $row->_value ;
            }
        }

        return $dato;
    }
}

/* End of file Preferences.php */