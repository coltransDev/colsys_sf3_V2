<?php
?>
<div align="center">
    
    <?
    if($criterio=='buttondirnal'){
    ?>
    <h2 style="font-size: 200%">Directorio Telef&oacute;nico Nacional</h2>
    <br />
    
    <table class="tableList" border="1" width="100%">
        <tr>
            <th >Usuario</th>
            <th >Cargo</th>
            <th >Email</th>
            <th >Tel&eacute;fono</th>
            <th >Ext.</th>
        </tr>
        <?
        $lastEmpresa = "";
        $lastSucursal = "";
        $lastDepartamento = "";
        
        foreach( $usuarios as $usuario ){
            if( $lastEmpresa!=$usuario->getSucursal()->getEmpresa()->getCaNombre() ){
                $lastEmpresa=$usuario->getSucursal()->getEmpresa()->getCaNombre();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left"><font size="4"><b><?=$lastEmpresa?></b></font></td>
                </tr>
            <?
            }
            if( $lastSucursal!=$usuario->getCaSucursal() ){
                $lastSucursal=$usuario->getCaSucursal();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;<font size="3"><b><?=$lastSucursal?></b></font></td>
                </tr>
            <?
            }
            if( $lastDepartamento!=$usuario->getCaDepartamento() ){
                $lastDepartamento=$usuario->getCaDepartamento();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?=$lastDepartamento?></b></td>
                </tr>
            <?
            }
            ?>
            <tr>
                <td style="text-align: left; font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo link_to($usuario->getCaNombre(), "adminUsers/viewUser?login=".$usuario->getCaLogin());?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaCargo()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaEmail()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getSucursal()->getCaTelefono()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaExtension()?></td>
            </tr>
            <?
            }
            ?>
    </table>
    <?
    }
    if($criterio=='buttoncom'){
    ?>
    <h2 style="font-size: 200%">Directorio Telef&oacute;nico por Empresa</h2>
    <br />
    <table class="tableList" border="1" width="100%">
        <tr>
            <th >Usuario</th>
            <th >Cargo</th>
            <th >Email</th>
            <th >Tel&eacute;fono</th>
            <th >Ext.</th>
        </tr>
        <?
        $lastEmpresa = "";
        $lastSucursal = "";
        $lastDepartamento = "";

        foreach( $usuarios as $usuario ){
            if( $lastEmpresa!=$usuario->getSucursal()->getEmpresa()->getCaNombre() ){
                $lastEmpresa=$usuario->getSucursal()->getEmpresa()->getCaNombre();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left"><font size="4"><b><?=$lastEmpresa?></b></font></td>
                </tr>
            <?
            }
            if( $lastSucursal!=$usuario->getCaSucursal() ){
                $lastSucursal=$usuario->getCaSucursal();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;<font size="3"><b><?=$lastSucursal?></b></font></td>
                </tr>
            <?
            }
            if( $lastDepartamento!=$usuario->getCaDepartamento() ){
                $lastDepartamento=$usuario->getCaDepartamento();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?=$lastDepartamento?></b></td>
                </tr>
            <?
            }
            ?>
             <tr>
                <td style="text-align: left; font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo link_to($usuario->getCaNombre(), "adminUsers/viewUser?login=".$usuario->getCaLogin());?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaCargo()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaEmail()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getSucursal()->getCaTelefono()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaExtension()?></td>
            </tr>
            <?
            }
            ?>
    </table>
    <?
    }
    if($criterio=='buttonsuc'){
    ?>

    <h2 style="font-size: 200%">Directorio Telef&oacute;nico por Sucursal</h2>
    <br />
    <table class="tableList" border="1" width="100%">
        <tr>
            <th >Usuario</th>
            <th >Cargo</th>
            <th >Email</th>
            <th >Tel&eacute;fono</th>
            <th >Ext.</th>
        </tr>
        <?
        $lastEmpresa = "";
        $lastSucursal = "";
        $lastDepartamento = "";
        foreach( $usuarios as $usuario ){
            if( $lastEmpresa!=$usuario->getSucursal()->getEmpresa()->getCaNombre() ){
                $lastEmpresa=$usuario->getSucursal()->getEmpresa()->getCaNombre();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left"><font size="4"><b><?=$lastEmpresa?></b></font></td>
                </tr>
            <?
            }
            if( $lastSucursal!=$usuario->getSucursal()->getCaNombre() ){
                $lastSucursal=$usuario->getSucursal()->getCaNombre();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;<font size="3"><b><?=$lastSucursal?></b></font></td>
                </tr>
            <?
            }
            if( $lastDepartamento!=$usuario->getCaDepartamento() ){
                $lastDepartamento=$usuario->getCaDepartamento();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?=$lastDepartamento?></b></td>
                </tr>
            <?
            }
            ?>
             <tr>
                <td style="text-align: left; font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo link_to($usuario->getCaNombre(), "adminUsers/viewUser?login=".$usuario->getCaLogin());?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaCargo()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaEmail()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getSucursal()->getCaTelefono()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaExtension()?></td>
            </tr>
            <?
            }
            ?>
    </table>
    <?
    }
    if($criterio=='buttondep'){
    ?>

    <h2 style="font-size: 200%">Directorio Telef&oacute;nico por Departamento</h2>
    <br />
    <table class="tableList" border="1" width="100%">
        <tr>
            <th >Usuario</th>
            <th >Cargo</th>
            <th >Email</th>
            <th >Tel&eacute;fono</th>
            <th >Ext.</th>
        </tr>
        <?
        $lastDepartamento = "";
        $lastSucursal = "";
        $lastEmpresa = "";
        foreach( $usuarios as $usuario ){
            if( $lastEmpresa!=$usuario->getSucursal()->getEmpresa()->getCaNombre() ){
                $lastEmpresa=$usuario->getSucursal()->getEmpresa()->getCaNombre();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left"><font size="4"><b><?=$lastEmpresa?></b></font></td>
                </tr>
            <?
            }
            if( $lastDepartamento!=$usuario->getCaDepartamento() ){
                $lastDepartamento=$usuario->getCaDepartamento();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;<font size="3"><b><?=$lastDepartamento?></b></font></td>
                </tr>
            <?
            }
            if( $lastSucursal!=$usuario->getCaSucursal() ){
                $lastSucursal=$usuario->getCaSucursal();
                ?>
                <tr class="row0">
                    <td colspan="5" style="text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="2"><b><?=$lastSucursal?></b></font></td>
                </tr>
            <?
            }
            ?>
             <tr>
                <td style="text-align: left; font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo link_to($usuario->getCaNombre(), "adminUsers/viewUser?login=".$usuario->getCaLogin());?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaCargo()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaEmail()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getSucursal()->getCaTelefono()?></td>
                <td style="text-align: left; font-size:10px;"><?=$usuario->getCaExtension()?></td>
            </tr>
            <?
            }
            ?>
    </table>
    <?
    }
    ?>
    <br />
    <?
    include_component("adminUsers", "directorio");
    ?>
    

</div>