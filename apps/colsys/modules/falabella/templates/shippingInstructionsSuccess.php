<?
use_helper("Javascript", "Validation");
?>

<script language="javascript">
	function showEmailForm(){
		if( document.getElementById('emailForm').style.display=="none"){ 
			<?
			echo visual_effect('BlindDown', 'emailForm');
			?>
		}else{
			<?
			echo visual_effect('BlindUp', 'emailForm');
			?>
		}
	}
</script>
<div id="emailForm" align="left" style="display:none;">
	<?
	echo form_remote_tag(array("url"=>"falabella/enviarEmail?iddoc=".urlencode($header->getCaIdDoc()), 
								"update"=>"emailForm",
								 'loading'  => visual_effect('appear', 'indicator'),
							    'complete' => visual_effect('fade', 'indicator')							
							
						 ));
	include_component("general", "formEmail");
	?>
	<br />
	<div align="left"><?=submit_tag("Enviar");?></div><br /><br />

</div>

<table cellspacing="0" cellpadding="0" class="tableForm">
	
	
	<tr >
		<td colspan="4" ><div align="center"><strong>Shipper    &amp; Forwarder Shipping Instructions</strong></div></td>
	</tr>
	<tr >
		<td  ></td>
		<td ></td>
		<td ></td>
		<td ><?=$header->getCaFechaCarpeta()?></td>
	</tr>
	<tr >
		<td ></td>
		<td></td>
		<td><strong>Carpeta</strong></td>
		<td><?=substr($header->getCaIdDoc(),0,15)?></td>
	</tr>
	<tr >
		<td ><strong>Trader</strong></td>
		<td><?=$header->getCaTrader()?></td>
		<td><strong>Forwarder</strong></td>
		<td>COLTRANS S.A.</td>
	</tr>
	<tr >
		<td ><strong>Address</strong></td>
		<td>&nbsp;</td>
		<td>Contact</td>
		<td>&nbsp;</td>
	</tr>
	<tr >
		<td ><strong>Tel/Fax</strong></td>
		<td>&nbsp;</td>
		<td>Tel/Fax</td>
		<td>&nbsp;</td>
	</tr>
	<tr >
		<td ><strong>Contact</strong></td>
		<td>&nbsp;</td>
		<td><strong>Shipping Line</strong></td>
		<td><?=$info->getCaLine()?></td>
	</tr>
	<tr >
		<td >&nbsp;</td>
		<td>&nbsp;</td>
		<td><strong>Contact</strong></td>
		<td><?=$info->getCaContactLine()?></td>
	</tr>
	<tr >
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr >
		<td ><strong>Vendor</strong></td>
		<td><?=$header->getCaVendorName()?></td>
		<td>From</td> <!--No estan el el archivo-->
		<td>&nbsp;</td>
	</tr>
	<tr >
		<td ><strong>Address</strong></td>
		<td><?=$header->getCaVendorAddr1()?></td>
		<td>Tel/Fax</td>
		<td>&nbsp;</td>
	</tr>
	<tr >
		<td ><strong>Tel/Fax</strong></td>
		<td><?=$header->getCaManufacturerPhone()?>
		<?=$header->getCaManufacturerFax()?></td>
		<td><strong>Total Units Per    Proforma-Invoice</strong></td>
		<td><?=$info->getCaUppo()?></td>
	</tr>
	<tr >
		<td ><strong>Contact</strong></td>
		<td><?=$header->getCaManufacturerContact()?></td>
		<td><strong>Notes</strong></td>
		<td><?=$header->getCaOrdenComments()?></td>
	</tr>
	<tr >
		<td ></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr >
		<td ><strong>Suplier REF</strong></td>
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
		<td ><strong>Shipment Windows</strong></td>
		<td><?=$header->getCaEsd()." ".$header->getCaLsd() ?></td>
		<td><strong>Falabella Import Ref</strong></td>
		<td><?=$header->getCaProformaNumber()?></td>
	</tr>
	<tr >
		<td ></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr >
		<td ><strong>Commodities</strong></td>
		<td><?=$info->getCaCommodities() ?></td>
		<td><strong>Expected Booking</strong></td>
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
		<td ><strong>Partial Shipment</strong></td>
		<td><?=$info->getcaPartial()=="Y"?"ALLOWED":"NOT ALLOWED"?></td>
		<td><strong>Shipment Port/Airport</strong></td>
		<td><?=$info->getCaPort()?></td>
	</tr>
	<tr >
		<td ><strong>Term of    Payment</strong></td>
		<td><?=$header->getCaPaymentTerms()?></td>
		<td><strong>Transshipment</strong></td>
		<td><?=$info->getCaTransshipment()=="Y"?"ALLOWED":"NOT ALLOWED"?></td>
	</tr>
	<tr >
		<td ><strong>Incoterm</strong></td>
		<td><?=$header->getCaIncoterms()?></td>
		<td><strong>Transport</strong></td>
		<td>
			<?		
			switch($info->getCaTransportVia()){
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
			?>		</td>
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
		<td><strong>Documents Required</strong></td>
		<td>(Orig) / (Copy)</td>
	</tr>
	<tr >
		<td >40'HC</td>
		<td>&nbsp;</td>
		<td><strong>Invoice</strong></td>
		<td>  ( 
		<?=$info->getCaInvoiceOrg()?>) / ( <?=$info->getCaInvoiceCps()?> )</td>
	</tr>
	<tr >
		<td >NOR</td>
		<td>&nbsp;</td>
		<td><strong>Packing List</strong></td>
		<td> ( 
		<?=$info->getCaPackingListOrg()?>) / ( <?=$info->getCaPackingListCps()?> )</td>
	</tr>
	<tr >
		<td >GOH</td>
		<td></td>
		<td><strong>B/L-AWB</strong></td>
		<td> ( 
			<?=$info->getCaDocumentOrg()?>
			) / (
			<?=$info->getCaDocumentCps()?>
)</td>
	</tr>
	<tr >
		<td >LCL/FCL</td>
		<td>&nbsp;</td>
		<td><strong>Origin Cert</strong></td>
		<td> ( 
		<?=$info->getCaOcOrg()?>) / ( <?=$info->getCaOcCps()?> )</td>
	</tr>
	<tr >
		<td >LCL</td>
		<td>&nbsp;</td>
		<td><strong>Other Docs</strong></td>
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
		<td><strong>Issuing Original B/L</strong></td>
		<td>(Origin) / (Destinatios)</td>
	</tr>
	<tr >
		<td ><strong>PO Number</strong></td>
		<td>
		<?=$header->getCaProformaNumber()?></td>
		<td><strong>Shipping</strong></td>
		<td>( <?=$info->getCaShippingOrg()?> ) / ( <?=$info->getCaShippingDst()?> )</td>
	</tr>
	<tr >
		<td ><strong>Our Ref. Nbr</strong></td>
		<td><?=substr($header->getCaIdDoc(),0,15)?></td>
		<td><strong>Original</strong></td>
		<td> ( 
			<?=$info->getCaOriginalOrg()?>
) / (
<?=$info->getCaOriginalDst()?>
 )</td>
	</tr>
	<tr >
		<td >Nr CTN</td>
		<td>..........</td>
		<td><strong>Forwarders Copy</strong></td>
		<td>(<?=$info->getCaFwdCopyOrg()?>
) / (
<?=$info->getCaFwdCopyDst()?>
)</td>
	</tr>
	<tr >
		<td >Nr Units</td>
		<td>..........</td>
		<td><strong>Fcr</strong></td>
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
		<td ><strong>Port    Destination</strong></td>
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

