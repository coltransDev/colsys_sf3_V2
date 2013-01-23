<?//php use_stylesheets_for_form($filtroFormulario) ?>
<?//php use_javascripts_for_form($filtroFormulario) ?>

<form action="<?php echo url_for('formulario/filtrar') ?>" method="POST">
    <?php echo $filtroFormulario ?>
    <input class="filter-button" type="submit" value="Filtrar" />
</form>