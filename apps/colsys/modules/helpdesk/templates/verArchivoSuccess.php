<?php
/*
 *  This file is part of the Colsys Project.
 *
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<?
header('Content-Disposition: attachment; filename="'.basename($file).'"');
header('content-type: "'.Utils::mimetype($file).'"');
header('Content-Length: '.filesize($file));


readfile( $file );

exit();
?>