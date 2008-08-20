<?php


abstract class BaseFalaInstructions extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $ca_iddoc;


	
	protected $ca_instructions;


	
	protected $ca_idfalainstructions;

	
	protected $aFalaHeader;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCaIddoc()
	{

		return $this->ca_iddoc;
	}

	
	public function getCaInstructions()
	{

		return $this->ca_instructions;
	}

	
	public function getCaIdfalainstructions()
	{

		return $this->ca_idfalainstructions;
	}

	
	public function setCaIddoc($v)
	{

		if ($this->ca_iddoc !== $v) {
			$this->ca_iddoc = $v;
			$this->modifiedColumns[] = FalaInstructionsPeer::CA_IDDOC;
		}

		if ($this->aFalaHeader !== null && $this->aFalaHeader->getCaIddoc() !== $v) {
			$this->aFalaHeader = null;
		}

	} 
	
	public function setCaInstructions($v)
	{

		if ($this->ca_instructions !== $v) {
			$this->ca_instructions = $v;
			$this->modifiedColumns[] = FalaInstructionsPeer::CA_INSTRUCTIONS;
		}

	} 
	
	public function setCaIdfalainstructions($v)
	{

		if ($this->ca_idfalainstructions !== $v) {
			$this->ca_idfalainstructions = $v;
			$this->modifiedColumns[] = FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ca_iddoc = $rs->getString($startcol + 0);

			$this->ca_instructions = $rs->getString($startcol + 1);

			$this->ca_idfalainstructions = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FalaInstructions object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FalaInstructionsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FalaInstructionsPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aFalaHeader !== null) {
				if ($this->aFalaHeader->isModified()) {
					$affectedRows += $this->aFalaHeader->save($con);
				}
				$this->setFalaHeader($this->aFalaHeader);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FalaInstructionsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += FalaInstructionsPeer::doUpdate($this, $con);
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


												
			if ($this->aFalaHeader !== null) {
				if (!$this->aFalaHeader->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFalaHeader->getValidationFailures());
				}
			}


			if (($retval = FalaInstructionsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaInstructionsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIddoc();
				break;
			case 1:
				return $this->getCaInstructions();
				break;
			case 2:
				return $this->getCaIdfalainstructions();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FalaInstructionsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIddoc(),
			$keys[1] => $this->getCaInstructions(),
			$keys[2] => $this->getCaIdfalainstructions(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FalaInstructionsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIddoc($value);
				break;
			case 1:
				$this->setCaInstructions($value);
				break;
			case 2:
				$this->setCaIdfalainstructions($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FalaInstructionsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIddoc($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaInstructions($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdfalainstructions($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FalaInstructionsPeer::DATABASE_NAME);

		if ($this->isColumnModified(FalaInstructionsPeer::CA_IDDOC)) $criteria->add(FalaInstructionsPeer::CA_IDDOC, $this->ca_iddoc);
		if ($this->isColumnModified(FalaInstructionsPeer::CA_INSTRUCTIONS)) $criteria->add(FalaInstructionsPeer::CA_INSTRUCTIONS, $this->ca_instructions);
		if ($this->isColumnModified(FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS)) $criteria->add(FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS, $this->ca_idfalainstructions);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FalaInstructionsPeer::DATABASE_NAME);

		$criteria->add(FalaInstructionsPeer::CA_IDFALAINSTRUCTIONS, $this->ca_idfalainstructions);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdfalainstructions();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdfalainstructions($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIddoc($this->ca_iddoc);

		$copyObj->setCaInstructions($this->ca_instructions);


		$copyObj->setNew(true);

		$copyObj->setCaIdfalainstructions(NULL); 
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
			self::$peer = new FalaInstructionsPeer();
		}
		return self::$peer;
	}

	
	public function setFalaHeader($v)
	{


		if ($v === null) {
			$this->setCaIddoc(NULL);
		} else {
			$this->setCaIddoc($v->getCaIddoc());
		}


		$this->aFalaHeader = $v;
	}


	
	public function getFalaHeader($con = null)
	{
				include_once 'lib/model/falabella/om/BaseFalaHeaderPeer.php';

		if ($this->aFalaHeader === null && (($this->ca_iddoc !== "" && $this->ca_iddoc !== null))) {

			$this->aFalaHeader = FalaHeaderPeer::retrieveByPK($this->ca_iddoc, $con);

			
		}
		return $this->aFalaHeader;
	}

} 