<?
if ($formulario->getCaEmpresa()  == 1) {
    include_partial('formulario/emailHtmlColmas', array('formulario' => $formulario));
} else {
    include_partial('formulario/emailHtmlColtrans', array('formulario' => $formulario));
}
?>





