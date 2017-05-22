<div align="center">
<form action="<?=url_for("login/novell")?>" method="post">

<h3> Bienvenido a nuestro sistema de Tracking </h3>
<br />		
	<div class="box1" style="width:550px" align="center">
		<table width="550px" border="0">
		<tr>
		  <td colspan="2"><div align="center" style="color:#FF0000">&nbsp;</div></td>
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


    <table width="135" border="0" cellpadding="2" cellspacing="0" title="Click to Verify - This site chose VeriSign SSL for secure e-commerce and confidential communications.">
<tr>
<td width="135" align="center" valign="top"><script type="text/javascript" src="https://seal.verisign.com/getseal?host_name=<?=sfConfig::get("app_branding_url")?>&amp;size=S&amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script><br />
<a href="http://www.verisign.com/ssl-certificate/" target="_blank"  style="color:#000000; text-decoration:none; font:bold 7px verdana,sans-serif; letter-spacing:.5px; text-align:center; margin:0px; padding:0px;">ABOUT SSL CERTIFICATES</a></td>
</tr>
</table>

</div>
