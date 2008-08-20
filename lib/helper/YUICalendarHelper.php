<?
function yui_flat_calendar( $selectHandler, $default_date ){

	
	?>
	<div id="cal1Container"></div>
	<script>
				YAHOO.namespace("example.calendar");

				function init() {
					YAHOO.example.calendar.cal1 = new YAHOO.widget.Calendar("cal1","cal1Container");
			
					YAHOO.example.calendar.cal1.selectEvent.subscribe(<?=$selectHandler?>, YAHOO.example.calendar.cal1, true);
					
					
					
					YAHOO.example.calendar.cal1.render();
				}
								
				YAHOO.util.Event.addListener(window, "load", init);
		</script>
		
		
	<?
}


function yui_calendar( $field_id, $value=null , $html_options=null , $mindate=null, $maxdate=null , $trigger = null, $modificable=false ){
	ob_start(); 
?>
<script language="javascript" type="text/javascript">

YAHOO.namespace("example.calendar");

function init_<?=$field_id."_cal"?>() {
	YAHOO.example.calendar.<?=$field_id."_cal"?> = new YAHOO.widget.Calendar("<?=$field_id."_cal"?>","<?=$field_id."_cal"?>Container", { title:"Choose a date:", close:true  <?=$mindate?', mindate:"'.Utils::parseDate( $mindate, "m/d/Y").'"':""?>  <?=$maxdate?', maxdate:"'.Utils::parseDate( $maxdate, "m/d/Y").'"':""?>   }  );
	
	
	// Listener to show the 1-up Calendar when the button is clicked
	YAHOO.util.Event.addListener("<?=$field_id."Show"?>", "click", YAHOO.example.calendar.<?=$field_id."_cal"?>.show, YAHOO.example.calendar.<?=$field_id."_cal"?>, true);
	
	YAHOO.example.calendar.<?=$field_id."_cal"?>.selectEvent.subscribe(handleSelect_<?=$field_id."_cal"?>, YAHOO.example.calendar.<?=$field_id."_cal"?>,true  );
	<?
	if( $value ){
	?>
	updateCal_<?=$field_id."_cal"?>();
	<?
	}
	?>
	
	YAHOO.example.calendar.<?=$field_id."_cal"?>.render();
	
	
	function handleSelect_<?=$field_id."_cal"?>(type,args,obj) {
		var dates = args[0]; 
		var date = dates[0];
		var year = date[0], month = date[1], day = date[2];
		
		if( month<10 ){
			month = "0"+month;
		}
		if( day<10 ){
			day = "0"+day;
		}
		YAHOO.example.calendar.<?=$field_id."_cal"?>.hide();
		var txtDate1 = document.getElementById("<?=$field_id?>");
		txtDate1.value = year + "-" + month + "-" + day;
			
		
		
		<?
		if( $trigger ){
			if( strpos($trigger, "(" ) !== false  ){ 
				echo $trigger;	
			}else{
				echo $trigger."();";
			}
		}
		?>
		}	
	
	function updateCal_<?=$field_id."_cal"?>() { 
	    	       
	     <?
		 if( $value ){
		 ?>
			// Set the Calendar's page to the earliest selected date 
			YAHOO.example.calendar.<?=$field_id."_cal"?>.select('<?=Utils::parseDate( $value, "m/d/Y")?>'); 
			YAHOO.example.calendar.<?=$field_id."_cal"?>.cfg.setProperty("pagedate",  "<?=Utils::parseDate( $value, "m")?>/<?=Utils::parseDate( $value, "Y")?>" );  
			 
		//	YAHOO.example.calendar.<?=$field_id."_cal"?>.render(); 
		<?
		}
		?>
	} 	
	
}	
<?
 
if (  sfContext::getInstance()->getRequest()->isXmlHttpRequest() ){
?>  
	init_<?=$field_id."_cal"?>();	
<?
}else{
?>
	YAHOO.util.Event.addListener(window, "load", init_<?=$field_id."_cal"?> );
<?
}
?>

</script>
<?
if( $value ){
	$value = Utils::parseDate( $value, "Y-m-d");
}
if ($modificable==false)
	$html_options["readonly"]="readonly";
	
?>

<?=input_tag($field_id , $value , $html_options ).image_tag("22x22/5days.gif",  "id=".$field_id."Show")?>

<div id="<?=$field_id."_cal"?>Container" style="display:none; position:absolute;"></div>

<?
	$html=ob_get_contents();				
	ob_end_clean();	
	return $html;
}
?>