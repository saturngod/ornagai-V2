<?php
class Word extends Model {
    
    function Word()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function add($word,$state,$def)
    {
        
        $this->load->library('session');
        
        /*
         `Word` ,
									`state` ,
									`def` ,
									`approve`
        */
        
        $data = array(
               'Word' => 'My title' ,
               'state' => 'My Name' ,
               'def' => 'My date',
               'approve' => 0,
               'usr_id' =>$this->session->userdata('item')
            );

$this->db->insert('mytable', $data);

    }
    
}
?>