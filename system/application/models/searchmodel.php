<?php
class Searchmodel extends Model {
    
    function Searchmodel()
    {
        // Call the Model constructor
        parent::Model();
    }
    
    function detect_langauage($message)
    {
        $myanmar_word="/[ကခဂဃငစဆဇဈဉညဋဌဍဎဏတထဒဓနပဖဗဘမယရလဝသဟဠအဣဤဥဦဧဩဪ၀၁၂၃၄၅၆၇၈၉၊။၌၍၎၏ေ]/";
        
        if(preg_match($myanmar_word, $message ))
        {
            return true;
        }
      return false;
        
    }
    
    function query($q,$mm,$page=1)
    {
        $numshow=10; //number of result per page	
	$show=($page-1)*10;

        if($mm)
        {
            
            $my_data=mysql_real_escape_string($q);
            $sql="
		
SELECT SQL_NO_CACHE * , IF( `def` = '$my_data', 1, IF( `def` LIKE '$my_data%', 2, IF( `def` LIKE '%$my_data', 4, 3 ) ) ) AS `sort`
FROM `mydblist`
WHERE `def` LIKE '%$my_data%'
ORDER BY `sort` , `def`
		
		";
            
        }
        else{
            $data_q=mysql_real_escape_string($q);
	    $sql="
		SELECT SQL_NO_CACHE * , IF( `Word` = '$data_q', 1, IF( `Word` LIKE '$data_q%', 2, IF( `Word` LIKE '%$data_q', 4, 3 ) ) ) AS `sort`
FROM `dblist`
WHERE `Word` LIKE '%$data_q%'
ORDER BY `sort` , `Word`
		
		";

        }
        
        $sql=$sql." LIMIT $show, $numshow";
        
    
        $query=$this->db->query($sql);
        
        
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else{
            return false;
        }
        
        
    }
    
    function query_numrows($q,$mm)
    {
       
        if($mm)
        {
            
            $my_data=mysql_real_escape_string($q);
            $sql="
		
SELECT SQL_NO_CACHE * , IF( `def` = '$my_data', 1, IF( `def` LIKE '$my_data%', 2, IF( `def` LIKE '%$my_data', 4, 3 ) ) ) AS `sort`
FROM `mydblist`
WHERE `def` LIKE '%$my_data%'
ORDER BY `sort` , `def`
		
		";
            
        }
        else{
            $data_q=mysql_real_escape_string($q);
	    $sql="
		SELECT SQL_NO_CACHE * , IF( `Word` = '$data_q', 1, IF( `Word` LIKE '$data_q%', 2, IF( `Word` LIKE '%$data_q', 4, 3 ) ) ) AS `sort`
FROM `dblist`
WHERE `Word` LIKE '%$data_q%'
ORDER BY `sort` , `Word`
		
		";

        }
        
        
    
        $query=$this->db->query($sql);
        
        return $query->num_rows;
        
        
        
    }
    
    
    
}

?>