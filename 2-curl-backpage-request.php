<?php
	
	//Function to make GET request using cURL
	function curlGet($url) {
		
		$ch = curl_init(); //Initialising cURL session
		
		// Setting cURL options
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_URL, $url); 
		
		$results = curl_exec($ch); //Executing cURL session
		
		curl_close($ch); //Closing cURL session
		
		return $results; //Return the result
	}
	
	$backpagePage = curlGet('http://nashville.backpage.com/BodyRubs/');
	
	echo $backpagePage;
?>
