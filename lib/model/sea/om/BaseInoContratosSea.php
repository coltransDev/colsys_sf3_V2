<?php


abstract class BaseInoContratosSea extends BaseObject  implements Persistent {


  const PEER = 'InoContratosSeaPeer';

	
	protected static $peer;

	
	protected $ca_referencia;

	
	protected $ca_idequipo;

	
	protected $ca_idcontrato;

	
	protected $ca_fchcontrato;

	
	protected $ca_inspeccion_nta;

	
	protected $ca_inspeccion_fch;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $aInoEquiposSea;

	
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

	
	public function getCaReferencia()
	{
		return $this->ca_referencia;
	}

	
	public function getCaIdequipo()
	{
		return $this->ca_idequipo;
	}

	
	public function getCaIdcontrato()
	{
		return $this->ca_idcontrato;
	}

	
	public function getCaFchcontrato($format = 'Y-m-d')
	{
		if ($this->ca_fchcontrato === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_fchcontrato);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_fchcontrato, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaInspeccionNta()
	{
		return $this->ca_inspeccion_nta;
	}

	
	public function getCaInspeccionFch($format = 'Y-m-d')
	{
		if ($this->ca_inspeccion_fch === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_inspeccion_fch);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_inspeccion_fch, true), $x);
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

	
	public function setCaReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_referencia !== $v) {
			$this->ca_referencia = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_REFERENCIA;
		}

		if ($this->aInoEquiposSea !== null && $this->aInoEquiposSea->getCaReferencia() !== $v) {
			$this->aInoEquiposSea = null;
		}

		return $this;
	} 
	
	public function setCaIdequipo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idequipo !== $v) {
			$this->ca_idequipo = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_IDEQUIPO;
		}

		if ($this->aInoEquiposSea !== null && $this->aInoEquiposSea->getCaIdequipo() !== $v) {
			$this->aInoEquiposSea = null;
		}

		return $this;
	} 
	
	public function setCaIdcontrato($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idcontrato !== $v) {
			$this->ca_idcontrato = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_IDCONTRATO;
		}

		return $this;
	} 
	
	public function setCaFchcontrato($v)
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

		if ( $this->ca_fchcontrato !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_fchcontrato !== null && $tmpDt = new DateTime($this->ca_fchcontrato)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_fchcontrato = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoContratosSeaPeer::CA_FCHCONTRATO;
			}
		} 
		return $this;
	} 
	
	public function setCaInspeccionNta($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_inspeccion_nta !== $v) {
			$this->ca_inspeccion_nta = $v;
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_INSPECCION_NTA;
		}

		return $this;
	} 
	
	public function setCaInspeccionFch($v)
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

		if ( $this->ca_inspeccion_fch !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_inspeccion_fch !== null && $tmpDt = new DateTime($this->ca_inspeccion_fch)) ? $tmpDt->format('Y-m-d') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_inspeccion_fch = ($dt ? $dt->format('Y-m-d') : null);
				$this->modifiedColumns[] = InoContratosSeaPeer::CA_INSPECCION_FCH;
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
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = InoContratosSeaPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = InoContratosSeaPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = InoContratosSeaPeer::CA_USUACTUALIZADO;
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

			$this->ca_referencia = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idequipo = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idcontrato = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_fchcontrato = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_inspeccion_nta = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_inspeccion_fch = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_observaciones = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchcreado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usucreado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_fchactualizado = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_usuactualizado = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InoContratosSea object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aInoEquiposSea !== null && $this->ca_referencia !== $this->aInoEquiposSea->getCaReferencia()) {
			$this->aInoEquiposSea = null;
		}
		if ($this->aInoEquiposSea !== null && $this->ca_idequipo !== $this->aInoEquiposSea->getCaIdequipo()) {
			$this->aInoEquiposSea = null;
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
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = InoContratosSeaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aInoEquiposSea = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoContratosSea:delete:pre') as $callable)
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
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			InoContratosSeaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseInoContratosSea:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseInoContratosSea:save:pre') as $callable)
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
			$con = Propel::getConnection(InoContratosSeaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseInoContratosSea:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			InoContratosSeaPeer::addInstanceToPool($this);
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

												
			if ($this->aInoEquiposSea !== null) {
				if ($this->aInoEquiposSea->isModified() || $this->aInoEquiposSea->isNew()) {
					$affectedRows += $this->aInoEquiposSea->save($con);
				}
				$this->setInoEquiposSea($this->aInoEquiposSea);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InoContratosSeaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InoContratosSeaPeer::doUpdate($this, $con);
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


												
			if ($this->aInoEquiposSea !== null) {
				if (!$this->aInoEquiposSea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInoEquiposSea->getValidationFailures());
				}
			}


			if (($retval = InoContratosSeaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoContratosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaReferencia();
				break;
			case 1:
				return $this->getCaIdequipo();
				break;
			case 2:
				return $this->getCaIdcontrato();
				break;
			case 3:
				return $this->getCaFchcontrato();
				break;
			case 4:
				return $this->getCaInspeccionNta();
				break;
			case 5:
				return $this->getCaInspeccionFch();
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
			case 9:
				return $this->getCaFchactualizado();
				break;
			case 10:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = InoContratosSeaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaReferencia(),
			$keys[1] => $this->getCaIdequipo(),
			$keys[2] => $this->getCaIdcontrato(),
			$keys[3] => $this->getCaFchcontrato(),
			$keys[4] => $this->getCaInspeccionNta(),
			$keys[5] => $this->getCaInspeccionFch(),
			$keys[6] => $this->getCaObservaciones(),
			$keys[7] => $this->getCaFchcreado(),
			$keys[8] => $this->getCaUsucreado(),
			$keys[9] => $this->getCaFchactualizado(),
			$keys[10] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InoContratosSeaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaReferencia($value);
				break;
			case 1:
				$this->setCaIdequipo($value);
				break;
			case 2:
				$this->setCaIdcontrato($value);
				break;
			case 3:
				$this->setCaFchcontrato($value);
				break;
			case 4:
				$this->setCaInspeccionNta($value);
				break;
			case 5:
				$this->setCaInspeccionFch($value);
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
			case 9:
				$this->setCaFchactualizado($value);
				break;
			case 10:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InoContratosSeaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaReferencia($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdequipo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdcontrato($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaFchcontrato($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaInspeccionNta($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaInspeccionFch($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaObservaciones($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchcreado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsucreado($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaFchactualizado($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaUsuactualizado($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InoContratosSeaPeer::DATABASE_NAME);

		if ($this->isColumnModified(InoContratosSeaPeer::CA_REFERENCIA)) $criteria->add(InoContratosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_IDEQUIPO)) $criteria->add(InoContratosSeaPeer::CA_IDEQUIPO, $this->ca_idequipo);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_IDCONTRATO)) $criteria->add(InoContratosSeaPeer::CA_IDCONTRATO, $this->ca_idcontrato);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_FCHCONTRATO)) $criteria->add(InoContratosSeaPeer::CA_FCHCONTRATO, $this->ca_fchcontrato);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_INSPECCION_NTA)) $criteria->add(InoContratosSeaPeer::CA_INSPECCION_NTA, $this->ca_inspeccion_nta);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_INSPECCION_FCH)) $criteria->add(InoContratosSeaPeer::CA_INSPECCION_FCH, $this->ca_inspeccion_fch);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_OBSERVACIONES)) $criteria->add(InoContratosSeaPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_FCHCREADO)) $criteria->add(InoContratosSeaPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_USUCREADO)) $criteria->add(InoContratosSeaPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_FCHACTUALIZADO)) $criteria->add(InoContratosSeaPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(InoContratosSeaPeer::CA_USUACTUALIZADO)) $criteria->add(InoContratosSeaPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InoContratosSeaPeer::DATABASE_NAME);

		$criteria->add(InoContratosSeaPeer::CA_REFERENCIA, $this->ca_referencia);
		$criteria->add(InoContratosSeaPeer::CA_IDEQUIPO, $this->ca_idequipo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaReferencia();

		$pks[1] = $this->getCaIdequipo();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaReferencia($keys[0]);

		$this->setCaIdequipo($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaReferencia($this->ca_referencia);

		$copyObj->setCaIdequipo($this->ca_idequipo);

		$copyObj->setCaIdcontrato($this->ca_idcontrato);

		$copyObj->setCaFchcontrato($this->ca_fchcontrato);

		$copyObj->setCaInspeccionNta($this->ca_inspeccion_nta);

		$copyObj->setCaInspeccionFch($this->ca_inspeccion_fch);

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
			self::$peer = new InoContratosSeaPeer();
		}
		return self::$peer;
	}

	
	public function setInoEquiposSea(InoEquiposSea $v = null)
	{
		if ($v === null) {
			$this->setCaReferencia(NULL);
		} else {
			$this->setCaReferencia($v->getCaReferencia());
		}

		if ($v === null) {
			$this->setCaIdequipo(NULL);
		} else {
			$this->setCaIdequipo($v->getCaIdequipo());
		}

		$this->aInoEquiposSea = $v;

				if ($v !== null) {
			$v->setInoContratosSea($this);
		}

		return $this;
	}


	
	public function getInoEquiposSea(PropelPDO $con = null)
	{
		if ($this->aInoEquiposSea === null && (($this->ca_referencia !== "" && $this->ca_referencia !== null) && $this->ca_idequipo !== null)) {
			$c = new Criteria(InoEquiposSeaPeer::DATABASE_NAME);
			$c->add(InoEquiposSeaPeer::CA_REFERENCIA, $this->ca_referencia);
			$c->add(InoEquiposSeaPeer::CA_IDEQUIPO, $this->ca_idequipo);
			$this->aInoEquiposSea = InoEquiposSeaPeer::doSelectOne($c, $con);
						$this->aInoEquiposSea->setInoContratosSea($this);
		}
		return $this->aInoEquiposSea;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} 
			$this->aInoEquiposSea = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseInoContratosSea:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseInoContratosSea::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 