<?php


abstract class BaseNivelesAcceso extends BaseObject  implements Persistent {


  const PEER = 'NivelesAccesoPeer';

	
	protected static $peer;

	
	protected $ca_login;

	
	protected $ca_basededatos;

	
	protected $ca_nivel;

	
	protected $aUsuario;

	
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

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function getCaBasededatos()
	{
		return $this->ca_basededatos;
	}

	
	public function getCaNivel()
	{
		return $this->ca_nivel;
	}

	
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = NivelesAccesoPeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

		return $this;
	} 
	
	public function setCaBasededatos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_basededatos !== $v) {
			$this->ca_basededatos = $v;
			$this->modifiedColumns[] = NivelesAccesoPeer::CA_BASEDEDATOS;
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
			$this->modifiedColumns[] = NivelesAccesoPeer::CA_NIVEL;
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

			$this->ca_login = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_basededatos = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_nivel = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating NivelesAcceso object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aUsuario !== null && $this->ca_login !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
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
			$con = Propel::getConnection(NivelesAccesoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = NivelesAccesoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aUsuario = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseNivelesAcceso:delete:pre') as $callable)
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
			$con = Propel::getConnection(NivelesAccesoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			NivelesAccesoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseNivelesAcceso:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseNivelesAcceso:save:pre') as $callable)
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
			$con = Propel::getConnection(NivelesAccesoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseNivelesAcceso:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			NivelesAccesoPeer::addInstanceToPool($this);
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

												
			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = NivelesAccesoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += NivelesAccesoPeer::doUpdate($this, $con);
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


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = NivelesAccesoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NivelesAccesoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaLogin();
				break;
			case 1:
				return $this->getCaBasededatos();
				break;
			case 2:
				return $this->getCaNivel();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = NivelesAccesoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaLogin(),
			$keys[1] => $this->getCaBasededatos(),
			$keys[2] => $this->getCaNivel(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NivelesAccesoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaLogin($value);
				break;
			case 1:
				$this->setCaBasededatos($value);
				break;
			case 2:
				$this->setCaNivel($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NivelesAccesoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaLogin($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaBasededatos($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNivel($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NivelesAccesoPeer::DATABASE_NAME);

		if ($this->isColumnModified(NivelesAccesoPeer::CA_LOGIN)) $criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(NivelesAccesoPeer::CA_BASEDEDATOS)) $criteria->add(NivelesAccesoPeer::CA_BASEDEDATOS, $this->ca_basededatos);
		if ($this->isColumnModified(NivelesAccesoPeer::CA_NIVEL)) $criteria->add(NivelesAccesoPeer::CA_NIVEL, $this->ca_nivel);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NivelesAccesoPeer::DATABASE_NAME);

		$criteria->add(NivelesAccesoPeer::CA_LOGIN, $this->ca_login);
		$criteria->add(NivelesAccesoPeer::CA_BASEDEDATOS, $this->ca_basededatos);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaLogin();

		$pks[1] = $this->getCaBasededatos();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaLogin($keys[0]);

		$this->setCaBasededatos($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaBasededatos($this->ca_basededatos);

		$copyObj->setCaNivel($this->ca_nivel);


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
			self::$peer = new NivelesAccesoPeer();
		}
		return self::$peer;
	}

	
	public function setUsuario(Usuario $v = null)
	{
		if ($v === null) {
			$this->setCaLogin(NULL);
		} else {
			$this->setCaLogin($v->getCaLogin());
		}

		$this->aUsuario = $v;

						if ($v !== null) {
			$v->addNivelesAcceso($this);
		}

		return $this;
	}


	
	public function getUsuario(PropelPDO $con = null)
	{
		if ($this->aUsuario === null && (($this->ca_login !== "" && $this->ca_login !== null))) {
			$c = new Criteria(UsuarioPeer::DATABASE_NAME);
			$c->add(UsuarioPeer::CA_LOGIN, $this->ca_login);
			$this->aUsuario = UsuarioPeer::doSelectOne($c, $con);
			
		}
		return $this->aUsuario;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aUsuario = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseNivelesAcceso:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseNivelesAcceso::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 