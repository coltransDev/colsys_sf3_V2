<?php


abstract class BaseRepGasto extends BaseObject  implements Persistent {


  const PEER = 'RepGastoPeer';

	
	protected static $peer;

	
	protected $oid;

	
	protected $ca_idreporte;

	
	protected $ca_idrecargo;

	
	protected $ca_aplicacion;

	
	protected $ca_tipo;

	
	protected $ca_neta_tar;

	
	protected $ca_neta_min;

	
	protected $ca_reportar_tar;

	
	protected $ca_reportar_min;

	
	protected $ca_cobrar_tar;

	
	protected $ca_cobrar_min;

	
	protected $ca_idmoneda;

	
	protected $ca_detalles;

	
	protected $ca_idconcepto;

	
	protected $aReporte;

	
	protected $aConcepto;

	
	protected $aTipoRecargo;

	
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

	
	public function getCaIdrecargo()
	{
		return $this->ca_idrecargo;
	}

	
	public function getCaAplicacion()
	{
		return $this->ca_aplicacion;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaNetaTar()
	{
		return $this->ca_neta_tar;
	}

	
	public function getCaNetaMin()
	{
		return $this->ca_neta_min;
	}

	
	public function getCaReportarTar()
	{
		return $this->ca_reportar_tar;
	}

	
	public function getCaReportarMin()
	{
		return $this->ca_reportar_min;
	}

	
	public function getCaCobrarTar()
	{
		return $this->ca_cobrar_tar;
	}

	
	public function getCaCobrarMin()
	{
		return $this->ca_cobrar_min;
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaDetalles()
	{
		return $this->ca_detalles;
	}

	
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	
	public function setOid($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->oid !== $v) {
			$this->oid = $v;
			$this->modifiedColumns[] = RepGastoPeer::OID;
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
			$this->modifiedColumns[] = RepGastoPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
		}

		return $this;
	} 
	
	public function setCaIdrecargo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idrecargo !== $v) {
			$this->ca_idrecargo = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
		}

		return $this;
	} 
	
	public function setCaAplicacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplicacion !== $v) {
			$this->ca_aplicacion = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_APLICACION;
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
			$this->modifiedColumns[] = RepGastoPeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaNetaTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_neta_tar !== $v) {
			$this->ca_neta_tar = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_NETA_TAR;
		}

		return $this;
	} 
	
	public function setCaNetaMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_neta_min !== $v) {
			$this->ca_neta_min = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_NETA_MIN;
		}

		return $this;
	} 
	
	public function setCaReportarTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_reportar_tar !== $v) {
			$this->ca_reportar_tar = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_REPORTAR_TAR;
		}

		return $this;
	} 
	
	public function setCaReportarMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_reportar_min !== $v) {
			$this->ca_reportar_min = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_REPORTAR_MIN;
		}

		return $this;
	} 
	
	public function setCaCobrarTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cobrar_tar !== $v) {
			$this->ca_cobrar_tar = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_COBRAR_TAR;
		}

		return $this;
	} 
	
	public function setCaCobrarMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cobrar_min !== $v) {
			$this->ca_cobrar_min = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_COBRAR_MIN;
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
			$this->modifiedColumns[] = RepGastoPeer::CA_IDMONEDA;
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
			$this->modifiedColumns[] = RepGastoPeer::CA_DETALLES;
		}

		return $this;
	} 
	
	public function setCaIdconcepto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idconcepto !== $v) {
			$this->ca_idconcepto = $v;
			$this->modifiedColumns[] = RepGastoPeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
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
			$this->ca_idrecargo = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_aplicacion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_tipo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_neta_tar = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_neta_min = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_reportar_tar = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_reportar_min = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_cobrar_tar = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_cobrar_min = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_idmoneda = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_detalles = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_idconcepto = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 14; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RepGasto object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
		}
		if ($this->aTipoRecargo !== null && $this->ca_idrecargo !== $this->aTipoRecargo->getCaIdrecargo()) {
			$this->aTipoRecargo = null;
		}
		if ($this->aConcepto !== null && $this->ca_idconcepto !== $this->aConcepto->getCaIdconcepto()) {
			$this->aConcepto = null;
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
			$con = Propel::getConnection(RepGastoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RepGastoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aReporte = null;
			$this->aConcepto = null;
			$this->aTipoRecargo = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepGasto:delete:pre') as $callable)
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
			$con = Propel::getConnection(RepGastoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepGastoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRepGasto:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepGasto:save:pre') as $callable)
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
			$con = Propel::getConnection(RepGastoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRepGasto:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RepGastoPeer::addInstanceToPool($this);
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

			if ($this->aConcepto !== null) {
				if ($this->aConcepto->isModified() || $this->aConcepto->isNew()) {
					$affectedRows += $this->aConcepto->save($con);
				}
				$this->setConcepto($this->aConcepto);
			}

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified() || $this->aTipoRecargo->isNew()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepGastoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RepGastoPeer::doUpdate($this, $con);
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

			if ($this->aConcepto !== null) {
				if (!$this->aConcepto->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConcepto->getValidationFailures());
				}
			}

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = RepGastoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepGastoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdrecargo();
				break;
			case 3:
				return $this->getCaAplicacion();
				break;
			case 4:
				return $this->getCaTipo();
				break;
			case 5:
				return $this->getCaNetaTar();
				break;
			case 6:
				return $this->getCaNetaMin();
				break;
			case 7:
				return $this->getCaReportarTar();
				break;
			case 8:
				return $this->getCaReportarMin();
				break;
			case 9:
				return $this->getCaCobrarTar();
				break;
			case 10:
				return $this->getCaCobrarMin();
				break;
			case 11:
				return $this->getCaIdmoneda();
				break;
			case 12:
				return $this->getCaDetalles();
				break;
			case 13:
				return $this->getCaIdconcepto();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RepGastoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaIdreporte(),
			$keys[2] => $this->getCaIdrecargo(),
			$keys[3] => $this->getCaAplicacion(),
			$keys[4] => $this->getCaTipo(),
			$keys[5] => $this->getCaNetaTar(),
			$keys[6] => $this->getCaNetaMin(),
			$keys[7] => $this->getCaReportarTar(),
			$keys[8] => $this->getCaReportarMin(),
			$keys[9] => $this->getCaCobrarTar(),
			$keys[10] => $this->getCaCobrarMin(),
			$keys[11] => $this->getCaIdmoneda(),
			$keys[12] => $this->getCaDetalles(),
			$keys[13] => $this->getCaIdconcepto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepGastoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdrecargo($value);
				break;
			case 3:
				$this->setCaAplicacion($value);
				break;
			case 4:
				$this->setCaTipo($value);
				break;
			case 5:
				$this->setCaNetaTar($value);
				break;
			case 6:
				$this->setCaNetaMin($value);
				break;
			case 7:
				$this->setCaReportarTar($value);
				break;
			case 8:
				$this->setCaReportarMin($value);
				break;
			case 9:
				$this->setCaCobrarTar($value);
				break;
			case 10:
				$this->setCaCobrarMin($value);
				break;
			case 11:
				$this->setCaIdmoneda($value);
				break;
			case 12:
				$this->setCaDetalles($value);
				break;
			case 13:
				$this->setCaIdconcepto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RepGastoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdreporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdrecargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaAplicacion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTipo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNetaTar($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaNetaMin($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaReportarTar($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaReportarMin($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaCobrarTar($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaCobrarMin($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaIdmoneda($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaDetalles($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaIdconcepto($arr[$keys[13]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RepGastoPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepGastoPeer::OID)) $criteria->add(RepGastoPeer::OID, $this->oid);
		if ($this->isColumnModified(RepGastoPeer::CA_IDREPORTE)) $criteria->add(RepGastoPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepGastoPeer::CA_IDRECARGO)) $criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(RepGastoPeer::CA_APLICACION)) $criteria->add(RepGastoPeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(RepGastoPeer::CA_TIPO)) $criteria->add(RepGastoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(RepGastoPeer::CA_NETA_TAR)) $criteria->add(RepGastoPeer::CA_NETA_TAR, $this->ca_neta_tar);
		if ($this->isColumnModified(RepGastoPeer::CA_NETA_MIN)) $criteria->add(RepGastoPeer::CA_NETA_MIN, $this->ca_neta_min);
		if ($this->isColumnModified(RepGastoPeer::CA_REPORTAR_TAR)) $criteria->add(RepGastoPeer::CA_REPORTAR_TAR, $this->ca_reportar_tar);
		if ($this->isColumnModified(RepGastoPeer::CA_REPORTAR_MIN)) $criteria->add(RepGastoPeer::CA_REPORTAR_MIN, $this->ca_reportar_min);
		if ($this->isColumnModified(RepGastoPeer::CA_COBRAR_TAR)) $criteria->add(RepGastoPeer::CA_COBRAR_TAR, $this->ca_cobrar_tar);
		if ($this->isColumnModified(RepGastoPeer::CA_COBRAR_MIN)) $criteria->add(RepGastoPeer::CA_COBRAR_MIN, $this->ca_cobrar_min);
		if ($this->isColumnModified(RepGastoPeer::CA_IDMONEDA)) $criteria->add(RepGastoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(RepGastoPeer::CA_DETALLES)) $criteria->add(RepGastoPeer::CA_DETALLES, $this->ca_detalles);
		if ($this->isColumnModified(RepGastoPeer::CA_IDCONCEPTO)) $criteria->add(RepGastoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RepGastoPeer::DATABASE_NAME);

		$criteria->add(RepGastoPeer::OID, $this->oid);

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

		$copyObj->setCaIdrecargo($this->ca_idrecargo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaNetaTar($this->ca_neta_tar);

		$copyObj->setCaNetaMin($this->ca_neta_min);

		$copyObj->setCaReportarTar($this->ca_reportar_tar);

		$copyObj->setCaReportarMin($this->ca_reportar_min);

		$copyObj->setCaCobrarTar($this->ca_cobrar_tar);

		$copyObj->setCaCobrarMin($this->ca_cobrar_min);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaDetalles($this->ca_detalles);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);


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
			self::$peer = new RepGastoPeer();
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
			$v->addRepGasto($this);
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

	
	public function setConcepto(Concepto $v = null)
	{
		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}

		$this->aConcepto = $v;

						if ($v !== null) {
			$v->addRepGasto($this);
		}

		return $this;
	}


	
	public function getConcepto(PropelPDO $con = null)
	{
		if ($this->aConcepto === null && ($this->ca_idconcepto !== null)) {
			$c = new Criteria(ConceptoPeer::DATABASE_NAME);
			$c->add(ConceptoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
			$this->aConcepto = ConceptoPeer::doSelectOne($c, $con);
			
		}
		return $this->aConcepto;
	}

	
	public function setTipoRecargo(TipoRecargo $v = null)
	{
		if ($v === null) {
			$this->setCaIdrecargo(NULL);
		} else {
			$this->setCaIdrecargo($v->getCaIdrecargo());
		}

		$this->aTipoRecargo = $v;

						if ($v !== null) {
			$v->addRepGasto($this);
		}

		return $this;
	}


	
	public function getTipoRecargo(PropelPDO $con = null)
	{
		if ($this->aTipoRecargo === null && ($this->ca_idrecargo !== null)) {
			$c = new Criteria(TipoRecargoPeer::DATABASE_NAME);
			$c->add(TipoRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
			$this->aTipoRecargo = TipoRecargoPeer::doSelectOne($c, $con);
			
		}
		return $this->aTipoRecargo;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aReporte = null;
			$this->aConcepto = null;
			$this->aTipoRecargo = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRepGasto:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRepGasto::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 