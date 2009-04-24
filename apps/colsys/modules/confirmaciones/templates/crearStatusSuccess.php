<div align="center">
El mensaje se ha enviado correctamente
<br />
<br />

¿Que desea hacer?
<br />
<br />
<a href="<?=url_for("confirmaciones/index?modo=".$modo )?>">Ir a la pagina inicial del modulo </a>
<br />
<br />
<a href="<?=url_for("confirmaciones/consulta?modo=".$modo."&referencia=".str_replace(".","-",$referencia->getCaReferencia()))?>">Volver a la pagina anterior</a>
</div>
