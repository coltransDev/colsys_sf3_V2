<?php


abstract class BaseUsuarioPerfil extends BaseObject  implements Persistent {


  const PEER = 'UsuarioPerfilPeer';

	
	protected static $peer;

	
	protected $ca_login;

	
	protected $ca_perfil;

	
	protected $aUsuario;

	
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

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function getCaPerfil()
	{
		return $this->ca_perfil;
	}

	
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = UsuarioPerfilPeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
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
			$this->modifiedColumns[] = UsuarioPerfilPeer::CA_PERFIL;
		}

		if ($this->aPerfil !== null && $this->aPerfil->getCaPerfil() !== $v) {
			$this->aPerfil = null;
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
			$this->ca_perfil = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating UsuarioPerfil object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aUsuario !== null && $this->ca_login !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
		}
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
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = UsuarioPerfilPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aUsuario = null;
			$this->aPerfil = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPerfil:delete:pre') as $callable)
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
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			UsuarioPerfilPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseUsuarioPerfil:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseUsuarioPerfil:save:pre') as $callable)
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
			$con = Propel::getConnection(UsuarioPerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseUsuarioPerfil:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			UsuarioPerfilPeer::addInstanceToPool($this);
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

			if ($this->aPerfil !== null) {
				if ($this->aPerfil->isModified() || $this->aPerfil->isNew()) {
					$affectedRows += $this->aPerfil->save($con);
				}
				$this->setPerfil($this->aPerfil);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UsuarioPerfilPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += UsuarioPerfilPeer::doUpdate($this, $con);
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

			if ($this->aPerfil !== null) {
				if (!$this->aPerfil->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerfil->getValidationFailures());
				}
			}


			if (($retval = UsuarioPerfilPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioPerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaPerfil();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = UsuarioPerfilPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaLogin(),
			$keys[1] => $this->getCaPerfil(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioPerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaLogin($value);
				break;
			case 1:
				$this->setCaPerfil($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuarioPerfilPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaLogin($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaPerfil($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UsuarioPerfilPeer::DATABASE_NAME);

		if ($this->isColumnModified(UsuarioPerfilPeer::CA_LOGIN)) $criteria->add(UsuarioPerfilPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(UsuarioPerfilPeer::CA_PERFIL)) $criteria->add(UsuarioPerfilPeer::CA_PERFIL, $this->ca_perfil);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UsuarioPerfilPeer::DATABASE_NAME);

		$criteria->add(UsuarioPerfilPeer::CA_LOGIN, $this->ca_login);
		$criteria->add(UsuarioPerfilPeer::CA_PERFIL, $this->ca_perfil);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaLogin();

		$pks[1] = $this->getCaPerfil();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaLogin($keys[0]);

		$this->setCaPerfil($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaPerfil($this->ca_perfil);


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
			self::$peer = new UsuarioPerfilPeer();
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
			$v->addUsuarioPerfil($this);
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

	
	public function setPerfil(Perfil $v = null)
	{
		if ($v === null) {
			$this->setCaPerfil(NULL);
		} else {
			$this->setCaPerfil($v->getCaPerfil());
		}

		$this->aPerfil = $v;

						if ($v !== null) {
			$v->addUsuarioPerfil($this);
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
			$this->aUsuario = null;
			$this->aPerfil = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseUsuarioPerfil:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseUsuarioPerfil::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 