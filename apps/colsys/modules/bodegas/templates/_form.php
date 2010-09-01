<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script type="text/javascript">
    var verificar=function(){
        Ext.Ajax.request(
        {
            waitMsg: 'Verificando...',
            url: '<?=url_for("bodegas/verificarBodega")?>',
            method: 'POST',
            //Solamente se envian los cambios
            params :	{
                bodega: document.getElementById("bodega_ca_nombre").value,
                tipo: document.getElementById("bodega_ca_tipo").value,
                transporte: document.getElementById("bodega_ca_transporte").value
            },

            callback :function(options, success, response){
                document.getElementById("resultados").innerHTML = response.responseText;
            }
        }
    );
    }

    var activarGuardar=function(){
        document.getElementById("guardar").style.display="";
    }


</script>

<form id="form-bodega" action="<?php echo url_for('bodegas/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?ca_idbodega='.$form->getObject()->getCaIdbodega() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?> onsubmit="return false;">
    <?php if (!$form->getObject()->isNew()): ?>
    <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table class="tableList">
        <tfoot>
            <tr>
                <td colspan="2">
                    <div>
                        <center><input align="center" type="button" value="Verificar" onClick="verificar()"/></center><br /><br />
                    </div>
                    <div id="guardar" style="display:none">
                        <center><input align="center" type="button" value="Guardar" onclick="document.getElementById('form-bodega').submit()" /></center>
                    </div>
                    <?php echo $form->renderHiddenFields(false) ?>
                    <?php if (!$form->getObject()->isNew()): ?>
                    <center>El registro se ha creado exitosamente</center><br />
                    <center>&nbsp;<?=link_to("Editar", "bodegas/show?ca_idbodega=".$form->getObject()->getCaIdbodega() )?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo link_to('Delete', 'bodegas/delete?ca_idbodega='.$form->getObject()->getCaIdbodega(), array('method' => 'delete', 'confirm' => 'Está seguro que desea eliminar la bodega?')) ?></center>
                    <?php endif; ?><br /><br />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['ca_nombre']->renderLabel() ?></th>
                <td>
                    <?php echo $form['ca_nombre']->renderError() ?>
                    <?php echo $form['ca_nombre'] ?>
                </td>
            </tr>
            <tr>
                <th>&nbsp;</th>
                <td>
                    <div id="resultados"></div>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['ca_tipo']->renderLabel() ?></th>
                <td>
                    <?php echo $form['ca_tipo']->renderError() ?>
                    <?php echo $form['ca_tipo'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['ca_transporte']->renderLabel() ?></th>
                <td>
                    <?php echo $form['ca_transporte']->renderError() ?>
                    <?php echo $form['ca_transporte'] ?>
                </td>

            </tr>
        </tbody>
    </table>
</form>