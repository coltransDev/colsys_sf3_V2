<table width="100%" border="0" cellspacing="0" cellpadding="0" class="toolbar">
  <tr>			
		<?php 		
		foreach($buttons as $button){			
			isset($button['onClick'])?$onClick="onClick='".$button['onClick']."'":$onClick="";
			isset($button['options'])?$options=$button['options']."'":$options="";
		?>	
    	<td width="50px"><div id="toolbar">
			<?			
			if( isset($button['onClick']) ){
				?>
				<a onclick="<?=$button['onClick']?>" class="toolbar"><?=image_tag( $button["image"] ) ."<br />".$button["name"] ?></a>
				<?
			}else{
				echo link_to( image_tag( $button["image"] ) ."<br />".$button["name"]  , isset($button["link"])?$button["link"]:"#" , "$options class=toolbar  $onClick ".($button["tooltip"]?" title='".$button["tooltip"]."'":"")." ".(isset($button["confirm"])?" confirm='".$button["confirm"]."'":"") ); 					
			}//onmouseover=return overlib('".$button["tooltip"]."') onmouseout=return nd();
				
			?></div></td>
		<?php 
		}
		?>  		
		<td>
			<div id="indicator" style="display:none; height:32px" align="right">
				<?=image_tag("ajax-loader.gif")?>
			</div>
		</td>      		
  </tr>  
</table>
	
			