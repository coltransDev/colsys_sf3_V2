<?php

/**
 * Subclass for representing a row from the 'tb_fileimported' table.
 *
 * 
 * 
 * @package lib.model.dataimport
 */ 
class FileImported extends BaseFileImported
{
	private $row = array();
	
	
	public function process(){	
		$header = $this->getFileHeader();
		
		$c = new Criteria();
		$c->add( FileColumnPeer::CA_IDCOLUMNA , FileColumnPeer::CA_IDCOLUMNA."=".FileColumnPeer::CA_IDREGISTRO,Criteria::CUSTOM );
		$c->add( FileColumnPeer::CA_IDFILEHEADER, $header->getCaIdfileheader() );
		$registros = FileColumnPeer::doSelect( $c );
				
		
		$resultado = array();
		
		$content = explode("\n",$this->getCaContent());
		
		foreach ($content as $line )
		{			
								
			foreach( $registros as $registro ){
				$this->row = array();	
				if( $registro->getCaColumna() == substr( $line, 0, strlen($registro->getCaColumna()) ) ){					
					$columnas=$registro->getColumnasRegistros();
					//Empieza el proceso del registro
					$pos = 0;
					
					foreach( $columnas as $columna ){				
						if( $columna->getCaTipo()=="date" ){
							$value = Utils::parseDate( (substr( $line, $pos, $columna->getCaLongitud() )));							
						}else{
							$value = substr( $line, $pos, $columna->getCaLongitud() );							
						}
						$this->row[$columna->getCaColumna()]=$value;										
						$pos +=$columna->getCaLongitud() ;		
						
					}	
									
					if(!$this->processFalabella()){
						return false;
					}				
				}					
			}
		}
		return true;
	}
	
	public function processFalabella(){
		
		if(isset($this->row['FALPOH01'])){ //REGISTRO TIPO 1			
			
			$header = FalaHeaderPeer::retrieveByPk( trim($this->row['po_number']) );
			if( !$header ){ //Verifica que no se haya procesado 
				$falaHeader = new FalaHeader();
				$falaHeader->setCaIdDoc( trim($this->row['po_number']) );
				$falaHeader->setCaFechaCarpeta( $this->row['po_date'] );
				$falaHeader->setCaCodigoPuertoPickup( $this->row['origin'] );
				$falaHeader->setCaCodigoPuertoDescarga( $this->row['destination'] );
				$falaHeader->setCaCodigoProveedor( $this->row['vendor_id'] );
				$falaHeader->setCaNombreProveedor( $this->row['vendor_name'] );				
				$falaHeader->setCaArchivoOrigen( $this->getCaNombre() );
				$falaHeader->setCaTrader( trim($this->row['trader']) );
				$falaHeader->setCaVendorId( trim($this->row['vendor_id']) );
				$falaHeader->setCaVendorName( trim($this->row['vendor_name']) );
				$falaHeader->setCaVendorAddr1( trim($this->row['vendor_addr1']) );
				$falaHeader->setCaVendorCity( trim($this->row['vendor_city']) );
				$falaHeader->setCaVendorCountry( trim($this->row['vendor_country']) );
				$falaHeader->setCaEsd( trim($this->row['esd']) );
				$falaHeader->setCaLsd( trim($this->row['lsd']) );
				$falaHeader->setCaIncoterms( trim($this->row['incoterm']) );
				$falaHeader->setCaPaymentTerms( trim($this->row['payment_terms']) );
				$falaHeader->setCaProformaNumber( trim($this->row['proforma_number']) );
				$falaHeader->setCaOrigin( trim($this->row['origin']) );
				$falaHeader->setCaDestination( trim($this->row['destination']) );
				$falaHeader->setCaTransShipPort( trim($this->row['trans_ship_port']) );
				$falaHeader->setCaReqdDelivery( trim($this->row['reqd_delivery']) );
				$falaHeader->setCaOrdenComments( trim($this->row['orden_comments']) );		
				$falaHeader->setCaManufacturerContact( trim($this->row['manufacturer_contact']) );		
				$falaHeader->setCaManufacturerPhone( trim($this->row['manufacturer_phone']) );	
				$falaHeader->setCaManufacturerFax( trim($this->row['manufacturer_fax']) );				
				$falaHeader->save();				
			}else{
				return false;
			}
			
		}
		
		if(isset($this->row['FALPOH02'])){
			
			if( FalaHeaderPeer::retrieveByPK( trim($this->row['po_number'] ) ) ){
				
				$falaShip = new FalaShipmentInfo();
				$falaShip->setCaIdDoc( trim($this->row['po_number']) );
				$falaShip->setCaBeginWindow( trim($this->row['esd']) );
				$falaShip->setCaEndWindow( trim($this->row['lsd']) );
				$falaShip->setCaCommodities( trim($this->row['commodities']) );
				$falaShip->setCaPartial( trim($this->row['partial']) );
				$falaShip->setCaPaymentTerms( trim($this->row['payment_terms']) );
				$falaShip->setCaIncoterms( trim($this->row['incoterm']) );
				$falaShip->setCaContainerType( trim($this->row['container_type']) );
				$falaShip->setCaUtv( trim($this->row['utv']) );
				$falaShip->setCaEtv( trim($this->row['etv']) );
				$falaShip->setCaLine( trim($this->row['line']) );
				$falaShip->setCaContactLine( trim($this->row['contact_line']) );
				$falaShip->setCaContactImporter( trim($this->row['contact_Importer']) );
				$falaShip->setCaUppo( trim($this->row['uppo']) );
				$falaShip->setCaEb( trim($this->row['eb']) );
				$falaShip->setCaEdd( trim($this->row['edd']) );
				$falaShip->setCaPort( trim($this->row['port']) );
				$falaShip->setCaTransshipment( trim($this->row['transshipment']) );
				$falaShip->setCaTransshipmentPort( trim($this->row['transshipment_port']) );
				$falaShip->setCaShippingOrg( trim($this->row['shipping_org']) );
				$falaShip->setCaOriginalOrg( trim($this->row['original_org']) );
				$falaShip->setCaFwdCopyOrg( trim($this->row['fwd_copy_org']) );
				$falaShip->setCaFcrOrg( trim($this->row['fcr_org']) );
				$falaShip->setCaShippingDst( trim($this->row['shipping_dst']) );
				$falaShip->setCaOriginalDst( trim($this->row['original_dst']) );
				$falaShip->setCaFwdCopyDst( trim($this->row['fwd_copy_dst']) );
				$falaShip->setCaFcrDst( trim($this->row['fcr_dst']) );
				$falaShip->setCaTransportVia( trim($this->row['transport_via']) );
				$falaShip->setCaInvoiceOrg( trim($this->row['invoice_org']) );
				$falaShip->setCaPackingListOrg( trim($this->row['packing_list_org']) );
				$falaShip->setCaDocumentOrg( trim($this->row['document_org']) );
				$falaShip->setCaOcOrg( trim($this->row['oc_org']) );
				$falaShip->setCaOthersDocsOrg( trim($this->row['others_docs_org']) );
				$falaShip->setCaPackingListCps( trim($this->row['packing_list_cps']) );
				$falaShip->setCaInvoiceCps( trim($this->row['invoice_cps']) );
				$falaShip->setCaDocumentCps( trim($this->row['document_cps']) );
				$falaShip->setCaOcCps( trim($this->row['oc_cps']) );
				$falaShip->setCaOthersDocsCps( trim($this->row['others_docs_cps']) );
				$falaShip->setCaFinalPort( trim($this->row['final_port']) );
				$falaShip->setCaAlterPort( trim($this->row['alter_port']) );
				$falaShip->setCaFinalPort( trim($this->row['final_port']) );
				$falaShip->setCaLimitDate( trim($this->row['limit_date']) );
				$falaShip->save();				
			}	
		}
		
		if(isset($this->row['FALPOH03'])){ //REGISTRO TIPO 3
			
			if( FalaHeaderPeer::retrieveByPK( trim($this->row['po_number'] ) ) ){	
				$falaInst = new FalaInstruction();
				$falaInst->setCaIdDoc( trim($this->row['po_number']) );
				$falaInst->setCaInstructions( trim($this->row['instructions']) );					
				$falaInst->save();
			}
		}
		
		
		if(isset($this->row['FALPOD01'])){ //REGISTRO TIPO 4
			if( FalaHeaderPeer::retrieveByPK( trim($this->row['po_number'] ) ) ){	
				$falaDetail = new FalaDetail();
				$falaDetail->setCaIdDoc( trim($this->row['po_number']) );
				$falaDetail->setCaSku( trim($this->row['sku']) );	
				$falaDetail->setCaDescripcionItem( trim($this->row['item_description']) );
				$falaDetail->setCaCantidadMiles( $this->row['order_quantity'] );
				$falaDetail->setCaUnidadMedidadCantidad( "PC" );
				$falaDetail->setCaCantidadPaquetesMiles( $this->row['ctns'] );
				$falaDetail->setCaUnidadMedidaPaquetes( "CT" );
				$falaDetail->setCaCantidadVolumenMiles( ($this->row['ctn_hgt'] * $this->row['ctn_wid'] * $this->row['ctn_lgt']) );
				//$falaDetail->setCaUnidadMedidaVolumen( $this->row['long'] );
				$falaDetail->setCaCantidadPesoMiles( $this->row['kgs_net'] );
				$falaDetail->setCaUnidadMedidaPeso( $this->row['unit_measure'] );
				$falaDetail->save();
			}
		}
		
		
		
		
		return true;
		
	}
}
?>