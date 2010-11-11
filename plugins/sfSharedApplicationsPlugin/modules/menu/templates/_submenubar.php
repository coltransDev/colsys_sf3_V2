<?

$buttons = $sf_data->getRaw('buttons');

if( count($buttons)>0 ){
?>
<br />
<div align="center">
<div class="toolbar">
	<div class="submenuleft" ><?=image_tag("layout/submenu/leftbg.gif")?></div>
	<div class="submenuright" ><?=image_tag("layout/submenu/rightbg.gif")?></div>
<?php 		
foreach($buttons as $button){			
	isset($button['onClick'])?$onClick="onClick='".$button['onClick']."'":$onClick="";
	isset($button['options'])?$options=$button['options']."'":$options="";
?>	
  <div class="toolbarbtnWraper">  	
  	
	<?			
	echo image_tag("");
	if( isset($button['onClick']) ){
            $button['id']=isset($button['id'])?$button['id']:"";
		?>
		<a onclick="<?=$button['onClick']?>" class="toolbarBtn" <?=$button['id']?'id="'.$button['id'].'"':""?>><?=image_tag( $button["image"] ) ." ".$button["name"] ?></a>
		<?
	}else{
		echo link_to( image_tag( $button["image"] ) ." ".$button["name"]  , isset($button["link"])?$button["link"]:"#" , "$options class=toolbarBtn  $onClick ".($button["tooltip"]?" title='".$button["tooltip"]."'":"")." ".(isset($button["confirm"])?" confirm='".$button["confirm"]."'":"") ); 					
	}//onmouseover=return overlib('".$button["tooltip"]."') onmouseout=return nd();
		
	?>
	</div>
<?php 
}
if(isset($buttonHelp) && count($buttonHelp)>0)
{


?>
    <div class="toolbarbtnhelp">
        <a onclick="<?=$buttonHelp['onClick']?>" class="toolbarBtn"><?=image_tag( $buttonHelp["image"] ) ?></a>
    </div>
<?
}
?>
</div>
</div>

<?
}
?>
