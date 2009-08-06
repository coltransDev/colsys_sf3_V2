<?php


abstract class BasePricRecargoParametro extends BaseObject  implements Persistent {


  const PEER = 'PricRecargoParametroPeer';

	
	protected static $peer;

	
	protected $ca_idlinea;

	
	protected $ca_transporte;

	
	protected $ca_modalidad;

	
	protected $ca_impoexpo;

	
	protected $ca_concepto;

	
	protected $ca_valor;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $aTransportador;

	
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

	
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaConcepto()
	{
		return $this->ca_concepto;
	}

	
	public function getCaValor()
	{
		return $this->ca_valor;
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

	
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = PricRecargoParametroPeer::CA_IDLINEA;
		}

		if ($this->aTransportador !== null && $this->aTransportador->getCaIdlinea() !== $v) {
			$this->aTransportador = null;
		}

		return $this;
	} 
	
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = PricRecargoParametroPeer::CA_TRANSPORTE;
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
			$this->modifiedColumns[] = PricRecargoParametroPeer::CA_MODALIDAD;
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
			$this->modifiedColumns[] = PricRecargoParametroPeer::CA_IMPOEXPO;
		}

		return $this;
	} 
	
	public function setCaConcepto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_concepto !== $v) {
			$this->ca_concepto = $v;
			$this->modifiedColumns[] = PricRecargoParametroPeer::CA_CONCEPTO;
		}

		return $this;
	} 
	
	public function setCaValor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor !== $v) {
			$this->ca_valor = $v;
			$this->modifiedColumns[] = PricRecargoParametroPeer::CA_VALOR;
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
			$this->modifiedColumns[] = PricRecargoParametroPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = PricRecargoParametroPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricRecargoParametroPeer::CA_USUCREADO;
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

			$this->ca_idlinea = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_transporte = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_modalidad = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_impoexpo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_concepto = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_valor = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_observaciones = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchcreado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usucreado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PricRecargoParametro object", $e);
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
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PricRecargoParametroPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTransportador = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargoParametro:delete:pre') as $callable)
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
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricRecargoParametroPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePricRecargoParametro:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargoParametro:save:pre') as $callable)
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
			$con = Propel::getConnection(PricRecargoParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePricRecargoParametro:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PricRecargoParametroPeer::addInstanceToPool($this);
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
					$pk = PricRecargoParametroPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PricRecargoParametroPeer::doUpdate($this, $con);
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


												
			if ($this->aTransportador !== null) {
				if (!$this->aTransportador->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportador->getValidationFailures());
				}
			}


			if (($retval = PricRecargoParametroPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricRecargoParametroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdlinea();
				break;
			case 1:
				return $this->getCaTransporte();
				break;
			case 2:
				return $this->getCaModalidad();
				break;
			case 3:
				return $this->getCaImpoexpo();
				break;
			case 4:
				return $this->getCaConcepto();
				break;
			case 5:
				return $this->getCaValor();
				break;
			case 6:
				return $this->getCaObservaciones();
				break;
			case 7:
				return $this->getCaFchcreado();
				break;
			case 8:
				return $this->getCaUsucreado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PricRecargoParametroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdlinea(),
			$keys[1] => $this->getCaTransporte(),
			$keys[2] => $this->getCaModalidad(),
			$keys[3] => $this->getCaImpoexpo(),
			$keys[4] => $this->getCaConcepto(),
			$keys[5] => $this->getCaValor(),
			$keys[6] => $this->getCaObservaciones(),
			$keys[7] => $this->getCaFchcreado(),
			$keys[8] => $this->getCaUsucreado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricRecargoParametroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdlinea($value);
				break;
			case 1:
				$this->setCaTransporte($value);
				break;
			case 2:
				$this->setCaModalidad($value);
				break;
			case 3:
				$this->setCaImpoexpo($value);
				break;
			case 4:
				$this->setCaConcepto($value);
				break;
			case 5:
				$this->setCaValor($value);
				break;
			case 6:
				$this->setCaObservaciones($value);
				break;
			case 7:
				$this->setCaFchcreado($value);
				break;
			case 8:
				$this->setCaUsucreado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PricRecargoParametroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdlinea($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaTransporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaModalidad($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaImpoexpo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaConcepto($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaValor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObservaciones($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchcreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsucreado($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PricRecargoParametroPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricRecargoParametroPeer::CA_IDLINEA)) $criteria->add(PricRecargoParametroPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(PricRecargoParametroPeer::CA_TRANSPORTE)) $criteria->add(PricRecargoParametroPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(PricRecargoParametroPeer::CA_MODALIDAD)) $criteria->add(PricRecargoParametroPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(PricRecargoParametroPeer::CA_IMPOEXPO)) $criteria->add(PricRecargoParametroPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(PricRecargoParametroPeer::CA_CONCEPTO)) $criteria->add(PricRecargoParametroPeer::CA_CONCEPTO, $this->ca_concepto);
		if ($this->isColumnModified(PricRecargoParametroPeer::CA_VALOR)) $criteria->add(PricRecargoParametroPeer::CA_VALOR, $this->ca_valor);
		if ($this->isColumnModified(PricRecargoParametroPeer::CA_OBSERVACIONES)) $criteria->add(PricRecargoParametroPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(PricRecargoParametroPeer::CA_FCHCREADO)) $criteria->add(PricRecargoParametroPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricRecargoParametroPeer::CA_USUCREADO)) $criteria->add(PricRecargoParametroPeer::CA_USUCREADO, $this->ca_usucreado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PricRecargoParametroPeer::DATABASE_NAME);

		$criteria->add(PricRecargoParametroPeer::CA_IDLINEA, $this->ca_idlinea);
		$criteria->add(PricRecargoParametroPeer::CA_TRANSPORTE, $this->ca_transporte);
		$criteria->add(PricRecargoParametroPeer::CA_MODALIDAD, $this->ca_modalidad);
		$criteria->add(PricRecargoParametroPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		$criteria->add(PricRecargoParametroPeer::CA_CONCEPTO, $this->ca_concepto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdlinea();

		$pks[1] = $this->getCaTransporte();

		$pks[2] = $this->getCaModalidad();

		$pks[3] = $this->getCaImpoexpo();

		$pks[4] = $this->getCaConcepto();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdlinea($keys[0]);

		$this->setCaTransporte($keys[1]);

		$this->setCaModalidad($keys[2]);

		$this->setCaImpoexpo($keys[3]);

		$this->setCaConcepto($keys[4]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdlinea($this->ca_idlinea);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaConcepto($this->ca_concepto);

		$copyObj->setCaValor($this->ca_valor);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);


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
			self::$peer = new PricRecargoParametroPeer();
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
			$v->addPricRecargoParametro($this);
		}

		return $this;
	}


	
	public function getTransportador(PropelPDO $con = null)
	{
		if ($this->aTransportador === null && (($this->ca_idlinea !== "" && $this->ca_idlinea !== null))) {
			$c = new Criteria(TransportadorPeer::DATABASE_NAME);
			$c->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
			$this->aTransportador = TransportadorPeer::doSelectOne($c, $con);
			
		}
		return $this->aTransportador;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aTransportador = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePricRecargoParametro:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePricRecargoParametro::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 