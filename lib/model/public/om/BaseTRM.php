<?php


abstract class BaseTRM extends BaseObject  implements Persistent {


  const PEER = 'TRMPeer';

	
	protected static $peer;

	
	protected $ca_fecha;

	
	protected $ca_euro;

	
	protected $ca_pesos;

	
	protected $ca_libra;

	
	protected $ca_fsuizo;

	
	protected $ca_marco;

	
	protected $ca_yen;

	
	protected $ca_rupee;

	
	protected $ca_ausdolar;

	
	protected $ca_candolar;

	
	protected $ca_cornoruega;

	
	protected $ca_singdolar;

	
	protected $ca_rand;

	
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

	
	public function getCaFecha($format = 'Y-m-d')
	{
		if ($this->ca_fecha === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fecha);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fecha, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaEuro()
	{
		return $this->ca_euro;
	}

	
	public function getCaPesos()
	{
		return $this->ca_pesos;
	}

	
	public function getCaLibra()
	{
		return $this->ca_libra;
	}

	
	public function getCaFsuizo()
	{
		return $this->ca_fsuizo;
	}

	
	public function getCaMarco()
	{
		return $this->ca_marco;
	}

	
	public function getCaYen()
	{
		return $this->ca_yen;
	}

	
	public function getCaRupee()
	{
		return $this->ca_rupee;
	}

	
	public function getCaAusdolar()
	{
		return $this->ca_ausdolar;
	}

	
	public function getCaCandolar()
	{
		return $this->ca_candolar;
	}

	
	public function getCaCornoruega()
	{
		return $this->ca_cornoruega;
	}

	
	public function getCaSingdolar()
	{
		return $this->ca_singdolar;
	}

	
	public function getCaRand()
	{
		return $this->ca_rand;
	}

	
	public function setCaFecha($v)
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

		if ( $this->ca_fecha !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fecha !== null && $tmpDt = new DateTime($this->ca_fecha)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fecha = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = TRMPeer::CA_FECHA;
			}
		} 
		return $this;
	} 
	
	public function setCaEuro($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_euro !== $v) {
			$this->ca_euro = $v;
			$this->modifiedColumns[] = TRMPeer::CA_EURO;
		}

		return $this;
	} 
	
	public function setCaPesos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_pesos !== $v) {
			$this->ca_pesos = $v;
			$this->modifiedColumns[] = TRMPeer::CA_PESOS;
		}

		return $this;
	} 
	
	public function setCaLibra($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_libra !== $v) {
			$this->ca_libra = $v;
			$this->modifiedColumns[] = TRMPeer::CA_LIBRA;
		}

		return $this;
	} 
	
	public function setCaFsuizo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fsuizo !== $v) {
			$this->ca_fsuizo = $v;
			$this->modifiedColumns[] = TRMPeer::CA_FSUIZO;
		}

		return $this;
	} 
	
	public function setCaMarco($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_marco !== $v) {
			$this->ca_marco = $v;
			$this->modifiedColumns[] = TRMPeer::CA_MARCO;
		}

		return $this;
	} 
	
	public function setCaYen($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_yen !== $v) {
			$this->ca_yen = $v;
			$this->modifiedColumns[] = TRMPeer::CA_YEN;
		}

		return $this;
	} 
	
	public function setCaRupee($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_rupee !== $v) {
			$this->ca_rupee = $v;
			$this->modifiedColumns[] = TRMPeer::CA_RUPEE;
		}

		return $this;
	} 
	
	public function setCaAusdolar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_ausdolar !== $v) {
			$this->ca_ausdolar = $v;
			$this->modifiedColumns[] = TRMPeer::CA_AUSDOLAR;
		}

		return $this;
	} 
	
	public function setCaCandolar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_candolar !== $v) {
			$this->ca_candolar = $v;
			$this->modifiedColumns[] = TRMPeer::CA_CANDOLAR;
		}

		return $this;
	} 
	
	public function setCaCornoruega($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cornoruega !== $v) {
			$this->ca_cornoruega = $v;
			$this->modifiedColumns[] = TRMPeer::CA_CORNORUEGA;
		}

		return $this;
	} 
	
	public function setCaSingdolar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_singdolar !== $v) {
			$this->ca_singdolar = $v;
			$this->modifiedColumns[] = TRMPeer::CA_SINGDOLAR;
		}

		return $this;
	} 
	
	public function setCaRand($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_rand !== $v) {
			$this->ca_rand = $v;
			$this->modifiedColumns[] = TRMPeer::CA_RAND;
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

			$this->ca_fecha = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_euro = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_pesos = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_libra = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fsuizo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_marco = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_yen = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_rupee = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_ausdolar = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_candolar = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_cornoruega = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_singdolar = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_rand = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TRM object", $e);
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
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TRMPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseTRM:delete:pre') as $callable)
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
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TRMPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTRM:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTRM:save:pre') as $callable)
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
			$con = Propel::getConnection(TRMPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTRM:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TRMPeer::addInstanceToPool($this);
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
					$pk = TRMPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += TRMPeer::doUpdate($this, $con);
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


			if (($retval = TRMPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TRMPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaFecha();
				break;
			case 1:
				return $this->getCaEuro();
				break;
			case 2:
				return $this->getCaPesos();
				break;
			case 3:
				return $this->getCaLibra();
				break;
			case 4:
				return $this->getCaFsuizo();
				break;
			case 5:
				return $this->getCaMarco();
				break;
			case 6:
				return $this->getCaYen();
				break;
			case 7:
				return $this->getCaRupee();
				break;
			case 8:
				return $this->getCaAusdolar();
				break;
			case 9:
				return $this->getCaCandolar();
				break;
			case 10:
				return $this->getCaCornoruega();
				break;
			case 11:
				return $this->getCaSingdolar();
				break;
			case 12:
				return $this->getCaRand();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TRMPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaFecha(),
			$keys[1] => $this->getCaEuro(),
			$keys[2] => $this->getCaPesos(),
			$keys[3] => $this->getCaLibra(),
			$keys[4] => $this->getCaFsuizo(),
			$keys[5] => $this->getCaMarco(),
			$keys[6] => $this->getCaYen(),
			$keys[7] => $this->getCaRupee(),
			$keys[8] => $this->getCaAusdolar(),
			$keys[9] => $this->getCaCandolar(),
			$keys[10] => $this->getCaCornoruega(),
			$keys[11] => $this->getCaSingdolar(),
			$keys[12] => $this->getCaRand(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TRMPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaFecha($value);
				break;
			case 1:
				$this->setCaEuro($value);
				break;
			case 2:
				$this->setCaPesos($value);
				break;
			case 3:
				$this->setCaLibra($value);
				break;
			case 4:
				$this->setCaFsuizo($value);
				break;
			case 5:
				$this->setCaMarco($value);
				break;
			case 6:
				$this->setCaYen($value);
				break;
			case 7:
				$this->setCaRupee($value);
				break;
			case 8:
				$this->setCaAusdolar($value);
				break;
			case 9:
				$this->setCaCandolar($value);
				break;
			case 10:
				$this->setCaCornoruega($value);
				break;
			case 11:
				$this->setCaSingdolar($value);
				break;
			case 12:
				$this->setCaRand($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TRMPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaFecha($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaEuro($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaPesos($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaLibra($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFsuizo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaMarco($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaYen($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaRupee($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaAusdolar($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaCandolar($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaCornoruega($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaSingdolar($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaRand($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TRMPeer::DATABASE_NAME);

		if ($this->isColumnModified(TRMPeer::CA_FECHA)) $criteria->add(TRMPeer::CA_FECHA, $this->ca_fecha);
		if ($this->isColumnModified(TRMPeer::CA_EURO)) $criteria->add(TRMPeer::CA_EURO, $this->ca_euro);
		if ($this->isColumnModified(TRMPeer::CA_PESOS)) $criteria->add(TRMPeer::CA_PESOS, $this->ca_pesos);
		if ($this->isColumnModified(TRMPeer::CA_LIBRA)) $criteria->add(TRMPeer::CA_LIBRA, $this->ca_libra);
		if ($this->isColumnModified(TRMPeer::CA_FSUIZO)) $criteria->add(TRMPeer::CA_FSUIZO, $this->ca_fsuizo);
		if ($this->isColumnModified(TRMPeer::CA_MARCO)) $criteria->add(TRMPeer::CA_MARCO, $this->ca_marco);
		if ($this->isColumnModified(TRMPeer::CA_YEN)) $criteria->add(TRMPeer::CA_YEN, $this->ca_yen);
		if ($this->isColumnModified(TRMPeer::CA_RUPEE)) $criteria->add(TRMPeer::CA_RUPEE, $this->ca_rupee);
		if ($this->isColumnModified(TRMPeer::CA_AUSDOLAR)) $criteria->add(TRMPeer::CA_AUSDOLAR, $this->ca_ausdolar);
		if ($this->isColumnModified(TRMPeer::CA_CANDOLAR)) $criteria->add(TRMPeer::CA_CANDOLAR, $this->ca_candolar);
		if ($this->isColumnModified(TRMPeer::CA_CORNORUEGA)) $criteria->add(TRMPeer::CA_CORNORUEGA, $this->ca_cornoruega);
		if ($this->isColumnModified(TRMPeer::CA_SINGDOLAR)) $criteria->add(TRMPeer::CA_SINGDOLAR, $this->ca_singdolar);
		if ($this->isColumnModified(TRMPeer::CA_RAND)) $criteria->add(TRMPeer::CA_RAND, $this->ca_rand);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TRMPeer::DATABASE_NAME);

		$criteria->add(TRMPeer::CA_FECHA, $this->ca_fecha);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaFecha();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaFecha($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFecha($this->ca_fecha);

		$copyObj->setCaEuro($this->ca_euro);

		$copyObj->setCaPesos($this->ca_pesos);

		$copyObj->setCaLibra($this->ca_libra);

		$copyObj->setCaFsuizo($this->ca_fsuizo);

		$copyObj->setCaMarco($this->ca_marco);

		$copyObj->setCaYen($this->ca_yen);

		$copyObj->setCaRupee($this->ca_rupee);

		$copyObj->setCaAusdolar($this->ca_ausdolar);

		$copyObj->setCaCandolar($this->ca_candolar);

		$copyObj->setCaCornoruega($this->ca_cornoruega);

		$copyObj->setCaSingdolar($this->ca_singdolar);

		$copyObj->setCaRand($this->ca_rand);


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
			self::$peer = new TRMPeer();
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
    if (!$callable = sfMixer::getCallable('BaseTRM:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTRM::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 