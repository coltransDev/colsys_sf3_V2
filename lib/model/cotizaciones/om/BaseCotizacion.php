<?php


abstract class BaseCotizacion extends BaseObject  implements Persistent {


  const PEER = 'CotizacionPeer';

	
	protected static $peer;

	
	protected $ca_idcotizacion;

	
	protected $ca_idcontacto;

	
	protected $ca_consecutivo;

	
	protected $ca_asunto;

	
	protected $ca_saludo;

	
	protected $ca_entrada;

	
	protected $ca_despedida;

	
	protected $ca_usuario;

	
	protected $ca_anexos;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_fchsolicitud;

	
	protected $ca_horasolicitud;

	
	protected $ca_fchpresentacion;

	
	protected $ca_fchanulado;

	
	protected $ca_usuanulado;

	
	protected $ca_empresa;

	
	protected $ca_datosag;

	
	protected $ca_fuente;

	
	protected $ca_idg_envio_oportuno;

	
	protected $aContacto;

	
	protected $aNotTarea;

	
	protected $aUsuario;

	
	protected $collCotProductos;

	
	private $lastCotProductoCriteria = null;

	
	protected $collCotContinuacions;

	
	private $lastCotContinuacionCriteria = null;

	
	protected $collCotSeguros;

	
	private $lastCotSeguroCriteria = null;

	
	protected $collCotArchivos;

	
	private $lastCotArchivoCriteria = null;

	
	protected $collCotSeguimientos;

	
	private $lastCotSeguimientoCriteria = null;

	
	protected $collCotContactoAgs;

	
	private $lastCotContactoAgCriteria = null;

	
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

	
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	
	public function getCaIdcontacto()
	{
		return $this->ca_idcontacto;
	}

	
	public function getCaConsecutivo()
	{
		return $this->ca_consecutivo;
	}

	
	public function getCaAsunto()
	{
		return $this->ca_asunto;
	}

	
	public function getCaSaludo()
	{
		return $this->ca_saludo;
	}

	
	public function getCaEntrada()
	{
		return $this->ca_entrada;
	}

	
	public function getCaDespedida()
	{
		return $this->ca_despedida;
	}

	
	public function getCaUsuario()
	{
		return $this->ca_usuario;
	}

	
	public function getCaAnexos()
	{
		return $this->ca_anexos;
	}

	
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchcreado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcreado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcreado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsucreado()
	{
		return $this->ca_usucreado;
	}

	
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchactualizado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchactualizado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchactualizado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuactualizado()
	{
		return $this->ca_usuactualizado;
	}

	
	public function getCaFchsolicitud($format = 'Y-m-d')
	{
		if ($this->ca_fchsolicitud === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchsolicitud);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchsolicitud, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaHorasolicitud($format = 'H:i:s')
	{
		if ($this->ca_horasolicitud === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_horasolicitud);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_horasolicitud, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFchpresentacion($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchpresentacion === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchpresentacion);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchpresentacion, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
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

	
	public function getCaEmpresa()
	{
		return $this->ca_empresa;
	}

	
	public function getCaDatosag()
	{
		return $this->ca_datosag;
	}

	
	public function getCaFuente()
	{
		return $this->ca_fuente;
	}

	
	public function getCaIdgEnvioOportuno()
	{
		return $this->ca_idg_envio_oportuno;
	}

	
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_IDCOTIZACION;
		}

		return $this;
	} 
	
	public function setCaIdcontacto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_IDCONTACTO;
		}

		if ($this->aContacto !== null && $this->aContacto->getCaIdcontacto() !== $v) {
			$this->aContacto = null;
		}

		return $this;
	} 
	
	public function setCaConsecutivo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_consecutivo !== $v) {
			$this->ca_consecutivo = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_CONSECUTIVO;
		}

		return $this;
	} 
	
	public function setCaAsunto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_asunto !== $v) {
			$this->ca_asunto = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_ASUNTO;
		}

		return $this;
	} 
	
	public function setCaSaludo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_saludo !== $v) {
			$this->ca_saludo = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_SALUDO;
		}

		return $this;
	} 
	
	public function setCaEntrada($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_entrada !== $v) {
			$this->ca_entrada = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_ENTRADA;
		}

		return $this;
	} 
	
	public function setCaDespedida($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_despedida !== $v) {
			$this->ca_despedida = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_DESPEDIDA;
		}

		return $this;
	} 
	
	public function setCaUsuario($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuario !== $v) {
			$this->ca_usuario = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

		return $this;
	} 
	
	public function setCaAnexos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_anexos !== $v) {
			$this->ca_anexos = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_ANEXOS;
		}

		return $this;
	} 
	
	public function setCaFchcreado($v)
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

		if ( $this->ca_fchcreado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = CotizacionPeer::CA_FCHCREADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUCREADO;
		}

		return $this;
	} 
	
	public function setCaFchactualizado($v)
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

		if ( $this->ca_fchactualizado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = CotizacionPeer::CA_FCHACTUALIZADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaFchsolicitud($v)
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

		if ( $this->ca_fchsolicitud !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchsolicitud !== null && $tmpDt = new DateTime($this->ca_fchsolicitud)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchsolicitud = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = CotizacionPeer::CA_FCHSOLICITUD;
			}
		} 
		return $this;
	} 
	
	public function setCaHorasolicitud($v)
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

		if ( $this->ca_horasolicitud !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_horasolicitud !== null && $tmpDt = new DateTime($this->ca_horasolicitud)) ? $tmpDt->format('H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_horasolicitud = ($dt ? $dt->format('H:i:s') : null);
				$this->modifiedColumns[] = CotizacionPeer::CA_HORASOLICITUD;
			}
		} 
		return $this;
	} 
	
	public function setCaFchpresentacion($v)
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

		if ( $this->ca_fchpresentacion !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchpresentacion !== null && $tmpDt = new DateTime($this->ca_fchpresentacion)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchpresentacion = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = CotizacionPeer::CA_FCHPRESENTACION;
			}
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
				$this->modifiedColumns[] = CotizacionPeer::CA_FCHANULADO;
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
			$this->modifiedColumns[] = CotizacionPeer::CA_USUANULADO;
		}

		return $this;
	} 
	
	public function setCaEmpresa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_empresa !== $v) {
			$this->ca_empresa = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_EMPRESA;
		}

		return $this;
	} 
	
	public function setCaDatosag($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_datosag !== $v) {
			$this->ca_datosag = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_DATOSAG;
		}

		return $this;
	} 
	
	public function setCaFuente($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fuente !== $v) {
			$this->ca_fuente = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_FUENTE;
		}

		return $this;
	} 
	
	public function setCaIdgEnvioOportuno($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idg_envio_oportuno !== $v) {
			$this->ca_idg_envio_oportuno = $v;
			$this->modifiedColumns[] = CotizacionPeer::CA_IDG_ENVIO_OPORTUNO;
		}

		if ($this->aNotTarea !== null && $this->aNotTarea->getCaIdtarea() !== $v) {
			$this->aNotTarea = null;
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

			$this->ca_idcotizacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idcontacto = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_consecutivo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_asunto = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_saludo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_entrada = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_despedida = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_usuario = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_anexos = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchcreado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_usucreado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchactualizado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usuactualizado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchsolicitud = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_horasolicitud = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchpresentacion = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_fchanulado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_usuanulado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_empresa = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_datosag = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_fuente = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_idg_envio_oportuno = ($row[$startcol + 21] !== null) ? (int) $row[$startcol + 21] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 22; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Cotizacion object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aContacto !== null && $this->ca_idcontacto !== $this->aContacto->getCaIdcontacto()) {
			$this->aContacto = null;
		}
		if ($this->aUsuario !== null && $this->ca_usuario !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
		}
		if ($this->aNotTarea !== null && $this->ca_idg_envio_oportuno !== $this->aNotTarea->getCaIdtarea()) {
			$this->aNotTarea = null;
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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CotizacionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aContacto = null;
			$this->aNotTarea = null;
			$this->aUsuario = null;
			$this->collCotProductos = null;
			$this->lastCotProductoCriteria = null;

			$this->collCotContinuacions = null;
			$this->lastCotContinuacionCriteria = null;

			$this->collCotSeguros = null;
			$this->lastCotSeguroCriteria = null;

			$this->collCotArchivos = null;
			$this->lastCotArchivoCriteria = null;

			$this->collCotSeguimientos = null;
			$this->lastCotSeguimientoCriteria = null;

			$this->collCotContactoAgs = null;
			$this->lastCotContactoAgCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotizacion:delete:pre') as $callable)
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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotizacionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCotizacion:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotizacion:save:pre') as $callable)
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
			$con = Propel::getConnection(CotizacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCotizacion:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			CotizacionPeer::addInstanceToPool($this);
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

												
			if ($this->aContacto !== null) {
				if ($this->aContacto->isModified() || $this->aContacto->isNew()) {
					$affectedRows += $this->aContacto->save($con);
				}
				$this->setContacto($this->aContacto);
			}

			if ($this->aNotTarea !== null) {
				if ($this->aNotTarea->isModified() || $this->aNotTarea->isNew()) {
					$affectedRows += $this->aNotTarea->save($con);
				}
				$this->setNotTarea($this->aNotTarea);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CotizacionPeer::CA_IDCOTIZACION;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotizacionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdcotizacion($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CotizacionPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collCotProductos !== null) {
				foreach ($this->collCotProductos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotContinuacions !== null) {
				foreach ($this->collCotContinuacions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotSeguros !== null) {
				foreach ($this->collCotSeguros as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotArchivos !== null) {
				foreach ($this->collCotArchivos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotSeguimientos !== null) {
				foreach ($this->collCotSeguimientos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotContactoAgs !== null) {
				foreach ($this->collCotContactoAgs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
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


												
			if ($this->aContacto !== null) {
				if (!$this->aContacto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aContacto->getValidationFailures());
				}
			}

			if ($this->aNotTarea !== null) {
				if (!$this->aNotTarea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotTarea->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = CotizacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collCotProductos !== null) {
					foreach ($this->collCotProductos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotContinuacions !== null) {
					foreach ($this->collCotContinuacions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotSeguros !== null) {
					foreach ($this->collCotSeguros as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotArchivos !== null) {
					foreach ($this->collCotArchivos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotSeguimientos !== null) {
					foreach ($this->collCotSeguimientos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotContactoAgs !== null) {
					foreach ($this->collCotContactoAgs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotizacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdcotizacion();
				break;
			case 1:
				return $this->getCaIdcontacto();
				break;
			case 2:
				return $this->getCaConsecutivo();
				break;
			case 3:
				return $this->getCaAsunto();
				break;
			case 4:
				return $this->getCaSaludo();
				break;
			case 5:
				return $this->getCaEntrada();
				break;
			case 6:
				return $this->getCaDespedida();
				break;
			case 7:
				return $this->getCaUsuario();
				break;
			case 8:
				return $this->getCaAnexos();
				break;
			case 9:
				return $this->getCaFchcreado();
				break;
			case 10:
				return $this->getCaUsucreado();
				break;
			case 11:
				return $this->getCaFchactualizado();
				break;
			case 12:
				return $this->getCaUsuactualizado();
				break;
			case 13:
				return $this->getCaFchsolicitud();
				break;
			case 14:
				return $this->getCaHorasolicitud();
				break;
			case 15:
				return $this->getCaFchpresentacion();
				break;
			case 16:
				return $this->getCaFchanulado();
				break;
			case 17:
				return $this->getCaUsuanulado();
				break;
			case 18:
				return $this->getCaEmpresa();
				break;
			case 19:
				return $this->getCaDatosag();
				break;
			case 20:
				return $this->getCaFuente();
				break;
			case 21:
				return $this->getCaIdgEnvioOportuno();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CotizacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcotizacion(),
			$keys[1] => $this->getCaIdcontacto(),
			$keys[2] => $this->getCaConsecutivo(),
			$keys[3] => $this->getCaAsunto(),
			$keys[4] => $this->getCaSaludo(),
			$keys[5] => $this->getCaEntrada(),
			$keys[6] => $this->getCaDespedida(),
			$keys[7] => $this->getCaUsuario(),
			$keys[8] => $this->getCaAnexos(),
			$keys[9] => $this->getCaFchcreado(),
			$keys[10] => $this->getCaUsucreado(),
			$keys[11] => $this->getCaFchactualizado(),
			$keys[12] => $this->getCaUsuactualizado(),
			$keys[13] => $this->getCaFchsolicitud(),
			$keys[14] => $this->getCaHorasolicitud(),
			$keys[15] => $this->getCaFchpresentacion(),
			$keys[16] => $this->getCaFchanulado(),
			$keys[17] => $this->getCaUsuanulado(),
			$keys[18] => $this->getCaEmpresa(),
			$keys[19] => $this->getCaDatosag(),
			$keys[20] => $this->getCaFuente(),
			$keys[21] => $this->getCaIdgEnvioOportuno(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotizacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcotizacion($value);
				break;
			case 1:
				$this->setCaIdcontacto($value);
				break;
			case 2:
				$this->setCaConsecutivo($value);
				break;
			case 3:
				$this->setCaAsunto($value);
				break;
			case 4:
				$this->setCaSaludo($value);
				break;
			case 5:
				$this->setCaEntrada($value);
				break;
			case 6:
				$this->setCaDespedida($value);
				break;
			case 7:
				$this->setCaUsuario($value);
				break;
			case 8:
				$this->setCaAnexos($value);
				break;
			case 9:
				$this->setCaFchcreado($value);
				break;
			case 10:
				$this->setCaUsucreado($value);
				break;
			case 11:
				$this->setCaFchactualizado($value);
				break;
			case 12:
				$this->setCaUsuactualizado($value);
				break;
			case 13:
				$this->setCaFchsolicitud($value);
				break;
			case 14:
				$this->setCaHorasolicitud($value);
				break;
			case 15:
				$this->setCaFchpresentacion($value);
				break;
			case 16:
				$this->setCaFchanulado($value);
				break;
			case 17:
				$this->setCaUsuanulado($value);
				break;
			case 18:
				$this->setCaEmpresa($value);
				break;
			case 19:
				$this->setCaDatosag($value);
				break;
			case 20:
				$this->setCaFuente($value);
				break;
			case 21:
				$this->setCaIdgEnvioOportuno($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CotizacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcotizacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcontacto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaConsecutivo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaAsunto($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaSaludo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaEntrada($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaDespedida($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaUsuario($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaAnexos($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchcreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaUsucreado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchactualizado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsuactualizado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchsolicitud($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaHorasolicitud($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchpresentacion($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchanulado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsuanulado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaEmpresa($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaDatosag($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaFuente($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaIdgEnvioOportuno($arr[$keys[21]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotizacionPeer::CA_IDCOTIZACION)) $criteria->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotizacionPeer::CA_IDCONTACTO)) $criteria->add(CotizacionPeer::CA_IDCONTACTO, $this->ca_idcontacto);
		if ($this->isColumnModified(CotizacionPeer::CA_CONSECUTIVO)) $criteria->add(CotizacionPeer::CA_CONSECUTIVO, $this->ca_consecutivo);
		if ($this->isColumnModified(CotizacionPeer::CA_ASUNTO)) $criteria->add(CotizacionPeer::CA_ASUNTO, $this->ca_asunto);
		if ($this->isColumnModified(CotizacionPeer::CA_SALUDO)) $criteria->add(CotizacionPeer::CA_SALUDO, $this->ca_saludo);
		if ($this->isColumnModified(CotizacionPeer::CA_ENTRADA)) $criteria->add(CotizacionPeer::CA_ENTRADA, $this->ca_entrada);
		if ($this->isColumnModified(CotizacionPeer::CA_DESPEDIDA)) $criteria->add(CotizacionPeer::CA_DESPEDIDA, $this->ca_despedida);
		if ($this->isColumnModified(CotizacionPeer::CA_USUARIO)) $criteria->add(CotizacionPeer::CA_USUARIO, $this->ca_usuario);
		if ($this->isColumnModified(CotizacionPeer::CA_ANEXOS)) $criteria->add(CotizacionPeer::CA_ANEXOS, $this->ca_anexos);
		if ($this->isColumnModified(CotizacionPeer::CA_FCHCREADO)) $criteria->add(CotizacionPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotizacionPeer::CA_USUCREADO)) $criteria->add(CotizacionPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotizacionPeer::CA_FCHACTUALIZADO)) $criteria->add(CotizacionPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotizacionPeer::CA_USUACTUALIZADO)) $criteria->add(CotizacionPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(CotizacionPeer::CA_FCHSOLICITUD)) $criteria->add(CotizacionPeer::CA_FCHSOLICITUD, $this->ca_fchsolicitud);
		if ($this->isColumnModified(CotizacionPeer::CA_HORASOLICITUD)) $criteria->add(CotizacionPeer::CA_HORASOLICITUD, $this->ca_horasolicitud);
		if ($this->isColumnModified(CotizacionPeer::CA_FCHPRESENTACION)) $criteria->add(CotizacionPeer::CA_FCHPRESENTACION, $this->ca_fchpresentacion);
		if ($this->isColumnModified(CotizacionPeer::CA_FCHANULADO)) $criteria->add(CotizacionPeer::CA_FCHANULADO, $this->ca_fchanulado);
		if ($this->isColumnModified(CotizacionPeer::CA_USUANULADO)) $criteria->add(CotizacionPeer::CA_USUANULADO, $this->ca_usuanulado);
		if ($this->isColumnModified(CotizacionPeer::CA_EMPRESA)) $criteria->add(CotizacionPeer::CA_EMPRESA, $this->ca_empresa);
		if ($this->isColumnModified(CotizacionPeer::CA_DATOSAG)) $criteria->add(CotizacionPeer::CA_DATOSAG, $this->ca_datosag);
		if ($this->isColumnModified(CotizacionPeer::CA_FUENTE)) $criteria->add(CotizacionPeer::CA_FUENTE, $this->ca_fuente);
		if ($this->isColumnModified(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO)) $criteria->add(CotizacionPeer::CA_IDG_ENVIO_OPORTUNO, $this->ca_idg_envio_oportuno);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);

		$criteria->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdcotizacion();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdcotizacion($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcontacto($this->ca_idcontacto);

		$copyObj->setCaConsecutivo($this->ca_consecutivo);

		$copyObj->setCaAsunto($this->ca_asunto);

		$copyObj->setCaSaludo($this->ca_saludo);

		$copyObj->setCaEntrada($this->ca_entrada);

		$copyObj->setCaDespedida($this->ca_despedida);

		$copyObj->setCaUsuario($this->ca_usuario);

		$copyObj->setCaAnexos($this->ca_anexos);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchsolicitud($this->ca_fchsolicitud);

		$copyObj->setCaHorasolicitud($this->ca_horasolicitud);

		$copyObj->setCaFchpresentacion($this->ca_fchpresentacion);

		$copyObj->setCaFchanulado($this->ca_fchanulado);

		$copyObj->setCaUsuanulado($this->ca_usuanulado);

		$copyObj->setCaEmpresa($this->ca_empresa);

		$copyObj->setCaDatosag($this->ca_datosag);

		$copyObj->setCaFuente($this->ca_fuente);

		$copyObj->setCaIdgEnvioOportuno($this->ca_idg_envio_oportuno);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getCotProductos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotProducto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotContinuacions() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotContinuacion($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotSeguros() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotSeguro($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotArchivos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotArchivo($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotSeguimientos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotSeguimiento($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotContactoAgs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotContactoAg($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdcotizacion(NULL); 
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
			self::$peer = new CotizacionPeer();
		}
		return self::$peer;
	}

	
	public function setContacto(Contacto $v = null)
	{
		if ($v === null) {
			$this->setCaIdcontacto(NULL);
		} else {
			$this->setCaIdcontacto($v->getCaIdcontacto());
		}

		$this->aContacto = $v;

						if ($v !== null) {
			$v->addCotizacion($this);
		}

		return $this;
	}


	
	public function getContacto(PropelPDO $con = null)
	{
		if ($this->aContacto === null && ($this->ca_idcontacto !== null)) {
			$c = new Criteria(ContactoPeer::DATABASE_NAME);
			$c->add(ContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);
			$this->aContacto = ContactoPeer::doSelectOne($c, $con);
			
		}
		return $this->aContacto;
	}

	
	public function setNotTarea(NotTarea $v = null)
	{
		if ($v === null) {
			$this->setCaIdgEnvioOportuno(NULL);
		} else {
			$this->setCaIdgEnvioOportuno($v->getCaIdtarea());
		}

		$this->aNotTarea = $v;

						if ($v !== null) {
			$v->addCotizacion($this);
		}

		return $this;
	}


	
	public function getNotTarea(PropelPDO $con = null)
	{
		if ($this->aNotTarea === null && ($this->ca_idg_envio_oportuno !== null)) {
			$c = new Criteria(NotTareaPeer::DATABASE_NAME);
			$c->add(NotTareaPeer::CA_IDTAREA, $this->ca_idg_envio_oportuno);
			$this->aNotTarea = NotTareaPeer::doSelectOne($c, $con);
			
		}
		return $this->aNotTarea;
	}

	
	public function setUsuario(Usuario $v = null)
	{
		if ($v === null) {
			$this->setCaUsuario(NULL);
		} else {
			$this->setCaUsuario($v->getCaLogin());
		}

		$this->aUsuario = $v;

						if ($v !== null) {
			$v->addCotizacion($this);
		}

		return $this;
	}


	
	public function getUsuario(PropelPDO $con = null)
	{
		if ($this->aUsuario === null && (($this->ca_usuario !== "" && $this->ca_usuario !== null))) {
			$c = new Criteria(UsuarioPeer::DATABASE_NAME);
			$c->add(UsuarioPeer::CA_LOGIN, $this->ca_usuario);
			$this->aUsuario = UsuarioPeer::doSelectOne($c, $con);
			
		}
		return $this->aUsuario;
	}

	
	public function clearCotProductos()
	{
		$this->collCotProductos = null; 	}

	
	public function initCotProductos()
	{
		$this->collCotProductos = array();
	}

	
	public function getCotProductos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
			   $this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotProductoPeer::addSelectColumns($criteria);
				$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotProductoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
					$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotProductoCriteria = $criteria;
		return $this->collCotProductos;
	}

	
	public function countCotProductos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotProductoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
					$count = CotProductoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotProductos);
				}
			} else {
				$count = count($this->collCotProductos);
			}
		}
		return $count;
	}

	
	public function addCotProducto(CotProducto $l)
	{
		if ($this->collCotProductos === null) {
			$this->initCotProductos();
		}
		if (!in_array($l, $this->collCotProductos, true)) { 			array_push($this->collCotProductos, $l);
			$l->setCotizacion($this);
		}
	}


	
	public function getCotProductosJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotProductos = CotProductoPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
				$this->collCotProductos = CotProductoPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotProductoCriteria = $criteria;

		return $this->collCotProductos;
	}


	
	public function getCotProductosJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotProductos = CotProductoPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotProductoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
				$this->collCotProductos = CotProductoPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotProductoCriteria = $criteria;

		return $this->collCotProductos;
	}

	
	public function clearCotContinuacions()
	{
		$this->collCotContinuacions = null; 	}

	
	public function initCotContinuacions()
	{
		$this->collCotContinuacions = array();
	}

	
	public function getCotContinuacions($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
			   $this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotContinuacionPeer::addSelectColumns($criteria);
				$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotContinuacionPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
					$this->collCotContinuacions = CotContinuacionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;
		return $this->collCotContinuacions;
	}

	
	public function countCotContinuacions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotContinuacionPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
					$count = CotContinuacionPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotContinuacions);
				}
			} else {
				$count = count($this->collCotContinuacions);
			}
		}
		return $count;
	}

	
	public function addCotContinuacion(CotContinuacion $l)
	{
		if ($this->collCotContinuacions === null) {
			$this->initCotContinuacions();
		}
		if (!in_array($l, $this->collCotContinuacions, true)) { 			array_push($this->collCotContinuacions, $l);
			$l->setCotizacion($this);
		}
	}


	
	public function getCotContinuacionsJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContinuacions === null) {
			if ($this->isNew()) {
				$this->collCotContinuacions = array();
			} else {

				$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotContinuacionCriteria) || !$this->lastCotContinuacionCriteria->equals($criteria)) {
				$this->collCotContinuacions = CotContinuacionPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotContinuacionCriteria = $criteria;

		return $this->collCotContinuacions;
	}

	
	public function clearCotSeguros()
	{
		$this->collCotSeguros = null; 	}

	
	public function initCotSeguros()
	{
		$this->collCotSeguros = array();
	}

	
	public function getCotSeguros($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
			   $this->collCotSeguros = array();
			} else {

				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotSeguroPeer::addSelectColumns($criteria);
				$this->collCotSeguros = CotSeguroPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotSeguroPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotSeguroCriteria) || !$this->lastCotSeguroCriteria->equals($criteria)) {
					$this->collCotSeguros = CotSeguroPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotSeguroCriteria = $criteria;
		return $this->collCotSeguros;
	}

	
	public function countCotSeguros(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotSeguroPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotSeguroCriteria) || !$this->lastCotSeguroCriteria->equals($criteria)) {
					$count = CotSeguroPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotSeguros);
				}
			} else {
				$count = count($this->collCotSeguros);
			}
		}
		return $count;
	}

	
	public function addCotSeguro(CotSeguro $l)
	{
		if ($this->collCotSeguros === null) {
			$this->initCotSeguros();
		}
		if (!in_array($l, $this->collCotSeguros, true)) { 			array_push($this->collCotSeguros, $l);
			$l->setCotizacion($this);
		}
	}


	
	public function getCotSegurosJoinMoneda($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguros === null) {
			if ($this->isNew()) {
				$this->collCotSeguros = array();
			} else {

				$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotSeguros = CotSeguroPeer::doSelectJoinMoneda($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotSeguroCriteria) || !$this->lastCotSeguroCriteria->equals($criteria)) {
				$this->collCotSeguros = CotSeguroPeer::doSelectJoinMoneda($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguroCriteria = $criteria;

		return $this->collCotSeguros;
	}

	
	public function clearCotArchivos()
	{
		$this->collCotArchivos = null; 	}

	
	public function initCotArchivos()
	{
		$this->collCotArchivos = array();
	}

	
	public function getCotArchivos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotArchivos === null) {
			if ($this->isNew()) {
			   $this->collCotArchivos = array();
			} else {

				$criteria->add(CotArchivoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotArchivoPeer::addSelectColumns($criteria);
				$this->collCotArchivos = CotArchivoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotArchivoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotArchivoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotArchivoCriteria) || !$this->lastCotArchivoCriteria->equals($criteria)) {
					$this->collCotArchivos = CotArchivoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotArchivoCriteria = $criteria;
		return $this->collCotArchivos;
	}

	
	public function countCotArchivos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotArchivos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotArchivoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotArchivoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotArchivoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotArchivoCriteria) || !$this->lastCotArchivoCriteria->equals($criteria)) {
					$count = CotArchivoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotArchivos);
				}
			} else {
				$count = count($this->collCotArchivos);
			}
		}
		return $count;
	}

	
	public function addCotArchivo(CotArchivo $l)
	{
		if ($this->collCotArchivos === null) {
			$this->initCotArchivos();
		}
		if (!in_array($l, $this->collCotArchivos, true)) { 			array_push($this->collCotArchivos, $l);
			$l->setCotizacion($this);
		}
	}

	
	public function clearCotSeguimientos()
	{
		$this->collCotSeguimientos = null; 	}

	
	public function initCotSeguimientos()
	{
		$this->collCotSeguimientos = array();
	}

	
	public function getCotSeguimientos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
			   $this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotSeguimientoPeer::addSelectColumns($criteria);
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotSeguimientoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
					$this->collCotSeguimientos = CotSeguimientoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;
		return $this->collCotSeguimientos;
	}

	
	public function countCotSeguimientos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotSeguimientoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
					$count = CotSeguimientoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotSeguimientos);
				}
			} else {
				$count = count($this->collCotSeguimientos);
			}
		}
		return $count;
	}

	
	public function addCotSeguimiento(CotSeguimiento $l)
	{
		if ($this->collCotSeguimientos === null) {
			$this->initCotSeguimientos();
		}
		if (!in_array($l, $this->collCotSeguimientos, true)) { 			array_push($this->collCotSeguimientos, $l);
			$l->setCotizacion($this);
		}
	}


	
	public function getCotSeguimientosJoinCotProducto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinCotProducto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinCotProducto($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;

		return $this->collCotSeguimientos;
	}


	
	public function getCotSeguimientosJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotSeguimientos === null) {
			if ($this->isNew()) {
				$this->collCotSeguimientos = array();
			} else {

				$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotSeguimientoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

			if (!isset($this->lastCotSeguimientoCriteria) || !$this->lastCotSeguimientoCriteria->equals($criteria)) {
				$this->collCotSeguimientos = CotSeguimientoPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotSeguimientoCriteria = $criteria;

		return $this->collCotSeguimientos;
	}

	
	public function clearCotContactoAgs()
	{
		$this->collCotContactoAgs = null; 	}

	
	public function initCotContactoAgs()
	{
		$this->collCotContactoAgs = array();
	}

	
	public function getCotContactoAgs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotContactoAgs === null) {
			if ($this->isNew()) {
			   $this->collCotContactoAgs = array();
			} else {

				$criteria->add(CotContactoAgPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotContactoAgPeer::addSelectColumns($criteria);
				$this->collCotContactoAgs = CotContactoAgPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotContactoAgPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				CotContactoAgPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotContactoAgCriteria) || !$this->lastCotContactoAgCriteria->equals($criteria)) {
					$this->collCotContactoAgs = CotContactoAgPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotContactoAgCriteria = $criteria;
		return $this->collCotContactoAgs;
	}

	
	public function countCotContactoAgs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(CotizacionPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotContactoAgs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotContactoAgPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				$count = CotContactoAgPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotContactoAgPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);

				if (!isset($this->lastCotContactoAgCriteria) || !$this->lastCotContactoAgCriteria->equals($criteria)) {
					$count = CotContactoAgPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotContactoAgs);
				}
			} else {
				$count = count($this->collCotContactoAgs);
			}
		}
		return $count;
	}

	
	public function addCotContactoAg(CotContactoAg $l)
	{
		if ($this->collCotContactoAgs === null) {
			$this->initCotContactoAgs();
		}
		if (!in_array($l, $this->collCotContactoAgs, true)) { 			array_push($this->collCotContactoAgs, $l);
			$l->setCotizacion($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collCotProductos) {
				foreach ((array) $this->collCotProductos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotContinuacions) {
				foreach ((array) $this->collCotContinuacions as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotSeguros) {
				foreach ((array) $this->collCotSeguros as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotArchivos) {
				foreach ((array) $this->collCotArchivos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotSeguimientos) {
				foreach ((array) $this->collCotSeguimientos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotContactoAgs) {
				foreach ((array) $this->collCotContactoAgs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collCotProductos = null;
		$this->collCotContinuacions = null;
		$this->collCotSeguros = null;
		$this->collCotArchivos = null;
		$this->collCotSeguimientos = null;
		$this->collCotContactoAgs = null;
			$this->aContacto = null;
			$this->aNotTarea = null;
			$this->aUsuario = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCotizacion:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCotizacion::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 