<?

?>
<div class="content" align="center" >
    <script language="javascript">
            function showEmailForm(){
                    if( document.getElementById('emailForm').style.display=="none"){
                            document.getElementById('emailForm').style.display="inline";
                    }else{
                            document.getElementById('emailForm').style.display="none";
                    }
            }
    </script>
    <div id="emailForm" align="left" style="display:none;">
            <form name="form1" id="form1" method="post" action="<?=url_for("falabella/enviarEmail?iddoc=".base64_encode($header->getCaIddoc()))?>">
            <?
            $asunto = 'Shipper & Forwarder Shipping Instructions - Coltrans S.A.';
            $mensaje= '';
            include_component("email", "formEmail", array("subject"=>$asunto,"message"=>$mensaje,"contacts"=>$contactos));
            ?>
            <div align="center"><input type="submit" name="commit" value="Enviar" /></div><br /><br />
        </form>
    </div>

    <table cellspacing="0" cellpadding="0" class="tableList">
        <tr >
            <th colspan="4" ><div align="center"><b>Shipper    &amp; Forwarder Shipping Instructions</b></div></th>
        </tr>
        <tr >
            <td ></td>
            <td ></td>
            <td ></td>
            <td ><?=$header->getCaFechaCarpeta()?></td>
        </tr>
        <tr >
            <td ></td>
            <td></td>
            <td><b>Carpeta</b></td>
            <td><?=substr($header->getCaIddoc(),0,15)?></td>
        </tr>
        <tr >
            <td ><b>Trader</b></td>
            <td><?=$header->getCaTrader()?></td>
            <td><b>Forwarder</b></td>
            <td>COLTRANS S.A.</td>
        </tr>
        <tr >
            <td ><b>Address</b></td>
            <td>&nbsp;</td>
            <td>Contact</td>
            <td>&nbsp;</td>
        </tr>
        <tr >
            <td ><b>Tel/Fax</b></td>
            <td>&nbsp;</td>
            <td>Tel/Fax</td>
            <td>&nbsp;</td>
        </tr>
        <tr >
            <td ><b>Contact</b></td>
            <td>&nbsp;</td>
            <td><b>Shipping Line</b></td>
            <td><?=$info->getCaLine()?></td>
        </tr>
        <tr >
            <td >&nbsp;</td>
            <td>&nbsp;</td>
            <td><b>Contact</b></td>
            <td><?=$info->getCaContactLine()?></td>
        </tr>
        <tr >
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr >
            <td ><b>Vendor</b></td>
            <td><?=$header->getCaVendorName()?></td>
            <td>From</td> <!--No estan el el archivo-->
            <td>&nbsp;</td>
        </tr>
        <tr >
            <td ><b>Address</b></td>
            <td><?=$header->getCaVendorAddr1()?></td>
            <td>Tel/Fax</td>
            <td>&nbsp;</td>
        </tr>
        <tr >
            <td ><b>Tel/Fax</b></td>
            <td><?=$header->getCaManufacturerPhone()?> <?=$header->getCaManufacturerFax()?></td>
            <td><b>Total Units Per    Proforma-Invoice</b></td>
            <td><?=$info->getCaUppo()?></td>
        </tr>
        <tr >
            <td ><b>Contact</b></td>
            <td><?=$header->getCaManufacturerContact()?></td>
            <td><b>Notes</b></td>
            <td><?=$header->getCaOrdenComments()?></td>
        </tr>
        <tr >
            <td ></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td ><b>Suplier REF</b></td>
            <td><?=$header->getCaProformaNumber()?></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td ></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td ><b>Shipment Windows</b></td>
            <td><?=$header->getCaEsd()." ".$header->getCaLsd() ?></td>
            <td><b>Falabella Import Ref</b></td>
            <td><?=$header->getCaProformaNumber()?></td>
        </tr>
        <tr >
            <td ></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td ><b>Commodities</b></td>
            <td><?=$info->getCaCommodities() ?></td>
            <td><b>Expected Booking</b></td>
            <td><?=$info->getCaEb()?></td>
        </tr>
        <tr >
            <td ></td>
            <td></td>
            <td>Departure</td>
            <td>&nbsp;</td>
        </tr>
        <tr >
            <td ></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td ><b>Partial Shipment</b></td>
            <td><?=$info->getcaPartial()=="Y"?"ALLOWED":"NOT ALLOWED"?></td>
            <td><b>Shipment Port/Airport</b></td>
            <td><?=$info->getCaPort()?></td>
        </tr>
        <tr >
            <td ><b>Term of    Payment</b></td>
            <td><?=$header->getCaPaymentTerms()?></td>
            <td><b>Transshipment</b></td>
            <td><?=$info->getCaTransshipment()=="Y"?"ALLOWED":"NOT ALLOWED"?></td>
        </tr>
        <tr >
            <td ><b>Incoterm</b></td>
            <td><?=$header->getCaIncoterms()?></td>
            <td><b>Transport</b></td>
            <td>
                <?
                switch($info->getCaTransportVia()) {
                    case "S":
                        echo "Sea";
                        break;
                    case "A":
                        echo "Air";
                        break;
                    case "C":
                        echo "Combined";
                        break;
                    case "R":
                        echo "Road";
                        break;
                }
                ?>
            </td>
        </tr>
        <tr >
            <td >Volume</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td >20'</td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td >40'</td>
            <td>&nbsp;</td>
            <td><b>Documents Required</b></td>
            <td>(Orig) / (Copy)</td>
        </tr>
        <tr >
            <td >40'HC</td>
            <td>&nbsp;</td>
            <td><b>Invoice</b></td>
            <td>  (<?=$info->getCaInvoiceOrg()?>) / ( <?=$info->getCaInvoiceCps()?> )</td>
        </tr>
        <tr >
            <td >NOR</td>
            <td>&nbsp;</td>
            <td><b>Packing List</b></td>
            <td> (<?=$info->getCaPackingListOrg()?>) / ( <?=$info->getCaPackingListCps()?> )</td>
        </tr>
        <tr >
            <td >GOH</td>
            <td></td>
            <td><b>B/L-AWB</b></td>
            <td> (
                <?=$info->getCaDocumentOrg()?>
                ) / (
                <?=$info->getCaDocumentCps()?>
                )</td>
        </tr>
        <tr >
            <td >LCL/FCL</td>
            <td>&nbsp;</td>
            <td><b>Origin Cert</b></td>
            <td> (
                <?=$info->getCaOcOrg()?>) / ( <?=$info->getCaOcCps()?> )</td>
        </tr>
        <tr >
            <td >LCL</td>
            <td>&nbsp;</td>
            <td><b>Other Docs</b></td>
            <td>(
                <?=$info->getCaOthersDocsOrg()?>) / ( <?=$info->getCaOthersDocsCps()?> )</td>
        </tr>
        <tr >
            <td >CBM</td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td >WEIGHT/VOL</td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td ></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td >Cartons Marks</td>
            <td>&nbsp;</td>
            <td><b>Issuing Original B/L</b></td>
            <td>(Origin) / (Destinatios)</td>
        </tr>
        <tr >
            <td ><b>PO Number</b></td>
            <td>
                <?=$header->getCaProformaNumber()?></td>
            <td><b>Shipping</b></td>
            <td>( <?=$info->getCaShippingOrg()?> ) / ( <?=$info->getCaShippingDst()?> )</td>
        </tr>
        <tr >
            <td ><b>Our Ref. Nbr</b></td>
            <td><?=substr($header->getCaIddoc(),0,15)?></td>
            <td><b>Original</b></td>
            <td> (
                <?=$info->getCaOriginalOrg()?>
                ) / (
                <?=$info->getCaOriginalDst()?>
                )</td>
        </tr>
        <tr >
            <td >Nr CTN</td>
            <td>..........</td>
            <td><b>Forwarders Copy</b></td>
            <td>(<?=$info->getCaFwdCopyOrg()?>
                ) / (
                <?=$info->getCaFwdCopyDst()?>
                )</td>
        </tr>
        <tr >
            <td >Nr Units</td>
            <td>..........</td>
            <td><b>Fcr</b></td>
            <td> (
                <?=$info->getCaFcrOrg()?>
                ) / (
                <?=$info->getCaFcrDst()?>
                )</td>
        </tr>
        <tr >
            <td >Style</td>
            <td>..........</td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td >Color</td>
            <td>..........</td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td ><b>Port    Destination</b></td>
            <td><?=$info->getCaFinalPort()?></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td >UPC Nbr</td>
            <td>..........</td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td ></td>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td ></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td >Especial Conditions</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr >
            <td  colspan="3">Send    copy documents by email to:&nbsp;    yacgarzon@Falabella.com.co / smrodriguez@Falabella.com.co</td>
            <td></td>
        </tr>
        <tr >
            <td  colspan="3">Packing    list have to comply with information requerid in our format, UPC must be only    one per CARTON.</td>
            <td></td>
        </tr>
        <tr >
            <td  colspan="2">All    Original Document must be delivery to DHL</td>
            <td></td>
            <td></td>
        </tr>
    </table>

</div>
