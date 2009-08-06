<?php


abstract class BaseInoMaestraSea extends BaseObject  implements Persistent {


  const PEER = 'InoMaestraSeaPeer';

	
	protected static $peer;

	
	protected $ca_fchreferencia;

	
	protected $ca_referencia;

	
	protected $ca_impoexpo;

	
	protected $ca_origen;

	
	protected $ca_destino;

	
	protected $ca_fchembarque;

	
	protected $ca_fcharribo;

	
	protected $ca_modalidad;

	
	protected $ca_idlinea;

	
	protected $ca_motonave;

	
	protected $ca_ciclo;

	
	protected $ca_mbls;

	
	protected $ca_observaciones;

	
	protected $ca_fchconfirmacion;

	
	protected $ca_horaconfirmacion;

	
	protected $ca_registroadu;

	
	protected $ca_registrocap;

	
	protected $ca_bandera;

	
	protected $ca_fchliberacion;

	
	protected $ca_nroliberacion;

	
	protected $ca_anulado;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_fchliquidado;

	
	protected $ca_usuliquidado;

	
	protected $ca_fchcerrado;

	
	protected $ca_usucerrado;

	
	protected $ca_mensaje;

	
	protected $ca_fchdesconsolidacion;

	
	protected $ca_mnllegada;

	
	protected $ca_fchregistroadu;

	
	protected $ca_fchconfirmado;

	
	protected $ca_usuconfirmado;

	
	protected $ca_asunto_otm;

	
	protected $ca_mensaje_otm;

	
	protected $ca_fchllegada_otm;

	
	protected $ca_ciudad_otm;

	
	protected $ca_fchconfirma_otm;

	
	protected $ca_usuconfirma_otm;

	
	protected $ca_provisional;

	
	protected $ca_sitiodevolucion;

	
	protected $aTransportador;

	
	protected $collInoClientesSeas;

	
	private $lastInoClientesSeaCriteria = null;

	
	protected $collInoIngresosSeas;

	
	private $lastInoIngresosSeaCriteria = null;

	
	protected $collInoAvisosSeas;

	
	private $lastInoAvisosSeaCriteria = null;

	
	protected $collInoEquiposSeas;

	
	private $lastInoEquiposSeaCriteria = null;

	
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

	
	public function getCaFchreferencia($format = 'Y-m-d')
	{
		if ($this->ca_fchreferencia === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchreferencia);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchreferencia, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaReferencia()
	{
		return $this->ca_referencia;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaOrigen()
	{
		return $this->ca_origen;
	}

	
	public function getCaDestino()
	{
		return $this->ca_destino;
	}

	
	public function getCaFchembarque($format = 'Y-m-d')
	{
		if ($this->ca_fchembarque === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchembarque);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchembarque, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFcharribo($format = 'Y-m-d')
	{
		if ($this->ca_fcharribo === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fcharribo);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fcharribo, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	
	public function getCaMotonave()
	{
		return $this->ca_motonave;
	}

	
	public function getCaCiclo()
	{
		return $this->ca_ciclo;
	}

	
	public function getCaMbls()
	{
		return $this->ca_mbls;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	
	public function getCaFchconfirmacion($format = 'Y-m-d')
	{
		if ($this->ca_fchconfirmacion === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchconfirmacion);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchconfirmacion, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaHoraconfirmacion($format = 'H:i:s')
	{
		if ($this->ca_horaconfirmacion === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_horaconfirmacion);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_horaconfirmacion, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaRegistroadu()
	{
		return $this->ca_registroadu;
	}

	
	public function getCaRegistrocap()
	{
		return $this->ca_registrocap;
	}

	
	public function getCaBandera()
	{
		return $this->ca_bandera;
	}

	
	public function getCaFchliberacion($format = 'Y-m-d')
	{
		if ($this->ca_fchliberacion === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchliberacion);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchliberacion, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaNroliberacion()
	{
		return $this->ca_nroliberacion;
	}

	
	public function getCaAnulado()
	{
		return $this->ca_anulado;
	}

	
	public function getCaFchcreado($format = 'Y-m-d')
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

	
	public function getCaFchactualizado($format = 'Y-m-d')
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

	
	public function getCaFchliquidado($format = 'Y-m-d')
	{
		if ($this->ca_fchliquidado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchliquidado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchliquidado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuliquidado()
	{
		return $this->ca_usuliquidado;
	}

	
	public function getCaFchcerrado($format = 'Y-m-d')
	{
		if ($this->ca_fchcerrado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcerrado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcerrado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsucerrado()
	{
		return $this->ca_usucerrado;
	}

	
	public function getCaMensaje()
	{
		return $this->ca_mensaje;
	}

	
	public function getCaFchdesconsolidacion()
	{
		return $this->ca_fchdesconsolidacion;
	}

	
	public function getCaMnllegada()
	{
		return $this->ca_mnllegada;
	}

	
	public function getCaFchregistroadu()
	{
		return $this->ca_fchregistroadu;
	}

	
	public function getCaFchconfirmado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchconfirmado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchconfirmado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchconfirmado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuconfirmado()
	{
		return $this->ca_usuconfirmado;
	}

	
	public function getCaAsuntoOtm()
	{
		return $this->ca_asunto_otm;
	}

	
	public function getCaMensajeOtm()
	{
		return $this->ca_mensaje_otm;
	}

	
	public function getCaFchllegadaOtm()
	{
		return $this->ca_fchllegada_otm;
	}

	
	public function getCaCiudadOtm()
	{
		return $this->ca_ciudad_otm;
	}

	
	public function getCaFchconfirmaOtm($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchconfirma_otm === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchconfirma_otm);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchconfirma_otm, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuconfirmaOtm()
	{
		return $this->ca_usuconfirma_otm;
	}

	
	public function getCaProvisional()
	{
		return $this->ca_provisional;
	}

	
	public function getCaSitiodevolucion()
	{
		return $this->ca_sitiodevolucion;
	}

	
	public function setCaFchreferencia($v)
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

		if ( $this->ca_fchreferencia !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchreferencia !== null && $tmpDt = new DateTime($this->ca_fchreferencia)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchreferencia = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHREFERENCIA;
			}
		} 
		return $this;
	} 
	
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_REFERENCIA;
		}

		return $this;
	} 
	
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_IMPOEXPO;
		}

		return $this;
	} 
	
	public function setCaOrigen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_origen !== $v) {
			$this->ca_origen = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_ORIGEN;
		}

		return $this;
	} 
	
	public function setCaDestino($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_destino !== $v) {
			$this->ca_destino = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_DESTINO;
		}

		return $this;
	} 
	
	public function setCaFchembarque($v)
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

		if ( $this->ca_fchembarque !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchembarque !== null && $tmpDt = new DateTime($this->ca_fchembarque)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchembarque = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHEMBARQUE;
			}
		} 
		return $this;
	} 
	
	public function setCaFcharribo($v)
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

		if ( $this->ca_fcharribo !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fcharribo !== null && $tmpDt = new DateTime($this->ca_fcharribo)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fcharribo = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHARRIBO;
			}
		} 
		return $this;
	} 
	
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MODALIDAD;
		}

		return $this;
	} 
	
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

		return $this;
	} 
	
	public function setCaMotonave($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_motonave !== $v) {
			$this->ca_motonave = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MOTONAVE;
		}

		return $this;
	} 
	
	public function setCaCiclo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_ciclo !== $v) {
			$this->ca_ciclo = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_CICLO;
		}

		return $this;
	} 
	
	public function setCaMbls($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mbls !== $v) {
			$this->ca_mbls = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MBLS;
		}

		return $this;
	} 
	
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_OBSERVACIONES;
		}

		return $this;
	} 
	
	public function setCaFchconfirmacion($v)
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

		if ( $this->ca_fchconfirmacion !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchconfirmacion !== null && $tmpDt = new DateTime($this->ca_fchconfirmacion)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchconfirmacion = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHCONFIRMACION;
			}
		} 
		return $this;
	} 
	
	public function setCaHoraconfirmacion($v)
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

		if ( $this->ca_horaconfirmacion !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_horaconfirmacion !== null && $tmpDt = new DateTime($this->ca_horaconfirmacion)) ? $tmpDt->format('H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('H:i:s') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_horaconfirmacion = ($dt ? $dt->format('H:i:s') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_HORACONFIRMACION;
			}
		} 
		return $this;
	} 
	
	public function setCaRegistroadu($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_registroadu !== $v) {
			$this->ca_registroadu = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_REGISTROADU;
		}

		return $this;
	} 
	
	public function setCaRegistrocap($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_registrocap !== $v) {
			$this->ca_registrocap = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_REGISTROCAP;
		}

		return $this;
	} 
	
	public function setCaBandera($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_bandera !== $v) {
			$this->ca_bandera = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_BANDERA;
		}

		return $this;
	} 
	
	public function setCaFchliberacion($v)
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

		if ( $this->ca_fchliberacion !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchliberacion !== null && $tmpDt = new DateTime($this->ca_fchliberacion)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchliberacion = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHLIBERACION;
			}
		} 
		return $this;
	} 
	
	public function setCaNroliberacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nroliberacion !== $v) {
			$this->ca_nroliberacion = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_NROLIBERACION;
		}

		return $this;
	} 
	
	public function setCaAnulado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_anulado !== $v) {
			$this->ca_anulado = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_ANULADO;
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
			
			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USUCREADO;
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
			
			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaFchliquidado($v)
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

		if ( $this->ca_fchliquidado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchliquidado !== null && $tmpDt = new DateTime($this->ca_fchliquidado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchliquidado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHLIQUIDADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuliquidado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuliquidado !== $v) {
			$this->ca_usuliquidado = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USULIQUIDADO;
		}

		return $this;
	} 
	
	public function setCaFchcerrado($v)
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

		if ( $this->ca_fchcerrado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcerrado !== null && $tmpDt = new DateTime($this->ca_fchcerrado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcerrado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHCERRADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsucerrado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucerrado !== $v) {
			$this->ca_usucerrado = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USUCERRADO;
		}

		return $this;
	} 
	
	public function setCaMensaje($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mensaje !== $v) {
			$this->ca_mensaje = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MENSAJE;
		}

		return $this;
	} 
	
	public function setCaFchdesconsolidacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fchdesconsolidacion !== $v) {
			$this->ca_fchdesconsolidacion = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHDESCONSOLIDACION;
		}

		return $this;
	} 
	
	public function setCaMnllegada($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mnllegada !== $v) {
			$this->ca_mnllegada = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MNLLEGADA;
		}

		return $this;
	} 
	
	public function setCaFchregistroadu($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fchregistroadu !== $v) {
			$this->ca_fchregistroadu = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHREGISTROADU;
		}

		return $this;
	} 
	
	public function setCaFchconfirmado($v)
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

		if ( $this->ca_fchconfirmado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchconfirmado !== null && $tmpDt = new DateTime($this->ca_fchconfirmado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchconfirmado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHCONFIRMADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuconfirmado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuconfirmado !== $v) {
			$this->ca_usuconfirmado = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USUCONFIRMADO;
		}

		return $this;
	} 
	
	public function setCaAsuntoOtm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_asunto_otm !== $v) {
			$this->ca_asunto_otm = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_ASUNTO_OTM;
		}

		return $this;
	} 
	
	public function setCaMensajeOtm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mensaje_otm !== $v) {
			$this->ca_mensaje_otm = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_MENSAJE_OTM;
		}

		return $this;
	} 
	
	public function setCaFchllegadaOtm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fchllegada_otm !== $v) {
			$this->ca_fchllegada_otm = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHLLEGADA_OTM;
		}

		return $this;
	} 
	
	public function setCaCiudadOtm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_ciudad_otm !== $v) {
			$this->ca_ciudad_otm = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_CIUDAD_OTM;
		}

		return $this;
	} 
	
	public function setCaFchconfirmaOtm($v)
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

		if ( $this->ca_fchconfirma_otm !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchconfirma_otm !== null && $tmpDt = new DateTime($this->ca_fchconfirma_otm)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchconfirma_otm = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = InoMaestraSeaPeer::CA_FCHCONFIRMA_OTM;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuconfirmaOtm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuconfirma_otm !== $v) {
			$this->ca_usuconfirma_otm = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_USUCONFIRMA_OTM;
		}

		return $this;
	} 
	
	public function setCaProvisional($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_provisional !== $v) {
			$this->ca_provisional = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_PROVISIONAL;
		}

		return $this;
	} 
	
	public function setCaSitiodevolucion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sitiodevolucion !== $v) {
			$this->ca_sitiodevolucion = $v;
			$this->modifiedColumns[] = InoMaestraSeaPeer::CA_SITIODEVOLUCION;
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

			$this->ca_fchreferencia = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_referencia = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_impoexpo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_origen = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_destino = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchembarque = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_fcharribo = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_modalidad = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_idlinea = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->ca_motonave = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_ciclo = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_mbls = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_observaciones = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchconfirmacion = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_horaconfirmacion = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_registroadu = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_registrocap = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_bandera = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_fchliberacion = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_nroliberacion = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_anulado = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_fchcreado = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_usucreado = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_fchactualizado = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->ca_usuactualizado = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->ca_fchliquidado = ($row[$startcol + 25] !== null) ? (string) $row[$startcol + 25] : null;
			$this->ca_usuliquidado = ($row[$startcol + 26] !== null) ? (string) $row[$startcol + 26] : null;
			$this->ca_fchcerrado = ($row[$startcol + 27] !== null) ? (string) $row[$startcol + 27] : null;
			$this->ca_usucerrado = ($row[$startcol + 28] !== null) ? (string) $row[$startcol + 28] : null;
			$this->ca_mensaje = ($row[$startcol + 29] !== null) ? (string) $row[$startcol + 29] : null;
			$this->ca_fchdesconsolidacion = ($row[$startcol + 30] !== null) ? (string) $row[$startcol + 30] : null;
			$this->ca_mnllegada = ($row[$startcol + 31] !== null) ? (string) $row[$startcol + 31] : null;
			$this->ca_fchregistroadu = ($row[$startcol + 32] !== null) ? (string) $row[$startcol + 32] : null;
			$this->ca_fchconfirmado = ($row[$startcol + 33] !== null) ? (string) $row[$startcol + 33] : null;
			$this->ca_usuconfirmado = ($row[$startcol + 34] !== null) ? (string) $row[$startcol + 34] : null;
			$this->ca_asunto_otm = ($row[$startcol + 35] !== null) ? (string) $row[$startcol + 35] : null;
			$this->ca_mensaje_otm = ($row[$startcol + 36] !== null) ? (string) $row[$startcol + 36] : null;
			$this->ca_fchllegada_otm = ($row[$startcol + 37] !== null) ? (string) $row[$startcol + 37] : null;
			$this->ca_ciudad_otm = ($row[$startcol + 38] !== null) ? (string) $row[$startcol + 38] : null;
			$this->ca_fchconfirma_otm = ($row[$startcol + 39] !== null) ? (string) $row[$startcol + 39] : null;
			$this->ca_usuconfirma_otm = ($row[$startcol + 40] !== null) ? (string) $row[$startcol + 40] : null;
			$this->ca_provisional = ($row[$startcol + 41] !== null) ? (boolean) $row[$startcol + 41] : null;
			$this->ca_sitiodevolucion = ($row[$startcol + 42] !== null) ? (string) $row[$startcol + 42] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 43; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InoMaestraSea object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTransportador !== null && $this->ca_idlinea !== $this->aTransportador->getCaIdlinea()) {
			$this->aTransportador = null;
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
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = InoMaestraSeaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTransportador = null;
			$this->collInoClientesSeas = null;
			$this->lastInoClientesSeaCriteria = null;

			$this->collInoIngresosSeas = null;
			$this->lastInoIngresosSeaCriteria = null;

			$this->collInoAvisosSeas = null;
			$this->lastInoAvisosSeaCriteria = null;

			$this->collInoEquiposSeas = null;
			$this->lastInoEquiposSeaCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraSea:delete:pre') as $callable)
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
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoMaestraSeaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInoMaestraSea:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraSea:save:pre') as $callable)
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
			$con = Propel::getConnection(InoMaestraSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInoMaestraSea:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			InoMaestraSeaPeer::addInstanceToPool($this);
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

												
			if ($this->aTransportador !== null) {
				if ($this->aTransportador->isModified() || $this->aTransportador->isNew()) {
					$affectedRows += $this->aTransportador->save($con);
				}
				$this->setTransportador($this->aTransportador);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoMaestraSeaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InoMaestraSeaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collInoClientesSeas !== null) {
				foreach ($this->collInoClientesSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoIngresosSeas !== null) {
				foreach ($this->collInoIngresosSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoAvisosSeas !== null) {
				foreach ($this->collInoAvisosSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoEquiposSeas !== null) {
				foreach ($this->collInoEquiposSeas as $referrerFK) {
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


												
			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}


			if (($retval = InoMaestraSeaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInoClientesSeas !== null) {
					foreach ($this->collInoClientesSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosSeas !== null) {
					foreach ($this->collInoIngresosSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoAvisosSeas !== null) {
					foreach ($this->collInoAvisosSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoEquiposSeas !== null) {
					foreach ($this->collInoEquiposSeas as $referrerFK) {
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
		$pos = InoMaestraSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaFchreferencia();
				break;
			case 1:
				return $this->getCaReferencia();
				break;
			case 2:
				return $this->getCaImpoexpo();
				break;
			case 3:
				return $this->getCaOrigen();
				break;
			case 4:
				return $this->getCaDestino();
				break;
			case 5:
				return $this->getCaFchembarque();
				break;
			case 6:
				return $this->getCaFcharribo();
				break;
			case 7:
				return $this->getCaModalidad();
				break;
			case 8:
				return $this->getCaIdlinea();
				break;
			case 9:
				return $this->getCaMotonave();
				break;
			case 10:
				return $this->getCaCiclo();
				break;
			case 11:
				return $this->getCaMbls();
				break;
			case 12:
				return $this->getCaObservaciones();
				break;
			case 13:
				return $this->getCaFchconfirmacion();
				break;
			case 14:
				return $this->getCaHoraconfirmacion();
				break;
			case 15:
				return $this->getCaRegistroadu();
				break;
			case 16:
				return $this->getCaRegistrocap();
				break;
			case 17:
				return $this->getCaBandera();
				break;
			case 18:
				return $this->getCaFchliberacion();
				break;
			case 19:
				return $this->getCaNroliberacion();
				break;
			case 20:
				return $this->getCaAnulado();
				break;
			case 21:
				return $this->getCaFchcreado();
				break;
			case 22:
				return $this->getCaUsucreado();
				break;
			case 23:
				return $this->getCaFchactualizado();
				break;
			case 24:
				return $this->getCaUsuactualizado();
				break;
			case 25:
				return $this->getCaFchliquidado();
				break;
			case 26:
				return $this->getCaUsuliquidado();
				break;
			case 27:
				return $this->getCaFchcerrado();
				break;
			case 28:
				return $this->getCaUsucerrado();
				break;
			case 29:
				return $this->getCaMensaje();
				break;
			case 30:
				return $this->getCaFchdesconsolidacion();
				break;
			case 31:
				return $this->getCaMnllegada();
				break;
			case 32:
				return $this->getCaFchregistroadu();
				break;
			case 33:
				return $this->getCaFchconfirmado();
				break;
			case 34:
				return $this->getCaUsuconfirmado();
				break;
			case 35:
				return $this->getCaAsuntoOtm();
				break;
			case 36:
				return $this->getCaMensajeOtm();
				break;
			case 37:
				return $this->getCaFchllegadaOtm();
				break;
			case 38:
				return $this->getCaCiudadOtm();
				break;
			case 39:
				return $this->getCaFchconfirmaOtm();
				break;
			case 40:
				return $this->getCaUsuconfirmaOtm();
				break;
			case 41:
				return $this->getCaProvisional();
				break;
			case 42:
				return $this->getCaSitiodevolucion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = InoMaestraSeaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaFchreferencia(),
			$keys[1] => $this->getCaReferencia(),
			$keys[2] => $this->getCaImpoexpo(),
			$keys[3] => $this->getCaOrigen(),
			$keys[4] => $this->getCaDestino(),
			$keys[5] => $this->getCaFchembarque(),
			$keys[6] => $this->getCaFcharribo(),
			$keys[7] => $this->getCaModalidad(),
			$keys[8] => $this->getCaIdlinea(),
			$keys[9] => $this->getCaMotonave(),
			$keys[10] => $this->getCaCiclo(),
			$keys[11] => $this->getCaMbls(),
			$keys[12] => $this->getCaObservaciones(),
			$keys[13] => $this->getCaFchconfirmacion(),
			$keys[14] => $this->getCaHoraconfirmacion(),
			$keys[15] => $this->getCaRegistroadu(),
			$keys[16] => $this->getCaRegistrocap(),
			$keys[17] => $this->getCaBandera(),
			$keys[18] => $this->getCaFchliberacion(),
			$keys[19] => $this->getCaNroliberacion(),
			$keys[20] => $this->getCaAnulado(),
			$keys[21] => $this->getCaFchcreado(),
			$keys[22] => $this->getCaUsucreado(),
			$keys[23] => $this->getCaFchactualizado(),
			$keys[24] => $this->getCaUsuactualizado(),
			$keys[25] => $this->getCaFchliquidado(),
			$keys[26] => $this->getCaUsuliquidado(),
			$keys[27] => $this->getCaFchcerrado(),
			$keys[28] => $this->getCaUsucerrado(),
			$keys[29] => $this->getCaMensaje(),
			$keys[30] => $this->getCaFchdesconsolidacion(),
			$keys[31] => $this->getCaMnllegada(),
			$keys[32] => $this->getCaFchregistroadu(),
			$keys[33] => $this->getCaFchconfirmado(),
			$keys[34] => $this->getCaUsuconfirmado(),
			$keys[35] => $this->getCaAsuntoOtm(),
			$keys[36] => $this->getCaMensajeOtm(),
			$keys[37] => $this->getCaFchllegadaOtm(),
			$keys[38] => $this->getCaCiudadOtm(),
			$keys[39] => $this->getCaFchconfirmaOtm(),
			$keys[40] => $this->getCaUsuconfirmaOtm(),
			$keys[41] => $this->getCaProvisional(),
			$keys[42] => $this->getCaSitiodevolucion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoMaestraSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaFchreferencia($value);
				break;
			case 1:
				$this->setCaReferencia($value);
				break;
			case 2:
				$this->setCaImpoexpo($value);
				break;
			case 3:
				$this->setCaOrigen($value);
				break;
			case 4:
				$this->setCaDestino($value);
				break;
			case 5:
				$this->setCaFchembarque($value);
				break;
			case 6:
				$this->setCaFcharribo($value);
				break;
			case 7:
				$this->setCaModalidad($value);
				break;
			case 8:
				$this->setCaIdlinea($value);
				break;
			case 9:
				$this->setCaMotonave($value);
				break;
			case 10:
				$this->setCaCiclo($value);
				break;
			case 11:
				$this->setCaMbls($value);
				break;
			case 12:
				$this->setCaObservaciones($value);
				break;
			case 13:
				$this->setCaFchconfirmacion($value);
				break;
			case 14:
				$this->setCaHoraconfirmacion($value);
				break;
			case 15:
				$this->setCaRegistroadu($value);
				break;
			case 16:
				$this->setCaRegistrocap($value);
				break;
			case 17:
				$this->setCaBandera($value);
				break;
			case 18:
				$this->setCaFchliberacion($value);
				break;
			case 19:
				$this->setCaNroliberacion($value);
				break;
			case 20:
				$this->setCaAnulado($value);
				break;
			case 21:
				$this->setCaFchcreado($value);
				break;
			case 22:
				$this->setCaUsucreado($value);
				break;
			case 23:
				$this->setCaFchactualizado($value);
				break;
			case 24:
				$this->setCaUsuactualizado($value);
				break;
			case 25:
				$this->setCaFchliquidado($value);
				break;
			case 26:
				$this->setCaUsuliquidado($value);
				break;
			case 27:
				$this->setCaFchcerrado($value);
				break;
			case 28:
				$this->setCaUsucerrado($value);
				break;
			case 29:
				$this->setCaMensaje($value);
				break;
			case 30:
				$this->setCaFchdesconsolidacion($value);
				break;
			case 31:
				$this->setCaMnllegada($value);
				break;
			case 32:
				$this->setCaFchregistroadu($value);
				break;
			case 33:
				$this->setCaFchconfirmado($value);
				break;
			case 34:
				$this->setCaUsuconfirmado($value);
				break;
			case 35:
				$this->setCaAsuntoOtm($value);
				break;
			case 36:
				$this->setCaMensajeOtm($value);
				break;
			case 37:
				$this->setCaFchllegadaOtm($value);
				break;
			case 38:
				$this->setCaCiudadOtm($value);
				break;
			case 39:
				$this->setCaFchconfirmaOtm($value);
				break;
			case 40:
				$this->setCaUsuconfirmaOtm($value);
				break;
			case 41:
				$this->setCaProvisional($value);
				break;
			case 42:
				$this->setCaSitiodevolucion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoMaestraSeaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaFchreferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaReferencia($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaImpoexpo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaOrigen($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaDestino($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchembarque($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaFcharribo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaModalidad($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaIdlinea($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaMotonave($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaCiclo($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaMbls($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaObservaciones($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchconfirmacion($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaHoraconfirmacion($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaRegistroadu($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaRegistrocap($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaBandera($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaFchliberacion($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaNroliberacion($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaAnulado($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaFchcreado($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaUsucreado($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaFchactualizado($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaUsuactualizado($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaFchliquidado($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setCaUsuliquidado($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setCaFchcerrado($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setCaUsucerrado($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setCaMensaje($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setCaFchdesconsolidacion($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setCaMnllegada($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setCaFchregistroadu($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setCaFchconfirmado($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setCaUsuconfirmado($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setCaAsuntoOtm($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setCaMensajeOtm($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setCaFchllegadaOtm($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setCaCiudadOtm($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setCaFchconfirmaOtm($arr[$keys[39]]);
		if (array_key_exists($keys[40], $arr)) $this->setCaUsuconfirmaOtm($arr[$keys[40]]);
		if (array_key_exists($keys[41], $arr)) $this->setCaProvisional($arr[$keys[41]]);
		if (array_key_exists($keys[42], $arr)) $this->setCaSitiodevolucion($arr[$keys[42]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHREFERENCIA)) $criteria->add(InoMaestraSeaPeer::CA_FCHREFERENCIA, $this->ca_fchreferencia);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_REFERENCIA)) $criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_IMPOEXPO)) $criteria->add(InoMaestraSeaPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_ORIGEN)) $criteria->add(InoMaestraSeaPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_DESTINO)) $criteria->add(InoMaestraSeaPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHEMBARQUE)) $criteria->add(InoMaestraSeaPeer::CA_FCHEMBARQUE, $this->ca_fchembarque);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHARRIBO)) $criteria->add(InoMaestraSeaPeer::CA_FCHARRIBO, $this->ca_fcharribo);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MODALIDAD)) $criteria->add(InoMaestraSeaPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_IDLINEA)) $criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MOTONAVE)) $criteria->add(InoMaestraSeaPeer::CA_MOTONAVE, $this->ca_motonave);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_CICLO)) $criteria->add(InoMaestraSeaPeer::CA_CICLO, $this->ca_ciclo);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MBLS)) $criteria->add(InoMaestraSeaPeer::CA_MBLS, $this->ca_mbls);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_OBSERVACIONES)) $criteria->add(InoMaestraSeaPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHCONFIRMACION)) $criteria->add(InoMaestraSeaPeer::CA_FCHCONFIRMACION, $this->ca_fchconfirmacion);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_HORACONFIRMACION)) $criteria->add(InoMaestraSeaPeer::CA_HORACONFIRMACION, $this->ca_horaconfirmacion);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_REGISTROADU)) $criteria->add(InoMaestraSeaPeer::CA_REGISTROADU, $this->ca_registroadu);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_REGISTROCAP)) $criteria->add(InoMaestraSeaPeer::CA_REGISTROCAP, $this->ca_registrocap);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_BANDERA)) $criteria->add(InoMaestraSeaPeer::CA_BANDERA, $this->ca_bandera);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHLIBERACION)) $criteria->add(InoMaestraSeaPeer::CA_FCHLIBERACION, $this->ca_fchliberacion);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_NROLIBERACION)) $criteria->add(InoMaestraSeaPeer::CA_NROLIBERACION, $this->ca_nroliberacion);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_ANULADO)) $criteria->add(InoMaestraSeaPeer::CA_ANULADO, $this->ca_anulado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHCREADO)) $criteria->add(InoMaestraSeaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USUCREADO)) $criteria->add(InoMaestraSeaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHACTUALIZADO)) $criteria->add(InoMaestraSeaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USUACTUALIZADO)) $criteria->add(InoMaestraSeaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHLIQUIDADO)) $criteria->add(InoMaestraSeaPeer::CA_FCHLIQUIDADO, $this->ca_fchliquidado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USULIQUIDADO)) $criteria->add(InoMaestraSeaPeer::CA_USULIQUIDADO, $this->ca_usuliquidado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHCERRADO)) $criteria->add(InoMaestraSeaPeer::CA_FCHCERRADO, $this->ca_fchcerrado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USUCERRADO)) $criteria->add(InoMaestraSeaPeer::CA_USUCERRADO, $this->ca_usucerrado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MENSAJE)) $criteria->add(InoMaestraSeaPeer::CA_MENSAJE, $this->ca_mensaje);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHDESCONSOLIDACION)) $criteria->add(InoMaestraSeaPeer::CA_FCHDESCONSOLIDACION, $this->ca_fchdesconsolidacion);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MNLLEGADA)) $criteria->add(InoMaestraSeaPeer::CA_MNLLEGADA, $this->ca_mnllegada);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHREGISTROADU)) $criteria->add(InoMaestraSeaPeer::CA_FCHREGISTROADU, $this->ca_fchregistroadu);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHCONFIRMADO)) $criteria->add(InoMaestraSeaPeer::CA_FCHCONFIRMADO, $this->ca_fchconfirmado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USUCONFIRMADO)) $criteria->add(InoMaestraSeaPeer::CA_USUCONFIRMADO, $this->ca_usuconfirmado);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_ASUNTO_OTM)) $criteria->add(InoMaestraSeaPeer::CA_ASUNTO_OTM, $this->ca_asunto_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_MENSAJE_OTM)) $criteria->add(InoMaestraSeaPeer::CA_MENSAJE_OTM, $this->ca_mensaje_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHLLEGADA_OTM)) $criteria->add(InoMaestraSeaPeer::CA_FCHLLEGADA_OTM, $this->ca_fchllegada_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_CIUDAD_OTM)) $criteria->add(InoMaestraSeaPeer::CA_CIUDAD_OTM, $this->ca_ciudad_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_FCHCONFIRMA_OTM)) $criteria->add(InoMaestraSeaPeer::CA_FCHCONFIRMA_OTM, $this->ca_fchconfirma_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_USUCONFIRMA_OTM)) $criteria->add(InoMaestraSeaPeer::CA_USUCONFIRMA_OTM, $this->ca_usuconfirma_otm);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_PROVISIONAL)) $criteria->add(InoMaestraSeaPeer::CA_PROVISIONAL, $this->ca_provisional);
		if ($this->isColumnModified(InoMaestraSeaPeer::CA_SITIODEVOLUCION)) $criteria->add(InoMaestraSeaPeer::CA_SITIODEVOLUCION, $this->ca_sitiodevolucion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);

		$criteria->add(InoMaestraSeaPeer::CA_REFERENCIA, $this->ca_referencia);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaReferencia();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaReferencia($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchreferencia($this->ca_fchreferencia);

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaFchembarque($this->ca_fchembarque);

		$copyObj->setCaFcharribo($this->ca_fcharribo);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaMotonave($this->ca_motonave);

		$copyObj->setCaCiclo($this->ca_ciclo);

		$copyObj->setCaMbls($this->ca_mbls);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchconfirmacion($this->ca_fchconfirmacion);

		$copyObj->setCaHoraconfirmacion($this->ca_horaconfirmacion);

		$copyObj->setCaRegistroadu($this->ca_registroadu);

		$copyObj->setCaRegistrocap($this->ca_registrocap);

		$copyObj->setCaBandera($this->ca_bandera);

		$copyObj->setCaFchliberacion($this->ca_fchliberacion);

		$copyObj->setCaNroliberacion($this->ca_nroliberacion);

		$copyObj->setCaAnulado($this->ca_anulado);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchliquidado($this->ca_fchliquidado);

		$copyObj->setCaUsuliquidado($this->ca_usuliquidado);

		$copyObj->setCaFchcerrado($this->ca_fchcerrado);

		$copyObj->setCaUsucerrado($this->ca_usucerrado);

		$copyObj->setCaMensaje($this->ca_mensaje);

		$copyObj->setCaFchdesconsolidacion($this->ca_fchdesconsolidacion);

		$copyObj->setCaMnllegada($this->ca_mnllegada);

		$copyObj->setCaFchregistroadu($this->ca_fchregistroadu);

		$copyObj->setCaFchconfirmado($this->ca_fchconfirmado);

		$copyObj->setCaUsuconfirmado($this->ca_usuconfirmado);

		$copyObj->setCaAsuntoOtm($this->ca_asunto_otm);

		$copyObj->setCaMensajeOtm($this->ca_mensaje_otm);

		$copyObj->setCaFchllegadaOtm($this->ca_fchllegada_otm);

		$copyObj->setCaCiudadOtm($this->ca_ciudad_otm);

		$copyObj->setCaFchconfirmaOtm($this->ca_fchconfirma_otm);

		$copyObj->setCaUsuconfirmaOtm($this->ca_usuconfirma_otm);

		$copyObj->setCaProvisional($this->ca_provisional);

		$copyObj->setCaSitiodevolucion($this->ca_sitiodevolucion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getInoClientesSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoClientesSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoIngresosSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoIngresosSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoAvisosSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoAvisosSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoEquiposSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoEquiposSea($relObj->copy($deepCopy));
				}
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
			self::$peer = new InoMaestraSeaPeer();
		}
		return self::$peer;
	}

	
	public function setTransportador(Transportador $v = null)
	{
		if ($v === null) {
			$this->setCaIdlinea(NULL);
		} else {
			$this->setCaIdlinea($v->getCaIdlinea());
		}

		$this->aTransportador = $v;

						if ($v !== null) {
			$v->addInoMaestraSea($this);
		}

		return $this;
	}


	
	public function getTransportador(PropelPDO $con = null)
	{
		if ($this->aTransportador === null && ($this->ca_idlinea !== null)) {
			$c = new Criteria(TransportadorPeer::DATABASE_NAME);
			$c->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
			$this->aTransportador = TransportadorPeer::doSelectOne($c, $con);
			
		}
		return $this->aTransportador;
	}

	
	public function clearInoClientesSeas()
	{
		$this->collInoClientesSeas = null; 	}

	
	public function initInoClientesSeas()
	{
		$this->collInoClientesSeas = array();
	}

	
	public function getInoClientesSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
			   $this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				InoClientesSeaPeer::addSelectColumns($criteria);
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				InoClientesSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;
		return $this->collInoClientesSeas;
	}

	
	public function countInoClientesSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = InoClientesSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$count = InoClientesSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoClientesSeas);
				}
			} else {
				$count = count($this->collInoClientesSeas);
			}
		}
		return $count;
	}

	
	public function addInoClientesSea(InoClientesSea $l)
	{
		if ($this->collInoClientesSeas === null) {
			$this->initInoClientesSeas();
		}
		if (!in_array($l, $this->collInoClientesSeas, true)) { 			array_push($this->collInoClientesSeas, $l);
			$l->setInoMaestraSea($this);
		}
	}


	
	public function getInoClientesSeasJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	
	public function getInoClientesSeasJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	
	public function getInoClientesSeasJoinCliente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}

	
	public function clearInoIngresosSeas()
	{
		$this->collInoIngresosSeas = null; 	}

	
	public function initInoIngresosSeas()
	{
		$this->collInoIngresosSeas = array();
	}

	
	public function getInoIngresosSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosSeas = array();
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				InoIngresosSeaPeer::addSelectColumns($criteria);
				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				InoIngresosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
					$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoIngresosSeaCriteria = $criteria;
		return $this->collInoIngresosSeas;
	}

	
	public function countInoIngresosSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = InoIngresosSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
					$count = InoIngresosSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoIngresosSeas);
				}
			} else {
				$count = count($this->collInoIngresosSeas);
			}
		}
		return $count;
	}

	
	public function addInoIngresosSea(InoIngresosSea $l)
	{
		if ($this->collInoIngresosSeas === null) {
			$this->initInoIngresosSeas();
		}
		if (!in_array($l, $this->collInoIngresosSeas, true)) { 			array_push($this->collInoIngresosSeas, $l);
			$l->setInoMaestraSea($this);
		}
	}


	
	public function getInoIngresosSeasJoinCliente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosSeas === null) {
			if ($this->isNew()) {
				$this->collInoIngresosSeas = array();
			} else {

				$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoIngresosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoIngresosSeaCriteria) || !$this->lastInoIngresosSeaCriteria->equals($criteria)) {
				$this->collInoIngresosSeas = InoIngresosSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoIngresosSeaCriteria = $criteria;

		return $this->collInoIngresosSeas;
	}

	
	public function clearInoAvisosSeas()
	{
		$this->collInoAvisosSeas = null; 	}

	
	public function initInoAvisosSeas()
	{
		$this->collInoAvisosSeas = array();
	}

	
	public function getInoAvisosSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
			   $this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				InoAvisosSeaPeer::addSelectColumns($criteria);
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				InoAvisosSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
					$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;
		return $this->collInoAvisosSeas;
	}

	
	public function countInoAvisosSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = InoAvisosSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
					$count = InoAvisosSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoAvisosSeas);
				}
			} else {
				$count = count($this->collInoAvisosSeas);
			}
		}
		return $count;
	}

	
	public function addInoAvisosSea(InoAvisosSea $l)
	{
		if ($this->collInoAvisosSeas === null) {
			$this->initInoAvisosSeas();
		}
		if (!in_array($l, $this->collInoAvisosSeas, true)) { 			array_push($this->collInoAvisosSeas, $l);
			$l->setInoMaestraSea($this);
		}
	}


	
	public function getInoAvisosSeasJoinInoClientesSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoClientesSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoClientesSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}


	
	public function getInoAvisosSeasJoinCliente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}


	
	public function getInoAvisosSeasJoinEmail($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoAvisosSeas === null) {
			if ($this->isNew()) {
				$this->collInoAvisosSeas = array();
			} else {

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}

	
	public function clearInoEquiposSeas()
	{
		$this->collInoEquiposSeas = null; 	}

	
	public function initInoEquiposSeas()
	{
		$this->collInoEquiposSeas = array();
	}

	
	public function getInoEquiposSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoEquiposSeas === null) {
			if ($this->isNew()) {
			   $this->collInoEquiposSeas = array();
			} else {

				$criteria->add(InoEquiposSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				InoEquiposSeaPeer::addSelectColumns($criteria);
				$this->collInoEquiposSeas = InoEquiposSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoEquiposSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				InoEquiposSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoEquiposSeaCriteria) || !$this->lastInoEquiposSeaCriteria->equals($criteria)) {
					$this->collInoEquiposSeas = InoEquiposSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoEquiposSeaCriteria = $criteria;
		return $this->collInoEquiposSeas;
	}

	
	public function countInoEquiposSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoEquiposSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoEquiposSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = InoEquiposSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoEquiposSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastInoEquiposSeaCriteria) || !$this->lastInoEquiposSeaCriteria->equals($criteria)) {
					$count = InoEquiposSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoEquiposSeas);
				}
			} else {
				$count = count($this->collInoEquiposSeas);
			}
		}
		return $count;
	}

	
	public function addInoEquiposSea(InoEquiposSea $l)
	{
		if ($this->collInoEquiposSeas === null) {
			$this->initInoEquiposSeas();
		}
		if (!in_array($l, $this->collInoEquiposSeas, true)) { 			array_push($this->collInoEquiposSeas, $l);
			$l->setInoMaestraSea($this);
		}
	}


	
	public function getInoEquiposSeasJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoEquiposSeas === null) {
			if ($this->isNew()) {
				$this->collInoEquiposSeas = array();
			} else {

				$criteria->add(InoEquiposSeaPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoEquiposSeas = InoEquiposSeaPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoEquiposSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoEquiposSeaCriteria) || !$this->lastInoEquiposSeaCriteria->equals($criteria)) {
				$this->collInoEquiposSeas = InoEquiposSeaPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoEquiposSeaCriteria = $criteria;

		return $this->collInoEquiposSeas;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collInoClientesSeas) {
				foreach ((array) $this->collInoClientesSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoIngresosSeas) {
				foreach ((array) $this->collInoIngresosSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoAvisosSeas) {
				foreach ((array) $this->collInoAvisosSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoEquiposSeas) {
				foreach ((array) $this->collInoEquiposSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collInoClientesSeas = null;
		$this->collInoIngresosSeas = null;
		$this->collInoAvisosSeas = null;
		$this->collInoEquiposSeas = null;
			$this->aTransportador = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInoMaestraSea:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInoMaestraSea::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 