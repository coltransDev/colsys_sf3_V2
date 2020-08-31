<div class="resultado">
    <h1>!Muchas gracias! <? //php echo sizeof($pager->getResults())       ?> <? //php echo sizeof($pager->getNbResults())       ?> </h1>
    <br>
    <br>
    <br>
    <p class="align-center"><b>Sus respuestas han sido registradas correctamente.</b></p>
    <br>
    <br>

    <?php if ($sf_user->hasFlash('notice')): ?>
        <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice') ?>
        </div>
    <?php endif; ?>

</div>





