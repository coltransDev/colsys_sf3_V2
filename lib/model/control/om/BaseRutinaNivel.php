<?php


abstract class BaseRutinaNivel extends BaseObject  implements Persistent {


  const PEER = 'RutinaNivelPeer';

	
	protected static $peer;

	
	protected $ca_rutina;

	
	protected $ca_nivel;

	
	protected $ca_valor;

	
	protected $aRutina;

	
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

	
	public function getCaRutina()
	{
		return $this->ca_rutina;
	}

	
	public function getCaNivel()
	{
		return $this->ca_nivel;
	}

	
	public function getCaValor()
	{
		return $this->ca_valor;
	}

	
	public function setCaRutina($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_rutina !== $v) {
			$this->ca_rutina = $v;
			$this->modifiedColumns[] = RutinaNivelPeer::CA_RUTINA;
		}

		if ($this->aRutina !== null && $this->aRutina->getCaRutina() !== $v) {
			$this->aRutina = null;
		}

		return $this;
	} 
	
	public function setCaNivel($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nivel !== $v) {
			$this->ca_nivel = $v;
			$this->modifiedColumns[] = RutinaNivelPeer::CA_NIVEL;
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
			$this->modifiedColumns[] = RutinaNivelPeer::CA_VALOR;
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

			$this->ca_rutina = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_nivel = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_valor = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RutinaNivel object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aRutina !== null && $this->ca_rutina !== $this->aRutina->getCaRutina()) {
			$this->aRutina = null;
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
			$con = Propel::getConnection(RutinaNivelPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RutinaNivelPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aRutina = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRutinaNivel:delete:pre') as $callable)
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
			$con = Propel::getConnection(RutinaNivelPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RutinaNivelPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRutinaNivel:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRutinaNivel:save:pre') as $callable)
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
			$con = Propel::getConnection(RutinaNivelPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRutinaNivel:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RutinaNivelPeer::addInstanceToPool($this);
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

												
			if ($this->aRutina !== null) {
				if ($this->aRutina->isModified() || $this->aRutina->isNew()) {
					$affectedRows += $this->aRutina->save($con);
				}
				$this->setRutina($this->aRutina);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RutinaNivelPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RutinaNivelPeer::doUpdate($this, $con);
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


												
			if ($this->aRutina !== null) {
				if (!$this->aRutina->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRutina->getValidationFailures());
				}
			}


			if (($retval = RutinaNivelPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RutinaNivelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaRutina();
				break;
			case 1:
				return $this->getCaNivel();
				break;
			case 2:
				return $this->getCaValor();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RutinaNivelPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaRutina(),
			$keys[1] => $this->getCaNivel(),
			$keys[2] => $this->getCaValor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RutinaNivelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaRutina($value);
				break;
			case 1:
				$this->setCaNivel($value);
				break;
			case 2:
				$this->setCaValor($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RutinaNivelPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaRutina($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNivel($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaValor($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RutinaNivelPeer::DATABASE_NAME);

		if ($this->isColumnModified(RutinaNivelPeer::CA_RUTINA)) $criteria->add(RutinaNivelPeer::CA_RUTINA, $this->ca_rutina);
		if ($this->isColumnModified(RutinaNivelPeer::CA_NIVEL)) $criteria->add(RutinaNivelPeer::CA_NIVEL, $this->ca_nivel);
		if ($this->isColumnModified(RutinaNivelPeer::CA_VALOR)) $criteria->add(RutinaNivelPeer::CA_VALOR, $this->ca_valor);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RutinaNivelPeer::DATABASE_NAME);

		$criteria->add(RutinaNivelPeer::CA_RUTINA, $this->ca_rutina);
		$criteria->add(RutinaNivelPeer::CA_NIVEL, $this->ca_nivel);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaRutina();

		$pks[1] = $this->getCaNivel();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaRutina($keys[0]);

		$this->setCaNivel($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaRutina($this->ca_rutina);

		$copyObj->setCaNivel($this->ca_nivel);

		$copyObj->setCaValor($this->ca_valor);


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
			self::$peer = new RutinaNivelPeer();
		}
		return self::$peer;
	}

	
	public function setRutina(Rutina $v = null)
	{
		if ($v === null) {
			$this->setCaRutina(NULL);
		} else {
			$this->setCaRutina($v->getCaRutina());
		}

		$this->aRutina = $v;

						if ($v !== null) {
			$v->addRutinaNivel($this);
		}

		return $this;
	}


	
	public function getRutina(PropelPDO $con = null)
	{
		if ($this->aRutina === null && (($this->ca_rutina !== "" && $this->ca_rutina !== null))) {
			$c = new Criteria(RutinaPeer::DATABASE_NAME);
			$c->add(RutinaPeer::CA_RUTINA, $this->ca_rutina);
			$this->aRutina = RutinaPeer::doSelectOne($c, $con);
			
		}
		return $this->aRutina;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aRutina = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRutinaNivel:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRutinaNivel::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 