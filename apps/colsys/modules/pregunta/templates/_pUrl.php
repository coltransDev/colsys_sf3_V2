<?php include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
<input class="texto" type="url" id="en_<?php echo $pregunta->ca_id ?>"  value="" name="en.<?php echo $pregunta->ca_id ?>.sencillo">