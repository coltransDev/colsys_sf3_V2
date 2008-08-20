<?php
function tab_pane(){
	$html='<div class="tab-pane" id="tab-pane-1">';
	return $html;
}
function tab_page($titulo){
	$html='<div class="tab-page" ><h2 class="tab">'.$titulo.'</h2>';
	return $html;
}
function close_tab_page(){
	$html='</div>';
	return $html;
}

function close_tab_pane(){
	$html='</div>';
	return $html;
}

/*
Usado despues de actualizar con AJAX
*/
function init_tabs(){
	$html='<script language="Javascript" type="text/javascript">setupAllTabs()</script>';
	return $html;
	


}
?>