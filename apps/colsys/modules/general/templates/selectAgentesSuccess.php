<?
use_helper("Object");

echo select_tag("agente", options_for_select(array(""=>"Directo")).objects_for_select($agentes, "getId", "getCaNombre", $selected  ) )?>