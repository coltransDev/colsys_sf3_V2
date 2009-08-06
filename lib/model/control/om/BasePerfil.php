<?php


abstract class BasePerfil extends BaseObject  implements Persistent {


  const PEER = 'PerfilPeer';

	
	protected static $peer;

	
	protected $ca_perfil;

	
	protected $ca_nombre;

	
	protected $ca_descripcion;

	
	protected $ca_departamento;

	
	protected $aDepartamento;

	
	protected $collAccesoPerfils;

	
	private $lastAccesoPerfilCriteria = null;

	
	protected $collUsuarioPerfils;

	
	private $lastUsuarioPerfilCriteria = null;

	
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

	
	public function getCaPerfil()
	{
		return $this->ca_perfil;
	}

	
	public function getCaNombre()
	{
		return $this->ca_nombre;
	}

	
	public function getCaDescripcion()
	{
		return $this->ca_descripcion;
	}

	
	public function getCaDepartamento()
	{
		return $this->ca_departamento;
	}

	
	public function setCaPerfil($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_perfil !== $v) {
			$this->ca_perfil = $v;
			$this->modifiedColumns[] = PerfilPeer::CA_PERFIL;
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
			$this->modifiedColumns[] = PerfilPeer::CA_NOMBRE;
		}

		return $this;
	} 
	
	public function setCaDescripcion($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_descripcion !== $v) {
			$this->ca_descripcion = $v;
			$this->modifiedColumns[] = PerfilPeer::CA_DESCRIPCION;
		}

		return $this;
	} 
	
	public function setCaDepartamento($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_departamento !== $v) {
			$this->ca_departamento = $v;
			$this->modifiedColumns[] = PerfilPeer::CA_DEPARTAMENTO;
		}

		if ($this->aDepartamento !== null && $this->aDepartamento->getCaNombre() !== $v) {
			$this->aDepartamento = null;
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

			$this->ca_perfil = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_descripcion = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_departamento = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Perfil object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aDepartamento !== null && $this->ca_departamento !== $this->aDepartamento->getCaNombre()) {
			$this->aDepartamento = null;
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
			$con = Propel::getConnection(PerfilPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = PerfilPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aDepartamento = null;
			$this->collAccesoPerfils = null;
			$this->lastAccesoPerfilCriteria = null;

			$this->collUsuarioPerfils = null;
			$this->lastUsuarioPerfilCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePerfil:delete:pre') as $callable)
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
			$con = Propel::getConnection(PerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			PerfilPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePerfil:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BasePerfil:save:pre') as $callable)
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
			$con = Propel::getConnection(PerfilPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePerfil:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			PerfilPeer::addInstanceToPool($this);
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

												
			if ($this->aDepartamento !== null) {
				if ($this->aDepartamento->isModified() || $this->aDepartamento->isNew()) {
					$affectedRows += $this->aDepartamento->save($con);
				}
				$this->setDepartamento($this->aDepartamento);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PerfilPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += PerfilPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collAccesoPerfils !== null) {
				foreach ($this->collAccesoPerfils as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collUsuarioPerfils !== null) {
				foreach ($this->collUsuarioPerfils as $referrerFK) {
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


												
			if ($this->aDepartamento !== null) {
				if (!$this->aDepartamento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDepartamento->getValidationFailures());
				}
			}


			if (($retval = PerfilPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAccesoPerfils !== null) {
					foreach ($this->collAccesoPerfils as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collUsuarioPerfils !== null) {
					foreach ($this->collUsuarioPerfils as $referrerFK) {
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
		$pos = PerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaPerfil();
				break;
			case 1:
				return $this->getCaNombre();
				break;
			case 2:
				return $this->getCaDescripcion();
				break;
			case 3:
				return $this->getCaDepartamento();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = PerfilPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaPerfil(),
			$keys[1] => $this->getCaNombre(),
			$keys[2] => $this->getCaDescripcion(),
			$keys[3] => $this->getCaDepartamento(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaPerfil($value);
				break;
			case 1:
				$this->setCaNombre($value);
				break;
			case 2:
				$this->setCaDescripcion($value);
				break;
			case 3:
				$this->setCaDepartamento($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PerfilPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaPerfil($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaDescripcion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDepartamento($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PerfilPeer::DATABASE_NAME);

		if ($this->isColumnModified(PerfilPeer::CA_PERFIL)) $criteria->add(PerfilPeer::CA_PERFIL, $this->ca_perfil);
		if ($this->isColumnModified(PerfilPeer::CA_NOMBRE)) $criteria->add(PerfilPeer::CA_NOMBRE, $this->ca_nombre);
		if ($this->isColumnModified(PerfilPeer::CA_DESCRIPCION)) $criteria->add(PerfilPeer::CA_DESCRIPCION, $this->ca_descripcion);
		if ($this->isColumnModified(PerfilPeer::CA_DEPARTAMENTO)) $criteria->add(PerfilPeer::CA_DEPARTAMENTO, $this->ca_departamento);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PerfilPeer::DATABASE_NAME);

		$criteria->add(PerfilPeer::CA_PERFIL, $this->ca_perfil);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaPerfil();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaPerfil($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaPerfil($this->ca_perfil);

		$copyObj->setCaNombre($this->ca_nombre);

		$copyObj->setCaDescripcion($this->ca_descripcion);

		$copyObj->setCaDepartamento($this->ca_departamento);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getAccesoPerfils() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addAccesoPerfil($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getUsuarioPerfils() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addUsuarioPerfil($relObj->copy($deepCopy));
				}
			}

		} 

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
			self::$peer = new PerfilPeer();
		}
		return self::$peer;
	}

	
	public function setDepartamento(Departamento $v = null)
	{
		if ($v === null) {
			$this->setCaDepartamento(NULL);
		} else {
			$this->setCaDepartamento($v->getCaNombre());
		}

		$this->aDepartamento = $v;

						if ($v !== null) {
			$v->addPerfil($this);
		}

		return $this;
	}


	
	public function getDepartamento(PropelPDO $con = null)
	{
		if ($this->aDepartamento === null && (($this->ca_departamento !== "" && $this->ca_departamento !== null))) {
			$c = new Criteria(DepartamentoPeer::DATABASE_NAME);
			$c->add(DepartamentoPeer::CA_NOMBRE, $this->ca_departamento);
			$this->aDepartamento = DepartamentoPeer::doSelectOne($c, $con);
			
		}
		return $this->aDepartamento;
	}

	
	public function clearAccesoPerfils()
	{
		$this->collAccesoPerfils = null; 	}

	
	public function initAccesoPerfils()
	{
		$this->collAccesoPerfils = array();
	}

	
	public function getAccesoPerfils($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PerfilPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAccesoPerfils === null) {
			if ($this->isNew()) {
			   $this->collAccesoPerfils = array();
			} else {

				$criteria->add(AccesoPerfilPeer::CA_PERFIL, $this->ca_perfil);

				AccesoPerfilPeer::addSelectColumns($criteria);
				$this->collAccesoPerfils = AccesoPerfilPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AccesoPerfilPeer::CA_PERFIL, $this->ca_perfil);

				AccesoPerfilPeer::addSelectColumns($criteria);
				if (!isset($this->lastAccesoPerfilCriteria) || !$this->lastAccesoPerfilCriteria->equals($criteria)) {
					$this->collAccesoPerfils = AccesoPerfilPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAccesoPerfilCriteria = $criteria;
		return $this->collAccesoPerfils;
	}

	
	public function countAccesoPerfils(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PerfilPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collAccesoPerfils === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(AccesoPerfilPeer::CA_PERFIL, $this->ca_perfil);

				$count = AccesoPerfilPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AccesoPerfilPeer::CA_PERFIL, $this->ca_perfil);

				if (!isset($this->lastAccesoPerfilCriteria) || !$this->lastAccesoPerfilCriteria->equals($criteria)) {
					$count = AccesoPerfilPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collAccesoPerfils);
				}
			} else {
				$count = count($this->collAccesoPerfils);
			}
		}
		return $count;
	}

	
	public function addAccesoPerfil(AccesoPerfil $l)
	{
		if ($this->collAccesoPerfils === null) {
			$this->initAccesoPerfils();
		}
		if (!in_array($l, $this->collAccesoPerfils, true)) { 			array_push($this->collAccesoPerfils, $l);
			$l->setPerfil($this);
		}
	}

	
	public function clearUsuarioPerfils()
	{
		$this->collUsuarioPerfils = null; 	}

	
	public function initUsuarioPerfils()
	{
		$this->collUsuarioPerfils = array();
	}

	
	public function getUsuarioPerfils($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PerfilPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarioPerfils === null) {
			if ($this->isNew()) {
			   $this->collUsuarioPerfils = array();
			} else {

				$criteria->add(UsuarioPerfilPeer::CA_PERFIL, $this->ca_perfil);

				UsuarioPerfilPeer::addSelectColumns($criteria);
				$this->collUsuarioPerfils = UsuarioPerfilPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioPerfilPeer::CA_PERFIL, $this->ca_perfil);

				UsuarioPerfilPeer::addSelectColumns($criteria);
				if (!isset($this->lastUsuarioPerfilCriteria) || !$this->lastUsuarioPerfilCriteria->equals($criteria)) {
					$this->collUsuarioPerfils = UsuarioPerfilPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUsuarioPerfilCriteria = $criteria;
		return $this->collUsuarioPerfils;
	}

	
	public function countUsuarioPerfils(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PerfilPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collUsuarioPerfils === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(UsuarioPerfilPeer::CA_PERFIL, $this->ca_perfil);

				$count = UsuarioPerfilPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioPerfilPeer::CA_PERFIL, $this->ca_perfil);

				if (!isset($this->lastUsuarioPerfilCriteria) || !$this->lastUsuarioPerfilCriteria->equals($criteria)) {
					$count = UsuarioPerfilPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collUsuarioPerfils);
				}
			} else {
				$count = count($this->collUsuarioPerfils);
			}
		}
		return $count;
	}

	
	public function addUsuarioPerfil(UsuarioPerfil $l)
	{
		if ($this->collUsuarioPerfils === null) {
			$this->initUsuarioPerfils();
		}
		if (!in_array($l, $this->collUsuarioPerfils, true)) { 			array_push($this->collUsuarioPerfils, $l);
			$l->setPerfil($this);
		}
	}


	
	public function getUsuarioPerfilsJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(PerfilPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarioPerfils === null) {
			if ($this->isNew()) {
				$this->collUsuarioPerfils = array();
			} else {

				$criteria->add(UsuarioPerfilPeer::CA_PERFIL, $this->ca_perfil);

				$this->collUsuarioPerfils = UsuarioPerfilPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(UsuarioPerfilPeer::CA_PERFIL, $this->ca_perfil);

			if (!isset($this->lastUsuarioPerfilCriteria) || !$this->lastUsuarioPerfilCriteria->equals($criteria)) {
				$this->collUsuarioPerfils = UsuarioPerfilPeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastUsuarioPerfilCriteria = $criteria;

		return $this->collUsuarioPerfils;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collAccesoPerfils) {
				foreach ((array) $this->collAccesoPerfils as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collUsuarioPerfils) {
				foreach ((array) $this->collUsuarioPerfils as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collAccesoPerfils = null;
		$this->collUsuarioPerfils = null;
			$this->aDepartamento = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePerfil:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePerfil::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 