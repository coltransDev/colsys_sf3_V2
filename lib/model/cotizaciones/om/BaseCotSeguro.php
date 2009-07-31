<?php


abstract class BaseCotSeguro extends BaseObject  implements Persistent {


  const PEER = 'CotSeguroPeer';

	
	protected static $peer;

	
	protected $ca_idseguro;

	
	protected $ca_idcotizacion;

	
	protected $ca_idmoneda;

	
	protected $ca_prima_tip;

	
	protected $ca_prima_vlr;

	
	protected $ca_prima_min;

	
	protected $ca_obtencion;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_transporte;

	
	protected $aCotizacion;

	
	protected $aMoneda;

	
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

	
	public function getCaIdseguro()
	{
		return $this->ca_idseguro;
	}

	
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaPrimaTip()
	{
		return $this->ca_prima_tip;
	}

	
	public function getCaPrimaVlr()
	{
		return $this->ca_prima_vlr;
	}

	
	public function getCaPrimaMin()
	{
		return $this->ca_prima_min;
	}

	
	public function getCaObtencion()
	{
		return $this->ca_obtencion;
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

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function setCaIdseguro($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idseguro !== $v) {
			$this->ca_idseguro = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_IDSEGURO;
		}

		return $this;
	} 
	
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_IDCOTIZACION;
		}

		if ($this->aCotizacion !== null && $this->aCotizacion->getCaIdcotizacion() !== $v) {
			$this->aCotizacion = null;
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
			$this->modifiedColumns[] = CotSeguroPeer::CA_IDMONEDA;
		}

		if ($this->aMoneda !== null && $this->aMoneda->getCaIdmoneda() !== $v) {
			$this->aMoneda = null;
		}

		return $this;
	} 
	
	public function setCaPrimaTip($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_prima_tip !== $v) {
			$this->ca_prima_tip = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_PRIMA_TIP;
		}

		return $this;
	} 
	
	public function setCaPrimaVlr($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_prima_vlr !== $v) {
			$this->ca_prima_vlr = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_PRIMA_VLR;
		}

		return $this;
	} 
	
	public function setCaPrimaMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_prima_min !== $v) {
			$this->ca_prima_min = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_PRIMA_MIN;
		}

		return $this;
	} 
	
	public function setCaObtencion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_obtencion !== $v) {
			$this->ca_obtencion = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_OBTENCION;
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
			$this->modifiedColumns[] = CotSeguroPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = CotSeguroPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = CotSeguroPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = CotSeguroPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = CotSeguroPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaTransporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_transporte !== $v) {
			$this->ca_transporte = $v;
			$this->modifiedColumns[] = CotSeguroPeer::CA_TRANSPORTE;
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

			$this->ca_idseguro = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idcotizacion = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idmoneda = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_prima_tip = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_prima_vlr = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_prima_min = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_obtencion = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_observaciones = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_fchcreado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_usucreado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_fchactualizado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_usuactualizado = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_transporte = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CotSeguro object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCotizacion !== null && $this->ca_idcotizacion !== $this->aCotizacion->getCaIdcotizacion()) {
			$this->aCotizacion = null;
		}
		if ($this->aMoneda !== null && $this->ca_idmoneda !== $this->aMoneda->getCaIdmoneda()) {
			$this->aMoneda = null;
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
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CotSeguroPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCotizacion = null;
			$this->aMoneda = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotSeguro:delete:pre') as $callable)
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
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotSeguroPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCotSeguro:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotSeguro:save:pre') as $callable)
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
			$con = Propel::getConnection(CotSeguroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCotSeguro:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			CotSeguroPeer::addInstanceToPool($this);
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

												
			if ($this->aCotizacion !== null) {
				if ($this->aCotizacion->isModified() || $this->aCotizacion->isNew()) {
					$affectedRows += $this->aCotizacion->save($con);
				}
				$this->setCotizacion($this->aCotizacion);
			}

			if ($this->aMoneda !== null) {
				if ($this->aMoneda->isModified() || $this->aMoneda->isNew()) {
					$affectedRows += $this->aMoneda->save($con);
				}
				$this->setMoneda($this->aMoneda);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = CotSeguroPeer::CA_IDSEGURO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotSeguroPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdseguro($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += CotSeguroPeer::doUpdate($this, $con);
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


												
			if ($this->aCotizacion !== null) {
				if (!$this->aCotizacion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotizacion->getValidationFailures());
				}
			}

			if ($this->aMoneda !== null) {
				if (!$this->aMoneda->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMoneda->getValidationFailures());
				}
			}


			if (($retval = CotSeguroPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdseguro();
				break;
			case 1:
				return $this->getCaIdcotizacion();
				break;
			case 2:
				return $this->getCaIdmoneda();
				break;
			case 3:
				return $this->getCaPrimaTip();
				break;
			case 4:
				return $this->getCaPrimaVlr();
				break;
			case 5:
				return $this->getCaPrimaMin();
				break;
			case 6:
				return $this->getCaObtencion();
				break;
			case 7:
				return $this->getCaObservaciones();
				break;
			case 8:
				return $this->getCaFchcreado();
				break;
			case 9:
				return $this->getCaUsucreado();
				break;
			case 10:
				return $this->getCaFchactualizado();
				break;
			case 11:
				return $this->getCaUsuactualizado();
				break;
			case 12:
				return $this->getCaTransporte();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CotSeguroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdseguro(),
			$keys[1] => $this->getCaIdcotizacion(),
			$keys[2] => $this->getCaIdmoneda(),
			$keys[3] => $this->getCaPrimaTip(),
			$keys[4] => $this->getCaPrimaVlr(),
			$keys[5] => $this->getCaPrimaMin(),
			$keys[6] => $this->getCaObtencion(),
			$keys[7] => $this->getCaObservaciones(),
			$keys[8] => $this->getCaFchcreado(),
			$keys[9] => $this->getCaUsucreado(),
			$keys[10] => $this->getCaFchactualizado(),
			$keys[11] => $this->getCaUsuactualizado(),
			$keys[12] => $this->getCaTransporte(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotSeguroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdseguro($value);
				break;
			case 1:
				$this->setCaIdcotizacion($value);
				break;
			case 2:
				$this->setCaIdmoneda($value);
				break;
			case 3:
				$this->setCaPrimaTip($value);
				break;
			case 4:
				$this->setCaPrimaVlr($value);
				break;
			case 5:
				$this->setCaPrimaMin($value);
				break;
			case 6:
				$this->setCaObtencion($value);
				break;
			case 7:
				$this->setCaObservaciones($value);
				break;
			case 8:
				$this->setCaFchcreado($value);
				break;
			case 9:
				$this->setCaUsucreado($value);
				break;
			case 10:
				$this->setCaFchactualizado($value);
				break;
			case 11:
				$this->setCaUsuactualizado($value);
				break;
			case 12:
				$this->setCaTransporte($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CotSeguroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdseguro($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdcotizacion($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdmoneda($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaPrimaTip($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaPrimaVlr($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaPrimaMin($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObtencion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaObservaciones($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaFchcreado($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaUsucreado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaFchactualizado($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaUsuactualizado($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaTransporte($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CotSeguroPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotSeguroPeer::CA_IDSEGURO)) $criteria->add(CotSeguroPeer::CA_IDSEGURO, $this->ca_idseguro);
		if ($this->isColumnModified(CotSeguroPeer::CA_IDCOTIZACION)) $criteria->add(CotSeguroPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotSeguroPeer::CA_IDMONEDA)) $criteria->add(CotSeguroPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(CotSeguroPeer::CA_PRIMA_TIP)) $criteria->add(CotSeguroPeer::CA_PRIMA_TIP, $this->ca_prima_tip);
		if ($this->isColumnModified(CotSeguroPeer::CA_PRIMA_VLR)) $criteria->add(CotSeguroPeer::CA_PRIMA_VLR, $this->ca_prima_vlr);
		if ($this->isColumnModified(CotSeguroPeer::CA_PRIMA_MIN)) $criteria->add(CotSeguroPeer::CA_PRIMA_MIN, $this->ca_prima_min);
		if ($this->isColumnModified(CotSeguroPeer::CA_OBTENCION)) $criteria->add(CotSeguroPeer::CA_OBTENCION, $this->ca_obtencion);
		if ($this->isColumnModified(CotSeguroPeer::CA_OBSERVACIONES)) $criteria->add(CotSeguroPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(CotSeguroPeer::CA_FCHCREADO)) $criteria->add(CotSeguroPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotSeguroPeer::CA_USUCREADO)) $criteria->add(CotSeguroPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotSeguroPeer::CA_FCHACTUALIZADO)) $criteria->add(CotSeguroPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotSeguroPeer::CA_USUACTUALIZADO)) $criteria->add(CotSeguroPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(CotSeguroPeer::CA_TRANSPORTE)) $criteria->add(CotSeguroPeer::CA_TRANSPORTE, $this->ca_transporte);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CotSeguroPeer::DATABASE_NAME);

		$criteria->add(CotSeguroPeer::CA_IDSEGURO, $this->ca_idseguro);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdseguro();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdseguro($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaPrimaTip($this->ca_prima_tip);

		$copyObj->setCaPrimaVlr($this->ca_prima_vlr);

		$copyObj->setCaPrimaMin($this->ca_prima_min);

		$copyObj->setCaObtencion($this->ca_obtencion);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaTransporte($this->ca_transporte);


		$copyObj->setNew(true);

		$copyObj->setCaIdseguro(NULL); 
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
			self::$peer = new CotSeguroPeer();
		}
		return self::$peer;
	}

	
	public function setCotizacion(Cotizacion $v = null)
	{
		if ($v === null) {
			$this->setCaIdcotizacion(NULL);
		} else {
			$this->setCaIdcotizacion($v->getCaIdcotizacion());
		}

		$this->aCotizacion = $v;

						if ($v !== null) {
			$v->addCotSeguro($this);
		}

		return $this;
	}


	
	public function getCotizacion(PropelPDO $con = null)
	{
		if ($this->aCotizacion === null && ($this->ca_idcotizacion !== null)) {
			$c = new Criteria(CotizacionPeer::DATABASE_NAME);
			$c->add(CotizacionPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
			$this->aCotizacion = CotizacionPeer::doSelectOne($c, $con);
			
		}
		return $this->aCotizacion;
	}

	
	public function setMoneda(Moneda $v = null)
	{
		if ($v === null) {
			$this->setCaIdmoneda(NULL);
		} else {
			$this->setCaIdmoneda($v->getCaIdmoneda());
		}

		$this->aMoneda = $v;

						if ($v !== null) {
			$v->addCotSeguro($this);
		}

		return $this;
	}


	
	public function getMoneda(PropelPDO $con = null)
	{
		if ($this->aMoneda === null && (($this->ca_idmoneda !== "" && $this->ca_idmoneda !== null))) {
			$c = new Criteria(MonedaPeer::DATABASE_NAME);
			$c->add(MonedaPeer::CA_IDMONEDA, $this->ca_idmoneda);
			$this->aMoneda = MonedaPeer::doSelectOne($c, $con);
			
		}
		return $this->aMoneda;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aCotizacion = null;
			$this->aMoneda = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCotSeguro:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCotSeguro::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 