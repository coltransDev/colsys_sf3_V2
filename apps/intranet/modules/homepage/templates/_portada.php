<?php
$ids = [1,2,4,8,11];

if(!in_array($idempresa, $ids)){
    $idempresa = 2;
}        
eval('$video = "/usodelpapel_' . $idempresa . '.mp4";');
?>
<h2>Uso y ahorro del papel</h2>

<video width="520" height="330" controls autoplay muted>
    <source src="<?= url_for("images/video") . $video ?>" type="video/mp4">
    Your browser does not support the video tag.
</video> 

<?
eval('$video = "/manejoimpresoras_' . $idempresa . '.mp4";');
?>
<h2>Manejo y cuidado de impresoras</h2>

<video width="520" height="330" controls>
    <source src="<?= url_for("images/video") . $video ?>" type="video/mp4">
    Your browser does not support the video tag.
</video> 