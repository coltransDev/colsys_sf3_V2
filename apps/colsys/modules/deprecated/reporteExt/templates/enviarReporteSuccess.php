<div align="center">
El mensaje se ha enviado correctamente
<br />
<br />

¿Que desea hacer?
<br />
<br />
<a href="<?=url_for("traficos/index?modo=".$modo )?>">Ir a la pagina inicial del modulo </a>
<br />
<br />
<a href="<?=url_for("traficos/listaStatus?modo=".$modo."&reporte=".$reporte->getCaConsecutivo())?>">Volver a la pagina anterior</a>
</div>