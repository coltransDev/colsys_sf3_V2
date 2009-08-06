<?php


abstract class BaseInoClientesSea extends BaseObject  implements Persistent {


  const PEER = 'InoClientesSeaPeer';

	
	protected static $peer;

	
	protected $oid;

	
	protected $ca_referencia;

	
	protected $ca_idcliente;

	
	protected $ca_hbls;

	
	protected $ca_idreporte;

	
	protected $ca_idproveedor;

	
	protected $ca_proveedor;

	
	protected $ca_numpiezas;

	
	protected $ca_peso;

	
	protected $ca_volumen;

	
	protected $ca_numorden;

	
	protected $ca_confirmar;

	
	protected $ca_login;

	
	protected $ca_observaciones;

	
	protected $ca_fchliberacion;

	
	protected $ca_notaliberacion;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_fchliberado;

	
	protected $ca_usuliberado;

	
	protected $ca_mensaje;

	
	protected $ca_continuacion;

	
	protected $ca_continuacion_dest;

	
	protected $ca_idbodega;

	
	protected $aReporte;

	
	protected $aTercero;

	
	protected $aCliente;

	
	protected $aInoMaestraSea;

	
	protected $collInoAvisosSeas;

	
	private $lastInoAvisosSeaCriteria = null;

	
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

	
	public function getOid()
	{
		return $this->oid;
	}

	
	public function getCaReferencia()
	{
		return $this->ca_referencia;
	}

	
	public function getCaIdcliente()
	{
		return $this->ca_idcliente;
	}

	
	public function getCaHbls()
	{
		return $this->ca_hbls;
	}

	
	public function getCaIdreporte()
	{
		return $this->ca_idreporte;
	}

	
	public function getCaIdproveedor()
	{
		return $this->ca_idproveedor;
	}

	
	public function getCaProveedor()
	{
		return $this->ca_proveedor;
	}

	
	public function getCaNumpiezas()
	{
		return $this->ca_numpiezas;
	}

	
	public function getCaPeso()
	{
		return $this->ca_peso;
	}

	
	public function getCaVolumen()
	{
		return $this->ca_volumen;
	}

	
	public function getCaNumorden()
	{
		return $this->ca_numorden;
	}

	
	public function getCaConfirmar()
	{
		return $this->ca_confirmar;
	}

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
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

	
	public function getCaNotaliberacion()
	{
		return $this->ca_notaliberacion;
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

	
	public function getCaFchliberado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchliberado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchliberado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchliberado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuliberado()
	{
		return $this->ca_usuliberado;
	}

	
	public function getCaMensaje()
	{
		return $this->ca_mensaje;
	}

	
	public function getCaContinuacion()
	{
		return $this->ca_continuacion;
	}

	
	public function getCaContinuacionDest()
	{
		return $this->ca_continuacion_dest;
	}

	
	public function getCaIdbodega()
	{
		return $this->ca_idbodega;
	}

	
	public function setOid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::OID;
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
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_REFERENCIA;
		}

		if ($this->aInoMaestraSea !== null && $this->aInoMaestraSea->getCaReferencia() !== $v) {
			$this->aInoMaestraSea = null;
		}

		return $this;
	} 
	
	public function setCaIdcliente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcliente !== $v) {
			$this->ca_idcliente = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_IDCLIENTE;
		}

		if ($this->aCliente !== null && $this->aCliente->getCaIdcliente() !== $v) {
			$this->aCliente = null;
		}

		return $this;
	} 
	
	public function setCaHbls($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_hbls !== $v) {
			$this->ca_hbls = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_HBLS;
		}

		return $this;
	} 
	
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} 
	
	public function setCaIdproveedor($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproveedor !== $v) {
			$this->ca_idproveedor = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_IDPROVEEDOR;
		}

		if ($this->aTercero !== null && $this->aTercero->getCaIdtercero() !== $v) {
			$this->aTercero = null;
		}

		return $this;
	} 
	
	public function setCaProveedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_proveedor !== $v) {
			$this->ca_proveedor = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_PROVEEDOR;
		}

		return $this;
	} 
	
	public function setCaNumpiezas($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_numpiezas !== $v) {
			$this->ca_numpiezas = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_NUMPIEZAS;
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
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_PESO;
		}

		return $this;
	} 
	
	public function setCaVolumen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_volumen !== $v) {
			$this->ca_volumen = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_VOLUMEN;
		}

		return $this;
	} 
	
	public function setCaNumorden($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_numorden !== $v) {
			$this->ca_numorden = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_NUMORDEN;
		}

		return $this;
	} 
	
	public function setCaConfirmar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_confirmar !== $v) {
			$this->ca_confirmar = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_CONFIRMAR;
		}

		return $this;
	} 
	
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_LOGIN;
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
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = InoClientesSeaPeer::CA_FCHLIBERACION;
			}
		} 
		return $this;
	} 
	
	public function setCaNotaliberacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_notaliberacion !== $v) {
			$this->ca_notaliberacion = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_NOTALIBERACION;
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
				$this->modifiedColumns[] = InoClientesSeaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = InoClientesSeaPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaFchliberado($v)
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

		if ( $this->ca_fchliberado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchliberado !== null && $tmpDt = new DateTime($this->ca_fchliberado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchliberado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = InoClientesSeaPeer::CA_FCHLIBERADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuliberado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuliberado !== $v) {
			$this->ca_usuliberado = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_USULIBERADO;
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
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_MENSAJE;
		}

		return $this;
	} 
	
	public function setCaContinuacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_continuacion !== $v) {
			$this->ca_continuacion = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_CONTINUACION;
		}

		return $this;
	} 
	
	public function setCaContinuacionDest($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_continuacion_dest !== $v) {
			$this->ca_continuacion_dest = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_CONTINUACION_DEST;
		}

		return $this;
	} 
	
	public function setCaIdbodega($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idbodega !== $v) {
			$this->ca_idbodega = $v;
			$this->modifiedColumns[] = InoClientesSeaPeer::CA_IDBODEGA;
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

			$this->oid = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_referencia = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_idcliente = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_hbls = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idreporte = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_idproveedor = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->ca_proveedor = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_numpiezas = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_peso = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_volumen = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_numorden = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_confirmar = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_login = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_observaciones = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_fchliberacion = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_notaliberacion = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_fchcreado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_usucreado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_fchactualizado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->ca_usuactualizado = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->ca_fchliberado = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->ca_usuliberado = ($row[$startcol + 21] !== null) ? (string) $row[$startcol + 21] : null;
			$this->ca_mensaje = ($row[$startcol + 22] !== null) ? (string) $row[$startcol + 22] : null;
			$this->ca_continuacion = ($row[$startcol + 23] !== null) ? (string) $row[$startcol + 23] : null;
			$this->ca_continuacion_dest = ($row[$startcol + 24] !== null) ? (string) $row[$startcol + 24] : null;
			$this->ca_idbodega = ($row[$startcol + 25] !== null) ? (int) $row[$startcol + 25] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 26; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InoClientesSea object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aInoMaestraSea !== null && $this->ca_referencia !== $this->aInoMaestraSea->getCaReferencia()) {
			$this->aInoMaestraSea = null;
		}
		if ($this->aCliente !== null && $this->ca_idcliente !== $this->aCliente->getCaIdcliente()) {
			$this->aCliente = null;
		}
		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
		}
		if ($this->aTercero !== null && $this->ca_idproveedor !== $this->aTercero->getCaIdtercero()) {
			$this->aTercero = null;
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
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = InoClientesSeaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aReporte = null;
			$this->aTercero = null;
			$this->aCliente = null;
			$this->aInoMaestraSea = null;
			$this->collInoAvisosSeas = null;
			$this->lastInoAvisosSeaCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoClientesSea:delete:pre') as $callable)
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
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoClientesSeaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInoClientesSea:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoClientesSea:save:pre') as $callable)
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
			$con = Propel::getConnection(InoClientesSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInoClientesSea:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			InoClientesSeaPeer::addInstanceToPool($this);
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

												
			if ($this->aReporte !== null) {
				if ($this->aReporte->isModified() || $this->aReporte->isNew()) {
					$affectedRows += $this->aReporte->save($con);
				}
				$this->setReporte($this->aReporte);
			}

			if ($this->aTercero !== null) {
				if ($this->aTercero->isModified() || $this->aTercero->isNew()) {
					$affectedRows += $this->aTercero->save($con);
				}
				$this->setTercero($this->aTercero);
			}

			if ($this->aCliente !== null) {
				if ($this->aCliente->isModified() || $this->aCliente->isNew()) {
					$affectedRows += $this->aCliente->save($con);
				}
				$this->setCliente($this->aCliente);
			}

			if ($this->aInoMaestraSea !== null) {
				if ($this->aInoMaestraSea->isModified() || $this->aInoMaestraSea->isNew()) {
					$affectedRows += $this->aInoMaestraSea->save($con);
				}
				$this->setInoMaestraSea($this->aInoMaestraSea);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoClientesSeaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InoClientesSeaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collInoAvisosSeas !== null) {
				foreach ($this->collInoAvisosSeas as $referrerFK) {
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


												
			if ($this->aReporte !== null) {
				if (!$this->aReporte->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aReporte->getValidationFailures());
				}
			}

			if ($this->aTercero !== null) {
				if (!$this->aTercero->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTercero->getValidationFailures());
				}
			}

			if ($this->aCliente !== null) {
				if (!$this->aCliente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCliente->getValidationFailures());
				}
			}

			if ($this->aInoMaestraSea !== null) {
				if (!$this->aInoMaestraSea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoMaestraSea->getValidationFailures());
				}
			}


			if (($retval = InoClientesSeaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collInoAvisosSeas !== null) {
					foreach ($this->collInoAvisosSeas as $referrerFK) {
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
		$pos = InoClientesSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getOid();
				break;
			case 1:
				return $this->getCaReferencia();
				break;
			case 2:
				return $this->getCaIdcliente();
				break;
			case 3:
				return $this->getCaHbls();
				break;
			case 4:
				return $this->getCaIdreporte();
				break;
			case 5:
				return $this->getCaIdproveedor();
				break;
			case 6:
				return $this->getCaProveedor();
				break;
			case 7:
				return $this->getCaNumpiezas();
				break;
			case 8:
				return $this->getCaPeso();
				break;
			case 9:
				return $this->getCaVolumen();
				break;
			case 10:
				return $this->getCaNumorden();
				break;
			case 11:
				return $this->getCaConfirmar();
				break;
			case 12:
				return $this->getCaLogin();
				break;
			case 13:
				return $this->getCaObservaciones();
				break;
			case 14:
				return $this->getCaFchliberacion();
				break;
			case 15:
				return $this->getCaNotaliberacion();
				break;
			case 16:
				return $this->getCaFchcreado();
				break;
			case 17:
				return $this->getCaUsucreado();
				break;
			case 18:
				return $this->getCaFchactualizado();
				break;
			case 19:
				return $this->getCaUsuactualizado();
				break;
			case 20:
				return $this->getCaFchliberado();
				break;
			case 21:
				return $this->getCaUsuliberado();
				break;
			case 22:
				return $this->getCaMensaje();
				break;
			case 23:
				return $this->getCaContinuacion();
				break;
			case 24:
				return $this->getCaContinuacionDest();
				break;
			case 25:
				return $this->getCaIdbodega();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = InoClientesSeaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaReferencia(),
			$keys[2] => $this->getCaIdcliente(),
			$keys[3] => $this->getCaHbls(),
			$keys[4] => $this->getCaIdreporte(),
			$keys[5] => $this->getCaIdproveedor(),
			$keys[6] => $this->getCaProveedor(),
			$keys[7] => $this->getCaNumpiezas(),
			$keys[8] => $this->getCaPeso(),
			$keys[9] => $this->getCaVolumen(),
			$keys[10] => $this->getCaNumorden(),
			$keys[11] => $this->getCaConfirmar(),
			$keys[12] => $this->getCaLogin(),
			$keys[13] => $this->getCaObservaciones(),
			$keys[14] => $this->getCaFchliberacion(),
			$keys[15] => $this->getCaNotaliberacion(),
			$keys[16] => $this->getCaFchcreado(),
			$keys[17] => $this->getCaUsucreado(),
			$keys[18] => $this->getCaFchactualizado(),
			$keys[19] => $this->getCaUsuactualizado(),
			$keys[20] => $this->getCaFchliberado(),
			$keys[21] => $this->getCaUsuliberado(),
			$keys[22] => $this->getCaMensaje(),
			$keys[23] => $this->getCaContinuacion(),
			$keys[24] => $this->getCaContinuacionDest(),
			$keys[25] => $this->getCaIdbodega(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoClientesSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setOid($value);
				break;
			case 1:
				$this->setCaReferencia($value);
				break;
			case 2:
				$this->setCaIdcliente($value);
				break;
			case 3:
				$this->setCaHbls($value);
				break;
			case 4:
				$this->setCaIdreporte($value);
				break;
			case 5:
				$this->setCaIdproveedor($value);
				break;
			case 6:
				$this->setCaProveedor($value);
				break;
			case 7:
				$this->setCaNumpiezas($value);
				break;
			case 8:
				$this->setCaPeso($value);
				break;
			case 9:
				$this->setCaVolumen($value);
				break;
			case 10:
				$this->setCaNumorden($value);
				break;
			case 11:
				$this->setCaConfirmar($value);
				break;
			case 12:
				$this->setCaLogin($value);
				break;
			case 13:
				$this->setCaObservaciones($value);
				break;
			case 14:
				$this->setCaFchliberacion($value);
				break;
			case 15:
				$this->setCaNotaliberacion($value);
				break;
			case 16:
				$this->setCaFchcreado($value);
				break;
			case 17:
				$this->setCaUsucreado($value);
				break;
			case 18:
				$this->setCaFchactualizado($value);
				break;
			case 19:
				$this->setCaUsuactualizado($value);
				break;
			case 20:
				$this->setCaFchliberado($value);
				break;
			case 21:
				$this->setCaUsuliberado($value);
				break;
			case 22:
				$this->setCaMensaje($value);
				break;
			case 23:
				$this->setCaContinuacion($value);
				break;
			case 24:
				$this->setCaContinuacionDest($value);
				break;
			case 25:
				$this->setCaIdbodega($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoClientesSeaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaReferencia($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdcliente($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaHbls($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdreporte($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdproveedor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaProveedor($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaNumpiezas($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaPeso($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaVolumen($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaNumorden($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaConfirmar($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaLogin($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaObservaciones($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaFchliberacion($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaNotaliberacion($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchcreado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsucreado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaFchactualizado($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCaUsuactualizado($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setCaFchliberado($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCaUsuliberado($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setCaMensaje($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCaContinuacion($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCaContinuacionDest($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setCaIdbodega($arr[$keys[25]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoClientesSeaPeer::OID)) $criteria->add(InoClientesSeaPeer::OID, $this->oid);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_REFERENCIA)) $criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_IDCLIENTE)) $criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_HBLS)) $criteria->add(InoClientesSeaPeer::CA_HBLS, $this->ca_hbls);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_IDREPORTE)) $criteria->add(InoClientesSeaPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_IDPROVEEDOR)) $criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idproveedor);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_PROVEEDOR)) $criteria->add(InoClientesSeaPeer::CA_PROVEEDOR, $this->ca_proveedor);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_NUMPIEZAS)) $criteria->add(InoClientesSeaPeer::CA_NUMPIEZAS, $this->ca_numpiezas);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_PESO)) $criteria->add(InoClientesSeaPeer::CA_PESO, $this->ca_peso);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_VOLUMEN)) $criteria->add(InoClientesSeaPeer::CA_VOLUMEN, $this->ca_volumen);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_NUMORDEN)) $criteria->add(InoClientesSeaPeer::CA_NUMORDEN, $this->ca_numorden);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_CONFIRMAR)) $criteria->add(InoClientesSeaPeer::CA_CONFIRMAR, $this->ca_confirmar);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_LOGIN)) $criteria->add(InoClientesSeaPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_OBSERVACIONES)) $criteria->add(InoClientesSeaPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_FCHLIBERACION)) $criteria->add(InoClientesSeaPeer::CA_FCHLIBERACION, $this->ca_fchliberacion);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_NOTALIBERACION)) $criteria->add(InoClientesSeaPeer::CA_NOTALIBERACION, $this->ca_notaliberacion);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_FCHCREADO)) $criteria->add(InoClientesSeaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_USUCREADO)) $criteria->add(InoClientesSeaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_FCHACTUALIZADO)) $criteria->add(InoClientesSeaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_USUACTUALIZADO)) $criteria->add(InoClientesSeaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_FCHLIBERADO)) $criteria->add(InoClientesSeaPeer::CA_FCHLIBERADO, $this->ca_fchliberado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_USULIBERADO)) $criteria->add(InoClientesSeaPeer::CA_USULIBERADO, $this->ca_usuliberado);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_MENSAJE)) $criteria->add(InoClientesSeaPeer::CA_MENSAJE, $this->ca_mensaje);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_CONTINUACION)) $criteria->add(InoClientesSeaPeer::CA_CONTINUACION, $this->ca_continuacion);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_CONTINUACION_DEST)) $criteria->add(InoClientesSeaPeer::CA_CONTINUACION_DEST, $this->ca_continuacion_dest);
		if ($this->isColumnModified(InoClientesSeaPeer::CA_IDBODEGA)) $criteria->add(InoClientesSeaPeer::CA_IDBODEGA, $this->ca_idbodega);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);

		$criteria->add(InoClientesSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoClientesSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);
		$criteria->add(InoClientesSeaPeer::CA_HBLS, $this->ca_hbls);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaReferencia();

		$pks[1] = $this->getCaIdcliente();

		$pks[2] = $this->getCaHbls();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaReferencia($keys[0]);

		$this->setCaIdcliente($keys[1]);

		$this->setCaHbls($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOid($this->oid);

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaIdcliente($this->ca_idcliente);

		$copyObj->setCaHbls($this->ca_hbls);

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdproveedor($this->ca_idproveedor);

		$copyObj->setCaProveedor($this->ca_proveedor);

		$copyObj->setCaNumpiezas($this->ca_numpiezas);

		$copyObj->setCaPeso($this->ca_peso);

		$copyObj->setCaVolumen($this->ca_volumen);

		$copyObj->setCaNumorden($this->ca_numorden);

		$copyObj->setCaConfirmar($this->ca_confirmar);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchliberacion($this->ca_fchliberacion);

		$copyObj->setCaNotaliberacion($this->ca_notaliberacion);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaFchliberado($this->ca_fchliberado);

		$copyObj->setCaUsuliberado($this->ca_usuliberado);

		$copyObj->setCaMensaje($this->ca_mensaje);

		$copyObj->setCaContinuacion($this->ca_continuacion);

		$copyObj->setCaContinuacionDest($this->ca_continuacion_dest);

		$copyObj->setCaIdbodega($this->ca_idbodega);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getInoAvisosSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoAvisosSea($relObj->copy($deepCopy));
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
			self::$peer = new InoClientesSeaPeer();
		}
		return self::$peer;
	}

	
	public function setReporte(Reporte $v = null)
	{
		if ($v === null) {
			$this->setCaIdreporte(NULL);
		} else {
			$this->setCaIdreporte($v->getCaIdreporte());
		}

		$this->aReporte = $v;

						if ($v !== null) {
			$v->addInoClientesSea($this);
		}

		return $this;
	}


	
	public function getReporte(PropelPDO $con = null)
	{
		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
			
		}
		return $this->aReporte;
	}

	
	public function setTercero(Tercero $v = null)
	{
		if ($v === null) {
			$this->setCaIdproveedor(NULL);
		} else {
			$this->setCaIdproveedor($v->getCaIdtercero());
		}

		$this->aTercero = $v;

						if ($v !== null) {
			$v->addInoClientesSea($this);
		}

		return $this;
	}


	
	public function getTercero(PropelPDO $con = null)
	{
		if ($this->aTercero === null && ($this->ca_idproveedor !== null)) {
			$c = new Criteria(TerceroPeer::DATABASE_NAME);
			$c->add(TerceroPeer::CA_IDTERCERO, $this->ca_idproveedor);
			$this->aTercero = TerceroPeer::doSelectOne($c, $con);
			
		}
		return $this->aTercero;
	}

	
	public function setCliente(Cliente $v = null)
	{
		if ($v === null) {
			$this->setCaIdcliente(NULL);
		} else {
			$this->setCaIdcliente($v->getCaIdcliente());
		}

		$this->aCliente = $v;

						if ($v !== null) {
			$v->addInoClientesSea($this);
		}

		return $this;
	}


	
	public function getCliente(PropelPDO $con = null)
	{
		if ($this->aCliente === null && ($this->ca_idcliente !== null)) {
			$c = new Criteria(ClientePeer::DATABASE_NAME);
			$c->add(ClientePeer::CA_IDCLIENTE, $this->ca_idcliente);
			$this->aCliente = ClientePeer::doSelectOne($c, $con);
			
		}
		return $this->aCliente;
	}

	
	public function setInoMaestraSea(InoMaestraSea $v = null)
	{
		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}

		$this->aInoMaestraSea = $v;

						if ($v !== null) {
			$v->addInoClientesSea($this);
		}

		return $this;
	}


	
	public function getInoMaestraSea(PropelPDO $con = null)
	{
		if ($this->aInoMaestraSea === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null))) {
			$c = new Criteria(InoMaestraSeaPeer::DATABASE_NAME);
			$c->add(InoMaestraSeaPeer::CA_REFERENCIA, $this->ca_referencia);
			$this->aInoMaestraSea = InoMaestraSeaPeer::doSelectOne($c, $con);
			
		}
		return $this->aInoMaestraSea;
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
			$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);
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

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);

				InoAvisosSeaPeer::addSelectColumns($criteria);
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);


				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);


				$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);

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
			$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);
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

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);

				$count = InoAvisosSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);


				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);


				$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);

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
			$l->setInoClientesSea($this);
		}
	}


	
	public function getInoAvisosSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);
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

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}


	
	public function getInoAvisosSeasJoinCliente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);
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

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);

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
			$criteria = new Criteria(InoClientesSeaPeer::DATABASE_NAME);
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

				$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

				$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);

				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoAvisosSeaPeer::CA_REFERENCIA, $this->ca_referencia);

			$criteria->add(InoAvisosSeaPeer::CA_IDCLIENTE, $this->ca_idcliente);

			$criteria->add(InoAvisosSeaPeer::CA_HBLS, $this->ca_hbls);

			if (!isset($this->lastInoAvisosSeaCriteria) || !$this->lastInoAvisosSeaCriteria->equals($criteria)) {
				$this->collInoAvisosSeas = InoAvisosSeaPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoAvisosSeaCriteria = $criteria;

		return $this->collInoAvisosSeas;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collInoAvisosSeas) {
				foreach ((array) $this->collInoAvisosSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collInoAvisosSeas = null;
			$this->aReporte = null;
			$this->aTercero = null;
			$this->aCliente = null;
			$this->aInoMaestraSea = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInoClientesSea:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInoClientesSea::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 