<?php


abstract class BaseFileImported extends BaseObject  implements Persistent {


  const PEER = 'FileImportedPeer';

	
	protected static $peer;

	
	protected $ca_idfileheader;

	
	protected $ca_fchimportacion;

	
	protected $ca_content;

	
	protected $ca_usuario;

	
	protected $ca_procesado;

	
	protected $ca_nombre;

	
	protected $aFileHeader;

	
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

	
	public function getCaIdfileheader()
	{
		return $this->ca_idfileheader;
	}

	
	public function getCaFchimportacion($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchimportacion === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchimportacion);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchimportacion, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaContent()
	{
		return $this->ca_content;
	}

	
	public function getCaUsuario()
	{
		return $this->ca_usuario;
	}

	
	public function getCaProcesado()
	{
		return $this->ca_procesado;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function setCaIdfileheader($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idfileheader !== $v) {
			$this->ca_idfileheader = $v;
			$this->modifiedColumns[] = FileImportedPeer::CA_IDFILEHEADER;
		}

		if ($this->aFileHeader !== null && $this->aFileHeader->getCaIdfileheader() !== $v) {
			$this->aFileHeader = null;
		}

		return $this;
	} 
	
	public function setCaFchimportacion($v)
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

		if ( $this->ca_fchimportacion !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchimportacion !== null && $tmpDt = new DateTime($this->ca_fchimportacion)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchimportacion = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = FileImportedPeer::CA_FCHIMPORTACION;
			}
		} 
		return $this;
	} 
	
	public function setCaContent($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_content !== $v) {
			$this->ca_content = $v;
			$this->modifiedColumns[] = FileImportedPeer::CA_CONTENT;
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
			$this->modifiedColumns[] = FileImportedPeer::CA_USUARIO;
		}

		return $this;
	} 
	
	public function setCaProcesado($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_procesado !== $v) {
			$this->ca_procesado = $v;
			$this->modifiedColumns[] = FileImportedPeer::CA_PROCESADO;
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
			$this->modifiedColumns[] = FileImportedPeer::CA_NOMBRE;
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

			$this->ca_idfileheader = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_fchimportacion = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_content = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_usuario = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_procesado = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->ca_nombre = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FileImported object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aFileHeader !== null && $this->ca_idfileheader !== $this->aFileHeader->getCaIdfileheader()) {
			$this->aFileHeader = null;
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
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = FileImportedPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aFileHeader = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileImported:delete:pre') as $callable)
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
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			FileImportedPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFileImported:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseFileImported:save:pre') as $callable)
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
			$con = Propel::getConnection(FileImportedPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFileImported:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			FileImportedPeer::addInstanceToPool($this);
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

												
			if ($this->aFileHeader !== null) {
				if ($this->aFileHeader->isModified() || $this->aFileHeader->isNew()) {
					$affectedRows += $this->aFileHeader->save($con);
				}
				$this->setFileHeader($this->aFileHeader);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FileImportedPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += FileImportedPeer::doUpdate($this, $con);
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


												
			if ($this->aFileHeader !== null) {
				if (!$this->aFileHeader->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFileHeader->getValidationFailures());
				}
			}


			if (($retval = FileImportedPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FileImportedPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdfileheader();
				break;
			case 1:
				return $this->getCaFchimportacion();
				break;
			case 2:
				return $this->getCaContent();
				break;
			case 3:
				return $this->getCaUsuario();
				break;
			case 4:
				return $this->getCaProcesado();
				break;
			case 5:
				return $this->getCaNombre();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = FileImportedPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdfileheader(),
			$keys[1] => $this->getCaFchimportacion(),
			$keys[2] => $this->getCaContent(),
			$keys[3] => $this->getCaUsuario(),
			$keys[4] => $this->getCaProcesado(),
			$keys[5] => $this->getCaNombre(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FileImportedPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdfileheader($value);
				break;
			case 1:
				$this->setCaFchimportacion($value);
				break;
			case 2:
				$this->setCaContent($value);
				break;
			case 3:
				$this->setCaUsuario($value);
				break;
			case 4:
				$this->setCaProcesado($value);
				break;
			case 5:
				$this->setCaNombre($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FileImportedPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdfileheader($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFchimportacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaContent($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaUsuario($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaProcesado($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNombre($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FileImportedPeer::DATABASE_NAME);

		if ($this->isColumnModified(FileImportedPeer::CA_IDFILEHEADER)) $criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->ca_idfileheader);
		if ($this->isColumnModified(FileImportedPeer::CA_FCHIMPORTACION)) $criteria->add(FileImportedPeer::CA_FCHIMPORTACION, $this->ca_fchimportacion);
		if ($this->isColumnModified(FileImportedPeer::CA_CONTENT)) $criteria->add(FileImportedPeer::CA_CONTENT, $this->ca_content);
		if ($this->isColumnModified(FileImportedPeer::CA_USUARIO)) $criteria->add(FileImportedPeer::CA_USUARIO, $this->ca_usuario);
		if ($this->isColumnModified(FileImportedPeer::CA_PROCESADO)) $criteria->add(FileImportedPeer::CA_PROCESADO, $this->ca_procesado);
		if ($this->isColumnModified(FileImportedPeer::CA_NOMBRE)) $criteria->add(FileImportedPeer::CA_NOMBRE, $this->ca_nombre);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FileImportedPeer::DATABASE_NAME);

		$criteria->add(FileImportedPeer::CA_IDFILEHEADER, $this->ca_idfileheader);
		$criteria->add(FileImportedPeer::CA_FCHIMPORTACION, $this->ca_fchimportacion);
		$criteria->add(FileImportedPeer::CA_NOMBRE, $this->ca_nombre);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdfileheader();

		$pks[1] = $this->getCaFchimportacion();

		$pks[2] = $this->getCaNombre();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdfileheader($keys[0]);

		$this->setCaFchimportacion($keys[1]);

		$this->setCaNombre($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdfileheader($this->ca_idfileheader);

		$copyObj->setCaFchimportacion($this->ca_fchimportacion);

		$copyObj->setCaContent($this->ca_content);

		$copyObj->setCaUsuario($this->ca_usuario);

		$copyObj->setCaProcesado($this->ca_procesado);

		$copyObj->setCaNombre($this->ca_nombre);


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
			self::$peer = new FileImportedPeer();
		}
		return self::$peer;
	}

	
	public function setFileHeader(FileHeader $v = null)
	{
		if ($v === null) {
			$this->setCaIdfileheader(NULL);
		} else {
			$this->setCaIdfileheader($v->getCaIdfileheader());
		}

		$this->aFileHeader = $v;

						if ($v !== null) {
			$v->addFileImported($this);
		}

		return $this;
	}


	
	public function getFileHeader(PropelPDO $con = null)
	{
		if ($this->aFileHeader === null && ($this->ca_idfileheader !== null)) {
			$c = new Criteria(FileHeaderPeer::DATABASE_NAME);
			$c->add(FileHeaderPeer::CA_IDFILEHEADER, $this->ca_idfileheader);
			$this->aFileHeader = FileHeaderPeer::doSelectOne($c, $con);
			
		}
		return $this->aFileHeader;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aFileHeader = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFileImported:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFileImported::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 