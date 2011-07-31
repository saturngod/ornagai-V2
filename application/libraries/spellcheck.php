<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class spellcheck
{
	function check($text)
	{

		$url="https://www.google.com/tbproxy/spell?lang=en";
		$text = urldecode($text);

		$body = '<?xml version="1.0" encoding="utf-8" ?>';
		$body .= '<spellrequest textalreadyclipped="0" ignoredups="1" ignoredigits="1" ignoreallcaps="1">';
		$body .= '<text>'.$text.'</text>';
		$body .= '</spellrequest>';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$contents = curl_exec($ch);
		curl_close($ch);

		$doc = new DOMDocument();
		$doc->loadXML($contents);
		$component = $doc->getElementsByTagName('c')->item(0);
		if($component!=NULL)
		{
			$result=preg_split('/	/',$component->nodeValue);
			return $result;
		}
		return false;
		
	}
}
?>