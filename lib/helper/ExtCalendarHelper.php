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
				 value: '".$value."',
                 width: 100,
                format: 'Y-m-d'
			});
		</script>";
					
	
	return $html;
}

function extTimePicker($field_id, $value='')
{
    
    $html="
    <input type='text' id='".$field_id."' name='".$field_id."' />
    <script language='javascript' type='text/javascript'>
        new Ext.form.TimeField({
        format: 'H:i:s',
        increment: 15,       
        applyTo: '".$field_id."',
        value: '".$value."',
        width: 120
        });
    </script>
";
    
    return $html;
}

?>