<? /* url: '<?=url_for("formulario/refrescarFormulario?ca_id='.$formulario->ca_id")?>', */ ?>
<head>
    <script>
        function loadXMLDoc()
        {
            Ext.Ajax.request(
            {
                waitMsg: 'Actualizando el formulario...',
                url: '<?= url_for("formulario/refrescarFormulario") ?>',
                method: 'POST',
                params : {
                    id: '<?= $formulario->ca_id ?>',
                    servicios: 'Aereo, Maritimo, Exportaciones Aereo, Exportaciones Maritimo, Aduana'
                },
                /*form: 'formDatos',*/
                success:function(response,options){
                    var res = Ext.util.JSON.decode( response.responseText );
                    if( res.success ){
                        // $("#mydiv").html(res.html);
                        document.getElementById("myDiv").innerHTML=res.html;
                        //document.getElementById("indicator").style.display='block';
                        $("#indicator").show();
                    }
                },

                failure: function(response,options){
                    alert("Error:"+response.responseText.toString());
                    //$("#bguardar").attr("disabled",false);
                }
            });
        }
        function loadXMLDoc2()
        {
            var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    document.getElementById("6").innerHTML=xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","/ajax_info.txt",true);
            xmlhttp.send();
        }
    </script>
</head>

<?php
include_partial('formulario/vistaPreviaFormulario', array('formulario' => $formulario));
?>

<div id="myDiv"><h2>Let AJAX change the text</h2></div>
<button type="button" onclick="loadXMLDoc()">Change Content</button>

<script>

</script>

