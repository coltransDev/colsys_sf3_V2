<?php

/**
 * @package lib
 * @author Andres Botero
 *
 */

/**
 * Enable to use Modalbox script : http://www.wildbit.com/labs/modalbox/
 * @author Gerald Estadieu <gestadieu@gmail.com>
 */
function m_link_to($name, $url, $html_options = array(), $modal_options = array())
{
    
    
    if(array_key_exists('title', $html_options))
    {
        $modal_options = array_merge($modal_options, array('title' => 'this.title'));
    }
    
    $params_to_escape = sfConfig::get('app_params_to_escape_list');
    
    // escape strings for js
    foreach($modal_options as $option => $value)
    {
        if(in_array($option, $params_to_escape))
        {
            $modal_options[$option] = "'" . $value . "'";
        }
    }
    
    $js_options = _options_for_javascript($modal_options);

    $html_options['onclick'] = "Modalbox.show(this.href, " . $js_options . "); return false;";

    return link_to($name, $url, $html_options);
}

/*
* Muestra un boton que permite hacer submit en un modalbox
* @author Andres Botero
*/
function m_submit_tag( $name= "Submit" , $form_name , $action="", $title="Sending status"){
	$action = url_for($action);
	return submit_tag( $name , "onClick=Modalbox.show('".$action."', {title: '".$title."', params: Form.serialize('".$form_name."') }); return false;" );
}

/*
* Igual que m_submit_tag solo que coloca un link
* @author Andres Botero
*/
function m_submit_link_tag( $name= "Submit" , $form_name , $action="", $title="Sending status"){
	$action = url_for($action);
	return link_to( $name , "#", "onClick=Modalbox.show('".$action."', {title: '".$title."', params: Form.serialize('".$form_name."') }); return false;" );
}
?>