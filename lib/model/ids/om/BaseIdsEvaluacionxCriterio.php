<?php


abstract class BaseIdsEvaluacionxCriterio extends BaseObject  implements Persistent {


  const PEER = 'IdsEvaluacionxCriterioPeer';

	
	protected static $peer;

	
	protected $ca_idevaluacion;

	
	protected $ca_idcriterio;

	
	protected $ca_valor;

	
	protected $ca_ponderacion;

	
	protected $ca_observaciones;

	
	protected $aIdsEvaluacion;

	
	protected $aIdsCriterio;

	
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

	
	public function getCaIdevaluacion()
	{
		return $this->ca_idevaluacion;
	}

	
	public function getCaIdcriterio()
	{
		return $this->ca_idcriterio;
	}

	
	public function getCaValor()
	{
		return $this->ca_valor;
	}

	
	public function getCaPonderacion()
	{
		return $this->ca_ponderacion;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	
	public function setCaIdevaluacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idevaluacion !== $v) {
			$this->ca_idevaluacion = $v;
			$this->modifiedColumns[] = IdsEvaluacionxCriterioPeer::CA_IDEVALUACION;
		}

		if ($this->aIdsEvaluacion !== null && $this->aIdsEvaluacion->getCaIdevaluacion() !== $v) {
			$this->aIdsEvaluacion = null;
		}

		return $this;
	} 
	
	public function setCaIdcriterio($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idcriterio !== $v) {
			$this->ca_idcriterio = $v;
			$this->modifiedColumns[] = IdsEvaluacionxCriterioPeer::CA_IDCRITERIO;
		}

		if ($this->aIdsCriterio !== null && $this->aIdsCriterio->getCaIdcriterio() !== $v) {
			$this->aIdsCriterio = null;
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
			$this->modifiedColumns[] = IdsEvaluacionxCriterioPeer::CA_VALOR;
		}

		return $this;
	} 
	
	public function setCaPonderacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_ponderacion !== $v) {
			$this->ca_ponderacion = $v;
			$this->modifiedColumns[] = IdsEvaluacionxCriterioPeer::CA_PONDERACION;
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
			$this->modifiedColumns[] = IdsEvaluacionxCriterioPeer::CA_OBSERVACIONES;
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

			$this->ca_idevaluacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idcriterio = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_valor = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_ponderacion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_observaciones = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsEvaluacionxCriterio object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aIdsEvaluacion !== null && $this->ca_idevaluacion !== $this->aIdsEvaluacion->getCaIdevaluacion()) {
			$this->aIdsEvaluacion = null;
		}
		if ($this->aIdsCriterio !== null && $this->ca_idcriterio !== $this->aIdsCriterio->getCaIdcriterio()) {
			$this->aIdsCriterio = null;
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
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsEvaluacionxCriterioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aIdsEvaluacion = null;
			$this->aIdsCriterio = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterio:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsEvaluacionxCriterioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterio:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterio:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsEvaluacionxCriterioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsEvaluacionxCriterio:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsEvaluacionxCriterioPeer::addInstanceToPool($this);
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

												
			if ($this->aIdsEvaluacion !== null) {
				if ($this->aIdsEvaluacion->isModified() || $this->aIdsEvaluacion->isNew()) {
					$affectedRows += $this->aIdsEvaluacion->save($con);
				}
				$this->setIdsEvaluacion($this->aIdsEvaluacion);
			}

			if ($this->aIdsCriterio !== null) {
				if ($this->aIdsCriterio->isModified() || $this->aIdsCriterio->isNew()) {
					$affectedRows += $this->aIdsCriterio->save($con);
				}
				$this->setIdsCriterio($this->aIdsCriterio);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsEvaluacionxCriterioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += IdsEvaluacionxCriterioPeer::doUpdate($this, $con);
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


												
			if ($this->aIdsEvaluacion !== null) {
				if (!$this->aIdsEvaluacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIdsEvaluacion->getValidationFailures());
				}
			}

			if ($this->aIdsCriterio !== null) {
				if (!$this->aIdsCriterio->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIdsCriterio->getValidationFailures());
				}
			}


			if (($retval = IdsEvaluacionxCriterioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsEvaluacionxCriterioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdevaluacion();
				break;
			case 1:
				return $this->getCaIdcriterio();
				break;
			case 2:
				return $this->getCaValor();
				break;
			case 3:
				return $this->getCaPonderacion();
				break;
			case 4:
				return $this->getCaObservaciones();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsEvaluacionxCriterioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdevaluacion(),
			$keys[1] => $this->getCaIdcriterio(),
			$keys[2] => $this->getCaValor(),
			$keys[3] => $this->getCaPonderacion(),
			$keys[4] => $this->getCaObservaciones(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsEvaluacionxCriterioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdevaluacion($value);
				break;
			case 1:
				$this->setCaIdcriterio($value);
				break;
			case 2:
				$this->setCaValor($value);
				break;
			case 3:
				$this->setCaPonderacion($value);
				break;
			case 4:
				$this->setCaObservaciones($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsEvaluacionxCriterioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdevaluacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcriterio($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaValor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPonderacion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaObservaciones($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsEvaluacionxCriterioPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION)) $criteria->add(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $this->ca_idevaluacion);
		if ($this->isColumnModified(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO)) $criteria->add(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);
		if ($this->isColumnModified(IdsEvaluacionxCriterioPeer::CA_VALOR)) $criteria->add(IdsEvaluacionxCriterioPeer::CA_VALOR, $this->ca_valor);
		if ($this->isColumnModified(IdsEvaluacionxCriterioPeer::CA_PONDERACION)) $criteria->add(IdsEvaluacionxCriterioPeer::CA_PONDERACION, $this->ca_ponderacion);
		if ($this->isColumnModified(IdsEvaluacionxCriterioPeer::CA_OBSERVACIONES)) $criteria->add(IdsEvaluacionxCriterioPeer::CA_OBSERVACIONES, $this->ca_observaciones);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsEvaluacionxCriterioPeer::DATABASE_NAME);

		$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDEVALUACION, $this->ca_idevaluacion);
		$criteria->add(IdsEvaluacionxCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdevaluacion();

		$pks[1] = $this->getCaIdcriterio();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdevaluacion($keys[0]);

		$this->setCaIdcriterio($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdevaluacion($this->ca_idevaluacion);

		$copyObj->setCaIdcriterio($this->ca_idcriterio);

		$copyObj->setCaValor($this->ca_valor);

		$copyObj->setCaPonderacion($this->ca_ponderacion);

		$copyObj->setCaObservaciones($this->ca_observaciones);


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
			self::$peer = new IdsEvaluacionxCriterioPeer();
		}
		return self::$peer;
	}

	
	public function setIdsEvaluacion(IdsEvaluacion $v = null)
	{
		if ($v === null) {
			$this->setCaIdevaluacion(NULL);
		} else {
			$this->setCaIdevaluacion($v->getCaIdevaluacion());
		}

		$this->aIdsEvaluacion = $v;

						if ($v !== null) {
			$v->addIdsEvaluacionxCriterio($this);
		}

		return $this;
	}


	
	public function getIdsEvaluacion(PropelPDO $con = null)
	{
		if ($this->aIdsEvaluacion === null && ($this->ca_idevaluacion !== null)) {
			$c = new Criteria(IdsEvaluacionPeer::DATABASE_NAME);
			$c->add(IdsEvaluacionPeer::CA_IDEVALUACION, $this->ca_idevaluacion);
			$this->aIdsEvaluacion = IdsEvaluacionPeer::doSelectOne($c, $con);
			
		}
		return $this->aIdsEvaluacion;
	}

	
	public function setIdsCriterio(IdsCriterio $v = null)
	{
		if ($v === null) {
			$this->setCaIdcriterio(NULL);
		} else {
			$this->setCaIdcriterio($v->getCaIdcriterio());
		}

		$this->aIdsCriterio = $v;

						if ($v !== null) {
			$v->addIdsEvaluacionxCriterio($this);
		}

		return $this;
	}


	
	public function getIdsCriterio(PropelPDO $con = null)
	{
		if ($this->aIdsCriterio === null && (($this->ca_idcriterio !== "" && $this->ca_idcriterio !== null))) {
			$c = new Criteria(IdsCriterioPeer::DATABASE_NAME);
			$c->add(IdsCriterioPeer::CA_IDCRITERIO, $this->ca_idcriterio);
			$this->aIdsCriterio = IdsCriterioPeer::doSelectOne($c, $con);
			
		}
		return $this->aIdsCriterio;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aIdsEvaluacion = null;
			$this->aIdsCriterio = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIdsEvaluacionxCriterio:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsEvaluacionxCriterio::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 