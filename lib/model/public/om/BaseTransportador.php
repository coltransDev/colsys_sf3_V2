<?php


abstract class BaseTransportador extends BaseObject  implements Persistent {


  const PEER = 'TransportadorPeer';

	
	protected static $peer;

	
	protected $ca_idlinea;

	
	protected $ca_idtransportista;

	
	protected $ca_nombre;

	
	protected $ca_sigla;

	
	protected $ca_transporte;

	
	protected $ca_activo;

	
	protected $aIdsProveedor;

	
	protected $aTransportista;

	
	protected $collTrayectos;

	
	private $lastTrayectoCriteria = null;

	
	protected $collPricRecargosxLineas;

	
	private $lastPricRecargosxLineaCriteria = null;

	
	protected $collPricRecargosxLineaLogs;

	
	private $lastPricRecargosxLineaLogCriteria = null;

	
	protected $collPricRecargoParametros;

	
	private $lastPricRecargoParametroCriteria = null;

	
	protected $collPricPatioLineas;

	
	private $lastPricPatioLineaCriteria = null;

	
	protected $collReportes;

	
	private $lastReporteCriteria = null;

	
	protected $collCotProductos;

	
	private $lastCotProductoCriteria = null;

	
	protected $collInoMaestraSeas;

	
	private $lastInoMaestraSeaCriteria = null;

	
	protected $collInoMaestraAirs;

	
	private $lastInoMaestraAirCriteria = null;

	
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

	
	public function getCaIdlinea()
	{
		return $this->ca_idlinea;
	}

	
	public function getCaIdtransportista()
	{
		return $this->ca_idtransportista;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaSigla()
	{
		return $this->ca_sigla;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaActivo()
	{
		return $this->ca_activo;
	}

	
	public function setCaIdlinea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idlinea !== $v) {
			$this->ca_idlinea = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_IDLINEA;
		}

		return $this;
	} 
	
	public function setCaIdtransportista($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idtransportista !== $v) {
			$this->ca_idtransportista = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_IDTRANSPORTISTA;
		}

		if ($this->aIdsProveedor !== null && $this->aIdsProveedor->getCaIdproveedor() !== $v) {
			$this->aIdsProveedor = null;
		}

		if ($this->aTransportista !== null && $this->aTransportista->getCaIdtransportista() !== $v) {
			$this->aTransportista = null;
		}

		return $this;
	} 
	
	public function setCaNombre($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_nombre !== $v) {
			$this->ca_nombre = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaSigla($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_sigla !== $v) {
			$this->ca_sigla = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_SIGLA;
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
			$this->modifiedColumns[] = TransportadorPeer::CA_TRANSPORTE;
		}

		return $this;
	} 
	
	public function setCaActivo($v)
	{
		if ($v !== null) {
			$v = (boolean) $v;
		}

		if ($this->ca_activo !== $v) {
			$this->ca_activo = $v;
			$this->modifiedColumns[] = TransportadorPeer::CA_ACTIVO;
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

			$this->ca_idlinea = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idtransportista = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_sigla = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_transporte = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_activo = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Transportador object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aIdsProveedor !== null && $this->ca_idtransportista !== $this->aIdsProveedor->getCaIdproveedor()) {
			$this->aIdsProveedor = null;
		}
		if ($this->aTransportista !== null && $this->ca_idtransportista !== $this->aTransportista->getCaIdtransportista()) {
			$this->aTransportista = null;
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
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TransportadorPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aIdsProveedor = null;
			$this->aTransportista = null;
			$this->collTrayectos = null;
			$this->lastTrayectoCriteria = null;

			$this->collPricRecargosxLineas = null;
			$this->lastPricRecargosxLineaCriteria = null;

			$this->collPricRecargosxLineaLogs = null;
			$this->lastPricRecargosxLineaLogCriteria = null;

			$this->collPricRecargoParametros = null;
			$this->lastPricRecargoParametroCriteria = null;

			$this->collPricPatioLineas = null;
			$this->lastPricPatioLineaCriteria = null;

			$this->collReportes = null;
			$this->lastReporteCriteria = null;

			$this->collCotProductos = null;
			$this->lastCotProductoCriteria = null;

			$this->collInoMaestraSeas = null;
			$this->lastInoMaestraSeaCriteria = null;

			$this->collInoMaestraAirs = null;
			$this->lastInoMaestraAirCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransportador:delete:pre') as $callable)
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
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TransportadorPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTransportador:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransportador:save:pre') as $callable)
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
			$con = Propel::getConnection(TransportadorPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTransportador:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TransportadorPeer::addInstanceToPool($this);
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

												
			if ($this->aIdsProveedor !== null) {
				if ($this->aIdsProveedor->isModified() || $this->aIdsProveedor->isNew()) {
					$affectedRows += $this->aIdsProveedor->save($con);
				}
				$this->setIdsProveedor($this->aIdsProveedor);
			}

			if ($this->aTransportista !== null) {
				if ($this->aTransportista->isModified() || $this->aTransportista->isNew()) {
					$affectedRows += $this->aTransportista->save($con);
				}
				$this->setTransportista($this->aTransportista);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = TransportadorPeer::CA_IDLINEA;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TransportadorPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdlinea($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TransportadorPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collTrayectos !== null) {
				foreach ($this->collTrayectos as $referrerFK) {
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

			if ($this->collPricRecargoParametros !== null) {
				foreach ($this->collPricRecargoParametros as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPricPatioLineas !== null) {
				foreach ($this->collPricPatioLineas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collReportes !== null) {
				foreach ($this->collReportes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCotProductos !== null) {
				foreach ($this->collCotProductos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoMaestraSeas !== null) {
				foreach ($this->collInoMaestraSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoMaestraAirs !== null) {
				foreach ($this->collInoMaestraAirs as $referrerFK) {
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


												
			if ($this->aIdsProveedor !== null) {
				if (!$this->aIdsProveedor->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aIdsProveedor->getValidationFailures());
				}
			}

			if ($this->aTransportista !== null) {
				if (!$this->aTransportista->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTransportista->getValidationFailures());
				}
			}


			if (($retval = TransportadorPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTrayectos !== null) {
					foreach ($this->collTrayectos as $referrerFK) {
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

				if ($this->collPricRecargoParametros !== null) {
					foreach ($this->collPricRecargoParametros as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPricPatioLineas !== null) {
					foreach ($this->collPricPatioLineas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collReportes !== null) {
					foreach ($this->collReportes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCotProductos !== null) {
					foreach ($this->collCotProductos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoMaestraSeas !== null) {
					foreach ($this->collInoMaestraSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoMaestraAirs !== null) {
					foreach ($this->collInoMaestraAirs as $referrerFK) {
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
		$pos = TransportadorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdlinea();
				break;
			case 1:
				return $this->getCaIdtransportista();
				break;
			case 2:
				return $this->getCaNombre();
				break;
			case 3:
				return $this->getCaSigla();
				break;
			case 4:
				return $this->getCaTransporte();
				break;
			case 5:
				return $this->getCaActivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TransportadorPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdlinea(),
			$keys[1] => $this->getCaIdtransportista(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaSigla(),
			$keys[4] => $this->getCaTransporte(),
			$keys[5] => $this->getCaActivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TransportadorPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdlinea($value);
				break;
			case 1:
				$this->setCaIdtransportista($value);
				break;
			case 2:
				$this->setCaNombre($value);
				break;
			case 3:
				$this->setCaSigla($value);
				break;
			case 4:
				$this->setCaTransporte($value);
				break;
			case 5:
				$this->setCaActivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TransportadorPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdlinea($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdtransportista($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaSigla($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTransporte($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaActivo($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);

		if ($this->isColumnModified(TransportadorPeer::CA_IDLINEA)) $criteria->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);
		if ($this->isColumnModified(TransportadorPeer::CA_IDTRANSPORTISTA)) $criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);
		if ($this->isColumnModified(TransportadorPeer::CA_NOMBRE)) $criteria->add(TransportadorPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TransportadorPeer::CA_SIGLA)) $criteria->add(TransportadorPeer::CA_SIGLA, $this->ca_sigla);
		if ($this->isColumnModified(TransportadorPeer::CA_TRANSPORTE)) $criteria->add(TransportadorPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(TransportadorPeer::CA_ACTIVO)) $criteria->add(TransportadorPeer::CA_ACTIVO, $this->ca_activo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);

		$criteria->add(TransportadorPeer::CA_IDLINEA, $this->ca_idlinea);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdlinea();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdlinea($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdtransportista($this->ca_idtransportista);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaSigla($this->ca_sigla);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaActivo($this->ca_activo);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getTrayectos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addTrayecto($relObj->copy($deepCopy));
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

			foreach ($this->getPricRecargoParametros() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricRecargoParametro($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getPricPatioLineas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addPricPatioLinea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getReportes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addReporte($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getCotProductos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addCotProducto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoMaestraSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoMaestraSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoMaestraAirs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoMaestraAir($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdlinea(NULL); 
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
			self::$peer = new TransportadorPeer();
		}
		return self::$peer;
	}

	
	public function setIdsProveedor(IdsProveedor $v = null)
	{
		if ($v === null) {
			$this->setCaIdtransportista(NULL);
		} else {
			$this->setCaIdtransportista($v->getCaIdproveedor());
		}

		$this->aIdsProveedor = $v;

						if ($v !== null) {
			$v->addTransportador($this);
		}

		return $this;
	}


	
	public function getIdsProveedor(PropelPDO $con = null)
	{
		if ($this->aIdsProveedor === null && (($this->ca_idtransportista !== "" && $this->ca_idtransportista !== null))) {
			$c = new Criteria(IdsProveedorPeer::DATABASE_NAME);
			$c->add(IdsProveedorPeer::CA_IDPROVEEDOR, $this->ca_idtransportista);
			$this->aIdsProveedor = IdsProveedorPeer::doSelectOne($c, $con);
			
		}
		return $this->aIdsProveedor;
	}

	
	public function setTransportista(Transportista $v = null)
	{
		if ($v === null) {
			$this->setCaIdtransportista(NULL);
		} else {
			$this->setCaIdtransportista($v->getCaIdtransportista());
		}

		$this->aTransportista = $v;

						if ($v !== null) {
			$v->addTransportador($this);
		}

		return $this;
	}


	
	public function getTransportista(PropelPDO $con = null)
	{
		if ($this->aTransportista === null && (($this->ca_idtransportista !== "" && $this->ca_idtransportista !== null))) {
			$c = new Criteria(TransportistaPeer::DATABASE_NAME);
			$c->add(TransportistaPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);
			$this->aTransportista = TransportistaPeer::doSelectOne($c, $con);
			
		}
		return $this->aTransportista;
	}

	
	public function clearTrayectos()
	{
		$this->collTrayectos = null; 	}

	
	public function initTrayectos()
	{
		$this->collTrayectos = array();
	}

	
	public function getTrayectos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrayectos === null) {
			if ($this->isNew()) {
			   $this->collTrayectos = array();
			} else {

				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

				TrayectoPeer::addSelectColumns($criteria);
				$this->collTrayectos = TrayectoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

				TrayectoPeer::addSelectColumns($criteria);
				if (!isset($this->lastTrayectoCriteria) || !$this->lastTrayectoCriteria->equals($criteria)) {
					$this->collTrayectos = TrayectoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTrayectoCriteria = $criteria;
		return $this->collTrayectos;
	}

	
	public function countTrayectos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTrayectos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = TrayectoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastTrayectoCriteria) || !$this->lastTrayectoCriteria->equals($criteria)) {
					$count = TrayectoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collTrayectos);
				}
			} else {
				$count = count($this->collTrayectos);
			}
		}
		return $count;
	}

	
	public function addTrayecto(Trayecto $l)
	{
		if ($this->collTrayectos === null) {
			$this->initTrayectos();
		}
		if (!in_array($l, $this->collTrayectos, true)) { 			array_push($this->collTrayectos, $l);
			$l->setTransportador($this);
		}
	}


	
	public function getTrayectosJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrayectos === null) {
			if ($this->isNew()) {
				$this->collTrayectos = array();
			} else {

				$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collTrayectos = TrayectoPeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(TrayectoPeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastTrayectoCriteria) || !$this->lastTrayectoCriteria->equals($criteria)) {
				$this->collTrayectos = TrayectoPeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		}
		$this->lastTrayectoCriteria = $criteria;

		return $this->collTrayectos;
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
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->ca_idlinea);

				PricRecargosxLineaPeer::addSelectColumns($criteria);
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->ca_idlinea);

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
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
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

				$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = PricRecargosxLineaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->ca_idlinea);

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
			$l->setTransportador($this);
		}
	}


	
	public function getPricRecargosxLineasJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastPricRecargosxLineaCriteria) || !$this->lastPricRecargosxLineaCriteria->equals($criteria)) {
				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaCriteria = $criteria;

		return $this->collPricRecargosxLineas;
	}


	
	public function getPricRecargosxLineasJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineas === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineas = array();
			} else {

				$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collPricRecargosxLineas = PricRecargosxLineaPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaPeer::CA_IDLINEA, $this->ca_idlinea);

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
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
			   $this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDLINEA, $this->ca_idlinea);

				PricRecargosxLineaLogPeer::addSelectColumns($criteria);
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDLINEA, $this->ca_idlinea);

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
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
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

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = PricRecargosxLineaLogPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDLINEA, $this->ca_idlinea);

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
			$l->setTransportador($this);
		}
	}


	
	public function getPricRecargosxLineaLogsJoinTipoRecargo($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaLogPeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinTipoRecargo($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;

		return $this->collPricRecargosxLineaLogs;
	}


	
	public function getPricRecargosxLineaLogsJoinConcepto($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargosxLineaLogs === null) {
			if ($this->isNew()) {
				$this->collPricRecargosxLineaLogs = array();
			} else {

				$criteria->add(PricRecargosxLineaLogPeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricRecargosxLineaLogPeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastPricRecargosxLineaLogCriteria) || !$this->lastPricRecargosxLineaLogCriteria->equals($criteria)) {
				$this->collPricRecargosxLineaLogs = PricRecargosxLineaLogPeer::doSelectJoinConcepto($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricRecargosxLineaLogCriteria = $criteria;

		return $this->collPricRecargosxLineaLogs;
	}

	
	public function clearPricRecargoParametros()
	{
		$this->collPricRecargoParametros = null; 	}

	
	public function initPricRecargoParametros()
	{
		$this->collPricRecargoParametros = array();
	}

	
	public function getPricRecargoParametros($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricRecargoParametros === null) {
			if ($this->isNew()) {
			   $this->collPricRecargoParametros = array();
			} else {

				$criteria->add(PricRecargoParametroPeer::CA_IDLINEA, $this->ca_idlinea);

				PricRecargoParametroPeer::addSelectColumns($criteria);
				$this->collPricRecargoParametros = PricRecargoParametroPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargoParametroPeer::CA_IDLINEA, $this->ca_idlinea);

				PricRecargoParametroPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricRecargoParametroCriteria) || !$this->lastPricRecargoParametroCriteria->equals($criteria)) {
					$this->collPricRecargoParametros = PricRecargoParametroPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricRecargoParametroCriteria = $criteria;
		return $this->collPricRecargoParametros;
	}

	
	public function countPricRecargoParametros(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricRecargoParametros === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricRecargoParametroPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = PricRecargoParametroPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricRecargoParametroPeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastPricRecargoParametroCriteria) || !$this->lastPricRecargoParametroCriteria->equals($criteria)) {
					$count = PricRecargoParametroPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricRecargoParametros);
				}
			} else {
				$count = count($this->collPricRecargoParametros);
			}
		}
		return $count;
	}

	
	public function addPricRecargoParametro(PricRecargoParametro $l)
	{
		if ($this->collPricRecargoParametros === null) {
			$this->initPricRecargoParametros();
		}
		if (!in_array($l, $this->collPricRecargoParametros, true)) { 			array_push($this->collPricRecargoParametros, $l);
			$l->setTransportador($this);
		}
	}

	
	public function clearPricPatioLineas()
	{
		$this->collPricPatioLineas = null; 	}

	
	public function initPricPatioLineas()
	{
		$this->collPricPatioLineas = array();
	}

	
	public function getPricPatioLineas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricPatioLineas === null) {
			if ($this->isNew()) {
			   $this->collPricPatioLineas = array();
			} else {

				$criteria->add(PricPatioLineaPeer::CA_IDLINEA, $this->ca_idlinea);

				PricPatioLineaPeer::addSelectColumns($criteria);
				$this->collPricPatioLineas = PricPatioLineaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricPatioLineaPeer::CA_IDLINEA, $this->ca_idlinea);

				PricPatioLineaPeer::addSelectColumns($criteria);
				if (!isset($this->lastPricPatioLineaCriteria) || !$this->lastPricPatioLineaCriteria->equals($criteria)) {
					$this->collPricPatioLineas = PricPatioLineaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPricPatioLineaCriteria = $criteria;
		return $this->collPricPatioLineas;
	}

	
	public function countPricPatioLineas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collPricPatioLineas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(PricPatioLineaPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = PricPatioLineaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PricPatioLineaPeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastPricPatioLineaCriteria) || !$this->lastPricPatioLineaCriteria->equals($criteria)) {
					$count = PricPatioLineaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collPricPatioLineas);
				}
			} else {
				$count = count($this->collPricPatioLineas);
			}
		}
		return $count;
	}

	
	public function addPricPatioLinea(PricPatioLinea $l)
	{
		if ($this->collPricPatioLineas === null) {
			$this->initPricPatioLineas();
		}
		if (!in_array($l, $this->collPricPatioLineas, true)) { 			array_push($this->collPricPatioLineas, $l);
			$l->setTransportador($this);
		}
	}


	
	public function getPricPatioLineasJoinPricPatio($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPricPatioLineas === null) {
			if ($this->isNew()) {
				$this->collPricPatioLineas = array();
			} else {

				$criteria->add(PricPatioLineaPeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collPricPatioLineas = PricPatioLineaPeer::doSelectJoinPricPatio($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(PricPatioLineaPeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastPricPatioLineaCriteria) || !$this->lastPricPatioLineaCriteria->equals($criteria)) {
				$this->collPricPatioLineas = PricPatioLineaPeer::doSelectJoinPricPatio($criteria, $con, $join_behavior);
			}
		}
		$this->lastPricPatioLineaCriteria = $criteria;

		return $this->collPricPatioLineas;
	}

	
	public function clearReportes()
	{
		$this->collReportes = null; 	}

	
	public function initReportes()
	{
		$this->collReportes = array();
	}

	
	public function getReportes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				ReportePeer::addSelectColumns($criteria);
				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$this->collReportes = ReportePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastReporteCriteria = $criteria;
		return $this->collReportes;
	}

	
	public function countReportes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$count = ReportePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
					$count = ReportePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collReportes);
				}
			} else {
				$count = count($this->collReportes);
			}
		}
		return $count;
	}

	
	public function addReporte(Reporte $l)
	{
		if ($this->collReportes === null) {
			$this->initReportes();
		}
		if (!in_array($l, $this->collReportes, true)) { 			array_push($this->collReportes, $l);
			$l->setTransportador($this);
		}
	}


	
	public function getReportesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinBodega($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinTrackingEtapa($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collReportes = ReportePeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	
	public function clearCotProductos()
	{
		$this->collCotProductos = null; 	}

	
	public function initCotProductos()
	{
		$this->collCotProductos = array();
	}

	
	public function getCotProductos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
			   $this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				CotProductoPeer::addSelectColumns($criteria);
				$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				CotProductoPeer::addSelectColumns($criteria);
				if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
					$this->collCotProductos = CotProductoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCotProductoCriteria = $criteria;
		return $this->collCotProductos;
	}

	
	public function countCotProductos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = CotProductoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
					$count = CotProductoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collCotProductos);
				}
			} else {
				$count = count($this->collCotProductos);
			}
		}
		return $count;
	}

	
	public function addCotProducto(CotProducto $l)
	{
		if ($this->collCotProductos === null) {
			$this->initCotProductos();
		}
		if (!in_array($l, $this->collCotProductos, true)) { 			array_push($this->collCotProductos, $l);
			$l->setTransportador($this);
		}
	}


	
	public function getCotProductosJoinCotizacion($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collCotProductos = CotProductoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
				$this->collCotProductos = CotProductoPeer::doSelectJoinCotizacion($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotProductoCriteria = $criteria;

		return $this->collCotProductos;
	}


	
	public function getCotProductosJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCotProductos === null) {
			if ($this->isNew()) {
				$this->collCotProductos = array();
			} else {

				$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

				$this->collCotProductos = CotProductoPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(CotProductoPeer::CA_IDLINEA, $this->ca_idlinea);

			if (!isset($this->lastCotProductoCriteria) || !$this->lastCotProductoCriteria->equals($criteria)) {
				$this->collCotProductos = CotProductoPeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastCotProductoCriteria = $criteria;

		return $this->collCotProductos;
	}

	
	public function clearInoMaestraSeas()
	{
		$this->collInoMaestraSeas = null; 	}

	
	public function initInoMaestraSeas()
	{
		$this->collInoMaestraSeas = array();
	}

	
	public function getInoMaestraSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoMaestraSeas === null) {
			if ($this->isNew()) {
			   $this->collInoMaestraSeas = array();
			} else {

				$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->ca_idlinea);

				InoMaestraSeaPeer::addSelectColumns($criteria);
				$this->collInoMaestraSeas = InoMaestraSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->ca_idlinea);

				InoMaestraSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoMaestraSeaCriteria) || !$this->lastInoMaestraSeaCriteria->equals($criteria)) {
					$this->collInoMaestraSeas = InoMaestraSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoMaestraSeaCriteria = $criteria;
		return $this->collInoMaestraSeas;
	}

	
	public function countInoMaestraSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoMaestraSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = InoMaestraSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoMaestraSeaPeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastInoMaestraSeaCriteria) || !$this->lastInoMaestraSeaCriteria->equals($criteria)) {
					$count = InoMaestraSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoMaestraSeas);
				}
			} else {
				$count = count($this->collInoMaestraSeas);
			}
		}
		return $count;
	}

	
	public function addInoMaestraSea(InoMaestraSea $l)
	{
		if ($this->collInoMaestraSeas === null) {
			$this->initInoMaestraSeas();
		}
		if (!in_array($l, $this->collInoMaestraSeas, true)) { 			array_push($this->collInoMaestraSeas, $l);
			$l->setTransportador($this);
		}
	}

	
	public function clearInoMaestraAirs()
	{
		$this->collInoMaestraAirs = null; 	}

	
	public function initInoMaestraAirs()
	{
		$this->collInoMaestraAirs = array();
	}

	
	public function getInoMaestraAirs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoMaestraAirs === null) {
			if ($this->isNew()) {
			   $this->collInoMaestraAirs = array();
			} else {

				$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->ca_idlinea);

				InoMaestraAirPeer::addSelectColumns($criteria);
				$this->collInoMaestraAirs = InoMaestraAirPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->ca_idlinea);

				InoMaestraAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoMaestraAirCriteria) || !$this->lastInoMaestraAirCriteria->equals($criteria)) {
					$this->collInoMaestraAirs = InoMaestraAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoMaestraAirCriteria = $criteria;
		return $this->collInoMaestraAirs;
	}

	
	public function countInoMaestraAirs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportadorPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoMaestraAirs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->ca_idlinea);

				$count = InoMaestraAirPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoMaestraAirPeer::CA_IDLINEA, $this->ca_idlinea);

				if (!isset($this->lastInoMaestraAirCriteria) || !$this->lastInoMaestraAirCriteria->equals($criteria)) {
					$count = InoMaestraAirPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoMaestraAirs);
				}
			} else {
				$count = count($this->collInoMaestraAirs);
			}
		}
		return $count;
	}

	
	public function addInoMaestraAir(InoMaestraAir $l)
	{
		if ($this->collInoMaestraAirs === null) {
			$this->initInoMaestraAirs();
		}
		if (!in_array($l, $this->collInoMaestraAirs, true)) { 			array_push($this->collInoMaestraAirs, $l);
			$l->setTransportador($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collTrayectos) {
				foreach ((array) $this->collTrayectos as $o) {
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
			if ($this->collPricRecargoParametros) {
				foreach ((array) $this->collPricRecargoParametros as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPricPatioLineas) {
				foreach ((array) $this->collPricPatioLineas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collReportes) {
				foreach ((array) $this->collReportes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCotProductos) {
				foreach ((array) $this->collCotProductos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoMaestraSeas) {
				foreach ((array) $this->collInoMaestraSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoMaestraAirs) {
				foreach ((array) $this->collInoMaestraAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collTrayectos = null;
		$this->collPricRecargosxLineas = null;
		$this->collPricRecargosxLineaLogs = null;
		$this->collPricRecargoParametros = null;
		$this->collPricPatioLineas = null;
		$this->collReportes = null;
		$this->collCotProductos = null;
		$this->collInoMaestraSeas = null;
		$this->collInoMaestraAirs = null;
			$this->aIdsProveedor = null;
			$this->aTransportista = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTransportador:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTransportador::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 