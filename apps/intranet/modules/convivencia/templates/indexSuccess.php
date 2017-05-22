<?
$permitidos = $sf_data->getRaw("permitidos");
$user = $sf_data->getRaw("user");

?>
<div align="center"><iframe src="https://docs.google.com/presentation/d/1JC3ggqGiPSlMG2qdFjWOigdK5UDI8ilmbJb9FkEpEeg/embed?start=true&loop=false&delayms=3000" frameborder="0" width="480" height="389" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe></div>
<ul>
    <li><b><a href="documentos/tipo/1">Normatividad Vigente</a></b></li>
    <li><b><a href="documentos/tipo/2">Integrantes</a></b></li>
    <li><b><a href="<?=url_for('images/docs')?>/REGLAMENTO_COMITE_DE_CONVIVENCIA.pdf" target="_blank">Reglamento Interno</a></b></li>        
    <li><b><a href="documentos/tipo/4">Formulario para presentar su Queja (online)</a></b></li>
    <li><b><a href="<?=url_for('images/docs')?>/Formato_de_presentacion_de_quejas.pdf" target="_blank">Formulario para presentar su Queja (versi&oacute;n Impresa)</a></b></li>
    <li><b><a href="documentos/tipo/5">Mis Quejas</a></b></li>
    <?    
    if(in_array($user->getUserId(),$permitidos)){?>
        <li><b><a href="documentos/tipo/6">Reporte de Quejas</a></b></li>
    <?
    }
    ?>
</ul>