<form action="<?=url_for('clientes/cancelarSuscripcion?aceptacion=si&idcontacto='.$contacto->getCaIdcontacto()."&idcliente=".$contacto->getCaIdcliente())?>" method="post">
     Por favor infórmenos la razón por la cuál desea dejar de recibir éste tipo de Comunicaciones:<br />    
            <textarea class="parrafo area-adicional" id="comentarios"   name="comentarios"></textarea>
    <div class="submitForm">
                <input class="button" type="submit" value="Submit" />
                <input class="button" type="button" value="Cancelar" />
    </div>
</form>
<?if ($aceptacion){?>
Gracias por sus datos
<? } ?>
