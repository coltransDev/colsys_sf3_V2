<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
*/

?>
<table width="100%" class="tableList">    
    <tr>
        <th colspan="4"><b>Informaci&oacute;n de exportaciones</b></th>
    </tr>
    <tr>
        <td  width="213">
            <strong>Piezas:</strong><br>
            <div style="display: none;" class="form_error" id="error_for_piezas"> ?&nbsp; &nbsp;?</div>

            <input name="piezas" id="piezas" value="" size="8" type="text"><select name="tipo_piezas" id="tipo_piezas"><option value="Bultos">Bultos</option>
                <option value="Cajas">Cajas</option>
                <option value="Cartones">Cartones</option>
                <option value="Pallets">Pallets</option>
                <option value="Patines">Patines</option>
                <option value="Piezas">Piezas</option>
                <option value="Rollos">Rollos</option>
                <option value="Sacos">Sacos</option>
                <option value="Tambores">Tambores</option>

            </select>
        </td>
        <td  width="201"><strong>Peso:</strong> <br>
            <div style="display: none;" class="form_error" id="error_for_peso"> ?&nbsp; &nbsp;?</div>
            <input name="peso" id="peso" value="" size="8" type="text"><select name="tipo_peso" id="tipo_peso"><option value="Kilos">Kilos</option>
            </select>		</td>
        <td  width="283"><strong>Volumen: </strong><br>

            <div style="display: none;" class="form_error" id="error_for_volumen"> ?&nbsp; &nbsp;?</div>
            <input name="volumen" id="volumen" value="" size="8" type="text">				<div style="display: none;" id="tipo_volumen_maritimo">
                <select name="tipo_volumen_maritimo" id="tipo_volumen_maritimo"><option value="M&amp;sup3;">M³</option>
                </select>				</div>
            <div style="display: inline;" id="tipo_volumen_aereo">
                <select name="tipo_volumen_aereo" id="tipo_volumen_aereo"><option value="V/Kilos">V/Kilos</option>

                </select>				</div>
        </td>
        <td  width="167">

            <strong>Dimensiones:</strong> (cant;largoxanchoxalto en metros) <br>
            <div style="display: none;" class="form_error" id="error_for_dimensiones"> ?&nbsp; &nbsp;?</div>
            <textarea name="dimensiones" id="dimensiones" rows="3" cols="22"></textarea>		</td>

    </tr>
    <tr>
        <td colspan="2" >
            <strong>Valor de Carga (USD):</strong><br>
            <div style="display: none;" class="form_error" id="error_for_valorCarga"> ?&nbsp; &nbsp;?</div>
            <input name="valorCarga" id="valorCarga" value="" size="12" type="text">
        </td>
        <td colspan="2"  valign="top"><strong>Agente Aduanero:</strong><br>

            <select name="sia" id="sia"><option value="19">ADUANA GAMA</option>
                <option value="61">ADUANA HUBEMAR</option>
                <option value="52">Aduanar</option>
                <option value="49">ADUANAS  AVIA LTDA  SIA</option>
                <option value="18">Aduanas y Servicios</option>
                <option value="74">ADUANERA  GRAN COLOMBIANA SIA LTDA. </option>
                <option value="82">ADUANIMEX  S.A. SIA </option>
                <option value="54">Aeromarítimo</option>

                <option value="15">Agecoldex</option>
                <option value="97">AGENCIA DE ADUANA DINAMICA ADUANERA SIA LTDA</option>
                <option value="96">AGENCIA DE ADUANAS ABC REPECEV S.A. Nivel 1</option>
                <option value="87">AGENCIA DE ADUANA SAETA LTDA</option>
                <option value="98">AGENCIA DE ADUANAS CEVA LOGISTICS NIVEL 2</option>
                <option value="92">AGENCIA DE ADUANAS GRANANDINA DE ADUANAS </option>
                <option value="100">AGENCIA DE ADUANAS JORGE NUMA LTDA. NIVEL 1 </option>
                <option value="39">AGENCIA NACIONAL  ADUANERA  LTDA  SIA </option>
                <option value="65">ALADUANA S.A. </option>

                <option value="24">ALADUANA  SIA </option>
                <option value="59">ALMACENAR</option>
                <option value="45">ALMAGRAN </option>
                <option value="73">ALMAVIVA</option>
                <option value="62">ALPASAR LTDA. </option>
                <option value="57">ALPOPULAR</option>
                <option value="12">Ascointer SIA Ltda</option>
                <option value="11">Asecol SIA</option>
                <option value="46">ASIMCOMEX  LTDA</option>

                <option value="44">A.ST.</option>
                <option value="84">CARGO FLASH</option>
                <option value="56">CARLOS CAMPUZANO</option>
                <option value="42">CEA Ltda.</option>
                <option value="17">COLMAS</option>
                <option value="9">Colmas-Acodex SIA Ltda.</option>
                <option value="80">COMERCIAL PLASTIDER S.A. SIA</option>
                <option value="93">COMERCIO EXTERIOR LIDERES S.A. NIVEL 1 </option>
                <option value="77">CONTINENTAL DE ADUANAS</option>

                <option value="7">Coral Vision</option>
                <option value="20">CS S.IA LTDA</option>
                <option value="79">CUSTOM INTERNACIONAL </option>
                <option value="40">EXCELSIA </option>
                <option value="41">Export Cargo</option>
                <option value="47">FEDECMEX  SIA</option>
                <option value="63">FUERZA AEREA COLOMBIANA </option>
                <option value="26">GAMA SOCIEDAD DE INTERNMEDIACION ADUANERA</option>
                <option value="95">GEOCARGA SIA LTDA</option>

                <option value="31">GRUPO ADUANERO  SIA LTDA</option>
                <option value="32">GRUPO ADUANERO  SIA LTDA</option>
                <option value="50">HECADUANAS</option>
                <option value="91">HERMAN SCHWYN SIA </option>
                <option value="10">IMEX</option>
                <option value="72">INTERBLUE SIA S.A.</option>
                <option value="51">Interlogistica</option>
                <option value="23">JOSE MANUEL DIAZ</option>
                <option value="86">JULIO FERNANDEZ VELEZ</option>

                <option value="89">K &amp; D  SIA LTDA. </option>
                <option value="34">KN  COLOMBIA  SIA  S.A</option>
                <option value="55">LOGISTICA  PASAR  LTDA</option>
                <option value="53">Mariano Roldan</option>
                <option value="25">MARIO LONDOÑO  SIA </option>
                <option value="76">MAR Y AIRE</option>
                <option value="69">MERCO  REPRESENTACIONES  SIA </option>
                <option value="68">MERCO  REPRESENTACIONES  SIA </option>

                <option value="29">MORADUANAS  SIA LTDA</option>
                <option value="60">MOVIADUANAS</option>
                <option value="22">Ninguna</option>
                <option value="64">NUMA SIA </option>
                <option value="94">PANIMEX SIA</option>
                <option value="38">RCL CARGO</option>
                <option value="33">ROLDAN  SIA </option>
                <option value="36">ROLICARGO  SIA LTDA</option>
                <option value="78">SAIJO</option>

                <option value="48">SERINCE SIA LTDA</option>
                <option value="35">SERVADE LTDA  SIA </option>
                <option value="75">SIA ADUANAMIENTOS</option>
                <option value="16">Siaco</option>
                <option value="81">SIACOMEX LTDA</option>
                <option value="43">SIA DHL</option>
                <option value="67">SIA EZL</option>
                <option value="88">SIA  FHM</option>
                <option value="13">SIA Hecaduanas Ctg.</option>

                <option value="66">SIA INTERNACIONAL </option>
                <option value="14">Siamex</option>
                <option value="28">SIA  MIRCANA </option>
                <option value="27">SIA NACIONAL ADUANERA  LTDA</option>
                <option value="8">SIAP</option>
                <option value="90">SIA SEI TRANSGLOBAL</option>
                <option value="30">SIA SHENKER</option>
                <option value="85">SIA SUDECO</option>
                <option value="83">SIA TRADE</option>

                <option value="21">SIA  UNIVERSAL  LOGISTICS  LTDA</option>
                <option value="37">TRASLADOS  INTERNACIONALES</option>
            </select></td>
    </tr>

    <tr>
        <td >
            <div style="display: none;" id="emisionbl">
                <strong>Lugar de emisión BL</strong><br>
                <select name="emisionbl" id="emisionbl"><option value="" selected="selected"></option>

                    <option value="Origen">Origen</option>
                    <option value="Destino">Destino</option>
                </select>			</div>			</td>
        <td >
            <div style="display: none;" id="cuantosbl">
                <strong>Cuantos BL? </strong><br>
                <input name="numbl" id="numbl" value="" type="text">			</div>		</td>

        <td  colspan="2"><strong>Tipo de exportación: </strong><br>
            <select name="tipoexpo" id="tipoexpo"><option value="1">Exportación Definitiva</option>
                <option value="2">Exportación Definitiva en Garantia</option>
                <option value="3">Re-Exportación</option>
                <option value="4">Re-Embarque</option>
                <option value="5">Re-Expedición</option>
                <option value="6">Exportación Temporal Perfeccionamiento Pasivo</option>
                <option value="7">Menajes</option>

                <option value="8">Muestra Sin Valor Comercial</option>
                <option value="9">Exportación Definitiva sin reintegro </option>
            </select></td>
    </tr>
    <tr>
        <td >
            <strong>Motonave/Vuelo</strong><br>
            <input name="motonave" id="motonave" value="" size="30" type="text">		</td>

        <td ><strong>Solicitud anticipo</strong><br>
            <input name="anticipo" id="anticipo_Si" value="Si" checked="checked" type="radio">Sí&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="anticipo" id="anticipo_No" value="No" type="radio">No
        </td>
        <td  colspan="2">&nbsp;</td>
    </tr>
</table>
