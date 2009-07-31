<?php


abstract class BaseRepTarifa extends BaseObject  implements Persistent {


  const PEER = 'RepTarifaPeer';

	
	protected static $peer;

	
	protected $oid;

	
	protected $ca_idreporte;

	
	protected $ca_idconcepto;

	
	protected $ca_cantidad;

	
	protected $ca_neta_tar;

	
	protected $ca_neta_min;

	
	protected $ca_neta_idm;

	
	protected $ca_reportar_tar;

	
	protected $ca_reportar_min;

	
	protected $ca_reportar_idm;

	
	protected $ca_cobrar_tar;

	
	protected $ca_cobrar_min;

	
	protected $ca_cobrar_idm;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $aReporte;

	
	protected $aConcepto;

	
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

	
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	
	public function getCaCantidad()
	{
		return $this->ca_cantidad;
	}

	
	public function getCaNetaTar()
	{
		return $this->ca_neta_tar;
	}

	
	public function getCaNetaMin()
	{
		return $this->ca_neta_min;
	}

	
	public function getCaNetaIdm()
	{
		return $this->ca_neta_idm;
	}

	
	public function getCaReportarTar()
	{
		return $this->ca_reportar_tar;
	}

	
	public function getCaReportarMin()
	{
		return $this->ca_reportar_min;
	}

	
	public function getCaReportarIdm()
	{
		return $this->ca_reportar_idm;
	}

	
	public function getCaCobrarTar()
	{
		return $this->ca_cobrar_tar;
	}

	
	public function getCaCobrarMin()
	{
		return $this->ca_cobrar_min;
	}

	
	public function getCaCobrarIdm()
	{
		return $this->ca_cobrar_idm;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
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
			$this->modifiedColumns[] = RepTarifaPeer::OID;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_IDREPORTE;
		}

		if ($this->aReporte !== null && $this->aReporte->getCaIdreporte() !== $v) {
			$this->aReporte = null;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_IDCONCEPTO;
		}

		if ($this->aConcepto !== null && $this->aConcepto->getCaIdconcepto() !== $v) {
			$this->aConcepto = null;
		}

		return $this;
	} 
	
	public function setCaCantidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cantidad !== $v) {
			$this->ca_cantidad = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_CANTIDAD;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_NETA_TAR;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_NETA_MIN;
		}

		return $this;
	} 
	
	public function setCaNetaIdm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_neta_idm !== $v) {
			$this->ca_neta_idm = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_NETA_IDM;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_REPORTAR_TAR;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_REPORTAR_MIN;
		}

		return $this;
	} 
	
	public function setCaReportarIdm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_reportar_idm !== $v) {
			$this->ca_reportar_idm = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_REPORTAR_IDM;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_COBRAR_TAR;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_COBRAR_MIN;
		}

		return $this;
	} 
	
	public function setCaCobrarIdm($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_cobrar_idm !== $v) {
			$this->ca_cobrar_idm = $v;
			$this->modifiedColumns[] = RepTarifaPeer::CA_COBRAR_IDM;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = RepTarifaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = RepTarifaPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = RepTarifaPeer::CA_USUACTUALIZADO;
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
			$this->ca_idconcepto = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_cantidad = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_neta_tar = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_neta_min = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_neta_idm = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_reportar_tar = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_reportar_min = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_reportar_idm = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_cobrar_tar = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_cobrar_min = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_cobrar_idm = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_observaciones = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_fchcreado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_usucreado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_fchactualizado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_usuactualizado = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RepTarifa object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aReporte !== null && $this->ca_idreporte !== $this->aReporte->getCaIdreporte()) {
			$this->aReporte = null;
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
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RepTarifaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aReporte = null;
			$this->aConcepto = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepTarifa:delete:pre') as $callable)
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
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RepTarifaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRepTarifa:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRepTarifa:save:pre') as $callable)
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
			$con = Propel::getConnection(RepTarifaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRepTarifa:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RepTarifaPeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RepTarifaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RepTarifaPeer::doUpdate($this, $con);
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


			if (($retval = RepTarifaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepTarifaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaIdconcepto();
				break;
			case 3:
				return $this->getCaCantidad();
				break;
			case 4:
				return $this->getCaNetaTar();
				break;
			case 5:
				return $this->getCaNetaMin();
				break;
			case 6:
				return $this->getCaNetaIdm();
				break;
			case 7:
				return $this->getCaReportarTar();
				break;
			case 8:
				return $this->getCaReportarMin();
				break;
			case 9:
				return $this->getCaReportarIdm();
				break;
			case 10:
				return $this->getCaCobrarTar();
				break;
			case 11:
				return $this->getCaCobrarMin();
				break;
			case 12:
				return $this->getCaCobrarIdm();
				break;
			case 13:
				return $this->getCaObservaciones();
				break;
			case 14:
				return $this->getCaFchcreado();
				break;
			case 15:
				return $this->getCaUsucreado();
				break;
			case 16:
				return $this->getCaFchactualizado();
				break;
			case 17:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RepTarifaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getOid(),
			$keys[1] => $this->getCaIdreporte(),
			$keys[2] => $this->getCaIdconcepto(),
			$keys[3] => $this->getCaCantidad(),
			$keys[4] => $this->getCaNetaTar(),
			$keys[5] => $this->getCaNetaMin(),
			$keys[6] => $this->getCaNetaIdm(),
			$keys[7] => $this->getCaReportarTar(),
			$keys[8] => $this->getCaReportarMin(),
			$keys[9] => $this->getCaReportarIdm(),
			$keys[10] => $this->getCaCobrarTar(),
			$keys[11] => $this->getCaCobrarMin(),
			$keys[12] => $this->getCaCobrarIdm(),
			$keys[13] => $this->getCaObservaciones(),
			$keys[14] => $this->getCaFchcreado(),
			$keys[15] => $this->getCaUsucreado(),
			$keys[16] => $this->getCaFchactualizado(),
			$keys[17] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RepTarifaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaIdconcepto($value);
				break;
			case 3:
				$this->setCaCantidad($value);
				break;
			case 4:
				$this->setCaNetaTar($value);
				break;
			case 5:
				$this->setCaNetaMin($value);
				break;
			case 6:
				$this->setCaNetaIdm($value);
				break;
			case 7:
				$this->setCaReportarTar($value);
				break;
			case 8:
				$this->setCaReportarMin($value);
				break;
			case 9:
				$this->setCaReportarIdm($value);
				break;
			case 10:
				$this->setCaCobrarTar($value);
				break;
			case 11:
				$this->setCaCobrarMin($value);
				break;
			case 12:
				$this->setCaCobrarIdm($value);
				break;
			case 13:
				$this->setCaObservaciones($value);
				break;
			case 14:
				$this->setCaFchcreado($value);
				break;
			case 15:
				$this->setCaUsucreado($value);
				break;
			case 16:
				$this->setCaFchactualizado($value);
				break;
			case 17:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RepTarifaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setOid($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdreporte($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdconcepto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaCantidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaNetaTar($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaNetaMin($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaNetaIdm($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaReportarTar($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaReportarMin($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaReportarIdm($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaCobrarTar($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaCobrarMin($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaCobrarIdm($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaObservaciones($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaFchcreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaUsucreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchactualizado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsuactualizado($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RepTarifaPeer::DATABASE_NAME);

		if ($this->isColumnModified(RepTarifaPeer::OID)) $criteria->add(RepTarifaPeer::OID, $this->oid);
		if ($this->isColumnModified(RepTarifaPeer::CA_IDREPORTE)) $criteria->add(RepTarifaPeer::CA_IDREPORTE, $this->ca_idreporte);
		if ($this->isColumnModified(RepTarifaPeer::CA_IDCONCEPTO)) $criteria->add(RepTarifaPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(RepTarifaPeer::CA_CANTIDAD)) $criteria->add(RepTarifaPeer::CA_CANTIDAD, $this->ca_cantidad);
		if ($this->isColumnModified(RepTarifaPeer::CA_NETA_TAR)) $criteria->add(RepTarifaPeer::CA_NETA_TAR, $this->ca_neta_tar);
		if ($this->isColumnModified(RepTarifaPeer::CA_NETA_MIN)) $criteria->add(RepTarifaPeer::CA_NETA_MIN, $this->ca_neta_min);
		if ($this->isColumnModified(RepTarifaPeer::CA_NETA_IDM)) $criteria->add(RepTarifaPeer::CA_NETA_IDM, $this->ca_neta_idm);
		if ($this->isColumnModified(RepTarifaPeer::CA_REPORTAR_TAR)) $criteria->add(RepTarifaPeer::CA_REPORTAR_TAR, $this->ca_reportar_tar);
		if ($this->isColumnModified(RepTarifaPeer::CA_REPORTAR_MIN)) $criteria->add(RepTarifaPeer::CA_REPORTAR_MIN, $this->ca_reportar_min);
		if ($this->isColumnModified(RepTarifaPeer::CA_REPORTAR_IDM)) $criteria->add(RepTarifaPeer::CA_REPORTAR_IDM, $this->ca_reportar_idm);
		if ($this->isColumnModified(RepTarifaPeer::CA_COBRAR_TAR)) $criteria->add(RepTarifaPeer::CA_COBRAR_TAR, $this->ca_cobrar_tar);
		if ($this->isColumnModified(RepTarifaPeer::CA_COBRAR_MIN)) $criteria->add(RepTarifaPeer::CA_COBRAR_MIN, $this->ca_cobrar_min);
		if ($this->isColumnModified(RepTarifaPeer::CA_COBRAR_IDM)) $criteria->add(RepTarifaPeer::CA_COBRAR_IDM, $this->ca_cobrar_idm);
		if ($this->isColumnModified(RepTarifaPeer::CA_OBSERVACIONES)) $criteria->add(RepTarifaPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(RepTarifaPeer::CA_FCHCREADO)) $criteria->add(RepTarifaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(RepTarifaPeer::CA_USUCREADO)) $criteria->add(RepTarifaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(RepTarifaPeer::CA_FCHACTUALIZADO)) $criteria->add(RepTarifaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(RepTarifaPeer::CA_USUACTUALIZADO)) $criteria->add(RepTarifaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RepTarifaPeer::DATABASE_NAME);

		$criteria->add(RepTarifaPeer::OID, $this->oid);

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

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaCantidad($this->ca_cantidad);

		$copyObj->setCaNetaTar($this->ca_neta_tar);

		$copyObj->setCaNetaMin($this->ca_neta_min);

		$copyObj->setCaNetaIdm($this->ca_neta_idm);

		$copyObj->setCaReportarTar($this->ca_reportar_tar);

		$copyObj->setCaReportarMin($this->ca_reportar_min);

		$copyObj->setCaReportarIdm($this->ca_reportar_idm);

		$copyObj->setCaCobrarTar($this->ca_cobrar_tar);

		$copyObj->setCaCobrarMin($this->ca_cobrar_min);

		$copyObj->setCaCobrarIdm($this->ca_cobrar_idm);

		$copyObj->setCaObservaciones($this->ca_observaciones);

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
			self::$peer = new RepTarifaPeer();
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
			$v->addRepTarifa($this);
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
			$v->addRepTarifa($this);
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

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aReporte = null;
			$this->aConcepto = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRepTarifa:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRepTarifa::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 