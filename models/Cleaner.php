<?php
class Cleaner
{
	public function __construct()
	{

	}
	public static function cleanInput($input)
	{
	  	$search = array(
				    '@<script[^>]*?>.*?@si',
				    '@<[/!]*?[^<>]*?>@si',
				    '@<style[^>]*?>.*?</style>@siU',
				    '@<![sS]*?--[ tnr]*>@'
			  	);
		$output =preg_replace($search, '', $input);
		$output = htmlspecialchars($output, ENT_QUOTES);
		$output  =addslashes(trim($output));
		$output =addslashes(trim($output));
	  	return $output;
	}
}