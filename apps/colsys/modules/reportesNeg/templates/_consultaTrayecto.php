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
        <td ><b>Clase: </b></td>
        <td <?=($comparar)? (($reporte->compDato("CaImpoexpo")!=0)?"class='rojo'":"") :""?> ><?=Utils::replace($reporte->getCaImpoexpo())?></td>
        <td ><b>Fecha Despacho:</b></td>
        <td <?=($comparar)? (($reporte->compDato("CaFchdespacho")!=0)?"class='rojo'":"") :""?> ><?=Utils::fechaMes($reporte->getCaFchdespacho())?></td>
        <td ><b>Linea</b></td>
        <td <?=($comparar)? (($reporte->compDato("CaIdlinea")!=0)?"class='rojo'":"") :""?> ><?=$reporte->getIdsProveedor()->getIds()->getCaNombre();
        ?></td>
    </tr>

    <tr>
        <td ><b>Transporte:</b></td>
        <td <?=($comparar)? (($reporte->compDato("CaTransporte")!=0)?"class='rojo'":"") :""?> ><?=Utils::replace($reporte->getCaTransporte())?></td>
        <td ><b>Origen:</b></td>
        <td <?=($comparar)? (($reporte->compDato("CaOrigen")!=0)?"class='rojo'":"") :""?> ><?=$reporte->getOrigen()?></td>
        <td ><b>Destino</b></td>
        <td <?=($comparar)? (($reporte->compDato("CaDestino")!=0)?"class='rojo'":"") :""?> ><?=$reporte->getDestino()?></td>
    </tr>
    <tr>
        <td ><b>Tipo Envio</b></td>
        <td <?=($comparar)? (($reporte->compDato("CaModalidad")!=0)?"class='rojo'":"") :""?> ><?=$reporte->getCaModalidad()?></td>
        <td ><b>Agente: </b><a href="/ids/formEventosNew/idreporte/<?=$reporte->getCaIdreporte()?>/modo/agentes">Eventos</a></td>
        <td <?=($comparar)? (($reporte->compDato("CaIdagente")!=0)?"class='rojo'":"") :""?> ><?=$reporte->getIdsAgente()?$reporte->getIdsAgente()->getIds()->getCaNombre():"Directo"?></td>
        <td ><b>Incoterms</b></td>
        <td <?=($comparar)? (($reporte->compDato("IncotermsStr")!=0)?"class='rojo'":"") :""?> ><?=$reporte->getIncotermsStr()?></td>
    </tr>
    <tr>
        <td colspan="6" <?=($comparar)? (($reporte->compDato("CaMercanciaDesc")!=0)?"class='rojo'":"") :""?> ><b>Descripci&oacute;n de la Mercanc&iacute;a:</b><br />
            <?=Utils::replace($reporte->getCaMercanciaDesc())?>			</td>
    </tr>
    <tr>
        <td <?=($comparar)? (($reporte->compDato("CaDeclaracionant")!=0)?"class='rojo'":"") :""?>><b>Declaraci&oacute;n Anticipada:</b><br />
            <?=($reporte->getCaDeclaracionant())=="true"?"SI":"NO"?></td>
        <?if($reporte->getCaDeclaracionant()=="true"){?>
        <td <?=($comparar)? (($reporte->compDato("Property('subarancel')")!=0)?"class='rojo'":"") :""?>><b>Subpartida Arancelaria:</b><br />
            <?=$reporte->getProperty("subarancel")?></td>
        <?}?>
    </tr>
    <?
    if( $reporte->getCaImpoexpo()==Constantes::EXPO  ){
        
        $repExpo = Doctrine::getTable("RepExpo")->findOneBy("ca_idreporte", $reporte->getCaIdreporte() );
        if($repExpo)
        {        
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
                $reporteExp["sia"]=$repExpo->getSia();
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
         <td colspan="4" <?=($comparar)? (($reporte->compDato("CaContinuacion")!=0)?"class='rojo'":"") :""?>>
           <?=$reporte->getCaContinuacion()?>
        </td>
    </tr>
    <tr id="continuacion-row0">
        <td width="33%" valign="top" <?=($comparar)? (($reporte->compDato("CaContinuacionDest")!=0)?"class='rojo'":"") :""?> ><b>Destino Final:</b><br />
                <?=$reporte->getDestinoCont()?>

				</td>
                <td width="67%" valign="top" >
                <?
                if( $reporte->getCaTransporte()==Constantes::MARITIMO){
                ?>
                <span <?=($comparar)? (($reporte->compDato("CaContinuacionConf")!=0)?"class='rojo'":"") :""?>><b>Notificar a:</b><br />
                <?
                    if( $reporte->getCaContinuacionConf() ){

                        $q = Doctrine::getTable("Usuario")
                               ->createQuery("u")
                               ->select("u.ca_login,u.ca_nombre,u.ca_email,ca_sucursal,u.ca_idsucursal")
                               ->innerJoin("u.UsuarioPerfil up")
                               ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE','cordinador-de-otm'))
                                ->addWhere("u.ca_idsucursal = ?",$reporte->getCaContinuacionConf())
                               ->addOrderBy("u.ca_idsucursal")
                               ->addOrderBy("u.ca_nombre");                        
                        $usuariosC=$q->execute();

                               
                               
                        /*Doctrine::getTable("Usuario")
                               ->createQuery("u")
                               ->select("u.ca_login,u.ca_nombre,u.ca_email,ca_sucursal")
                               ->innerJoin("u.UsuarioPerfil up")
                               ->where("u.ca_activo=? AND up.ca_perfil=? ", array('TRUE','cordinador-de-otm'))
                               ->addWhere("u.ca_sucursal = ?",$reporte->getCaContinuacionConf())
                               ->addOrderBy("u.ca_nombre")
                               ->execute();*/

                        foreach($usuariosC as $usuario)
                        {
                            echo $usuario->getCaEmail()."<br>";
                        }
                    }
                    ?>
                </span>
                    <?
                }
                ?>
        </td>
    </tr>
</table>
<?
}
?>
