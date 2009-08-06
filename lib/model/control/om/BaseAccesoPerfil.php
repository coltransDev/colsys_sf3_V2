<?php


abstract class BaseAccesoPerfil extends BaseObject  implements Persistent {


  const PEER = 'AccesoPerfilPeer';

	
	protected static $peer;

	
	protected $ca_rutina;

	
	protected $ca_perfil;

	
	protected $ca_acceso;

	
	protected $aPerfil;

	
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

	
	public function getCaPerfil()
	{
		return $this->ca_perfil;
	}

	
	public function getCaAcceso()
	{
		return $this->ca_acceso;
	}

	
	public function setCaRutina($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_rutina !== $v) {
			$this->ca_rutina = $v;
			$this->modifiedColumns[] = AccesoPerfilPeer::CA_RUTINA;
		}

		return $this;
	} 
	
	public function setCaPerfil($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_perfil !== $v) {
			$this->ca_perfil = $v;
			$this->modifiedColumns[] = AccesoPerfilPeer::CA_PERFIL;
		}

		if ($this->aPerfil !== null && $this->aPerfil->getCaPerfil() !== $v) {
			$this->aPerfil = null;
		}

		return $this;
	} 
	
	public function setCaAcceso($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_acceso !== $v) {
			$this->ca_acceso = $v;
			$this->modifiedColumns[] = AccesoPerfilPeer::CA_ACCESO;
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
			$this->ca_perfil = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_acceso = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating AccesoPerfil object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aPerfil !== null && $this->ca_perfil !== $this->aPerfil->getCaPerfil()) {
			$this->aPerfil = null;
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
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AccesoPerfilPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aPerfil = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAccesoPerfil:delete:pre') as $callable)
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
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			AccesoPerfilPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAccesoPerfil:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAccesoPerfil:save:pre') as $callable)
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
			$con = Propel::getConnection(AccesoPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAccesoPerfil:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			AccesoPerfilPeer::addInstanceToPool($this);
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

												
			if ($this->aPerfil !== null) {
				if ($this->aPerfil->isModified() || $this->aPerfil->isNew()) {
					$affectedRows += $this->aPerfil->save($con);
				}
				$this->setPerfil($this->aPerfil);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AccesoPerfilPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += AccesoPerfilPeer::doUpdate($this, $con);
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


												
			if ($this->aPerfil !== null) {
				if (!$this->aPerfil->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerfil->getValidationFailures());
				}
			}


			if (($retval = AccesoPerfilPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AccesoPerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaPerfil();
				break;
			case 2:
				return $this->getCaAcceso();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AccesoPerfilPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaRutina(),
			$keys[1] => $this->getCaPerfil(),
			$keys[2] => $this->getCaAcceso(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AccesoPerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaRutina($value);
				break;
			case 1:
				$this->setCaPerfil($value);
				break;
			case 2:
				$this->setCaAcceso($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AccesoPerfilPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaRutina($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaPerfil($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaAcceso($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AccesoPerfilPeer::DATABASE_NAME);

		if ($this->isColumnModified(AccesoPerfilPeer::CA_RUTINA)) $criteria->add(AccesoPerfilPeer::CA_RUTINA, $this->ca_rutina);
		if ($this->isColumnModified(AccesoPerfilPeer::CA_PERFIL)) $criteria->add(AccesoPerfilPeer::CA_PERFIL, $this->ca_perfil);
		if ($this->isColumnModified(AccesoPerfilPeer::CA_ACCESO)) $criteria->add(AccesoPerfilPeer::CA_ACCESO, $this->ca_acceso);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AccesoPerfilPeer::DATABASE_NAME);

		$criteria->add(AccesoPerfilPeer::CA_RUTINA, $this->ca_rutina);
		$criteria->add(AccesoPerfilPeer::CA_PERFIL, $this->ca_perfil);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaRutina();

		$pks[1] = $this->getCaPerfil();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaRutina($keys[0]);

		$this->setCaPerfil($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaRutina($this->ca_rutina);

		$copyObj->setCaPerfil($this->ca_perfil);

		$copyObj->setCaAcceso($this->ca_acceso);


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
			self::$peer = new AccesoPerfilPeer();
		}
		return self::$peer;
	}

	
	public function setPerfil(Perfil $v = null)
	{
		if ($v === null) {
			$this->setCaPerfil(NULL);
		} else {
			$this->setCaPerfil($v->getCaPerfil());
		}

		$this->aPerfil = $v;

						if ($v !== null) {
			$v->addAccesoPerfil($this);
		}

		return $this;
	}


	
	public function getPerfil(PropelPDO $con = null)
	{
		if ($this->aPerfil === null && (($this->ca_perfil !== "" && $this->ca_perfil !== null))) {
			$c = new Criteria(PerfilPeer::DATABASE_NAME);
			$c->add(PerfilPeer::CA_PERFIL, $this->ca_perfil);
			$this->aPerfil = PerfilPeer::doSelectOne($c, $con);
			
		}
		return $this->aPerfil;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aPerfil = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAccesoPerfil:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAccesoPerfil::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 