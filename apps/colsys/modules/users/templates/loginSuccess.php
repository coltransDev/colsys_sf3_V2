
<form action="<?=url_for("users/login")?>" method="post" autocomplete="off">
<br />
<br />


<h3> Bienvenido a Colsys</h3>
<br />		
	<div class="box1" style="width:550px" align="center">
		<table width="550px" border="0">
		<tr>
		  <td colspan="2">&nbsp;</td>
		  </tr>
		<tr>
			<td width="169">
			<?=image_tag("logo_colsys.gif")?>			</td>
			<td width="371">
				<div align="left">
				<table >
					<?
					echo $form;
					?>
				</table>
				</div>		  </td>
		</tr>
	
		<tr>	
			<td colspan="2"><div align="center"><input type="submit" value="Entrar" class="button" /></div></td>
		</tr>		
	</table>
	</div>
		


</form>


<!--<table width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose VeriSign SSL for secure e-commerce and confidential communications.">
<tr>
<td width="135" align="center" valign="top"><script type="text/javascript" src="https://seal.verisign.com/getseal?host_name=www.coltrans.com.co&amp;size=S&amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script><br />
<a href="http://www.verisign.com/ssl-certificate/" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a></td>
</tr>
</table>-->


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
