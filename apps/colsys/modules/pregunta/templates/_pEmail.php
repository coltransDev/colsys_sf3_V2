<?php include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
<input class="texto" type="email" id="en_<?php echo $pregunta->ca_id ?>"  value="" name="en.<?php echo $pregunta->ca_id ?>.sencillo">
<script type="text/javascript">

    var pregunta = new LiveValidation('en_<?php echo $pregunta->ca_id ?>',{ validMessage: "OK!"});
    pregunta.add( Validate.Email);
<?php if ($pregunta->ca_obligatoria == 'true') { ?>
            pregunta.add( Validate.Presence);
    </script>
<?php } ?>
</script>