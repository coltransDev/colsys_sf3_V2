<?php


abstract class BaseRecargoFleteTraf extends BaseObject  implements Persistent {


  const PEER = 'RecargoFleteTrafPeer';

	
	protected static $peer;

	
	protected $ca_idtrafico;

	
	protected $ca_idciudad;

	
	protected $ca_idrecargo;

	
	protected $ca_aplicacion;

	
	protected $ca_vlrfijo;

	
	protected $ca_porcentaje;

	
	protected $ca_baseporcentaje;

	
	protected $ca_vlrunitario;

	
	protected $ca_baseunitario;

	
	protected $ca_recargominimo;

	
	protected $ca_idmoneda;

	
	protected $ca_observaciones;

	
	protected $ca_fchinicio;

	
	protected $ca_fchvencimiento;

	
	protected $ca_modalidad;

	
	protected $ca_impoexpo;

	
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

	
	public function getCaAplicacion()
	{
		return $this->ca_aplicacion;
	}

	
	public function getCaVlrfijo()
	{
		return $this->ca_vlrfijo;
	}

	
	public function getCaPorcentaje()
	{
		return $this->ca_porcentaje;
	}

	
	public function getCaBaseporcentaje()
	{
		return $this->ca_baseporcentaje;
	}

	
	public function getCaVlrunitario()
	{
		return $this->ca_vlrunitario;
	}

	
	public function getCaBaseunitario()
	{
		return $this->ca_baseunitario;
	}

	
	public function getCaRecargominimo()
	{
		return $this->ca_recargominimo;
	}

	
	public function getCaIdmoneda()
	{
		return $this->ca_idmoneda;
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

	
	public function getCaModalidad()
	{
		return $this->ca_modalidad;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function setCaIdtrafico($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idtrafico !== $v) {
			$this->ca_idtrafico = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_IDTRAFICO;
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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_IDCIUDAD;
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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_IDRECARGO;
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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_APLICACION;
		}

		return $this;
	} 
	
	public function setCaVlrfijo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrfijo !== $v) {
			$this->ca_vlrfijo = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_VLRFIJO;
		}

		return $this;
	} 
	
	public function setCaPorcentaje($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_porcentaje !== $v) {
			$this->ca_porcentaje = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_PORCENTAJE;
		}

		return $this;
	} 
	
	public function setCaBaseporcentaje($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_baseporcentaje !== $v) {
			$this->ca_baseporcentaje = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_BASEPORCENTAJE;
		}

		return $this;
	} 
	
	public function setCaVlrunitario($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vlrunitario !== $v) {
			$this->ca_vlrunitario = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_VLRUNITARIO;
		}

		return $this;
	} 
	
	public function setCaBaseunitario($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_baseunitario !== $v) {
			$this->ca_baseunitario = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_BASEUNITARIO;
		}

		return $this;
	} 
	
	public function setCaRecargominimo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_recargominimo !== $v) {
			$this->ca_recargominimo = $v;
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_RECARGOMINIMO;
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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_IDMONEDA;
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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_FCHINICIO;
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
				$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_FCHVENCIMIENTO;
			}
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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_MODALIDAD;
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
			$this->modifiedColumns[] = RecargoFleteTrafPeer::CA_IMPOEXPO;
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
			$this->ca_aplicacion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_vlrfijo = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_porcentaje = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_baseporcentaje = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_vlrunitario = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_baseunitario = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_recargominimo = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_idmoneda = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_observaciones = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_fchinicio = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->ca_fchvencimiento = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->ca_modalidad = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->ca_impoexpo = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 16; 
		} catch (Exception $e) {
			throw new PropelException("Error populating RecargoFleteTraf object", $e);
		}
	}

	
	public function ensureConsistency()
	{

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
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RecargoFleteTrafPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aTipoRecargo = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRecargoFleteTraf:delete:pre') as $callable)
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
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RecargoFleteTrafPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRecargoFleteTraf:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRecargoFleteTraf:save:pre') as $callable)
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
			$con = Propel::getConnection(RecargoFleteTrafPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRecargoFleteTraf:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RecargoFleteTrafPeer::addInstanceToPool($this);
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

												
			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified() || $this->aTipoRecargo->isNew()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RecargoFleteTrafPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RecargoFleteTrafPeer::doUpdate($this, $con);
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


												
			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = RecargoFleteTrafPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RecargoFleteTrafPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCaAplicacion();
				break;
			case 4:
				return $this->getCaVlrfijo();
				break;
			case 5:
				return $this->getCaPorcentaje();
				break;
			case 6:
				return $this->getCaBaseporcentaje();
				break;
			case 7:
				return $this->getCaVlrunitario();
				break;
			case 8:
				return $this->getCaBaseunitario();
				break;
			case 9:
				return $this->getCaRecargominimo();
				break;
			case 10:
				return $this->getCaIdmoneda();
				break;
			case 11:
				return $this->getCaObservaciones();
				break;
			case 12:
				return $this->getCaFchinicio();
				break;
			case 13:
				return $this->getCaFchvencimiento();
				break;
			case 14:
				return $this->getCaModalidad();
				break;
			case 15:
				return $this->getCaImpoexpo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = RecargoFleteTrafPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrafico(),
			$keys[1] => $this->getCaIdciudad(),
			$keys[2] => $this->getCaIdrecargo(),
			$keys[3] => $this->getCaAplicacion(),
			$keys[4] => $this->getCaVlrfijo(),
			$keys[5] => $this->getCaPorcentaje(),
			$keys[6] => $this->getCaBaseporcentaje(),
			$keys[7] => $this->getCaVlrunitario(),
			$keys[8] => $this->getCaBaseunitario(),
			$keys[9] => $this->getCaRecargominimo(),
			$keys[10] => $this->getCaIdmoneda(),
			$keys[11] => $this->getCaObservaciones(),
			$keys[12] => $this->getCaFchinicio(),
			$keys[13] => $this->getCaFchvencimiento(),
			$keys[14] => $this->getCaModalidad(),
			$keys[15] => $this->getCaImpoexpo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RecargoFleteTrafPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCaAplicacion($value);
				break;
			case 4:
				$this->setCaVlrfijo($value);
				break;
			case 5:
				$this->setCaPorcentaje($value);
				break;
			case 6:
				$this->setCaBaseporcentaje($value);
				break;
			case 7:
				$this->setCaVlrunitario($value);
				break;
			case 8:
				$this->setCaBaseunitario($value);
				break;
			case 9:
				$this->setCaRecargominimo($value);
				break;
			case 10:
				$this->setCaIdmoneda($value);
				break;
			case 11:
				$this->setCaObservaciones($value);
				break;
			case 12:
				$this->setCaFchinicio($value);
				break;
			case 13:
				$this->setCaFchvencimiento($value);
				break;
			case 14:
				$this->setCaModalidad($value);
				break;
			case 15:
				$this->setCaImpoexpo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RecargoFleteTrafPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrafico($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdciudad($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdrecargo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaAplicacion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaVlrfijo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaPorcentaje($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaBaseporcentaje($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaVlrunitario($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaBaseunitario($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaRecargominimo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIdmoneda($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaObservaciones($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaFchinicio($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setCaFchvencimiento($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCaModalidad($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaImpoexpo($arr[$keys[15]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RecargoFleteTrafPeer::DATABASE_NAME);

		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_IDTRAFICO)) $criteria->add(RecargoFleteTrafPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_IDCIUDAD)) $criteria->add(RecargoFleteTrafPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_IDRECARGO)) $criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_APLICACION)) $criteria->add(RecargoFleteTrafPeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_VLRFIJO)) $criteria->add(RecargoFleteTrafPeer::CA_VLRFIJO, $this->ca_vlrfijo);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_PORCENTAJE)) $criteria->add(RecargoFleteTrafPeer::CA_PORCENTAJE, $this->ca_porcentaje);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_BASEPORCENTAJE)) $criteria->add(RecargoFleteTrafPeer::CA_BASEPORCENTAJE, $this->ca_baseporcentaje);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_VLRUNITARIO)) $criteria->add(RecargoFleteTrafPeer::CA_VLRUNITARIO, $this->ca_vlrunitario);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_BASEUNITARIO)) $criteria->add(RecargoFleteTrafPeer::CA_BASEUNITARIO, $this->ca_baseunitario);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_RECARGOMINIMO)) $criteria->add(RecargoFleteTrafPeer::CA_RECARGOMINIMO, $this->ca_recargominimo);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_IDMONEDA)) $criteria->add(RecargoFleteTrafPeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_OBSERVACIONES)) $criteria->add(RecargoFleteTrafPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_FCHINICIO)) $criteria->add(RecargoFleteTrafPeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_FCHVENCIMIENTO)) $criteria->add(RecargoFleteTrafPeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_MODALIDAD)) $criteria->add(RecargoFleteTrafPeer::CA_MODALIDAD, $this->ca_modalidad);
		if ($this->isColumnModified(RecargoFleteTrafPeer::CA_IMPOEXPO)) $criteria->add(RecargoFleteTrafPeer::CA_IMPOEXPO, $this->ca_impoexpo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RecargoFleteTrafPeer::DATABASE_NAME);

		$criteria->add(RecargoFleteTrafPeer::CA_IDTRAFICO, $this->ca_idtrafico);
		$criteria->add(RecargoFleteTrafPeer::CA_IDCIUDAD, $this->ca_idciudad);
		$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);
		$criteria->add(RecargoFleteTrafPeer::CA_MODALIDAD, $this->ca_modalidad);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdtrafico();

		$pks[1] = $this->getCaIdciudad();

		$pks[2] = $this->getCaIdrecargo();

		$pks[3] = $this->getCaModalidad();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdtrafico($keys[0]);

		$this->setCaIdciudad($keys[1]);

		$this->setCaIdrecargo($keys[2]);

		$this->setCaModalidad($keys[3]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrafico($this->ca_idtrafico);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaIdrecargo($this->ca_idrecargo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);

		$copyObj->setCaVlrfijo($this->ca_vlrfijo);

		$copyObj->setCaPorcentaje($this->ca_porcentaje);

		$copyObj->setCaBaseporcentaje($this->ca_baseporcentaje);

		$copyObj->setCaVlrunitario($this->ca_vlrunitario);

		$copyObj->setCaBaseunitario($this->ca_baseunitario);

		$copyObj->setCaRecargominimo($this->ca_recargominimo);

		$copyObj->setCaIdmoneda($this->ca_idmoneda);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchinicio($this->ca_fchinicio);

		$copyObj->setCaFchvencimiento($this->ca_fchvencimiento);

		$copyObj->setCaModalidad($this->ca_modalidad);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);


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
			self::$peer = new RecargoFleteTrafPeer();
		}
		return self::$peer;
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
			$v->addRecargoFleteTraf($this);
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
			$this->aTipoRecargo = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRecargoFleteTraf:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRecargoFleteTraf::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 