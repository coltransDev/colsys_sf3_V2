<form class="formulario" id="f_<?=$formulario->ca_id ?>" action="<?=url_for('formulario/proceso?id=' . base64_encode($formulario->getCaId()) . '&co=' . $contacto) ?>" method="post">
    <div class="formulario-cabecera">
        <? if ($formulario->ca_empresa == 1) { ?>
            <img class="logo-topmenu" src="/images/logos/colmas.png" alt="Colmas SA" />    
        <? } else { ?>
            <img class="logo-topmenu" src="https://www.coltrans.com.co/logosoficiales/coltrans/Coltrans1988_medium.png" alt="Coltrans SA" />
        <? } ?>

        <h1><?=$formulario->getCaAlias() ?></h1>
        <div class="intro-formulario"><?=html_entity_decode($formulario->ca_introduccion) ?></div>
    </div>
    <div class="mensaje-obligatorio"><span class="pregunta-obligatoria">*</span>Campo Obligatorio</div>
    <? foreach ($formulario->getBloquesOrdenados($formulario->ca_id) as $bloque){?>
        <?
        include_partial('bloque/vistaPreviaBloque', array('bloque' => $bloque, 'servicios' => $servicios, "formulario"=>$formulario));
        ?>
    <? } ?>
    
    <div class="submitForm">
        <input class="button" type="button" value="Enviar" onclick="validarFormulario()" />
    </div>
</form>
<script>

function validarFormulario(){
    
    var obj = $( ":input[obligatorio=1]" );
    //var obj = $('select[obligatorio=1]');
    
    var Campos = new Object();  
    var valor = 0;
    
    $.each( obj, function( key, el ) {
        
        eval( "var valor=Campos."+el.name+";");
        
        if(valor!="true"){
            eval( "Campos."+el.name+" = 'false';" );
            var pregunta = document.getElementById(el.attributes["idpregunta"].value);
            
            pregunta.style.color='#E42C2C';
            //alert(el.attributes["idpregunta"].value);
            //var tipo = $("input[type='radio']");            
            var tipo = el.type;
            
            if(tipo=="radio"){
                if(el.checked==true){                    
                    eval( "Campos."+el.name+" = 'true';" );                    
                    pregunta.style.color='#000000';                                       
                }                    
            }
            
            if(tipo=="select-one"){
                var opcion =$('select[name='+el.name+']').val();
                if(opcion!=""){
                    eval( "Campos."+el.name+" = 'true';" )
                    pregunta.style.color='#000000';
                }
            }            
        }
    });
    
    $.each( Campos, function( key, el ) {
        if(el == "false"){
            valor += 1;
        }
    })
    
    if(valor>0){
        alert("Agradecemos evaluar las preguntas resaltadas en rojo");
    }else{
        document.getElementById("f_"+"<?=$formulario->getCaId()?>").submit();
    }
}
</script>