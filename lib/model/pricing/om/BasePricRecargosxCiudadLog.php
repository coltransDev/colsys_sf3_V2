<?php


abstract class BasePricRecargosxCiudadLog extends BaseObject  implements Persistent {


  const PEER = 'PricRecargosxCiudadLogPeer';

	
	protected static $peer;

	
	protected $ca_idtrafico;

	
	protected $ca_idciudad;

	
	protected $ca_idrecargo;

	
	protected $ca_modalidad;

	
	protected $ca_impoexpo;

	
	protected $ca_vlrrecargo;

	
	protected $ca_aplicacion;

	
	protected $ca_vlrminimo;

	
	protected $ca_aplicacion_min;

	
	protected $ca_observaciones;

	
	protected $ca_fchinicio;

	
	protected $ca_fchvencimiento;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_idmoneda;

	
	protected $ca_consecutivo;

	
	protected $aCiudad;

	
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

	
	public function getCaIdtrafico()
	{
		return $this->ca_idtrafico;
	}

	
	public function getCaIdciudad()
	{
		return $this->ca_idciudad;
	}

	
	public function getCaIdrecargo()
	{
		return $this->ca_idrecargo;
	}

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaVlrrecargo()
	{
		return $this->ca_vlrrecargo;
	}

	
	public function getCaAplicacion()
	{
		return $this->ca_aplicacion;
	}

	
	public function getCaVlrminimo()
	{
		return $this->ca_vlrminimo;
	}

	
	public function getCaAplicacionMin()
	{
		return $this->ca_aplicacion_min;
	}

	
	public function getCaObservaciones()
	{
		return $this->ca_observaciones;
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

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
	}

	
	public function getCaConsecutivo()
	{
		return $this->ca_consecutivo;
	}

	
	public function setCaIdtrafico($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idtrafico !== $v) {
			$this->ca_idtrafico = $v;
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_IDTRAFICO;
		}

		return $this;
	} 
	
	public function setCaIdciudad($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idciudad !== $v) {
			$this->ca_idciudad = $v;
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
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
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_IDRECARGO;
		}

		if ($this->aTipoRecargo !== null && $this->aTipoRecargo->getCaIdrecargo() !== $v) {
			$this->aTipoRecargo = null;
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
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_MODALIDAD;
		}

		return $this;
	} 
	
	public function setCaImpoexpo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_impoexpo !== $v) {
			$this->ca_impoexpo = $v;
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_IMPOEXPO;
		}

		return $this;
	} 
	
	public function setCaVlrrecargo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrrecargo !== $v) {
			$this->ca_vlrrecargo = $v;
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_VLRRECARGO;
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
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_APLICACION;
		}

		return $this;
	} 
	
	public function setCaVlrminimo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrminimo !== $v) {
			$this->ca_vlrminimo = $v;
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_VLRMINIMO;
		}

		return $this;
	} 
	
	public function setCaAplicacionMin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_aplicacion_min !== $v) {
			$this->ca_aplicacion_min = $v;
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_APLICACION_MIN;
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
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_FCHINICIO;
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
				$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_FCHVENCIMIENTO;
			}
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
				$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_USUCREADO;
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
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_IDMONEDA;
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
			$this->modifiedColumns[] = PricRecargosxCiudadLogPeer::CA_CONSECUTIVO;
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

			$this->ca_idtrafico = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_idciudad = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_idrecargo = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_modalidad = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_impoexpo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_vlrrecargo = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_aplicacion = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_vlrminimo = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_aplicacion_min = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_observaciones = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_fchinicio = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_fchcreado = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_usucreado = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_idmoneda = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_consecutivo = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PricRecargosxCiudadLog object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCiudad !== null && $this->ca_idciudad !== $this->aCiudad->getCaIdciudad()) {
			$this->aCiudad = null;
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
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PricRecargosxCiudadLogPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCiudad = null;
			$this->aTipoRecargo = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadLog:delete:pre') as $callable)
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
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PricRecargosxCiudadLogPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadLog:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePricRecargosxCiudadLog:save:pre') as $callable)
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
			$con = Propel::getConnection(PricRecargosxCiudadLogPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePricRecargosxCiudadLog:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PricRecargosxCiudadLogPeer::addInstanceToPool($this);
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

												
			if ($this->aCiudad !== null) {
				if ($this->aCiudad->isModified() || $this->aCiudad->isNew()) {
					$affectedRows += $this->aCiudad->save($con);
				}
				$this->setCiudad($this->aCiudad);
			}

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified() || $this->aTipoRecargo->isNew()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PricRecargosxCiudadLogPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PricRecargosxCiudadLogPeer::doUpdate($this, $con);
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


												
			if ($this->aCiudad !== null) {
				if (!$this->aCiudad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCiudad->getValidationFailures());
				}
			}

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = PricRecargosxCiudadLogPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricRecargosxCiudadLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdtrafico();
				break;
			case 1:
				return $this->getCaIdciudad();
				break;
			case 2:
				return $this->getCaIdrecargo();
				break;
			case 3:
				return $this->getCaModalidad();
				break;
			case 4:
				return $this->getCaImpoexpo();
				break;
			case 5:
				return $this->getCaVlrrecargo();
				break;
			case 6:
				return $this->getCaAplicacion();
				break;
			case 7:
				return $this->getCaVlrminimo();
				break;
			case 8:
				return $this->getCaAplicacionMin();
				break;
			case 9:
				return $this->getCaObservaciones();
				break;
			case 10:
				return $this->getCaFchinicio();
				break;
			case 11:
				return $this->getCaFchvencimiento();
				break;
			case 12:
				return $this->getCaFchcreado();
				break;
			case 13:
				return $this->getCaUsucreado();
				break;
			case 14:
				return $this->getCaIdmoneda();
				break;
			case 15:
				return $this->getCaConsecutivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PricRecargosxCiudadLogPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrafico(),
			$keys[1] => $this->getCaIdciudad(),
			$keys[2] => $this->getCaIdrecargo(),
			$keys[3] => $this->getCaModalidad(),
			$keys[4] => $this->getCaImpoexpo(),
			$keys[5] => $this->getCaVlrrecargo(),
			$keys[6] => $this->getCaAplicacion(),
			$keys[7] => $this->getCaVlrminimo(),
			$keys[8] => $this->getCaAplicacionMin(),
			$keys[9] => $this->getCaObservaciones(),
			$keys[10] => $this->getCaFchinicio(),
			$keys[11] => $this->getCaFchvencimiento(),
			$keys[12] => $this->getCaFchcreado(),
			$keys[13] => $this->getCaUsucreado(),
			$keys[14] => $this->getCaIdmoneda(),
			$keys[15] => $this->getCaConsecutivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PricRecargosxCiudadLogPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdtrafico($value);
				break;
			case 1:
				$this->setCaIdciudad($value);
				break;
			case 2:
				$this->setCaIdrecargo($value);
				break;
			case 3:
				$this->setCaModalidad($value);
				break;
			case 4:
				$this->setCaImpoexpo($value);
				break;
			case 5:
				$this->setCaVlrrecargo($value);
				break;
			case 6:
				$this->setCaAplicacion($value);
				break;
			case 7:
				$this->setCaVlrminimo($value);
				break;
			case 8:
				$this->setCaAplicacionMin($value);
				break;
			case 9:
				$this->setCaObservaciones($value);
				break;
			case 10:
				$this->setCaFchinicio($value);
				break;
			case 11:
				$this->setCaFchvencimiento($value);
				break;
			case 12:
				$this->setCaFchcreado($value);
				break;
			case 13:
				$this->setCaUsucreado($value);
				break;
			case 14:
				$this->setCaIdmoneda($value);
				break;
			case 15:
				$this->setCaConsecutivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PricRecargosxCiudadLogPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrafico($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdciudad($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdrecargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaModalidad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaImpoexpo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaVlrrecargo($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaAplicacion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaVlrminimo($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaAplicacionMin($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaObservaciones($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaFchinicio($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaFchvencimiento($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchcreado($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaUsucreado($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaIdmoneda($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaConsecutivo($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PricRecargosxCiudadLogPeer::DATABASE_NAME);

		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_IDTRAFICO)) $criteria->add(PricRecargosxCiudadLogPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_IDCIUDAD)) $criteria->add(PricRecargosxCiudadLogPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_IDRECARGO)) $criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_MODALIDAD)) $criteria->add(PricRecargosxCiudadLogPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_IMPOEXPO)) $criteria->add(PricRecargosxCiudadLogPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_VLRRECARGO)) $criteria->add(PricRecargosxCiudadLogPeer::CA_VLRRECARGO, $this->ca_vlrrecargo);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_APLICACION)) $criteria->add(PricRecargosxCiudadLogPeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_VLRMINIMO)) $criteria->add(PricRecargosxCiudadLogPeer::CA_VLRMINIMO, $this->ca_vlrminimo);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_APLICACION_MIN)) $criteria->add(PricRecargosxCiudadLogPeer::CA_APLICACION_MIN, $this->ca_aplicacion_min);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_OBSERVACIONES)) $criteria->add(PricRecargosxCiudadLogPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_FCHINICIO)) $criteria->add(PricRecargosxCiudadLogPeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_FCHVENCIMIENTO)) $criteria->add(PricRecargosxCiudadLogPeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_FCHCREADO)) $criteria->add(PricRecargosxCiudadLogPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_USUCREADO)) $criteria->add(PricRecargosxCiudadLogPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_IDMONEDA)) $criteria->add(PricRecargosxCiudadLogPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO)) $criteria->add(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, $this->ca_consecutivo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PricRecargosxCiudadLogPeer::DATABASE_NAME);

		$criteria->add(PricRecargosxCiudadLogPeer::CA_CONSECUTIVO, $this->ca_consecutivo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaConsecutivo();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaConsecutivo($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrafico($this->ca_idtrafico);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaIdrecargo($this->ca_idrecargo);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaVlrrecargo($this->ca_vlrrecargo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);

		$copyObj->setCaVlrminimo($this->ca_vlrminimo);

		$copyObj->setCaAplicacionMin($this->ca_aplicacion_min);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

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
			self::$peer = new PricRecargosxCiudadLogPeer();
		}
		return self::$peer;
	}

	
	public function setCiudad(Ciudad $v = null)
	{
		if ($v === null) {
			$this->setCaIdciudad(NULL);
		} else {
			$this->setCaIdciudad($v->getCaIdciudad());
		}

		$this->aCiudad = $v;

						if ($v !== null) {
			$v->addPricRecargosxCiudadLog($this);
		}

		return $this;
	}


	
	public function getCiudad(PropelPDO $con = null)
	{
		if ($this->aCiudad === null && (($this->ca_idciudad !== "" && $this->ca_idciudad !== null))) {
			$c = new Criteria(CiudadPeer::DATABASE_NAME);
			$c->add(CiudadPeer::CA_IDCIUDAD, $this->ca_idciudad);
			$this->aCiudad = CiudadPeer::doSelectOne($c, $con);
			
		}
		return $this->aCiudad;
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
			$v->addPricRecargosxCiudadLog($this);
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
			$this->aCiudad = null;
			$this->aTipoRecargo = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePricRecargosxCiudadLog:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePricRecargosxCiudadLog::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 