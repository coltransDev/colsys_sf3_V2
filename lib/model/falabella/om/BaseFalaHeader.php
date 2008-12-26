<?php

/**
 * Base class that represents a row from the 'tb_falaheader' table.
 *
 * 
 *
 * @package    lib.model.falabella.om
 */
abstract class BaseFalaHeader extends BaseObject  implements Persistent {


  const PEER = 'FalaHeaderPeer';

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
	 * @var        string
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
	 * @var        string
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
	 * @var        string
	 */
	protected $ca_esd;

	/**
	 * The value for the ca_lsd field.
	 * @var        string
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
	 * @var        string
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
	 * @var        string
	 */
	protected $ca_fchanulado;

	/**
	 * The value for the ca_usuanulado field.
	 * @var        string
	 */
	protected $ca_usuanulado;

	/**
	 * @var        array FalaDetail[] Collection to store aggregation of FalaDetail objects.
	 */
	protected $collFalaDetails;

	/**
	 * @var        Criteria The criteria used to select the current contents of collFalaDetails.
	 */
	private $lastFalaDetailCriteria = null;

	/**
	 * @var        array FalaInstruction[] Collection to store aggregation of FalaInstruction objects.
	 */
	protected $collFalaInstructions;

	/**
	 * @var        Criteria The criteria used to select the current contents of collFalaInstructions.
	 */
	private $lastFalaInstructionCriteria = null;

	/**
	 * @var        FalaShipmentInfo one-to-one related FalaShipmentInfo object
	 */
	protected $singleFalaShipmentInfo;

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
	 * Initializes internal state of BaseFalaHeader object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
	}

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
	 * Get the [optionally formatted] temporal [ca_fecha_carpeta] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
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
	 * @return     string
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
	 * Get the [optionally formatted] temporal [ca_esd] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [ca_lsd] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
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
	 * Get the [optionally formatted] temporal [ca_reqd_delivery] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
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
	 * Get the [optionally formatted] temporal [ca_fchanulado] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
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
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
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
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaIddoc()

	/**
	 * Sets the value of [ca_fecha_carpeta] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     FalaHeader The current object (for fluent API support)
	 */
	public function setCaFechaCarpeta($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fecha_carpeta !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fecha_carpeta !== null && $tmpDt = new DateTime($this->ca_fecha_carpeta)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fecha_carpeta = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaHeaderPeer::CA_FECHA_CARPETA;
			}
		} // if either are not null

		return $this;
	} // setCaFechaCarpeta()

	/**
	 * Set the value of [ca_archivo_origen] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaArchivoOrigen()

	/**
	 * Set the value of [ca_reporte] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaReporte()

	/**
	 * Set the value of [ca_num_viaje] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaNumViaje()

	/**
	 * Set the value of [ca_cod_carrier] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaCodCarrier()

	/**
	 * Set the value of [ca_codigo_puerto_pickup] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaCodigoPuertoPickup()

	/**
	 * Set the value of [ca_codigo_puerto_descarga] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaCodigoPuertoDescarga()

	/**
	 * Set the value of [ca_container_mode] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaContainerMode()

	/**
	 * Set the value of [ca_nombre_proveedor] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaNombreProveedor()

	/**
	 * Set the value of [ca_campo_59] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaCampo59()

	/**
	 * Set the value of [ca_codigo_proveedor] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaCodigoProveedor()

	/**
	 * Set the value of [ca_campo_61] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaCampo61()

	/**
	 * Set the value of [ca_monto_invoice_miles] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaMontoInvoiceMiles()

	/**
	 * Set the value of [ca_procesado] column.
	 * 
	 * @param      boolean $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaProcesado()

	/**
	 * Set the value of [ca_trader] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaTrader()

	/**
	 * Set the value of [ca_vendor_id] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaVendorId()

	/**
	 * Set the value of [ca_vendor_name] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaVendorName()

	/**
	 * Set the value of [ca_vendor_addr1] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaVendorAddr1()

	/**
	 * Set the value of [ca_vendor_city] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaVendorCity()

	/**
	 * Set the value of [ca_vendor_country] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaVendorCountry()

	/**
	 * Sets the value of [ca_esd] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     FalaHeader The current object (for fluent API support)
	 */
	public function setCaEsd($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_esd !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_esd !== null && $tmpDt = new DateTime($this->ca_esd)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_esd = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaHeaderPeer::CA_ESD;
			}
		} // if either are not null

		return $this;
	} // setCaEsd()

	/**
	 * Sets the value of [ca_lsd] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     FalaHeader The current object (for fluent API support)
	 */
	public function setCaLsd($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_lsd !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_lsd !== null && $tmpDt = new DateTime($this->ca_lsd)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_lsd = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaHeaderPeer::CA_LSD;
			}
		} // if either are not null

		return $this;
	} // setCaLsd()

	/**
	 * Set the value of [ca_incoterms] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaIncoterms()

	/**
	 * Set the value of [ca_payment_terms] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaPaymentTerms()

	/**
	 * Set the value of [ca_proforma_number] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaProformaNumber()

	/**
	 * Set the value of [ca_origin] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaOrigin()

	/**
	 * Set the value of [ca_destination] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaDestination()

	/**
	 * Set the value of [ca_trans_ship_port] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaTransShipPort()

	/**
	 * Sets the value of [ca_reqd_delivery] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     FalaHeader The current object (for fluent API support)
	 */
	public function setCaReqdDelivery($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_reqd_delivery !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_reqd_delivery !== null && $tmpDt = new DateTime($this->ca_reqd_delivery)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_reqd_delivery = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = FalaHeaderPeer::CA_REQD_DELIVERY;
			}
		} // if either are not null

		return $this;
	} // setCaReqdDelivery()

	/**
	 * Set the value of [ca_orden_comments] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaOrdenComments()

	/**
	 * Set the value of [ca_manufacturer_contact] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaManufacturerContact()

	/**
	 * Set the value of [ca_manufacturer_phone] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaManufacturerPhone()

	/**
	 * Set the value of [ca_manufacturer_fax] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaManufacturerFax()

	/**
	 * Sets the value of [ca_fchanulado] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     FalaHeader The current object (for fluent API support)
	 */
	public function setCaFchanulado($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->ca_fchanulado !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->ca_fchanulado !== null && $tmpDt = new DateTime($this->ca_fchanulado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->ca_fchanulado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = FalaHeaderPeer::CA_FCHANULADO;
			}
		} // if either are not null

		return $this;
	} // setCaFchanulado()

	/**
	 * Set the value of [ca_usuanulado] column.
	 * 
	 * @param      string $v new value
	 * @return     FalaHeader The current object (for fluent API support)
	 */
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
	} // setCaUsuanulado()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
			// First, ensure that we don't have any columns that have been modified which aren't default columns.
			if (array_diff($this->modifiedColumns, array())) {
				return false;
			}

		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
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

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 36; // 36 = FalaHeaderPeer::NUM_COLUMNS - FalaHeaderPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating FalaHeader object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
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

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = FalaHeaderPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collFalaDetails = null;
			$this->lastFalaDetailCriteria = null;

			$this->collFalaInstructions = null;
			$this->lastFalaInstructionCriteria = null;

			$this->singleFalaShipmentInfo = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
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
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
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
			FalaHeaderPeer::addInstanceToPool($this);
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
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

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaHeaderPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
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

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
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
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
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
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach ($this->getFalaDetails() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFalaDetail($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getFalaInstructions() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addFalaInstruction($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getFalaShipmentInfo();
			if ($relObj) {
				$copyObj->setFalaShipmentInfo($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

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
	 * Clears out the collFalaDetails collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFalaDetails()
	 */
	public function clearFalaDetails()
	{
		$this->collFalaDetails = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFalaDetails collection (array).
	 *
	 * By default this just sets the collFalaDetails collection to an empty array (like clearcollFalaDetails());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initFalaDetails()
	{
		$this->collFalaDetails = array();
	}

	/**
	 * Gets an array of FalaDetail objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this FalaHeader has previously been saved, it will retrieve
	 * related FalaDetails from storage. If this FalaHeader is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array FalaDetail[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related FalaDetail objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related FalaDetail objects.
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


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
		$this->lastFalaDetailCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a FalaDetail object to this object
	 * through the FalaDetail foreign key attribute.
	 *
	 * @param      FalaDetail $l FalaDetail
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFalaDetail(FalaDetail $l)
	{
		if ($this->collFalaDetails === null) {
			$this->initFalaDetails();
		}
		if (!in_array($l, $this->collFalaDetails, true)) { // only add it if the **same** object is not already associated
			array_push($this->collFalaDetails, $l);
			$l->setFalaHeader($this);
		}
	}

	/**
	 * Clears out the collFalaInstructions collection (array).
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addFalaInstructions()
	 */
	public function clearFalaInstructions()
	{
		$this->collFalaInstructions = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collFalaInstructions collection (array).
	 *
	 * By default this just sets the collFalaInstructions collection to an empty array (like clearcollFalaInstructions());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initFalaInstructions()
	{
		$this->collFalaInstructions = array();
	}

	/**
	 * Gets an array of FalaInstruction objects which contain a foreign key that references this object.
	 *
	 * If this collection has already been initialized with an identical Criteria, it returns the collection.
	 * Otherwise if this FalaHeader has previously been saved, it will retrieve
	 * related FalaInstructions from storage. If this FalaHeader is new, it will return
	 * an empty collection or the current collection, the criteria is ignored on a new object.
	 *
	 * @param      PropelPDO $con
	 * @param      Criteria $criteria
	 * @return     array FalaInstruction[]
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


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

	/**
	 * Returns the number of related FalaInstruction objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related FalaInstruction objects.
	 * @throws     PropelException
	 */
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
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return count of the collection.


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
		$this->lastFalaInstructionCriteria = $criteria;
		return $count;
	}

	/**
	 * Method called to associate a FalaInstruction object to this object
	 * through the FalaInstruction foreign key attribute.
	 *
	 * @param      FalaInstruction $l FalaInstruction
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFalaInstruction(FalaInstruction $l)
	{
		if ($this->collFalaInstructions === null) {
			$this->initFalaInstructions();
		}
		if (!in_array($l, $this->collFalaInstructions, true)) { // only add it if the **same** object is not already associated
			array_push($this->collFalaInstructions, $l);
			$l->setFalaHeader($this);
		}
	}

	/**
	 * Gets a single FalaShipmentInfo object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con
	 * @return     FalaShipmentInfo
	 * @throws     PropelException
	 */
	public function getFalaShipmentInfo(PropelPDO $con = null)
	{

		if ($this->singleFalaShipmentInfo === null && !$this->isNew()) {
			$this->singleFalaShipmentInfo = FalaShipmentInfoPeer::retrieveByPK($this->ca_iddoc, $con);
		}

		return $this->singleFalaShipmentInfo;
	}

	/**
	 * Sets a single FalaShipmentInfo object as related to this object by a one-to-one relationship.
	 *
	 * @param      FalaShipmentInfo $l FalaShipmentInfo
	 * @return     FalaHeader The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setFalaShipmentInfo(FalaShipmentInfo $v)
	{
		$this->singleFalaShipmentInfo = $v;

		// Make sure that that the passed-in FalaShipmentInfo isn't already associated with this object
		if ($v->getFalaHeader() === null) {
			$v->setFalaHeader($this);
		}

		return $this;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
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
		} // if ($deep)

		$this->collFalaDetails = null;
		$this->collFalaInstructions = null;
		$this->singleFalaShipmentInfo = null;
	}

} // BaseFalaHeader
