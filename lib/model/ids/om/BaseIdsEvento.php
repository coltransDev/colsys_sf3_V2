<?php


abstract class BaseIdsEvento extends BaseObject  implements Persistent {


  const PEER = 'IdsEventoPeer';

	
	protected static $peer;

	
	protected $ca_idevento;

	
	protected $ca_id;

	
	protected $ca_evento;

	
	protected $ca_referencia;

	
	protected $ca_tipo;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $aIds;

	
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

	
	public function getCaIdevento()
	{
		return $this->ca_idevento;
	}

	
	public function getCaId()
	{
		return $this->ca_id;
	}

	
	public function getCaEvento()
	{
		return $this->ca_evento;
	}

	
	public function getCaReferencia()
	{
		return $this->ca_referencia;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
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

	
	public function setCaIdevento($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idevento !== $v) {
			$this->ca_idevento = $v;
			$this->modifiedColumns[] = IdsEventoPeer::CA_IDEVENTO;
		}

		return $this;
	} 
	
	public function setCaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_id !== $v) {
			$this->ca_id = $v;
			$this->modifiedColumns[] = IdsEventoPeer::CA_ID;
		}

		if ($this->aIds !== null && $this->aIds->getCaId() !== $v) {
			$this->aIds = null;
		}

		return $this;
	} 
	
	public function setCaEvento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_evento !== $v) {
			$this->ca_evento = $v;
			$this->modifiedColumns[] = IdsEventoPeer::CA_EVENTO;
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
			$this->modifiedColumns[] = IdsEventoPeer::CA_REFERENCIA;
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
			$this->modifiedColumns[] = IdsEventoPeer::CA_TIPO;
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
				$this->modifiedColumns[] = IdsEventoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = IdsEventoPeer::CA_USUCREADO;
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

			$this->ca_idevento = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_evento = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_referencia = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_tipo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchcreado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_usucreado = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsEvento object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aIds !== null && $this->ca_id !== $this->aIds->getCaId()) {
			$this->aIds = null;
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
			$con = Propel::getConnection(IdsEventoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsEventoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aIds = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvento:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsEventoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsEventoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsEvento:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvento:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsEventoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsEvento:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsEventoPeer::addInstanceToPool($this);
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

												
			if ($this->aIds !== null) {
				if ($this->aIds->isModified() || $this->aIds->isNew()) {
					$affectedRows += $this->aIds->save($con);
				}
				$this->setIds($this->aIds);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = IdsEventoPeer::CA_IDEVENTO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsEventoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdevento($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += IdsEventoPeer::doUpdate($this, $con);
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


												
			if ($this->aIds !== null) {
				if (!$this->aIds->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIds->getValidationFailures());
				}
			}


			if (($retval = IdsEventoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsEventoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdevento();
				break;
			case 1:
				return $this->getCaId();
				break;
			case 2:
				return $this->getCaEvento();
				break;
			case 3:
				return $this->getCaReferencia();
				break;
			case 4:
				return $this->getCaTipo();
				break;
			case 5:
				return $this->getCaFchcreado();
				break;
			case 6:
				return $this->getCaUsucreado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsEventoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdevento(),
			$keys[1] => $this->getCaId(),
			$keys[2] => $this->getCaEvento(),
			$keys[3] => $this->getCaReferencia(),
			$keys[4] => $this->getCaTipo(),
			$keys[5] => $this->getCaFchcreado(),
			$keys[6] => $this->getCaUsucreado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsEventoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdevento($value);
				break;
			case 1:
				$this->setCaId($value);
				break;
			case 2:
				$this->setCaEvento($value);
				break;
			case 3:
				$this->setCaReferencia($value);
				break;
			case 4:
				$this->setCaTipo($value);
				break;
			case 5:
				$this->setCaFchcreado($value);
				break;
			case 6:
				$this->setCaUsucreado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsEventoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdevento($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaEvento($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaReferencia($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTipo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchcreado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUsucreado($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsEventoPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsEventoPeer::CA_IDEVENTO)) $criteria->add(IdsEventoPeer::CA_IDEVENTO, $this->ca_idevento);
		if ($this->isColumnModified(IdsEventoPeer::CA_ID)) $criteria->add(IdsEventoPeer::CA_ID, $this->ca_id);
		if ($this->isColumnModified(IdsEventoPeer::CA_EVENTO)) $criteria->add(IdsEventoPeer::CA_EVENTO, $this->ca_evento);
		if ($this->isColumnModified(IdsEventoPeer::CA_REFERENCIA)) $criteria->add(IdsEventoPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(IdsEventoPeer::CA_TIPO)) $criteria->add(IdsEventoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(IdsEventoPeer::CA_FCHCREADO)) $criteria->add(IdsEventoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(IdsEventoPeer::CA_USUCREADO)) $criteria->add(IdsEventoPeer::CA_USUCREADO, $this->ca_usucreado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsEventoPeer::DATABASE_NAME);

		$criteria->add(IdsEventoPeer::CA_IDEVENTO, $this->ca_idevento);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdevento();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdevento($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaId($this->ca_id);

		$copyObj->setCaEvento($this->ca_evento);

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);


		$copyObj->setNew(true);

		$copyObj->setCaIdevento(NULL); 
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
			self::$peer = new IdsEventoPeer();
		}
		return self::$peer;
	}

	
	public function setIds(Ids $v = null)
	{
		if ($v === null) {
			$this->setCaId(NULL);
		} else {
			$this->setCaId($v->getCaId());
		}

		$this->aIds = $v;

						if ($v !== null) {
			$v->addIdsEvento($this);
		}

		return $this;
	}


	
	public function getIds(PropelPDO $con = null)
	{
		if ($this->aIds === null && ($this->ca_id !== null)) {
			$c = new Criteria(IdsPeer::DATABASE_NAME);
			$c->add(IdsPeer::CA_ID, $this->ca_id);
			$this->aIds = IdsPeer::doSelectOne($c, $con);
			
		}
		return $this->aIds;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aIds = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIdsEvento:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsEvento::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 