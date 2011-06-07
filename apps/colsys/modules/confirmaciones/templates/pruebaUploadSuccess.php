<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$folder="UmVmZXJlbmNpYXMvNTAwLjA1LjA0LjAwMy4xL0xFWCBCUkUgMTEwMzA4MDAwNTM4Lw==";
?>

<form id="nuevo" name="nuevo" method="post" enctype="multipart/form-data" action="/widgets/uploadImages">   
    <input type="hidden" name="folder" id="folder" value="<?=$folder?>" />
    <br/>
    <input type="file" name="Filedata" /><br>
    <input type="submit" />
</form>
