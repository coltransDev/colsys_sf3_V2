<?
echo input_hidden_tag("idtercero[9999]",$tercero->getCaIdtercero() );
echo input_hidden_tag("nombre[9999]",$tercero->getCaNombre() );
echo input_hidden_tag("contacto[9999]",$tercero->getCaContacto() );
echo input_hidden_tag("direccion[9999]",str_replace("|" , " " , $tercero->getCaDireccion()) );
echo input_hidden_tag("telefonos[9999]",$tercero->getCaTelefonos() );
echo input_hidden_tag("fax[9999]",$tercero->getCaFax() );
echo input_hidden_tag("email[9999]",$tercero->getCaEmail() );
?>
<script language="javascript" type="text/javascript">
	seleccionTercero("<?=isset($formName)?$formName:""?>",9999);
</script>
