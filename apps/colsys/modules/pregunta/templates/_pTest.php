<?php include_partial('pregunta/error', array('pregunta' => $pregunta)); ?>
<ul class="test">
    <?php $cont = 1; ?>
    <?php foreach ($pregunta->getOpcionesOrdenadas($pregunta->ca_id) as $opcion): ?>
        <li class="radio-item">
            <label class="radio-label">
                <input type="radio" id="grupo_<?php echo $pregunta->ca_id ?>_<?php echo $cont ?>" class="radio-button" value="<?php echo html_entity_decode($opcion->ca_texto) ?>" name="en.<?php echo $pregunta->ca_id ?>.grupo">
                <?php echo html_entity_decode($opcion->ca_texto) ?>
            </label>
        </li>
        <?php $cont++; ?>
    <?php endforeach; ?>
</ul>
<?php if ($pregunta->ca_obligatoria == 'true') { ?>

    <script type="text/javascript">

        var pregunta = new LiveValidation('en_<?php echo $pregunta->ca_id ?>',{ validMessage: "OK!"});
        pregunta.add( Validate.Presence);
    </script>
<?php } ?>