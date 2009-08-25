<?php


abstract class BaseHdeskKBase extends BaseObject  implements Persistent {


  const PEER = 'HdeskKBasePeer';

	
	protected static $peer;

	
	protected $ca_idkbase;

	
	protected $ca_idcategory;

	
	protected $ca_login;

	
	protected $ca_createdat;

	
	protected $ca_text;

	
	protected $ca_title;

	
	protected $ca_private;

	
	protected $aHdeskKBaseCategory;

	
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

	
	public function getCaIdkbase()
	{
		return $this->ca_idkbase;
	}

	
	public function getCaIdcategory()
	{
		return $this->ca_idcategory;
	}

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function getCaCreatedat($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_createdat === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_createdat);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_createdat, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaText()
	{
		return $this->ca_text;
	}

	
	public function getCaTitle()
	{
		return $this->ca_title;
	}

	
	public function getCaPrivate()
	{
		return $this->ca_private;
	}

	
	public function setCaIdkbase($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idkbase !== $v) {
			$this->ca_idkbase = $v;
			$this->modifiedColumns[] = HdeskKBasePeer::CA_IDKBASE;
		}

		return $this;
	} 
	
	public function setCaIdcategory($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcategory !== $v) {
			$this->ca_idcategory = $v;
			$this->modifiedColumns[] = HdeskKBasePeer::CA_IDCATEGORY;
		}

		if ($this->aHdeskKBaseCategory !== null && $this->aHdeskKBaseCategory->getCaIdcategory() !== $v) {
			$this->aHdeskKBaseCategory = null;
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
			$this->modifiedColumns[] = HdeskKBasePeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
		}

		return $this;
	} 
	
	public function setCaCreatedat($v)
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

		if ( $this->ca_createdat !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_createdat !== null && $tmpDt = new DateTime($this->ca_createdat)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_createdat = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = HdeskKBasePeer::CA_CREATEDAT;
			}
		} 
		return $this;
	} 
	
	public function setCaText($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_text !== $v) {
			$this->ca_text = $v;
			$this->modifiedColumns[] = HdeskKBasePeer::CA_TEXT;
		}

		return $this;
	} 
	
	public function setCaTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_title !== $v) {
			$this->ca_title = $v;
			$this->modifiedColumns[] = HdeskKBasePeer::CA_TITLE;
		}

		return $this;
	} 
	
	public function setCaPrivate($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_private !== $v) {
			$this->ca_private = $v;
			$this->modifiedColumns[] = HdeskKBasePeer::CA_PRIVATE;
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

			$this->ca_idkbase = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idcategory = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_login = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_createdat = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_text = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_title = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_private = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HdeskKBase object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aHdeskKBaseCategory !== null && $this->ca_idcategory !== $this->aHdeskKBaseCategory->getCaIdcategory()) {
			$this->aHdeskKBaseCategory = null;
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
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = HdeskKBasePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aHdeskKBaseCategory = null;
			$this->aUsuario = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskKBase:delete:pre') as $callable)
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
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HdeskKBasePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseHdeskKBase:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskKBase:save:pre') as $callable)
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
			$con = Propel::getConnection(HdeskKBasePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseHdeskKBase:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			HdeskKBasePeer::addInstanceToPool($this);
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

												
			if ($this->aHdeskKBaseCategory !== null) {
				if ($this->aHdeskKBaseCategory->isModified() || $this->aHdeskKBaseCategory->isNew()) {
					$affectedRows += $this->aHdeskKBaseCategory->save($con);
				}
				$this->setHdeskKBaseCategory($this->aHdeskKBaseCategory);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = HdeskKBasePeer::CA_IDKBASE;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HdeskKBasePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdkbase($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HdeskKBasePeer::doUpdate($this, $con);
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


												
			if ($this->aHdeskKBaseCategory !== null) {
				if (!$this->aHdeskKBaseCategory->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHdeskKBaseCategory->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = HdeskKBasePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskKBasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdkbase();
				break;
			case 1:
				return $this->getCaIdcategory();
				break;
			case 2:
				return $this->getCaLogin();
				break;
			case 3:
				return $this->getCaCreatedat();
				break;
			case 4:
				return $this->getCaText();
				break;
			case 5:
				return $this->getCaTitle();
				break;
			case 6:
				return $this->getCaPrivate();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = HdeskKBasePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdkbase(),
			$keys[1] => $this->getCaIdcategory(),
			$keys[2] => $this->getCaLogin(),
			$keys[3] => $this->getCaCreatedat(),
			$keys[4] => $this->getCaText(),
			$keys[5] => $this->getCaTitle(),
			$keys[6] => $this->getCaPrivate(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskKBasePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdkbase($value);
				break;
			case 1:
				$this->setCaIdcategory($value);
				break;
			case 2:
				$this->setCaLogin($value);
				break;
			case 3:
				$this->setCaCreatedat($value);
				break;
			case 4:
				$this->setCaText($value);
				break;
			case 5:
				$this->setCaTitle($value);
				break;
			case 6:
				$this->setCaPrivate($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HdeskKBasePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdkbase($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcategory($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaLogin($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaCreatedat($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaText($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTitle($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaPrivate($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HdeskKBasePeer::DATABASE_NAME);

		if ($this->isColumnModified(HdeskKBasePeer::CA_IDKBASE)) $criteria->add(HdeskKBasePeer::CA_IDKBASE, $this->ca_idkbase);
		if ($this->isColumnModified(HdeskKBasePeer::CA_IDCATEGORY)) $criteria->add(HdeskKBasePeer::CA_IDCATEGORY, $this->ca_idcategory);
		if ($this->isColumnModified(HdeskKBasePeer::CA_LOGIN)) $criteria->add(HdeskKBasePeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(HdeskKBasePeer::CA_CREATEDAT)) $criteria->add(HdeskKBasePeer::CA_CREATEDAT, $this->ca_createdat);
		if ($this->isColumnModified(HdeskKBasePeer::CA_TEXT)) $criteria->add(HdeskKBasePeer::CA_TEXT, $this->ca_text);
		if ($this->isColumnModified(HdeskKBasePeer::CA_TITLE)) $criteria->add(HdeskKBasePeer::CA_TITLE, $this->ca_title);
		if ($this->isColumnModified(HdeskKBasePeer::CA_PRIVATE)) $criteria->add(HdeskKBasePeer::CA_PRIVATE, $this->ca_private);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HdeskKBasePeer::DATABASE_NAME);

		$criteria->add(HdeskKBasePeer::CA_IDKBASE, $this->ca_idkbase);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdkbase();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdkbase($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcategory($this->ca_idcategory);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaCreatedat($this->ca_createdat);

		$copyObj->setCaText($this->ca_text);

		$copyObj->setCaTitle($this->ca_title);

		$copyObj->setCaPrivate($this->ca_private);


		$copyObj->setNew(true);

		$copyObj->setCaIdkbase(NULL); 
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
			self::$peer = new HdeskKBasePeer();
		}
		return self::$peer;
	}

	
	public function setHdeskKBaseCategory(HdeskKBaseCategory $v = null)
	{
		if ($v === null) {
			$this->setCaIdcategory(NULL);
		} else {
			$this->setCaIdcategory($v->getCaIdcategory());
		}

		$this->aHdeskKBaseCategory = $v;

						if ($v !== null) {
			$v->addHdeskKBase($this);
		}

		return $this;
	}


	
	public function getHdeskKBaseCategory(PropelPDO $con = null)
	{
		if ($this->aHdeskKBaseCategory === null && ($this->ca_idcategory !== null)) {
			$c = new Criteria(HdeskKBaseCategoryPeer::DATABASE_NAME);
			$c->add(HdeskKBaseCategoryPeer::CA_IDCATEGORY, $this->ca_idcategory);
			$this->aHdeskKBaseCategory = HdeskKBaseCategoryPeer::doSelectOne($c, $con);
			
		}
		return $this->aHdeskKBaseCategory;
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
			$v->addHdeskKBase($this);
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
			$this->aHdeskKBaseCategory = null;
			$this->aUsuario = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseHdeskKBase:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseHdeskKBase::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 