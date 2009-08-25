<?php


abstract class BaseAduanaEvento extends BaseObject  implements Persistent {


  const PEER = 'AduanaEventoPeer';

	
	protected static $peer;

	
	protected $ca_referencia;

	
	protected $ca_realizado;

	
	protected $ca_idevento;

	
	protected $ca_usuario;

	
	protected $ca_fchevento;

	
	protected $ca_notas;

	
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

	
	public function getCaRealizado()
	{
		return $this->ca_realizado;
	}

	
	public function getCaIdevento()
	{
		return $this->ca_idevento;
	}

	
	public function getCaUsuario()
	{
		return $this->ca_usuario;
	}

	
	public function getCaFchevento($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchevento === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchevento);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchevento, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaNotas()
	{
		return $this->ca_notas;
	}

	
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = AduanaEventoPeer::CA_REFERENCIA;
		}

		if ($this->aAduanaMaestra !== null && $this->aAduanaMaestra->getCaReferencia() !== $v) {
			$this->aAduanaMaestra = null;
		}

		return $this;
	} 
	
	public function setCaRealizado($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_realizado !== $v) {
			$this->ca_realizado = $v;
			$this->modifiedColumns[] = AduanaEventoPeer::CA_REALIZADO;
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
			$this->modifiedColumns[] = AduanaEventoPeer::CA_IDEVENTO;
		}

		return $this;
	} 
	
	public function setCaUsuario($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuario !== $v) {
			$this->ca_usuario = $v;
			$this->modifiedColumns[] = AduanaEventoPeer::CA_USUARIO;
		}

		return $this;
	} 
	
	public function setCaFchevento($v)
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

		if ( $this->ca_fchevento !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchevento !== null && $tmpDt = new DateTime($this->ca_fchevento)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchevento = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = AduanaEventoPeer::CA_FCHEVENTO;
			}
		} 
		return $this;
	} 
	
	public function setCaNotas($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_notas !== $v) {
			$this->ca_notas = $v;
			$this->modifiedColumns[] = AduanaEventoPeer::CA_NOTAS;
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
			$this->ca_realizado = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idevento = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_usuario = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fchevento = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_notas = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AduanaEvento object", $e);
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
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AduanaEventoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
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

    foreach (sfMixer::getCallables('BaseAduanaEvento:delete:pre') as $callable)
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
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			AduanaEventoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAduanaEvento:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAduanaEvento:save:pre') as $callable)
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
			$con = Propel::getConnection(AduanaEventoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAduanaEvento:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			AduanaEventoPeer::addInstanceToPool($this);
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
					$pk = AduanaEventoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += AduanaEventoPeer::doUpdate($this, $con);
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


			if (($retval = AduanaEventoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AduanaEventoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaRealizado();
				break;
			case 2:
				return $this->getCaIdevento();
				break;
			case 3:
				return $this->getCaUsuario();
				break;
			case 4:
				return $this->getCaFchevento();
				break;
			case 5:
				return $this->getCaNotas();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AduanaEventoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaRealizado(),
			$keys[2] => $this->getCaIdevento(),
			$keys[3] => $this->getCaUsuario(),
			$keys[4] => $this->getCaFchevento(),
			$keys[5] => $this->getCaNotas(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AduanaEventoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaReferencia($value);
				break;
			case 1:
				$this->setCaRealizado($value);
				break;
			case 2:
				$this->setCaIdevento($value);
				break;
			case 3:
				$this->setCaUsuario($value);
				break;
			case 4:
				$this->setCaFchevento($value);
				break;
			case 5:
				$this->setCaNotas($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AduanaEventoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaRealizado($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdevento($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaUsuario($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchevento($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNotas($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AduanaEventoPeer::DATABASE_NAME);

		if ($this->isColumnModified(AduanaEventoPeer::CA_REFERENCIA)) $criteria->add(AduanaEventoPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(AduanaEventoPeer::CA_REALIZADO)) $criteria->add(AduanaEventoPeer::CA_REALIZADO, $this->ca_realizado);
		if ($this->isColumnModified(AduanaEventoPeer::CA_IDEVENTO)) $criteria->add(AduanaEventoPeer::CA_IDEVENTO, $this->ca_idevento);
		if ($this->isColumnModified(AduanaEventoPeer::CA_USUARIO)) $criteria->add(AduanaEventoPeer::CA_USUARIO, $this->ca_usuario);
		if ($this->isColumnModified(AduanaEventoPeer::CA_FCHEVENTO)) $criteria->add(AduanaEventoPeer::CA_FCHEVENTO, $this->ca_fchevento);
		if ($this->isColumnModified(AduanaEventoPeer::CA_NOTAS)) $criteria->add(AduanaEventoPeer::CA_NOTAS, $this->ca_notas);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AduanaEventoPeer::DATABASE_NAME);

		$criteria->add(AduanaEventoPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(AduanaEventoPeer::CA_IDEVENTO, $this->ca_idevento);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaReferencia();

		$pks[1] = $this->getCaIdevento();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaReferencia($keys[0]);

		$this->setCaIdevento($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaRealizado($this->ca_realizado);

		$copyObj->setCaIdevento($this->ca_idevento);

		$copyObj->setCaUsuario($this->ca_usuario);

		$copyObj->setCaFchevento($this->ca_fchevento);

		$copyObj->setCaNotas($this->ca_notas);


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
			self::$peer = new AduanaEventoPeer();
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
			$v->addAduanaEvento($this);
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
    if (!$callable = sfMixer::getCallable('BaseAduanaEvento:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAduanaEvento::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 