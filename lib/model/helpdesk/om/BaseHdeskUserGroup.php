<?php


abstract class BaseHdeskUserGroup extends BaseObject  implements Persistent {


  const PEER = 'HdeskUserGroupPeer';

	
	protected static $peer;

	
	protected $ca_idgroup;

	
	protected $ca_login;

	
	protected $aHdeskGroup;

	
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

	
	public function getCaIdgroup()
	{
		return $this->ca_idgroup;
	}

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function setCaIdgroup($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgroup !== $v) {
			$this->ca_idgroup = $v;
			$this->modifiedColumns[] = HdeskUserGroupPeer::CA_IDGROUP;
		}

		if ($this->aHdeskGroup !== null && $this->aHdeskGroup->getCaIdgroup() !== $v) {
			$this->aHdeskGroup = null;
		}

		return $this;
	} 
	
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = HdeskUserGroupPeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
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

			$this->ca_idgroup = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_login = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HdeskUserGroup object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aHdeskGroup !== null && $this->ca_idgroup !== $this->aHdeskGroup->getCaIdgroup()) {
			$this->aHdeskGroup = null;
		}
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
			$con = Propel::getConnection(HdeskUserGroupPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = HdeskUserGroupPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aHdeskGroup = null;
			$this->aUsuario = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskUserGroup:delete:pre') as $callable)
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
			$con = Propel::getConnection(HdeskUserGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HdeskUserGroupPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseHdeskUserGroup:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskUserGroup:save:pre') as $callable)
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
			$con = Propel::getConnection(HdeskUserGroupPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseHdeskUserGroup:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			HdeskUserGroupPeer::addInstanceToPool($this);
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

												
			if ($this->aHdeskGroup !== null) {
				if ($this->aHdeskGroup->isModified() || $this->aHdeskGroup->isNew()) {
					$affectedRows += $this->aHdeskGroup->save($con);
				}
				$this->setHdeskGroup($this->aHdeskGroup);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HdeskUserGroupPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += HdeskUserGroupPeer::doUpdate($this, $con);
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


												
			if ($this->aHdeskGroup !== null) {
				if (!$this->aHdeskGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHdeskGroup->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = HdeskUserGroupPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskUserGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdgroup();
				break;
			case 1:
				return $this->getCaLogin();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = HdeskUserGroupPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdgroup(),
			$keys[1] => $this->getCaLogin(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskUserGroupPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdgroup($value);
				break;
			case 1:
				$this->setCaLogin($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HdeskUserGroupPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdgroup($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaLogin($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HdeskUserGroupPeer::DATABASE_NAME);

		if ($this->isColumnModified(HdeskUserGroupPeer::CA_IDGROUP)) $criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);
		if ($this->isColumnModified(HdeskUserGroupPeer::CA_LOGIN)) $criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HdeskUserGroupPeer::DATABASE_NAME);

		$criteria->add(HdeskUserGroupPeer::CA_IDGROUP, $this->ca_idgroup);
		$criteria->add(HdeskUserGroupPeer::CA_LOGIN, $this->ca_login);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdgroup();

		$pks[1] = $this->getCaLogin();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdgroup($keys[0]);

		$this->setCaLogin($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdgroup($this->ca_idgroup);

		$copyObj->setCaLogin($this->ca_login);


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
			self::$peer = new HdeskUserGroupPeer();
		}
		return self::$peer;
	}

	
	public function setHdeskGroup(HdeskGroup $v = null)
	{
		if ($v === null) {
			$this->setCaIdgroup(NULL);
		} else {
			$this->setCaIdgroup($v->getCaIdgroup());
		}

		$this->aHdeskGroup = $v;

						if ($v !== null) {
			$v->addHdeskUserGroup($this);
		}

		return $this;
	}


	
	public function getHdeskGroup(PropelPDO $con = null)
	{
		if ($this->aHdeskGroup === null && ($this->ca_idgroup !== null)) {
			$c = new Criteria(HdeskGroupPeer::DATABASE_NAME);
			$c->add(HdeskGroupPeer::CA_IDGROUP, $this->ca_idgroup);
			$this->aHdeskGroup = HdeskGroupPeer::doSelectOne($c, $con);
			
		}
		return $this->aHdeskGroup;
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
			$v->addHdeskUserGroup($this);
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
			$this->aHdeskGroup = null;
			$this->aUsuario = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseHdeskUserGroup:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseHdeskUserGroup::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 