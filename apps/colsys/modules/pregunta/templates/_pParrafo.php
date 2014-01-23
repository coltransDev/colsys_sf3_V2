<?php include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
<textarea class="parrafo" id="en_<?php echo $pregunta->ca_id ?>"   name="en.<?php echo $pregunta->ca_id ?>.sencillo"></textarea>

<?php if ($pregunta->ca_obligatoria == 'true') { ?>

    <script type="text/javascript">

        var pregunta = new LiveValidation('en_<?php echo $pregunta->ca_id ?>',{ validMessage: "OK!"});
        pregunta.add( Validate.Presence);
    </script>
<?php } ?>