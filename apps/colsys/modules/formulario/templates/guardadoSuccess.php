<div class="formulario-cabecera">
    <img class="logo-topmenu" src="/images/logos/coltrans.png" alt="Coltrans SA" />
</div>
<div class="resultado">
    <h1>Estimado cliente</h1>
    <br>
    <br>
    <br>
    <p class="align-center">Sus datos fueron diligenciados previamente. Por lo tanto este enlace ya no es válido.</p>
    <br>
    <br>
    <br>
    <p class="align-center"><b>Muchas Gracias!!!</b></p>
    <?php if ($sf_user->hasFlash('notice')): ?>
        <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice') ?>
            
        </div>
    <?php endif; ?>
</div>





