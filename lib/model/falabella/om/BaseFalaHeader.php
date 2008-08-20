<?php

/**
 * Base class that represents a row from the 'tb_falaheader' table.
 *
 * 
 *
 * @package    lib.model.falabella.om
 */
abstract class BaseFalaHeader extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FalaHeaderPeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_iddoc field.
	 * @var        string
	 */
	protected $ca_iddoc;


	/**
	 * The value for the ca_fecha_carpeta field.
	 * @var        int
	 */
	protected $ca_fecha_carpeta;


	/**
	 * The value for the ca_archivo_origen field.
	 * @var        string
	 */
	protected $ca_archivo_origen;


	/**
	 * The value for the ca_reporte field.
	 * @var        string
	 */
	protected $ca_reporte;


	/**
	 * The value for the ca_num_viaje field.
	 * @var        string
	 */
	protected $ca_num_viaje;


	/**
	 * The value for the ca_cod_carrier field.
	 * @var        string
	 */
	protected $ca_cod_carrier;


	/**
	 * The value for the ca_codigo_puerto_pickup field.
	 * @var        string
	 */
	protected $ca_codigo_puerto_pickup;


	/**
	 * The value for the ca_codigo_puerto_descarga field.
	 * @var        string
	 */
	protected $ca_codigo_puerto_descarga;


	/**
	 * The value for the ca_container_mode field.
	 * @var        string
	 */
	protected $ca_container_mode;


	/**
	 * The value for the ca_nombre_proveedor field.
	 * @var        string
	 */
	protected $ca_nombre_proveedor;


	/**
	 * The value for the ca_campo_59 field.
	 * @var        string
	 */
	protected $ca_campo_59;


	/**
	 * The value for the ca_codigo_proveedor field.
	 * @var        string
	 */
	protected $ca_codigo_proveedor;


	/**
	 * The value for the ca_campo_61 field.
	 * @var        string
	 */
	protected $ca_campo_61;


	/**
	 * The value for the ca_monto_invoice_miles field.
	 * @var        double
	 */
	protected $ca_monto_invoice_miles;


	/**
	 * The value for the ca_procesado field.
	 * @var        boolean
	 */
	protected $ca_procesado;


	/**
	 * The value for the ca_trader field.
	 * @var        string
	 */
	protected $ca_trader;


	/**
	 * The value for the ca_vendor_id field.
	 * @var        string
	 */
	protected $ca_vendor_id;


	/**
	 * The value for the ca_vendor_name field.
	 * @var        string
	 */
	protected $ca_vendor_name;


	/**
	 * The value for the ca_vendor_addr1 field.
	 * @var        string
	 */
	protected $ca_vendor_addr1;


	/**
	 * The value for the ca_vendor_city field.
	 * @var        string
	 */
	protected $ca_vendor_city;


	/**
	 * The value for the ca_vendor_country field.
	 * @var        string
	 */
	protected $ca_vendor_country;


	/**
	 * The value for the ca_esd field.
	 * @var        int
	 */
	protected $ca_esd;


	/**
	 * The value for the ca_lsd field.
	 * @var        int
	 */
	protected $ca_lsd;


	/**
	 * The value for the ca_incoterms field.
	 * @var        string
	 */
	protected $ca_incoterms;


	/**
	 * The value for the ca_payment_terms field.
	 * @var        string
	 */
	protected $ca_payment_terms;


	/**
	 * The value for the ca_proforma_number field.
	 * @var        string
	 */
	protected $ca_proforma_number;


	/**
	 * The value for the ca_origin field.
	 * @var        string
	 */
	protected $ca_origin;


	/**
	 * The value for the ca_destination field.
	 * @var        string
	 */
	protected $ca_destination;


	/**
	 * The value for the ca_trans_ship_port field.
	 * @var        string
	 */
	protected $ca_trans_ship_port;


	/**
	 * The value for the ca_reqd_delivery field.
	 * @var        int
	 */
	protected $ca_reqd_delivery;


	/**
	 * The value for the ca_orden_comments field.
	 * @var        string
	 */
	protected $ca_orden_comments;


	/**
	 * The value for the ca_manufacturer_contact field.
	 * @var        string
	 */
	protected $ca_manufacturer_contact;


	/**
	 * The value for the ca_manufacturer_phone field.
	 * @var        string
	 */
	protected $ca_manufacturer_phone;


	/**
	 * The value for the ca_manufacturer_fax field.
	 * @var        string
	 */
	protected $ca_manufacturer_fax;


	/**
	 * The value for the ca_fchanulado field.
	 * @var        int
	 */
	protected $ca_fchanulado;


	/**
	 * The value for the ca_usuanulado field.
	 * @var        string
	 */
	protected $ca_usuanulado;

	/**
	 * Collection to store aggregation of collFalaDetails.
	 * @var        array
	 */
	protected $collFalaDetails;

	/**
	 * The criteria used to select the current contents of collFalaDetails.
	 * @var        Criteria
	 */
	protected $lastFalaDetailCriteria = null;

	/**
	 * Collection to store aggregation of collFalaInstructions.
	 * @var        array
	 */
	protected $collFalaInstructions;

	/**
	 * The criteria used to select the current contents of collFalaInstructions.
	 * @var        Criteria
	 */
	protected $lastFalaInstructionCriteria = null;

	/**
	 * Collection to store aggregation of collFalaShipmentInfos.
	 * @var        array
	 */
	protected $collFalaShipmentInfos;

	/**
	 * The criteria used to select the current contents of collFalaShipmentInfos.
	 * @var        Criteria
	 */
	protected $lastFalaShipmentInfoCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * Get the [ca_iddoc] column value.
	 * 
	 * @return     string
	 */
	public function getCaIddoc()
	{

		return $this->ca_iddoc;
	}

	/**
	 * Get the [optionally formatted] [ca_fecha_carpeta] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFechaCarpeta($format = 'Y-m-d')
	{

		if ($this->ca_fecha_carpeta === null || $this->ca_fecha_carpeta === '') {
			return null;
		} elseif (!is_int($this->ca_fecha_carpeta)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fecha_carpeta);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fecha_carpeta] as date/time value: " . var_export($this->ca_fecha_carpeta, true));
			}
		} else {
			$ts = $this->ca_fecha_carpeta;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_archivo_origen] column value.
	 * 
	 * @return     string
	 */
	public function getCaArchivoOrigen()
	{

		return $this->ca_archivo_origen;
	}

	/**
	 * Get the [ca_reporte] column value.
	 * 
	 * @return     string
	 */
	public function getCaReporte()
	{

		return $this->ca_reporte;
	}

	/**
	 * Get the [ca_num_viaje] column value.
	 * 
	 * @return     string
	 */
	public function getCaNumViaje()
	{

		return $this->ca_num_viaje;
	}

	/**
	 * Get the [ca_cod_carrier] column value.
	 * 
	 * @return     string
	 */
	public function getCaCodCarrier()
	{

		return $this->ca_cod_carrier;
	}

	/**
	 * Get the [ca_codigo_puerto_pickup] column value.
	 * 
	 * @return     string
	 */
	public function getCaCodigoPuertoPickup()
	{

		return $this->ca_codigo_puerto_pickup;
	}

	/**
	 * Get the [ca_codigo_puerto_descarga] column value.
	 * 
	 * @return     string
	 */
	public function getCaCodigoPuertoDescarga()
	{

		return $this->ca_codigo_puerto_descarga;
	}

	/**
	 * Get the [ca_container_mode] column value.
	 * 
	 * @return     string
	 */
	public function getCaContainerMode()
	{

		return $this->ca_container_mode;
	}

	/**
	 * Get the [ca_nombre_proveedor] column value.
	 * 
	 * @return     string
	 */
	public function getCaNombreProveedor()
	{

		return $this->ca_nombre_proveedor;
	}

	/**
	 * Get the [ca_campo_59] column value.
	 * 
	 * @return     string
	 */
	public function getCaCampo59()
	{

		return $this->ca_campo_59;
	}

	/**
	 * Get the [ca_codigo_proveedor] column value.
	 * 
	 * @return     string
	 */
	public function getCaCodigoProveedor()
	{

		return $this->ca_codigo_proveedor;
	}

	/**
	 * Get the [ca_campo_61] column value.
	 * 
	 * @return     string
	 */
	public function getCaCampo61()
	{

		return $this->ca_campo_61;
	}

	/**
	 * Get the [ca_monto_invoice_miles] column value.
	 * 
	 * @return     double
	 */
	public function getCaMontoInvoiceMiles()
	{

		return $this->ca_monto_invoice_miles;
	}

	/**
	 * Get the [ca_procesado] column value.
	 * 
	 * @return     boolean
	 */
	public function getCaProcesado()
	{

		return $this->ca_procesado;
	}

	/**
	 * Get the [ca_trader] column value.
	 * 
	 * @return     string
	 */
	public function getCaTrader()
	{

		return $this->ca_trader;
	}

	/**
	 * Get the [ca_vendor_id] column value.
	 * 
	 * @return     string
	 */
	public function getCaVendorId()
	{

		return $this->ca_vendor_id;
	}

	/**
	 * Get the [ca_vendor_name] column value.
	 * 
	 * @return     string
	 */
	public function getCaVendorName()
	{

		return $this->ca_vendor_name;
	}

	/**
	 * Get the [ca_vendor_addr1] column value.
	 * 
	 * @return     string
	 */
	public function getCaVendorAddr1()
	{

		return $this->ca_vendor_addr1;
	}

	/**
	 * Get the [ca_vendor_city] column value.
	 * 
	 * @return     string
	 */
	public function getCaVendorCity()
	{

		return $this->ca_vendor_city;
	}

	/**
	 * Get the [ca_vendor_country] column value.
	 * 
	 * @return     string
	 */
	public function getCaVendorCountry()
	{

		return $this->ca_vendor_country;
	}

	/**
	 * Get the [optionally formatted] [ca_esd] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaEsd($format = 'Y-m-d')
	{

		if ($this->ca_esd === null || $this->ca_esd === '') {
			return null;
		} elseif (!is_int($this->ca_esd)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_esd);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_esd] as date/time value: " . var_export($this->ca_esd, true));
			}
		} else {
			$ts = $this->ca_esd;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [optionally formatted] [ca_lsd] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaLsd($format = 'Y-m-d')
	{

		if ($this->ca_lsd === null || $this->ca_lsd === '') {
			return null;
		} elseif (!is_int($this->ca_lsd)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_lsd);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_lsd] as date/time value: " . var_export($this->ca_lsd, true));
			}
		} else {
			$ts = $this->ca_lsd;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_incoterms] column value.
	 * 
	 * @return     string
	 */
	public function getCaIncoterms()
	{

		return $this->ca_incoterms;
	}

	/**
	 * Get the [ca_payment_terms] column value.
	 * 
	 * @return     string
	 */
	public function getCaPaymentTerms()
	{

		return $this->ca_payment_terms;
	}

	/**
	 * Get the [ca_proforma_number] column value.
	 * 
	 * @return     string
	 */
	public function getCaProformaNumber()
	{

		return $this->ca_proforma_number;
	}

	/**
	 * Get the [ca_origin] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrigin()
	{

		return $this->ca_origin;
	}

	/**
	 * Get the [ca_destination] column value.
	 * 
	 * @return     string
	 */
	public function getCaDestination()
	{

		return $this->ca_destination;
	}

	/**
	 * Get the [ca_trans_ship_port] column value.
	 * 
	 * @return     string
	 */
	public function getCaTransShipPort()
	{

		return $this->ca_trans_ship_port;
	}

	/**
	 * Get the [optionally formatted] [ca_reqd_delivery] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaReqdDelivery($format = 'Y-m-d')
	{

		if ($this->ca_reqd_delivery === null || $this->ca_reqd_delivery === '') {
			return null;
		} elseif (!is_int($this->ca_reqd_delivery)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_reqd_delivery);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_reqd_delivery] as date/time value: " . var_export($this->ca_reqd_delivery, true));
			}
		} else {
			$ts = $this->ca_reqd_delivery;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_orden_comments] column value.
	 * 
	 * @return     string
	 */
	public function getCaOrdenComments()
	{

		return $this->ca_orden_comments;
	}

	/**
	 * Get the [ca_manufacturer_contact] column value.
	 * 
	 * @return     string
	 */
	public function getCaManufacturerContact()
	{

		return $this->ca_manufacturer_contact;
	}

	/**
	 * Get the [ca_manufacturer_phone] column value.
	 * 
	 * @return     string
	 */
	public function getCaManufacturerPhone()
	{

		return $this->ca_manufacturer_phone;
	}

	/**
	 * Get the [ca_manufacturer_fax] column value.
	 * 
	 * @return     string
	 */
	public function getCaManufacturerFax()
	{

		return $this->ca_manufacturer_fax;
	}

	/**
	 * Get the [optionally formatted] [ca_fchanulado] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCaFchanulado($format = 'Y-m-d H:i:s')
	{

		if ($this->ca_fchanulado === null || $this->ca_fchanulado === '') {
			return null;
		} elseif (!is_int($this->ca_fchanulado)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->ca_fchanulado);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [ca_fchanulado] as date/time value: " . var_export($this->ca_fchanulado, true));
			}
		} else {
			$ts = $this->ca_fchanulado;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	/**
	 * Get the [ca_usuanulado] column value.
	 * 
	 * @return     string
	 */
	public function getCaUsuanulado()
	{

		return $this->ca_usuanulado;
	}

	/**
	 * Set the value of [ca_iddoc] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIddoc($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_iddoc !== $v) {
			$this->ca_iddoc = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_IDDOC;
		}

	} // setCaIddoc()

	/**
	 * Set the value of [ca_fecha_carpeta] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFechaCarpeta($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fecha_carpeta] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fecha_carpeta !== $ts) {
			$this->ca_fecha_carpeta = $ts;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_FECHA_CARPETA;
		}

	} // setCaFechaCarpeta()

	/**
	 * Set the value of [ca_archivo_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaArchivoOrigen($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_archivo_origen !== $v) {
			$this->ca_archivo_origen = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_ARCHIVO_ORIGEN;
		}

	} // setCaArchivoOrigen()

	/**
	 * Set the value of [ca_reporte] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaReporte($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_reporte !== $v) {
			$this->ca_reporte = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_REPORTE;
		}

	} // setCaReporte()

	/**
	 * Set the value of [ca_num_viaje] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNumViaje($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_num_viaje !== $v) {
			$this->ca_num_viaje = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_NUM_VIAJE;
		}

	} // setCaNumViaje()

	/**
	 * Set the value of [ca_cod_carrier] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCodCarrier($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_cod_carrier !== $v) {
			$this->ca_cod_carrier = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_COD_CARRIER;
		}

	} // setCaCodCarrier()

	/**
	 * Set the value of [ca_codigo_puerto_pickup] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCodigoPuertoPickup($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_codigo_puerto_pickup !== $v) {
			$this->ca_codigo_puerto_pickup = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CODIGO_PUERTO_PICKUP;
		}

	} // setCaCodigoPuertoPickup()

	/**
	 * Set the value of [ca_codigo_puerto_descarga] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCodigoPuertoDescarga($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_codigo_puerto_descarga !== $v) {
			$this->ca_codigo_puerto_descarga = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CODIGO_PUERTO_DESCARGA;
		}

	} // setCaCodigoPuertoDescarga()

	/**
	 * Set the value of [ca_container_mode] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaContainerMode($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_container_mode !== $v) {
			$this->ca_container_mode = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CONTAINER_MODE;
		}

	} // setCaContainerMode()

	/**
	 * Set the value of [ca_nombre_proveedor] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNombreProveedor($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_nombre_proveedor !== $v) {
			$this->ca_nombre_proveedor = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_NOMBRE_PROVEEDOR;
		}

	} // setCaNombreProveedor()

	/**
	 * Set the value of [ca_campo_59] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCampo59($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_campo_59 !== $v) {
			$this->ca_campo_59 = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CAMPO_59;
		}

	} // setCaCampo59()

	/**
	 * Set the value of [ca_codigo_proveedor] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCodigoProveedor($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_codigo_proveedor !== $v) {
			$this->ca_codigo_proveedor = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CODIGO_PROVEEDOR;
		}

	} // setCaCodigoProveedor()

	/**
	 * Set the value of [ca_campo_61] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCampo61($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_campo_61 !== $v) {
			$this->ca_campo_61 = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_CAMPO_61;
		}

	} // setCaCampo61()

	/**
	 * Set the value of [ca_monto_invoice_miles] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setCaMontoInvoiceMiles($v)
	{

		if ($this->ca_monto_invoice_miles !== $v) {
			$this->ca_monto_invoice_miles = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_MONTO_INVOICE_MILES;
		}

	} // setCaMontoInvoiceMiles()

	/**
	 * Set the value of [ca_procesado] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setCaProcesado($v)
	{

		if ($this->ca_procesado !== $v) {
			$this->ca_procesado = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_PROCESADO;
		}

	} // setCaProcesado()

	/**
	 * Set the value of [ca_trader] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTrader($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_trader !== $v) {
			$this->ca_trader = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_TRADER;
		}

	} // setCaTrader()

	/**
	 * Set the value of [ca_vendor_id] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaVendorId($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_vendor_id !== $v) {
			$this->ca_vendor_id = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_VENDOR_ID;
		}

	} // setCaVendorId()

	/**
	 * Set the value of [ca_vendor_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaVendorName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_vendor_name !== $v) {
			$this->ca_vendor_name = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_VENDOR_NAME;
		}

	} // setCaVendorName()

	/**
	 * Set the value of [ca_vendor_addr1] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaVendorAddr1($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_vendor_addr1 !== $v) {
			$this->ca_vendor_addr1 = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_VENDOR_ADDR1;
		}

	} // setCaVendorAddr1()

	/**
	 * Set the value of [ca_vendor_city] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaVendorCity($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_vendor_city !== $v) {
			$this->ca_vendor_city = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_VENDOR_CITY;
		}

	} // setCaVendorCity()

	/**
	 * Set the value of [ca_vendor_country] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaVendorCountry($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_vendor_country !== $v) {
			$this->ca_vendor_country = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_VENDOR_COUNTRY;
		}

	} // setCaVendorCountry()

	/**
	 * Set the value of [ca_esd] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaEsd($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_esd] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_esd !== $ts) {
			$this->ca_esd = $ts;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_ESD;
		}

	} // setCaEsd()

	/**
	 * Set the value of [ca_lsd] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaLsd($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_lsd] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_lsd !== $ts) {
			$this->ca_lsd = $ts;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_LSD;
		}

	} // setCaLsd()

	/**
	 * Set the value of [ca_incoterms] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIncoterms($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_incoterms !== $v) {
			$this->ca_incoterms = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_INCOTERMS;
		}

	} // setCaIncoterms()

	/**
	 * Set the value of [ca_payment_terms] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPaymentTerms($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_payment_terms !== $v) {
			$this->ca_payment_terms = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_PAYMENT_TERMS;
		}

	} // setCaPaymentTerms()

	/**
	 * Set the value of [ca_proforma_number] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaProformaNumber($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_proforma_number !== $v) {
			$this->ca_proforma_number = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_PROFORMA_NUMBER;
		}

	} // setCaProformaNumber()

	/**
	 * Set the value of [ca_origin] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaOrigin($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_origin !== $v) {
			$this->ca_origin = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_ORIGIN;
		}

	} // setCaOrigin()

	/**
	 * Set the value of [ca_destination] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDestination($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_destination !== $v) {
			$this->ca_destination = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_DESTINATION;
		}

	} // setCaDestination()

	/**
	 * Set the value of [ca_trans_ship_port] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTransShipPort($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_trans_ship_port !== $v) {
			$this->ca_trans_ship_port = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_TRANS_SHIP_PORT;
		}

	} // setCaTransShipPort()

	/**
	 * Set the value of [ca_reqd_delivery] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaReqdDelivery($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_reqd_delivery] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_reqd_delivery !== $ts) {
			$this->ca_reqd_delivery = $ts;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_REQD_DELIVERY;
		}

	} // setCaReqdDelivery()

	/**
	 * Set the value of [ca_orden_comments] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaOrdenComments($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_orden_comments !== $v) {
			$this->ca_orden_comments = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_ORDEN_COMMENTS;
		}

	} // setCaOrdenComments()

	/**
	 * Set the value of [ca_manufacturer_contact] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaManufacturerContact($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_manufacturer_contact !== $v) {
			$this->ca_manufacturer_contact = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_MANUFACTURER_CONTACT;
		}

	} // setCaManufacturerContact()

	/**
	 * Set the value of [ca_manufacturer_phone] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaManufacturerPhone($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_manufacturer_phone !== $v) {
			$this->ca_manufacturer_phone = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_MANUFACTURER_PHONE;
		}

	} // setCaManufacturerPhone()

	/**
	 * Set the value of [ca_manufacturer_fax] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaManufacturerFax($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_manufacturer_fax !== $v) {
			$this->ca_manufacturer_fax = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_MANUFACTURER_FAX;
		}

	} // setCaManufacturerFax()

	/**
	 * Set the value of [ca_fchanulado] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaFchanulado($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [ca_fchanulado] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ca_fchanulado !== $ts) {
			$this->ca_fchanulado = $ts;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_FCHANULADO;
		}

	} // setCaFchanulado()

	/**
	 * Set the value of [ca_usuanulado] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaUsuanulado($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_usuanulado !== $v) {
			$this->ca_usuanulado = $v;
			$this->modifiedColumns[] = FalaHeaderPeer::CA_USUANULADO;
		}

	} // setCaUsuanulado()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ca_iddoc = $rs->getString($startcol + 0);

			$this->ca_fecha_carpeta = $rs->getDate($startcol + 1, null);

			$this->ca_archivo_origen = $rs->getString($startcol + 2);

			$this->ca_reporte = $rs->getString($startcol + 3);

			$this->ca_num_viaje = $rs->getString($startcol + 4);

			$this->ca_cod_carrier = $rs->getString($startcol + 5);

			$this->ca_codigo_puerto_pickup = $rs->getString($startcol + 6);

			$this->ca_codigo_puerto_descarga = $rs->getString($startcol + 7);

			$this->ca_container_mode = $rs->getString($startcol + 8);

			$this->ca_nombre_proveedor = $rs->getString($startcol + 9);

			$this->ca_campo_59 = $rs->getString($startcol + 10);

			$this->ca_codigo_proveedor = $rs->getString($startcol + 11);

			$this->ca_campo_61 = $rs->getString($startcol + 12);

			$this->ca_monto_invoice_miles = $rs->getFloat($startcol + 13);

			$this->ca_procesado = $rs->getBoolean($startcol + 14);

			$this->ca_trader = $rs->getString($startcol + 15);

			$this->ca_vendor_id = $rs->getString($startcol + 16);

			$this->ca_vendor_name = $rs->getString($startcol + 17);

			$this->ca_vendor_addr1 = $rs->getString($startcol + 18);

			$this->ca_vendor_city = $rs->getString($startcol + 19);

			$this->ca_vendor_country = $rs->getString($startcol + 20);

			$this->ca_esd = $rs->getDate($startcol + 21, null);

			$this->ca_lsd = $rs->getDate($startcol + 22, null);

			$this->ca_incoterms = $rs->getString($startcol + 23);

			$this->ca_payment_terms = $rs->getString($startcol + 24);

			$this->ca_proforma_number = $rs->getString($startcol + 25);

			$this->ca_origin = $rs->getString($startcol + 26);

			$this->ca_destination = $rs->getString($startcol + 27);

			$this->ca_trans_ship_port = $rs->getString($startcol + 28);

			$this->ca_reqd_delivery = $rs->getDate($startcol + 29, null);

			$this->ca_orden_comments = $rs->getString($startcol + 30);

			$this->ca_manufacturer_contact = $rs->getString($startcol + 31);

			$this->ca_manufacturer_phone = $rs->getString($startcol + 32);

			$this->ca_manufacturer_fax = $rs->getString($startcol + 33);

			$this->ca_fchanulado = $rs->getTimestamp($startcol + 34, null);

			$this->ca_usuanulado = $rs->getString($startcol + 35);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 36; // 36 = FalaHeaderPeer::NUM_COLUMNS - FalaHeaderPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating FalaHeader object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FalaHeaderPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaHeaderPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FalaHeaderPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += FalaHeaderPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collFalaDetails !== null) {
				foreach($this->collFalaDetails as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFalaInstructions !== null) {
				foreach($this->collFalaInstructions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFalaShipmentInfos !== null) {
				foreach($this->collFalaShipmentInfos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
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

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
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
					foreach($this->collFalaDetails as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFalaInstructions !== null) {
					foreach($this->collFalaInstructions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFalaShipmentInfos !== null) {
					foreach($this->collFalaShipmentInfos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
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
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
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

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
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
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
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

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
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

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FalaHeaderPeer::DATABASE_NAME);

		$criteria->add(FalaHeaderPeer::CA_IDDOC, $this->ca_iddoc);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     string
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIddoc();
	}

	/**
	 * Generic method to set the primary key (ca_iddoc column).
	 *
	 * @param      string $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIddoc($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of FalaHeader (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

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
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getFalaDetails() as $relObj) {
				$copyObj->addFalaDetail($relObj->copy($deepCopy));
			}

			foreach($this->getFalaInstructions() as $relObj) {
				$copyObj->addFalaInstruction($relObj->copy($deepCopy));
			}

			foreach($this->getFalaShipmentInfos() as $relObj) {
				$copyObj->addFalaShipmentInfo($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIddoc(NULL); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     FalaHeader Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     FalaHeaderPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FalaHeaderPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collFalaDetails to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFalaDetails()
	{
		if ($this->collFalaDetails === null) {
			$this->collFalaDetails = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FalaHeader has previously
	 * been saved, it will retrieve related FalaDetails from storage.
	 * If this FalaHeader is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFalaDetails($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFalaDetails === null) {
			if ($this->isNew()) {
			   $this->collFalaDetails = array();
			} else {

				$criteria->add(FalaDetailPeer::CA_IDDOC, $this->getCaIddoc());

				FalaDetailPeer::addSelectColumns($criteria);
				$this->collFalaDetails = FalaDetailPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FalaDetailPeer::CA_IDDOC, $this->getCaIddoc());

				FalaDetailPeer::addSelectColumns($criteria);
				if (!isset($this->lastFalaDetailCriteria) || !$this->lastFalaDetailCriteria->equals($criteria)) {
					$this->collFalaDetails = FalaDetailPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFalaDetailCriteria = $criteria;
		return $this->collFalaDetails;
	}

	/**
	 * Returns the number of related FalaDetails.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFalaDetails($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FalaDetailPeer::CA_IDDOC, $this->getCaIddoc());

		return FalaDetailPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a FalaDetail object to this object
	 * through the FalaDetail foreign key attribute
	 *
	 * @param      FalaDetail $l FalaDetail
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFalaDetail(FalaDetail $l)
	{
		$this->collFalaDetails[] = $l;
		$l->setFalaHeader($this);
	}

	/**
	 * Temporary storage of collFalaInstructions to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFalaInstructions()
	{
		if ($this->collFalaInstructions === null) {
			$this->collFalaInstructions = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FalaHeader has previously
	 * been saved, it will retrieve related FalaInstructions from storage.
	 * If this FalaHeader is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFalaInstructions($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFalaInstructions === null) {
			if ($this->isNew()) {
			   $this->collFalaInstructions = array();
			} else {

				$criteria->add(FalaInstructionPeer::CA_IDDOC, $this->getCaIddoc());

				FalaInstructionPeer::addSelectColumns($criteria);
				$this->collFalaInstructions = FalaInstructionPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FalaInstructionPeer::CA_IDDOC, $this->getCaIddoc());

				FalaInstructionPeer::addSelectColumns($criteria);
				if (!isset($this->lastFalaInstructionCriteria) || !$this->lastFalaInstructionCriteria->equals($criteria)) {
					$this->collFalaInstructions = FalaInstructionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFalaInstructionCriteria = $criteria;
		return $this->collFalaInstructions;
	}

	/**
	 * Returns the number of related FalaInstructions.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFalaInstructions($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FalaInstructionPeer::CA_IDDOC, $this->getCaIddoc());

		return FalaInstructionPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a FalaInstruction object to this object
	 * through the FalaInstruction foreign key attribute
	 *
	 * @param      FalaInstruction $l FalaInstruction
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFalaInstruction(FalaInstruction $l)
	{
		$this->collFalaInstructions[] = $l;
		$l->setFalaHeader($this);
	}

	/**
	 * Temporary storage of collFalaShipmentInfos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFalaShipmentInfos()
	{
		if ($this->collFalaShipmentInfos === null) {
			$this->collFalaShipmentInfos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this FalaHeader has previously
	 * been saved, it will retrieve related FalaShipmentInfos from storage.
	 * If this FalaHeader is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFalaShipmentInfos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFalaShipmentInfos === null) {
			if ($this->isNew()) {
			   $this->collFalaShipmentInfos = array();
			} else {

				$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $this->getCaIddoc());

				FalaShipmentInfoPeer::addSelectColumns($criteria);
				$this->collFalaShipmentInfos = FalaShipmentInfoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $this->getCaIddoc());

				FalaShipmentInfoPeer::addSelectColumns($criteria);
				if (!isset($this->lastFalaShipmentInfoCriteria) || !$this->lastFalaShipmentInfoCriteria->equals($criteria)) {
					$this->collFalaShipmentInfos = FalaShipmentInfoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFalaShipmentInfoCriteria = $criteria;
		return $this->collFalaShipmentInfos;
	}

	/**
	 * Returns the number of related FalaShipmentInfos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFalaShipmentInfos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FalaShipmentInfoPeer::CA_IDDOC, $this->getCaIddoc());

		return FalaShipmentInfoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a FalaShipmentInfo object to this object
	 * through the FalaShipmentInfo foreign key attribute
	 *
	 * @param      FalaShipmentInfo $l FalaShipmentInfo
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFalaShipmentInfo(FalaShipmentInfo $l)
	{
		$this->collFalaShipmentInfos[] = $l;
		$l->setFalaHeader($this);
	}

} // BaseFalaHeader
