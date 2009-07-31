<?php


abstract class BaseCotContinuacion extends BaseObject  implements Persistent {


  const PEER = 'CotContinuacionPeer';

	
	protected static $peer;

	
	protected $ca_idcontinuacion;

	
	protected $ca_idcotizacion;

	
	protected $ca_tipo;

	
	protected $ca_modalidad;

	
	protected $ca_origen;

	
	protected $ca_destino;

	
	protected $ca_idconcepto;

	
	protected $ca_idmoneda;

	
	protected $ca_idequipo;

	
	protected $ca_tarifa;

	
	protected $ca_valor_tar;

	
	protected $ca_valor_min;

	
	protected $ca_frecuencia;

	
	protected $ca_tiempotransito;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $aCotizacion;

	
	protected $aConcepto;

	
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

	
	public function getCaIdcontinuacion()
	{
		return $this->ca_idcontinuacion;
	}

	
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaOrigen()
	{
		return $this->ca_origen;
	}

	
	public function getCaDestino()
	{
		return $this->ca_destino;
	}

	
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaIdequipo()
	{
		return $this->ca_idequipo;
	}

	
	public function getCaTarifa()
	{
		return $this->ca_tarifa;
	}

	
	public function getCaValorTar()
	{
		return $this->ca_valor_tar;
	}

	
	public function getCaValorMin()
	{
		return $this->ca_valor_min;
	}

	
	public function getCaFrecuencia()
	{
		return $this->ca_frecuencia;
	}

	
	public function getCaTiempotransito()
	{
		return $this->ca_tiempotransito;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
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

	
	public function setCaIdcontinuacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcontinuacion !== $v) {
			$this->ca_idcontinuacion = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_IDCONTINUACION;
		}

		return $this;
	} 
	
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_IDCOTIZACION;
		}

		if ($this->aCotizacion !== null && $this->aCotizacion->getCaIdcotizacion() !== $v) {
			$this->aCotizacion = null;
		}

		return $this;
	} 
	
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_TIPO;
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
			$this->modifiedColumns[] = CotContinuacionPeer::CA_MODALIDAD;
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
			$this->modifiedColumns[] = CotContinuacionPeer::CA_ORIGEN;
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
			$this->modifiedColumns[] = CotContinuacionPeer::CA_DESTINO;
		}

		return $this;
	} 
	
	public function setCaIdconcepto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
		}

		return $this;
	} 
	
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_IDMONEDA;
		}

		return $this;
	} 
	
	public function setCaIdequipo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idequipo !== $v) {
			$this->ca_idequipo = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_IDEQUIPO;
		}

		return $this;
	} 
	
	public function setCaTarifa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tarifa !== $v) {
			$this->ca_tarifa = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_TARIFA;
		}

		return $this;
	} 
	
	public function setCaValorTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor_tar !== $v) {
			$this->ca_valor_tar = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_VALOR_TAR;
		}

		return $this;
	} 
	
	public function setCaValorMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor_min !== $v) {
			$this->ca_valor_min = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_VALOR_MIN;
		}

		return $this;
	} 
	
	public function setCaFrecuencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_frecuencia !== $v) {
			$this->ca_frecuencia = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_FRECUENCIA;
		}

		return $this;
	} 
	
	public function setCaTiempotransito($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tiempotransito !== $v) {
			$this->ca_tiempotransito = $v;
			$this->modifiedColumns[] = CotContinuacionPeer::CA_TIEMPOTRANSITO;
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
			$this->modifiedColumns[] = CotContinuacionPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = CotContinuacionPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = CotContinuacionPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = CotContinuacionPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = CotContinuacionPeer::CA_USUACTUALIZADO;
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

			$this->ca_idcontinuacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idcotizacion = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_tipo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_modalidad = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_origen = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_destino = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_idconcepto = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
			$this->ca_idmoneda = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_idequipo = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->ca_tarifa = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_valor_tar = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_valor_min = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_frecuencia = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_tiempotransito = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_observaciones = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchcreado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_usucreado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_fchactualizado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->ca_usuactualizado = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CotContinuacion object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCotizacion !== null && $this->ca_idcotizacion !== $this->aCotizacion->getCaIdcotizacion()) {
			$this->aCotizacion = null;
		}
		if ($this->aConcepto !== null && $this->ca_idconcepto !== $this->aConcepto->getCaIdconcepto()) {
			$this->aConcepto = null;
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
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CotContinuacionPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCotizacion = null;
			$this->aConcepto = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotContinuacion:delete:pre') as $callable)
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
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotContinuacionPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCotContinuacion:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotContinuacion:save:pre') as $callable)
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
			$con = Propel::getConnection(CotContinuacionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCotContinuacion:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			CotContinuacionPeer::addInstanceToPool($this);
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

												
			if ($this->aCotizacion !== null) {
				if ($this->aCotizacion->isModified() || $this->aCotizacion->isNew()) {
					$affectedRows += $this->aCotizacion->save($con);
				}
				$this->setCotizacion($this->aCotizacion);
			}

			if ($this->aConcepto !== null) {
				if ($this->aConcepto->isModified() || $this->aConcepto->isNew()) {
					$affectedRows += $this->aConcepto->save($con);
				}
				$this->setConcepto($this->aConcepto);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CotContinuacionPeer::CA_IDCONTINUACION;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotContinuacionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdcontinuacion($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CotContinuacionPeer::doUpdate($this, $con);
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


												
			if ($this->aCotizacion !== null) {
				if (!$this->aCotizacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotizacion->getValidationFailures());
				}
			}

			if ($this->aConcepto !== null) {
				if (!$this->aConcepto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcepto->getValidationFailures());
				}
			}


			if (($retval = CotContinuacionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotContinuacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdcontinuacion();
				break;
			case 1:
				return $this->getCaIdcotizacion();
				break;
			case 2:
				return $this->getCaTipo();
				break;
			case 3:
				return $this->getCaModalidad();
				break;
			case 4:
				return $this->getCaOrigen();
				break;
			case 5:
				return $this->getCaDestino();
				break;
			case 6:
				return $this->getCaIdconcepto();
				break;
			case 7:
				return $this->getCaIdmoneda();
				break;
			case 8:
				return $this->getCaIdequipo();
				break;
			case 9:
				return $this->getCaTarifa();
				break;
			case 10:
				return $this->getCaValorTar();
				break;
			case 11:
				return $this->getCaValorMin();
				break;
			case 12:
				return $this->getCaFrecuencia();
				break;
			case 13:
				return $this->getCaTiempotransito();
				break;
			case 14:
				return $this->getCaObservaciones();
				break;
			case 15:
				return $this->getCaFchcreado();
				break;
			case 16:
				return $this->getCaUsucreado();
				break;
			case 17:
				return $this->getCaFchactualizado();
				break;
			case 18:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CotContinuacionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcontinuacion(),
			$keys[1] => $this->getCaIdcotizacion(),
			$keys[2] => $this->getCaTipo(),
			$keys[3] => $this->getCaModalidad(),
			$keys[4] => $this->getCaOrigen(),
			$keys[5] => $this->getCaDestino(),
			$keys[6] => $this->getCaIdconcepto(),
			$keys[7] => $this->getCaIdmoneda(),
			$keys[8] => $this->getCaIdequipo(),
			$keys[9] => $this->getCaTarifa(),
			$keys[10] => $this->getCaValorTar(),
			$keys[11] => $this->getCaValorMin(),
			$keys[12] => $this->getCaFrecuencia(),
			$keys[13] => $this->getCaTiempotransito(),
			$keys[14] => $this->getCaObservaciones(),
			$keys[15] => $this->getCaFchcreado(),
			$keys[16] => $this->getCaUsucreado(),
			$keys[17] => $this->getCaFchactualizado(),
			$keys[18] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotContinuacionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcontinuacion($value);
				break;
			case 1:
				$this->setCaIdcotizacion($value);
				break;
			case 2:
				$this->setCaTipo($value);
				break;
			case 3:
				$this->setCaModalidad($value);
				break;
			case 4:
				$this->setCaOrigen($value);
				break;
			case 5:
				$this->setCaDestino($value);
				break;
			case 6:
				$this->setCaIdconcepto($value);
				break;
			case 7:
				$this->setCaIdmoneda($value);
				break;
			case 8:
				$this->setCaIdequipo($value);
				break;
			case 9:
				$this->setCaTarifa($value);
				break;
			case 10:
				$this->setCaValorTar($value);
				break;
			case 11:
				$this->setCaValorMin($value);
				break;
			case 12:
				$this->setCaFrecuencia($value);
				break;
			case 13:
				$this->setCaTiempotransito($value);
				break;
			case 14:
				$this->setCaObservaciones($value);
				break;
			case 15:
				$this->setCaFchcreado($value);
				break;
			case 16:
				$this->setCaUsucreado($value);
				break;
			case 17:
				$this->setCaFchactualizado($value);
				break;
			case 18:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CotContinuacionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcontinuacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcotizacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTipo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaModalidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaOrigen($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaDestino($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdconcepto($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmoneda($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaIdequipo($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaTarifa($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaValorTar($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaValorMin($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFrecuencia($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaTiempotransito($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaObservaciones($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchcreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsucreado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaFchactualizado($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setCaUsuactualizado($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CotContinuacionPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotContinuacionPeer::CA_IDCONTINUACION)) $criteria->add(CotContinuacionPeer::CA_IDCONTINUACION, $this->ca_idcontinuacion);
		if ($this->isColumnModified(CotContinuacionPeer::CA_IDCOTIZACION)) $criteria->add(CotContinuacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotContinuacionPeer::CA_TIPO)) $criteria->add(CotContinuacionPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(CotContinuacionPeer::CA_MODALIDAD)) $criteria->add(CotContinuacionPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(CotContinuacionPeer::CA_ORIGEN)) $criteria->add(CotContinuacionPeer::CA_ORIGEN, $this->ca_origen);
		if ($this->isColumnModified(CotContinuacionPeer::CA_DESTINO)) $criteria->add(CotContinuacionPeer::CA_DESTINO, $this->ca_destino);
		if ($this->isColumnModified(CotContinuacionPeer::CA_IDCONCEPTO)) $criteria->add(CotContinuacionPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(CotContinuacionPeer::CA_IDMONEDA)) $criteria->add(CotContinuacionPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(CotContinuacionPeer::CA_IDEQUIPO)) $criteria->add(CotContinuacionPeer::CA_IDEQUIPO, $this->ca_idequipo);
		if ($this->isColumnModified(CotContinuacionPeer::CA_TARIFA)) $criteria->add(CotContinuacionPeer::CA_TARIFA, $this->ca_tarifa);
		if ($this->isColumnModified(CotContinuacionPeer::CA_VALOR_TAR)) $criteria->add(CotContinuacionPeer::CA_VALOR_TAR, $this->ca_valor_tar);
		if ($this->isColumnModified(CotContinuacionPeer::CA_VALOR_MIN)) $criteria->add(CotContinuacionPeer::CA_VALOR_MIN, $this->ca_valor_min);
		if ($this->isColumnModified(CotContinuacionPeer::CA_FRECUENCIA)) $criteria->add(CotContinuacionPeer::CA_FRECUENCIA, $this->ca_frecuencia);
		if ($this->isColumnModified(CotContinuacionPeer::CA_TIEMPOTRANSITO)) $criteria->add(CotContinuacionPeer::CA_TIEMPOTRANSITO, $this->ca_tiempotransito);
		if ($this->isColumnModified(CotContinuacionPeer::CA_OBSERVACIONES)) $criteria->add(CotContinuacionPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(CotContinuacionPeer::CA_FCHCREADO)) $criteria->add(CotContinuacionPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotContinuacionPeer::CA_USUCREADO)) $criteria->add(CotContinuacionPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotContinuacionPeer::CA_FCHACTUALIZADO)) $criteria->add(CotContinuacionPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotContinuacionPeer::CA_USUACTUALIZADO)) $criteria->add(CotContinuacionPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CotContinuacionPeer::DATABASE_NAME);

		$criteria->add(CotContinuacionPeer::CA_IDCONTINUACION, $this->ca_idcontinuacion);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdcontinuacion();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdcontinuacion($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaOrigen($this->ca_origen);

		$copyObj->setCaDestino($this->ca_destino);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaIdequipo($this->ca_idequipo);

		$copyObj->setCaTarifa($this->ca_tarifa);

		$copyObj->setCaValorTar($this->ca_valor_tar);

		$copyObj->setCaValorMin($this->ca_valor_min);

		$copyObj->setCaFrecuencia($this->ca_frecuencia);

		$copyObj->setCaTiempotransito($this->ca_tiempotransito);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		$copyObj->setNew(true);

		$copyObj->setCaIdcontinuacion(NULL); 
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
			self::$peer = new CotContinuacionPeer();
		}
		return self::$peer;
	}

	
	public function setCotizacion(Cotizacion $v = null)
	{
		if ($v === null) {
			$this->setCaIdcotizacion(NULL);
		} else {
			$this->setCaIdcotizacion($v->getCaIdcotizacion());
		}

		$this->aCotizacion = $v;

						if ($v !== null) {
			$v->addCotContinuacion($this);
		}

		return $this;
	}


	
	public function getCotizacion(PropelPDO $con = null)
	{
		if ($this->aCotizacion === null && ($this->ca_idcotizacion !== null)) {
			$c = new Criteria(CotizacionPeer::DATABASE_NAME);
			$c->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
			$this->aCotizacion = CotizacionPeer::doSelectOne($c, $con);
			
		}
		return $this->aCotizacion;
	}

	
	public function setConcepto(Concepto $v = null)
	{
		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}

		$this->aConcepto = $v;

						if ($v !== null) {
			$v->addCotContinuacion($this);
		}

		return $this;
	}


	
	public function getConcepto(PropelPDO $con = null)
	{
		if ($this->aConcepto === null && ($this->ca_idconcepto !== null)) {
			$c = new Criteria(ConceptoPeer::DATABASE_NAME);
			$c->add(ConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
			$this->aConcepto = ConceptoPeer::doSelectOne($c, $con);
			
		}
		return $this->aConcepto;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aCotizacion = null;
			$this->aConcepto = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCotContinuacion:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCotContinuacion::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 