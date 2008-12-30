<div align="center">
<?
use_helper("Javascript");
if( $sf_user->hasCredential("colsys_user") ){
	?>
	
	<?=form_tag("homepage/indexColsys")?>
	
	
	<table width="45%" border="1" class="table1">
		<tr>
			<th colspan="3" scope="col">Por favor selecciona un cliente</th>
		</tr>
		<tr class="row0">
			<td width="29%"><strong>Busqueda</strong></td>
			<td width="35%"><?=input_tag("busqueda")?></td>
			<td width="36%"></td>
		</tr>
		<tr >
			<td colspan="3">
			<div id="listaClientes">
			  <div align="center">
			    <?
			include_component("homepage", "listaClientes");
			?>
		        </div>
			</div>			</td>
		</tr>
		
		<tr>
			<td colspan="3">
			  
	          <div align="center">
	            <?=submit_tag("Continuar", "class=button")?>
                </div></td></tr>
	</table>
	<?
	echo  observe_field("busqueda", array("url"=>"homepage/listaClientes",
									  "update"=>"listaClientes",
									  "with"=>"'filtro='+value", 										  
									  'loading'  => visual_effect('appear', 'indicator'), 
									  'complete' => visual_effect('fade', 'indicator'), 
									 ));
	?>
	
	
	</form>
<?
}
?>
</div>