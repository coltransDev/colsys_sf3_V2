---------- CLIENTES.PHP
[356]			 echo "  <TD Class=mostrar><INPUT TYPE='TEXT' READONLY NAME='fchcompromiso' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- CLIENTES_ADM.PHP
[364]			 echo "  <TD Class=mostrar><INPUT TYPE='TEXT' READONLY NAME='fchcompromiso' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- CONFIRMACIONES.PHP
[58]	echo "  <TD Class=listar>Fecha Inicial:<BR><INPUT TYPE='TEXT' READONLY NAME='fchinicial' SIZE=12 VALUE='".date(date("Y")."-".date("m")."-"."01")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[59]	echo "  <TD Class=listar>Fecha Final :<BR><INPUT TYPE='TEXT' READONLY NAME='fchfinal' SIZE=12 VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[288]		        echo "  <TD Class=mostrar>Fecha Confirmación:<BR><INPUT TYPE='TEXT' READONLY NAME='fchconfirmacion' VALUE='".$rs->Value('ca_fchconfirmacion')."' SIZE=12 ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[291]		        echo "  <TD Class=mostrar>Fecha Registro:<BR><INPUT TYPE='TEXT' READONLY NAME='fchregistroadu' VALUE='".$rs->Value('ca_fchregistroadu')."' SIZE=12 ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[297]		        echo "  <TD Class=mostrar>Fecha Desconsolidación:<BR><INPUT TYPE='TEXT' READONLY NAME='fchdesconsolidacion' VALUE='".$rs->Value('ca_fchdesconsolidacion')."' SIZE=12 ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- COTIZACIONES.PHP
[331]			 echo "  <TD Class=listar><INPUT TYPE='TEXT' READONLY NAME='fchcotizacion' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[446]			 echo "  <TD Class=listar><INPUT TYPE='TEXT' READONLY NAME='fchcotizacion' SIZE=12 VALUE='".$rs->Value('ca_fchcotizacion')."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- ENCCLIENTE.PHP
[250]			 echo "  <TD Class=mostrar COLSPAN=2>Fecha de la Visita : <INPUT TYPE='TEXT' READONLY NAME='fchvisita' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- FLETES.PHP
[292]             echo "  <TD Class=mostrar style='text-align: center;'><B>Inicio Vigencia:</B><BR><INPUT TYPE='TEXT' READONLY NAME='fchinicio' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[293]             echo "  <TD Class=mostrar style='text-align: center;'><B>Final Vigencia:</B><BR><INPUT TYPE='TEXT' READONLY NAME='fchvencimiento' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[407]             echo "  <TD Class=mostrar style='text-align: center;'><B>Inicio Vigencia:</B><BR><INPUT TYPE='TEXT' READONLY NAME='fchinicio' SIZE=12 VALUE='".$rs->Value('ca_fchinicio')."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[408]             echo "  <TD Class=mostrar style='text-align: center;'><B>Final Vigencia:</B><BR><INPUT TYPE='TEXT' READONLY NAME='fchvencimiento' SIZE=12 VALUE='".$rs->Value('ca_fchvencimiento')."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- INOSEA.PHP
[59]	echo "  <TD Class=listar>Fecha Inicial:<BR><INPUT TYPE='TEXT' READONLY NAME='fchinicial' SIZE=12 VALUE='".date(date("Y")."-".date("m")."-"."01")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[60]	echo "  <TD Class=listar>Fecha Final :<BR><INPUT TYPE='TEXT' READONLY NAME='fchfinal' SIZE=12 VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[537]			 echo "  <TD Class=mostrar><INPUT TYPE='TEXT' READONLY NAME='fchcompromiso' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[623]			 echo "  <TD Class=mostrar><INPUT TYPE='TEXT' READONLY NAME='fchcompromiso' SIZE=12 VALUE='".$rs->Value('ca_fchcompromiso')."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[792]             echo "  <TD Class=listar>Fecha Factura:<BR><INPUT TYPE='TEXT' READONLY NAME='fchfactura' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[930]             echo "  <TD Class=listar>Fecha Factura:<BR><INPUT TYPE='TEXT' READONLY NAME='fchfactura' VALUE='".$rs->Value('ca_fchfactura')."' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1133]             echo "  <TD Class=mostrar>Fecha Factura:<BR><INPUT TYPE='TEXT' READONLY NAME='fchfactura[]' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1140]             echo "  <TD Class=mostrar>Fecha Factura:<BR><INPUT TYPE='TEXT' READONLY NAME='fchfactura[]' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1147]             echo "  <TD Class=mostrar>Fecha Factura:<BR><INPUT TYPE='TEXT' READONLY NAME='fchfactura[]' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1278]	             echo "  <TD Class=mostrar>Fecha Factura:<BR><INPUT TYPE='TEXT' READONLY NAME='fchfactura[]' VALUE='".$rs->Value('ca_fchfactura')."' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1288]             echo "  <TD Class=mostrar>Fecha Factura:<BR><INPUT TYPE='TEXT' READONLY NAME='fchfactura[]' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1588]//             echo "  <TD Class=mostrar COLSPAN=2>Fecha de Registro : <INPUT TYPE='TEXT' NAME='fchreferencia' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYUP='chkDate(this)' ONKEYPRESS='javascript:if(event.keyCode==13)return false;' ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1589]             echo "  <TD Class=mostrar COLSPAN=2>Fecha de Registro : <INPUT TYPE='TEXT' NAME='fchreferencia' SIZE=12 VALUE='".date("Y-m-d")."' ONKEYPRESS='chkDate(this)' ONDBLCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1622]             echo "  <TD Class=mostrar>Fecha Estim.Embarque:<BR><INPUT TYPE='TEXT' READONLY NAME='fchembarque' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1623]             echo "  <TD Class=mostrar>Fecha Estim.Arribo:<BR><INPUT TYPE='TEXT' READONLY NAME='fcharribo' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1842]             echo "  <TD Class=mostrar COLSPAN=2>Fecha de Registro : <INPUT TYPE='TEXT' READONLY NAME='fchreferencia' SIZE=12 VALUE='".$rs->Value('ca_fchreferencia')."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1891]             echo "  <TD Class=mostrar>Fecha Estim.Embarque:<BR><INPUT TYPE='TEXT' READONLY NAME='fchembarque' VALUE='".$rs->Value('ca_fchembarque')."' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[1892]             echo "  <TD Class=mostrar>Fecha Estim.Arribo:<BR><INPUT TYPE='TEXT' READONLY NAME='fcharribo' VALUE='".$rs->Value('ca_fcharribo')."' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- INOSEA_ABRIR.PHP
[58]	echo "  <TD Class=listar>Fecha Inicial:<BR><INPUT TYPE='TEXT' READONLY NAME='fchinicial' SIZE=12 VALUE='".date(date("Y")."-".date("m")."-"."01")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[59]	echo "  <TD Class=listar>Fecha Final :<BR><INPUT TYPE='TEXT' READONLY NAME='fchfinal' SIZE=12 VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- INOSEA_CONS.PHP
[58]	echo "  <TD Class=listar>Fecha Inicial:<BR><INPUT TYPE='TEXT' READONLY NAME='fchinicial' SIZE=12 VALUE='".date(date("Y")."-".date("m")."-"."01")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[59]	echo "  <TD Class=listar>Fecha Final :<BR><INPUT TYPE='TEXT' READONLY NAME='fchfinal' SIZE=12 VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- INOSEA_GERE.PHP
[58]	echo "  <TD Class=listar>Fecha Inicial:<BR><INPUT TYPE='TEXT' READONLY NAME='fchinicial' SIZE=12 VALUE='".date(date("Y")."-".date("m")."-"."01")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[59]	echo "  <TD Class=listar>Fecha Final :<BR><INPUT TYPE='TEXT' READONLY NAME='fchfinal' SIZE=12 VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- PLANILLAS.PHP
[126]             echo "  <TD Class=mostrar>Inicio de vigencia<BR><INPUT TYPE='TEXT' READONLY NAME='fchinicio' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[127]             echo "  <TD Class=mostrar>Vencimiento<BR><INPUT TYPE='TEXT' READONLY NAME='fchvencimiento' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- RECARGOS.PHP
[156]             echo "  <TD Class=mostrar>Inicio<BR><INPUT TYPE='TEXT' DISABLED READONLY NAME='fchinicio' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[157]             echo "  <TD Class=mostrar>Vencimiento<BR><INPUT TYPE='TEXT' DISABLED READONLY NAME='fchvencimiento' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[336]             echo "  <TD Class=mostrar>Inicio<BR><INPUT TYPE='TEXT' ".($rs->Value('ca_aplicacion')=='Permanente'?'DISABLED':'')." READONLY NAME='fchinicio' SIZE=12 VALUE='".$rs->Value('ca_fchinicio')."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[337]             echo "  <TD Class=mostrar>Vencimiento<BR><INPUT TYPE='TEXT' ".($rs->Value('ca_aplicacion')=='Permanente'?'DISABLED':'')." READONLY NAME='fchvencimiento' SIZE=12 VALUE='".$rs->Value('ca_fchvencimiento')."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- RECARGOSXTRAF.PHP
[329]             echo "  <TD Class=listar>Inicio<BR><INPUT TYPE='TEXT' DISABLED READONLY NAME='fchinicio' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[330]             echo "  <TD Class=listar>Vencimiento<BR><INPUT TYPE='TEXT' DISABLED READONLY NAME='fchvencimiento' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[536]             echo "  <TD Class=mostrar>Inicio<BR><INPUT TYPE='TEXT' ".($rs->Value('ca_aplicacion')=='Permanente'?'DISABLED':'')." READONLY NAME='fchinicio' SIZE=12 VALUE='".$rs->Value('ca_fchinicio')."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[537]             echo "  <TD Class=mostrar>Vencimiento<BR><INPUT TYPE='TEXT' ".($rs->Value('ca_aplicacion')=='Permanente'?'DISABLED':'')." READONLY NAME='fchvencimiento' SIZE=12 VALUE='".$rs->Value('ca_fchvencimiento')."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";

---------- REPORTENEGOCIO.PHP
[62]	echo "  <TD Class=listar>Fecha Inicial:<BR><INPUT TYPE='TEXT' READONLY NAME='fchinicial' SIZE=12 VALUE='".date(date("Y")."-".date("m")."-"."01")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[63]	echo "  <TD Class=listar>Fecha Final :<BR><INPUT TYPE='TEXT' READONLY NAME='fchfinal' SIZE=12 VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[218]			 echo "  <TD Class=titulo style='text-align:left; vertical-align:top;' ROWSPAN=2>4. Fecha Despacho:<BR><CENTER><INPUT TYPE='TEXT' READONLY NAME='fchdespacho' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";
[452]			 echo "  <TD Class=titulo style='text-align:left; vertical-align:top;' ROWSPAN=2>4. Fecha Despacho:<BR><CENTER><INPUT TYPE='TEXT' READONLY NAME='fchdespacho' SIZE=12 VALUE='".$rs->Value('ca_fchdespacho')."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";

---------- TARIFARIO.PHP
[184]    echo "  <TD Class=mostrar COLSPAN=2><B>Fecha :</B><BR><CENTER><INPUT TYPE='TEXT' READONLY NAME='fchcotizacion' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";

---------- TARIFARIO_CONS.PHP
[184]    echo "  <TD Class=mostrar COLSPAN=2><B>Fecha :</B><BR><CENTER><INPUT TYPE='TEXT' READONLY NAME='fchcotizacion' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></CENTER></TD>";

---------- TRAYECTOS.PHP
[459]             echo "  <TD Class=mostrar><INPUT TYPE='TEXT' READONLY NAME='fchcreado' SIZE=12 VALUE='".date("Y-m-d")."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";





---------- UPTARIFARIO.PHP
[225]				echo "  <TD Class=mostrar style='text-align: center;'><B>Inicio Vigencia:</B><BR><INPUT TYPE='TEXT' READONLY NAME='fchinicio_f' SIZE=12 VALUE='".$ini_mem."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[226]				echo "  <TD Class=mostrar style='text-align: center;'><B>Final Vigencia:</B><BR><INPUT TYPE='TEXT' READONLY NAME='fchvencimiento_f' SIZE=12 VALUE='".$ven_mem."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[317]		            echo "  <TD Class=invertir>Inicio<BR><INPUT ID=fchinicio_$j TYPE='TEXT' ".($rs->Value('ca_aplicacion')!='Temporal'?'DISABLED':'')." READONLY NAME='reg_".$rs->Value('ca_oid_r')."[fchinicio]' SIZE=12 VALUE='".$ini_mem."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[318]		            echo "  <TD Class=invertir>Vencimiento<BR><INPUT ID=fchvencimiento_$j TYPE='TEXT' ".($rs->Value('ca_aplicacion')!='Temporal'?'DISABLED':'')." READONLY NAME='reg_".$rs->Value('ca_oid_r')."[fchvencimiento]' SIZE=12 VALUE='".$ven_mem."' ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[385]		            echo "  <TD Class=imprimir>Inicio<BR><INPUT ID=fchinicio_$z TYPE='TEXT' DISABLED READONLY NAME='reg_nuevo_".$z."[fchinicio]' VALUE='".date(date("Y")."-".date("m")."-"."01")."' SIZE=12 ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
[386]		            echo "  <TD Class=imprimir>Vencimiento<BR><INPUT ID=fchvencimiento_$z TYPE='TEXT' DISABLED READONLY NAME='reg_nuevo_".$z."[fchvencimiento]' VALUE='".date( "Y-m-d", mktime(0,0,0,date("m")+1,0,date("Y")))."' SIZE=12 ONCLICK=\"popUpCalendar(this, this, 'yyyy-mm-dd')\"></TD>";
