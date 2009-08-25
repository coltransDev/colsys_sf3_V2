<?php


abstract class BaseHdeskResponse extends BaseObject  implements Persistent {


  const PEER = 'HdeskResponsePeer';

	
	protected static $peer;

	
	protected $ca_idresponse;

	
	protected $ca_idticket;

	
	protected $ca_responsetoresponse;

	
	protected $ca_login;

	
	protected $ca_createdat;

	
	protected $ca_text;

	
	protected $aHdeskTicket;

	
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

	
	public function getCaIdresponse()
	{
		return $this->ca_idresponse;
	}

	
	public function getCaIdticket()
	{
		return $this->ca_idticket;
	}

	
	public function getCaResponsetoresponse()
	{
		return $this->ca_responsetoresponse;
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

	
	public function setCaIdresponse($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idresponse !== $v) {
			$this->ca_idresponse = $v;
			$this->modifiedColumns[] = HdeskResponsePeer::CA_IDRESPONSE;
		}

		return $this;
	} 
	
	public function setCaIdticket($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idticket !== $v) {
			$this->ca_idticket = $v;
			$this->modifiedColumns[] = HdeskResponsePeer::CA_IDTICKET;
		}

		if ($this->aHdeskTicket !== null && $this->aHdeskTicket->getCaIdticket() !== $v) {
			$this->aHdeskTicket = null;
		}

		return $this;
	} 
	
	public function setCaResponsetoresponse($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_responsetoresponse !== $v) {
			$this->ca_responsetoresponse = $v;
			$this->modifiedColumns[] = HdeskResponsePeer::CA_RESPONSETORESPONSE;
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
			$this->modifiedColumns[] = HdeskResponsePeer::CA_LOGIN;
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
				$this->modifiedColumns[] = HdeskResponsePeer::CA_CREATEDAT;
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
			$this->modifiedColumns[] = HdeskResponsePeer::CA_TEXT;
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

			$this->ca_idresponse = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idticket = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_responsetoresponse = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_login = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_createdat = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_text = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HdeskResponse object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aHdeskTicket !== null && $this->ca_idticket !== $this->aHdeskTicket->getCaIdticket()) {
			$this->aHdeskTicket = null;
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
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = HdeskResponsePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aHdeskTicket = null;
			$this->aUsuario = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskResponse:delete:pre') as $callable)
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
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HdeskResponsePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseHdeskResponse:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskResponse:save:pre') as $callable)
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
			$con = Propel::getConnection(HdeskResponsePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseHdeskResponse:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			HdeskResponsePeer::addInstanceToPool($this);
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

												
			if ($this->aHdeskTicket !== null) {
				if ($this->aHdeskTicket->isModified() || $this->aHdeskTicket->isNew()) {
					$affectedRows += $this->aHdeskTicket->save($con);
				}
				$this->setHdeskTicket($this->aHdeskTicket);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = HdeskResponsePeer::CA_IDRESPONSE;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HdeskResponsePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdresponse($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HdeskResponsePeer::doUpdate($this, $con);
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


												
			if ($this->aHdeskTicket !== null) {
				if (!$this->aHdeskTicket->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHdeskTicket->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = HdeskResponsePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskResponsePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdresponse();
				break;
			case 1:
				return $this->getCaIdticket();
				break;
			case 2:
				return $this->getCaResponsetoresponse();
				break;
			case 3:
				return $this->getCaLogin();
				break;
			case 4:
				return $this->getCaCreatedat();
				break;
			case 5:
				return $this->getCaText();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = HdeskResponsePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdresponse(),
			$keys[1] => $this->getCaIdticket(),
			$keys[2] => $this->getCaResponsetoresponse(),
			$keys[3] => $this->getCaLogin(),
			$keys[4] => $this->getCaCreatedat(),
			$keys[5] => $this->getCaText(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskResponsePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdresponse($value);
				break;
			case 1:
				$this->setCaIdticket($value);
				break;
			case 2:
				$this->setCaResponsetoresponse($value);
				break;
			case 3:
				$this->setCaLogin($value);
				break;
			case 4:
				$this->setCaCreatedat($value);
				break;
			case 5:
				$this->setCaText($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HdeskResponsePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdresponse($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdticket($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaResponsetoresponse($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaLogin($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaCreatedat($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaText($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HdeskResponsePeer::DATABASE_NAME);

		if ($this->isColumnModified(HdeskResponsePeer::CA_IDRESPONSE)) $criteria->add(HdeskResponsePeer::CA_IDRESPONSE, $this->ca_idresponse);
		if ($this->isColumnModified(HdeskResponsePeer::CA_IDTICKET)) $criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);
		if ($this->isColumnModified(HdeskResponsePeer::CA_RESPONSETORESPONSE)) $criteria->add(HdeskResponsePeer::CA_RESPONSETORESPONSE, $this->ca_responsetoresponse);
		if ($this->isColumnModified(HdeskResponsePeer::CA_LOGIN)) $criteria->add(HdeskResponsePeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(HdeskResponsePeer::CA_CREATEDAT)) $criteria->add(HdeskResponsePeer::CA_CREATEDAT, $this->ca_createdat);
		if ($this->isColumnModified(HdeskResponsePeer::CA_TEXT)) $criteria->add(HdeskResponsePeer::CA_TEXT, $this->ca_text);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HdeskResponsePeer::DATABASE_NAME);

		$criteria->add(HdeskResponsePeer::CA_IDRESPONSE, $this->ca_idresponse);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdresponse();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdresponse($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdticket($this->ca_idticket);

		$copyObj->setCaResponsetoresponse($this->ca_responsetoresponse);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaCreatedat($this->ca_createdat);

		$copyObj->setCaText($this->ca_text);


		$copyObj->setNew(true);

		$copyObj->setCaIdresponse(NULL); 
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
			self::$peer = new HdeskResponsePeer();
		}
		return self::$peer;
	}

	
	public function setHdeskTicket(HdeskTicket $v = null)
	{
		if ($v === null) {
			$this->setCaIdticket(NULL);
		} else {
			$this->setCaIdticket($v->getCaIdticket());
		}

		$this->aHdeskTicket = $v;

						if ($v !== null) {
			$v->addHdeskResponse($this);
		}

		return $this;
	}


	
	public function getHdeskTicket(PropelPDO $con = null)
	{
		if ($this->aHdeskTicket === null && ($this->ca_idticket !== null)) {
			$c = new Criteria(HdeskTicketPeer::DATABASE_NAME);
			$c->add(HdeskTicketPeer::CA_IDTICKET, $this->ca_idticket);
			$this->aHdeskTicket = HdeskTicketPeer::doSelectOne($c, $con);
			
		}
		return $this->aHdeskTicket;
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
			$v->addHdeskResponse($this);
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
			$this->aHdeskTicket = null;
			$this->aUsuario = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseHdeskResponse:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseHdeskResponse::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 