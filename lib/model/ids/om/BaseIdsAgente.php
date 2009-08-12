<?php


abstract class BaseIdsAgente extends BaseObject  implements Persistent {


  const PEER = 'IdsAgentePeer';

	
	protected static $peer;

	
	protected $ca_idagente;

	
	protected $ca_tipo;

	
	protected $ca_activo;

	
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

	
	public function getCaIdagente()
	{
		return $this->ca_idagente;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaActivo()
	{
		return $this->ca_activo;
	}

	
	public function setCaIdagente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idagente !== $v) {
			$this->ca_idagente = $v;
			$this->modifiedColumns[] = IdsAgentePeer::CA_IDAGENTE;
		}

		if ($this->aIds !== null && $this->aIds->getCaId() !== $v) {
			$this->aIds = null;
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
			$this->modifiedColumns[] = IdsAgentePeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaActivo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_activo !== $v) {
			$this->ca_activo = $v;
			$this->modifiedColumns[] = IdsAgentePeer::CA_ACTIVO;
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

			$this->ca_idagente = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_tipo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_activo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsAgente object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aIds !== null && $this->ca_idagente !== $this->aIds->getCaId()) {
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
			$con = Propel::getConnection(IdsAgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsAgentePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseIdsAgente:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsAgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsAgentePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsAgente:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsAgente:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsAgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsAgente:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsAgentePeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsAgentePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += IdsAgentePeer::doUpdate($this, $con);
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


			if (($retval = IdsAgentePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsAgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdagente();
				break;
			case 1:
				return $this->getCaTipo();
				break;
			case 2:
				return $this->getCaActivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsAgentePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdagente(),
			$keys[1] => $this->getCaTipo(),
			$keys[2] => $this->getCaActivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsAgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdagente($value);
				break;
			case 1:
				$this->setCaTipo($value);
				break;
			case 2:
				$this->setCaActivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsAgentePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdagente($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaTipo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaActivo($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsAgentePeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsAgentePeer::CA_IDAGENTE)) $criteria->add(IdsAgentePeer::CA_IDAGENTE, $this->ca_idagente);
		if ($this->isColumnModified(IdsAgentePeer::CA_TIPO)) $criteria->add(IdsAgentePeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(IdsAgentePeer::CA_ACTIVO)) $criteria->add(IdsAgentePeer::CA_ACTIVO, $this->ca_activo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsAgentePeer::DATABASE_NAME);

		$criteria->add(IdsAgentePeer::CA_IDAGENTE, $this->ca_idagente);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdagente();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdagente($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdagente($this->ca_idagente);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaActivo($this->ca_activo);


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
			self::$peer = new IdsAgentePeer();
		}
		return self::$peer;
	}

	
	public function setIds(Ids $v = null)
	{
		if ($v === null) {
			$this->setCaIdagente(NULL);
		} else {
			$this->setCaIdagente($v->getCaId());
		}

		$this->aIds = $v;

				if ($v !== null) {
			$v->setIdsAgente($this);
		}

		return $this;
	}


	
	public function getIds(PropelPDO $con = null)
	{
		if ($this->aIds === null && ($this->ca_idagente !== null)) {
			$c = new Criteria(IdsPeer::DATABASE_NAME);
			$c->add(IdsPeer::CA_ID, $this->ca_idagente);
			$this->aIds = IdsPeer::doSelectOne($c, $con);
						$this->aIds->setIdsAgente($this);
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
    if (!$callable = sfMixer::getCallable('BaseIdsAgente:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsAgente::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 