<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<b>Organigrama</b><br/>
<?=($manager->getCaDepartamento()) ?><br/>
<br/>

<div class="box1">
    <table bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" align="center">
       <tbody>
        <tr>
            <td width="150" align="center">
                <font size="2">
                    <b><a href="<?=url_for('adminUsers/viewUser?login='.$manager->getCaLogin()) ?>"><?=($manager->getCaNombre())?></a></b>
                </font>
            </td>
        </tr>
        <tr>
            <td width="150" align="center"><font size="1"><?=$manager->getCaCargo()?></font></td>
        </tr>
        <?
        if( $manager->getCaManager() ){
        ?>
        <tr>
            <td width="150" align="center">
                <?=link_to(image_tag("left.gif"),"adminUsers/viewOrganigrama?login=".$manager->getCaManager())?></td>
        </tr>
        <?
        }
        ?>
    </table>
</div>

<table bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0" align="center">
<?
   $numUsuarios = count($usuarios);
   for ($i=0; $i<$numUsuarios; $i++){
    $usuario = $usuarios[$i];

?>
    <tr>
        <td align="right">
			<?
				if($i==$numUsuarios-1){
					echo image_tag("l.jpg");
				}else{
					
					echo image_tag("t.jpg");
				}
            ?>
		</td>
        <td>
			<div class="box1">
						<table bgcolor="#fdfdfd" border="0" cellpadding="0" cellspacing="0">
						   <tbody>
							<tr>
								<td width="150" align="center">
									<font size="2">
										<b><a href="<?=url_for('adminUsers/viewUser?login='.$usuario->getCaLogin()) ?>"><?=($usuario->getCaNombre())?></a></b>
									</font>
								</td>
							</tr>
							<tr>
								<td width="150" align="center"><font size="1"><?=($usuario->getCaCargo())?></font></td>
							</tr>
							<?
							$subs = $usuario->getSubordinado();
							if(count($subs)>0){
							?>
							<tr>
								<td width="150" align="center">
									<?=link_to(image_tag("right.gif"),"adminUsers/viewOrganigrama?login=".$usuario->getCaLogin())?></td>
							</tr>
							<?
							}
							?>
					   </table>
			</div>
		</td>
	</tr>
 <?
   }
 ?>

    </table>