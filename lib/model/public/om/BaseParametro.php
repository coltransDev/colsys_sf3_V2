<?php


abstract class BaseParametro extends BaseObject  implements Persistent {


  const PEER = 'ParametroPeer';

	
	protected static $peer;

	
	protected $ca_casouso;

	
	protected $ca_identificacion;

	
	protected $ca_valor;

	
	protected $ca_valor2;

	
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

	
	public function getCaCasouso()
	{
		return $this->ca_casouso;
	}

	
	public function getCaIdentificacion()
	{
		return $this->ca_identificacion;
	}

	
	public function getCaValor()
	{
		return $this->ca_valor;
	}

	
	public function getCaValor2()
	{
		return $this->ca_valor2;
	}

	
	public function setCaCasouso($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_casouso !== $v) {
			$this->ca_casouso = $v;
			$this->modifiedColumns[] = ParametroPeer::CA_CASOUSO;
		}

		return $this;
	} 
	
	public function setCaIdentificacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_identificacion !== $v) {
			$this->ca_identificacion = $v;
			$this->modifiedColumns[] = ParametroPeer::CA_IDENTIFICACION;
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
			$this->modifiedColumns[] = ParametroPeer::CA_VALOR;
		}

		return $this;
	} 
	
	public function setCaValor2($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor2 !== $v) {
			$this->ca_valor2 = $v;
			$this->modifiedColumns[] = ParametroPeer::CA_VALOR2;
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

			$this->ca_casouso = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_identificacion = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_valor = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_valor2 = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Parametro object", $e);
		}
	}

	
	public function ensureConsistency()
	{

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
			$con = Propel::getConnection(ParametroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ParametroPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseParametro:delete:pre') as $callable)
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
			$con = Propel::getConnection(ParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ParametroPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseParametro:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseParametro:save:pre') as $callable)
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
			$con = Propel::getConnection(ParametroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseParametro:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			ParametroPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ParametroPeer::CA_CASOUSO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ParametroPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaCasouso($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ParametroPeer::doUpdate($this, $con);
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


			if (($retval = ParametroPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ParametroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaCasouso();
				break;
			case 1:
				return $this->getCaIdentificacion();
				break;
			case 2:
				return $this->getCaValor();
				break;
			case 3:
				return $this->getCaValor2();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ParametroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaCasouso(),
			$keys[1] => $this->getCaIdentificacion(),
			$keys[2] => $this->getCaValor(),
			$keys[3] => $this->getCaValor2(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ParametroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaCasouso($value);
				break;
			case 1:
				$this->setCaIdentificacion($value);
				break;
			case 2:
				$this->setCaValor($value);
				break;
			case 3:
				$this->setCaValor2($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ParametroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaCasouso($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdentificacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaValor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaValor2($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ParametroPeer::DATABASE_NAME);

		if ($this->isColumnModified(ParametroPeer::CA_CASOUSO)) $criteria->add(ParametroPeer::CA_CASOUSO, $this->ca_casouso);
		if ($this->isColumnModified(ParametroPeer::CA_IDENTIFICACION)) $criteria->add(ParametroPeer::CA_IDENTIFICACION, $this->ca_identificacion);
		if ($this->isColumnModified(ParametroPeer::CA_VALOR)) $criteria->add(ParametroPeer::CA_VALOR, $this->ca_valor);
		if ($this->isColumnModified(ParametroPeer::CA_VALOR2)) $criteria->add(ParametroPeer::CA_VALOR2, $this->ca_valor2);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ParametroPeer::DATABASE_NAME);

		$criteria->add(ParametroPeer::CA_CASOUSO, $this->ca_casouso);
		$criteria->add(ParametroPeer::CA_IDENTIFICACION, $this->ca_identificacion);
		$criteria->add(ParametroPeer::CA_VALOR, $this->ca_valor);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaCasouso();

		$pks[1] = $this->getCaIdentificacion();

		$pks[2] = $this->getCaValor();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaCasouso($keys[0]);

		$this->setCaIdentificacion($keys[1]);

		$this->setCaValor($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdentificacion($this->ca_identificacion);

		$copyObj->setCaValor($this->ca_valor);

		$copyObj->setCaValor2($this->ca_valor2);


		$copyObj->setNew(true);

		$copyObj->setCaCasouso(NULL); 
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
			self::$peer = new ParametroPeer();
		}
		return self::$peer;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseParametro:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseParametro::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 