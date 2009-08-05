<?php


abstract class BaseIdsDocumento extends BaseObject  implements Persistent {


  const PEER = 'IdsDocumentoPeer';

	
	protected static $peer;

	
	protected $ca_iddocumento;

	
	protected $ca_id;

	
	protected $ca_idtipo;

	
	protected $ca_ubicacion;

	
	protected $ca_fchinicio;

	
	protected $ca_fchvencimiento;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $aIds;

	
	protected $aIdsTipoDocumento;

	
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

	
	public function getCaIddocumento()
	{
		return $this->ca_iddocumento;
	}

	
	public function getCaId()
	{
		return $this->ca_id;
	}

	
	public function getCaIdtipo()
	{
		return $this->ca_idtipo;
	}

	
	public function getCaUbicacion()
	{
		return $this->ca_ubicacion;
	}

	
	public function getCaFchinicio($format = 'Y-m-d')
	{
		if ($this->ca_fchinicio === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchinicio);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchinicio, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaFchvencimiento($format = 'Y-m-d')
	{
		if ($this->ca_fchvencimiento === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchvencimiento);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchvencimiento, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
	}

	
	public function getCaFchcreado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchcreado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcreado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcreado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsucreado()
	{
		return $this->ca_usucreado;
	}

	
	public function setCaIddocumento($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_iddocumento !== $v) {
			$this->ca_iddocumento = $v;
			$this->modifiedColumns[] = IdsDocumentoPeer::CA_IDDOCUMENTO;
		}

		return $this;
	} 
	
	public function setCaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_id !== $v) {
			$this->ca_id = $v;
			$this->modifiedColumns[] = IdsDocumentoPeer::CA_ID;
		}

		if ($this->aIds !== null && $this->aIds->getCaId() !== $v) {
			$this->aIds = null;
		}

		return $this;
	} 
	
	public function setCaIdtipo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtipo !== $v) {
			$this->ca_idtipo = $v;
			$this->modifiedColumns[] = IdsDocumentoPeer::CA_IDTIPO;
		}

		if ($this->aIdsTipoDocumento !== null && $this->aIdsTipoDocumento->getCaIdtipo() !== $v) {
			$this->aIdsTipoDocumento = null;
		}

		return $this;
	} 
	
	public function setCaUbicacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_ubicacion !== $v) {
			$this->ca_ubicacion = $v;
			$this->modifiedColumns[] = IdsDocumentoPeer::CA_UBICACION;
		}

		return $this;
	} 
	
	public function setCaFchinicio($v)
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

		if ( $this->ca_fchinicio !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchinicio !== null && $tmpDt = new DateTime($this->ca_fchinicio)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchinicio = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = IdsDocumentoPeer::CA_FCHINICIO;
			}
		} 
		return $this;
	} 
	
	public function setCaFchvencimiento($v)
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

		if ( $this->ca_fchvencimiento !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchvencimiento !== null && $tmpDt = new DateTime($this->ca_fchvencimiento)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchvencimiento = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = IdsDocumentoPeer::CA_FCHVENCIMIENTO;
			}
		} 
		return $this;
	} 
	
	public function setCaObservaciones($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_observaciones !== $v) {
			$this->ca_observaciones = $v;
			$this->modifiedColumns[] = IdsDocumentoPeer::CA_OBSERVACIONES;
		}

		return $this;
	} 
	
	public function setCaFchcreado($v)
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

		if ( $this->ca_fchcreado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = IdsDocumentoPeer::CA_FCHCREADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsucreado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usucreado !== $v) {
			$this->ca_usucreado = $v;
			$this->modifiedColumns[] = IdsDocumentoPeer::CA_USUCREADO;
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

			$this->ca_iddocumento = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idtipo = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_ubicacion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fchinicio = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_observaciones = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchcreado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usucreado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsDocumento object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aIds !== null && $this->ca_id !== $this->aIds->getCaId()) {
			$this->aIds = null;
		}
		if ($this->aIdsTipoDocumento !== null && $this->ca_idtipo !== $this->aIdsTipoDocumento->getCaIdtipo()) {
			$this->aIdsTipoDocumento = null;
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
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsDocumentoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aIds = null;
			$this->aIdsTipoDocumento = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsDocumento:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsDocumentoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsDocumento:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsDocumento:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsDocumento:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsDocumentoPeer::addInstanceToPool($this);
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

												
			if ($this->aIds !== null) {
				if ($this->aIds->isModified() || $this->aIds->isNew()) {
					$affectedRows += $this->aIds->save($con);
				}
				$this->setIds($this->aIds);
			}

			if ($this->aIdsTipoDocumento !== null) {
				if ($this->aIdsTipoDocumento->isModified() || $this->aIdsTipoDocumento->isNew()) {
					$affectedRows += $this->aIdsTipoDocumento->save($con);
				}
				$this->setIdsTipoDocumento($this->aIdsTipoDocumento);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = IdsDocumentoPeer::CA_IDDOCUMENTO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsDocumentoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIddocumento($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += IdsDocumentoPeer::doUpdate($this, $con);
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


												
			if ($this->aIds !== null) {
				if (!$this->aIds->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIds->getValidationFailures());
				}
			}

			if ($this->aIdsTipoDocumento !== null) {
				if (!$this->aIdsTipoDocumento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIdsTipoDocumento->getValidationFailures());
				}
			}


			if (($retval = IdsDocumentoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsDocumentoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIddocumento();
				break;
			case 1:
				return $this->getCaId();
				break;
			case 2:
				return $this->getCaIdtipo();
				break;
			case 3:
				return $this->getCaUbicacion();
				break;
			case 4:
				return $this->getCaFchinicio();
				break;
			case 5:
				return $this->getCaFchvencimiento();
				break;
			case 6:
				return $this->getCaObservaciones();
				break;
			case 7:
				return $this->getCaFchcreado();
				break;
			case 8:
				return $this->getCaUsucreado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsDocumentoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIddocumento(),
			$keys[1] => $this->getCaId(),
			$keys[2] => $this->getCaIdtipo(),
			$keys[3] => $this->getCaUbicacion(),
			$keys[4] => $this->getCaFchinicio(),
			$keys[5] => $this->getCaFchvencimiento(),
			$keys[6] => $this->getCaObservaciones(),
			$keys[7] => $this->getCaFchcreado(),
			$keys[8] => $this->getCaUsucreado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsDocumentoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIddocumento($value);
				break;
			case 1:
				$this->setCaId($value);
				break;
			case 2:
				$this->setCaIdtipo($value);
				break;
			case 3:
				$this->setCaUbicacion($value);
				break;
			case 4:
				$this->setCaFchinicio($value);
				break;
			case 5:
				$this->setCaFchvencimiento($value);
				break;
			case 6:
				$this->setCaObservaciones($value);
				break;
			case 7:
				$this->setCaFchcreado($value);
				break;
			case 8:
				$this->setCaUsucreado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsDocumentoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIddocumento($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdtipo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaUbicacion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFchinicio($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchvencimiento($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObservaciones($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchcreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsucreado($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsDocumentoPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsDocumentoPeer::CA_IDDOCUMENTO)) $criteria->add(IdsDocumentoPeer::CA_IDDOCUMENTO, $this->ca_iddocumento);
		if ($this->isColumnModified(IdsDocumentoPeer::CA_ID)) $criteria->add(IdsDocumentoPeer::CA_ID, $this->ca_id);
		if ($this->isColumnModified(IdsDocumentoPeer::CA_IDTIPO)) $criteria->add(IdsDocumentoPeer::CA_IDTIPO, $this->ca_idtipo);
		if ($this->isColumnModified(IdsDocumentoPeer::CA_UBICACION)) $criteria->add(IdsDocumentoPeer::CA_UBICACION, $this->ca_ubicacion);
		if ($this->isColumnModified(IdsDocumentoPeer::CA_FCHINICIO)) $criteria->add(IdsDocumentoPeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(IdsDocumentoPeer::CA_FCHVENCIMIENTO)) $criteria->add(IdsDocumentoPeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(IdsDocumentoPeer::CA_OBSERVACIONES)) $criteria->add(IdsDocumentoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(IdsDocumentoPeer::CA_FCHCREADO)) $criteria->add(IdsDocumentoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(IdsDocumentoPeer::CA_USUCREADO)) $criteria->add(IdsDocumentoPeer::CA_USUCREADO, $this->ca_usucreado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsDocumentoPeer::DATABASE_NAME);

		$criteria->add(IdsDocumentoPeer::CA_IDDOCUMENTO, $this->ca_iddocumento);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIddocumento();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIddocumento($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaId($this->ca_id);

		$copyObj->setCaIdtipo($this->ca_idtipo);

		$copyObj->setCaUbicacion($this->ca_ubicacion);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);


		$copyObj->setNew(true);

		$copyObj->setCaIddocumento(NULL); 
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
			self::$peer = new IdsDocumentoPeer();
		}
		return self::$peer;
	}

	
	public function setIds(Ids $v = null)
	{
		if ($v === null) {
			$this->setCaId(NULL);
		} else {
			$this->setCaId($v->getCaId());
		}

		$this->aIds = $v;

						if ($v !== null) {
			$v->addIdsDocumento($this);
		}

		return $this;
	}


	
	public function getIds(PropelPDO $con = null)
	{
		if ($this->aIds === null && ($this->ca_id !== null)) {
			$c = new Criteria(IdsPeer::DATABASE_NAME);
			$c->add(IdsPeer::CA_ID, $this->ca_id);
			$this->aIds = IdsPeer::doSelectOne($c, $con);
			
		}
		return $this->aIds;
	}

	
	public function setIdsTipoDocumento(IdsTipoDocumento $v = null)
	{
		if ($v === null) {
			$this->setCaIdtipo(NULL);
		} else {
			$this->setCaIdtipo($v->getCaIdtipo());
		}

		$this->aIdsTipoDocumento = $v;

						if ($v !== null) {
			$v->addIdsDocumento($this);
		}

		return $this;
	}


	
	public function getIdsTipoDocumento(PropelPDO $con = null)
	{
		if ($this->aIdsTipoDocumento === null && ($this->ca_idtipo !== null)) {
			$c = new Criteria(IdsTipoDocumentoPeer::DATABASE_NAME);
			$c->add(IdsTipoDocumentoPeer::CA_IDTIPO, $this->ca_idtipo);
			$this->aIdsTipoDocumento = IdsTipoDocumentoPeer::doSelectOne($c, $con);
			
		}
		return $this->aIdsTipoDocumento;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aIds = null;
			$this->aIdsTipoDocumento = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIdsDocumento:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsDocumento::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 