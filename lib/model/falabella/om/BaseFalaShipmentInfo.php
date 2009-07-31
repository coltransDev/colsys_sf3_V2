<?php


abstract class BaseFalaShipmentInfo extends BaseObject  implements Persistent {


  const PEER = 'FalaShipmentInfoPeer';

	
	protected static $peer;

	
	protected $ca_iddoc;

	
	protected $ca_begin_window;

	
	protected $ca_end_window;

	
	protected $ca_commodities;

	
	protected $ca_partial;

	
	protected $ca_payment_terms;

	
	protected $ca_incoterms;

	
	protected $ca_container_type;

	
	protected $ca_utv;

	
	protected $ca_etv;

	
	protected $ca_line;

	
	protected $ca_contact_line;

	
	protected $ca_contact_importer;

	
	protected $ca_uppo;

	
	protected $ca_eb;

	
	protected $ca_edd;

	
	protected $ca_port;

	
	protected $ca_transshipment;

	
	protected $ca_transshipment_port;

	
	protected $ca_shipping_org;

	
	protected $ca_original_org;

	
	protected $ca_fwd_copy_org;

	
	protected $ca_fcr_org;

	
	protected $ca_shipping_dst;

	
	protected $ca_original_dst;

	
	protected $ca_fwd_copy_dst;

	
	protected $ca_fcr_dst;

	
	protected $ca_transport_via;

	
	protected $ca_invoice_org;

	
	protected $ca_packing_list_org;

	
	protected $ca_document_org;

	
	protected $ca_oc_org;

	
	protected $ca_others_docs_org;

	
	protected $ca_invoice_cps;

	
	protected $ca_packing_list_cps;

	
	protected $ca_document_cps;

	
	protected $ca_oc_cps;

	
	protected $ca_others_docs_cps;

	
	protected $ca_final_port;

	
	protected $ca_alter_port;

	
	protected $ca_limit_date;

	
	protected $aFalaHeader;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	
	public function applyDefaultValues()
	{
	}

	
	public function getCaIddoc()
	{
		return $this->ca_iddoc;
	}

	
	public function getCaBeginWindow($format = 'Y-m-d')
	{
		if ($this->ca_begin_window === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_begin_window);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_begin_window, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaEndWindow($format = 'Y-m-d')
	{
		if ($this->ca_end_window === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_end_window);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_end_window, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaCommodities()
	{
		return $this->ca_commodities;
	}

	
	public function getCaPartial()
	{
		return $this->ca_partial;
	}

	
	public function getCaPaymentTerms()
	{
		return $this->ca_payment_terms;
	}

	
	public function getCaIncoterms()
	{
		return $this->ca_incoterms;
	}

	
	public function getCaContainerType()
	{
		return $this->ca_container_type;
	}

	
	public function getCaUtv()
	{
		return $this->ca_utv;
	}

	
	public function getCaEtv()
	{
		return $this->ca_etv;
	}

	
	public function getCaLine()
	{
		return $this->ca_line;
	}

	
	public function getCaContactLine()
	{
		return $this->ca_contact_line;
	}

	
	public function getCaContactImporter()
	{
		return $this->ca_contact_importer;
	}

	
	public function getCaUppo()
	{
		return $this->ca_uppo;
	}

	
	public function getCaEb()
	{
		return $this->ca_eb;
	}

	
	public function getCaEdd()
	{
		return $this->ca_edd;
	}

	
	public function getCaPort()
	{
		return $this->ca_port;
	}

	
	public function getCaTransshipment()
	{
		return $this->ca_transshipment;
	}

	
	public function getCaTransshipmentPort()
	{
		return $this->ca_transshipment_port;
	}

	
	public function getCaShippingOrg()
	{
		return $this->ca_shipping_org;
	}

	
	public function getCaOriginalOrg()
	{
		return $this->ca_original_org;
	}

	
	public function getCaFwdCopyOrg()
	{
		return $this->ca_fwd_copy_org;
	}

	
	public function getCaFcrOrg()
	{
		return $this->ca_fcr_org;
	}

	
	public function getCaShippingDst()
	{
		return $this->ca_shipping_dst;
	}

	
	public function getCaOriginalDst()
	{
		return $this->ca_original_dst;
	}

	
	public function getCaFwdCopyDst()
	{
		return $this->ca_fwd_copy_dst;
	}

	
	public function getCaFcrDst()
	{
		return $this->ca_fcr_dst;
	}

	
	public function getCaTransportVia()
	{
		return $this->ca_transport_via;
	}

	
	public function getCaInvoiceOrg()
	{
		return $this->ca_invoice_org;
	}

	
	public function getCaPackingListOrg()
	{
		return $this->ca_packing_list_org;
	}

	
	public function getCaDocumentOrg()
	{
		return $this->ca_document_org;
	}

	
	public function getCaOcOrg()
	{
		return $this->ca_oc_org;
	}

	
	public function getCaOthersDocsOrg()
	{
		return $this->ca_others_docs_org;
	}

	
	public function getCaInvoiceCps()
	{
		return $this->ca_invoice_cps;
	}

	
	public function getCaPackingListCps()
	{
		return $this->ca_packing_list_cps;
	}

	
	public function getCaDocumentCps()
	{
		return $this->ca_document_cps;
	}

	
	public function getCaOcCps()
	{
		return $this->ca_oc_cps;
	}

	
	public function getCaOthersDocsCps()
	{
		return $this->ca_others_docs_cps;
	}

	
	public function getCaFinalPort()
	{
		return $this->ca_final_port;
	}

	
	public function getCaAlterPort()
	{
		return $this->ca_alter_port;
	}

	
	public function getCaLimitDate($format = 'Y-m-d')
	{
		if ($this->ca_limit_date === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_limit_date);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_limit_date, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function setCaIddoc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_iddoc !== $v) {
			$this->ca_iddoc = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_IDDOC;
		}

		if ($this->aFalaHeader !== null && $this->aFalaHeader->getCaIddoc() !== $v) {
			$this->aFalaHeader = null;
		}

		return $this;
	} 
	
	public function setCaBeginWindow($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_begin_window !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_begin_window !== null && $tmpDt = new DateTime($this->ca_begin_window)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_begin_window = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_BEGIN_WINDOW;
			}
		} 
		return $this;
	} 
	
	public function setCaEndWindow($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_end_window !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_end_window !== null && $tmpDt = new DateTime($this->ca_end_window)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_end_window = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_END_WINDOW;
			}
		} 
		return $this;
	} 
	
	public function setCaCommodities($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_commodities !== $v) {
			$this->ca_commodities = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_COMMODITIES;
		}

		return $this;
	} 
	
	public function setCaPartial($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_partial !== $v) {
			$this->ca_partial = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_PARTIAL;
		}

		return $this;
	} 
	
	public function setCaPaymentTerms($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_payment_terms !== $v) {
			$this->ca_payment_terms = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_PAYMENT_TERMS;
		}

		return $this;
	} 
	
	public function setCaIncoterms($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_incoterms !== $v) {
			$this->ca_incoterms = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_INCOTERMS;
		}

		return $this;
	} 
	
	public function setCaContainerType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_container_type !== $v) {
			$this->ca_container_type = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_CONTAINER_TYPE;
		}

		return $this;
	} 
	
	public function setCaUtv($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_utv !== $v) {
			$this->ca_utv = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_UTV;
		}

		return $this;
	} 
	
	public function setCaEtv($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_etv !== $v) {
			$this->ca_etv = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_ETV;
		}

		return $this;
	} 
	
	public function setCaLine($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_line !== $v) {
			$this->ca_line = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_LINE;
		}

		return $this;
	} 
	
	public function setCaContactLine($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_contact_line !== $v) {
			$this->ca_contact_line = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_CONTACT_LINE;
		}

		return $this;
	} 
	
	public function setCaContactImporter($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_contact_importer !== $v) {
			$this->ca_contact_importer = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_CONTACT_IMPORTER;
		}

		return $this;
	} 
	
	public function setCaUppo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_uppo !== $v) {
			$this->ca_uppo = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_UPPO;
		}

		return $this;
	} 
	
	public function setCaEb($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_eb !== $v) {
			$this->ca_eb = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_EB;
		}

		return $this;
	} 
	
	public function setCaEdd($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_edd !== $v) {
			$this->ca_edd = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_EDD;
		}

		return $this;
	} 
	
	public function setCaPort($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_port !== $v) {
			$this->ca_port = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_PORT;
		}

		return $this;
	} 
	
	public function setCaTransshipment($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transshipment !== $v) {
			$this->ca_transshipment = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_TRANSSHIPMENT;
		}

		return $this;
	} 
	
	public function setCaTransshipmentPort($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transshipment_port !== $v) {
			$this->ca_transshipment_port = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_TRANSSHIPMENT_PORT;
		}

		return $this;
	} 
	
	public function setCaShippingOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_shipping_org !== $v) {
			$this->ca_shipping_org = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_SHIPPING_ORG;
		}

		return $this;
	} 
	
	public function setCaOriginalOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_original_org !== $v) {
			$this->ca_original_org = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_ORIGINAL_ORG;
		}

		return $this;
	} 
	
	public function setCaFwdCopyOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fwd_copy_org !== $v) {
			$this->ca_fwd_copy_org = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_FWD_COPY_ORG;
		}

		return $this;
	} 
	
	public function setCaFcrOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fcr_org !== $v) {
			$this->ca_fcr_org = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_FCR_ORG;
		}

		return $this;
	} 
	
	public function setCaShippingDst($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_shipping_dst !== $v) {
			$this->ca_shipping_dst = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_SHIPPING_DST;
		}

		return $this;
	} 
	
	public function setCaOriginalDst($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_original_dst !== $v) {
			$this->ca_original_dst = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_ORIGINAL_DST;
		}

		return $this;
	} 
	
	public function setCaFwdCopyDst($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fwd_copy_dst !== $v) {
			$this->ca_fwd_copy_dst = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_FWD_COPY_DST;
		}

		return $this;
	} 
	
	public function setCaFcrDst($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fcr_dst !== $v) {
			$this->ca_fcr_dst = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_FCR_DST;
		}

		return $this;
	} 
	
	public function setCaTransportVia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transport_via !== $v) {
			$this->ca_transport_via = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_TRANSPORT_VIA;
		}

		return $this;
	} 
	
	public function setCaInvoiceOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_invoice_org !== $v) {
			$this->ca_invoice_org = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_INVOICE_ORG;
		}

		return $this;
	} 
	
	public function setCaPackingListOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_packing_list_org !== $v) {
			$this->ca_packing_list_org = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_PACKING_LIST_ORG;
		}

		return $this;
	} 
	
	public function setCaDocumentOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_document_org !== $v) {
			$this->ca_document_org = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_DOCUMENT_ORG;
		}

		return $this;
	} 
	
	public function setCaOcOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_oc_org !== $v) {
			$this->ca_oc_org = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_OC_ORG;
		}

		return $this;
	} 
	
	public function setCaOthersDocsOrg($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_others_docs_org !== $v) {
			$this->ca_others_docs_org = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_OTHERS_DOCS_ORG;
		}

		return $this;
	} 
	
	public function setCaInvoiceCps($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_invoice_cps !== $v) {
			$this->ca_invoice_cps = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_INVOICE_CPS;
		}

		return $this;
	} 
	
	public function setCaPackingListCps($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_packing_list_cps !== $v) {
			$this->ca_packing_list_cps = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_PACKING_LIST_CPS;
		}

		return $this;
	} 
	
	public function setCaDocumentCps($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_document_cps !== $v) {
			$this->ca_document_cps = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_DOCUMENT_CPS;
		}

		return $this;
	} 
	
	public function setCaOcCps($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_oc_cps !== $v) {
			$this->ca_oc_cps = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_OC_CPS;
		}

		return $this;
	} 
	
	public function setCaOthersDocsCps($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_others_docs_cps !== $v) {
			$this->ca_others_docs_cps = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_OTHERS_DOCS_CPS;
		}

		return $this;
	} 
	
	public function setCaFinalPort($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_final_port !== $v) {
			$this->ca_final_port = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_FINAL_PORT;
		}

		return $this;
	} 
	
	public function setCaAlterPort($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_alter_port !== $v) {
			$this->ca_alter_port = $v;
			$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_ALTER_PORT;
		}

		return $this;
	} 
	
	public function setCaLimitDate($v)
	{
						if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
									try {
				if (is_numeric($v)) { 					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
															$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_limit_date !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_limit_date !== null && $tmpDt = new DateTime($this->ca_limit_date)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_limit_date = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaShipmentInfoPeer::CA_LIMIT_DATE;
			}
		} 
		return $this;
	} 
	
	public function hasOnlyDefaultValues()
	{
						if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

				return true;
	} 
	
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->ca_iddoc = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_begin_window = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_end_window = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_commodities = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_partial = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_payment_terms = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_incoterms = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_container_type = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_utv = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_etv = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_line = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_contact_line = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_contact_importer = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_uppo = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_eb = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_edd = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_port = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_transshipment = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_transshipment_port = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_shipping_org = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_original_org = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_fwd_copy_org = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_fcr_org = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_shipping_dst = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->ca_original_dst = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->ca_fwd_copy_dst = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
			$this->ca_fcr_dst = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
			$this->ca_transport_via = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
			$this->ca_invoice_org = ($row[$startcol + 28] !== null) ? (string) $row[$startcol + 28] : null;
			$this->ca_packing_list_org = ($row[$startcol + 29] !== null) ? (string) $row[$startcol + 29] : null;
			$this->ca_document_org = ($row[$startcol + 30] !== null) ? (string) $row[$startcol + 30] : null;
			$this->ca_oc_org = ($row[$startcol + 31] !== null) ? (string) $row[$startcol + 31] : null;
			$this->ca_others_docs_org = ($row[$startcol + 32] !== null) ? (string) $row[$startcol + 32] : null;
			$this->ca_invoice_cps = ($row[$startcol + 33] !== null) ? (string) $row[$startcol + 33] : null;
			$this->ca_packing_list_cps = ($row[$startcol + 34] !== null) ? (string) $row[$startcol + 34] : null;
			$this->ca_document_cps = ($row[$startcol + 35] !== null) ? (string) $row[$startcol + 35] : null;
			$this->ca_oc_cps = ($row[$startcol + 36] !== null) ? (string) $row[$startcol + 36] : null;
			$this->ca_others_docs_cps = ($row[$startcol + 37] !== null) ? (string) $row[$startcol + 37] : null;
			$this->ca_final_port = ($row[$startcol + 38] !== null) ? (string) $row[$startcol + 38] : null;
			$this->ca_alter_port = ($row[$startcol + 39] !== null) ? (string) $row[$startcol + 39] : null;
			$this->ca_limit_date = ($row[$startcol + 40] !== null) ? (string) $row[$startcol + 40] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 41; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FalaShipmentInfo object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aFalaHeader !== null && $this->ca_iddoc !== $this->aFalaHeader->getCaIddoc()) {
			$this->aFalaHeader = null;
		}
	} 
	
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = FalaShipmentInfoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aFalaHeader = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaShipmentInfo:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			FalaShipmentInfoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFalaShipmentInfo:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaShipmentInfo:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaShipmentInfoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFalaShipmentInfo:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			FalaShipmentInfoPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

												
			if ($this->aFalaHeader !== null) {
				if ($this->aFalaHeader->isModified() || $this->aFalaHeader->isNew()) {
					$affectedRows += $this->aFalaHeader->save($con);
				}
				$this->setFalaHeader($this->aFalaHeader);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FalaShipmentInfoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += FalaShipmentInfoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aFalaHeader !== null) {
				if (!$this->aFalaHeader->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFalaHeader->getValidationFailures());
				}
			}


			if (($retval = FalaShipmentInfoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaShipmentInfoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIddoc();
				break;
			case 1:
				return $this->getCaBeginWindow();
				break;
			case 2:
				return $this->getCaEndWindow();
				break;
			case 3:
				return $this->getCaCommodities();
				break;
			case 4:
				return $this->getCaPartial();
				break;
			case 5:
				return $this->getCaPaymentTerms();
				break;
			case 6:
				return $this->getCaIncoterms();
				break;
			case 7:
				return $this->getCaContainerType();
				break;
			case 8:
				return $this->getCaUtv();
				break;
			case 9:
				return $this->getCaEtv();
				break;
			case 10:
				return $this->getCaLine();
				break;
			case 11:
				return $this->getCaContactLine();
				break;
			case 12:
				return $this->getCaContactImporter();
				break;
			case 13:
				return $this->getCaUppo();
				break;
			case 14:
				return $this->getCaEb();
				break;
			case 15:
				return $this->getCaEdd();
				break;
			case 16:
				return $this->getCaPort();
				break;
			case 17:
				return $this->getCaTransshipment();
				break;
			case 18:
				return $this->getCaTransshipmentPort();
				break;
			case 19:
				return $this->getCaShippingOrg();
				break;
			case 20:
				return $this->getCaOriginalOrg();
				break;
			case 21:
				return $this->getCaFwdCopyOrg();
				break;
			case 22:
				return $this->getCaFcrOrg();
				break;
			case 23:
				return $this->getCaShippingDst();
				break;
			case 24:
				return $this->getCaOriginalDst();
				break;
			case 25:
				return $this->getCaFwdCopyDst();
				break;
			case 26:
				return $this->getCaFcrDst();
				break;
			case 27:
				return $this->getCaTransportVia();
				break;
			case 28:
				return $this->getCaInvoiceOrg();
				break;
			case 29:
				return $this->getCaPackingListOrg();
				break;
			case 30:
				return $this->getCaDocumentOrg();
				break;
			case 31:
				return $this->getCaOcOrg();
				break;
			case 32:
				return $this->getCaOthersDocsOrg();
				break;
			case 33:
				return $this->getCaInvoiceCps();
				break;
			case 34:
				return $this->getCaPackingListCps();
				break;
			case 35:
				return $this->getCaDocumentCps();
				break;
			case 36:
				return $this->getCaOcCps();
				break;
			case 37:
				return $this->getCaOthersDocsCps();
				break;
			case 38:
				return $this->getCaFinalPort();
				break;
			case 39:
				return $this->getCaAlterPort();
				break;
			case 40:
				return $this->getCaLimitDate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = FalaShipmentInfoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIddoc(),
			$keys[1] => $this->getCaBeginWindow(),
			$keys[2] => $this->getCaEndWindow(),
			$keys[3] => $this->getCaCommodities(),
			$keys[4] => $this->getCaPartial(),
			$keys[5] => $this->getCaPaymentTerms(),
			$keys[6] => $this->getCaIncoterms(),
			$keys[7] => $this->getCaContainerType(),
			$keys[8] => $this->getCaUtv(),
			$keys[9] => $this->getCaEtv(),
			$keys[10] => $this->getCaLine(),
			$keys[11] => $this->getCaContactLine(),
			$keys[12] => $this->getCaContactImporter(),
			$keys[13] => $this->getCaUppo(),
			$keys[14] => $this->getCaEb(),
			$keys[15] => $this->getCaEdd(),
			$keys[16] => $this->getCaPort(),
			$keys[17] => $this->getCaTransshipment(),
			$keys[18] => $this->getCaTransshipmentPort(),
			$keys[19] => $this->getCaShippingOrg(),
			$keys[20] => $this->getCaOriginalOrg(),
			$keys[21] => $this->getCaFwdCopyOrg(),
			$keys[22] => $this->getCaFcrOrg(),
			$keys[23] => $this->getCaShippingDst(),
			$keys[24] => $this->getCaOriginalDst(),
			$keys[25] => $this->getCaFwdCopyDst(),
			$keys[26] => $this->getCaFcrDst(),
			$keys[27] => $this->getCaTransportVia(),
			$keys[28] => $this->getCaInvoiceOrg(),
			$keys[29] => $this->getCaPackingListOrg(),
			$keys[30] => $this->getCaDocumentOrg(),
			$keys[31] => $this->getCaOcOrg(),
			$keys[32] => $this->getCaOthersDocsOrg(),
			$keys[33] => $this->getCaInvoiceCps(),
			$keys[34] => $this->getCaPackingListCps(),
			$keys[35] => $this->getCaDocumentCps(),
			$keys[36] => $this->getCaOcCps(),
			$keys[37] => $this->getCaOthersDocsCps(),
			$keys[38] => $this->getCaFinalPort(),
			$keys[39] => $this->getCaAlterPort(),
			$keys[40] => $this->getCaLimitDate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaShipmentInfoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIddoc($value);
				break;
			case 1:
				$this->setCaBeginWindow($value);
				break;
			case 2:
				$this->setCaEndWindow($value);
				break;
			case 3:
				$this->setCaCommodities($value);
				break;
			case 4:
				$this->setCaPartial($value);
				break;
			case 5:
				$this->setCaPaymentTerms($value);
				break;
			case 6:
				$this->setCaIncoterms($value);
				break;
			case 7:
				$this->setCaContainerType($value);
				break;
			case 8:
				$this->setCaUtv($value);
				break;
			case 9:
				$this->setCaEtv($value);
				break;
			case 10:
				$this->setCaLine($value);
				break;
			case 11:
				$this->setCaContactLine($value);
				break;
			case 12:
				$this->setCaContactImporter($value);
				break;
			case 13:
				$this->setCaUppo($value);
				break;
			case 14:
				$this->setCaEb($value);
				break;
			case 15:
				$this->setCaEdd($value);
				break;
			case 16:
				$this->setCaPort($value);
				break;
			case 17:
				$this->setCaTransshipment($value);
				break;
			case 18:
				$this->setCaTransshipmentPort($value);
				break;
			case 19:
				$this->setCaShippingOrg($value);
				break;
			case 20:
				$this->setCaOriginalOrg($value);
				break;
			case 21:
				$this->setCaFwdCopyOrg($value);
				break;
			case 22:
				$this->setCaFcrOrg($value);
				break;
			case 23:
				$this->setCaShippingDst($value);
				break;
			case 24:
				$this->setCaOriginalDst($value);
				break;
			case 25:
				$this->setCaFwdCopyDst($value);
				break;
			case 26:
				$this->setCaFcrDst($value);
				break;
			case 27:
				$this->setCaTransportVia($value);
				break;
			case 28:
				$this->setCaInvoiceOrg($value);
				break;
			case 29:
				$this->setCaPackingListOrg($value);
				break;
			case 30:
				$this->setCaDocumentOrg($value);
				break;
			case 31:
				$this->setCaOcOrg($value);
				break;
			case 32:
				$this->setCaOthersDocsOrg($value);
				break;
			case 33:
				$this->setCaInvoiceCps($value);
				break;
			case 34:
				$this->setCaPackingListCps($value);
				break;
			case 35:
				$this->setCaDocumentCps($value);
				break;
			case 36:
				$this->setCaOcCps($value);
				break;
			case 37:
				$this->setCaOthersDocsCps($value);
				break;
			case 38:
				$this->setCaFinalPort($value);
				break;
			case 39:
				$this->setCaAlterPort($value);
				break;
			case 40:
				$this->setCaLimitDate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FalaShipmentInfoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIddoc($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaBeginWindow($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaEndWindow($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaCommodities($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaPartial($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaPaymentTerms($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIncoterms($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaContainerType($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUtv($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaEtv($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaLine($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaContactLine($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaContactImporter($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaUppo($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaEb($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaEdd($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaPort($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaTransshipment($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaTransshipmentPort($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaShippingOrg($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaOriginalOrg($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaFwdCopyOrg($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaFcrOrg($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaShippingDst($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaOriginalDst($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaFwdCopyDst($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCaFcrDst($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCaTransportVia($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCaInvoiceOrg($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCaPackingListOrg($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCaDocumentOrg($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setCaOcOrg($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setCaOthersDocsOrg($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setCaInvoiceCps($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setCaPackingListCps($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setCaDocumentCps($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setCaOcCps($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setCaOthersDocsCps($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setCaFinalPort($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setCaAlterPort($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setCaLimitDate($arr[$keys[40]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FalaShipmentInfoPeer::DATABASE_NAME);

		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_IDDOC)) $criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $this->ca_iddoc);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_BEGIN_WINDOW)) $criteria->add(FalaShipmentInfoPeer::CA_BEGIN_WINDOW, $this->ca_begin_window);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_END_WINDOW)) $criteria->add(FalaShipmentInfoPeer::CA_END_WINDOW, $this->ca_end_window);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_COMMODITIES)) $criteria->add(FalaShipmentInfoPeer::CA_COMMODITIES, $this->ca_commodities);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_PARTIAL)) $criteria->add(FalaShipmentInfoPeer::CA_PARTIAL, $this->ca_partial);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_PAYMENT_TERMS)) $criteria->add(FalaShipmentInfoPeer::CA_PAYMENT_TERMS, $this->ca_payment_terms);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_INCOTERMS)) $criteria->add(FalaShipmentInfoPeer::CA_INCOTERMS, $this->ca_incoterms);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_CONTAINER_TYPE)) $criteria->add(FalaShipmentInfoPeer::CA_CONTAINER_TYPE, $this->ca_container_type);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_UTV)) $criteria->add(FalaShipmentInfoPeer::CA_UTV, $this->ca_utv);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_ETV)) $criteria->add(FalaShipmentInfoPeer::CA_ETV, $this->ca_etv);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_LINE)) $criteria->add(FalaShipmentInfoPeer::CA_LINE, $this->ca_line);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_CONTACT_LINE)) $criteria->add(FalaShipmentInfoPeer::CA_CONTACT_LINE, $this->ca_contact_line);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_CONTACT_IMPORTER)) $criteria->add(FalaShipmentInfoPeer::CA_CONTACT_IMPORTER, $this->ca_contact_importer);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_UPPO)) $criteria->add(FalaShipmentInfoPeer::CA_UPPO, $this->ca_uppo);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_EB)) $criteria->add(FalaShipmentInfoPeer::CA_EB, $this->ca_eb);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_EDD)) $criteria->add(FalaShipmentInfoPeer::CA_EDD, $this->ca_edd);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_PORT)) $criteria->add(FalaShipmentInfoPeer::CA_PORT, $this->ca_port);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_TRANSSHIPMENT)) $criteria->add(FalaShipmentInfoPeer::CA_TRANSSHIPMENT, $this->ca_transshipment);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_TRANSSHIPMENT_PORT)) $criteria->add(FalaShipmentInfoPeer::CA_TRANSSHIPMENT_PORT, $this->ca_transshipment_port);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_SHIPPING_ORG)) $criteria->add(FalaShipmentInfoPeer::CA_SHIPPING_ORG, $this->ca_shipping_org);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_ORIGINAL_ORG)) $criteria->add(FalaShipmentInfoPeer::CA_ORIGINAL_ORG, $this->ca_original_org);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_FWD_COPY_ORG)) $criteria->add(FalaShipmentInfoPeer::CA_FWD_COPY_ORG, $this->ca_fwd_copy_org);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_FCR_ORG)) $criteria->add(FalaShipmentInfoPeer::CA_FCR_ORG, $this->ca_fcr_org);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_SHIPPING_DST)) $criteria->add(FalaShipmentInfoPeer::CA_SHIPPING_DST, $this->ca_shipping_dst);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_ORIGINAL_DST)) $criteria->add(FalaShipmentInfoPeer::CA_ORIGINAL_DST, $this->ca_original_dst);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_FWD_COPY_DST)) $criteria->add(FalaShipmentInfoPeer::CA_FWD_COPY_DST, $this->ca_fwd_copy_dst);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_FCR_DST)) $criteria->add(FalaShipmentInfoPeer::CA_FCR_DST, $this->ca_fcr_dst);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_TRANSPORT_VIA)) $criteria->add(FalaShipmentInfoPeer::CA_TRANSPORT_VIA, $this->ca_transport_via);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_INVOICE_ORG)) $criteria->add(FalaShipmentInfoPeer::CA_INVOICE_ORG, $this->ca_invoice_org);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_PACKING_LIST_ORG)) $criteria->add(FalaShipmentInfoPeer::CA_PACKING_LIST_ORG, $this->ca_packing_list_org);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_DOCUMENT_ORG)) $criteria->add(FalaShipmentInfoPeer::CA_DOCUMENT_ORG, $this->ca_document_org);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_OC_ORG)) $criteria->add(FalaShipmentInfoPeer::CA_OC_ORG, $this->ca_oc_org);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_OTHERS_DOCS_ORG)) $criteria->add(FalaShipmentInfoPeer::CA_OTHERS_DOCS_ORG, $this->ca_others_docs_org);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_INVOICE_CPS)) $criteria->add(FalaShipmentInfoPeer::CA_INVOICE_CPS, $this->ca_invoice_cps);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_PACKING_LIST_CPS)) $criteria->add(FalaShipmentInfoPeer::CA_PACKING_LIST_CPS, $this->ca_packing_list_cps);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_DOCUMENT_CPS)) $criteria->add(FalaShipmentInfoPeer::CA_DOCUMENT_CPS, $this->ca_document_cps);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_OC_CPS)) $criteria->add(FalaShipmentInfoPeer::CA_OC_CPS, $this->ca_oc_cps);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_OTHERS_DOCS_CPS)) $criteria->add(FalaShipmentInfoPeer::CA_OTHERS_DOCS_CPS, $this->ca_others_docs_cps);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_FINAL_PORT)) $criteria->add(FalaShipmentInfoPeer::CA_FINAL_PORT, $this->ca_final_port);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_ALTER_PORT)) $criteria->add(FalaShipmentInfoPeer::CA_ALTER_PORT, $this->ca_alter_port);
		if ($this->isColumnModified(FalaShipmentInfoPeer::CA_LIMIT_DATE)) $criteria->add(FalaShipmentInfoPeer::CA_LIMIT_DATE, $this->ca_limit_date);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FalaShipmentInfoPeer::DATABASE_NAME);

		$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $this->ca_iddoc);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIddoc();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIddoc($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIddoc($this->ca_iddoc);

		$copyObj->setCaBeginWindow($this->ca_begin_window);

		$copyObj->setCaEndWindow($this->ca_end_window);

		$copyObj->setCaCommodities($this->ca_commodities);

		$copyObj->setCaPartial($this->ca_partial);

		$copyObj->setCaPaymentTerms($this->ca_payment_terms);

		$copyObj->setCaIncoterms($this->ca_incoterms);

		$copyObj->setCaContainerType($this->ca_container_type);

		$copyObj->setCaUtv($this->ca_utv);

		$copyObj->setCaEtv($this->ca_etv);

		$copyObj->setCaLine($this->ca_line);

		$copyObj->setCaContactLine($this->ca_contact_line);

		$copyObj->setCaContactImporter($this->ca_contact_importer);

		$copyObj->setCaUppo($this->ca_uppo);

		$copyObj->setCaEb($this->ca_eb);

		$copyObj->setCaEdd($this->ca_edd);

		$copyObj->setCaPort($this->ca_port);

		$copyObj->setCaTransshipment($this->ca_transshipment);

		$copyObj->setCaTransshipmentPort($this->ca_transshipment_port);

		$copyObj->setCaShippingOrg($this->ca_shipping_org);

		$copyObj->setCaOriginalOrg($this->ca_original_org);

		$copyObj->setCaFwdCopyOrg($this->ca_fwd_copy_org);

		$copyObj->setCaFcrOrg($this->ca_fcr_org);

		$copyObj->setCaShippingDst($this->ca_shipping_dst);

		$copyObj->setCaOriginalDst($this->ca_original_dst);

		$copyObj->setCaFwdCopyDst($this->ca_fwd_copy_dst);

		$copyObj->setCaFcrDst($this->ca_fcr_dst);

		$copyObj->setCaTransportVia($this->ca_transport_via);

		$copyObj->setCaInvoiceOrg($this->ca_invoice_org);

		$copyObj->setCaPackingListOrg($this->ca_packing_list_org);

		$copyObj->setCaDocumentOrg($this->ca_document_org);

		$copyObj->setCaOcOrg($this->ca_oc_org);

		$copyObj->setCaOthersDocsOrg($this->ca_others_docs_org);

		$copyObj->setCaInvoiceCps($this->ca_invoice_cps);

		$copyObj->setCaPackingListCps($this->ca_packing_list_cps);

		$copyObj->setCaDocumentCps($this->ca_document_cps);

		$copyObj->setCaOcCps($this->ca_oc_cps);

		$copyObj->setCaOthersDocsCps($this->ca_others_docs_cps);

		$copyObj->setCaFinalPort($this->ca_final_port);

		$copyObj->setCaAlterPort($this->ca_alter_port);

		$copyObj->setCaLimitDate($this->ca_limit_date);


		$copyObj->setNew(true);

	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FalaShipmentInfoPeer();
		}
		return self::$peer;
	}

	
	public function setFalaHeader(FalaHeader $v = null)
	{
		if ($v === null) {
			$this->setCaIddoc(NULL);
		} else {
			$this->setCaIddoc($v->getCaIddoc());
		}

		$this->aFalaHeader = $v;

				if ($v !== null) {
			$v->setFalaShipmentInfo($this);
		}

		return $this;
	}


	
	public function getFalaHeader(PropelPDO $con = null)
	{
		if ($this->aFalaHeader === null && (($this->ca_iddoc !== "" && $this->ca_iddoc !== null))) {
			$c = new Criteria(FalaHeaderPeer::DATABASE_NAME);
			$c->add(FalaHeaderPeer::CA_IDDOC, $this->ca_iddoc);
			$this->aFalaHeader = FalaHeaderPeer::doSelectOne($c, $con);
						$this->aFalaHeader->setFalaShipmentInfo($this);
		}
		return $this->aFalaHeader;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aFalaHeader = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFalaShipmentInfo:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFalaShipmentInfo::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 