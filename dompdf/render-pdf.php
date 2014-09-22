<?php 
/***********************
** DEV CODE **
************************/
$upload_dir = \wp_upload_dir(); // GET UPLOAD DIRECTORY ARRAY
$upload_path = $upload_dir['basedir'].'/generated_pdfs'; // SET UPLOAD PATH
/** END **/

require_once("dompdf_config.inc.php");
define('CURRENTURL', 'http://m1.wpdev.cahnrs.wsu.edu/wp-content/plugins/impact-reports');
ob_start();
include 'layouts/impact-report.php';
$html = ob_get_clean();

$dompdf = new DOMPDF();
$dompdf->load_html($html);

$dompdf->render();
//\file_put_contents( $upload_path.'/impact_report.pdf', $dompdf->output());
$dompdf->stream("hello_world.pdf", array("Attachment" => 0) );
?>