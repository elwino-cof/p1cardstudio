<?php
session_start();
$svgfilename = "nameFail.svg" ;
$filename ="nameFail.png";

if ($_SESSION["login"] != "yes") {
	header("Location: https://designedbypirates.com/login/"); /* Redirect browser */
	exit;
}

// Validate Name
if ($_POST['name'] == "First MI Last") {
	echo "fail";
	exit;
}

// Validate Email
$pos = stripos($_POST['email'], "@capitalone.com");
if ($pos === false || $pos == null) {
	echo "fail";
	unset($_SESSION['login']);
	exit;
} else {
	$filename = strtolower(substr($_POST['email'],0,$pos)).".png";
	$svgfilename = strtolower(substr($_POST['email'],0,$pos)).".svg";
}

// Save signature to file
if(isset($_POST['svg'])) {
	//png 
	$im = new Imagick();
	$im -> setBackgroundColor(new ImagickPixel('transparent'));
	$data = base64_decode($_POST['svg']);
	
	$im->readImageBlob($data);
	
	$im->setImageFormat("png24");

	$im->writeImage('images/'.$filename);
	$im->clear();
	$im->destroy();
	
	//save signature to an svg file  	
	$ret = file_put_contents('images/'.$svgfilename, $data, LOCK_EX);
   
}

//save signature to an svg file  
// if(isset($_POST['svg'])) {
// 	$data = base64_decode($_POST['svg']);
// 	
// 	$ret = file_put_contents('images/'.$svgfilename, $data, LOCK_EX);
//    
//      
// }

// Send to Google Doc Form
$fields = array(
    'entry.59127135' => $_POST['name'],
    'entry.1751900457' => $_POST['email'],
    'entry.1017089804' => $_POST['phone'],
    'entry.2058425612' => "https://designedbypirates.com/pilot/images/".$filename,
    'entry.1229183410' => "https://designedbypirates.com/pilot/images/".$svgfilename,
    'entry.884698629' => $_POST['pattern'],
    'entry.873362902' => $_POST['preference'],
    'entry.815939887' => $_POST['sign'],
    'entry.108430054' => $_POST['pay'],
    'entry.1586145813' => $_POST['office'],
    'entry.291991826' => $_POST['last4']
);

$response = http_post_flds("https://docs.google.com/forms/d/1tC8o_9nf_Xj_697EUeGCjwb_C3FOSwTplkUgkLGOf6I/formResponse", $fields);

echo "success";
unset($_SESSION['login']);

function http_post_flds($url, $data, $headers=null) {   
    $data = http_build_query($data);    
    $opts = array('http' => array('method' => 'POST', 'content' => $data));

    if($headers) {
        $opts['http']['header'] = $headers;
    }
    $st = stream_context_create($opts);
    $fp = fopen($url, 'rb', false, $st);

    if(!$fp) {
        return false;
    }
    return stream_get_contents($fp);
}

?>