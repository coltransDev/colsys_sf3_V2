<?php


abstract class BaseInoMaestraAir extends BaseObject  implements Persistent {


  const PEER = 'InoMaestraAirPeer';

	
	protected static $peer;

	
	protected $ca_fchreferencia;

	
	protected $ca_referencia;

	
	protected $ca_impoexpo;

	
	protected $ca_origen;

	
	protected $ca_destino;

	
	protected $ca_modalidad;

	
	protected $ca_idlinea;

	
	protected $ca_mawb;

	
	protected $ca_piezas;

	
	protected $ca_peso;

	
	protected $ca_pesovolumen;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchpreaviso;

	
	protected $ca_fchllegada;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_fchliquidado;

	
	protected $ca_usuliquidado;

	
	protected $ca_fchcerrado;

	
	protected $ca_usucerrado;

	
	protected $aTransportador;

	
	protected $collInoClientesAirs;

	
	private $lastInoClientesAirCriteria = null;

	
	protected $collInoIngresosAirs;

	
	private $lastInoIngresosAirCriteria = null;

	
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

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	
	public function getCaMawb()
	{
		return $this->ca_mawb;
	}

	
	public function getCaPiezas()
	{
		return $this->ca_piezas;
	}

	
	public function getCaPeso()
	{
		return $this->ca_peso;
	}

	
	public function getCaPesovolumen()
	{
		return $this->ca_pesovolumen;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
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

	
	public function getCaFchpreaviso($format = 'Y-m-d')
	{
		if ($this->ca_fchpreaviso === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchpreaviso);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchpreaviso, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFchllegada($format = 'Y-m-d')
	{
		if ($this->ca_fchllegada === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchllegada);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchllegada, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
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
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHREFERENCIA;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_REFERENCIA;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_IMPOEXPO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_ORIGEN;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_DESTINO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_MODALIDAD;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

		return $this;
	} 
	
	public function setCaMawb($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mawb !== $v) {
			$this->ca_mawb = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_MAWB;
		}

		return $this;
	} 
	
	public function setCaPiezas($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_piezas !== $v) {
			$this->ca_piezas = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_PIEZAS;
		}

		return $this;
	} 
	
	public function setCaPeso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_peso !== $v) {
			$this->ca_peso = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_PESO;
		}

		return $this;
	} 
	
	public function setCaPesovolumen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_pesovolumen !== $v) {
			$this->ca_pesovolumen = $v;
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_PESOVOLUMEN;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USUCREADO;
		}

		return $this;
	} 
	
	public function setCaFchpreaviso($v)
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

		if ( $this->ca_fchpreaviso !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchpreaviso !== null && $tmpDt = new DateTime($this->ca_fchpreaviso)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchpreaviso = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHPREAVISO;
			}
		} 
		return $this;
	} 
	
	public function setCaFchllegada($v)
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

		if ( $this->ca_fchllegada !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchllegada !== null && $tmpDt = new DateTime($this->ca_fchllegada)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchllegada = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHLLEGADA;
			}
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
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USUACTUALIZADO;
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
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHLIQUIDADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USULIQUIDADO;
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
				$this->modifiedColumns[] = InoMaestraAirPeer::CA_FCHCERRADO;
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
			$this->modifiedColumns[] = InoMaestraAirPeer::CA_USUCERRADO;
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
			$this->ca_modalidad = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_idlinea = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->ca_mawb = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_piezas = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->ca_peso = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_pesovolumen = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_observaciones = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_fchcreado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_usucreado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_fchpreaviso = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchllegada = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_fchactualizado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_usuactualizado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_fchliquidado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_usuliquidado = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_fchcerrado = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_usucerrado = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 22; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InoMaestraAir object", $e);
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
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = InoMaestraAirPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTransportador = null;
			$this->collInoClientesAirs = null;
			$this->lastInoClientesAirCriteria = null;

			$this->collInoIngresosAirs = null;
			$this->lastInoIngresosAirCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraAir:delete:pre') as $callable)
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
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoMaestraAirPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInoMaestraAir:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoMaestraAir:save:pre') as $callable)
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
			$con = Propel::getConnection(InoMaestraAirPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInoMaestraAir:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			InoMaestraAirPeer::addInstanceToPool($this);
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
					$pk = InoMaestraAirPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InoMaestraAirPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collInoClientesAirs !== null) {
				foreach ($this->collInoClientesAirs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoIngresosAirs !== null) {
				foreach ($this->collInoIngresosAirs as $referrerFK) {
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


			if (($retval = InoMaestraAirPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInoClientesAirs !== null) {
					foreach ($this->collInoClientesAirs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoIngresosAirs !== null) {
					foreach ($this->collInoIngresosAirs as $referrerFK) {
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
		$pos = InoMaestraAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaModalidad();
				break;
			case 6:
				return $this->getCaIdlinea();
				break;
			case 7:
				return $this->getCaMawb();
				break;
			case 8:
				return $this->getCaPiezas();
				break;
			case 9:
				return $this->getCaPeso();
				break;
			case 10:
				return $this->getCaPesovolumen();
				break;
			case 11:
				return $this->getCaObservaciones();
				break;
			case 12:
				return $this->getCaFchcreado();
				break;
			case 13:
				return $this->getCaUsucreado();
				break;
			case 14:
				return $this->getCaFchpreaviso();
				break;
			case 15:
				return $this->getCaFchllegada();
				break;
			case 16:
				return $this->getCaFchactualizado();
				break;
			case 17:
				return $this->getCaUsuactualizado();
				break;
			case 18:
				return $this->getCaFchliquidado();
				break;
			case 19:
				return $this->getCaUsuliquidado();
				break;
			case 20:
				return $this->getCaFchcerrado();
				break;
			case 21:
				return $this->getCaUsucerrado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = InoMaestraAirPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaFchreferencia(),
			$keys[1] => $this->getCaReferencia(),
			$keys[2] => $this->getCaImpoexpo(),
			$keys[3] => $this->getCaOrigen(),
			$keys[4] => $this->getCaDestino(),
			$keys[5] => $this->getCaModalidad(),
			$keys[6] => $this->getCaIdlinea(),
			$keys[7] => $this->getCaMawb(),
			$keys[8] => $this->getCaPiezas(),
			$keys[9] => $this->getCaPeso(),
			$keys[10] => $this->getCaPesovolumen(),
			$keys[11] => $this->getCaObservaciones(),
			$keys[12] => $this->getCaFchcreado(),
			$keys[13] => $this->getCaUsucreado(),
			$keys[14] => $this->getCaFchpreaviso(),
			$keys[15] => $this->getCaFchllegada(),
			$keys[16] => $this->getCaFchactualizado(),
			$keys[17] => $this->getCaUsuactualizado(),
			$keys[18] => $this->getCaFchliquidado(),
			$keys[19] => $this->getCaUsuliquidado(),
			$keys[20] => $this->getCaFchcerrado(),
			$keys[21] => $this->getCaUsucerrado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoMaestraAirPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaModalidad($value);
				break;
			case 6:
				$this->setCaIdlinea($value);
				break;
			case 7:
				$this->setCaMawb($value);
				break;
			case 8:
				$this->setCaPiezas($value);
				break;
			case 9:
				$this->setCaPeso($value);
				break;
			case 10:
				$this->setCaPesovolumen($value);
				break;
			case 11:
				$this->setCaObservaciones($value);
				break;
			case 12:
				$this->setCaFchcreado($value);
				break;
			case 13:
				$this->setCaUsucreado($value);
				break;
			case 14:
				$this->setCaFchpreaviso($value);
				break;
			case 15:
				$this->setCaFchllegada($value);
				break;
			case 16:
				$this->setCaFchactualizado($value);
				break;
			case 17:
				$this->setCaUsuactualizado($value);
				break;
			case 18:
				$this->setCaFchliquidado($value);
				break;
			case 19:
				$this->setCaUsuliquidado($value);
				break;
			case 20:
				$this->setCaFchcerrado($value);
				break;
			case 21:
				$this->setCaUsucerrado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoMaestraAirPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaFchreferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaReferencia($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaImpoexpo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaOrigen($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaDestino($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaModalidad($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdlinea($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaMawb($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaPiezas($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaPeso($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaPesovolumen($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaObservaciones($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchcreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaUsucreado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaFchpreaviso($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchllegada($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchactualizado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsuactualizado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaFchliquidado($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaUsuliquidado($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaFchcerrado($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaUsucerrado($arr[$keys[21]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHREFERENCIA)) $criteria->add(InoMaestraAirPeer::CA_FCHREFERENCIA, $this->ca_fchreferencia);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_REFERENCIA)) $criteria->add(InoMaestraAirPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_IMPOEXPO)) $criteria->add(InoMaestraAirPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_ORIGEN)) $criteria->add(InoMaestraAirPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_DESTINO)) $criteria->add(InoMaestraAirPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_MODALIDAD)) $criteria->add(InoMaestraAirPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_IDLINEA)) $criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_MAWB)) $criteria->add(InoMaestraAirPeer::CA_MAWB, $this->ca_mawb);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_PIEZAS)) $criteria->add(InoMaestraAirPeer::CA_PIEZAS, $this->ca_piezas);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_PESO)) $criteria->add(InoMaestraAirPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_PESOVOLUMEN)) $criteria->add(InoMaestraAirPeer::CA_PESOVOLUMEN, $this->ca_pesovolumen);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_OBSERVACIONES)) $criteria->add(InoMaestraAirPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHCREADO)) $criteria->add(InoMaestraAirPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_USUCREADO)) $criteria->add(InoMaestraAirPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHPREAVISO)) $criteria->add(InoMaestraAirPeer::CA_FCHPREAVISO, $this->ca_fchpreaviso);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHLLEGADA)) $criteria->add(InoMaestraAirPeer::CA_FCHLLEGADA, $this->ca_fchllegada);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHACTUALIZADO)) $criteria->add(InoMaestraAirPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_USUACTUALIZADO)) $criteria->add(InoMaestraAirPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHLIQUIDADO)) $criteria->add(InoMaestraAirPeer::CA_FCHLIQUIDADO, $this->ca_fchliquidado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_USULIQUIDADO)) $criteria->add(InoMaestraAirPeer::CA_USULIQUIDADO, $this->ca_usuliquidado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_FCHCERRADO)) $criteria->add(InoMaestraAirPeer::CA_FCHCERRADO, $this->ca_fchcerrado);
		if ($this->isColumnModified(InoMaestraAirPeer::CA_USUCERRADO)) $criteria->add(InoMaestraAirPeer::CA_USUCERRADO, $this->ca_usucerrado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);

		$criteria->add(InoMaestraAirPeer::CA_REFERENCIA, $this->ca_referencia);

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

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaMawb($this->ca_mawb);

		$copyObj->setCaPiezas($this->ca_piezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaPesovolumen($this->ca_pesovolumen);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchpreaviso($this->ca_fchpreaviso);

		$copyObj->setCaFchllegada($this->ca_fchllegada);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchliquidado($this->ca_fchliquidado);

		$copyObj->setCaUsuliquidado($this->ca_usuliquidado);

		$copyObj->setCaFchcerrado($this->ca_fchcerrado);

		$copyObj->setCaUsucerrado($this->ca_usucerrado);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getInoClientesAirs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoClientesAir($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoIngresosAirs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoIngresosAir($relObj->copy($deepCopy));
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
			self::$peer = new InoMaestraAirPeer();
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
			$v->addInoMaestraAir($this);
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

	
	public function clearInoClientesAirs()
	{
		$this->collInoClientesAirs = null; 	}

	
	public function initInoClientesAirs()
	{
		$this->collInoClientesAirs = array();
	}

	
	public function getInoClientesAirs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
			   $this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				InoClientesAirPeer::addSelectColumns($criteria);
				$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				InoClientesAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
					$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;
		return $this->collInoClientesAirs;
	}

	
	public function countInoClientesAirs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = InoClientesAirPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
					$count = InoClientesAirPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoClientesAirs);
				}
			} else {
				$count = count($this->collInoClientesAirs);
			}
		}
		return $count;
	}

	
	public function addInoClientesAir(InoClientesAir $l)
	{
		if ($this->collInoClientesAirs === null) {
			$this->initInoClientesAirs();
		}
		if (!in_array($l, $this->collInoClientesAirs, true)) { 			array_push($this->collInoClientesAirs, $l);
			$l->setInoMaestraAir($this);
		}
	}


	
	public function getInoClientesAirsJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}


	
	public function getInoClientesAirsJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesAirPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}

	
	public function clearInoIngresosAirs()
	{
		$this->collInoIngresosAirs = null; 	}

	
	public function initInoIngresosAirs()
	{
		$this->collInoIngresosAirs = array();
	}

	
	public function getInoIngresosAirs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
			   $this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

				InoIngresosAirPeer::addSelectColumns($criteria);
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

				InoIngresosAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
					$this->collInoIngresosAirs = InoIngresosAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;
		return $this->collInoIngresosAirs;
	}

	
	public function countInoIngresosAirs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

				$count = InoIngresosAirPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

				if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
					$count = InoIngresosAirPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoIngresosAirs);
				}
			} else {
				$count = count($this->collInoIngresosAirs);
			}
		}
		return $count;
	}

	
	public function addInoIngresosAir(InoIngresosAir $l)
	{
		if ($this->collInoIngresosAirs === null) {
			$this->initInoIngresosAirs();
		}
		if (!in_array($l, $this->collInoIngresosAirs, true)) { 			array_push($this->collInoIngresosAirs, $l);
			$l->setInoMaestraAir($this);
		}
	}


	
	public function getInoIngresosAirsJoinCliente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoMaestraAirPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoIngresosAirs === null) {
			if ($this->isNew()) {
				$this->collInoIngresosAirs = array();
			} else {

				$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoIngresosAirPeer::CA_REFERENCIA, $this->ca_referencia);

			if (!isset($this->lastInoIngresosAirCriteria) || !$this->lastInoIngresosAirCriteria->equals($criteria)) {
				$this->collInoIngresosAirs = InoIngresosAirPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoIngresosAirCriteria = $criteria;

		return $this->collInoIngresosAirs;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collInoClientesAirs) {
				foreach ((array) $this->collInoClientesAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoIngresosAirs) {
				foreach ((array) $this->collInoIngresosAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collInoClientesAirs = null;
		$this->collInoIngresosAirs = null;
			$this->aTransportador = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInoMaestraAir:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInoMaestraAir::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 