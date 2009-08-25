<?php


abstract class BaseAduanaEventoExtra extends BaseObject  implements Persistent {


  const PEER = 'AduanaEventoExtraPeer';

	
	protected static $peer;

	
	protected $ca_referencia;

	
	protected $ca_idevento;

	
	protected $ca_usucreado;

	
	protected $ca_fchcreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_texto;

	
	protected $aAduanaMaestra;

	
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

	
	public function getCaReferencia()
	{
		return $this->ca_referencia;
	}

	
	public function getCaIdevento()
	{
		return $this->ca_idevento;
	}

	
	public function getCaUsucreado()
	{
		return $this->ca_usucreado;
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

	
	public function getCaFchactualizado($format = 'Y-m-d')
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

	
	public function getCaTexto()
	{
		return $this->ca_texto;
	}

	
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = AduanaEventoExtraPeer::CA_REFERENCIA;
		}

		if ($this->aAduanaMaestra !== null && $this->aAduanaMaestra->getCaReferencia() !== $v) {
			$this->aAduanaMaestra = null;
		}

		return $this;
	} 
	
	public function setCaIdevento($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idevento !== $v) {
			$this->ca_idevento = $v;
			$this->modifiedColumns[] = AduanaEventoExtraPeer::CA_IDEVENTO;
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
			$this->modifiedColumns[] = AduanaEventoExtraPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = AduanaEventoExtraPeer::CA_FCHCREADO;
			}
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
			
			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = AduanaEventoExtraPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = AduanaEventoExtraPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaTexto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_texto !== $v) {
			$this->ca_texto = $v;
			$this->modifiedColumns[] = AduanaEventoExtraPeer::CA_TEXTO;
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

			$this->ca_referencia = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idevento = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_usucreado = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_fchcreado = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fchactualizado = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_usuactualizado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_texto = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AduanaEventoExtra object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aAduanaMaestra !== null && $this->ca_referencia !== $this->aAduanaMaestra->getCaReferencia()) {
			$this->aAduanaMaestra = null;
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
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AduanaEventoExtraPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aAduanaMaestra = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaEventoExtra:delete:pre') as $callable)
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
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			AduanaEventoExtraPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAduanaEventoExtra:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaEventoExtra:save:pre') as $callable)
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
			$con = Propel::getConnection(AduanaEventoExtraPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAduanaEventoExtra:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			AduanaEventoExtraPeer::addInstanceToPool($this);
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

												
			if ($this->aAduanaMaestra !== null) {
				if ($this->aAduanaMaestra->isModified() || $this->aAduanaMaestra->isNew()) {
					$affectedRows += $this->aAduanaMaestra->save($con);
				}
				$this->setAduanaMaestra($this->aAduanaMaestra);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AduanaEventoExtraPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += AduanaEventoExtraPeer::doUpdate($this, $con);
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


												
			if ($this->aAduanaMaestra !== null) {
				if (!$this->aAduanaMaestra->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aAduanaMaestra->getValidationFailures());
				}
			}


			if (($retval = AduanaEventoExtraPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AduanaEventoExtraPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaReferencia();
				break;
			case 1:
				return $this->getCaIdevento();
				break;
			case 2:
				return $this->getCaUsucreado();
				break;
			case 3:
				return $this->getCaFchcreado();
				break;
			case 4:
				return $this->getCaFchactualizado();
				break;
			case 5:
				return $this->getCaUsuactualizado();
				break;
			case 6:
				return $this->getCaTexto();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AduanaEventoExtraPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdevento(),
			$keys[2] => $this->getCaUsucreado(),
			$keys[3] => $this->getCaFchcreado(),
			$keys[4] => $this->getCaFchactualizado(),
			$keys[5] => $this->getCaUsuactualizado(),
			$keys[6] => $this->getCaTexto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AduanaEventoExtraPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaReferencia($value);
				break;
			case 1:
				$this->setCaIdevento($value);
				break;
			case 2:
				$this->setCaUsucreado($value);
				break;
			case 3:
				$this->setCaFchcreado($value);
				break;
			case 4:
				$this->setCaFchactualizado($value);
				break;
			case 5:
				$this->setCaUsuactualizado($value);
				break;
			case 6:
				$this->setCaTexto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AduanaEventoExtraPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdevento($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaUsucreado($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaFchcreado($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchactualizado($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaUsuactualizado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaTexto($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AduanaEventoExtraPeer::DATABASE_NAME);

		if ($this->isColumnModified(AduanaEventoExtraPeer::CA_REFERENCIA)) $criteria->add(AduanaEventoExtraPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(AduanaEventoExtraPeer::CA_IDEVENTO)) $criteria->add(AduanaEventoExtraPeer::CA_IDEVENTO, $this->ca_idevento);
		if ($this->isColumnModified(AduanaEventoExtraPeer::CA_USUCREADO)) $criteria->add(AduanaEventoExtraPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(AduanaEventoExtraPeer::CA_FCHCREADO)) $criteria->add(AduanaEventoExtraPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(AduanaEventoExtraPeer::CA_FCHACTUALIZADO)) $criteria->add(AduanaEventoExtraPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(AduanaEventoExtraPeer::CA_USUACTUALIZADO)) $criteria->add(AduanaEventoExtraPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(AduanaEventoExtraPeer::CA_TEXTO)) $criteria->add(AduanaEventoExtraPeer::CA_TEXTO, $this->ca_texto);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AduanaEventoExtraPeer::DATABASE_NAME);

		$criteria->add(AduanaEventoExtraPeer::CA_IDEVENTO, $this->ca_idevento);

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

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaIdevento($this->ca_idevento);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaTexto($this->ca_texto);


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
			self::$peer = new AduanaEventoExtraPeer();
		}
		return self::$peer;
	}

	
	public function setAduanaMaestra(AduanaMaestra $v = null)
	{
		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}

		$this->aAduanaMaestra = $v;

						if ($v !== null) {
			$v->addAduanaEventoExtra($this);
		}

		return $this;
	}


	
	public function getAduanaMaestra(PropelPDO $con = null)
	{
		if ($this->aAduanaMaestra === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null))) {
			$c = new Criteria(AduanaMaestraPeer::DATABASE_NAME);
			$c->add(AduanaMaestraPeer::CA_REFERENCIA, $this->ca_referencia);
			$this->aAduanaMaestra = AduanaMaestraPeer::doSelectOne($c, $con);
			
		}
		return $this->aAduanaMaestra;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aAduanaMaestra = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAduanaEventoExtra:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAduanaEventoExtra::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 