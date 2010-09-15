
<form action="<?=url_for("adminUsers/login")?>" method="post" autocomplete="off">
<br />
<br />


<div align="center"><h3><b> Inicio de Sesi&oacute;n</b></h3></div>
<br />		
	<div class="box1" style="width:450px" align="center">
		<table width="100%" border="0"">
			<tr>
			  <td colspan="2">&nbsp;</td>
			  </tr>
			<tr>
				<td>
					<div align="left">
						<table align="center" >
							<?
							echo $form;
							?>
						</table>
					</div>
		       </td>
			</tr>
			<tr>	
				<td colspan="2"><div align="center"><input type="submit" value="Entrar" class="button" /></div></td>
			</tr>		
		</table>
	</div>
</div>
</form>


<?
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$ie6 = false;
	if( strpos($user_agent , "MSIE 6")!==false ){
		$ie6 = true;
	}
	
	if( $ie6 ){
		?>
		<div align="center">
		<a href="http://www.coltrans.com.co/download/Aplicaciones/IE8-WindowsXP-x86-ESN.exe">
		<br />
		<br />
	
		<?=image_tag("22x22/alert.gif")?> Es recomendable actualizar su versi&oacute;n de Internet Explorer, <br />
		por favor haga click aca 
		</a>
		</div>
		<? 
	}
?>
<br />
<br />
<br />
