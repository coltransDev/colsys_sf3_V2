<?php


abstract class BaseTipoRecargo extends BaseObject  implements Persistent {


  const PEER = 'TipoRecargoPeer';

	
	protected static $peer;

	
	protected $ca_idrecargo;

	
	protected $ca_recargo;

	
	protected $ca_tipo;

	
	protected $ca_transporte;

	
	protected $ca_incoterms;

	
	protected $ca_reporte;

	
	protected $ca_impoexpo;

	
	protected $ca_aplicacion;

	
	protected $collPricRecargoxConceptos;

	
	private $lastPricRecargoxConceptoCriteria = null;

	
	protected $collPricRecargoxConceptoLogs;

	
	private $lastPricRecargoxConceptoLogCriteria = null;

	
	protected $collPricRecargosxCiudads;

	
	private $lastPricRecargosxCiudadCriteria = null;

	
	protected $collPricRecargosxCiudadLogs;

	
	private $lastPricRecargosxCiudadLogCriteria = null;

	
	protected $collPricRecargosxLineas;

	
	private $lastPricRecargosxLineaCriteria = null;

	
	protected $collPricRecargosxLineaLogs;

	
	private $lastPricRecargosxLineaLogCriteria = null;

	
	protected $collRecargoFletes;

	
	private $lastRecargoFleteCriteria = null;

	
	protected $collRecargoFleteTrafs;

	
	private $lastRecargoFleteTrafCriteria = null;

	
	protected $collRepGastos;

	
	private $lastRepGastoCriteria = null;

	
	protected $collCotRecargos;

	
	private $lastCotRecargoCriteria = null;

	
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

	
	public function getCaIdrecargo()
	{
		return $this->ca_idrecargo;
	}

	
	public function getCaRecargo()
	{
		return $this->ca_recargo;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaIncoterms()
	{
		return $this->ca_incoterms;
	}

	
	public function getCaReporte()
	{
		return $this->ca_reporte;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaAplicacion()
	{
		return $this->ca_aplicacion;
	}

	
	public function setCaIdrecargo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idrecargo !== $v) {
			$this->ca_idrecargo = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_IDRECARGO;
		}

		return $this;
	} 
	
	public function setCaRecargo($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_recargo !== $v) {
			$this->ca_recargo = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_RECARGO;
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
			$this->modifiedColumns[] = TipoRecargoPeer::CA_TIPO;
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
			$this->modifiedColumns[] = TipoRecargoPeer::CA_TRANSPORTE;
		}

		return $this;
	} 
	
	public function setCaIncoterms($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_incoterms !== $v) {
			$this->ca_incoterms = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_INCOTERMS;
		}

		return $this;
	} 
	
	public function setCaReporte($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_reporte !== $v) {
			$this->ca_reporte = $v;
			$this->modifiedColumns[] = TipoRecargoPeer::CA_REPORTE;
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
			$this->modifiedColumns[] = TipoRecargoPeer::CA_IMPOEXPO;
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
			$this->modifiedColumns[] = TipoRecargoPeer::CA_APLICACION;
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

			$this->ca_idrecargo = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_recargo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_tipo = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_transporte = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_incoterms = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_reporte = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_impoexpo = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_aplicacion = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TipoRecargo object", $e);
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
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TipoRecargoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collPricRecargoxConceptos = null;
			$this->lastPricRecargoxConceptoCriteria = null;

			$this->collPricRecargoxConceptoLogs = null;
			$this->lastPricRecargoxConceptoLogCriteria = null;

			$this->collPricRecargosxCiudads = null;
			$this->lastPricRecargosxCiudadCriteria = null;

			$this->collPricRecargosxCiudadLogs = null;
			$this->lastPricRecargosxCiudadLogCriteria = null;

			$this->collPricRecargosxLineas = null;
			$this->lastPricRecargosxLineaCriteria = null;

			$this->collPricRecargosxLineaLogs = null;
			$this->lastPricRecargosxLineaLogCriteria = null;

			$this->collRecargoFletes = null;
			$this->lastRecargoFleteCriteria = null;

			$this->collRecargoFleteTrafs = null;
			$this->lastRecargoFleteTrafCriteria = null;

			$this->collRepGastos = null;
			$this->lastRepGastoCriteria = null;

			$this->collCotRecargos = null;
			$this->lastCotRecargoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTipoRecargo:delete:pre') as $callable)
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
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TipoRecargoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTipoRecargo:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTipoRecargo:save:pre') as $callable)
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
			$con = Propel::getConnection(TipoRecargoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTipoRecargo:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TipoRecargoPeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TipoRecargoPeer::CA_IDRECARGO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TipoRecargoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdrecargo($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TipoRecargoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collPricRecargoxConceptos !== null) {
				foreach ($this->collPricRecargoxConceptos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargoxConceptoLogs !== null) {
				foreach ($this->collPricRecargoxConceptoLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxCiudads !== null) {
				foreach ($this->collPricRecargosxCiudads as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxCiudadLogs !== null) {
				foreach ($this->collPricRecargosxCiudadLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxLineas !== null) {
				foreach ($this->collPricRecargosxLineas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricRecargosxLineaLogs !== null) {
				foreach ($this->collPricRecargosxLineaLogs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRecargoFletes !== null) {
				foreach ($this->collRecargoFletes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRecargoFleteTrafs !== null) {
				foreach ($this->collRecargoFleteTrafs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepGastos !== null) {
				foreach ($this->collRepGastos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotRecargos !== null) {
				foreach ($this->collCotRecargos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
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


			if (($retval = TipoRecargoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPricRecargoxConceptos !== null) {
					foreach ($this->collPricRecargoxConceptos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargoxConceptoLogs !== null) {
					foreach ($this->collPricRecargoxConceptoLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxCiudads !== null) {
					foreach ($this->collPricRecargosxCiudads as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxCiudadLogs !== null) {
					foreach ($this->collPricRecargosxCiudadLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxLineas !== null) {
					foreach ($this->collPricRecargosxLineas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricRecargosxLineaLogs !== null) {
					foreach ($this->collPricRecargosxLineaLogs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRecargoFletes !== null) {
					foreach ($this->collRecargoFletes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRecargoFleteTrafs !== null) {
					foreach ($this->collRecargoFleteTrafs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepGastos !== null) {
					foreach ($this->collRepGastos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotRecargos !== null) {
					foreach ($this->collCotRecargos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TipoRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdrecargo();
				break;
			case 1:
				return $this->getCaRecargo();
				break;
			case 2:
				return $this->getCaTipo();
				break;
			case 3:
				return $this->getCaTransporte();
				break;
			case 4:
				return $this->getCaIncoterms();
				break;
			case 5:
				return $this->getCaReporte();
				break;
			case 6:
				return $this->getCaImpoexpo();
				break;
			case 7:
				return $this->getCaAplicacion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TipoRecargoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdrecargo(),
			$keys[1] => $this->getCaRecargo(),
			$keys[2] => $this->getCaTipo(),
			$keys[3] => $this->getCaTransporte(),
			$keys[4] => $this->getCaIncoterms(),
			$keys[5] => $this->getCaReporte(),
			$keys[6] => $this->getCaImpoexpo(),
			$keys[7] => $this->getCaAplicacion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TipoRecargoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdrecargo($value);
				break;
			case 1:
				$this->setCaRecargo($value);
				break;
			case 2:
				$this->setCaTipo($value);
				break;
			case 3:
				$this->setCaTransporte($value);
				break;
			case 4:
				$this->setCaIncoterms($value);
				break;
			case 5:
				$this->setCaReporte($value);
				break;
			case 6:
				$this->setCaImpoexpo($value);
				break;
			case 7:
				$this->setCaAplicacion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TipoRecargoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdrecargo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaRecargo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTipo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTransporte($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaIncoterms($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaReporte($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaImpoexpo($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaAplicacion($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);

		if ($this->isColumnModified(TipoRecargoPeer::CA_IDRECARGO)) $criteria->add(TipoRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_RECARGO)) $criteria->add(TipoRecargoPeer::CA_RECARGO, $this->ca_recargo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_TIPO)) $criteria->add(TipoRecargoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_TRANSPORTE)) $criteria->add(TipoRecargoPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(TipoRecargoPeer::CA_INCOTERMS)) $criteria->add(TipoRecargoPeer::CA_INCOTERMS, $this->ca_incoterms);
		if ($this->isColumnModified(TipoRecargoPeer::CA_REPORTE)) $criteria->add(TipoRecargoPeer::CA_REPORTE, $this->ca_reporte);
		if ($this->isColumnModified(TipoRecargoPeer::CA_IMPOEXPO)) $criteria->add(TipoRecargoPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(TipoRecargoPeer::CA_APLICACION)) $criteria->add(TipoRecargoPeer::CA_APLICACION, $this->ca_aplicacion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);

		$criteria->add(TipoRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdrecargo();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdrecargo($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaRecargo($this->ca_recargo);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaIncoterms($this->ca_incoterms);

		$copyObj->setCaReporte($this->ca_reporte);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaAplicacion($this->ca_aplicacion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getPricRecargoxConceptos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargoxConcepto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargoxConceptoLogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargoxConceptoLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargosxCiudads() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargosxCiudad($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargosxCiudadLogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargosxCiudadLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargosxLineas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargosxLinea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricRecargosxLineaLogs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargosxLineaLog($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRecargoFletes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRecargoFlete($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRecargoFleteTrafs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRecargoFleteTraf($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepGastos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepGasto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotRecargos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotRecargo($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdrecargo(NULL); 
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
			self::$peer = new TipoRecargoPeer();
		}
		return self::$peer;
	}

	
	public function clearPricRecargoxConceptos()
	{
		$this->collPricRecargoxConceptos = null; 	}

	
	public function initPricRecargoxConceptos()
	{
		$this->collPricRecargoxConceptos = array();
	}

	
	public function getPricRecargoxConceptos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
			   $this->collPricRecargoxConceptos = array();
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargoxConceptoPeer::addSelectColumns($criteria);
				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargoxConceptoPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
					$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargoxConceptoCriteria = $criteria;
		return $this->collPricRecargoxConceptos;
	}

	
	public function countPricRecargoxConceptos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargoxConceptoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
					$count = PricRecargoxConceptoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargoxConceptos);
				}
			} else {
				$count = count($this->collPricRecargoxConceptos);
			}
		}
		return $count;
	}

	
	public function addPricRecargoxConcepto(PricRecargoxConcepto $l)
	{
		if ($this->collPricRecargoxConceptos === null) {
			$this->initPricRecargoxConceptos();
		}
		if (!in_array($l, $this->collPricRecargoxConceptos, true)) { 			array_push($this->collPricRecargoxConceptos, $l);
			$l->setTipoRecargo($this);
		}
	}


	
	public function getPricRecargoxConceptosJoinPricFlete($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptos === null) {
			if ($this->isNew()) {
				$this->collPricRecargoxConceptos = array();
			} else {

				$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelectJoinPricFlete($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargoxConceptoPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargoxConceptoCriteria) || !$this->lastPricRecargoxConceptoCriteria->equals($criteria)) {
				$this->collPricRecargoxConceptos = PricRecargoxConceptoPeer::doSelectJoinPricFlete($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargoxConceptoCriteria = $criteria;

		return $this->collPricRecargoxConceptos;
	}

	
	public function clearPricRecargoxConceptoLogs()
	{
		$this->collPricRecargoxConceptoLogs = null; 	}

	
	public function initPricRecargoxConceptoLogs()
	{
		$this->collPricRecargoxConceptoLogs = array();
	}

	
	public function getPricRecargoxConceptoLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargoxConceptoLogs = array();
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargoxConceptoLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
					$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargoxConceptoLogCriteria = $criteria;
		return $this->collPricRecargoxConceptoLogs;
	}

	
	public function countPricRecargoxConceptoLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargoxConceptoLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
					$count = PricRecargoxConceptoLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargoxConceptoLogs);
				}
			} else {
				$count = count($this->collPricRecargoxConceptoLogs);
			}
		}
		return $count;
	}

	
	public function addPricRecargoxConceptoLog(PricRecargoxConceptoLog $l)
	{
		if ($this->collPricRecargoxConceptoLogs === null) {
			$this->initPricRecargoxConceptoLogs();
		}
		if (!in_array($l, $this->collPricRecargoxConceptoLogs, true)) { 			array_push($this->collPricRecargoxConceptoLogs, $l);
			$l->setTipoRecargo($this);
		}
	}


	
	public function getPricRecargoxConceptoLogsJoinPricFlete($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoxConceptoLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargoxConceptoLogs = array();
			} else {

				$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelectJoinPricFlete($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargoxConceptoLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargoxConceptoLogCriteria) || !$this->lastPricRecargoxConceptoLogCriteria->equals($criteria)) {
				$this->collPricRecargoxConceptoLogs = PricRecargoxConceptoLogPeer::doSelectJoinPricFlete($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargoxConceptoLogCriteria = $criteria;

		return $this->collPricRecargoxConceptoLogs;
	}

	
	public function clearPricRecargosxCiudads()
	{
		$this->collPricRecargosxCiudads = null; 	}

	
	public function initPricRecargosxCiudads()
	{
		$this->collPricRecargosxCiudads = array();
	}

	
	public function getPricRecargosxCiudads($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxCiudads = array();
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxCiudadPeer::addSelectColumns($criteria);
				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxCiudadPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
					$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxCiudadCriteria = $criteria;
		return $this->collPricRecargosxCiudads;
	}

	
	public function countPricRecargosxCiudads(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargosxCiudadPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
					$count = PricRecargosxCiudadPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxCiudads);
				}
			} else {
				$count = count($this->collPricRecargosxCiudads);
			}
		}
		return $count;
	}

	
	public function addPricRecargosxCiudad(PricRecargosxCiudad $l)
	{
		if ($this->collPricRecargosxCiudads === null) {
			$this->initPricRecargosxCiudads();
		}
		if (!in_array($l, $this->collPricRecargosxCiudads, true)) { 			array_push($this->collPricRecargosxCiudads, $l);
			$l->setTipoRecargo($this);
		}
	}


	
	public function getPricRecargosxCiudadsJoinCiudad($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudads === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxCiudads = array();
			} else {

				$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxCiudadPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxCiudadCriteria) || !$this->lastPricRecargosxCiudadCriteria->equals($criteria)) {
				$this->collPricRecargosxCiudads = PricRecargosxCiudadPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxCiudadCriteria = $criteria;

		return $this->collPricRecargosxCiudads;
	}

	
	public function clearPricRecargosxCiudadLogs()
	{
		$this->collPricRecargosxCiudadLogs = null; 	}

	
	public function initPricRecargosxCiudadLogs()
	{
		$this->collPricRecargosxCiudadLogs = array();
	}

	
	public function getPricRecargosxCiudadLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxCiudadLogs = array();
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxCiudadLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
					$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxCiudadLogCriteria = $criteria;
		return $this->collPricRecargosxCiudadLogs;
	}

	
	public function countPricRecargosxCiudadLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargosxCiudadLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
					$count = PricRecargosxCiudadLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxCiudadLogs);
				}
			} else {
				$count = count($this->collPricRecargosxCiudadLogs);
			}
		}
		return $count;
	}

	
	public function addPricRecargosxCiudadLog(PricRecargosxCiudadLog $l)
	{
		if ($this->collPricRecargosxCiudadLogs === null) {
			$this->initPricRecargosxCiudadLogs();
		}
		if (!in_array($l, $this->collPricRecargosxCiudadLogs, true)) { 			array_push($this->collPricRecargosxCiudadLogs, $l);
			$l->setTipoRecargo($this);
		}
	}


	
	public function getPricRecargosxCiudadLogsJoinCiudad($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxCiudadLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxCiudadLogs = array();
			} else {

				$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxCiudadLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxCiudadLogCriteria) || !$this->lastPricRecargosxCiudadLogCriteria->equals($criteria)) {
				$this->collPricRecargosxCiudadLogs = PricRecargosxCiudadLogPeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxCiudadLogCriteria = $criteria;

		return $this->collPricRecargosxCiudadLogs;
	}

	
	public function clearPricRecargosxLineas()
	{
		$this->collPricRecargosxLineas = null; 	}

	
	public function initPricRecargosxLineas()
	{
		$this->collPricRecargosxLineas = array();
	}

	
	public function getPricRecargosxLineas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxLineaPeer::addSelectColumns($criteria);
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxLineaPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
					$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;
		return $this->collPricRecargosxLineas;
	}

	
	public function countPricRecargosxLineas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargosxLineaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
					$count = PricRecargosxLineaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxLineas);
				}
			} else {
				$count = count($this->collPricRecargosxLineas);
			}
		}
		return $count;
	}

	
	public function addPricRecargosxLinea(PricRecargosxLinea $l)
	{
		if ($this->collPricRecargosxLineas === null) {
			$this->initPricRecargosxLineas();
		}
		if (!in_array($l, $this->collPricRecargosxLineas, true)) { 			array_push($this->collPricRecargosxLineas, $l);
			$l->setTipoRecargo($this);
		}
	}


	
	public function getPricRecargosxLineasJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;

		return $this->collPricRecargosxLineas;
	}


	
	public function getPricRecargosxLineasJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;

		return $this->collPricRecargosxLineas;
	}

	
	public function clearPricRecargosxLineaLogs()
	{
		$this->collPricRecargosxLineaLogs = null; 	}

	
	public function initPricRecargosxLineaLogs()
	{
		$this->collPricRecargosxLineaLogs = array();
	}

	
	public function getPricRecargosxLineaLogs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxLineaLogPeer::addSelectColumns($criteria);
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				PricRecargosxLineaLogPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
					$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;
		return $this->collPricRecargosxLineaLogs;
	}

	
	public function countPricRecargosxLineaLogs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = PricRecargosxLineaLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
					$count = PricRecargosxLineaLogPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargosxLineaLogs);
				}
			} else {
				$count = count($this->collPricRecargosxLineaLogs);
			}
		}
		return $count;
	}

	
	public function addPricRecargosxLineaLog(PricRecargosxLineaLog $l)
	{
		if ($this->collPricRecargosxLineaLogs === null) {
			$this->initPricRecargosxLineaLogs();
		}
		if (!in_array($l, $this->collPricRecargosxLineaLogs, true)) { 			array_push($this->collPricRecargosxLineaLogs, $l);
			$l->setTipoRecargo($this);
		}
	}


	
	public function getPricRecargosxLineaLogsJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;

		return $this->collPricRecargosxLineaLogs;
	}


	
	public function getPricRecargosxLineaLogsJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaLogPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;

		return $this->collPricRecargosxLineaLogs;
	}

	
	public function clearRecargoFletes()
	{
		$this->collRecargoFletes = null; 	}

	
	public function initRecargoFletes()
	{
		$this->collRecargoFletes = array();
	}

	
	public function getRecargoFletes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
			   $this->collRecargoFletes = array();
			} else {

				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

				RecargoFletePeer::addSelectColumns($criteria);
				$this->collRecargoFletes = RecargoFletePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

				RecargoFletePeer::addSelectColumns($criteria);
				if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
					$this->collRecargoFletes = RecargoFletePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;
		return $this->collRecargoFletes;
	}

	
	public function countRecargoFletes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = RecargoFletePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
					$count = RecargoFletePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRecargoFletes);
				}
			} else {
				$count = count($this->collRecargoFletes);
			}
		}
		return $count;
	}

	
	public function addRecargoFlete(RecargoFlete $l)
	{
		if ($this->collRecargoFletes === null) {
			$this->initRecargoFletes();
		}
		if (!in_array($l, $this->collRecargoFletes, true)) { 			array_push($this->collRecargoFletes, $l);
			$l->setTipoRecargo($this);
		}
	}


	
	public function getRecargoFletesJoinFlete($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFletes === null) {
			if ($this->isNew()) {
				$this->collRecargoFletes = array();
			} else {

				$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collRecargoFletes = RecargoFletePeer::doSelectJoinFlete($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RecargoFletePeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastRecargoFleteCriteria) || !$this->lastRecargoFleteCriteria->equals($criteria)) {
				$this->collRecargoFletes = RecargoFletePeer::doSelectJoinFlete($criteria, $con, $join_behavior);
			}
		}
		$this->lastRecargoFleteCriteria = $criteria;

		return $this->collRecargoFletes;
	}

	
	public function clearRecargoFleteTrafs()
	{
		$this->collRecargoFleteTrafs = null; 	}

	
	public function initRecargoFleteTrafs()
	{
		$this->collRecargoFleteTrafs = array();
	}

	
	public function getRecargoFleteTrafs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRecargoFleteTrafs === null) {
			if ($this->isNew()) {
			   $this->collRecargoFleteTrafs = array();
			} else {

				$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);

				RecargoFleteTrafPeer::addSelectColumns($criteria);
				$this->collRecargoFleteTrafs = RecargoFleteTrafPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);

				RecargoFleteTrafPeer::addSelectColumns($criteria);
				if (!isset($this->lastRecargoFleteTrafCriteria) || !$this->lastRecargoFleteTrafCriteria->equals($criteria)) {
					$this->collRecargoFleteTrafs = RecargoFleteTrafPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRecargoFleteTrafCriteria = $criteria;
		return $this->collRecargoFleteTrafs;
	}

	
	public function countRecargoFleteTrafs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRecargoFleteTrafs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = RecargoFleteTrafPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RecargoFleteTrafPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastRecargoFleteTrafCriteria) || !$this->lastRecargoFleteTrafCriteria->equals($criteria)) {
					$count = RecargoFleteTrafPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRecargoFleteTrafs);
				}
			} else {
				$count = count($this->collRecargoFleteTrafs);
			}
		}
		return $count;
	}

	
	public function addRecargoFleteTraf(RecargoFleteTraf $l)
	{
		if ($this->collRecargoFleteTrafs === null) {
			$this->initRecargoFleteTrafs();
		}
		if (!in_array($l, $this->collRecargoFleteTrafs, true)) { 			array_push($this->collRecargoFleteTrafs, $l);
			$l->setTipoRecargo($this);
		}
	}

	
	public function clearRepGastos()
	{
		$this->collRepGastos = null; 	}

	
	public function initRepGastos()
	{
		$this->collRepGastos = array();
	}

	
	public function getRepGastos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
			   $this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				RepGastoPeer::addSelectColumns($criteria);
				$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				RepGastoPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
					$this->collRepGastos = RepGastoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepGastoCriteria = $criteria;
		return $this->collRepGastos;
	}

	
	public function countRepGastos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = RepGastoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
					$count = RepGastoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepGastos);
				}
			} else {
				$count = count($this->collRepGastos);
			}
		}
		return $count;
	}

	
	public function addRepGasto(RepGasto $l)
	{
		if ($this->collRepGastos === null) {
			$this->initRepGastos();
		}
		if (!in_array($l, $this->collRepGastos, true)) { 			array_push($this->collRepGastos, $l);
			$l->setTipoRecargo($this);
		}
	}


	
	public function getRepGastosJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collRepGastos = RepGastoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}


	
	public function getRepGastosJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepGastos === null) {
			if ($this->isNew()) {
				$this->collRepGastos = array();
			} else {

				$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepGastoPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastRepGastoCriteria) || !$this->lastRepGastoCriteria->equals($criteria)) {
				$this->collRepGastos = RepGastoPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepGastoCriteria = $criteria;

		return $this->collRepGastos;
	}

	
	public function clearCotRecargos()
	{
		$this->collCotRecargos = null; 	}

	
	public function initCotRecargos()
	{
		$this->collCotRecargos = array();
	}

	
	public function getCotRecargos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
			   $this->collCotRecargos = array();
			} else {

				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				CotRecargoPeer::addSelectColumns($criteria);
				$this->collCotRecargos = CotRecargoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				CotRecargoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
					$this->collCotRecargos = CotRecargoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotRecargoCriteria = $criteria;
		return $this->collCotRecargos;
	}

	
	public function countCotRecargos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$count = CotRecargoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
					$count = CotRecargoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotRecargos);
				}
			} else {
				$count = count($this->collCotRecargos);
			}
		}
		return $count;
	}

	
	public function addCotRecargo(CotRecargo $l)
	{
		if ($this->collCotRecargos === null) {
			$this->initCotRecargos();
		}
		if (!in_array($l, $this->collCotRecargos, true)) { 			array_push($this->collCotRecargos, $l);
			$l->setTipoRecargo($this);
		}
	}


	
	public function getCotRecargosJoinCotOpcion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TipoRecargoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotRecargos === null) {
			if ($this->isNew()) {
				$this->collCotRecargos = array();
			} else {

				$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

				$this->collCotRecargos = CotRecargoPeer::doSelectJoinCotOpcion($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotRecargoPeer::CA_IDRECARGO, $this->ca_idrecargo);

			if (!isset($this->lastCotRecargoCriteria) || !$this->lastCotRecargoCriteria->equals($criteria)) {
				$this->collCotRecargos = CotRecargoPeer::doSelectJoinCotOpcion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotRecargoCriteria = $criteria;

		return $this->collCotRecargos;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collPricRecargoxConceptos) {
				foreach ((array) $this->collPricRecargoxConceptos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargoxConceptoLogs) {
				foreach ((array) $this->collPricRecargoxConceptoLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargosxCiudads) {
				foreach ((array) $this->collPricRecargosxCiudads as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargosxCiudadLogs) {
				foreach ((array) $this->collPricRecargosxCiudadLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargosxLineas) {
				foreach ((array) $this->collPricRecargosxLineas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricRecargosxLineaLogs) {
				foreach ((array) $this->collPricRecargosxLineaLogs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRecargoFletes) {
				foreach ((array) $this->collRecargoFletes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRecargoFleteTrafs) {
				foreach ((array) $this->collRecargoFleteTrafs as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepGastos) {
				foreach ((array) $this->collRepGastos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotRecargos) {
				foreach ((array) $this->collCotRecargos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collPricRecargoxConceptos = null;
		$this->collPricRecargoxConceptoLogs = null;
		$this->collPricRecargosxCiudads = null;
		$this->collPricRecargosxCiudadLogs = null;
		$this->collPricRecargosxLineas = null;
		$this->collPricRecargosxLineaLogs = null;
		$this->collRecargoFletes = null;
		$this->collRecargoFleteTrafs = null;
		$this->collRepGastos = null;
		$this->collCotRecargos = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTipoRecargo:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTipoRecargo::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 