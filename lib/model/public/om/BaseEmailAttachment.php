<?php


abstract class BaseEmailAttachment extends BaseObject  implements Persistent {


  const PEER = 'EmailAttachmentPeer';

	
	protected static $peer;

	
	protected $ca_idattachment;

	
	protected $ca_idemail;

	
	protected $ca_extension;

	
	protected $ca_header_file;

	
	protected $ca_filesize;

	
	protected $ca_content;

	
	protected $aEmail;

	
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

	
	public function getCaIdattachment()
	{
		return $this->ca_idattachment;
	}

	
	public function getCaIdemail()
	{
		return $this->ca_idemail;
	}

	
	public function getCaExtension()
	{
		return $this->ca_extension;
	}

	
	public function getCaHeaderFile()
	{
		return $this->ca_header_file;
	}

	
	public function getCaFilesize()
	{
		return $this->ca_filesize;
	}

	
	public function getCaContent()
	{
		return $this->ca_content;
	}

	
	public function setCaIdattachment($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idattachment !== $v) {
			$this->ca_idattachment = $v;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_IDATTACHMENT;
		}

		return $this;
	} 
	
	public function setCaIdemail($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idemail !== $v) {
			$this->ca_idemail = $v;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_IDEMAIL;
		}

		if ($this->aEmail !== null && $this->aEmail->getCaIdemail() !== $v) {
			$this->aEmail = null;
		}

		return $this;
	} 
	
	public function setCaExtension($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_extension !== $v) {
			$this->ca_extension = $v;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_EXTENSION;
		}

		return $this;
	} 
	
	public function setCaHeaderFile($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_header_file !== $v) {
			$this->ca_header_file = $v;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_HEADER_FILE;
		}

		return $this;
	} 
	
	public function setCaFilesize($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_filesize !== $v) {
			$this->ca_filesize = $v;
			$this->modifiedColumns[] = EmailAttachmentPeer::CA_FILESIZE;
		}

		return $this;
	} 
	
	public function setCaContent($v)
	{
								if (!is_resource($v)) {
			$this->ca_content = fopen('php://memory', 'r+');
			fwrite($this->ca_content, $v);
			rewind($this->ca_content);
		} else { 			$this->ca_content = $v;
		}
		$this->modifiedColumns[] = EmailAttachmentPeer::CA_CONTENT;

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

			$this->ca_idattachment = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idemail = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_extension = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_header_file = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_filesize = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_content = $row[$startcol + 5];
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating EmailAttachment object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aEmail !== null && $this->ca_idemail !== $this->aEmail->getCaIdemail()) {
			$this->aEmail = null;
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
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = EmailAttachmentPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aEmail = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailAttachment:delete:pre') as $callable)
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
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			EmailAttachmentPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseEmailAttachment:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseEmailAttachment:save:pre') as $callable)
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
			$con = Propel::getConnection(EmailAttachmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseEmailAttachment:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			EmailAttachmentPeer::addInstanceToPool($this);
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

												
			if ($this->aEmail !== null) {
				if ($this->aEmail->isModified() || $this->aEmail->isNew()) {
					$affectedRows += $this->aEmail->save($con);
				}
				$this->setEmail($this->aEmail);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = EmailAttachmentPeer::CA_IDATTACHMENT;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = EmailAttachmentPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdattachment($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += EmailAttachmentPeer::doUpdate($this, $con);
				}

								if ($this->ca_content !== null && is_resource($this->ca_content)) {
					rewind($this->ca_content);
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


												
			if ($this->aEmail !== null) {
				if (!$this->aEmail->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aEmail->getValidationFailures());
				}
			}


			if (($retval = EmailAttachmentPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailAttachmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdattachment();
				break;
			case 1:
				return $this->getCaIdemail();
				break;
			case 2:
				return $this->getCaExtension();
				break;
			case 3:
				return $this->getCaHeaderFile();
				break;
			case 4:
				return $this->getCaFilesize();
				break;
			case 5:
				return $this->getCaContent();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = EmailAttachmentPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdattachment(),
			$keys[1] => $this->getCaIdemail(),
			$keys[2] => $this->getCaExtension(),
			$keys[3] => $this->getCaHeaderFile(),
			$keys[4] => $this->getCaFilesize(),
			$keys[5] => $this->getCaContent(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = EmailAttachmentPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdattachment($value);
				break;
			case 1:
				$this->setCaIdemail($value);
				break;
			case 2:
				$this->setCaExtension($value);
				break;
			case 3:
				$this->setCaHeaderFile($value);
				break;
			case 4:
				$this->setCaFilesize($value);
				break;
			case 5:
				$this->setCaContent($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = EmailAttachmentPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdattachment($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdemail($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaExtension($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaHeaderFile($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFilesize($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaContent($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(EmailAttachmentPeer::DATABASE_NAME);

		if ($this->isColumnModified(EmailAttachmentPeer::CA_IDATTACHMENT)) $criteria->add(EmailAttachmentPeer::CA_IDATTACHMENT, $this->ca_idattachment);
		if ($this->isColumnModified(EmailAttachmentPeer::CA_IDEMAIL)) $criteria->add(EmailAttachmentPeer::CA_IDEMAIL, $this->ca_idemail);
		if ($this->isColumnModified(EmailAttachmentPeer::CA_EXTENSION)) $criteria->add(EmailAttachmentPeer::CA_EXTENSION, $this->ca_extension);
		if ($this->isColumnModified(EmailAttachmentPeer::CA_HEADER_FILE)) $criteria->add(EmailAttachmentPeer::CA_HEADER_FILE, $this->ca_header_file);
		if ($this->isColumnModified(EmailAttachmentPeer::CA_FILESIZE)) $criteria->add(EmailAttachmentPeer::CA_FILESIZE, $this->ca_filesize);
		if ($this->isColumnModified(EmailAttachmentPeer::CA_CONTENT)) $criteria->add(EmailAttachmentPeer::CA_CONTENT, $this->ca_content);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(EmailAttachmentPeer::DATABASE_NAME);

		$criteria->add(EmailAttachmentPeer::CA_IDATTACHMENT, $this->ca_idattachment);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdattachment();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdattachment($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdemail($this->ca_idemail);

		$copyObj->setCaExtension($this->ca_extension);

		$copyObj->setCaHeaderFile($this->ca_header_file);

		$copyObj->setCaFilesize($this->ca_filesize);

		$copyObj->setCaContent($this->ca_content);


		$copyObj->setNew(true);

		$copyObj->setCaIdattachment(NULL); 
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
			self::$peer = new EmailAttachmentPeer();
		}
		return self::$peer;
	}

	
	public function setEmail(Email $v = null)
	{
		if ($v === null) {
			$this->setCaIdemail(NULL);
		} else {
			$this->setCaIdemail($v->getCaIdemail());
		}

		$this->aEmail = $v;

						if ($v !== null) {
			$v->addEmailAttachment($this);
		}

		return $this;
	}


	
	public function getEmail(PropelPDO $con = null)
	{
		if ($this->aEmail === null && ($this->ca_idemail !== null)) {
			$c = new Criteria(EmailPeer::DATABASE_NAME);
			$c->add(EmailPeer::CA_IDEMAIL, $this->ca_idemail);
			$this->aEmail = EmailPeer::doSelectOne($c, $con);
			
		}
		return $this->aEmail;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aEmail = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseEmailAttachment:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseEmailAttachment::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 