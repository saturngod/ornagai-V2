<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* CodeIgniter
*
* An open source application development framework for PHP 4.3.2 or newer
*
* @package        CodeIgniter
* @author        Rick Ellis
* @copyright    Copyright (c) 2006, EllisLab, Inc.
* @license        http://www.codeignitor.com/user_guide/license.html
* @link        http://www.codeigniter.com
* @since        Version 1.0
* @filesource
*/

// ------------------------------------------------------------------------

/**
* CodeIgniter GOOGLE Helpers
*
* @package        CodeIgniter
* @subpackage    Helpers
* @category    Helpers
* @author        Todd Perkins
* @link        http://www.undecisive.com
*/

// ------------------------------------------------------------------------

/**
* Google Analytics
*
* Inserts google analytics tracking code into view
* If a tracking code is passed in, then it will use that uacct info
* Otherwise, it will use the value defined in the google.php config file
* If both values do not exist, nothing will be inserted.
* 
* mobile by saturngod
*
* @access    public
* @param    string
* @return    string
*/
function google_analytics($uacct = '')
{
    
    $CI =& get_instance();
    
    if(
        $uacct != '' ||
        $CI->config->slash_item('google_uacct') != ''
    ){

        if($CI->config->slash_item('google_uacct') != ''){
            
            // Found config setting
            $google_analytics_code = '
                <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
                </script>
                <script type="text/javascript">
                _uacct = "'.$CI->config->item('google_uacct').'";
                urchinTracker();
                </script>
            ';
            
        }
        
        // In the event that both the google_uacct variable is set, AND we find that the $uacct
        // Variable is passed in, the return variable $google_analytics_code will be overwritten
        // with the $uacct variable taken priority.
        
        if($uacct != ''){
            
            // Found $uacct variable data
            $google_analytics_code = '
                <script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
                </script>
                <script type="text/javascript">
                _uacct = "'.$uacct.'";
                urchinTracker();
                </script>
            ';
            
        }
        
        
        if($google_analytics_code != ""){
            return $google_analytics_code;
        }
    
    
    }
    
}

function google_analytics_mobile($uacct = '')
{

	$CI =& get_instance();
	    
	if( $uacct != '' || $CI->config->slash_item('google_uacct_m') != '')
	 {
			$GA_ACCOUNT = $uacct;
	        if($CI->config->slash_item('google_uacct-M') != ''){
			  $GA_ACCOUNT = $CI->config->slash_item('google_uacct-M');
			}
			
			$GA_PIXEL = $CI->config->slash_item('base_url')."ga/ga.php";
			
		    $url = "";
		    $url .= $GA_PIXEL . "?";
		    $url .= "utmac=" . $GA_ACCOUNT;
		    $url .= "&utmn=" . rand(0, 0x7fffffff);
		    
		    $referer="";
		    if(isset($_SERVER["HTTP_REFERER"]))
		    {
		    	$referer = $_SERVER["HTTP_REFERER"];
		    }
		    $query = $_SERVER["QUERY_STRING"];
		    $path = $_SERVER["REQUEST_URI"];
		    if (empty($referer)) {
		      $referer = "-";
		    }
		    $url .= "&utmr=" . urlencode($referer);
		    if (!empty($path)) {
		      $url .= "&utmp=" . urlencode($path);
		    }
		    $url .= "&guid=ON";
		    $imglnk= str_replace("&", "&amp;", $url);
			    
			    
			$img= "<img src='".$imglnk."' />";
			return $img;
			
	}
	  
}

?> 