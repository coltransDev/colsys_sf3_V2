<?php


abstract class BaseIdsTipoDocumento extends BaseObject  implements Persistent {


  const PEER = 'IdsTipoDocumentoPeer';

	
	protected static $peer;

	
	protected $ca_idtipo;

	
	protected $ca_tipo;

	
	protected $ca_equivalentea;

	
	protected $ca_vigencia;

	
	protected $ca_observaciones;

	
	protected $ca_fchcreado;

	
	protected $ca_usucreado;

	
	protected $ca_fchactualizado;

	
	protected $ca_usuactualizado;

	
	protected $collIdsDocumentos;

	
	private $lastIdsDocumentoCriteria = null;

	
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

	
	public function getCaIdtipo()
	{
		return $this->ca_idtipo;
	}

	
	public function getCaTipo()
	{
		return $this->ca_tipo;
	}

	
	public function getCaEquivalentea()
	{
		return $this->ca_equivalentea;
	}

	
	public function getCaVigencia()
	{
		return $this->ca_vigencia;
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

	
	public function setCaIdtipo($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtipo !== $v) {
			$this->ca_idtipo = $v;
			$this->modifiedColumns[] = IdsTipoDocumentoPeer::CA_IDTIPO;
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
			$this->modifiedColumns[] = IdsTipoDocumentoPeer::CA_TIPO;
		}

		return $this;
	} 
	
	public function setCaEquivalentea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_equivalentea !== $v) {
			$this->ca_equivalentea = $v;
			$this->modifiedColumns[] = IdsTipoDocumentoPeer::CA_EQUIVALENTEA;
		}

		return $this;
	} 
	
	public function setCaVigencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_vigencia !== $v) {
			$this->ca_vigencia = $v;
			$this->modifiedColumns[] = IdsTipoDocumentoPeer::CA_VIGENCIA;
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
			$this->modifiedColumns[] = IdsTipoDocumentoPeer::CA_OBSERVACIONES;
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
				$this->modifiedColumns[] = IdsTipoDocumentoPeer::CA_FCHCREADO;
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
			$this->modifiedColumns[] = IdsTipoDocumentoPeer::CA_USUCREADO;
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
				$this->modifiedColumns[] = IdsTipoDocumentoPeer::CA_FCHACTUALIZADO;
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
			$this->modifiedColumns[] = IdsTipoDocumentoPeer::CA_USUACTUALIZADO;
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

			$this->ca_idtipo = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_tipo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_equivalentea = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_vigencia = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_observaciones = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_fchcreado = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_usucreado = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_fchactualizado = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_usuactualizado = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating IdsTipoDocumento object", $e);
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
			$con = Propel::getConnection(IdsTipoDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = IdsTipoDocumentoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collIdsDocumentos = null;
			$this->lastIdsDocumentoCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsTipoDocumento:delete:pre') as $callable)
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
			$con = Propel::getConnection(IdsTipoDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			IdsTipoDocumentoPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseIdsTipoDocumento:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseIdsTipoDocumento:save:pre') as $callable)
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
			$con = Propel::getConnection(IdsTipoDocumentoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseIdsTipoDocumento:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			IdsTipoDocumentoPeer::addInstanceToPool($this);
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
				$this->modifiedColumns[] = IdsTipoDocumentoPeer::CA_IDTIPO;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = IdsTipoDocumentoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdtipo($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += IdsTipoDocumentoPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collIdsDocumentos !== null) {
				foreach ($this->collIdsDocumentos as $referrerFK) {
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


			if (($retval = IdsTipoDocumentoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collIdsDocumentos !== null) {
					foreach ($this->collIdsDocumentos as $referrerFK) {
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
		$pos = IdsTipoDocumentoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdtipo();
				break;
			case 1:
				return $this->getCaTipo();
				break;
			case 2:
				return $this->getCaEquivalentea();
				break;
			case 3:
				return $this->getCaVigencia();
				break;
			case 4:
				return $this->getCaObservaciones();
				break;
			case 5:
				return $this->getCaFchcreado();
				break;
			case 6:
				return $this->getCaUsucreado();
				break;
			case 7:
				return $this->getCaFchactualizado();
				break;
			case 8:
				return $this->getCaUsuactualizado();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = IdsTipoDocumentoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdtipo(),
			$keys[1] => $this->getCaTipo(),
			$keys[2] => $this->getCaEquivalentea(),
			$keys[3] => $this->getCaVigencia(),
			$keys[4] => $this->getCaObservaciones(),
			$keys[5] => $this->getCaFchcreado(),
			$keys[6] => $this->getCaUsucreado(),
			$keys[7] => $this->getCaFchactualizado(),
			$keys[8] => $this->getCaUsuactualizado(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = IdsTipoDocumentoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdtipo($value);
				break;
			case 1:
				$this->setCaTipo($value);
				break;
			case 2:
				$this->setCaEquivalentea($value);
				break;
			case 3:
				$this->setCaVigencia($value);
				break;
			case 4:
				$this->setCaObservaciones($value);
				break;
			case 5:
				$this->setCaFchcreado($value);
				break;
			case 6:
				$this->setCaUsucreado($value);
				break;
			case 7:
				$this->setCaFchactualizado($value);
				break;
			case 8:
				$this->setCaUsuactualizado($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = IdsTipoDocumentoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdtipo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaTipo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaEquivalentea($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaVigencia($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaObservaciones($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaFchcreado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaUsucreado($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaFchactualizado($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaUsuactualizado($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(IdsTipoDocumentoPeer::DATABASE_NAME);

		if ($this->isColumnModified(IdsTipoDocumentoPeer::CA_IDTIPO)) $criteria->add(IdsTipoDocumentoPeer::CA_IDTIPO, $this->ca_idtipo);
		if ($this->isColumnModified(IdsTipoDocumentoPeer::CA_TIPO)) $criteria->add(IdsTipoDocumentoPeer::CA_TIPO, $this->ca_tipo);
		if ($this->isColumnModified(IdsTipoDocumentoPeer::CA_EQUIVALENTEA)) $criteria->add(IdsTipoDocumentoPeer::CA_EQUIVALENTEA, $this->ca_equivalentea);
		if ($this->isColumnModified(IdsTipoDocumentoPeer::CA_VIGENCIA)) $criteria->add(IdsTipoDocumentoPeer::CA_VIGENCIA, $this->ca_vigencia);
		if ($this->isColumnModified(IdsTipoDocumentoPeer::CA_OBSERVACIONES)) $criteria->add(IdsTipoDocumentoPeer::CA_OBSERVACIONES, $this->ca_observaciones);
		if ($this->isColumnModified(IdsTipoDocumentoPeer::CA_FCHCREADO)) $criteria->add(IdsTipoDocumentoPeer::CA_FCHCREADO, $this->ca_fchcreado);
		if ($this->isColumnModified(IdsTipoDocumentoPeer::CA_USUCREADO)) $criteria->add(IdsTipoDocumentoPeer::CA_USUCREADO, $this->ca_usucreado);
		if ($this->isColumnModified(IdsTipoDocumentoPeer::CA_FCHACTUALIZADO)) $criteria->add(IdsTipoDocumentoPeer::CA_FCHACTUALIZADO, $this->ca_fchactualizado);
		if ($this->isColumnModified(IdsTipoDocumentoPeer::CA_USUACTUALIZADO)) $criteria->add(IdsTipoDocumentoPeer::CA_USUACTUALIZADO, $this->ca_usuactualizado);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(IdsTipoDocumentoPeer::DATABASE_NAME);

		$criteria->add(IdsTipoDocumentoPeer::CA_IDTIPO, $this->ca_idtipo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdtipo();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdtipo($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaTipo($this->ca_tipo);

		$copyObj->setCaEquivalentea($this->ca_equivalentea);

		$copyObj->setCaVigencia($this->ca_vigencia);

		$copyObj->setCaObservaciones($this->ca_observaciones);

		$copyObj->setCaFchcreado($this->ca_fchcreado);

		$copyObj->setCaUsucreado($this->ca_usucreado);

		$copyObj->setCaFchactualizado($this->ca_fchactualizado);

		$copyObj->setCaUsuactualizado($this->ca_usuactualizado);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getIdsDocumentos() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addIdsDocumento($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdtipo(NULL); 
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
			self::$peer = new IdsTipoDocumentoPeer();
		}
		return self::$peer;
	}

	
	public function clearIdsDocumentos()
	{
		$this->collIdsDocumentos = null; 	}

	
	public function initIdsDocumentos()
	{
		$this->collIdsDocumentos = array();
	}

	
	public function getIdsDocumentos($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsTipoDocumentoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsDocumentos === null) {
			if ($this->isNew()) {
			   $this->collIdsDocumentos = array();
			} else {

				$criteria->add(IdsDocumentoPeer::CA_IDTIPO, $this->ca_idtipo);

				IdsDocumentoPeer::addSelectColumns($criteria);
				$this->collIdsDocumentos = IdsDocumentoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsDocumentoPeer::CA_IDTIPO, $this->ca_idtipo);

				IdsDocumentoPeer::addSelectColumns($criteria);
				if (!isset($this->lastIdsDocumentoCriteria) || !$this->lastIdsDocumentoCriteria->equals($criteria)) {
					$this->collIdsDocumentos = IdsDocumentoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastIdsDocumentoCriteria = $criteria;
		return $this->collIdsDocumentos;
	}

	
	public function countIdsDocumentos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsTipoDocumentoPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collIdsDocumentos === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(IdsDocumentoPeer::CA_IDTIPO, $this->ca_idtipo);

				$count = IdsDocumentoPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(IdsDocumentoPeer::CA_IDTIPO, $this->ca_idtipo);

				if (!isset($this->lastIdsDocumentoCriteria) || !$this->lastIdsDocumentoCriteria->equals($criteria)) {
					$count = IdsDocumentoPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collIdsDocumentos);
				}
			} else {
				$count = count($this->collIdsDocumentos);
			}
		}
		return $count;
	}

	
	public function addIdsDocumento(IdsDocumento $l)
	{
		if ($this->collIdsDocumentos === null) {
			$this->initIdsDocumentos();
		}
		if (!in_array($l, $this->collIdsDocumentos, true)) { 			array_push($this->collIdsDocumentos, $l);
			$l->setIdsTipoDocumento($this);
		}
	}


	
	public function getIdsDocumentosJoinIds($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(IdsTipoDocumentoPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collIdsDocumentos === null) {
			if ($this->isNew()) {
				$this->collIdsDocumentos = array();
			} else {

				$criteria->add(IdsDocumentoPeer::CA_IDTIPO, $this->ca_idtipo);

				$this->collIdsDocumentos = IdsDocumentoPeer::doSelectJoinIds($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(IdsDocumentoPeer::CA_IDTIPO, $this->ca_idtipo);

			if (!isset($this->lastIdsDocumentoCriteria) || !$this->lastIdsDocumentoCriteria->equals($criteria)) {
				$this->collIdsDocumentos = IdsDocumentoPeer::doSelectJoinIds($criteria, $con, $join_behavior);
			}
		}
		$this->lastIdsDocumentoCriteria = $criteria;

		return $this->collIdsDocumentos;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collIdsDocumentos) {
				foreach ((array) $this->collIdsDocumentos as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collIdsDocumentos = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseIdsTipoDocumento:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseIdsTipoDocumento::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 