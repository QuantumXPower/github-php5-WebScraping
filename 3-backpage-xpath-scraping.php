<?php

//Function to make GET request using cURL
function curlGet($url){
	$ch = curl_init();
	//setting cURL options
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_URL, $url);
	$results = curl_exec($ch); //Executing cURL session
	curl_close($ch); //Closing cURL session
	return $results; //Return the results
}

$backpagePage = array(); //Declaring array to store scraped backpage data

//Function to return XPath object
function returnXPathObject($item) {
	$xmlPageDom = new DomDocument();	//Instanting a new DomDocument object
	@$xmlPageDom->loadHTML($item);	//Loading the HTML from downloaded page
	$xmlPageXPath = new DOMXPath($xmlPageDom);	//Instanting new XPath DOM object
	return $xmlPageXPath;	//Return XPath object
}

$backpagePage = curlGet('http://nashville.backpage.com/BodyRubs/?layout=gallery');

//Calling function curlGet and storing returned results in $backpagePage variable

$backpagePageXpath = returnXPathObject($backpagePage); //Instantiating new XPath DOM object

$title = $backpagePageXpath->query('//h1'); //Querying for <h1> (title of book)

//If title exists
if($title->length > 0){
	$backpageBodyRub['title'] = $title->item(0)->nodeValue; //Add Title to array
}

$mainBody = $backpagePageXpath->query('//span[@class="mainBody"]');
//Querying for class="mainBody"> 

//If release date exists
if($mainBody->length > 0){
	$backpageBodyRub['mainBody'] = $release->item(0)->nodeValue; //Add release date to array
}

$catgallery = $backpagePageXpath->query('//div[@class="cat gallery"]');
//Querying for <div class= "cat gallery">

//IF overview exists
if($catgallery->length > 0){
	$backpageBodyRub['catgallery'] = trim($catgallery->item(0)->nodeValue); //Add overview to array
	//Trim whitespace and add overview to array
}

$galleryImgCont = $backpagePageXpath -> query('//div[@class="galleryImgCont"]/div[@class="galleryHeader"]/a');
//Querying for all images and their headers

//if author exist
if($galleryImgCont->length > 0)
{
	//For each @author OxfordHouseCorp
	for($i = 0; $i < $galleryImgContr->length; $i++){
		$backpageBodyRub['galleryInfo'][] = $galleryImgCont->item($i)->nodeValue; 
		//Add author to 2nd dimension of array
	}
}

print_r($backpageBodyRub);
?>