<?php


abstract class BaseCotRecargo extends BaseObject  implements Persistent {


  const PEER = 'CotRecargoPeer';

	
	protected static $peer;

	
	protected $ca_idcotizacion;

	
	protected $ca_idproducto;

	
	protected $ca_idopcion;

	
	protected $ca_idconcepto;

	
	protected $ca_idrecargo;

	
	protected $ca_tipo;

	
	protected $ca_valor_tar;

	
	protected $ca_aplica_tar;

	
	protected $ca_valor_min;

	
	protected $ca_aplica_min;

	
	protected $ca_idmoneda;

	
	protected $ca_modalidad;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $ca_consecutivo;

	
	protected $aCotOpcion;

	
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

	
	public function getCaIdcotizacion()
	{
		return $this->ca_idcotizacion;
	}

	
	public function getCaIdproducto()
	{
		return $this->ca_idproducto;
	}

	
	public function getCaIdopcion()
	{
		return $this->ca_idopcion;
	}

	
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
	}

	
	public function getCaIdrecargo()
	{
		return $this->ca_idrecargo;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaValorTar()
	{
		return $this->ca_valor_tar;
	}

	
	public function getCaAplicaTar()
	{
		return $this->ca_aplica_tar;
	}

	
	public function getCaValorMin()
	{
		return $this->ca_valor_min;
	}

	
	public function getCaAplicaMin()
	{
		return $this->ca_aplica_min;
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
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

	
	public function getCaConsecutivo()
	{
		return $this->ca_consecutivo;
	}

	
	public function setCaIdcotizacion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idcotizacion !== $v) {
			$this->ca_idcotizacion = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDCOTIZACION;
		}

		return $this;
	} 
	
	public function setCaIdproducto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproducto !== $v) {
			$this->ca_idproducto = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDPRODUCTO;
		}

		return $this;
	} 
	
	public function setCaIdopcion($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idopcion !== $v) {
			$this->ca_idopcion = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDOPCION;
		}

		if ($this->aCotOpcion !== null && $this->aCotOpcion->getCaIdopcion() !== $v) {
			$this->aCotOpcion = null;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDCONCEPTO;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaValorTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor_tar !== $v) {
			$this->ca_valor_tar = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_VALOR_TAR;
		}

		return $this;
	} 
	
	public function setCaAplicaTar($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplica_tar !== $v) {
			$this->ca_aplica_tar = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_APLICA_TAR;
		}

		return $this;
	} 
	
	public function setCaValorMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_valor_min !== $v) {
			$this->ca_valor_min = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_VALOR_MIN;
		}

		return $this;
	} 
	
	public function setCaAplicaMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplica_min !== $v) {
			$this->ca_aplica_min = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_APLICA_MIN;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_IDMONEDA;
		}

		return $this;
	} 
	
	public function setCaModalidad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_modalidad !== $v) {
			$this->ca_modalidad = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_MODALIDAD;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = CotRecargoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = CotRecargoPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = CotRecargoPeer::CA_USUACTUALIZADO;
		}

		return $this;
	} 
	
	public function setCaConsecutivo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_consecutivo !== $v) {
			$this->ca_consecutivo = $v;
			$this->modifiedColumns[] = CotRecargoPeer::CA_CONSECUTIVO;
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

			$this->ca_idcotizacion = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idproducto = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idopcion = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_idconcepto = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->ca_idrecargo = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
			$this->ca_tipo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_valor_tar = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_aplica_tar = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_valor_min = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_aplica_min = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_idmoneda = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_modalidad = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_observaciones = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchcreado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_usucreado = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_fchactualizado = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->ca_usuactualizado = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
			$this->ca_consecutivo = ($row[$startcol + 17] !== null) ? (int) $row[$startcol + 17] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating CotRecargo object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCotOpcion !== null && $this->ca_idopcion !== $this->aCotOpcion->getCaIdopcion()) {
			$this->aCotOpcion = null;
		}
		if ($this->aTipoRecargo !== null && $this->ca_idrecargo !== $this->aTipoRecargo->getCaIdrecargo()) {
			$this->aTipoRecargo = null;
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = CotRecargoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCotOpcion = null;
			$this->aTipoRecargo = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotRecargo:delete:pre') as $callable)
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			CotRecargoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCotRecargo:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseCotRecargo:save:pre') as $callable)
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
			$con = Propel::getConnection(CotRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCotRecargo:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			CotRecargoPeer::addInstanceToPool($this);
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

												
			if ($this->aCotOpcion !== null) {
				if ($this->aCotOpcion->isModified() || $this->aCotOpcion->isNew()) {
					$affectedRows += $this->aCotOpcion->save($con);
				}
				$this->setCotOpcion($this->aCotOpcion);
			}

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified() || $this->aTipoRecargo->isNew()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = CotRecargoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += CotRecargoPeer::doUpdate($this, $con);
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


												
			if ($this->aCotOpcion !== null) {
				if (!$this->aCotOpcion->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCotOpcion->getValidationFailures());
				}
			}

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = CotRecargoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdcotizacion();
				break;
			case 1:
				return $this->getCaIdproducto();
				break;
			case 2:
				return $this->getCaIdopcion();
				break;
			case 3:
				return $this->getCaIdconcepto();
				break;
			case 4:
				return $this->getCaIdrecargo();
				break;
			case 5:
				return $this->getCaTipo();
				break;
			case 6:
				return $this->getCaValorTar();
				break;
			case 7:
				return $this->getCaAplicaTar();
				break;
			case 8:
				return $this->getCaValorMin();
				break;
			case 9:
				return $this->getCaAplicaMin();
				break;
			case 10:
				return $this->getCaIdmoneda();
				break;
			case 11:
				return $this->getCaModalidad();
				break;
			case 12:
				return $this->getCaObservaciones();
				break;
			case 13:
				return $this->getCaFchcreado();
				break;
			case 14:
				return $this->getCaUsucreado();
				break;
			case 15:
				return $this->getCaFchactualizado();
				break;
			case 16:
				return $this->getCaUsuactualizado();
				break;
			case 17:
				return $this->getCaConsecutivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = CotRecargoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdcotizacion(),
			$keys[1] => $this->getCaIdproducto(),
			$keys[2] => $this->getCaIdopcion(),
			$keys[3] => $this->getCaIdconcepto(),
			$keys[4] => $this->getCaIdrecargo(),
			$keys[5] => $this->getCaTipo(),
			$keys[6] => $this->getCaValorTar(),
			$keys[7] => $this->getCaAplicaTar(),
			$keys[8] => $this->getCaValorMin(),
			$keys[9] => $this->getCaAplicaMin(),
			$keys[10] => $this->getCaIdmoneda(),
			$keys[11] => $this->getCaModalidad(),
			$keys[12] => $this->getCaObservaciones(),
			$keys[13] => $this->getCaFchcreado(),
			$keys[14] => $this->getCaUsucreado(),
			$keys[15] => $this->getCaFchactualizado(),
			$keys[16] => $this->getCaUsuactualizado(),
			$keys[17] => $this->getCaConsecutivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CotRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdcotizacion($value);
				break;
			case 1:
				$this->setCaIdproducto($value);
				break;
			case 2:
				$this->setCaIdopcion($value);
				break;
			case 3:
				$this->setCaIdconcepto($value);
				break;
			case 4:
				$this->setCaIdrecargo($value);
				break;
			case 5:
				$this->setCaTipo($value);
				break;
			case 6:
				$this->setCaValorTar($value);
				break;
			case 7:
				$this->setCaAplicaTar($value);
				break;
			case 8:
				$this->setCaValorMin($value);
				break;
			case 9:
				$this->setCaAplicaMin($value);
				break;
			case 10:
				$this->setCaIdmoneda($value);
				break;
			case 11:
				$this->setCaModalidad($value);
				break;
			case 12:
				$this->setCaObservaciones($value);
				break;
			case 13:
				$this->setCaFchcreado($value);
				break;
			case 14:
				$this->setCaUsucreado($value);
				break;
			case 15:
				$this->setCaFchactualizado($value);
				break;
			case 16:
				$this->setCaUsuactualizado($value);
				break;
			case 17:
				$this->setCaConsecutivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CotRecargoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdcotizacion($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdproducto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdopcion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaIdconcepto($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIdrecargo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaTipo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaValorTar($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaAplicaTar($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaValorMin($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaAplicaMin($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIdmoneda($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaModalidad($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaObservaciones($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchcreado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaUsucreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaFchactualizado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaUsuactualizado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaConsecutivo($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(CotRecargoPeer::DATABASE_NAME);

		if ($this->isColumnModified(CotRecargoPeer::CA_IDCOTIZACION)) $criteria->add(CotRecargoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		if ($this->isColumnModified(CotRecargoPeer::CA_IDPRODUCTO)) $criteria->add(CotRecargoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		if ($this->isColumnModified(CotRecargoPeer::CA_IDOPCION)) $criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);
		if ($this->isColumnModified(CotRecargoPeer::CA_IDCONCEPTO)) $criteria->add(CotRecargoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(CotRecargoPeer::CA_IDRECARGO)) $criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(CotRecargoPeer::CA_TIPO)) $criteria->add(CotRecargoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(CotRecargoPeer::CA_VALOR_TAR)) $criteria->add(CotRecargoPeer::CA_VALOR_TAR, $this->ca_valor_tar);
		if ($this->isColumnModified(CotRecargoPeer::CA_APLICA_TAR)) $criteria->add(CotRecargoPeer::CA_APLICA_TAR, $this->ca_aplica_tar);
		if ($this->isColumnModified(CotRecargoPeer::CA_VALOR_MIN)) $criteria->add(CotRecargoPeer::CA_VALOR_MIN, $this->ca_valor_min);
		if ($this->isColumnModified(CotRecargoPeer::CA_APLICA_MIN)) $criteria->add(CotRecargoPeer::CA_APLICA_MIN, $this->ca_aplica_min);
		if ($this->isColumnModified(CotRecargoPeer::CA_IDMONEDA)) $criteria->add(CotRecargoPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(CotRecargoPeer::CA_MODALIDAD)) $criteria->add(CotRecargoPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(CotRecargoPeer::CA_OBSERVACIONES)) $criteria->add(CotRecargoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(CotRecargoPeer::CA_FCHCREADO)) $criteria->add(CotRecargoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(CotRecargoPeer::CA_USUCREADO)) $criteria->add(CotRecargoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(CotRecargoPeer::CA_FCHACTUALIZADO)) $criteria->add(CotRecargoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(CotRecargoPeer::CA_USUACTUALIZADO)) $criteria->add(CotRecargoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);
		if ($this->isColumnModified(CotRecargoPeer::CA_CONSECUTIVO)) $criteria->add(CotRecargoPeer::CA_CONSECUTIVO, $this->ca_consecutivo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CotRecargoPeer::DATABASE_NAME);

		$criteria->add(CotRecargoPeer::CA_IDCOTIZACION, $this->ca_idcotizacion);
		$criteria->add(CotRecargoPeer::CA_IDPRODUCTO, $this->ca_idproducto);
		$criteria->add(CotRecargoPeer::CA_IDOPCION, $this->ca_idopcion);
		$criteria->add(CotRecargoPeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		$criteria->add(CotRecargoPeer::CA_MODALIDAD, $this->ca_modalidad);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdcotizacion();

		$pks[1] = $this->getCaIdproducto();

		$pks[2] = $this->getCaIdopcion();

		$pks[3] = $this->getCaIdconcepto();

		$pks[4] = $this->getCaIdrecargo();

		$pks[5] = $this->getCaModalidad();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdcotizacion($keys[0]);

		$this->setCaIdproducto($keys[1]);

		$this->setCaIdopcion($keys[2]);

		$this->setCaIdconcepto($keys[3]);

		$this->setCaIdrecargo($keys[4]);

		$this->setCaModalidad($keys[5]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdcotizacion($this->ca_idcotizacion);

		$copyObj->setCaIdproducto($this->ca_idproducto);

		$copyObj->setCaIdopcion($this->ca_idopcion);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

		$copyObj->setCaIdrecargo($this->ca_idrecargo);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaValorTar($this->ca_valor_tar);

		$copyObj->setCaAplicaTar($this->ca_aplica_tar);

		$copyObj->setCaValorMin($this->ca_valor_min);

		$copyObj->setCaAplicaMin($this->ca_aplica_min);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);

		$copyObj->setCaConsecutivo($this->ca_consecutivo);


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
			self::$peer = new CotRecargoPeer();
		}
		return self::$peer;
	}

	
	public function setCotOpcion(CotOpcion $v = null)
	{
		if ($v === null) {
			$this->setCaIdopcion(NULL);
		} else {
			$this->setCaIdopcion($v->getCaIdopcion());
		}

		$this->aCotOpcion = $v;

						if ($v !== null) {
			$v->addCotRecargo($this);
		}

		return $this;
	}


	
	public function getCotOpcion(PropelPDO $con = null)
	{
		if ($this->aCotOpcion === null && ($this->ca_idopcion !== null)) {
			$c = new Criteria(CotOpcionPeer::DATABASE_NAME);
			$c->add(CotOpcionPeer::CA_IDOPCION, $this->ca_idopcion);
			$this->aCotOpcion = CotOpcionPeer::doSelectOne($c, $con);
			
		}
		return $this->aCotOpcion;
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
			$v->addCotRecargo($this);
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
			$this->aCotOpcion = null;
			$this->aTipoRecargo = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCotRecargo:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCotRecargo::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 