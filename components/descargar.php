<div class='container'>
 <h1>Create and Download Zip file using PHP</h1>
 <form method='post' action=''>
   <input type='submit' name='create' value='Create Zip' />&nbsp;
   <input type='submit' name='download' value='Download' />
 </form>
</div>
<?php

include_once '../models/db.php';
include_once '../models/user_session.php';
require_once '../models/user.php';
$userSession = new UserSession();
$user = new User();

if (isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser($user));
}

$db = new DB();
if(isset($_REQUEST['beca'])) {
    $beca = $_REQUEST['beca'];
    if ($beca === '0') {
        $alumnos = $db->getAlumnos();
    } else {
        $alumnos = $db->getAlumnosConectar();
    }
}

if ($user->getTipoUsuario() === 0){
    
    $zip = new ZipArchive();
    if ($beca === '0') {
        $filename = "../files/documentacion-alumnos-teran.zip";
    } else {
        $filename = "../files/documentacion-alumnos-conectividad.zip";
    }

    if(file_exists($filename)) {
        unlink($filename);
    }

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit("cannot open <$filename>\n");
    }

    foreach($alumnos as $alumno){
        $documentacion = $db->tieneDocumentacion($alumno['idUsuario']);
        foreach($documentacion as $documento){
            if($documento) {
                $file = $alumno['DNI'] .'.pdf';
                $filepath = '../files/' .$alumno['Usuario'] .'/' .$file;
                $zip->addFile($filepath,$file);
            }
        }
    }
    $zip->close();

    if(file_exists($filename)) {
        if ($beca === '0') {
            output_file($filename, 'documentacion-teran.zip');
        } else {
            output_file($filename, 'documentacion-conectividad.zip');
        }
        exit;
    } else {
        http_response_code(404);
        die();
    }
    

}

function output_file($file, $name, $mime_type='')
{
 /*
 This function takes a path to a file to output ($file),  the filename that the browser will see ($name) and  the MIME type of the file ($mime_type, optional).
 */

 $size = filesize($file);
 $name = rawurldecode($name);

 /* Figure out the MIME type | Check in array */
 $known_mime_types=array(
    "pdf" => "application/pdf",
    "txt" => "text/plain",
    "html" => "text/html",
    "htm" => "text/html",
    "exe" => "application/octet-stream",
    "zip" => "application/zip",
    "doc" => "application/msword",
    "xls" => "application/vnd.ms-excel",
    "ppt" => "application/vnd.ms-powerpoint",
    "gif" => "image/gif",
    "png" => "image/png",
    "jpeg"=> "image/jpg",
    "jpg" =>  "image/jpg",
    "php" => "text/plain"
 );

 if($mime_type==''){
     $file_extension = strtolower(substr(strrchr($file,"."),1));
     if(array_key_exists($file_extension, $known_mime_types)){
        $mime_type=$known_mime_types[$file_extension];
     } else {
        $mime_type="application/force-download";
     };
 };

 //turn off output buffering to decrease cpu usage
 @ob_end_clean(); 

 // required for IE, otherwise Content-Disposition may be ignored
 if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');

 header('Content-Type: ' . $mime_type);
 header('Content-Disposition: attachment; filename="'.$name.'"');
 header("Content-Transfer-Encoding: binary");
 header('Accept-Ranges: bytes');

 /* The three lines below basically make the 
    download non-cacheable */
 header("Cache-control: private");
 header('Pragma: private');
 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

 // multipart-download and download resuming support
 if(isset($_SERVER['HTTP_RANGE']))
 {
    list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
    list($range) = explode(",",$range,2);
    list($range, $range_end) = explode("-", $range);
    $range=intval($range);
    if(!$range_end) {
        $range_end=$size-1;
    } else {
        $range_end=intval($range_end);
    }

    $new_length = $range_end-$range+1;
    header("HTTP/1.1 206 Partial Content");
    header("Content-Length: $new_length");
    header("Content-Range: bytes $range-$range_end/$size");
 } else {
    $new_length=$size;
    header("Content-Length: ".$size);
 }

 /* Will output the file itself */
 $chunksize = 1*(1024*1024); //you may want to change this
 $bytes_send = 0;
 if ($file = fopen($file, 'r'))
 {
    if(isset($_SERVER['HTTP_RANGE']))
    fseek($file, $range);

    while(!feof($file) && 
        (!connection_aborted()) && 
        ($bytes_send<$new_length)
          )
    {
        $buffer = fread($file, $chunksize);
        print($buffer); //echo($buffer); // can also possible
        flush();
        $bytes_send += strlen($buffer);
    }
 fclose($file);
 } else
 //If no permissiion
 die('Error - can not open file.');
 //die
die();
}
?>
