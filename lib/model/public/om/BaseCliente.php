<?php

/**
 * Base class that represents a row from the 'tb_clientes' table.
 *
 * 
 *
 * @package    lib.model.public.om
 */
abstract class BaseCliente extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ClientePeer
	 */
	protected static $peer;


	/**
	 * The value for the ca_idcliente field.
	 * @var        int
	 */
	protected $ca_idcliente;


	/**
	 * The value for the ca_digito field.
	 * @var        int
	 */
	protected $ca_digito;


	/**
	 * The value for the ca_compania field.
	 * @var        string
	 */
	protected $ca_compania;


	/**
	 * The value for the ca_papellido field.
	 * @var        string
	 */
	protected $ca_papellido;


	/**
	 * The value for the ca_sapellido field.
	 * @var        string
	 */
	protected $ca_sapellido;


	/**
	 * The value for the ca_nombres field.
	 * @var        string
	 */
	protected $ca_nombres;


	/**
	 * The value for the ca_saludo field.
	 * @var        string
	 */
	protected $ca_saludo;


	/**
	 * The value for the ca_sexo field.
	 * @var        string
	 */
	protected $ca_sexo;


	/**
	 * The value for the ca_cumpleanos field.
	 * @var        string
	 */
	protected $ca_cumpleanos;


	/**
	 * The value for the ca_oficina field.
	 * @var        string
	 */
	protected $ca_oficina;


	/**
	 * The value for the ca_vendedor field.
	 * @var        string
	 */
	protected $ca_vendedor;


	/**
	 * The value for the ca_email field.
	 * @var        string
	 */
	protected $ca_email;


	/**
	 * The value for the ca_coordinador field.
	 * @var        string
	 */
	protected $ca_coordinador;


	/**
	 * The value for the ca_direccion field.
	 * @var        string
	 */
	protected $ca_direccion;


	/**
	 * The value for the ca_localidad field.
	 * @var        string
	 */
	protected $ca_localidad;


	/**
	 * The value for the ca_complemento field.
	 * @var        string
	 */
	protected $ca_complemento;


	/**
	 * The value for the ca_telefonos field.
	 * @var        string
	 */
	protected $ca_telefonos;


	/**
	 * The value for the ca_fax field.
	 * @var        string
	 */
	protected $ca_fax;


	/**
	 * The value for the ca_preferencias field.
	 * @var        string
	 */
	protected $ca_preferencias;


	/**
	 * The value for the ca_confirmar field.
	 * @var        string
	 */
	protected $ca_confirmar;


	/**
	 * The value for the ca_idciudad field.
	 * @var        string
	 */
	protected $ca_idciudad;


	/**
	 * The value for the ca_idgrupo field.
	 * @var        int
	 */
	protected $ca_idgrupo;

	/**
	 * @var        Ciudad
	 */
	protected $aCiudad;

	/**
	 * Collection to store aggregation of collAduanaMaestras.
	 * @var        array
	 */
	protected $collAduanaMaestras;

	/**
	 * The criteria used to select the current contents of collAduanaMaestras.
	 * @var        Criteria
	 */
	protected $lastAduanaMaestraCriteria = null;

	/**
	 * Collection to store aggregation of collInoIngresosAirs.
	 * @var        array
	 */
	protected $collInoIngresosAirs;

	/**
	 * The criteria used to select the current contents of collInoIngresosAirs.
	 * @var        Criteria
	 */
	protected $lastInoIngresosAirCriteria = null;

	/**
	 * Collection to store aggregation of collContactos.
	 * @var        array
	 */
	protected $collContactos;

	/**
	 * The criteria used to select the current contents of collContactos.
	 * @var        Criteria
	 */
	protected $lastContactoCriteria = null;

	/**
	 * Collection to store aggregation of collClienteStds.
	 * @var        array
	 */
	protected $collClienteStds;

	/**
	 * The criteria used to select the current contents of collClienteStds.
	 * @var        Criteria
	 */
	protected $lastClienteStdCriteria = null;

	/**
	 * Collection to store aggregation of collInoIngresosSeas.
	 * @var        array
	 */
	protected $collInoIngresosSeas;

	/**
	 * The criteria used to select the current contents of collInoIngresosSeas.
	 * @var        Criteria
	 */
	protected $lastInoIngresosSeaCriteria = null;

	/**
	 * Collection to store aggregation of collInoAvisosSeas.
	 * @var        array
	 */
	protected $collInoAvisosSeas;

	/**
	 * The criteria used to select the current contents of collInoAvisosSeas.
	 * @var        Criteria
	 */
	protected $lastInoAvisosSeaCriteria = null;

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
	 * Get the [ca_idcliente] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdcliente()
	{

		return $this->ca_idcliente;
	}

	/**
	 * Get the [ca_digito] column value.
	 * 
	 * @return     int
	 */
	public function getCaDigito()
	{

		return $this->ca_digito;
	}

	/**
	 * Get the [ca_compania] column value.
	 * 
	 * @return     string
	 */
	public function getCaCompania()
	{

		return $this->ca_compania;
	}

	/**
	 * Get the [ca_papellido] column value.
	 * 
	 * @return     string
	 */
	public function getCaPapellido()
	{

		return $this->ca_papellido;
	}

	/**
	 * Get the [ca_sapellido] column value.
	 * 
	 * @return     string
	 */
	public function getCaSapellido()
	{

		return $this->ca_sapellido;
	}

	/**
	 * Get the [ca_nombres] column value.
	 * 
	 * @return     string
	 */
	public function getCaNombres()
	{

		return $this->ca_nombres;
	}

	/**
	 * Get the [ca_saludo] column value.
	 * 
	 * @return     string
	 */
	public function getCaSaludo()
	{

		return $this->ca_saludo;
	}

	/**
	 * Get the [ca_sexo] column value.
	 * 
	 * @return     string
	 */
	public function getCaSexo()
	{

		return $this->ca_sexo;
	}

	/**
	 * Get the [ca_cumpleanos] column value.
	 * 
	 * @return     string
	 */
	public function getCaCumpleanos()
	{

		return $this->ca_cumpleanos;
	}

	/**
	 * Get the [ca_oficina] column value.
	 * 
	 * @return     string
	 */
	public function getCaOficina()
	{

		return $this->ca_oficina;
	}

	/**
	 * Get the [ca_vendedor] column value.
	 * 
	 * @return     string
	 */
	public function getCaVendedor()
	{

		return $this->ca_vendedor;
	}

	/**
	 * Get the [ca_email] column value.
	 * 
	 * @return     string
	 */
	public function getCaEmail()
	{

		return $this->ca_email;
	}

	/**
	 * Get the [ca_coordinador] column value.
	 * 
	 * @return     string
	 */
	public function getCaCoordinador()
	{

		return $this->ca_coordinador;
	}

	/**
	 * Get the [ca_direccion] column value.
	 * 
	 * @return     string
	 */
	public function getCaDireccion()
	{

		return $this->ca_direccion;
	}

	/**
	 * Get the [ca_localidad] column value.
	 * 
	 * @return     string
	 */
	public function getCaLocalidad()
	{

		return $this->ca_localidad;
	}

	/**
	 * Get the [ca_complemento] column value.
	 * 
	 * @return     string
	 */
	public function getCaComplemento()
	{

		return $this->ca_complemento;
	}

	/**
	 * Get the [ca_telefonos] column value.
	 * 
	 * @return     string
	 */
	public function getCaTelefonos()
	{

		return $this->ca_telefonos;
	}

	/**
	 * Get the [ca_fax] column value.
	 * 
	 * @return     string
	 */
	public function getCaFax()
	{

		return $this->ca_fax;
	}

	/**
	 * Get the [ca_preferencias] column value.
	 * 
	 * @return     string
	 */
	public function getCaPreferencias()
	{

		return $this->ca_preferencias;
	}

	/**
	 * Get the [ca_confirmar] column value.
	 * 
	 * @return     string
	 */
	public function getCaConfirmar()
	{

		return $this->ca_confirmar;
	}

	/**
	 * Get the [ca_idciudad] column value.
	 * 
	 * @return     string
	 */
	public function getCaIdciudad()
	{

		return $this->ca_idciudad;
	}

	/**
	 * Get the [ca_idgrupo] column value.
	 * 
	 * @return     int
	 */
	public function getCaIdgrupo()
	{

		return $this->ca_idgrupo;
	}

	/**
	 * Set the value of [ca_idcliente] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdcliente($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = ClientePeer::CA_IDCLIENTE;
		}

	} // setCaIdcliente()

	/**
	 * Set the value of [ca_digito] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaDigito($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_digito !== $v) {
			$this->ca_digito = $v;
			$this->modifiedColumns[] = ClientePeer::CA_DIGITO;
		}

	} // setCaDigito()

	/**
	 * Set the value of [ca_compania] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCompania($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_compania !== $v) {
			$this->ca_compania = $v;
			$this->modifiedColumns[] = ClientePeer::CA_COMPANIA;
		}

	} // setCaCompania()

	/**
	 * Set the value of [ca_papellido] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPapellido($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_papellido !== $v) {
			$this->ca_papellido = $v;
			$this->modifiedColumns[] = ClientePeer::CA_PAPELLIDO;
		}

	} // setCaPapellido()

	/**
	 * Set the value of [ca_sapellido] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSapellido($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_sapellido !== $v) {
			$this->ca_sapellido = $v;
			$this->modifiedColumns[] = ClientePeer::CA_SAPELLIDO;
		}

	} // setCaSapellido()

	/**
	 * Set the value of [ca_nombres] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaNombres($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_nombres !== $v) {
			$this->ca_nombres = $v;
			$this->modifiedColumns[] = ClientePeer::CA_NOMBRES;
		}

	} // setCaNombres()

	/**
	 * Set the value of [ca_saludo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSaludo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_saludo !== $v) {
			$this->ca_saludo = $v;
			$this->modifiedColumns[] = ClientePeer::CA_SALUDO;
		}

	} // setCaSaludo()

	/**
	 * Set the value of [ca_sexo] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaSexo($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_sexo !== $v) {
			$this->ca_sexo = $v;
			$this->modifiedColumns[] = ClientePeer::CA_SEXO;
		}

	} // setCaSexo()

	/**
	 * Set the value of [ca_cumpleanos] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCumpleanos($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_cumpleanos !== $v) {
			$this->ca_cumpleanos = $v;
			$this->modifiedColumns[] = ClientePeer::CA_CUMPLEANOS;
		}

	} // setCaCumpleanos()

	/**
	 * Set the value of [ca_oficina] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaOficina($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_oficina !== $v) {
			$this->ca_oficina = $v;
			$this->modifiedColumns[] = ClientePeer::CA_OFICINA;
		}

	} // setCaOficina()

	/**
	 * Set the value of [ca_vendedor] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaVendedor($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_vendedor !== $v) {
			$this->ca_vendedor = $v;
			$this->modifiedColumns[] = ClientePeer::CA_VENDEDOR;
		}

	} // setCaVendedor()

	/**
	 * Set the value of [ca_email] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaEmail($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = ClientePeer::CA_EMAIL;
		}

	} // setCaEmail()

	/**
	 * Set the value of [ca_coordinador] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaCoordinador($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_coordinador !== $v) {
			$this->ca_coordinador = $v;
			$this->modifiedColumns[] = ClientePeer::CA_COORDINADOR;
		}

	} // setCaCoordinador()

	/**
	 * Set the value of [ca_direccion] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaDireccion($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = ClientePeer::CA_DIRECCION;
		}

	} // setCaDireccion()

	/**
	 * Set the value of [ca_localidad] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaLocalidad($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_localidad !== $v) {
			$this->ca_localidad = $v;
			$this->modifiedColumns[] = ClientePeer::CA_LOCALIDAD;
		}

	} // setCaLocalidad()

	/**
	 * Set the value of [ca_complemento] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaComplemento($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_complemento !== $v) {
			$this->ca_complemento = $v;
			$this->modifiedColumns[] = ClientePeer::CA_COMPLEMENTO;
		}

	} // setCaComplemento()

	/**
	 * Set the value of [ca_telefonos] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaTelefonos($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = ClientePeer::CA_TELEFONOS;
		}

	} // setCaTelefonos()

	/**
	 * Set the value of [ca_fax] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaFax($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = ClientePeer::CA_FAX;
		}

	} // setCaFax()

	/**
	 * Set the value of [ca_preferencias] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaPreferencias($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_preferencias !== $v) {
			$this->ca_preferencias = $v;
			$this->modifiedColumns[] = ClientePeer::CA_PREFERENCIAS;
		}

	} // setCaPreferencias()

	/**
	 * Set the value of [ca_confirmar] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaConfirmar($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_confirmar !== $v) {
			$this->ca_confirmar = $v;
			$this->modifiedColumns[] = ClientePeer::CA_CONFIRMAR;
		}

	} // setCaConfirmar()

	/**
	 * Set the value of [ca_idciudad] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCaIdciudad($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = ClientePeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
		}

	} // setCaIdciudad()

	/**
	 * Set the value of [ca_idgrupo] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCaIdgrupo($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ca_idgrupo !== $v) {
			$this->ca_idgrupo = $v;
			$this->modifiedColumns[] = ClientePeer::CA_IDGRUPO;
		}

	} // setCaIdgrupo()

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

			$this->ca_idcliente = $rs->getInt($startcol + 0);

			$this->ca_digito = $rs->getInt($startcol + 1);

			$this->ca_compania = $rs->getString($startcol + 2);

			$this->ca_papellido = $rs->getString($startcol + 3);

			$this->ca_sapellido = $rs->getString($startcol + 4);

			$this->ca_nombres = $rs->getString($startcol + 5);

			$this->ca_saludo = $rs->getString($startcol + 6);

			$this->ca_sexo = $rs->getString($startcol + 7);

			$this->ca_cumpleanos = $rs->getString($startcol + 8);

			$this->ca_oficina = $rs->getString($startcol + 9);

			$this->ca_vendedor = $rs->getString($startcol + 10);

			$this->ca_email = $rs->getString($startcol + 11);

			$this->ca_coordinador = $rs->getString($startcol + 12);

			$this->ca_direccion = $rs->getString($startcol + 13);

			$this->ca_localidad = $rs->getString($startcol + 14);

			$this->ca_complemento = $rs->getString($startcol + 15);

			$this->ca_telefonos = $rs->getString($startcol + 16);

			$this->ca_fax = $rs->getString($startcol + 17);

			$this->ca_preferencias = $rs->getString($startcol + 18);

			$this->ca_confirmar = $rs->getString($startcol + 19);

			$this->ca_idciudad = $rs->getString($startcol + 20);

			$this->ca_idgrupo = $rs->getInt($startcol + 21);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 22; // 22 = ClientePeer::NUM_COLUMNS - ClientePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Cliente object", $e);
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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ClientePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME);
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


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aCiudad !== null) {
				if ($this->aCiudad->isModified()) {
					$affectedRows += $this->aCiudad->save($con);
				}
				$this->setCiudad($this->aCiudad);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClientePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setCaIdcliente($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ClientePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collAduanaMaestras !== null) {
				foreach($this->collAduanaMaestras as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoIngresosAirs !== null) {
				foreach($this->collInoIngresosAirs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collContactos !== null) {
				foreach($this->collContactos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClienteStds !== null) {
				foreach($this->collClienteStds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoIngresosSeas !== null) {
				foreach($this->collInoIngresosSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoAvisosSeas !== null) {
				foreach($this->collInoAvisosSeas as $referrerFK) {
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aCiudad !== null) {
				if (!$this->aCiudad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCiudad->getValidationFailures());
				}
			}


			if (($retval = ClientePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAduanaMaestras !== null) {
					foreach($this->collAduanaMaestras as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosAirs !== null) {
					foreach($this->collInoIngresosAirs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collContactos !== null) {
					foreach($this->collContactos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClienteStds !== null) {
					foreach($this->collClienteStds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosSeas !== null) {
					foreach($this->collInoIngresosSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoAvisosSeas !== null) {
					foreach($this->collInoAvisosSeas as $referrerFK) {
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
		$pos = ClientePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdcliente();
				break;
			case 1:
				return $this->getCaDigito();
				break;
			case 2:
				return $this->getCaCompania();
				break;
			case 3:
				return $this->getCaPapellido();
				break;
			case 4:
				return $this->getCaSapellido();
				break;
			case 5:
				return $this->getCaNombres();
				break;
			case 6:
				return $this->getCaSaludo();
				break;
			case 7:
				return $this->getCaSexo();
				break;
			case 8:
				return $this->getCaCumpleanos();
				break;
			case 9:
				return $this->getCaOficina();
				break;
			case 10:
				return $this->getCaVendedor();
				break;
			case 11:
				return $this->getCaEmail();
				break;
			case 12:
				return $this->getCaCoordinador();
				break;
			case 13:
				return $this->getCaDireccion();
				break;
			case 14:
				return $this->getCaLocalidad();
				break;
			case 15:
				return $this->getCaComplemento();
				break;
			case 16:
				return $this->getCaTelefonos();
				break;
			case 17:
				return $this->getCaFax();
				break;
			case 18:
				return $this->getCaPreferencias();
				break;
			case 19:
				return $this->getCaConfirmar();
				break;
			case 20:
				return $this->getCaIdciudad();
				break;
			case 21:
				return $this->getCaIdgrupo();
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
		$keys = ClientePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcliente(),
			$keys[1] => $this->getCaDigito(),
			$keys[2] => $this->getCaCompania(),
			$keys[3] => $this->getCaPapellido(),
			$keys[4] => $this->getCaSapellido(),
			$keys[5] => $this->getCaNombres(),
			$keys[6] => $this->getCaSaludo(),
			$keys[7] => $this->getCaSexo(),
			$keys[8] => $this->getCaCumpleanos(),
			$keys[9] => $this->getCaOficina(),
			$keys[10] => $this->getCaVendedor(),
			$keys[11] => $this->getCaEmail(),
			$keys[12] => $this->getCaCoordinador(),
			$keys[13] => $this->getCaDireccion(),
			$keys[14] => $this->getCaLocalidad(),
			$keys[15] => $this->getCaComplemento(),
			$keys[16] => $this->getCaTelefonos(),
			$keys[17] => $this->getCaFax(),
			$keys[18] => $this->getCaPreferencias(),
			$keys[19] => $this->getCaConfirmar(),
			$keys[20] => $this->getCaIdciudad(),
			$keys[21] => $this->getCaIdgrupo(),
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
		$pos = ClientePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdcliente($value);
				break;
			case 1:
				$this->setCaDigito($value);
				break;
			case 2:
				$this->setCaCompania($value);
				break;
			case 3:
				$this->setCaPapellido($value);
				break;
			case 4:
				$this->setCaSapellido($value);
				break;
			case 5:
				$this->setCaNombres($value);
				break;
			case 6:
				$this->setCaSaludo($value);
				break;
			case 7:
				$this->setCaSexo($value);
				break;
			case 8:
				$this->setCaCumpleanos($value);
				break;
			case 9:
				$this->setCaOficina($value);
				break;
			case 10:
				$this->setCaVendedor($value);
				break;
			case 11:
				$this->setCaEmail($value);
				break;
			case 12:
				$this->setCaCoordinador($value);
				break;
			case 13:
				$this->setCaDireccion($value);
				break;
			case 14:
				$this->setCaLocalidad($value);
				break;
			case 15:
				$this->setCaComplemento($value);
				break;
			case 16:
				$this->setCaTelefonos($value);
				break;
			case 17:
				$this->setCaFax($value);
				break;
			case 18:
				$this->setCaPreferencias($value);
				break;
			case 19:
				$this->setCaConfirmar($value);
				break;
			case 20:
				$this->setCaIdciudad($value);
				break;
			case 21:
				$this->setCaIdgrupo($value);
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
		$keys = ClientePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcliente($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaDigito($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaCompania($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPapellido($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSapellido($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNombres($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaSaludo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaSexo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaCumpleanos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaOficina($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaVendedor($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaEmail($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaCoordinador($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaDireccion($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaLocalidad($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaComplemento($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaTelefonos($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaFax($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaPreferencias($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaConfirmar($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaIdciudad($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaIdgrupo($arr[$keys[21]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ClientePeer::DATABASE_NAME);

		if ($this->isColumnModified(ClientePeer::CA_IDCLIENTE)) $criteria->add(ClientePeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(ClientePeer::CA_DIGITO)) $criteria->add(ClientePeer::CA_DIGITO, $this->ca_digito);
		if ($this->isColumnModified(ClientePeer::CA_COMPANIA)) $criteria->add(ClientePeer::CA_COMPANIA, $this->ca_compania);
		if ($this->isColumnModified(ClientePeer::CA_PAPELLIDO)) $criteria->add(ClientePeer::CA_PAPELLIDO, $this->ca_papellido);
		if ($this->isColumnModified(ClientePeer::CA_SAPELLIDO)) $criteria->add(ClientePeer::CA_SAPELLIDO, $this->ca_sapellido);
		if ($this->isColumnModified(ClientePeer::CA_NOMBRES)) $criteria->add(ClientePeer::CA_NOMBRES, $this->ca_nombres);
		if ($this->isColumnModified(ClientePeer::CA_SALUDO)) $criteria->add(ClientePeer::CA_SALUDO, $this->ca_saludo);
		if ($this->isColumnModified(ClientePeer::CA_SEXO)) $criteria->add(ClientePeer::CA_SEXO, $this->ca_sexo);
		if ($this->isColumnModified(ClientePeer::CA_CUMPLEANOS)) $criteria->add(ClientePeer::CA_CUMPLEANOS, $this->ca_cumpleanos);
		if ($this->isColumnModified(ClientePeer::CA_OFICINA)) $criteria->add(ClientePeer::CA_OFICINA, $this->ca_oficina);
		if ($this->isColumnModified(ClientePeer::CA_VENDEDOR)) $criteria->add(ClientePeer::CA_VENDEDOR, $this->ca_vendedor);
		if ($this->isColumnModified(ClientePeer::CA_EMAIL)) $criteria->add(ClientePeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(ClientePeer::CA_COORDINADOR)) $criteria->add(ClientePeer::CA_COORDINADOR, $this->ca_coordinador);
		if ($this->isColumnModified(ClientePeer::CA_DIRECCION)) $criteria->add(ClientePeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(ClientePeer::CA_LOCALIDAD)) $criteria->add(ClientePeer::CA_LOCALIDAD, $this->ca_localidad);
		if ($this->isColumnModified(ClientePeer::CA_COMPLEMENTO)) $criteria->add(ClientePeer::CA_COMPLEMENTO, $this->ca_complemento);
		if ($this->isColumnModified(ClientePeer::CA_TELEFONOS)) $criteria->add(ClientePeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(ClientePeer::CA_FAX)) $criteria->add(ClientePeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(ClientePeer::CA_PREFERENCIAS)) $criteria->add(ClientePeer::CA_PREFERENCIAS, $this->ca_preferencias);
		if ($this->isColumnModified(ClientePeer::CA_CONFIRMAR)) $criteria->add(ClientePeer::CA_CONFIRMAR, $this->ca_confirmar);
		if ($this->isColumnModified(ClientePeer::CA_IDCIUDAD)) $criteria->add(ClientePeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(ClientePeer::CA_IDGRUPO)) $criteria->add(ClientePeer::CA_IDGRUPO, $this->ca_idgrupo);

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
		$criteria = new Criteria(ClientePeer::DATABASE_NAME);

		$criteria->add(ClientePeer::CA_IDCLIENTE, $this->ca_idcliente);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getCaIdcliente();
	}

	/**
	 * Generic method to set the primary key (ca_idcliente column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setCaIdcliente($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Cliente (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaDigito($this->ca_digito);

		$copyObj->setCaCompania($this->ca_compania);

		$copyObj->setCaPapellido($this->ca_papellido);

		$copyObj->setCaSapellido($this->ca_sapellido);

		$copyObj->setCaNombres($this->ca_nombres);

		$copyObj->setCaSaludo($this->ca_saludo);

		$copyObj->setCaSexo($this->ca_sexo);

		$copyObj->setCaCumpleanos($this->ca_cumpleanos);

		$copyObj->setCaOficina($this->ca_oficina);

		$copyObj->setCaVendedor($this->ca_vendedor);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaCoordinador($this->ca_coordinador);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaLocalidad($this->ca_localidad);

		$copyObj->setCaComplemento($this->ca_complemento);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaPreferencias($this->ca_preferencias);

		$copyObj->setCaConfirmar($this->ca_confirmar);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaIdgrupo($this->ca_idgrupo);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getAduanaMaestras() as $relObj) {
				$copyObj->addAduanaMaestra($relObj->copy($deepCopy));
			}

			foreach($this->getInoIngresosAirs() as $relObj) {
				$copyObj->addInoIngresosAir($relObj->copy($deepCopy));
			}

			foreach($this->getContactos() as $relObj) {
				$copyObj->addContacto($relObj->copy($deepCopy));
			}

			foreach($this->getClienteStds() as $relObj) {
				$copyObj->addClienteStd($relObj->copy($deepCopy));
			}

			foreach($this->getInoIngresosSeas() as $relObj) {
				$copyObj->addInoIngresosSea($relObj->copy($deepCopy));
			}

			foreach($this->getInoAvisosSeas() as $relObj) {
				$copyObj->addInoAvisosSea($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setCaIdcliente(NULL); // this is a pkey column, so set to default value

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
	 * @return     Cliente Clone of current object.
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
	 * @return     ClientePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ClientePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Ciudad object.
	 *
	 * @param      Ciudad $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setCiudad($v)
	{


		if ($v === null) {
			$this->setCaIdciudad(NULL);
		} else {
			$this->setCaIdciudad($v->getCaIdciudad());
		}


		$this->aCiudad = $v;
	}


	/**
	 * Get the associated Ciudad object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Ciudad The associated Ciudad object.
	 * @throws     PropelException
	 */
	public function getCiudad($con = null)
	{
		if ($this->aCiudad === null && (($this->ca_idciudad !== "" && $this->ca_idciudad !== null))) {
			// include the related Peer class
			$this->aCiudad = CiudadPeer::retrieveByPK($this->ca_idciudad, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = CiudadPeer::retrieveByPK($this->ca_idciudad, $con);
			   $obj->addCiudads($this);
			 */
		}
		return $this->aCiudad;
	}

	/**
	 * Temporary storage of collAduanaMaestras to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAduanaMaestras()
	{
		if ($this->collAduanaMaestras === null) {
			$this->collAduanaMaestras = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente has previously
	 * been saved, it will retrieve related AduanaMaestras from storage.
	 * If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAduanaMaestras($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAduanaMaestras === null) {
			if ($this->isNew()) {
			   $this->collAduanaMaestras = array();
			} else {

				$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				AduanaMaestraPeer::addSelectColumns($criteria);
				$this->collAduanaMaestras = AduanaMaestraPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				AduanaMaestraPeer::addSelectColumns($criteria);
				if (!isset($this->lastAduanaMaestraCriteria) || !$this->lastAduanaMaestraCriteria->equals($criteria)) {
					$this->collAduanaMaestras = AduanaMaestraPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAduanaMaestraCriteria = $criteria;
		return $this->collAduanaMaestras;
	}

	/**
	 * Returns the number of related AduanaMaestras.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAduanaMaestras($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AduanaMaestraPeer::CA_IDCLIENTE, $this->getCaIdcliente());

		return AduanaMaestraPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a AduanaMaestra object to this object
	 * through the AduanaMaestra foreign key attribute
	 *
	 * @param      AduanaMaestra $l AduanaMaestra
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAduanaMaestra(AduanaMaestra $l)
	{
		$this->collAduanaMaestras[] = $l;
		$l->setCliente($this);
	}

	/**
	 * Temporary storage of collInoIngresosAirs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoIngresosAirs()
	{
		if ($this->collInoIngresosAirs === null) {
			$this->collInoIngresosAirs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente has previously
	 * been saved, it will retrieve related InoIngresosAirs from storage.
	 * If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoIngresosAirs($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				InoIngresosAirPeer::addSelectColumns($criteria);
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				InoIngresosAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
					$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;
		return $this->collInoIngresosAirs;
	}

	/**
	 * Returns the number of related InoIngresosAirs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoIngresosAirs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->getCaIdcliente());

		return InoIngresosAirPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoIngresosAir object to this object
	 * through the InoIngresosAir foreign key attribute
	 *
	 * @param      InoIngresosAir $l InoIngresosAir
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoIngresosAir(InoIngresosAir $l)
	{
		$this->collInoIngresosAirs[] = $l;
		$l->setCliente($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoIngresosAirs from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoIngresosAirsJoinInoMaestraAir($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
				$this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinInoMaestraAir($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoIngresosAirPeer::CA_IDCLIENTE, $this->getCaIdcliente());

			if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinInoMaestraAir($criteria, $con);
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;

		return $this->collInoIngresosAirs;
	}

	/**
	 * Temporary storage of collContactos to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initContactos()
	{
		if ($this->collContactos === null) {
			$this->collContactos = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente has previously
	 * been saved, it will retrieve related Contactos from storage.
	 * If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getContactos($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactos === null) {
			if ($this->isNew()) {
			   $this->collContactos = array();
			} else {

				$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				ContactoPeer::addSelectColumns($criteria);
				$this->collContactos = ContactoPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				ContactoPeer::addSelectColumns($criteria);
				if (!isset($this->lastContactoCriteria) || !$this->lastContactoCriteria->equals($criteria)) {
					$this->collContactos = ContactoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastContactoCriteria = $criteria;
		return $this->collContactos;
	}

	/**
	 * Returns the number of related Contactos.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countContactos($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ContactoPeer::CA_IDCLIENTE, $this->getCaIdcliente());

		return ContactoPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Contacto object to this object
	 * through the Contacto foreign key attribute
	 *
	 * @param      Contacto $l Contacto
	 * @return     void
	 * @throws     PropelException
	 */
	public function addContacto(Contacto $l)
	{
		$this->collContactos[] = $l;
		$l->setCliente($this);
	}

	/**
	 * Temporary storage of collClienteStds to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initClienteStds()
	{
		if ($this->collClienteStds === null) {
			$this->collClienteStds = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente has previously
	 * been saved, it will retrieve related ClienteStds from storage.
	 * If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getClienteStds($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClienteStds === null) {
			if ($this->isNew()) {
			   $this->collClienteStds = array();
			} else {

				$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				ClienteStdPeer::addSelectColumns($criteria);
				$this->collClienteStds = ClienteStdPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				ClienteStdPeer::addSelectColumns($criteria);
				if (!isset($this->lastClienteStdCriteria) || !$this->lastClienteStdCriteria->equals($criteria)) {
					$this->collClienteStds = ClienteStdPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClienteStdCriteria = $criteria;
		return $this->collClienteStds;
	}

	/**
	 * Returns the number of related ClienteStds.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countClienteStds($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClienteStdPeer::CA_IDCLIENTE, $this->getCaIdcliente());

		return ClienteStdPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ClienteStd object to this object
	 * through the ClienteStd foreign key attribute
	 *
	 * @param      ClienteStd $l ClienteStd
	 * @return     void
	 * @throws     PropelException
	 */
	public function addClienteStd(ClienteStd $l)
	{
		$this->collClienteStds[] = $l;
		$l->setCliente($this);
	}

	/**
	 * Temporary storage of collInoIngresosSeas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoIngresosSeas()
	{
		if ($this->collInoIngresosSeas === null) {
			$this->collInoIngresosSeas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente has previously
	 * been saved, it will retrieve related InoIngresosSeas from storage.
	 * If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoIngresosSeas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosSeas = array();
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				InoIngresosSeaPeer::addSelectColumns($criteria);
				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				InoIngresosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
					$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoIngresosSeaCriteria = $criteria;
		return $this->collInoIngresosSeas;
	}

	/**
	 * Returns the number of related InoIngresosSeas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoIngresosSeas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->getCaIdcliente());

		return InoIngresosSeaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoIngresosSea object to this object
	 * through the InoIngresosSea foreign key attribute
	 *
	 * @param      InoIngresosSea $l InoIngresosSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoIngresosSea(InoIngresosSea $l)
	{
		$this->collInoIngresosSeas[] = $l;
		$l->setCliente($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoIngresosSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoIngresosSeasJoinInoMaestraSea($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
				$this->collInoIngresosSeas = array();
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoIngresosSeaPeer::CA_IDCLIENTE, $this->getCaIdcliente());

			if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con);
			}
		}
		$this->lastInoIngresosSeaCriteria = $criteria;

		return $this->collInoIngresosSeas;
	}

	/**
	 * Temporary storage of collInoAvisosSeas to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initInoAvisosSeas()
	{
		if ($this->collInoAvisosSeas === null) {
			$this->collInoAvisosSeas = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente has previously
	 * been saved, it will retrieve related InoAvisosSeas from storage.
	 * If this Cliente is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getInoAvisosSeas($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				InoAvisosSeaPeer::addSelectColumns($criteria);
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				InoAvisosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
					$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;
		return $this->collInoAvisosSeas;
	}

	/**
	 * Returns the number of related InoAvisosSeas.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countInoAvisosSeas($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->getCaIdcliente());

		return InoAvisosSeaPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a InoAvisosSea object to this object
	 * through the InoAvisosSea foreign key attribute
	 *
	 * @param      InoAvisosSea $l InoAvisosSea
	 * @return     void
	 * @throws     PropelException
	 */
	public function addInoAvisosSea(InoAvisosSea $l)
	{
		$this->collInoAvisosSeas[] = $l;
		$l->setCliente($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cliente is new, it will return
	 * an empty collection; or if this Cliente has previously
	 * been saved, it will retrieve related InoAvisosSeas from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cliente.
	 */
	public function getInoAvisosSeasJoinInoMaestraSea($criteria = null, $con = null)
	{
		// include the Peer class
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->getCaIdcliente());

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->getCaIdcliente());

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}

} // BaseCliente
