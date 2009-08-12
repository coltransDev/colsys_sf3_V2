<?php


abstract class BaseTransContacto extends BaseObject  implements Persistent {


  const PEER = 'TransContactoPeer';

	
	protected static $peer;

	
	protected $ca_idtransportista;

	
	protected $ca_idcontacto;

	
	protected $ca_nombre;

	
	protected $ca_telefonos;

	
	protected $ca_fax;

	
	protected $ca_email;

	
	protected $ca_observaciones;

	
	protected $aTransportista;

	
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

	
	public function getCaIdtransportista()
	{
		return $this->ca_idtransportista;
	}

	
	public function getCaIdcontacto()
	{
		return $this->ca_idcontacto;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaTelefonos()
	{
		return $this->ca_telefonos;
	}

	
	public function getCaFax()
	{
		return $this->ca_fax;
	}

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	
	public function setCaIdtransportista($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtransportista !== $v) {
			$this->ca_idtransportista = $v;
			$this->modifiedColumns[] = TransContactoPeer::CA_IDTRANSPORTISTA;
		}

		if ($this->aTransportista !== null && $this->aTransportista->getCaIdtransportista() !== $v) {
			$this->aTransportista = null;
		}

		return $this;
	} 
	
	public function setCaIdcontacto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idcontacto !== $v) {
			$this->ca_idcontacto = $v;
			$this->modifiedColumns[] = TransContactoPeer::CA_IDCONTACTO;
		}

		return $this;
	} 
	
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = TransContactoPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaTelefonos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = TransContactoPeer::CA_TELEFONOS;
		}

		return $this;
	} 
	
	public function setCaFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = TransContactoPeer::CA_FAX;
		}

		return $this;
	} 
	
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = TransContactoPeer::CA_EMAIL;
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
			$this->modifiedColumns[] = TransContactoPeer::CA_OBSERVACIONES;
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

			$this->ca_idtransportista = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idcontacto = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_telefonos = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fax = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_email = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_observaciones = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TransContacto object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aTransportista !== null && $this->ca_idtransportista !== $this->aTransportista->getCaIdtransportista()) {
			$this->aTransportista = null;
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
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TransContactoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTransportista = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransContacto:delete:pre') as $callable)
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
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TransContactoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTransContacto:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransContacto:save:pre') as $callable)
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
			$con = Propel::getConnection(TransContactoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTransContacto:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TransContactoPeer::addInstanceToPool($this);
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

												
			if ($this->aTransportista !== null) {
				if ($this->aTransportista->isModified() || $this->aTransportista->isNew()) {
					$affectedRows += $this->aTransportista->save($con);
				}
				$this->setTransportista($this->aTransportista);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TransContactoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += TransContactoPeer::doUpdate($this, $con);
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


												
			if ($this->aTransportista !== null) {
				if (!$this->aTransportista->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportista->getValidationFailures());
				}
			}


			if (($retval = TransContactoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TransContactoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdtransportista();
				break;
			case 1:
				return $this->getCaIdcontacto();
				break;
			case 2:
				return $this->getCaNombre();
				break;
			case 3:
				return $this->getCaTelefonos();
				break;
			case 4:
				return $this->getCaFax();
				break;
			case 5:
				return $this->getCaEmail();
				break;
			case 6:
				return $this->getCaObservaciones();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TransContactoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtransportista(),
			$keys[1] => $this->getCaIdcontacto(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaTelefonos(),
			$keys[4] => $this->getCaFax(),
			$keys[5] => $this->getCaEmail(),
			$keys[6] => $this->getCaObservaciones(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TransContactoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdtransportista($value);
				break;
			case 1:
				$this->setCaIdcontacto($value);
				break;
			case 2:
				$this->setCaNombre($value);
				break;
			case 3:
				$this->setCaTelefonos($value);
				break;
			case 4:
				$this->setCaFax($value);
				break;
			case 5:
				$this->setCaEmail($value);
				break;
			case 6:
				$this->setCaObservaciones($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TransContactoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtransportista($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcontacto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTelefonos($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFax($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaEmail($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObservaciones($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TransContactoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TransContactoPeer::CA_IDTRANSPORTISTA)) $criteria->add(TransContactoPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);
		if ($this->isColumnModified(TransContactoPeer::CA_IDCONTACTO)) $criteria->add(TransContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);
		if ($this->isColumnModified(TransContactoPeer::CA_NOMBRE)) $criteria->add(TransContactoPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TransContactoPeer::CA_TELEFONOS)) $criteria->add(TransContactoPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(TransContactoPeer::CA_FAX)) $criteria->add(TransContactoPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(TransContactoPeer::CA_EMAIL)) $criteria->add(TransContactoPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(TransContactoPeer::CA_OBSERVACIONES)) $criteria->add(TransContactoPeer::CA_OBSERVACIONES, $this->ca_observaciones);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TransContactoPeer::DATABASE_NAME);

		$criteria->add(TransContactoPeer::CA_IDCONTACTO, $this->ca_idcontacto);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdcontacto();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdcontacto($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtransportista($this->ca_idtransportista);

		$copyObj->setCaIdcontacto($this->ca_idcontacto);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaEmail($this->ca_email);

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
			self::$peer = new TransContactoPeer();
		}
		return self::$peer;
	}

	
	public function setTransportista(Transportista $v = null)
	{
		if ($v === null) {
			$this->setCaIdtransportista(NULL);
		} else {
			$this->setCaIdtransportista($v->getCaIdtransportista());
		}

		$this->aTransportista = $v;

						if ($v !== null) {
			$v->addTransContacto($this);
		}

		return $this;
	}


	
	public function getTransportista(PropelPDO $con = null)
	{
		if ($this->aTransportista === null && ($this->ca_idtransportista !== null)) {
			$c = new Criteria(TransportistaPeer::DATABASE_NAME);
			$c->add(TransportistaPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);
			$this->aTransportista = TransportistaPeer::doSelectOne($c, $con);
			
		}
		return $this->aTransportista;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aTransportista = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTransContacto:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTransContacto::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 