<?php
include ('pdfcrowd.php');
try
{ 
    
     $client = new \Pdfcrowd\HtmlToPdfClient("Sean", "1306a3dfb8cebf24565396c60bcab0f4");  

$uri = 'https://bcr-retrofit.bcrcomply.com/dashboard/property/report/1238/21/print';
$pdf = $client->convertUrl($uri);
$path = "/mnt/data/home/500964.cloudwaysapps.com/adpkuenvax/public_html/ecosmartapi/assets/uploads/inspection_photo/jonstest.pdf";
$out_file = fopen($path, "wb");
if (!$out_file) { die("Can't open file:".error_get_last()); }
if (!fwrite($out_file, $pdf)) { die("Can't write file"); }
if (!fclose($out_file)) { die("Can't close file"); }
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}
?>