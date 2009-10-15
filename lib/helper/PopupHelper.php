<?
function link_popup( $link,  $url , $width, $height, $title="myWindow" , $trigger=null, $options="" ){
	if( $trigger ){
		if( strpos($url, "?" )!==false ){
			$url.="&trigger=".$trigger;
		}
		
		if( strpos($url, "?" )!==false ){
			$url.="?trigger=".$trigger;
		}	
		
	}
	
	return link_to($link , "#" , "onClick=popup('".url_for($url)."', '$width', '$height' , '$title') ".$options );	
}
?>