<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>
<table class="tableList alignLeft" width="100%">
    <tr>
        <th colspan="6"><b>Informaci&oacute;n del trayecto</b></th>
    </tr>
    <tr>
        <td ><b>Clase:</b></td>
        <td ><?=Utils::replace($reporte->getCaImpoexpo())?></td>
        <td ><b>Fecha Despacho:</b></td>
        <td ><?=Utils::fechaMes($reporte->getCaFchdespacho())?></td>
        <td ><b>&nbsp;</b></td>
        <td >&nbsp;</td>
    </tr>

    <tr>
        <td ><b>Transporte:</b></td>
        <td ><?=Utils::replace($reporte->getCaTransporte())?></td>
        <td ><b>Origen:</b></td>
        <td ><?=$reporte->getOrigen()?></td>
        <td ><b>Destino</b></td>
        <td ><?=$reporte->getDestino()?></td>
    </tr>
    <tr>
        <td ><b>Tipo Envio</b></td>
        <td ><?=$reporte->getCaModalidad()?></td>
        <td ><b>Agente: </b><a href="/ids/formEventosNew?idreporte=<?=$reporte->getCaIdreporte()?>">Eventos</a></td>
        <td ><?=$reporte->getIdsAgente()?$reporte->getIdsAgente()->getIds()->getCaNombre():"Directo"?></td>
        <td ><b>Incoterms</b></td>
        <td ><?=$reporte->getCaIncoterms()?></td>
    </tr>
    <tr>
        <td colspan="6" ><b>Descripci&oacute;n de la Mercanc&iacute;a:</b><br />
            <?=Utils::replace($reporte->getCaMercanciaDesc())?>			</td>
    </tr>
    <?
    if( $reporte->getCaImpoexpo()==Constantes::EXPO  ){
        //echo $reporte->getCaIdreporte();
        $repExpo = Doctrine::getTable("RepExpo")->findOneBy("ca_idreporte", $reporte->getCaIdreporte() );
        if($repExpo)
        {
        //$repExpo= new RepExpo();
            $repExpo->setCaIdreporte($reporte->getCaIdreporte());
            $reporteExp=array("piezas"=>"","peso"=>"","volumen"=>"","dimensiones"=>"","valorcarga"=>"","sia"=>"","tipoexpo"=>"","motonave"=>"");
            if($repExpo->getCaPiezas() )
            {
                $reporteExp["piezas"]=$repExpo->getCaPiezas();
            }

            if($repExpo->getCaPeso() )
            {
                $reporteExp["peso"]=$repExpo->getCaPeso();
            }

            if($repExpo->getCaVolumen() )
            {
                $reporteExp["volumen"]=$repExpo->getCaVolumen();
            }

            if($repExpo->getCaDimensiones() )
            {
                $reporteExp["dimensiones"]=$repExpo->getCaDimensiones();
            }

            if($repExpo->getCaValorcarga() )
            {
                $reporteExp["valorcarga"]=$repExpo->getCaValorcarga();
            }
            if($repExpo->getCaIdsia() )
            {
                $reporteExp["sia"]=$repExpo->getSia()->getCaNombre();
            }

            if($repExpo->getCaTipoexpo() )
            {
                $tipoE = ParametroTable::retrieveByCaso( "CU011",null , null,$repExpo->getCaTipoexpo() );                
                if($tipoE)
                    $reporteExp["tipoexpo"]=$tipoE[0]->getCaValor();
                else
                    $reporteExp["tipoexpo"]="";
            }

            if($repExpo->getCaMotonave() )
            {
                $reporteExp["motonave"]=$repExpo->getCaMotonave();
            }  
    ?>
    <tr>
        <td ><b>Piezas</b></td>
        <td ><?=$reporteExp["piezas"]?></td>
        <td ><b>Peso: </b></td>
        <td ><?=$reporteExp["peso"]?></td>
        <td ><b>Volumen:</b></td>
        <td ><?=$reporteExp["volumen"]?></td>
    </tr>
    <tr>
        <td ><b>dimensiones</b></td>
        <td ><?=$reporteExp["dimensiones"]?></td>
        <td ><b>valor_carga: </b></td>
        <td ><?=$reporteExp["valorcarga"]?></td>
        <td ><b>sia:</b></td>
        <td ><?=$reporteExp["sia"]?></td>
    </tr>
    <tr>
        <td ><b>Tipoexpo</b></td>
        <td ><?=$reporteExp["tipoexpo"]?></td>
        <td ><b>motonave: </b></td>
        <td ><?=$reporteExp["motonave"]?></td>
        <td >&nbsp;</td>
        <td >&nbsp;</td>
    </tr>
    <?
        }
    }
    ?>
</table>
<?
if( $reporte->getcaContinuacion()!="N/A" && $reporte->getcaContinuacion()!="" ){
    

?>

<table class="tableList alignLeft" width="100%">
     <tr >
         <th colspan="4" ><b>Continuaci&oacute;n de viaje</b></th>
     </tr>
     <tr>
         <td colspan="4">
           <?=$reporte->getCaContinuacion()?>
        </td>
    </tr>
    <tr id="continuacion-row0">
        <td width="33%" valign="top" ><b>Destino Final:</b><br />
                <?=$reporte->getDestinoCont()?>

				</td>
                <td width="67%" valign="top" >
                <?
                if( $reporte->getCaTransporte()==Constantes::MARITIMO){
                ?>
                <b>Notificar a:</b><br />
                <?
                    if( $reporte->getCaContinuacionConf() ){
                        $usuariosC = Doctrine::getTable("Usuario")
                               ->createQuery("u")
                               ->select("u.ca_login,u.ca_nombre,u.ca_email,ca_sucursal")
                               ->innerJoin("u.UsuarioPerfil up")
                               ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE','cordinador-de-otm'))
                               ->addWhere("u.ca_sucursal = ?",$reporte->getCaContinuacionConf())
                               ->addOrderBy("u.ca_nombre")
                               ->execute();

                        foreach($usuariosC as $usuario)
                        {
                            echo $usuario->getCaEmail()."<br>";
                        }
//                        echo $reporte->getCaContinuacionConf();
                        //$usuario = Doctrine::getTable("Usuario")->find( $reporte->getCaContinuacionConf() );
                        //echo $usuario->getCaNombre();
                    }
                }
                ?>
        </td>
    </tr>
</table>
<?
}
?>