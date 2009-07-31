<?php


abstract class BaseTercero extends BaseObject  implements Persistent {


  const PEER = 'TerceroPeer';

	
	protected static $peer;

	
	protected $ca_idtercero;

	
	protected $ca_nombre;

	
	protected $ca_contacto;

	
	protected $ca_direccion;

	
	protected $ca_telefonos;

	
	protected $ca_fax;

	
	protected $ca_idciudad;

	
	protected $ca_email;

	
	protected $ca_vendedor;

	
	protected $ca_tipo;

	
	protected $ca_identificacion;

	
	protected $collReportes;

	
	private $lastReporteCriteria = null;

	
	protected $collInoClientesSeas;

	
	private $lastInoClientesSeaCriteria = null;

	
	protected $collInoClientesAirs;

	
	private $lastInoClientesAirCriteria = null;

	
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

	
	public function getCaIdtercero()
	{
		return $this->ca_idtercero;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaContacto()
	{
		return $this->ca_contacto;
	}

	
	public function getCaDireccion()
	{
		return $this->ca_direccion;
	}

	
	public function getCaTelefonos()
	{
		return $this->ca_telefonos;
	}

	
	public function getCaFax()
	{
		return $this->ca_fax;
	}

	
	public function getCaIdciudad()
	{
		return $this->ca_idciudad;
	}

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function getCaVendedor()
	{
		return $this->ca_vendedor;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaIdentificacion()
	{
		return $this->ca_identificacion;
	}

	
	public function setCaIdtercero($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtercero !== $v) {
			$this->ca_idtercero = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_IDTERCERO;
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
			$this->modifiedColumns[] = TerceroPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaContacto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_contacto !== $v) {
			$this->ca_contacto = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_CONTACTO;
		}

		return $this;
	} 
	
	public function setCaDireccion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_direccion !== $v) {
			$this->ca_direccion = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_DIRECCION;
		}

		return $this;
	} 
	
	public function setCaTelefonos($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_telefonos !== $v) {
			$this->ca_telefonos = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_TELEFONOS;
		}

		return $this;
	} 
	
	public function setCaFax($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_fax !== $v) {
			$this->ca_fax = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_FAX;
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
			$this->modifiedColumns[] = TerceroPeer::CA_IDCIUDAD;
		}

		return $this;
	} 
	
	public function setCaEmail($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_email !== $v) {
			$this->ca_email = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_EMAIL;
		}

		return $this;
	} 
	
	public function setCaVendedor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vendedor !== $v) {
			$this->ca_vendedor = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_VENDEDOR;
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
			$this->modifiedColumns[] = TerceroPeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaIdentificacion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_identificacion !== $v) {
			$this->ca_identificacion = $v;
			$this->modifiedColumns[] = TerceroPeer::CA_IDENTIFICACION;
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

			$this->ca_idtercero = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_contacto = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_direccion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_telefonos = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fax = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_idciudad = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_email = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_vendedor = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_tipo = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_identificacion = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Tercero object", $e);
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
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TerceroPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collReportes = null;
			$this->lastReporteCriteria = null;

			$this->collInoClientesSeas = null;
			$this->lastInoClientesSeaCriteria = null;

			$this->collInoClientesAirs = null;
			$this->lastInoClientesAirCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTercero:delete:pre') as $callable)
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
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TerceroPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTercero:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTercero:save:pre') as $callable)
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
			$con = Propel::getConnection(TerceroPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTercero:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TerceroPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = TerceroPeer::CA_IDTERCERO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TerceroPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdtercero($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TerceroPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collReportes !== null) {
				foreach ($this->collReportes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoClientesSeas !== null) {
				foreach ($this->collInoClientesSeas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInoClientesAirs !== null) {
				foreach ($this->collInoClientesAirs as $referrerFK) {
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


			if (($retval = TerceroPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collReportes !== null) {
					foreach ($this->collReportes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoClientesSeas !== null) {
					foreach ($this->collInoClientesSeas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInoClientesAirs !== null) {
					foreach ($this->collInoClientesAirs as $referrerFK) {
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
		$pos = TerceroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdtercero();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaContacto();
				break;
			case 3:
				return $this->getCaDireccion();
				break;
			case 4:
				return $this->getCaTelefonos();
				break;
			case 5:
				return $this->getCaFax();
				break;
			case 6:
				return $this->getCaIdciudad();
				break;
			case 7:
				return $this->getCaEmail();
				break;
			case 8:
				return $this->getCaVendedor();
				break;
			case 9:
				return $this->getCaTipo();
				break;
			case 10:
				return $this->getCaIdentificacion();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TerceroPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtercero(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaContacto(),
			$keys[3] => $this->getCaDireccion(),
			$keys[4] => $this->getCaTelefonos(),
			$keys[5] => $this->getCaFax(),
			$keys[6] => $this->getCaIdciudad(),
			$keys[7] => $this->getCaEmail(),
			$keys[8] => $this->getCaVendedor(),
			$keys[9] => $this->getCaTipo(),
			$keys[10] => $this->getCaIdentificacion(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TerceroPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdtercero($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaContacto($value);
				break;
			case 3:
				$this->setCaDireccion($value);
				break;
			case 4:
				$this->setCaTelefonos($value);
				break;
			case 5:
				$this->setCaFax($value);
				break;
			case 6:
				$this->setCaIdciudad($value);
				break;
			case 7:
				$this->setCaEmail($value);
				break;
			case 8:
				$this->setCaVendedor($value);
				break;
			case 9:
				$this->setCaTipo($value);
				break;
			case 10:
				$this->setCaIdentificacion($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TerceroPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtercero($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaContacto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDireccion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTelefonos($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFax($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdciudad($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaEmail($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaVendedor($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaTipo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaIdentificacion($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TerceroPeer::DATABASE_NAME);

		if ($this->isColumnModified(TerceroPeer::CA_IDTERCERO)) $criteria->add(TerceroPeer::CA_IDTERCERO, $this->ca_idtercero);
		if ($this->isColumnModified(TerceroPeer::CA_NOMBRE)) $criteria->add(TerceroPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TerceroPeer::CA_CONTACTO)) $criteria->add(TerceroPeer::CA_CONTACTO, $this->ca_contacto);
		if ($this->isColumnModified(TerceroPeer::CA_DIRECCION)) $criteria->add(TerceroPeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(TerceroPeer::CA_TELEFONOS)) $criteria->add(TerceroPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(TerceroPeer::CA_FAX)) $criteria->add(TerceroPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(TerceroPeer::CA_IDCIUDAD)) $criteria->add(TerceroPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(TerceroPeer::CA_EMAIL)) $criteria->add(TerceroPeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(TerceroPeer::CA_VENDEDOR)) $criteria->add(TerceroPeer::CA_VENDEDOR, $this->ca_vendedor);
		if ($this->isColumnModified(TerceroPeer::CA_TIPO)) $criteria->add(TerceroPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(TerceroPeer::CA_IDENTIFICACION)) $criteria->add(TerceroPeer::CA_IDENTIFICACION, $this->ca_identificacion);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TerceroPeer::DATABASE_NAME);

		$criteria->add(TerceroPeer::CA_IDTERCERO, $this->ca_idtercero);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdtercero();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdtercero($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaContacto($this->ca_contacto);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaVendedor($this->ca_vendedor);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaIdentificacion($this->ca_identificacion);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getReportes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addReporte($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoClientesSeas() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoClientesSea($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getInoClientesAirs() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addInoClientesAir($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdtercero(NULL); 
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
			self::$peer = new TerceroPeer();
		}
		return self::$peer;
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
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

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
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
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

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$count = ReportePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

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
			$l->setTercero($this);
		}
	}


	
	public function getReportesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinAgente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

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
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

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
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

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
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collReportes = ReportePeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDPROVEEDOR, $this->ca_idtercero);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	
	public function clearInoClientesSeas()
	{
		$this->collInoClientesSeas = null; 	}

	
	public function initInoClientesSeas()
	{
		$this->collInoClientesSeas = array();
	}

	
	public function getInoClientesSeas($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
			   $this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				InoClientesSeaPeer::addSelectColumns($criteria);
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				InoClientesSeaPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$this->collInoClientesSeas = InoClientesSeaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;
		return $this->collInoClientesSeas;
	}

	
	public function countInoClientesSeas(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$count = InoClientesSeaPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
					$count = InoClientesSeaPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoClientesSeas);
				}
			} else {
				$count = count($this->collInoClientesSeas);
			}
		}
		return $count;
	}

	
	public function addInoClientesSea(InoClientesSea $l)
	{
		if ($this->collInoClientesSeas === null) {
			$this->initInoClientesSeas();
		}
		if (!in_array($l, $this->collInoClientesSeas, true)) { 			array_push($this->collInoClientesSeas, $l);
			$l->setTercero($this);
		}
	}


	
	public function getInoClientesSeasJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	
	public function getInoClientesSeasJoinCliente($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinCliente($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}


	
	public function getInoClientesSeasJoinInoMaestraSea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesSeas === null) {
			if ($this->isNew()) {
				$this->collInoClientesSeas = array();
			} else {

				$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesSeaPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

			if (!isset($this->lastInoClientesSeaCriteria) || !$this->lastInoClientesSeaCriteria->equals($criteria)) {
				$this->collInoClientesSeas = InoClientesSeaPeer::doSelectJoinInoMaestraSea($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesSeaCriteria = $criteria;

		return $this->collInoClientesSeas;
	}

	
	public function clearInoClientesAirs()
	{
		$this->collInoClientesAirs = null; 	}

	
	public function initInoClientesAirs()
	{
		$this->collInoClientesAirs = array();
	}

	
	public function getInoClientesAirs($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
			   $this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				InoClientesAirPeer::addSelectColumns($criteria);
				$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				InoClientesAirPeer::addSelectColumns($criteria);
				if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
					$this->collInoClientesAirs = InoClientesAirPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;
		return $this->collInoClientesAirs;
	}

	
	public function countInoClientesAirs(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$count = InoClientesAirPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
					$count = InoClientesAirPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collInoClientesAirs);
				}
			} else {
				$count = count($this->collInoClientesAirs);
			}
		}
		return $count;
	}

	
	public function addInoClientesAir(InoClientesAir $l)
	{
		if ($this->collInoClientesAirs === null) {
			$this->initInoClientesAirs();
		}
		if (!in_array($l, $this->collInoClientesAirs, true)) { 			array_push($this->collInoClientesAirs, $l);
			$l->setTercero($this);
		}
	}


	
	public function getInoClientesAirsJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}


	
	public function getInoClientesAirsJoinInoMaestraAir($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TerceroPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInoClientesAirs === null) {
			if ($this->isNew()) {
				$this->collInoClientesAirs = array();
			} else {

				$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinInoMaestraAir($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(InoClientesAirPeer::CA_IDPROVEEDOR, $this->ca_idtercero);

			if (!isset($this->lastInoClientesAirCriteria) || !$this->lastInoClientesAirCriteria->equals($criteria)) {
				$this->collInoClientesAirs = InoClientesAirPeer::doSelectJoinInoMaestraAir($criteria, $con, $join_behavior);
			}
		}
		$this->lastInoClientesAirCriteria = $criteria;

		return $this->collInoClientesAirs;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collReportes) {
				foreach ((array) $this->collReportes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoClientesSeas) {
				foreach ((array) $this->collInoClientesSeas as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collInoClientesAirs) {
				foreach ((array) $this->collInoClientesAirs as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collReportes = null;
		$this->collInoClientesSeas = null;
		$this->collInoClientesAirs = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTercero:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTercero::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 