<?php // block any attempt to the filesystem

$filename = $_GET['name'];
$path = 'Report/'.$filename;
// check that file exists and is readable
if (file_exists($path) && is_readable($path)) {
// get the file size and send the http headers
$size = filesize($path);
header('Content-Type: application/octet-stream');
header('Content-Length: '.$size);
header('Content-Disposition: attachment; filename='.$filename);
header('Content-Transfer-Encoding: binary');
// open the file in binary read-only mode
// display the error messages if the file can´t be opened
$name = @ fopen($path, 'rb');
if ($name) {
// stream the file and exit the script when complete
fpassthru($name);
exit;
} else {
echo $err;
}
} else {
echo $err;
}
?>