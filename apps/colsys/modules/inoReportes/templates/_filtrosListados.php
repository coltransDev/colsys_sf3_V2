<?
//echo $impoexpo;
//echo $transporte;



$comerciales = $sf_data->getRaw("comerciales");
$comercial = $sf_data->getRaw("comercial");
$idcomercial = $sf_data->getRaw("idcomercial");
$sucursal = $sf_data->getRaw("sucursal");
$sucursales2 = $sf_data->getRaw("sucursales2");
$idsucursal = $sf_data->getRaw("idsucursal");


include_component("widgets", "widgetUsuario");
//include_component("widgets", "widgetSucursales");


//echo $url;
?>
<center>    
      <h3>Informe de Comisiones para Vendedores</h3>
	  <br />
    
          <form method="post" id="reporteCargaForm" action="#"  enctype="application/x-www-form-urlencoded" >
      <input type="hidden" name="entrada" value="" />
      <input type="hidden" name="comision" value="1" />
      <table width="600" border="0" cellspacing="1" cellpadding="5" class="tableList">
        <tr>
          <th colspan="7" style='font-size: 12px; font-weight:bold;'>
            <b>Ingrese los par&aacute;metros para el Reporte</b>          </th>
        </tr>
        <?
        if($url!="inoReportes/liquidarComisiones")
        {
        ?>
        <tr>
          <td class="listar"><p>Modulo</p>
          	
          		<select name="impoexpo" id="impoexpo">
                    <option value=""                                <?=($impoexpo=="")?"selected":""?>>Todos</option>
                    <option value="<?=Constantes::IMPO?>"           <?=($impoexpo==Constantes::IMPO)?"selected":""?>><?=Constantes::IMPO?></option>
                    <option value="<?=Constantes::EXPO?>"           <?=($impoexpo==Constantes::EXPO)?"selected":""?>><?=Constantes::EXPO?></option>
                    <option value="<?=Constantes::TRIANGULACION?>"  <?=($impoexpo==Constantes::TRIANGULACION)?"selected":""?>><?=Constantes::TRIANGULACION?></option>
                    <option value="<?=Constantes::INTERNO?>"        <?=($impoexpo==Constantes::INTERNO)?"selected":""?>><?=Constantes::INTERNO?></option>
       			</select>
          </td>
          <td class="listar"><p>Transporte</p>          	
          		<select name="transporte" id="transporte">
                    <option value=""                            <?=($transporte=="")?"selected":""?>>Todos</option>
                    <option value="<?=Constantes::MARITIMO?>"   <?=($transporte==Constantes::MARITIMO)?"selected":""?>> <?=Constantes::MARITIMO?>   </option>
                    <option value="<?=Constantes::AEREO?>"      <?=($transporte==Constantes::AEREO)?"selected":""?>>    <?=Constantes::AEREO?>      </option>
                    <option value="<?=Constantes::TERRESTRE?>"  <?=($transporte==Constantes::TERRESTRE)?"selected":""?>><?=Constantes::TERRESTRE?>  </option>
       			</select>          	
          </td>
          <?
        }
        else
        {
        ?>
        <input type="hidden" name="impoexpo" id="impoexpo" value="<?=Constantes::INTERNO?>">
        <input type="hidden" name="transporte" id="transporte" value="<?=Constantes::TERRESTRE?>">
        <?
        }
          ?>
          <td class="listar">Año: <br />
            <select name="anio" id="anio">
                <option value="" <?=($aa=="")?"selected":""?>>Todos</option>
                <!--<option value="<?=(date("Y"))?>" <?=($aa==date("Y"))?"selected":""?>><?=date("Y")?></option>-->
                <?
                for($i=(date("Y"));$i>=(date("Y")-2);$i--)
                {
                ?>
                <option value="<?=($i)?>" <?=($aa==$i)?"selected":""?>><?=$i?></option>
                <?
                }
                ?>
            </select>          
          </td>
     <?
            if($permiso>=2 )
            {
     ?>
          <td class="listar">Sucursal: <br />
 

              <select name="sucursal" id="sucursal" onchange="loadUser(this.value)">
                  <option value="" selected>Todas</option>
                <?
                foreach($sucursales2 as $s)
                {
                    switch($s["ca_nombre"])
                    {
                        case "BogotÃ¡ D.C.":
                          $s["ca_nombre"]="Bogotá D.C.";
                        break;
                        case "MedellÃ­n":
                          $s["ca_nombre"]="Medellín";
                        break;
                    }
                ?>
                  <option value="<?=  ($s["ca_nombre"])?>" <?=($sucursal==$s["ca_nombre"])?"selected":""?>> <?=$s["ca_nombre"]?> </option>
                <?
                }
                ?>
            </select>
          </td>
     
          <td class="listar">Comercial: <br />
           <!--<select name="comercial" id="comercial">                
                <?
                foreach($comerciales as $c)
                {
                ?>
                <option value="<?=$c->getCaLogin()?>"><?=($c->getCaNombre())?></option>
                <?
                }
                ?>
            </select>          -->
              
              <input type='comercial' id='comercial' name='comercial' />
                                    <script>
                                    var mu=new WidgetUsuario({
                                        id: 'comercial',
                                        name: 'comercial',
                                        hiddenName: "idcomercial",
                                        value:"<?=$comercial?>",
                                        hiddenValue:"<?=$idcomercial?>",
                                        applyTo: "comercial"
                                    })
                                    </script>

          </td>
        <?
              }
            ?>
          
          <td class="listar">Mes: <br />
            <select name="mes" id="mes">
            	<option value="">Todos los Meses</option>
                <option value="01" <?=($mm=="01")?"selected":""?> >Enero</option>
                <option value="02" <?=($mm=="02")?"selected":""?>>Febrero</option>
                <option value="03" <?=($mm=="03")?"selected":""?>>Marzo</option>
                <option value="04" <?=($mm=="04")?"selected":""?>>Abril</option>
                <option value="05" <?=($mm=="05")?"selected":""?>>Mayo</option>
                <option value="06" <?=($mm=="06")?"selected":""?>>Junio</option>
                <option value="07" <?=($mm=="07")?"selected":""?>>Julio</option>
                <option value="08" <?=($mm=="08")?"selected":""?>>Agosto</option>
                <option value="09" <?=($mm=="09")?"selected":""?>>Septiembre</option>
                <option value="10" <?=($mm=="10")?"selected":""?>>Octubre</option>
                <option value="11" <?=($mm=="11")?"selected":""?>>Noviembre</option>
                <option value="12" <?=($mm=="12")?"selected":""?>>Diciembre</option></select>          
          </td>

          <td class="listar" >Estado : <br/>
            <select name="casos" id="casos">
                <option value="0" <?=($casos=="0")?"selected":""?>>Casos Cerrados</option>
                <option value="1" <?=($casos=="1")?"selected":""?>>Casos Abiertos</option>
                <option value="2" <?=($casos=="2")?"selected":""?>>Casos Para comisionar</option>
                <option value="3" <?=($casos=="3")?"selected":""?>>Casos Para comisionar sin circular</option>
                <option value="" <?=($casos=="")?"selected":""?>>Todos los Casos</option></select>          
          </td>
        </tr>
      </table>

      <br />
        <table cellspacing="10">
            <tr>
                <th>
                    <input class="submit" type='submit' name='buscar' value='Buscar'  />  
                </th>
            </tr>
        </table>
    </form>

</center>

<script>
    function loadUser(value)
    {
        Ext.getCmp("comercial").store.setBaseParam("perfil","comercial");	
        if(value)
            Ext.getCmp("comercial").store.setBaseParam("ciudad",value);	
        Ext.getCmp("comercial").store.load();
    }
</script>
