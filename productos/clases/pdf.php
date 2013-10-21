
<?php
$valro = $_GET['valor'];
$mi_pdf = 'archivos/documento.pdf';
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="'.$valro.'"');
readfile($valro);
?>