<?
/**
 * Pantalla de bienvenida para el modulo de reportes
 * @author Andres Botero
 */

?>

<script type="text/javascript">
    function mostrarOpcion( obj ){
        switch( obj.value ){
            case "nombre":
                $("#cadena").show();
                $("#tipo,#transporte").hide();
                /*document.getElementById("cadena").style.display = "";
                document.getElementById("tipo").style.display = "none";
                document.getElementById("transporte").style.display = "none";
                */
                break;
            case "tipo":
                $("#tipo").show();
                $("#cadena,#transporte").hide();
                /*
                document.getElementById("cadena").style.display = "none";
                document.getElementById("tipo").style.display = "";
                document.getElementById("transporte").style.display = "none";
                */
                break;
            case "transporte":
                $("#transporte").show();
                $("#cadena,#tipo").hide();
                /*document.getElementById("cadena").style.display = "none";
                document.getElementById("tipo").style.display = "none";
                document.getElementById("transporte").style.display = "";
                */
                break;
        }

    }
</script>
<form action="<?=url_for( "bodegas/busqueda" )?>" method="post" >
    <table class="tableList" width="550px" align="center" border="0" cellpadding="5px" cellspacing="1px" >
        <tr>
            <th colspan="3" style='font-size: 12px; font-weight:bold;'>Sistema de Bodegas</th>
        </tr>
        <tr>
            <td colspan="3" style='font-size: 10px;'>Ingrese un criterio para realizar la búsqueda</td>
        </tr>
        <tr>
            <td width="88" ><b>Buscar por:</b> <br />
                <select name="criterio" size="7" onchange="mostrarOpcion(this)">
                    <option value="nombre" selected="selected">Nombre</option>
                    <option value="tipo">Tipo de Bodega</option>
                    <option value="transporte">Tipo de Transporte</option>
                </select>
            </td>
            <td width="337" >&nbsp;

                    <div id="cadena" >
                        <b>Que contenga la cadena:</b><br />
                        <input type="text" name="cadena" id="cadena" size="60" />
                    </div>

                    <div id="tipo" style="display:none">
                        Los Tipo de Bodega son:<br />
                        <select name="tipo">
                            <?
                            foreach($tbodegas as $bodega ) {
                                ?>
                            <option value="<?=utf8_decode($bodega["name1"])?>"><?=utf8_decode($bodega["name1"])?></option>
                                <?
                            }
                            ?>

                        </select>
                    </div>
                    <div id="transporte" style="display:none">
                        Los Tipo de Transporte son:<br />
                        <select name="transporte">
                            <?
                            foreach($transportes as $transporte ) {
                                ?>
                            <option value="<?=utf8_decode($transporte["name"])?>"><?=utf8_decode($transporte["name"])?></option>
                                <?
                            }
                            ?>

                        </select>
                    </div>

                </td>



            <td width="64"  ><input  type='submit' name='buscar' value=' Buscar' /></td>
        </tr>
    </table>
</form>


