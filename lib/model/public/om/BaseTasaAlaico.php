<?php


abstract class BaseTasaAlaico extends BaseObject  implements Persistent {


  const PEER = 'TasaAlaicoPeer';

	
	protected static $peer;

	
	protected $ca_fechainicial;

	
	protected $ca_fechafinal;

	
	protected $ca_valortasa;

	
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

	
	public function getCaFechainicial($format = 'Y-m-d')
	{
		if ($this->ca_fechainicial === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fechainicial);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fechainicial, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFechafinal($format = 'Y-m-d')
	{
		if ($this->ca_fechafinal === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fechafinal);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fechafinal, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaValortasa()
	{
		return $this->ca_valortasa;
	}

	
	public function setCaFechainicial($v)
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

		if ( $this->ca_fechainicial !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fechainicial !== null && $tmpDt = new DateTime($this->ca_fechainicial)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fechainicial = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = TasaAlaicoPeer::CA_FECHAINICIAL;
			}
		} 
		return $this;
	} 
	
	public function setCaFechafinal($v)
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

		if ( $this->ca_fechafinal !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fechafinal !== null && $tmpDt = new DateTime($this->ca_fechafinal)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fechafinal = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = TasaAlaicoPeer::CA_FECHAFINAL;
			}
		} 
		return $this;
	} 
	
	public function setCaValortasa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valortasa !== $v) {
			$this->ca_valortasa = $v;
			$this->modifiedColumns[] = TasaAlaicoPeer::CA_VALORTASA;
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

			$this->ca_fechainicial = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_fechafinal = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_valortasa = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TasaAlaico object", $e);
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
			$con = Propel::getConnection(TasaAlaicoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TasaAlaicoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseTasaAlaico:delete:pre') as $callable)
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
			$con = Propel::getConnection(TasaAlaicoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TasaAlaicoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTasaAlaico:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTasaAlaico:save:pre') as $callable)
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
			$con = Propel::getConnection(TasaAlaicoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTasaAlaico:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TasaAlaicoPeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TasaAlaicoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += TasaAlaicoPeer::doUpdate($this, $con);
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


			if (($retval = TasaAlaicoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TasaAlaicoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaFechainicial();
				break;
			case 1:
				return $this->getCaFechafinal();
				break;
			case 2:
				return $this->getCaValortasa();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TasaAlaicoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaFechainicial(),
			$keys[1] => $this->getCaFechafinal(),
			$keys[2] => $this->getCaValortasa(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TasaAlaicoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaFechainicial($value);
				break;
			case 1:
				$this->setCaFechafinal($value);
				break;
			case 2:
				$this->setCaValortasa($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TasaAlaicoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaFechainicial($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFechafinal($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaValortasa($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TasaAlaicoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TasaAlaicoPeer::CA_FECHAINICIAL)) $criteria->add(TasaAlaicoPeer::CA_FECHAINICIAL, $this->ca_fechainicial);
		if ($this->isColumnModified(TasaAlaicoPeer::CA_FECHAFINAL)) $criteria->add(TasaAlaicoPeer::CA_FECHAFINAL, $this->ca_fechafinal);
		if ($this->isColumnModified(TasaAlaicoPeer::CA_VALORTASA)) $criteria->add(TasaAlaicoPeer::CA_VALORTASA, $this->ca_valortasa);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TasaAlaicoPeer::DATABASE_NAME);

		$criteria->add(TasaAlaicoPeer::CA_FECHAINICIAL, $this->ca_fechainicial);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaFechainicial();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaFechainicial($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFechainicial($this->ca_fechainicial);

		$copyObj->setCaFechafinal($this->ca_fechafinal);

		$copyObj->setCaValortasa($this->ca_valortasa);


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
			self::$peer = new TasaAlaicoPeer();
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
    if (!$callable = sfMixer::getCallable('BaseTasaAlaico:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTasaAlaico::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 