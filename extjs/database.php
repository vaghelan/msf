<?php

////////////////////////////////////////////////////////
//  DATABASE.PHP - TUTORIAL PART 2
////////////////////////////////////////////////////////

// This will connect us to our database...
mysql_connect("localhost", "root", "") or
   die("Could not connect: " . mysql_error());
mysql_select_db("tutorial");

// The ext grid script will send  a task field which will specify what it wants to do
$task = '';
if ( isset($_POST['task'])){
	$task = $_POST['task'];
}
switch($task){
    case "LISTING":
        getList();
        break;		
    default:
        echo "{failure:true}";
        break;
}

function getList() 
{
	$query = "SELECT * FROM presidents pr, parties pa WHERE pr.IDparty = pa.IDparty";
	$result = mysql_query($query);
	$nbrows = mysql_num_rows($result);	
	if($nbrows>0){
		while($rec = mysql_fetch_array($result)){
            // render the right date format
			$rec['tookoffice']=codeDate($rec['tookoffice']);
			$rec['leftoffice']=codeDate($rec['leftoffice']);      
			$arr[] = $rec;
		}
		$jsonresult = JEncode($arr);
		echo '({"total":"'.$nbrows.'","results":'.$jsonresult.'})';
	} else {
		echo '({"total":"0", "results":""})';
	}
}

// Encodes a SQL array into a JSON formated string
function JEncode($arr){
    if (version_compare(PHP_VERSION,"5.2","<"))
    {    
        require_once("./JSON.php"); //if php<5.2 need JSON class
        $json = new Services_JSON();//instantiate new json object
        $data=$json->encode($arr);  //encode the data in json format
    } else
    {
        $data = json_encode($arr);  //encode the data in json format
    }
    return $data;
}

// Encodes a YYYY-MM-DD into a MM-DD-YYYY string
function codeDate ($date) {
	$tab = explode ("-", $date);
	$r = $tab[1]."/".$tab[2]."/".$tab[0];
	return $r;
}

// Encodes a MM-DD-YYYY into a YYYY-MM-DD string
function decodeDate ($date) {
	$tab = explode ("/", $date);   
	$n = count($tab);
	if($n==3) {
		$r = $tab[2]."-".$tab[0]."-".$tab[1];
	} else {
		$r = "";
	}
	return $r;
}
?> 