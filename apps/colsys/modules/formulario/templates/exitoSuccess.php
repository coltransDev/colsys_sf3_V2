<div class="formulario-cabecera">
    <? if ($formulario->ca_empresa == 1) { ?>
        <img class="logo-topmenu" src="/images/logos/colmas.png" alt="Colmas SA" />    
    <? } else { ?>
        <img class="logo-topmenu" src="/images/logos/coltrans.png" alt="Coltrans SA" />
    <? } ?>
</div>
<div class="resultado">
    <h1>Muchas gracias por su tiempo!!!</h1>
    <br>
    <br>
    <br>
    <p class="align-center">Sus datos han sido guardados correctamente</p>
    <br>
    <br>
    <br>
    <? if ($formulario->ca_empresa == 1) { ?>
        <p class="align-center">Puede continuar visitando nuestro sitio web  <a href="http://www.colmas.com.co/" target="_BLANK">COLMAS S.A.S</a></p>    
    <? } else { ?>
        <p class="align-center">Puede continuar visitando nuestro sitio web  <a href="http://www.coltrans.com.co/" target="_BLANK">COLTRANS S.A.S</a></p>
    <? } ?>    
</div>



