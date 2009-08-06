<?php


abstract class BaseRecargoFlete extends BaseObject  implements Persistent {


  const PEER = 'RecargoFletePeer';

	
	protected static $peer;

	
	protected $ca_idtrayecto;

	
	protected $ca_idconcepto;

	
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

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $aFlete;

	
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

	
	public function getCaIdtrayecto()
	{
		return $this->ca_idtrayecto;
	}

	
	public function getCaIdconcepto()
	{
		return $this->ca_idconcepto;
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

	
	public function setCaIdtrayecto($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtrayecto !== $v) {
			$this->ca_idtrayecto = $v;
			$this->modifiedColumns[] = RecargoFletePeer::CA_IDTRAYECTO;
		}

		if ($this->aFlete !== null && $this->aFlete->getCaIdtrayecto() !== $v) {
			$this->aFlete = null;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_IDCONCEPTO;
		}

		if ($this->aFlete !== null && $this->aFlete->getCaIdconcepto() !== $v) {
			$this->aFlete = null;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_IDRECARGO;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_APLICACION;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_VLRFIJO;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_PORCENTAJE;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_BASEPORCENTAJE;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_VLRUNITARIO;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_BASEUNITARIO;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_RECARGOMINIMO;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_IDMONEDA;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = RecargoFletePeer::CA_FCHINICIO;
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
				$this->modifiedColumns[] = RecargoFletePeer::CA_FCHVENCIMIENTO;
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
				$this->modifiedColumns[] = RecargoFletePeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = RecargoFletePeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = RecargoFletePeer::CA_USUACTUALIZADO;
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

			$this->ca_idtrayecto = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idconcepto = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
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
			throw new PropelException("Error populating RecargoFlete object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aFlete !== null && $this->ca_idtrayecto !== $this->aFlete->getCaIdtrayecto()) {
			$this->aFlete = null;
		}
		if ($this->aFlete !== null && $this->ca_idconcepto !== $this->aFlete->getCaIdconcepto()) {
			$this->aFlete = null;
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
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = RecargoFletePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aFlete = null;
			$this->aTipoRecargo = null;
		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRecargoFlete:delete:pre') as $callable)
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
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			RecargoFletePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRecargoFlete:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseRecargoFlete:save:pre') as $callable)
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
			$con = Propel::getConnection(RecargoFletePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRecargoFlete:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			RecargoFletePeer::addInstanceToPool($this);
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

												
			if ($this->aFlete !== null) {
				if ($this->aFlete->isModified() || $this->aFlete->isNew()) {
					$affectedRows += $this->aFlete->save($con);
				}
				$this->setFlete($this->aFlete);
			}

			if ($this->aTipoRecargo !== null) {
				if ($this->aTipoRecargo->isModified() || $this->aTipoRecargo->isNew()) {
					$affectedRows += $this->aTipoRecargo->save($con);
				}
				$this->setTipoRecargo($this->aTipoRecargo);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = RecargoFletePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RecargoFletePeer::doUpdate($this, $con);
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


												
			if ($this->aFlete !== null) {
				if (!$this->aFlete->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFlete->getValidationFailures());
				}
			}

			if ($this->aTipoRecargo !== null) {
				if (!$this->aTipoRecargo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTipoRecargo->getValidationFailures());
				}
			}


			if (($retval = RecargoFletePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RecargoFletePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdtrayecto();
				break;
			case 1:
				return $this->getCaIdconcepto();
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
		$keys = RecargoFletePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtrayecto(),
			$keys[1] => $this->getCaIdconcepto(),
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
			$keys[14] => $this->getCaFchcreado(),
			$keys[15] => $this->getCaUsucreado(),
			$keys[16] => $this->getCaFchactualizado(),
			$keys[17] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RecargoFletePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdtrayecto($value);
				break;
			case 1:
				$this->setCaIdconcepto($value);
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
		$keys = RecargoFletePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtrayecto($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdconcepto($arr[$keys[1]]);
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
		if (array_key_exists($keys[14], $arr)) $this->setCaFchcreado($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCaUsucreado($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setCaFchactualizado($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCaUsuactualizado($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RecargoFletePeer::DATABASE_NAME);

		if ($this->isColumnModified(RecargoFletePeer::CA_IDTRAYECTO)) $criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		if ($this->isColumnModified(RecargoFletePeer::CA_IDCONCEPTO)) $criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		if ($this->isColumnModified(RecargoFletePeer::CA_IDRECARGO)) $criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(RecargoFletePeer::CA_APLICACION)) $criteria->add(RecargoFletePeer::CA_APLICACION, $this->ca_aplicacion);
		if ($this->isColumnModified(RecargoFletePeer::CA_VLRFIJO)) $criteria->add(RecargoFletePeer::CA_VLRFIJO, $this->ca_vlrfijo);
		if ($this->isColumnModified(RecargoFletePeer::CA_PORCENTAJE)) $criteria->add(RecargoFletePeer::CA_PORCENTAJE, $this->ca_porcentaje);
		if ($this->isColumnModified(RecargoFletePeer::CA_BASEPORCENTAJE)) $criteria->add(RecargoFletePeer::CA_BASEPORCENTAJE, $this->ca_baseporcentaje);
		if ($this->isColumnModified(RecargoFletePeer::CA_VLRUNITARIO)) $criteria->add(RecargoFletePeer::CA_VLRUNITARIO, $this->ca_vlrunitario);
		if ($this->isColumnModified(RecargoFletePeer::CA_BASEUNITARIO)) $criteria->add(RecargoFletePeer::CA_BASEUNITARIO, $this->ca_baseunitario);
		if ($this->isColumnModified(RecargoFletePeer::CA_RECARGOMINIMO)) $criteria->add(RecargoFletePeer::CA_RECARGOMINIMO, $this->ca_recargominimo);
		if ($this->isColumnModified(RecargoFletePeer::CA_IDMONEDA)) $criteria->add(RecargoFletePeer::CA_IDMONEDA, $this->ca_idmoneda);
		if ($this->isColumnModified(RecargoFletePeer::CA_OBSERVACIONES)) $criteria->add(RecargoFletePeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(RecargoFletePeer::CA_FCHINICIO)) $criteria->add(RecargoFletePeer::CA_FCHINICIO, $this->ca_fchinicio);
		if ($this->isColumnModified(RecargoFletePeer::CA_FCHVENCIMIENTO)) $criteria->add(RecargoFletePeer::CA_FCHVENCIMIENTO, $this->ca_fchvencimiento);
		if ($this->isColumnModified(RecargoFletePeer::CA_FCHCREADO)) $criteria->add(RecargoFletePeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(RecargoFletePeer::CA_USUCREADO)) $criteria->add(RecargoFletePeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(RecargoFletePeer::CA_FCHACTUALIZADO)) $criteria->add(RecargoFletePeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(RecargoFletePeer::CA_USUACTUALIZADO)) $criteria->add(RecargoFletePeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RecargoFletePeer::DATABASE_NAME);

		$criteria->add(RecargoFletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
		$criteria->add(RecargoFletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);
		$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCaIdtrayecto();

		$pks[1] = $this->getCaIdconcepto();

		$pks[2] = $this->getCaIdrecargo();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCaIdtrayecto($keys[0]);

		$this->setCaIdconcepto($keys[1]);

		$this->setCaIdrecargo($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtrayecto($this->ca_idtrayecto);

		$copyObj->setCaIdconcepto($this->ca_idconcepto);

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
			self::$peer = new RecargoFletePeer();
		}
		return self::$peer;
	}

	
	public function setFlete(Flete $v = null)
	{
		if ($v === null) {
			$this->setCaIdtrayecto(NULL);
		} else {
			$this->setCaIdtrayecto($v->getCaIdtrayecto());
		}

		if ($v === null) {
			$this->setCaIdconcepto(NULL);
		} else {
			$this->setCaIdconcepto($v->getCaIdconcepto());
		}

		$this->aFlete = $v;

						if ($v !== null) {
			$v->addRecargoFlete($this);
		}

		return $this;
	}


	
	public function getFlete(PropelPDO $con = null)
	{
		if ($this->aFlete === null && ($this->ca_idtrayecto !== null && $this->ca_idconcepto !== null)) {
			$c = new Criteria(FletePeer::DATABASE_NAME);
			$c->add(FletePeer::CA_IDTRAYECTO, $this->ca_idtrayecto);
			$c->add(FletePeer::CA_IDCONCEPTO, $this->ca_idconcepto);
			$this->aFlete = FletePeer::doSelectOne($c, $con);
			
		}
		return $this->aFlete;
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
			$v->addRecargoFlete($this);
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
			$this->aFlete = null;
			$this->aTipoRecargo = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRecargoFlete:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRecargoFlete::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 