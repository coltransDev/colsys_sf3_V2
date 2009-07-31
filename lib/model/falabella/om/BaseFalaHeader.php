<?php


abstract class BaseFalaHeader extends BaseObject  implements Persistent {


  const PEER = 'FalaHeaderPeer';

	
	protected static $peer;

	
	protected $ca_iddoc;

	
	protected $ca_fecha_carpeta;

	
	protected $ca_archivo_origen;

	
	protected $ca_reporte;

	
	protected $ca_num_viaje;

	
	protected $ca_cod_carrier;

	
	protected $ca_codigo_puerto_pickup;

	
	protected $ca_codigo_puerto_descarga;

	
	protected $ca_container_mode;

	
	protected $ca_nombre_proveedor;

	
	protected $ca_campo_59;

	
	protected $ca_codigo_proveedor;

	
	protected $ca_campo_61;

	
	protected $ca_monto_invoice_miles;

	
	protected $ca_procesado;

	
	protected $ca_trader;

	
	protected $ca_vendor_id;

	
	protected $ca_vendor_name;

	
	protected $ca_vendor_addr1;

	
	protected $ca_vendor_city;

	
	protected $ca_vendor_country;

	
	protected $ca_esd;

	
	protected $ca_lsd;

	
	protected $ca_incoterms;

	
	protected $ca_payment_terms;

	
	protected $ca_proforma_number;

	
	protected $ca_origin;

	
	protected $ca_destination;

	
	protected $ca_trans_ship_port;

	
	protected $ca_reqd_delivery;

	
	protected $ca_orden_comments;

	
	protected $ca_manufacturer_contact;

	
	protected $ca_manufacturer_phone;

	
	protected $ca_manufacturer_fax;

	
	protected $ca_fchanulado;

	
	protected $ca_usuanulado;

	
	protected $collFalaDetails;

	
	private $lastFalaDetailCriteria = null;

	
	protected $collFalaInstructions;

	
	private $lastFalaInstructionCriteria = null;

	
	protected $singleFalaShipmentInfo;

	
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

	
	public function getCaFechaCarpeta($format = 'Y-m-d')
	{
		if ($this->ca_fecha_carpeta === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fecha_carpeta);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fecha_carpeta, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaArchivoOrigen()
	{
		return $this->ca_archivo_origen;
	}

	
	public function getCaReporte()
	{
		return $this->ca_reporte;
	}

	
	public function getCaNumViaje()
	{
		return $this->ca_num_viaje;
	}

	
	public function getCaCodCarrier()
	{
		return $this->ca_cod_carrier;
	}

	
	public function getCaCodigoPuertoPickup()
	{
		return $this->ca_codigo_puerto_pickup;
	}

	
	public function getCaCodigoPuertoDescarga()
	{
		return $this->ca_codigo_puerto_descarga;
	}

	
	public function getCaContainerMode()
	{
		return $this->ca_container_mode;
	}

	
	public function getCaNombreProveedor()
	{
		return $this->ca_nombre_proveedor;
	}

	
	public function getCaCampo59()
	{
		return $this->ca_campo_59;
	}

	
	public function getCaCodigoProveedor()
	{
		return $this->ca_codigo_proveedor;
	}

	
	public function getCaCampo61()
	{
		return $this->ca_campo_61;
	}

	
	public function getCaMontoInvoiceMiles()
	{
		return $this->ca_monto_invoice_miles;
	}

	
	public function getCaProcesado()
	{
		return $this->ca_procesado;
	}

	
	public function getCaTrader()
	{
		return $this->ca_trader;
	}

	
	public function getCaVendorId()
	{
		return $this->ca_vendor_id;
	}

	
	public function getCaVendorName()
	{
		return $this->ca_vendor_name;
	}

	
	public function getCaVendorAddr1()
	{
		return $this->ca_vendor_addr1;
	}

	
	public function getCaVendorCity()
	{
		return $this->ca_vendor_city;
	}

	
	public function getCaVendorCountry()
	{
		return $this->ca_vendor_country;
	}

	
	public function getCaEsd($format = 'Y-m-d')
	{
		if ($this->ca_esd === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_esd);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_esd, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaLsd($format = 'Y-m-d')
	{
		if ($this->ca_lsd === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_lsd);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_lsd, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaIncoterms()
	{
		return $this->ca_incoterms;
	}

	
	public function getCaPaymentTerms()
	{
		return $this->ca_payment_terms;
	}

	
	public function getCaProformaNumber()
	{
		return $this->ca_proforma_number;
	}

	
	public function getCaOrigin()
	{
		return $this->ca_origin;
	}

	
	public function getCaDestination()
	{
		return $this->ca_destination;
	}

	
	public function getCaTransShipPort()
	{
		return $this->ca_trans_ship_port;
	}

	
	public function getCaReqdDelivery($format = 'Y-m-d')
	{
		if ($this->ca_reqd_delivery === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_reqd_delivery);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_reqd_delivery, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaOrdenComments()
	{
		return $this->ca_orden_comments;
	}

	
	public function getCaManufacturerContact()
	{
		return $this->ca_manufacturer_contact;
	}

	
	public function getCaManufacturerPhone()
	{
		return $this->ca_manufacturer_phone;
	}

	
	public function getCaManufacturerFax()
	{
		return $this->ca_manufacturer_fax;
	}

	
	public function getCaFchanulado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchanulado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchanulado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchanulado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuanulado()
	{
		return $this->ca_usuanulado;
	}

	
	public function setCaIddoc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_iddoc !== $v) {
			$this->ca_iddoc = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_IDDOC;
		}

		return $this;
	} 
	
	public function setCaFechaCarpeta($v)
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

		if ( $this->ca_fecha_carpeta !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fecha_carpeta !== null && $tmpDt = new DateTime($this->ca_fecha_carpeta)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fecha_carpeta = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaHeaderPeer::CA_FECHA_CARPETA;
			}
		} 
		return $this;
	} 
	
	public function setCaArchivoOrigen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_archivo_origen !== $v) {
			$this->ca_archivo_origen = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_ARCHIVO_ORIGEN;
		}

		return $this;
	} 
	
	public function setCaReporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_reporte !== $v) {
			$this->ca_reporte = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_REPORTE;
		}

		return $this;
	} 
	
	public function setCaNumViaje($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_num_viaje !== $v) {
			$this->ca_num_viaje = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_NUM_VIAJE;
		}

		return $this;
	} 
	
	public function setCaCodCarrier($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cod_carrier !== $v) {
			$this->ca_cod_carrier = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_COD_CARRIER;
		}

		return $this;
	} 
	
	public function setCaCodigoPuertoPickup($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_codigo_puerto_pickup !== $v) {
			$this->ca_codigo_puerto_pickup = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CODIGO_PUERTO_PICKUP;
		}

		return $this;
	} 
	
	public function setCaCodigoPuertoDescarga($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_codigo_puerto_descarga !== $v) {
			$this->ca_codigo_puerto_descarga = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CODIGO_PUERTO_DESCARGA;
		}

		return $this;
	} 
	
	public function setCaContainerMode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_container_mode !== $v) {
			$this->ca_container_mode = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CONTAINER_MODE;
		}

		return $this;
	} 
	
	public function setCaNombreProveedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre_proveedor !== $v) {
			$this->ca_nombre_proveedor = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_NOMBRE_PROVEEDOR;
		}

		return $this;
	} 
	
	public function setCaCampo59($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_campo_59 !== $v) {
			$this->ca_campo_59 = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CAMPO_59;
		}

		return $this;
	} 
	
	public function setCaCodigoProveedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_codigo_proveedor !== $v) {
			$this->ca_codigo_proveedor = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CODIGO_PROVEEDOR;
		}

		return $this;
	} 
	
	public function setCaCampo61($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_campo_61 !== $v) {
			$this->ca_campo_61 = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CAMPO_61;
		}

		return $this;
	} 
	
	public function setCaMontoInvoiceMiles($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_monto_invoice_miles !== $v) {
			$this->ca_monto_invoice_miles = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_MONTO_INVOICE_MILES;
		}

		return $this;
	} 
	
	public function setCaProcesado($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_procesado !== $v) {
			$this->ca_procesado = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_PROCESADO;
		}

		return $this;
	} 
	
	public function setCaTrader($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_trader !== $v) {
			$this->ca_trader = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_TRADER;
		}

		return $this;
	} 
	
	public function setCaVendorId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vendor_id !== $v) {
			$this->ca_vendor_id = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_VENDOR_ID;
		}

		return $this;
	} 
	
	public function setCaVendorName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vendor_name !== $v) {
			$this->ca_vendor_name = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_VENDOR_NAME;
		}

		return $this;
	} 
	
	public function setCaVendorAddr1($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vendor_addr1 !== $v) {
			$this->ca_vendor_addr1 = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_VENDOR_ADDR1;
		}

		return $this;
	} 
	
	public function setCaVendorCity($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vendor_city !== $v) {
			$this->ca_vendor_city = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_VENDOR_CITY;
		}

		return $this;
	} 
	
	public function setCaVendorCountry($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vendor_country !== $v) {
			$this->ca_vendor_country = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_VENDOR_COUNTRY;
		}

		return $this;
	} 
	
	public function setCaEsd($v)
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

		if ( $this->ca_esd !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_esd !== null && $tmpDt = new DateTime($this->ca_esd)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_esd = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaHeaderPeer::CA_ESD;
			}
		} 
		return $this;
	} 
	
	public function setCaLsd($v)
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

		if ( $this->ca_lsd !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_lsd !== null && $tmpDt = new DateTime($this->ca_lsd)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_lsd = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaHeaderPeer::CA_LSD;
			}
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
			$this->modifiedColumns[] = FalaHeaderPeer::CA_INCOTERMS;
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
			$this->modifiedColumns[] = FalaHeaderPeer::CA_PAYMENT_TERMS;
		}

		return $this;
	} 
	
	public function setCaProformaNumber($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_proforma_number !== $v) {
			$this->ca_proforma_number = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_PROFORMA_NUMBER;
		}

		return $this;
	} 
	
	public function setCaOrigin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_origin !== $v) {
			$this->ca_origin = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_ORIGIN;
		}

		return $this;
	} 
	
	public function setCaDestination($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_destination !== $v) {
			$this->ca_destination = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_DESTINATION;
		}

		return $this;
	} 
	
	public function setCaTransShipPort($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_trans_ship_port !== $v) {
			$this->ca_trans_ship_port = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_TRANS_SHIP_PORT;
		}

		return $this;
	} 
	
	public function setCaReqdDelivery($v)
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

		if ( $this->ca_reqd_delivery !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_reqd_delivery !== null && $tmpDt = new DateTime($this->ca_reqd_delivery)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_reqd_delivery = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaHeaderPeer::CA_REQD_DELIVERY;
			}
		} 
		return $this;
	} 
	
	public function setCaOrdenComments($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_orden_comments !== $v) {
			$this->ca_orden_comments = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_ORDEN_COMMENTS;
		}

		return $this;
	} 
	
	public function setCaManufacturerContact($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_manufacturer_contact !== $v) {
			$this->ca_manufacturer_contact = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_MANUFACTURER_CONTACT;
		}

		return $this;
	} 
	
	public function setCaManufacturerPhone($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_manufacturer_phone !== $v) {
			$this->ca_manufacturer_phone = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_MANUFACTURER_PHONE;
		}

		return $this;
	} 
	
	public function setCaManufacturerFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_manufacturer_fax !== $v) {
			$this->ca_manufacturer_fax = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_MANUFACTURER_FAX;
		}

		return $this;
	} 
	
	public function setCaFchanulado($v)
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

		if ( $this->ca_fchanulado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchanulado !== null && $tmpDt = new DateTime($this->ca_fchanulado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchanulado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = FalaHeaderPeer::CA_FCHANULADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuanulado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuanulado !== $v) {
			$this->ca_usuanulado = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_USUANULADO;
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
			$this->ca_fecha_carpeta = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_archivo_origen = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_reporte = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_num_viaje = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_cod_carrier = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_codigo_puerto_pickup = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_codigo_puerto_descarga = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_container_mode = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_nombre_proveedor = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_campo_59 = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_codigo_proveedor = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_campo_61 = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_monto_invoice_miles = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_procesado = ($row[$startcol + 14] !== null) ? (boolean) $row[$startcol + 14] : null;
			$this->ca_trader = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_vendor_id = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_vendor_name = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_vendor_addr1 = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_vendor_city = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_vendor_country = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_esd = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_lsd = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_incoterms = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->ca_payment_terms = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->ca_proforma_number = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
			$this->ca_origin = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
			$this->ca_destination = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
			$this->ca_trans_ship_port = ($row[$startcol + 28] !== null) ? (string) $row[$startcol + 28] : null;
			$this->ca_reqd_delivery = ($row[$startcol + 29] !== null) ? (string) $row[$startcol + 29] : null;
			$this->ca_orden_comments = ($row[$startcol + 30] !== null) ? (string) $row[$startcol + 30] : null;
			$this->ca_manufacturer_contact = ($row[$startcol + 31] !== null) ? (string) $row[$startcol + 31] : null;
			$this->ca_manufacturer_phone = ($row[$startcol + 32] !== null) ? (string) $row[$startcol + 32] : null;
			$this->ca_manufacturer_fax = ($row[$startcol + 33] !== null) ? (string) $row[$startcol + 33] : null;
			$this->ca_fchanulado = ($row[$startcol + 34] !== null) ? (string) $row[$startcol + 34] : null;
			$this->ca_usuanulado = ($row[$startcol + 35] !== null) ? (string) $row[$startcol + 35] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 36; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FalaHeader object", $e);
		}
	}

	
	public function ensureConsistency()
	{

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
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = FalaHeaderPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collFalaDetails = null;
			$this->lastFalaDetailCriteria = null;

			$this->collFalaInstructions = null;
			$this->lastFalaInstructionCriteria = null;

			$this->singleFalaShipmentInfo = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaHeader:delete:pre') as $callable)
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
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			FalaHeaderPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFalaHeader:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFalaHeader:save:pre') as $callable)
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
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFalaHeader:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			FalaHeaderPeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FalaHeaderPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += FalaHeaderPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collFalaDetails !== null) {
				foreach ($this->collFalaDetails as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFalaInstructions !== null) {
				foreach ($this->collFalaInstructions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->singleFalaShipmentInfo !== null) {
				if (!$this->singleFalaShipmentInfo->isDeleted()) {
						$affectedRows += $this->singleFalaShipmentInfo->save($con);
				}
			}

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


			if (($retval = FalaHeaderPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFalaDetails !== null) {
					foreach ($this->collFalaDetails as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFalaInstructions !== null) {
					foreach ($this->collFalaInstructions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->singleFalaShipmentInfo !== null) {
					if (!$this->singleFalaShipmentInfo->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleFalaShipmentInfo->getValidationFailures());
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaFechaCarpeta();
				break;
			case 2:
				return $this->getCaArchivoOrigen();
				break;
			case 3:
				return $this->getCaReporte();
				break;
			case 4:
				return $this->getCaNumViaje();
				break;
			case 5:
				return $this->getCaCodCarrier();
				break;
			case 6:
				return $this->getCaCodigoPuertoPickup();
				break;
			case 7:
				return $this->getCaCodigoPuertoDescarga();
				break;
			case 8:
				return $this->getCaContainerMode();
				break;
			case 9:
				return $this->getCaNombreProveedor();
				break;
			case 10:
				return $this->getCaCampo59();
				break;
			case 11:
				return $this->getCaCodigoProveedor();
				break;
			case 12:
				return $this->getCaCampo61();
				break;
			case 13:
				return $this->getCaMontoInvoiceMiles();
				break;
			case 14:
				return $this->getCaProcesado();
				break;
			case 15:
				return $this->getCaTrader();
				break;
			case 16:
				return $this->getCaVendorId();
				break;
			case 17:
				return $this->getCaVendorName();
				break;
			case 18:
				return $this->getCaVendorAddr1();
				break;
			case 19:
				return $this->getCaVendorCity();
				break;
			case 20:
				return $this->getCaVendorCountry();
				break;
			case 21:
				return $this->getCaEsd();
				break;
			case 22:
				return $this->getCaLsd();
				break;
			case 23:
				return $this->getCaIncoterms();
				break;
			case 24:
				return $this->getCaPaymentTerms();
				break;
			case 25:
				return $this->getCaProformaNumber();
				break;
			case 26:
				return $this->getCaOrigin();
				break;
			case 27:
				return $this->getCaDestination();
				break;
			case 28:
				return $this->getCaTransShipPort();
				break;
			case 29:
				return $this->getCaReqdDelivery();
				break;
			case 30:
				return $this->getCaOrdenComments();
				break;
			case 31:
				return $this->getCaManufacturerContact();
				break;
			case 32:
				return $this->getCaManufacturerPhone();
				break;
			case 33:
				return $this->getCaManufacturerFax();
				break;
			case 34:
				return $this->getCaFchanulado();
				break;
			case 35:
				return $this->getCaUsuanulado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = FalaHeaderPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIddoc(),
			$keys[1] => $this->getCaFechaCarpeta(),
			$keys[2] => $this->getCaArchivoOrigen(),
			$keys[3] => $this->getCaReporte(),
			$keys[4] => $this->getCaNumViaje(),
			$keys[5] => $this->getCaCodCarrier(),
			$keys[6] => $this->getCaCodigoPuertoPickup(),
			$keys[7] => $this->getCaCodigoPuertoDescarga(),
			$keys[8] => $this->getCaContainerMode(),
			$keys[9] => $this->getCaNombreProveedor(),
			$keys[10] => $this->getCaCampo59(),
			$keys[11] => $this->getCaCodigoProveedor(),
			$keys[12] => $this->getCaCampo61(),
			$keys[13] => $this->getCaMontoInvoiceMiles(),
			$keys[14] => $this->getCaProcesado(),
			$keys[15] => $this->getCaTrader(),
			$keys[16] => $this->getCaVendorId(),
			$keys[17] => $this->getCaVendorName(),
			$keys[18] => $this->getCaVendorAddr1(),
			$keys[19] => $this->getCaVendorCity(),
			$keys[20] => $this->getCaVendorCountry(),
			$keys[21] => $this->getCaEsd(),
			$keys[22] => $this->getCaLsd(),
			$keys[23] => $this->getCaIncoterms(),
			$keys[24] => $this->getCaPaymentTerms(),
			$keys[25] => $this->getCaProformaNumber(),
			$keys[26] => $this->getCaOrigin(),
			$keys[27] => $this->getCaDestination(),
			$keys[28] => $this->getCaTransShipPort(),
			$keys[29] => $this->getCaReqdDelivery(),
			$keys[30] => $this->getCaOrdenComments(),
			$keys[31] => $this->getCaManufacturerContact(),
			$keys[32] => $this->getCaManufacturerPhone(),
			$keys[33] => $this->getCaManufacturerFax(),
			$keys[34] => $this->getCaFchanulado(),
			$keys[35] => $this->getCaUsuanulado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIddoc($value);
				break;
			case 1:
				$this->setCaFechaCarpeta($value);
				break;
			case 2:
				$this->setCaArchivoOrigen($value);
				break;
			case 3:
				$this->setCaReporte($value);
				break;
			case 4:
				$this->setCaNumViaje($value);
				break;
			case 5:
				$this->setCaCodCarrier($value);
				break;
			case 6:
				$this->setCaCodigoPuertoPickup($value);
				break;
			case 7:
				$this->setCaCodigoPuertoDescarga($value);
				break;
			case 8:
				$this->setCaContainerMode($value);
				break;
			case 9:
				$this->setCaNombreProveedor($value);
				break;
			case 10:
				$this->setCaCampo59($value);
				break;
			case 11:
				$this->setCaCodigoProveedor($value);
				break;
			case 12:
				$this->setCaCampo61($value);
				break;
			case 13:
				$this->setCaMontoInvoiceMiles($value);
				break;
			case 14:
				$this->setCaProcesado($value);
				break;
			case 15:
				$this->setCaTrader($value);
				break;
			case 16:
				$this->setCaVendorId($value);
				break;
			case 17:
				$this->setCaVendorName($value);
				break;
			case 18:
				$this->setCaVendorAddr1($value);
				break;
			case 19:
				$this->setCaVendorCity($value);
				break;
			case 20:
				$this->setCaVendorCountry($value);
				break;
			case 21:
				$this->setCaEsd($value);
				break;
			case 22:
				$this->setCaLsd($value);
				break;
			case 23:
				$this->setCaIncoterms($value);
				break;
			case 24:
				$this->setCaPaymentTerms($value);
				break;
			case 25:
				$this->setCaProformaNumber($value);
				break;
			case 26:
				$this->setCaOrigin($value);
				break;
			case 27:
				$this->setCaDestination($value);
				break;
			case 28:
				$this->setCaTransShipPort($value);
				break;
			case 29:
				$this->setCaReqdDelivery($value);
				break;
			case 30:
				$this->setCaOrdenComments($value);
				break;
			case 31:
				$this->setCaManufacturerContact($value);
				break;
			case 32:
				$this->setCaManufacturerPhone($value);
				break;
			case 33:
				$this->setCaManufacturerFax($value);
				break;
			case 34:
				$this->setCaFchanulado($value);
				break;
			case 35:
				$this->setCaUsuanulado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FalaHeaderPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIddoc($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFechaCarpeta($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaArchivoOrigen($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaReporte($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaNumViaje($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaCodCarrier($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaCodigoPuertoPickup($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaCodigoPuertoDescarga($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaContainerMode($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaNombreProveedor($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaCampo59($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaCodigoProveedor($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaCampo61($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaMontoInvoiceMiles($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaProcesado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaTrader($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaVendorId($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaVendorName($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaVendorAddr1($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaVendorCity($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaVendorCountry($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaEsd($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaLsd($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaIncoterms($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaPaymentTerms($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaProformaNumber($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCaOrigin($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCaDestination($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCaTransShipPort($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCaReqdDelivery($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCaOrdenComments($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setCaManufacturerContact($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setCaManufacturerPhone($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setCaManufacturerFax($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setCaFchanulado($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setCaUsuanulado($arr[$keys[35]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FalaHeaderPeer::DATABASE_NAME);

		if ($this->isColumnModified(FalaHeaderPeer::CA_IDDOC)) $criteria->add(FalaHeaderPeer::CA_IDDOC, $this->ca_iddoc);
		if ($this->isColumnModified(FalaHeaderPeer::CA_FECHA_CARPETA)) $criteria->add(FalaHeaderPeer::CA_FECHA_CARPETA, $this->ca_fecha_carpeta);
		if ($this->isColumnModified(FalaHeaderPeer::CA_ARCHIVO_ORIGEN)) $criteria->add(FalaHeaderPeer::CA_ARCHIVO_ORIGEN, $this->ca_archivo_origen);
		if ($this->isColumnModified(FalaHeaderPeer::CA_REPORTE)) $criteria->add(FalaHeaderPeer::CA_REPORTE, $this->ca_reporte);
		if ($this->isColumnModified(FalaHeaderPeer::CA_NUM_VIAJE)) $criteria->add(FalaHeaderPeer::CA_NUM_VIAJE, $this->ca_num_viaje);
		if ($this->isColumnModified(FalaHeaderPeer::CA_COD_CARRIER)) $criteria->add(FalaHeaderPeer::CA_COD_CARRIER, $this->ca_cod_carrier);
		if ($this->isColumnModified(FalaHeaderPeer::CA_CODIGO_PUERTO_PICKUP)) $criteria->add(FalaHeaderPeer::CA_CODIGO_PUERTO_PICKUP, $this->ca_codigo_puerto_pickup);
		if ($this->isColumnModified(FalaHeaderPeer::CA_CODIGO_PUERTO_DESCARGA)) $criteria->add(FalaHeaderPeer::CA_CODIGO_PUERTO_DESCARGA, $this->ca_codigo_puerto_descarga);
		if ($this->isColumnModified(FalaHeaderPeer::CA_CONTAINER_MODE)) $criteria->add(FalaHeaderPeer::CA_CONTAINER_MODE, $this->ca_container_mode);
		if ($this->isColumnModified(FalaHeaderPeer::CA_NOMBRE_PROVEEDOR)) $criteria->add(FalaHeaderPeer::CA_NOMBRE_PROVEEDOR, $this->ca_nombre_proveedor);
		if ($this->isColumnModified(FalaHeaderPeer::CA_CAMPO_59)) $criteria->add(FalaHeaderPeer::CA_CAMPO_59, $this->ca_campo_59);
		if ($this->isColumnModified(FalaHeaderPeer::CA_CODIGO_PROVEEDOR)) $criteria->add(FalaHeaderPeer::CA_CODIGO_PROVEEDOR, $this->ca_codigo_proveedor);
		if ($this->isColumnModified(FalaHeaderPeer::CA_CAMPO_61)) $criteria->add(FalaHeaderPeer::CA_CAMPO_61, $this->ca_campo_61);
		if ($this->isColumnModified(FalaHeaderPeer::CA_MONTO_INVOICE_MILES)) $criteria->add(FalaHeaderPeer::CA_MONTO_INVOICE_MILES, $this->ca_monto_invoice_miles);
		if ($this->isColumnModified(FalaHeaderPeer::CA_PROCESADO)) $criteria->add(FalaHeaderPeer::CA_PROCESADO, $this->ca_procesado);
		if ($this->isColumnModified(FalaHeaderPeer::CA_TRADER)) $criteria->add(FalaHeaderPeer::CA_TRADER, $this->ca_trader);
		if ($this->isColumnModified(FalaHeaderPeer::CA_VENDOR_ID)) $criteria->add(FalaHeaderPeer::CA_VENDOR_ID, $this->ca_vendor_id);
		if ($this->isColumnModified(FalaHeaderPeer::CA_VENDOR_NAME)) $criteria->add(FalaHeaderPeer::CA_VENDOR_NAME, $this->ca_vendor_name);
		if ($this->isColumnModified(FalaHeaderPeer::CA_VENDOR_ADDR1)) $criteria->add(FalaHeaderPeer::CA_VENDOR_ADDR1, $this->ca_vendor_addr1);
		if ($this->isColumnModified(FalaHeaderPeer::CA_VENDOR_CITY)) $criteria->add(FalaHeaderPeer::CA_VENDOR_CITY, $this->ca_vendor_city);
		if ($this->isColumnModified(FalaHeaderPeer::CA_VENDOR_COUNTRY)) $criteria->add(FalaHeaderPeer::CA_VENDOR_COUNTRY, $this->ca_vendor_country);
		if ($this->isColumnModified(FalaHeaderPeer::CA_ESD)) $criteria->add(FalaHeaderPeer::CA_ESD, $this->ca_esd);
		if ($this->isColumnModified(FalaHeaderPeer::CA_LSD)) $criteria->add(FalaHeaderPeer::CA_LSD, $this->ca_lsd);
		if ($this->isColumnModified(FalaHeaderPeer::CA_INCOTERMS)) $criteria->add(FalaHeaderPeer::CA_INCOTERMS, $this->ca_incoterms);
		if ($this->isColumnModified(FalaHeaderPeer::CA_PAYMENT_TERMS)) $criteria->add(FalaHeaderPeer::CA_PAYMENT_TERMS, $this->ca_payment_terms);
		if ($this->isColumnModified(FalaHeaderPeer::CA_PROFORMA_NUMBER)) $criteria->add(FalaHeaderPeer::CA_PROFORMA_NUMBER, $this->ca_proforma_number);
		if ($this->isColumnModified(FalaHeaderPeer::CA_ORIGIN)) $criteria->add(FalaHeaderPeer::CA_ORIGIN, $this->ca_origin);
		if ($this->isColumnModified(FalaHeaderPeer::CA_DESTINATION)) $criteria->add(FalaHeaderPeer::CA_DESTINATION, $this->ca_destination);
		if ($this->isColumnModified(FalaHeaderPeer::CA_TRANS_SHIP_PORT)) $criteria->add(FalaHeaderPeer::CA_TRANS_SHIP_PORT, $this->ca_trans_ship_port);
		if ($this->isColumnModified(FalaHeaderPeer::CA_REQD_DELIVERY)) $criteria->add(FalaHeaderPeer::CA_REQD_DELIVERY, $this->ca_reqd_delivery);
		if ($this->isColumnModified(FalaHeaderPeer::CA_ORDEN_COMMENTS)) $criteria->add(FalaHeaderPeer::CA_ORDEN_COMMENTS, $this->ca_orden_comments);
		if ($this->isColumnModified(FalaHeaderPeer::CA_MANUFACTURER_CONTACT)) $criteria->add(FalaHeaderPeer::CA_MANUFACTURER_CONTACT, $this->ca_manufacturer_contact);
		if ($this->isColumnModified(FalaHeaderPeer::CA_MANUFACTURER_PHONE)) $criteria->add(FalaHeaderPeer::CA_MANUFACTURER_PHONE, $this->ca_manufacturer_phone);
		if ($this->isColumnModified(FalaHeaderPeer::CA_MANUFACTURER_FAX)) $criteria->add(FalaHeaderPeer::CA_MANUFACTURER_FAX, $this->ca_manufacturer_fax);
		if ($this->isColumnModified(FalaHeaderPeer::CA_FCHANULADO)) $criteria->add(FalaHeaderPeer::CA_FCHANULADO, $this->ca_fchanulado);
		if ($this->isColumnModified(FalaHeaderPeer::CA_USUANULADO)) $criteria->add(FalaHeaderPeer::CA_USUANULADO, $this->ca_usuanulado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FalaHeaderPeer::DATABASE_NAME);

		$criteria->add(FalaHeaderPeer::CA_IDDOC, $this->ca_iddoc);

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

		$copyObj->setCaFechaCarpeta($this->ca_fecha_carpeta);

		$copyObj->setCaArchivoOrigen($this->ca_archivo_origen);

		$copyObj->setCaReporte($this->ca_reporte);

		$copyObj->setCaNumViaje($this->ca_num_viaje);

		$copyObj->setCaCodCarrier($this->ca_cod_carrier);

		$copyObj->setCaCodigoPuertoPickup($this->ca_codigo_puerto_pickup);

		$copyObj->setCaCodigoPuertoDescarga($this->ca_codigo_puerto_descarga);

		$copyObj->setCaContainerMode($this->ca_container_mode);

		$copyObj->setCaNombreProveedor($this->ca_nombre_proveedor);

		$copyObj->setCaCampo59($this->ca_campo_59);

		$copyObj->setCaCodigoProveedor($this->ca_codigo_proveedor);

		$copyObj->setCaCampo61($this->ca_campo_61);

		$copyObj->setCaMontoInvoiceMiles($this->ca_monto_invoice_miles);

		$copyObj->setCaProcesado($this->ca_procesado);

		$copyObj->setCaTrader($this->ca_trader);

		$copyObj->setCaVendorId($this->ca_vendor_id);

		$copyObj->setCaVendorName($this->ca_vendor_name);

		$copyObj->setCaVendorAddr1($this->ca_vendor_addr1);

		$copyObj->setCaVendorCity($this->ca_vendor_city);

		$copyObj->setCaVendorCountry($this->ca_vendor_country);

		$copyObj->setCaEsd($this->ca_esd);

		$copyObj->setCaLsd($this->ca_lsd);

		$copyObj->setCaIncoterms($this->ca_incoterms);

		$copyObj->setCaPaymentTerms($this->ca_payment_terms);

		$copyObj->setCaProformaNumber($this->ca_proforma_number);

		$copyObj->setCaOrigin($this->ca_origin);

		$copyObj->setCaDestination($this->ca_destination);

		$copyObj->setCaTransShipPort($this->ca_trans_ship_port);

		$copyObj->setCaReqdDelivery($this->ca_reqd_delivery);

		$copyObj->setCaOrdenComments($this->ca_orden_comments);

		$copyObj->setCaManufacturerContact($this->ca_manufacturer_contact);

		$copyObj->setCaManufacturerPhone($this->ca_manufacturer_phone);

		$copyObj->setCaManufacturerFax($this->ca_manufacturer_fax);

		$copyObj->setCaFchanulado($this->ca_fchanulado);

		$copyObj->setCaUsuanulado($this->ca_usuanulado);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getFalaDetails() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addFalaDetail($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFalaInstructions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addFalaInstruction($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getFalaShipmentInfo();
			if ($relObj) {
				$copyObj->setFalaShipmentInfo($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new FalaHeaderPeer();
		}
		return self::$peer;
	}

	
	public function clearFalaDetails()
	{
		$this->collFalaDetails = null; 	}

	
	public function initFalaDetails()
	{
		$this->collFalaDetails = array();
	}

	
	public function getFalaDetails($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FalaHeaderPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFalaDetails === null) {
			if ($this->isNew()) {
			   $this->collFalaDetails = array();
			} else {

				$criteria->add(FalaDetailPeer::CA_IDDOC, $this->ca_iddoc);

				FalaDetailPeer::addSelectColumns($criteria);
				$this->collFalaDetails = FalaDetailPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FalaDetailPeer::CA_IDDOC, $this->ca_iddoc);

				FalaDetailPeer::addSelectColumns($criteria);
				if (!isset($this->lastFalaDetailCriteria) || !$this->lastFalaDetailCriteria->equals($criteria)) {
					$this->collFalaDetails = FalaDetailPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFalaDetailCriteria = $criteria;
		return $this->collFalaDetails;
	}

	
	public function countFalaDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FalaHeaderPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFalaDetails === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FalaDetailPeer::CA_IDDOC, $this->ca_iddoc);

				$count = FalaDetailPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FalaDetailPeer::CA_IDDOC, $this->ca_iddoc);

				if (!isset($this->lastFalaDetailCriteria) || !$this->lastFalaDetailCriteria->equals($criteria)) {
					$count = FalaDetailPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collFalaDetails);
				}
			} else {
				$count = count($this->collFalaDetails);
			}
		}
		return $count;
	}

	
	public function addFalaDetail(FalaDetail $l)
	{
		if ($this->collFalaDetails === null) {
			$this->initFalaDetails();
		}
		if (!in_array($l, $this->collFalaDetails, true)) { 			array_push($this->collFalaDetails, $l);
			$l->setFalaHeader($this);
		}
	}

	
	public function clearFalaInstructions()
	{
		$this->collFalaInstructions = null; 	}

	
	public function initFalaInstructions()
	{
		$this->collFalaInstructions = array();
	}

	
	public function getFalaInstructions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FalaHeaderPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFalaInstructions === null) {
			if ($this->isNew()) {
			   $this->collFalaInstructions = array();
			} else {

				$criteria->add(FalaInstructionPeer::CA_IDDOC, $this->ca_iddoc);

				FalaInstructionPeer::addSelectColumns($criteria);
				$this->collFalaInstructions = FalaInstructionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FalaInstructionPeer::CA_IDDOC, $this->ca_iddoc);

				FalaInstructionPeer::addSelectColumns($criteria);
				if (!isset($this->lastFalaInstructionCriteria) || !$this->lastFalaInstructionCriteria->equals($criteria)) {
					$this->collFalaInstructions = FalaInstructionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFalaInstructionCriteria = $criteria;
		return $this->collFalaInstructions;
	}

	
	public function countFalaInstructions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(FalaHeaderPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collFalaInstructions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(FalaInstructionPeer::CA_IDDOC, $this->ca_iddoc);

				$count = FalaInstructionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FalaInstructionPeer::CA_IDDOC, $this->ca_iddoc);

				if (!isset($this->lastFalaInstructionCriteria) || !$this->lastFalaInstructionCriteria->equals($criteria)) {
					$count = FalaInstructionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collFalaInstructions);
				}
			} else {
				$count = count($this->collFalaInstructions);
			}
		}
		return $count;
	}

	
	public function addFalaInstruction(FalaInstruction $l)
	{
		if ($this->collFalaInstructions === null) {
			$this->initFalaInstructions();
		}
		if (!in_array($l, $this->collFalaInstructions, true)) { 			array_push($this->collFalaInstructions, $l);
			$l->setFalaHeader($this);
		}
	}

	
	public function getFalaShipmentInfo(PropelPDO $con = null)
	{

		if ($this->singleFalaShipmentInfo === null && !$this->isNew()) {
			$this->singleFalaShipmentInfo = FalaShipmentInfoPeer::retrieveByPK($this->ca_iddoc, $con);
		}

		return $this->singleFalaShipmentInfo;
	}

	
	public function setFalaShipmentInfo(FalaShipmentInfo $v)
	{
		$this->singleFalaShipmentInfo = $v;

				if ($v->getFalaHeader() === null) {
			$v->setFalaHeader($this);
		}

		return $this;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collFalaDetails) {
				foreach ((array) $this->collFalaDetails as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFalaInstructions) {
				foreach ((array) $this->collFalaInstructions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->singleFalaShipmentInfo) {
				$this->singleFalaShipmentInfo->clearAllReferences($deep);
			}
		} 
		$this->collFalaDetails = null;
		$this->collFalaInstructions = null;
		$this->singleFalaShipmentInfo = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFalaHeader:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFalaHeader::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 