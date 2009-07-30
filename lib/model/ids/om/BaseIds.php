<?php


abstract class BaseIds extends BaseObject  implements Persistent {


  const PEER = 'IdsPeer';

	
	protected static $peer;

	
	protected $ca_id;

	
	protected $ca_dv;

	
	protected $ca_idalterno;

	
	protected $ca_tipoidentificacion;

	
	protected $ca_idgrupo;

	
	protected $ca_nombre;

	
	protected $ca_website;

	
	protected $ca_actividad;

	
	protected $ca_sectoreco;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $collIdsSucursals;

	
	private $lastIdsSucursalCriteria = null;

	
	protected $singleIdsProveedor;

	
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

	
	public function getCaId()
	{
		return $this->ca_id;
	}

	
	public function getCaDv()
	{
		return $this->ca_dv;
	}

	
	public function getCaIdalterno()
	{
		return $this->ca_idalterno;
	}

	
	public function getCaTipoidentificacion()
	{
		return $this->ca_tipoidentificacion;
	}

	
	public function getCaIdgrupo()
	{
		return $this->ca_idgrupo;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaWebsite()
	{
		return $this->ca_website;
	}

	
	public function getCaActividad()
	{
		return $this->ca_actividad;
	}

	
	public function getCaSectoreco()
	{
		return $this->ca_sectoreco;
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

	
	public function getCaFchactualizado($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_fchactualizado === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchactualizado);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchactualizado, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaUsuactualizado()
	{
		return $this->ca_usuactualizado;
	}

	
	public function setCaId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_id !== $v) {
			$this->ca_id = $v;
			$this->modifiedColumns[] = IdsPeer::CA_ID;
		}

		return $this;
	} 
	
	public function setCaDv($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_dv !== $v) {
			$this->ca_dv = $v;
			$this->modifiedColumns[] = IdsPeer::CA_DV;
		}

		return $this;
	} 
	
	public function setCaIdalterno($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idalterno !== $v) {
			$this->ca_idalterno = $v;
			$this->modifiedColumns[] = IdsPeer::CA_IDALTERNO;
		}

		return $this;
	} 
	
	public function setCaTipoidentificacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipoidentificacion !== $v) {
			$this->ca_tipoidentificacion = $v;
			$this->modifiedColumns[] = IdsPeer::CA_TIPOIDENTIFICACION;
		}

		return $this;
	} 
	
	public function setCaIdgrupo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgrupo !== $v) {
			$this->ca_idgrupo = $v;
			$this->modifiedColumns[] = IdsPeer::CA_IDGRUPO;
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
			$this->modifiedColumns[] = IdsPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaWebsite($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_website !== $v) {
			$this->ca_website = $v;
			$this->modifiedColumns[] = IdsPeer::CA_WEBSITE;
		}

		return $this;
	} 
	
	public function setCaActividad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_actividad !== $v) {
			$this->ca_actividad = $v;
			$this->modifiedColumns[] = IdsPeer::CA_ACTIVIDAD;
		}

		return $this;
	} 
	
	public function setCaSectoreco($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sectoreco !== $v) {
			$this->ca_sectoreco = $v;
			$this->modifiedColumns[] = IdsPeer::CA_SECTORECO;
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
				$this->modifiedColumns[] = IdsPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = IdsPeer::CA_USUCREADO;
		}

		return $this;
	} 
	
	public function setCaFchactualizado($v)
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

		if ( $this->ca_fchactualizado !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = IdsPeer::CA_FCHACTUALIZADO;
			}
		} 
		return $this;
	} 
	
	public function setCaUsuactualizado($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_usuactualizado !== $v) {
			$this->ca_usuactualizado = $v;
			$this->modifiedColumns[] = IdsPeer::CA_USUACTUALIZADO;
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

			$this->ca_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_dv = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idalterno = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_tipoidentificacion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_idgrupo = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_nombre = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_website = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_actividad = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_sectoreco = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchcreado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_usucreado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchactualizado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_usuactualizado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Ids object", $e);
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
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collIdsSucursals = null;
			$this->lastIdsSucursalCriteria = null;

			$this->singleIdsProveedor = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIds:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIds:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIds:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIds:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsPeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += IdsPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collIdsSucursals !== null) {
				foreach ($this->collIdsSucursals as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->singleIdsProveedor !== null) {
				if (!$this->singleIdsProveedor->isDeleted()) {
						$affectedRows += $this->singleIdsProveedor->save($con);
				}
			}

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


			if (($retval = IdsPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collIdsSucursals !== null) {
					foreach ($this->collIdsSucursals as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->singleIdsProveedor !== null) {
					if (!$this->singleIdsProveedor->validate($columns)) {
						$failureMap = array_merge($failureMap, $this->singleIdsProveedor->getValidationFailures());
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaId();
				break;
			case 1:
				return $this->getCaDv();
				break;
			case 2:
				return $this->getCaIdalterno();
				break;
			case 3:
				return $this->getCaTipoidentificacion();
				break;
			case 4:
				return $this->getCaIdgrupo();
				break;
			case 5:
				return $this->getCaNombre();
				break;
			case 6:
				return $this->getCaWebsite();
				break;
			case 7:
				return $this->getCaActividad();
				break;
			case 8:
				return $this->getCaSectoreco();
				break;
			case 9:
				return $this->getCaFchcreado();
				break;
			case 10:
				return $this->getCaUsucreado();
				break;
			case 11:
				return $this->getCaFchactualizado();
				break;
			case 12:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaId(),
			$keys[1] => $this->getCaDv(),
			$keys[2] => $this->getCaIdalterno(),
			$keys[3] => $this->getCaTipoidentificacion(),
			$keys[4] => $this->getCaIdgrupo(),
			$keys[5] => $this->getCaNombre(),
			$keys[6] => $this->getCaWebsite(),
			$keys[7] => $this->getCaActividad(),
			$keys[8] => $this->getCaSectoreco(),
			$keys[9] => $this->getCaFchcreado(),
			$keys[10] => $this->getCaUsucreado(),
			$keys[11] => $this->getCaFchactualizado(),
			$keys[12] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaId($value);
				break;
			case 1:
				$this->setCaDv($value);
				break;
			case 2:
				$this->setCaIdalterno($value);
				break;
			case 3:
				$this->setCaTipoidentificacion($value);
				break;
			case 4:
				$this->setCaIdgrupo($value);
				break;
			case 5:
				$this->setCaNombre($value);
				break;
			case 6:
				$this->setCaWebsite($value);
				break;
			case 7:
				$this->setCaActividad($value);
				break;
			case 8:
				$this->setCaSectoreco($value);
				break;
			case 9:
				$this->setCaFchcreado($value);
				break;
			case 10:
				$this->setCaUsucreado($value);
				break;
			case 11:
				$this->setCaFchactualizado($value);
				break;
			case 12:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaDv($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdalterno($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTipoidentificacion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdgrupo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNombre($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaWebsite($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaActividad($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaSectoreco($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchcreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaUsucreado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchactualizado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsuactualizado($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsPeer::CA_ID)) $criteria->add(IdsPeer::CA_ID, $this->ca_id);
		if ($this->isColumnModified(IdsPeer::CA_DV)) $criteria->add(IdsPeer::CA_DV, $this->ca_dv);
		if ($this->isColumnModified(IdsPeer::CA_IDALTERNO)) $criteria->add(IdsPeer::CA_IDALTERNO, $this->ca_idalterno);
		if ($this->isColumnModified(IdsPeer::CA_TIPOIDENTIFICACION)) $criteria->add(IdsPeer::CA_TIPOIDENTIFICACION, $this->ca_tipoidentificacion);
		if ($this->isColumnModified(IdsPeer::CA_IDGRUPO)) $criteria->add(IdsPeer::CA_IDGRUPO, $this->ca_idgrupo);
		if ($this->isColumnModified(IdsPeer::CA_NOMBRE)) $criteria->add(IdsPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(IdsPeer::CA_WEBSITE)) $criteria->add(IdsPeer::CA_WEBSITE, $this->ca_website);
		if ($this->isColumnModified(IdsPeer::CA_ACTIVIDAD)) $criteria->add(IdsPeer::CA_ACTIVIDAD, $this->ca_actividad);
		if ($this->isColumnModified(IdsPeer::CA_SECTORECO)) $criteria->add(IdsPeer::CA_SECTORECO, $this->ca_sectoreco);
		if ($this->isColumnModified(IdsPeer::CA_FCHCREADO)) $criteria->add(IdsPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(IdsPeer::CA_USUCREADO)) $criteria->add(IdsPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(IdsPeer::CA_FCHACTUALIZADO)) $criteria->add(IdsPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(IdsPeer::CA_USUACTUALIZADO)) $criteria->add(IdsPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsPeer::DATABASE_NAME);

		$criteria->add(IdsPeer::CA_ID, $this->ca_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaId($this->ca_id);

		$copyObj->setCaDv($this->ca_dv);

		$copyObj->setCaIdalterno($this->ca_idalterno);

		$copyObj->setCaTipoidentificacion($this->ca_tipoidentificacion);

		$copyObj->setCaIdgrupo($this->ca_idgrupo);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaWebsite($this->ca_website);

		$copyObj->setCaActividad($this->ca_actividad);

		$copyObj->setCaSectoreco($this->ca_sectoreco);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getIdsSucursals() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addIdsSucursal($relObj->copy($deepCopy));
				}
			}

			$relObj = $this->getIdsProveedor();
			if ($relObj) {
				$copyObj->setIdsProveedor($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new IdsPeer();
		}
		return self::$peer;
	}

	
	public function clearIdsSucursals()
	{
		$this->collIdsSucursals = null; 	}

	
	public function initIdsSucursals()
	{
		$this->collIdsSucursals = array();
	}

	
	public function getIdsSucursals($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsSucursals === null) {
			if ($this->isNew()) {
			   $this->collIdsSucursals = array();
			} else {

				$criteria->add(IdsSucursalPeer::CA_ID, $this->ca_id);

				IdsSucursalPeer::addSelectColumns($criteria);
				$this->collIdsSucursals = IdsSucursalPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsSucursalPeer::CA_ID, $this->ca_id);

				IdsSucursalPeer::addSelectColumns($criteria);
				if (!isset($this->lastIdsSucursalCriteria) || !$this->lastIdsSucursalCriteria->equals($criteria)) {
					$this->collIdsSucursals = IdsSucursalPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastIdsSucursalCriteria = $criteria;
		return $this->collIdsSucursals;
	}

	
	public function countIdsSucursals(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collIdsSucursals === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(IdsSucursalPeer::CA_ID, $this->ca_id);

				$count = IdsSucursalPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsSucursalPeer::CA_ID, $this->ca_id);

				if (!isset($this->lastIdsSucursalCriteria) || !$this->lastIdsSucursalCriteria->equals($criteria)) {
					$count = IdsSucursalPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collIdsSucursals);
				}
			} else {
				$count = count($this->collIdsSucursals);
			}
		}
		return $count;
	}

	
	public function addIdsSucursal(IdsSucursal $l)
	{
		if ($this->collIdsSucursals === null) {
			$this->initIdsSucursals();
		}
		if (!in_array($l, $this->collIdsSucursals, true)) { 			array_push($this->collIdsSucursals, $l);
			$l->setIds($this);
		}
	}


	
	public function getIdsSucursalsJoinCiudad($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsSucursals === null) {
			if ($this->isNew()) {
				$this->collIdsSucursals = array();
			} else {

				$criteria->add(IdsSucursalPeer::CA_ID, $this->ca_id);

				$this->collIdsSucursals = IdsSucursalPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(IdsSucursalPeer::CA_ID, $this->ca_id);

			if (!isset($this->lastIdsSucursalCriteria) || !$this->lastIdsSucursalCriteria->equals($criteria)) {
				$this->collIdsSucursals = IdsSucursalPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		}
		$this->lastIdsSucursalCriteria = $criteria;

		return $this->collIdsSucursals;
	}

	
	public function getIdsProveedor(PropelPDO $con = null)
	{

		if ($this->singleIdsProveedor === null && !$this->isNew()) {
			$this->singleIdsProveedor = IdsProveedorPeer::retrieveByPK($this->ca_id, $con);
		}

		return $this->singleIdsProveedor;
	}

	
	public function setIdsProveedor(IdsProveedor $v)
	{
		$this->singleIdsProveedor = $v;

				if ($v->getIds() === null) {
			$v->setIds($this);
		}

		return $this;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collIdsSucursals) {
				foreach ((array) $this->collIdsSucursals as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->singleIdsProveedor) {
				$this->singleIdsProveedor->clearAllReferences($deep);
			}
		} 
		$this->collIdsSucursals = null;
		$this->singleIdsProveedor = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIds:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIds::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 