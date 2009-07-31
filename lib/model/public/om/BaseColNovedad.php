<?php


abstract class BaseColNovedad extends BaseObject  implements Persistent {


  const PEER = 'ColNovedadPeer';

	
	protected static $peer;

	
	protected $ca_idnovedad;

	
	protected $ca_fchpublicacion;

	
	protected $ca_asunto;

	
	protected $ca_detalle;

	
	protected $ca_fcharchivar;

	
	protected $ca_extension;

	
	protected $ca_header_file;

	
	protected $ca_content;

	
	protected $ca_fchpublicado;

	
	protected $ca_usupublicado;

	
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

	
	public function getCaIdnovedad()
	{
		return $this->ca_idnovedad;
	}

	
	public function getCaFchpublicacion($format = 'Y-m-d')
	{
		if ($this->ca_fchpublicacion === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchpublicacion);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchpublicacion, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaAsunto()
	{
		return $this->ca_asunto;
	}

	
	public function getCaDetalle()
	{
		return $this->ca_detalle;
	}

	
	public function getCaFcharchivar($format = 'Y-m-d')
	{
		if ($this->ca_fcharchivar === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fcharchivar);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fcharchivar, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaExtension()
	{
		return $this->ca_extension;
	}

	
	public function getCaHeaderFile()
	{
		return $this->ca_header_file;
	}

	
	public function getCaContent()
	{
		return $this->ca_content;
	}

	
	public function getCaFchpublicado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchpublicado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchpublicado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchpublicado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsupublicado()
	{
		return $this->ca_usupublicado;
	}

	
	public function setCaIdnovedad($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idnovedad !== $v) {
			$this->ca_idnovedad = $v;
			$this->modifiedColumns[] = ColNovedadPeer::CA_IDNOVEDAD;
		}

		return $this;
	} 
	
	public function setCaFchpublicacion($v)
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

		if ( $this->ca_fchpublicacion !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchpublicacion !== null && $tmpDt = new DateTime($this->ca_fchpublicacion)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchpublicacion = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ColNovedadPeer::CA_FCHPUBLICACION;
			}
		} 
		return $this;
	} 
	
	public function setCaAsunto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_asunto !== $v) {
			$this->ca_asunto = $v;
			$this->modifiedColumns[] = ColNovedadPeer::CA_ASUNTO;
		}

		return $this;
	} 
	
	public function setCaDetalle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_detalle !== $v) {
			$this->ca_detalle = $v;
			$this->modifiedColumns[] = ColNovedadPeer::CA_DETALLE;
		}

		return $this;
	} 
	
	public function setCaFcharchivar($v)
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

		if ( $this->ca_fcharchivar !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fcharchivar !== null && $tmpDt = new DateTime($this->ca_fcharchivar)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fcharchivar = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = ColNovedadPeer::CA_FCHARCHIVAR;
			}
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
			$this->modifiedColumns[] = ColNovedadPeer::CA_EXTENSION;
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
			$this->modifiedColumns[] = ColNovedadPeer::CA_HEADER_FILE;
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
		$this->modifiedColumns[] = ColNovedadPeer::CA_CONTENT;

		return $this;
	} 
	
	public function setCaFchpublicado($v)
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

		if ( $this->ca_fchpublicado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchpublicado !== null && $tmpDt = new DateTime($this->ca_fchpublicado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchpublicado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = ColNovedadPeer::CA_FCHPUBLICADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsupublicado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usupublicado !== $v) {
			$this->ca_usupublicado = $v;
			$this->modifiedColumns[] = ColNovedadPeer::CA_USUPUBLICADO;
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

			$this->ca_idnovedad = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_fchpublicacion = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_asunto = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_detalle = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fcharchivar = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_extension = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_header_file = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_content = $row[$startcol + 7];
			$this->ca_fchpublicado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_usupublicado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ColNovedad object", $e);
		}
	}

	
	public function ensureConsistency()
	{

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
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = ColNovedadPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseColNovedad:delete:pre') as $callable)
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
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			ColNovedadPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseColNovedad:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseColNovedad:save:pre') as $callable)
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
			$con = Propel::getConnection(ColNovedadPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseColNovedad:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			ColNovedadPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = ColNovedadPeer::CA_IDNOVEDAD;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ColNovedadPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdnovedad($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ColNovedadPeer::doUpdate($this, $con);
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


			if (($retval = ColNovedadPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ColNovedadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdnovedad();
				break;
			case 1:
				return $this->getCaFchpublicacion();
				break;
			case 2:
				return $this->getCaAsunto();
				break;
			case 3:
				return $this->getCaDetalle();
				break;
			case 4:
				return $this->getCaFcharchivar();
				break;
			case 5:
				return $this->getCaExtension();
				break;
			case 6:
				return $this->getCaHeaderFile();
				break;
			case 7:
				return $this->getCaContent();
				break;
			case 8:
				return $this->getCaFchpublicado();
				break;
			case 9:
				return $this->getCaUsupublicado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = ColNovedadPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdnovedad(),
			$keys[1] => $this->getCaFchpublicacion(),
			$keys[2] => $this->getCaAsunto(),
			$keys[3] => $this->getCaDetalle(),
			$keys[4] => $this->getCaFcharchivar(),
			$keys[5] => $this->getCaExtension(),
			$keys[6] => $this->getCaHeaderFile(),
			$keys[7] => $this->getCaContent(),
			$keys[8] => $this->getCaFchpublicado(),
			$keys[9] => $this->getCaUsupublicado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ColNovedadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdnovedad($value);
				break;
			case 1:
				$this->setCaFchpublicacion($value);
				break;
			case 2:
				$this->setCaAsunto($value);
				break;
			case 3:
				$this->setCaDetalle($value);
				break;
			case 4:
				$this->setCaFcharchivar($value);
				break;
			case 5:
				$this->setCaExtension($value);
				break;
			case 6:
				$this->setCaHeaderFile($value);
				break;
			case 7:
				$this->setCaContent($value);
				break;
			case 8:
				$this->setCaFchpublicado($value);
				break;
			case 9:
				$this->setCaUsupublicado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ColNovedadPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdnovedad($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaFchpublicacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaAsunto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDetalle($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFcharchivar($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaExtension($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaHeaderFile($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaContent($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFchpublicado($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaUsupublicado($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ColNovedadPeer::DATABASE_NAME);

		if ($this->isColumnModified(ColNovedadPeer::CA_IDNOVEDAD)) $criteria->add(ColNovedadPeer::CA_IDNOVEDAD, $this->ca_idnovedad);
		if ($this->isColumnModified(ColNovedadPeer::CA_FCHPUBLICACION)) $criteria->add(ColNovedadPeer::CA_FCHPUBLICACION, $this->ca_fchpublicacion);
		if ($this->isColumnModified(ColNovedadPeer::CA_ASUNTO)) $criteria->add(ColNovedadPeer::CA_ASUNTO, $this->ca_asunto);
		if ($this->isColumnModified(ColNovedadPeer::CA_DETALLE)) $criteria->add(ColNovedadPeer::CA_DETALLE, $this->ca_detalle);
		if ($this->isColumnModified(ColNovedadPeer::CA_FCHARCHIVAR)) $criteria->add(ColNovedadPeer::CA_FCHARCHIVAR, $this->ca_fcharchivar);
		if ($this->isColumnModified(ColNovedadPeer::CA_EXTENSION)) $criteria->add(ColNovedadPeer::CA_EXTENSION, $this->ca_extension);
		if ($this->isColumnModified(ColNovedadPeer::CA_HEADER_FILE)) $criteria->add(ColNovedadPeer::CA_HEADER_FILE, $this->ca_header_file);
		if ($this->isColumnModified(ColNovedadPeer::CA_CONTENT)) $criteria->add(ColNovedadPeer::CA_CONTENT, $this->ca_content);
		if ($this->isColumnModified(ColNovedadPeer::CA_FCHPUBLICADO)) $criteria->add(ColNovedadPeer::CA_FCHPUBLICADO, $this->ca_fchpublicado);
		if ($this->isColumnModified(ColNovedadPeer::CA_USUPUBLICADO)) $criteria->add(ColNovedadPeer::CA_USUPUBLICADO, $this->ca_usupublicado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ColNovedadPeer::DATABASE_NAME);

		$criteria->add(ColNovedadPeer::CA_IDNOVEDAD, $this->ca_idnovedad);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdnovedad();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdnovedad($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaFchpublicacion($this->ca_fchpublicacion);

		$copyObj->setCaAsunto($this->ca_asunto);

		$copyObj->setCaDetalle($this->ca_detalle);

		$copyObj->setCaFcharchivar($this->ca_fcharchivar);

		$copyObj->setCaExtension($this->ca_extension);

		$copyObj->setCaHeaderFile($this->ca_header_file);

		$copyObj->setCaContent($this->ca_content);

		$copyObj->setCaFchpublicado($this->ca_fchpublicado);

		$copyObj->setCaUsupublicado($this->ca_usupublicado);


		$copyObj->setNew(true);

		$copyObj->setCaIdnovedad(NULL); 
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
			self::$peer = new ColNovedadPeer();
		}
		return self::$peer;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseColNovedad:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseColNovedad::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 