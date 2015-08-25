<?
use_helper( "MimeType");
$subject = $proveedor->getIds()->getCaNombre().": EVALUACION ".$ano." - PERIODO ".$periodo;
$mensaje = $textos['saludoComunicado'].$textos['entradaComunicado'];
$idproveedor = $proveedor->getCaIdproveedor();
?>
    
<script language="javascript" type="text/javascript">
    function showEmailForm(){
        if( document.getElementById('emailForm').style.display=="none"){ 
            document.getElementById('emailForm').style.display="inline"
        }else{
            document.getElementById('emailForm').style.display="none"
        }
    }	
</script>

<div align="center" class="content">
<div id="emailForm"  style="display:none;">
   
    <form name="form1" id="form1" method="post" action="<?=url_for("ids/enviarComunicadoEmail?id=".$idproveedor."&ano=".$ano."&periodo=".$periodo)?>">
        <input type="hidden" name="checkObservaciones" id="checkObservaciones" value="" />
	<?
            include_component("email", "formEmail", array("subject"=>$subject,"message"=>$mensaje,"contacts"=>substr($contactos, 0, -1)));
        ?>
        <div align="center"><input type="submit" name="commit" value="Enviar" class="button" /></div><br /><br />    
    </form>
</div>

<iframe src="<?=url_for("/ids/generarPDFComunicadoProveedores/idproveedor/$idproveedor/ano/$ano/periodo/$periodo/token/cf5690a08f6fde84366c59402e741311")?>" width="830px" height="650px"></iframe>
<?
if( count($emails)>0 ){
    ?>
    <br />
    <br />
    <table class="tableList">
        <tr >
            <th>Fecha Envio</th>			
            <th>Asunto</th>			
            <th>Destinatarios</th>		
            <th>Email</th>			
        </tr>
        <?
        foreach( $emails as $email ){
            ?>
            <tr >
                <td><?=$email->getCaFchenvio()?></td>			
                <td><?=$email->getCaSubject()?></td>
                <td><?=$email->getCaAddress()?></td>
                <td><a href='#' onClick=window.open('<?=url_for("email/verEmail?id=".$email->getCaIdemail())?>')><?=image_tag("22x22/email.gif")?></a></td>			
            </tr>
            <?
        }
        ?>
    </table>
    <?
}
?>