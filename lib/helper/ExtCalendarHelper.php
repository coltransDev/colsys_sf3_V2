<?
/*
* Este archivo contiene helpers de uso comun como por ejemplo selección de clientes, impo/expo, modalidad, etc..
*/


function extDatePicker( $field_id, $value=null , $html_options=null , $mindate=null, $maxdate=null , $trigger = null, $modificable=false ){	
	
	$html = "
		<input type='text' id='".$field_id."' name='".$field_id."' />
		<script language='javascript' type='text/javascript'>
			new Ext.form.DateField({
				 applyTo: '".$field_id."',
				 value: '".$value."'
			});
		</script>
	
	";
					
	
	return $html;
}

?>