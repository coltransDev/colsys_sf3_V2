

<div class="content" align="center">

    <h1>Administraci&oacute;n de Tipos de Documento</h1>
    <br />

    <table class="tableList" width="80%">
        <tr>
            <th>Tipo</th>            
            <th>Titulo</th>
            <th><div align="center">Opciones</div></th>
        </tr>
        <?
        foreach( $tipos as $tipo ){            
        ?>
        <tr>
            <td><b><?=$tipo->getCaTipo()."-".str_pad($tipo->getCaComprobante(), 4, "0",  STR_PAD_LEFT)?></b></td>            
            <td><?=$tipo->getCaTitulo()?></td>
            <td>
                <div align="center">
                    <?=link_to(image_tag("16x16/edit.gif"), "inotipocomprobante/formTipo?id=".$tipo->getcaIdtipo())?>
                </div>

            </td>
        </tr>
        <?
        }
        ?>
    </table>

</div>