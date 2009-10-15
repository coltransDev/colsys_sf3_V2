<?php


abstract class BaseAgente extends BaseObject  implements Persistent {


  const PEER = 'AgentePeer';

	
	protected static $peer;

	
	protected $ca_idagente;

	
	protected $ca_nombre;

	
	protected $ca_direccion;

	
	protected $ca_telefonos;

	
	protected $ca_fax;

	
	protected $ca_idciudad;

	
	protected $ca_zipcode;

	
	protected $ca_website;

	
	protected $ca_email;

	
	protected $ca_tipo;

	
	protected $ca_activo;

	
	protected $aCiudad;

	
	protected $collTrayectos;

	
	private $lastTrayectoCriteria = null;

	
	protected $collContactoAgentes;

	
	private $lastContactoAgenteCriteria = null;

	
	protected $collReportes;

	
	private $lastReporteCriteria = null;

	
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

	
	public function getCaIdagente()
	{
		return $this->ca_idagente;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
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

	
	public function getCaZipcode()
	{
		return $this->ca_zipcode;
	}

	
	public function getCaWebsite()
	{
		return $this->ca_website;
	}

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaActivo()
	{
		return $this->ca_activo;
	}

	
	public function setCaIdagente($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idagente !== $v) {
			$this->ca_idagente = $v;
			$this->modifiedColumns[] = AgentePeer::CA_IDAGENTE;
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
			$this->modifiedColumns[] = AgentePeer::CA_NOMBRE;
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
			$this->modifiedColumns[] = AgentePeer::CA_DIRECCION;
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
			$this->modifiedColumns[] = AgentePeer::CA_TELEFONOS;
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
			$this->modifiedColumns[] = AgentePeer::CA_FAX;
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
			$this->modifiedColumns[] = AgentePeer::CA_IDCIUDAD;
		}

		if ($this->aCiudad !== null && $this->aCiudad->getCaIdciudad() !== $v) {
			$this->aCiudad = null;
		}

		return $this;
	} 
	
	public function setCaZipcode($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_zipcode !== $v) {
			$this->ca_zipcode = $v;
			$this->modifiedColumns[] = AgentePeer::CA_ZIPCODE;
		}

		return $this;
	} 
	
	public function setCaWebsite($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_website !== $v) {
			$this->ca_website = $v;
			$this->modifiedColumns[] = AgentePeer::CA_WEBSITE;
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
			$this->modifiedColumns[] = AgentePeer::CA_EMAIL;
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
			$this->modifiedColumns[] = AgentePeer::CA_TIPO;
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
			$this->modifiedColumns[] = AgentePeer::CA_ACTIVO;
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

			$this->ca_idagente = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_direccion = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_telefonos = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_fax = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_idciudad = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_zipcode = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_website = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_email = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_tipo = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_activo = ($row[$startcol + 10] !== null) ? (boolean) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 11; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Agente object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aCiudad !== null && $this->ca_idciudad !== $this->aCiudad->getCaIdciudad()) {
			$this->aCiudad = null;
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
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = AgentePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aCiudad = null;
			$this->collTrayectos = null;
			$this->lastTrayectoCriteria = null;

			$this->collContactoAgentes = null;
			$this->lastContactoAgenteCriteria = null;

			$this->collReportes = null;
			$this->lastReporteCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAgente:delete:pre') as $callable)
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
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			AgentePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseAgente:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseAgente:save:pre') as $callable)
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
			$con = Propel::getConnection(AgentePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseAgente:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			AgentePeer::addInstanceToPool($this);
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

			if ($this->isNew() ) {
				$this->modifiedColumns[] = AgentePeer::CA_IDAGENTE;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = AgentePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdagente($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += AgentePeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collTrayectos !== null) {
				foreach ($this->collTrayectos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collContactoAgentes !== null) {
				foreach ($this->collContactoAgentes as $referrerFK) {
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


			if (($retval = AgentePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTrayectos !== null) {
					foreach ($this->collTrayectos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collContactoAgentes !== null) {
					foreach ($this->collContactoAgentes as $referrerFK) {
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


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdagente();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaDireccion();
				break;
			case 3:
				return $this->getCaTelefonos();
				break;
			case 4:
				return $this->getCaFax();
				break;
			case 5:
				return $this->getCaIdciudad();
				break;
			case 6:
				return $this->getCaZipcode();
				break;
			case 7:
				return $this->getCaWebsite();
				break;
			case 8:
				return $this->getCaEmail();
				break;
			case 9:
				return $this->getCaTipo();
				break;
			case 10:
				return $this->getCaActivo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = AgentePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdagente(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaDireccion(),
			$keys[3] => $this->getCaTelefonos(),
			$keys[4] => $this->getCaFax(),
			$keys[5] => $this->getCaIdciudad(),
			$keys[6] => $this->getCaZipcode(),
			$keys[7] => $this->getCaWebsite(),
			$keys[8] => $this->getCaEmail(),
			$keys[9] => $this->getCaTipo(),
			$keys[10] => $this->getCaActivo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = AgentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdagente($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaDireccion($value);
				break;
			case 3:
				$this->setCaTelefonos($value);
				break;
			case 4:
				$this->setCaFax($value);
				break;
			case 5:
				$this->setCaIdciudad($value);
				break;
			case 6:
				$this->setCaZipcode($value);
				break;
			case 7:
				$this->setCaWebsite($value);
				break;
			case 8:
				$this->setCaEmail($value);
				break;
			case 9:
				$this->setCaTipo($value);
				break;
			case 10:
				$this->setCaActivo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = AgentePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdagente($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaDireccion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaTelefonos($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaFax($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaIdciudad($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaZipcode($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaWebsite($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaEmail($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaTipo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaActivo($arr[$keys[10]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(AgentePeer::DATABASE_NAME);

		if ($this->isColumnModified(AgentePeer::CA_IDAGENTE)) $criteria->add(AgentePeer::CA_IDAGENTE, $this->ca_idagente);
		if ($this->isColumnModified(AgentePeer::CA_NOMBRE)) $criteria->add(AgentePeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(AgentePeer::CA_DIRECCION)) $criteria->add(AgentePeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(AgentePeer::CA_TELEFONOS)) $criteria->add(AgentePeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(AgentePeer::CA_FAX)) $criteria->add(AgentePeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(AgentePeer::CA_IDCIUDAD)) $criteria->add(AgentePeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(AgentePeer::CA_ZIPCODE)) $criteria->add(AgentePeer::CA_ZIPCODE, $this->ca_zipcode);
		if ($this->isColumnModified(AgentePeer::CA_WEBSITE)) $criteria->add(AgentePeer::CA_WEBSITE, $this->ca_website);
		if ($this->isColumnModified(AgentePeer::CA_EMAIL)) $criteria->add(AgentePeer::CA_EMAIL, $this->ca_email);
		if ($this->isColumnModified(AgentePeer::CA_TIPO)) $criteria->add(AgentePeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(AgentePeer::CA_ACTIVO)) $criteria->add(AgentePeer::CA_ACTIVO, $this->ca_activo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(AgentePeer::DATABASE_NAME);

		$criteria->add(AgentePeer::CA_IDAGENTE, $this->ca_idagente);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdagente();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdagente($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaZipcode($this->ca_zipcode);

		$copyObj->setCaWebsite($this->ca_website);

		$copyObj->setCaEmail($this->ca_email);

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaActivo($this->ca_activo);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getTrayectos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addTrayecto($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getContactoAgentes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addContactoAgente($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getReportes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addReporte($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdagente(NULL); 
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
			self::$peer = new AgentePeer();
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
			$v->addAgente($this);
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
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrayectos === null) {
			if ($this->isNew()) {
			   $this->collTrayectos = array();
			} else {

				$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->ca_idagente);

				TrayectoPeer::addSelectColumns($criteria);
				$this->collTrayectos = TrayectoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->ca_idagente);

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
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
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

				$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->ca_idagente);

				$count = TrayectoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->ca_idagente);

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
			$l->setAgente($this);
		}
	}


	
	public function getTrayectosJoinTransportador($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTrayectos === null) {
			if ($this->isNew()) {
				$this->collTrayectos = array();
			} else {

				$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->ca_idagente);

				$this->collTrayectos = TrayectoPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(TrayectoPeer::CA_IDAGENTE, $this->ca_idagente);

			if (!isset($this->lastTrayectoCriteria) || !$this->lastTrayectoCriteria->equals($criteria)) {
				$this->collTrayectos = TrayectoPeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastTrayectoCriteria = $criteria;

		return $this->collTrayectos;
	}

	
	public function clearContactoAgentes()
	{
		$this->collContactoAgentes = null; 	}

	
	public function initContactoAgentes()
	{
		$this->collContactoAgentes = array();
	}

	
	public function getContactoAgentes($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
			   $this->collContactoAgentes = array();
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->ca_idagente);

				ContactoAgentePeer::addSelectColumns($criteria);
				$this->collContactoAgentes = ContactoAgentePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->ca_idagente);

				ContactoAgentePeer::addSelectColumns($criteria);
				if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
					$this->collContactoAgentes = ContactoAgentePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastContactoAgenteCriteria = $criteria;
		return $this->collContactoAgentes;
	}

	
	public function countContactoAgentes(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->ca_idagente);

				$count = ContactoAgentePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->ca_idagente);

				if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
					$count = ContactoAgentePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collContactoAgentes);
				}
			} else {
				$count = count($this->collContactoAgentes);
			}
		}
		return $count;
	}

	
	public function addContactoAgente(ContactoAgente $l)
	{
		if ($this->collContactoAgentes === null) {
			$this->initContactoAgentes();
		}
		if (!in_array($l, $this->collContactoAgentes, true)) { 			array_push($this->collContactoAgentes, $l);
			$l->setAgente($this);
		}
	}


	
	public function getContactoAgentesJoinCiudad($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContactoAgentes === null) {
			if ($this->isNew()) {
				$this->collContactoAgentes = array();
			} else {

				$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->ca_idagente);

				$this->collContactoAgentes = ContactoAgentePeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ContactoAgentePeer::CA_IDAGENTE, $this->ca_idagente);

			if (!isset($this->lastContactoAgenteCriteria) || !$this->lastContactoAgenteCriteria->equals($criteria)) {
				$this->collContactoAgentes = ContactoAgentePeer::doSelectJoinCiudad($criteria, $con, $join_behavior);
			}
		}
		$this->lastContactoAgenteCriteria = $criteria;

		return $this->collContactoAgentes;
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
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

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
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
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

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

				$count = ReportePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

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
			$l->setAgente($this);
		}
	}


	
	public function getReportesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

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
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinTercero($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinBodega($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

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
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

				$this->collReportes = ReportePeer::doSelectJoinTrackingEtapa($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

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
			$criteria = new Criteria(AgentePeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

				$this->collReportes = ReportePeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDAGENTE, $this->ca_idagente);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collTrayectos) {
				foreach ((array) $this->collTrayectos as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collContactoAgentes) {
				foreach ((array) $this->collContactoAgentes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collReportes) {
				foreach ((array) $this->collReportes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collTrayectos = null;
		$this->collContactoAgentes = null;
		$this->collReportes = null;
			$this->aCiudad = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseAgente:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseAgente::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 