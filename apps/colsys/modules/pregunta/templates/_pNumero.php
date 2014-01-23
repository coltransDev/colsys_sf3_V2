<?php include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
<input class="texto" type="number" id="entrada_<?php echo html_entity_decode($pregunta->ca_id) ?>"  value="" name="entrada.<?php echo html_entity_decode($pregunta->ca_id) ?>.sencillo">
<script type="text/javascript">

    var pregunta = new LiveValidation('entrada_<?php echo $pregunta->ca_id ?>',{ validMessage: "OK!"});
    pregunta.add( Validate.Numericality);
<?php if ($pregunta->ca_obligatoria == 'true') { ?>
            pregunta.add( Validate.Presence);
    </script>
<?php } ?>

</script>

