<?php


abstract class BaseRepCosto extends BaseObject  implements Persistent {


  const PEER = 'RepCostoPeer';

	
	protected static $peer;

	
	protected $oid;

	
	protected $ca_idreporte;

	
	protected $ca_idcosto;

	
	protected $ca_tipo;

	
	protected $ca_vlrcosto;

	
	protected $ca_mincosto;

	
	protected $ca_netcosto;

	
	protected $ca_idmoneda;

	
	protected $ca_detalles;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $aReporte;

	
	protected $aCosto;

	
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

	
	public function getOid()
	{
		return $this->oid;
	}

	
	public function getCaIdreporte()
	{
		return $this->ca_idreporte;
	}

	
	public function getCaIdcosto()
	{
		return $this->ca_idcosto;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaVlrcosto()
	{
		return $this->ca_vlrcosto;
	}

	
	public function getCaMincosto()
	{
		return $this->ca_mincosto;
	}

	
	public function getCaNetcosto()
	{
		return $this->ca_netcosto;
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaDetalles()
	{
		return $this->ca_detalles;
	}

	
	public function getCaFchcreado($format = 'Y-m-d')
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

	
	public function getCaFchactualizado($format = 'Y-m-d')
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

	
	public function setOid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = RepCostoPeer::OID;
		}

		return $this;
	} 
	
	public function setCaIdreporte($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idreporte !== $v) {
			$this->ca_idreporte = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} 
	
	public function setCaIdcosto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcosto !== $v) {
			$this->ca_idcosto = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_IDCOSTO;
		}

		if ($this->aCosto !== null && $this->aCosto->getCaIdcosto() !== $v) {
			$this->aCosto = null;
		}

		return $this;
	} 
	
	public function setCaTipo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_tipo !== $v) {
			$this->ca_tipo = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaVlrcosto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrcosto !== $v) {
			$this->ca_vlrcosto = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_VLRCOSTO;
		}

		return $this;
	} 
	
	public function setCaMincosto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_mincosto !== $v) {
			$this->ca_mincosto = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_MINCOSTO;
		}

		return $this;
	} 
	
	public function setCaNetcosto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_netcosto !== $v) {
			$this->ca_netcosto = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_NETCOSTO;
		}

		return $this;
	} 
	
	public function setCaIdmoneda($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idmoneda !== $v) {
			$this->ca_idmoneda = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_IDMONEDA;
		}

		return $this;
	} 
	
	public function setCaDetalles($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_detalles !== $v) {
			$this->ca_detalles = $v;
			$this->modifiedColumns[] = RepCostoPeer::CA_DETALLES;
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
			
			$currNorm = ($this->ca_fchcreado !== null && $tmpDt = new DateTime($this->ca_fchcreado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcreado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepCostoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = RepCostoPeer::CA_USUCREADO;
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
			
			$currNorm = ($this->ca_fchactualizado !== null && $tmpDt = new DateTime($this->ca_fchactualizado)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchactualizado = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = RepCostoPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = RepCostoPeer::CA_USUACTUALIZADO;
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

			$this->oid = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idreporte = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idcosto = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_tipo = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_vlrcosto = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_mincosto = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_netcosto = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_idmoneda = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_detalles = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
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
			throw new PropelException("Error populating RepCosto object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
		}
		if ($this->aCosto !== null && $this->ca_idcosto !== $this->aCosto->getCaIdcosto()) {
			$this->aCosto = null;
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
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RepCostoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aReporte = null;
			$this->aCosto = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepCosto:delete:pre') as $callable)
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
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepCostoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRepCosto:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepCosto:save:pre') as $callable)
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
			$con = Propel::getConnection(RepCostoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRepCosto:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RepCostoPeer::addInstanceToPool($this);
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

												
			if ($this->aReporte !== null) {
				if ($this->aReporte->isModified() || $this->aReporte->isNew()) {
					$affectedRows += $this->aReporte->save($con);
				}
				$this->setReporte($this->aReporte);
			}

			if ($this->aCosto !== null) {
				if ($this->aCosto->isModified() || $this->aCosto->isNew()) {
					$affectedRows += $this->aCosto->save($con);
				}
				$this->setCosto($this->aCosto);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepCostoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RepCostoPeer::doUpdate($this, $con);
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


												
			if ($this->aReporte !== null) {
				if (!$this->aReporte->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aReporte->getValidationFailures());
				}
			}

			if ($this->aCosto !== null) {
				if (!$this->aCosto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCosto->getValidationFailures());
				}
			}


			if (($retval = RepCostoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepCostoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getOid();
				break;
			case 1:
				return $this->getCaIdreporte();
				break;
			case 2:
				return $this->getCaIdcosto();
				break;
			case 3:
				return $this->getCaTipo();
				break;
			case 4:
				return $this->getCaVlrcosto();
				break;
			case 5:
				return $this->getCaMincosto();
				break;
			case 6:
				return $this->getCaNetcosto();
				break;
			case 7:
				return $this->getCaIdmoneda();
				break;
			case 8:
				return $this->getCaDetalles();
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
		$keys = RepCostoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaIdreporte(),
			$keys[2] => $this->getCaIdcosto(),
			$keys[3] => $this->getCaTipo(),
			$keys[4] => $this->getCaVlrcosto(),
			$keys[5] => $this->getCaMincosto(),
			$keys[6] => $this->getCaNetcosto(),
			$keys[7] => $this->getCaIdmoneda(),
			$keys[8] => $this->getCaDetalles(),
			$keys[9] => $this->getCaFchcreado(),
			$keys[10] => $this->getCaUsucreado(),
			$keys[11] => $this->getCaFchactualizado(),
			$keys[12] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepCostoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setOid($value);
				break;
			case 1:
				$this->setCaIdreporte($value);
				break;
			case 2:
				$this->setCaIdcosto($value);
				break;
			case 3:
				$this->setCaTipo($value);
				break;
			case 4:
				$this->setCaVlrcosto($value);
				break;
			case 5:
				$this->setCaMincosto($value);
				break;
			case 6:
				$this->setCaNetcosto($value);
				break;
			case 7:
				$this->setCaIdmoneda($value);
				break;
			case 8:
				$this->setCaDetalles($value);
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
		$keys = RepCostoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdreporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdcosto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTipo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaVlrcosto($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaMincosto($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaNetcosto($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaIdmoneda($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaDetalles($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchcreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaUsucreado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchactualizado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaUsuactualizado($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RepCostoPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepCostoPeer::OID)) $criteria->add(RepCostoPeer::OID, $this->oid);
		if ($this->isColumnModified(RepCostoPeer::CA_IDREPORTE)) $criteria->add(RepCostoPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepCostoPeer::CA_IDCOSTO)) $criteria->add(RepCostoPeer::CA_IDCOSTO, $this->ca_idcosto);
		if ($this->isColumnModified(RepCostoPeer::CA_TIPO)) $criteria->add(RepCostoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(RepCostoPeer::CA_VLRCOSTO)) $criteria->add(RepCostoPeer::CA_VLRCOSTO, $this->ca_vlrcosto);
		if ($this->isColumnModified(RepCostoPeer::CA_MINCOSTO)) $criteria->add(RepCostoPeer::CA_MINCOSTO, $this->ca_mincosto);
		if ($this->isColumnModified(RepCostoPeer::CA_NETCOSTO)) $criteria->add(RepCostoPeer::CA_NETCOSTO, $this->ca_netcosto);
		if ($this->isColumnModified(RepCostoPeer::CA_IDMONEDA)) $criteria->add(RepCostoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(RepCostoPeer::CA_DETALLES)) $criteria->add(RepCostoPeer::CA_DETALLES, $this->ca_detalles);
		if ($this->isColumnModified(RepCostoPeer::CA_FCHCREADO)) $criteria->add(RepCostoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(RepCostoPeer::CA_USUCREADO)) $criteria->add(RepCostoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(RepCostoPeer::CA_FCHACTUALIZADO)) $criteria->add(RepCostoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(RepCostoPeer::CA_USUACTUALIZADO)) $criteria->add(RepCostoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RepCostoPeer::DATABASE_NAME);

		$criteria->add(RepCostoPeer::OID, $this->oid);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getOid();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setOid($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setOid($this->oid);

		$copyObj->setCaIdreporte($this->ca_idreporte);

		$copyObj->setCaIdcosto($this->ca_idcosto);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaVlrcosto($this->ca_vlrcosto);

		$copyObj->setCaMincosto($this->ca_mincosto);

		$copyObj->setCaNetcosto($this->ca_netcosto);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaDetalles($this->ca_detalles);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


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
			self::$peer = new RepCostoPeer();
		}
		return self::$peer;
	}

	
	public function setReporte(Reporte $v = null)
	{
		if ($v === null) {
			$this->setCaIdreporte(NULL);
		} else {
			$this->setCaIdreporte($v->getCaIdreporte());
		}

		$this->aReporte = $v;

						if ($v !== null) {
			$v->addRepCosto($this);
		}

		return $this;
	}


	
	public function getReporte(PropelPDO $con = null)
	{
		if ($this->aReporte === null && ($this->ca_idreporte !== null)) {
			$c = new Criteria(ReportePeer::DATABASE_NAME);
			$c->add(ReportePeer::CA_IDREPORTE, $this->ca_idreporte);
			$this->aReporte = ReportePeer::doSelectOne($c, $con);
			
		}
		return $this->aReporte;
	}

	
	public function setCosto(Costo $v = null)
	{
		if ($v === null) {
			$this->setCaIdcosto(NULL);
		} else {
			$this->setCaIdcosto($v->getCaIdcosto());
		}

		$this->aCosto = $v;

						if ($v !== null) {
			$v->addRepCosto($this);
		}

		return $this;
	}


	
	public function getCosto(PropelPDO $con = null)
	{
		if ($this->aCosto === null && ($this->ca_idcosto !== null)) {
			$c = new Criteria(CostoPeer::DATABASE_NAME);
			$c->add(CostoPeer::CA_IDCOSTO, $this->ca_idcosto);
			$this->aCosto = CostoPeer::doSelectOne($c, $con);
			
		}
		return $this->aCosto;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aReporte = null;
			$this->aCosto = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRepCosto:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRepCosto::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 