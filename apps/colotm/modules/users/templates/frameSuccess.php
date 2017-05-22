<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
<HEAD>
  <TITLE>Sistema de Información - <?=sfConfig::get('app_branding_name')?></TITLE>
</HEAD>

<frameset rows="35,*" cols="*" frameborder="no" border="0" framespacing="0">
	<frame src="<?=url_for("users/titulo")?>" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" />
	<frameset cols="140,*" frameborder="no" border="0" framespacing="0" id="workframe">
		<frame src="<?=url_for("users/menu")?>" name="leftFrame" scrolling="No" noresize="noresize" id="menu" />

		<frame src="<?=url_for("users/homepage")?>" name="mainFrame" id="content" />
	</frameset>
</frameset>
<NOFRAMES>
<BODY BGCOLOR=white>
  <P>Lo siento, pero s&oacute;lo podr&aacute;s ver este sitio si su
  navegador tiene la capacidad de visualizar frames.</P>
  
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-3595860-1";
urchinTracker();
</script>
</BODY>
</NOFRAMES>
</HTML>