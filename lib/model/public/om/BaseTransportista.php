<?php


abstract class BaseTransportista extends BaseObject  implements Persistent {


  const PEER = 'TransportistaPeer';

	
	protected static $peer;

	
	protected $ca_idtransportista;

	
	protected $ca_digito;

	
	protected $ca_nombre;

	
	protected $ca_direccion;

	
	protected $ca_telefonos;

	
	protected $ca_fax;

	
	protected $ca_idciudad;

	
	protected $ca_website;

	
	protected $ca_email;

	
	protected $collTransportadors;

	
	private $lastTransportadorCriteria = null;

	
	protected $collTransContactos;

	
	private $lastTransContactoCriteria = null;

	
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

	
	public function getCaIdtransportista()
	{
		return $this->ca_idtransportista;
	}

	
	public function getCaDigito()
	{
		return $this->ca_digito;
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

	
	public function getCaWebsite()
	{
		return $this->ca_website;
	}

	
	public function getCaEmail()
	{
		return $this->ca_email;
	}

	
	public function setCaIdtransportista($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtransportista !== $v) {
			$this->ca_idtransportista = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_IDTRANSPORTISTA;
		}

		return $this;
	} 
	
	public function setCaDigito($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_digito !== $v) {
			$this->ca_digito = $v;
			$this->modifiedColumns[] = TransportistaPeer::CA_DIGITO;
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
			$this->modifiedColumns[] = TransportistaPeer::CA_NOMBRE;
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
			$this->modifiedColumns[] = TransportistaPeer::CA_DIRECCION;
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
			$this->modifiedColumns[] = TransportistaPeer::CA_TELEFONOS;
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
			$this->modifiedColumns[] = TransportistaPeer::CA_FAX;
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
			$this->modifiedColumns[] = TransportistaPeer::CA_IDCIUDAD;
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
			$this->modifiedColumns[] = TransportistaPeer::CA_WEBSITE;
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
			$this->modifiedColumns[] = TransportistaPeer::CA_EMAIL;
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

			$this->ca_idtransportista = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_digito = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_direccion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_telefonos = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fax = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_idciudad = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_website = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_email = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Transportista object", $e);
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
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TransportistaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collTransportadors = null;
			$this->lastTransportadorCriteria = null;

			$this->collTransContactos = null;
			$this->lastTransContactoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransportista:delete:pre') as $callable)
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
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TransportistaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTransportista:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTransportista:save:pre') as $callable)
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
			$con = Propel::getConnection(TransportistaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTransportista:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TransportistaPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = TransportistaPeer::CA_IDTRANSPORTISTA;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TransportistaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdtransportista($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TransportistaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collTransportadors !== null) {
				foreach ($this->collTransportadors as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTransContactos !== null) {
				foreach ($this->collTransContactos as $referrerFK) {
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


			if (($retval = TransportistaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTransportadors !== null) {
					foreach ($this->collTransportadors as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTransContactos !== null) {
					foreach ($this->collTransContactos as $referrerFK) {
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
		$pos = TransportistaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdtransportista();
				break;
			case 1:
				return $this->getCaDigito();
				break;
			case 2:
				return $this->getCaNombre();
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
				return $this->getCaWebsite();
				break;
			case 8:
				return $this->getCaEmail();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TransportistaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtransportista(),
			$keys[1] => $this->getCaDigito(),
			$keys[2] => $this->getCaNombre(),
			$keys[3] => $this->getCaDireccion(),
			$keys[4] => $this->getCaTelefonos(),
			$keys[5] => $this->getCaFax(),
			$keys[6] => $this->getCaIdciudad(),
			$keys[7] => $this->getCaWebsite(),
			$keys[8] => $this->getCaEmail(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TransportistaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdtransportista($value);
				break;
			case 1:
				$this->setCaDigito($value);
				break;
			case 2:
				$this->setCaNombre($value);
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
				$this->setCaWebsite($value);
				break;
			case 8:
				$this->setCaEmail($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TransportistaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtransportista($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaDigito($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDireccion($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTelefonos($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFax($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaIdciudad($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaWebsite($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaEmail($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);

		if ($this->isColumnModified(TransportistaPeer::CA_IDTRANSPORTISTA)) $criteria->add(TransportistaPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);
		if ($this->isColumnModified(TransportistaPeer::CA_DIGITO)) $criteria->add(TransportistaPeer::CA_DIGITO, $this->ca_digito);
		if ($this->isColumnModified(TransportistaPeer::CA_NOMBRE)) $criteria->add(TransportistaPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(TransportistaPeer::CA_DIRECCION)) $criteria->add(TransportistaPeer::CA_DIRECCION, $this->ca_direccion);
		if ($this->isColumnModified(TransportistaPeer::CA_TELEFONOS)) $criteria->add(TransportistaPeer::CA_TELEFONOS, $this->ca_telefonos);
		if ($this->isColumnModified(TransportistaPeer::CA_FAX)) $criteria->add(TransportistaPeer::CA_FAX, $this->ca_fax);
		if ($this->isColumnModified(TransportistaPeer::CA_IDCIUDAD)) $criteria->add(TransportistaPeer::CA_IDCIUDAD, $this->ca_idciudad);
		if ($this->isColumnModified(TransportistaPeer::CA_WEBSITE)) $criteria->add(TransportistaPeer::CA_WEBSITE, $this->ca_website);
		if ($this->isColumnModified(TransportistaPeer::CA_EMAIL)) $criteria->add(TransportistaPeer::CA_EMAIL, $this->ca_email);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);

		$criteria->add(TransportistaPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdtransportista();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdtransportista($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaDigito($this->ca_digito);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaDireccion($this->ca_direccion);

		$copyObj->setCaTelefonos($this->ca_telefonos);

		$copyObj->setCaFax($this->ca_fax);

		$copyObj->setCaIdciudad($this->ca_idciudad);

		$copyObj->setCaWebsite($this->ca_website);

		$copyObj->setCaEmail($this->ca_email);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getTransportadors() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addTransportador($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getTransContactos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addTransContacto($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdtransportista(NULL); 
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
			self::$peer = new TransportistaPeer();
		}
		return self::$peer;
	}

	
	public function clearTransportadors()
	{
		$this->collTransportadors = null; 	}

	
	public function initTransportadors()
	{
		$this->collTransportadors = array();
	}

	
	public function getTransportadors($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTransportadors === null) {
			if ($this->isNew()) {
			   $this->collTransportadors = array();
			} else {

				$criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				TransportadorPeer::addSelectColumns($criteria);
				$this->collTransportadors = TransportadorPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				TransportadorPeer::addSelectColumns($criteria);
				if (!isset($this->lastTransportadorCriteria) || !$this->lastTransportadorCriteria->equals($criteria)) {
					$this->collTransportadors = TransportadorPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTransportadorCriteria = $criteria;
		return $this->collTransportadors;
	}

	
	public function countTransportadors(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTransportadors === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				$count = TransportadorPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				if (!isset($this->lastTransportadorCriteria) || !$this->lastTransportadorCriteria->equals($criteria)) {
					$count = TransportadorPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collTransportadors);
				}
			} else {
				$count = count($this->collTransportadors);
			}
		}
		return $count;
	}

	
	public function addTransportador(Transportador $l)
	{
		if ($this->collTransportadors === null) {
			$this->initTransportadors();
		}
		if (!in_array($l, $this->collTransportadors, true)) { 			array_push($this->collTransportadors, $l);
			$l->setTransportista($this);
		}
	}


	
	public function getTransportadorsJoinIdsProveedor($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTransportadors === null) {
			if ($this->isNew()) {
				$this->collTransportadors = array();
			} else {

				$criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				$this->collTransportadors = TransportadorPeer::doSelectJoinIdsProveedor($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(TransportadorPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

			if (!isset($this->lastTransportadorCriteria) || !$this->lastTransportadorCriteria->equals($criteria)) {
				$this->collTransportadors = TransportadorPeer::doSelectJoinIdsProveedor($criteria, $con, $join_behavior);
			}
		}
		$this->lastTransportadorCriteria = $criteria;

		return $this->collTransportadors;
	}

	
	public function clearTransContactos()
	{
		$this->collTransContactos = null; 	}

	
	public function initTransContactos()
	{
		$this->collTransContactos = array();
	}

	
	public function getTransContactos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTransContactos === null) {
			if ($this->isNew()) {
			   $this->collTransContactos = array();
			} else {

				$criteria->add(TransContactoPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				TransContactoPeer::addSelectColumns($criteria);
				$this->collTransContactos = TransContactoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TransContactoPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				TransContactoPeer::addSelectColumns($criteria);
				if (!isset($this->lastTransContactoCriteria) || !$this->lastTransContactoCriteria->equals($criteria)) {
					$this->collTransContactos = TransContactoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTransContactoCriteria = $criteria;
		return $this->collTransContactos;
	}

	
	public function countTransContactos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TransportistaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collTransContactos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(TransContactoPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				$count = TransContactoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TransContactoPeer::CA_IDTRANSPORTISTA, $this->ca_idtransportista);

				if (!isset($this->lastTransContactoCriteria) || !$this->lastTransContactoCriteria->equals($criteria)) {
					$count = TransContactoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collTransContactos);
				}
			} else {
				$count = count($this->collTransContactos);
			}
		}
		return $count;
	}

	
	public function addTransContacto(TransContacto $l)
	{
		if ($this->collTransContactos === null) {
			$this->initTransContactos();
		}
		if (!in_array($l, $this->collTransContactos, true)) { 			array_push($this->collTransContactos, $l);
			$l->setTransportista($this);
		}
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collTransportadors) {
				foreach ((array) $this->collTransportadors as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTransContactos) {
				foreach ((array) $this->collTransContactos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collTransportadors = null;
		$this->collTransContactos = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTransportista:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTransportista::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 