<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zawgyi {

    function normalize($string,$cb="|",$syllable=true)
	{

	$string=$string." ";
	$string=str_replace("။"," ။",$string);
	$ka_ah="(က|ခ|ဂ|ဃ|င|စ|ဆ|ဇ|ဈ|ဉ|ည|ဋ|႗|ဥ|ဍ|ဎ|ဏ|တ|ထ|ဒ|ဓ|န|ႏ|ပ|ဖ|ဗ|ဘ|မ|ယ|ရ|႐|လ|ဝ|သ|ႆ|ဟ|ဠ|႒|ဧ|အ|႑|၏|ဩ|၍|၎|၌)";
	$ka_ah2="(က|ခ|ဂ|ဃ|င|စ|ဆ|ဇ|ဈ|ဉ|ည|ဋ|႗|ဥ|ဍ|ဎ|ဏ|တ|ထ|ဒ|ဓ|န|ႏ|ပ|ဖ|ဗ|ဘ|မ|ယ|ရ|႐|လ|ဝ|သ|ႆ|ဟ|ဠ|႒|ဧ|အ|႑|၏|ဩ|၍|၎|၌|ေ|ၾ|ျ|ႄ|ၿ|ႁ||)";
	
	$mypattern="(ံ|ိ|ီ|ႋ|ႌ|ႍ|ႎ|ာ|ါ|ၚ|ဳ|ဴ|ြ|ႊ|ု|ူ|ႈ|္|း|ဲ|့|႕|်|ၽ|ွ|ၤ|္)";
	
	$low_char="ၤ|ၠ|ၡ|ၢ|ၣ|ၥ|ၦ|ၧ|ၬ|ၭ|ၨ|ၰ|ၱ|ၳ|ၲ|ၳ|ၴ|ၵ|ၶ|ၷ|ၸ|ၹ|ၺ|ၻ|ၼ|ႅ|႓|႖|ႆ";
	
	/*
	
	$low_char="1060|1061|1062|1063|1065|1066|1067|106C|106D|1068|1070|1071|1073|1072|1073|1074|1075|1076|1077|1078|1079|107A|107B|107C|1085|1093|1096";
	
	*/
	$j=0;
	
	$pattern[$j]="/(ွ|ု|ူ|ဳ|ဴ|ႈ)(ံ|ိ|ီ|ႋ|ႌ|ႍ|ႎ)/";
	$replacement[$j] = '$2$1';
	
	$j=$j+1;
	
	$pattern[$j]="/(ံ|ိ|ီ|ႋ|ႌ|ႍ|ႎ)(်|ၽ)/";
	$replacement[$j] = '$2$1';
	
	$j=$j+1;
	
	
	$pattern[$j]="/(ွ|ု|ူ|ဳ|ဴ|ႈ)ံ/";
	$replacement[$j] = 'ံ$1';
	
	$j=$j+1;
	
	
	$pattern[$j]="/(ဲ|ံ|ိ|ီ|ႋ|ႌ|ႍ|ႎ|ႋ|ႌ|ႍ|ႎ)(ြ|ႊ)/";
	$replacement[$j] = '$1$2';

	$j=$j+1;
	
	$pattern[$j]="/ေ၇/";
	$replacement[$j] = 'ေရ';

	$j=$j+1;
	
	$pattern[$j]="/၇(ြ|ႊ|ာ|ွ|ု|ႈ)/";
	$replacement[$j] = '႐$1';

	$j=$j+1;
	
	$pattern[$j]="/(႔|႕|႔)/";
	$replacement[$j] = '့';

	$j=$j+1;
	
	
	$pattern[$j]="/ံြ/";
	$replacement[$j] = 'ြံ';
	
	$j=$j+1;
	 
	 $pattern[$j]="/(န|ရ)(ဲ|္|ံ)(့|႕)/";
	$replacement[$j]="$1$2႕";
	
	$j=$j+1;
	
	$pattern[$j]="/(န|ရ)(့|႕)(ဲ|္|ံ)/";
	$replacement[$j]="$1$3႕";
	
	$j=$j+1;
	
	$pattern[$j]="/(့|႕)္/";
	$replacement[$j] = '္$1';

	$j=$j+1;
	
	$pattern[$j]="/(ျ|ၿ|ႁ)/";
	$replacement[$j] = 'ျ';

	$j=$j+1;
	
	$pattern[$j]="/ျ(ခ|ဂ|င|စ|ဒ|ဓ|ႏ|ပ|ဖ|ဗ|မ|ဝ)(ံ|ိ|ီ|ႋ|ႌ|ႍ|ႎ)/";
	$replacement[$j] = 'ၿ$1$2';
	
	$j=$j+1;
	
	$pattern[$j]="/ျ(ခ|ဂ|င|စ|ဒ|ဓ|ႏ|ပ|ဖ|ဗ|မ|ဝ)ြ/";
	$replacement[$j] = 'ႁ$1ြ';
	
	$j=$j+1;
	
	$pattern[$j]="/ျ(ခ|ဂ|င|စ|ဒ|ဓ|ႏ|ပ|ဖ|ဗ|မ|ဝ)ိြ/";
	$replacement[$j] = 'ႃ$1ိြ';
	
	$j=$j+1;
	
	$pattern[$j]="/(ၾ|ႀ|ႂ|ႄ|ႄ)/";
	$replacement[$j]="ၾ";

	$j=$j+1;
	
	$pattern[$j]="/ၾ(က|ဆ|တ|ထ|သ)(ံ|ိ|ီ|ႋ|ႌ|ႍ|ႎ)ြ/";
	$replacement[$j]="ႄ$1$2ြ";
	
	$j=$j+1;
	
	$pattern[$j]="/ၾ(က|ဆ|တ|ထ|သ)(ံ|ိ|ီ|ႋ|ႌ|ႍ|ႎ)/";
	$replacement[$j]="ႀ$1$2";

	$j=$j+1;
	
	$pattern[$j]="/ၾ(က|ဆ|တ|ထ|သ)ြ/";
	$replacement[$j]="ႂ$1ြ";
	
	$j=$j+1;
	
	$pattern[$j]="/ာၤ/";
	$replacement[$j] = 'ၤာ ';
	
	$j=$j+1;
	
	$pattern[$j]="/့(ု|ူ|ဳ|ဴ|ႈ|ွ)/";
	$replacement[$j]="$1႕";
	
	$j=$j+1;
	
	$pattern[$j]="/(ြ|ႊ|ု|ူ|ဳ|ဴ|ႈ|ွ|န)့/";
	$replacement[$j]="$1႕";
	
	$j=$j+1;
	
	$pattern[$j]="/ံ(|ြ|ႊ)့/";
	$replacement[$j]="ံ$1႕";
	
	$j=$j+1;
	
	$pattern[$j]="/(ြ|ႊ)(်|ၽ)/";
	$replacement[$j]="ၽ$1";
	
	$j=$j+1;
	
	$pattern[$j]="/ြ့/";
	$replacement[$j]="ြ႕";
	
	$pattern[$j]="/၀/";
	$replacement[$j]="ဝ";
	
	$j=$j+1;
	
	$pattern[$j]="/(၁|၂|၃|၄|၅|၆|၇|၈|၉)ဝ/";
	$replacement[$j]="$1၀";
	
	$j=$j+1;
	
	$pattern[$j]="/(ဲ)(ြ)/";
	$replacement[$j]="$2$1";
	
	$j=$j+1;
	
	$pattern[$j]="/ိ(".$low_char.")/";
	$replacement[$j]="$1ိ";
	
	$j=$j+1;
	
	$pattern[$j]="/ံ(".$low_char.")/";
	$replacement[$j]="$1ံ"; 
	
	$j=$j+1;
	
	$pattern[$j]="/(ံ|ိ|ီ|ႋ|ႌ|ႍ|ႎ|ဲ)+/";
	$replacement[$j]="$1";
	
	$j=$j+1;
	
	$pattern[$j]="/(ေ)+/";
	$replacement[$j]="$1";
	
	$j=$j+1;
	
	$pattern[$j]="/(ံ)+/";
	$replacement[$j]="$1";
	
	$j=$j+1;
	
	$pattern[$j]="/ ့/";
	$replacement[$j]="႕";
	
	$j=$j+1;
	
	$pattern[$j]="/ေ( )+/";
	$replacement[$j]="ေ";
	
	$j=$j+1;
	
	$pattern[$j]="/(့|႕)+/";
	$replacement[$j]="$1";
	
	$j=$j+1;
	
	$pattern[$j]="/(ု|ူ|ႈ|ွ)+/";
	$replacement[$j]="$1";
	
	$j=$j+1;
	
	$pattern[$j]="/ပိသာ/";
	$replacement[$j]="ပိႆာ";
	
	$j=$j+1;
	
	$pattern[$j]="/ဥ္/";
	$replacement[$j]="ဉ္";
	
	$j=$j+1;
	
	
	$pattern[$j]="/(က|တ|ထ|ဝ|ည)ံ႕/";
	$replacement[$j] = '$1ံ့';
	
	$j=$j+1;
	
	$pattern[$j]="/(က|တ|ဝ|ထ|ည)့ံ/";
	$replacement[$j] = '$1ံ့';
	
	$j=$j+1;
	
	$pattern[$j]="/ျပသနာ/";
	$replacement[$j]="ျပႆနာ";
	
	$j=$j+1;
	
	$pattern[$j]="/ဧ။္/";
	$replacement[$j]="၏";
	
	$j=$j+1;
	
	$pattern[$j]="/ၾသ/";
	$replacement[$j]="ဩ";
	
	$j=$j+1;
	
	$pattern[$j]="/စ်/";
	$replacement[$j]="ဈ";
	
	$j=$j+1;
	
	$pattern[$j]="/ါ/";
	$replacement[$j]="ာ";
	
	$j=$j+1;
	
	$pattern[$j]="/(ခ|ဂ|င|ဒ|ဝ|ပ)ာ/";
	$replacement[$j]="$1ါ";
	
	$j=$j+1;
	
	$pattern[$j]="/(ျ|ၿ|ႁ)(ခ|ဂ|င|ဒ|ဝ|ပ)ါ/";
	$replacement[$j]="$1$2ာ";
	
	$j=$j+1;
	
	$pattern[$j]="/(ခ|ဂ|င|ဒ|ဝ|ပ)(".$low_char.")ာ/";
	$replacement[$j]="$1$2ါ";
	
	$j=$j+1;
	
	$pattern[$j]="/(ြ|ႊ)ဲ့/";
	$replacement[$j]="$1ဲ႕";
	
	$j=$j+1;
	
	$pattern[$j]="/".$ka_ah."ံဳ/";
	$replacement[$j]="$1ံု";
	
	$j=$j+1;
	
	$pattern[$j]="/".$ka_ah."ံဴ/";
	$replacement[$j]="$1ံူ";
	
	$pattern[$j]="/(ျ|ၿ|ႁ)".$ka_ah."ံု/";
	$replacement[$j]="$1$2ံဳ";
	
	$j=$j+1;
	
	$pattern[$j]="/(ျ|ၿ|ႁ)".$ka_ah."ံူ/";
	$replacement[$j]="$1$2ံဴ";
	
	$j=$j+1;
	
	$k=$j;
	
	
	if ($syllable==true)
	{
		/////////////////////////////////////////////////////////////
		/////////////////////// Character Breaking ////////////////////
		////////////////////////////////////////////////////////////
		//$cb="|";//character break
			
		$pattern[$j]="/(".$low_char.")()/";
		$replacement[$j]="$1".$cb; 
		
		$j=$j+1;
			
		$pattern[$j]="/".$ka_ah."/";
		$replacement[$j]="$1".$cb;
		
		$j=$j+1;
		
		$pattern[$j]="/".$mypattern."/";
		$replacement[$j]="$1".$cb;
		
		$j=$j+1;
		
		$pattern[$j]="/(\\".$cb.")+/";
		$replacement[$j]=$cb;
		
		$j=$j+1;
		
		
		
		$pattern[$j]="/\\".$cb."(".$low_char.")/";
		$replacement[$j]="$1";
		
		$j=$j+1;
		
		$pattern[$j]="/\\".$cb.$ka_ah2."(".$low_char.")/";
		$replacement[$j]="$1$2";
		
		$j=$j+1; 
		
		$pattern[$j]="/\\".$cb."ေ".$ka_ah."+(".$low_char.")/";
		$replacement[$j]="ေ$1$2$3";
		
		$j=$j+1; 
		
		$pattern[$j]="/\\".$cb.$mypattern."/";
		$replacement[$j]="$1";
		
		$j=$j+1;
		
		$pattern[$j]="/\\".$cb."(့|႕)/";
		$replacement[$j]="$1";
		
		$j=$j+1;
		
		$pattern[$j]="/\\".$cb."(".$ka_ah."္)+/";
		$replacement[$j]="$2္";
		
		$j=$j+1;
		
		$pattern[$j]="/\\".$cb."".$ka_ah.$mypattern."္/";
		$replacement[$j]="$1$2္";
		
		$j=$j+1;
		
		/*$pattern[$j]="/\\ေ".$cb.$ka_ah."(".$low_char.")/";
		$replacement[$j]="$1$2";
		
		$j=$j+1;
		*/
		$pattern[$j]="/".$cb."(".$low_char.")/";
		$replacement[$j]="$1"; 
		
		$j=$j+1;
		
	
	}
	
	$string=preg_replace($pattern, $replacement, $string);
		
	$string=str_replace(" ။","။",$string);
	$string = substr($string, 0, -1);  
	$string=stripslashes($string);
	
	return $string;
    }
}

?>