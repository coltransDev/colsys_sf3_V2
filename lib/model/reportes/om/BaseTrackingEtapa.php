<?php


abstract class BaseTrackingEtapa extends BaseObject  implements Persistent {


  const PEER = 'TrackingEtapaPeer';

	
	protected static $peer;

	
	protected $ca_idetapa;

	
	protected $ca_impoexpo;

	
	protected $ca_transporte;

	
	protected $ca_departamento;

	
	protected $ca_etapa;

	
	protected $ca_orden;

	
	protected $ca_ttl;

	
	protected $ca_class;

	
	protected $ca_template;

	
	protected $ca_message;

	
	protected $ca_message_default;

	
	protected $ca_intro;

	
	protected $ca_title;

	
	protected $collReportes;

	
	private $lastReporteCriteria = null;

	
	protected $collRepStatuss;

	
	private $lastRepStatusCriteria = null;

	
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

	
	public function getCaIdetapa()
	{
		return $this->ca_idetapa;
	}

	
	public function getCaImpoexpo()
	{
		return $this->ca_impoexpo;
	}

	
	public function getCaTransporte()
	{
		return $this->ca_transporte;
	}

	
	public function getCaDepartamento()
	{
		return $this->ca_departamento;
	}

	
	public function getCaEtapa()
	{
		return $this->ca_etapa;
	}

	
	public function getCaOrden()
	{
		return $this->ca_orden;
	}

	
	public function getCaTtl()
	{
		return $this->ca_ttl;
	}

	
	public function getCaClass()
	{
		return $this->ca_class;
	}

	
	public function getCaTemplate()
	{
		return $this->ca_template;
	}

	
	public function getCaMessage()
	{
		return $this->ca_message;
	}

	
	public function getCaMessageDefault()
	{
		return $this->ca_message_default;
	}

	
	public function getCaIntro()
	{
		return $this->ca_intro;
	}

	
	public function getCaTitle()
	{
		return $this->ca_title;
	}

	
	public function setCaIdetapa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_idetapa !== $v) {
			$this->ca_idetapa = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_IDETAPA;
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
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_IMPOEXPO;
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
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_TRANSPORTE;
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
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_DEPARTAMENTO;
		}

		return $this;
	} 
	
	public function setCaEtapa($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_etapa !== $v) {
			$this->ca_etapa = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_ETAPA;
		}

		return $this;
	} 
	
	public function setCaOrden($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_orden !== $v) {
			$this->ca_orden = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_ORDEN;
		}

		return $this;
	} 
	
	public function setCaTtl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_ttl !== $v) {
			$this->ca_ttl = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_TTL;
		}

		return $this;
	} 
	
	public function setCaClass($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_class !== $v) {
			$this->ca_class = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_CLASS;
		}

		return $this;
	} 
	
	public function setCaTemplate($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_template !== $v) {
			$this->ca_template = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_TEMPLATE;
		}

		return $this;
	} 
	
	public function setCaMessage($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_message !== $v) {
			$this->ca_message = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_MESSAGE;
		}

		return $this;
	} 
	
	public function setCaMessageDefault($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_message_default !== $v) {
			$this->ca_message_default = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_MESSAGE_DEFAULT;
		}

		return $this;
	} 
	
	public function setCaIntro($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_intro !== $v) {
			$this->ca_intro = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_INTRO;
		}

		return $this;
	} 
	
	public function setCaTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_title !== $v) {
			$this->ca_title = $v;
			$this->modifiedColumns[] = TrackingEtapaPeer::CA_TITLE;
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

			$this->ca_idetapa = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->ca_impoexpo = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->ca_transporte = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->ca_departamento = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_etapa = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_orden = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_ttl = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_class = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_template = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_message = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_message_default = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_intro = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->ca_title = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TrackingEtapa object", $e);
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
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = TrackingEtapaPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->collReportes = null;
			$this->lastReporteCriteria = null;

			$this->collRepStatuss = null;
			$this->lastRepStatusCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingEtapa:delete:pre') as $callable)
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
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			TrackingEtapaPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseTrackingEtapa:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseTrackingEtapa:save:pre') as $callable)
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
			$con = Propel::getConnection(TrackingEtapaPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseTrackingEtapa:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			TrackingEtapaPeer::addInstanceToPool($this);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TrackingEtapaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += TrackingEtapaPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collReportes !== null) {
				foreach ($this->collReportes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRepStatuss !== null) {
				foreach ($this->collRepStatuss as $referrerFK) {
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


			if (($retval = TrackingEtapaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collReportes !== null) {
					foreach ($this->collReportes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRepStatuss !== null) {
					foreach ($this->collRepStatuss as $referrerFK) {
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
		$pos = TrackingEtapaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdetapa();
				break;
			case 1:
				return $this->getCaImpoexpo();
				break;
			case 2:
				return $this->getCaTransporte();
				break;
			case 3:
				return $this->getCaDepartamento();
				break;
			case 4:
				return $this->getCaEtapa();
				break;
			case 5:
				return $this->getCaOrden();
				break;
			case 6:
				return $this->getCaTtl();
				break;
			case 7:
				return $this->getCaClass();
				break;
			case 8:
				return $this->getCaTemplate();
				break;
			case 9:
				return $this->getCaMessage();
				break;
			case 10:
				return $this->getCaMessageDefault();
				break;
			case 11:
				return $this->getCaIntro();
				break;
			case 12:
				return $this->getCaTitle();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = TrackingEtapaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdetapa(),
			$keys[1] => $this->getCaImpoexpo(),
			$keys[2] => $this->getCaTransporte(),
			$keys[3] => $this->getCaDepartamento(),
			$keys[4] => $this->getCaEtapa(),
			$keys[5] => $this->getCaOrden(),
			$keys[6] => $this->getCaTtl(),
			$keys[7] => $this->getCaClass(),
			$keys[8] => $this->getCaTemplate(),
			$keys[9] => $this->getCaMessage(),
			$keys[10] => $this->getCaMessageDefault(),
			$keys[11] => $this->getCaIntro(),
			$keys[12] => $this->getCaTitle(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TrackingEtapaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdetapa($value);
				break;
			case 1:
				$this->setCaImpoexpo($value);
				break;
			case 2:
				$this->setCaTransporte($value);
				break;
			case 3:
				$this->setCaDepartamento($value);
				break;
			case 4:
				$this->setCaEtapa($value);
				break;
			case 5:
				$this->setCaOrden($value);
				break;
			case 6:
				$this->setCaTtl($value);
				break;
			case 7:
				$this->setCaClass($value);
				break;
			case 8:
				$this->setCaTemplate($value);
				break;
			case 9:
				$this->setCaMessage($value);
				break;
			case 10:
				$this->setCaMessageDefault($value);
				break;
			case 11:
				$this->setCaIntro($value);
				break;
			case 12:
				$this->setCaTitle($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TrackingEtapaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdetapa($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaImpoexpo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaTransporte($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaDepartamento($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaEtapa($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaOrden($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaTtl($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaClass($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaTemplate($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaMessage($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaMessageDefault($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaIntro($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaTitle($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);

		if ($this->isColumnModified(TrackingEtapaPeer::CA_IDETAPA)) $criteria->add(TrackingEtapaPeer::CA_IDETAPA, $this->ca_idetapa);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_IMPOEXPO)) $criteria->add(TrackingEtapaPeer::CA_IMPOEXPO, $this->ca_impoexpo);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_TRANSPORTE)) $criteria->add(TrackingEtapaPeer::CA_TRANSPORTE, $this->ca_transporte);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_DEPARTAMENTO)) $criteria->add(TrackingEtapaPeer::CA_DEPARTAMENTO, $this->ca_departamento);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_ETAPA)) $criteria->add(TrackingEtapaPeer::CA_ETAPA, $this->ca_etapa);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_ORDEN)) $criteria->add(TrackingEtapaPeer::CA_ORDEN, $this->ca_orden);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_TTL)) $criteria->add(TrackingEtapaPeer::CA_TTL, $this->ca_ttl);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_CLASS)) $criteria->add(TrackingEtapaPeer::CA_CLASS, $this->ca_class);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_TEMPLATE)) $criteria->add(TrackingEtapaPeer::CA_TEMPLATE, $this->ca_template);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_MESSAGE)) $criteria->add(TrackingEtapaPeer::CA_MESSAGE, $this->ca_message);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_MESSAGE_DEFAULT)) $criteria->add(TrackingEtapaPeer::CA_MESSAGE_DEFAULT, $this->ca_message_default);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_INTRO)) $criteria->add(TrackingEtapaPeer::CA_INTRO, $this->ca_intro);
		if ($this->isColumnModified(TrackingEtapaPeer::CA_TITLE)) $criteria->add(TrackingEtapaPeer::CA_TITLE, $this->ca_title);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);

		$criteria->add(TrackingEtapaPeer::CA_IDETAPA, $this->ca_idetapa);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdetapa();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdetapa($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdetapa($this->ca_idetapa);

		$copyObj->setCaImpoexpo($this->ca_impoexpo);

		$copyObj->setCaTransporte($this->ca_transporte);

		$copyObj->setCaDepartamento($this->ca_departamento);

		$copyObj->setCaEtapa($this->ca_etapa);

		$copyObj->setCaOrden($this->ca_orden);

		$copyObj->setCaTtl($this->ca_ttl);

		$copyObj->setCaClass($this->ca_class);

		$copyObj->setCaTemplate($this->ca_template);

		$copyObj->setCaMessage($this->ca_message);

		$copyObj->setCaMessageDefault($this->ca_message_default);

		$copyObj->setCaIntro($this->ca_intro);

		$copyObj->setCaTitle($this->ca_title);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getReportes() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addReporte($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getRepStatuss() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addRepStatus($relObj->copy($deepCopy));
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
			self::$peer = new TrackingEtapaPeer();
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
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
			   $this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				ReportePeer::addSelectColumns($criteria);
				$this->collReportes = ReportePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

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
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
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

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$count = ReportePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

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
			$l->setTrackingEtapa($this);
		}
	}


	
	public function getReportesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

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
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinTransportador($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

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
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinTercero($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

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
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinAgente($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

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
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinBodega($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}


	
	public function getReportesJoinNotTarea($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collReportes === null) {
			if ($this->isNew()) {
				$this->collReportes = array();
			} else {

				$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collReportes = ReportePeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(ReportePeer::CA_IDETAPA, $this->ca_idetapa);

			if (!isset($this->lastReporteCriteria) || !$this->lastReporteCriteria->equals($criteria)) {
				$this->collReportes = ReportePeer::doSelectJoinNotTarea($criteria, $con, $join_behavior);
			}
		}
		$this->lastReporteCriteria = $criteria;

		return $this->collReportes;
	}

	
	public function clearRepStatuss()
	{
		$this->collRepStatuss = null; 	}

	
	public function initRepStatuss()
	{
		$this->collRepStatuss = array();
	}

	
	public function getRepStatuss($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
			   $this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				RepStatusPeer::addSelectColumns($criteria);
				$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				RepStatusPeer::addSelectColumns($criteria);
				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$this->collRepStatuss = RepStatusPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRepStatusCriteria = $criteria;
		return $this->collRepStatuss;
	}

	
	public function countRepStatuss(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				$count = RepStatusPeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
					$count = RepStatusPeer::doCount($criteria, $con);
				} else {
					$count = count($this->collRepStatuss);
				}
			} else {
				$count = count($this->collRepStatuss);
			}
		}
		return $count;
	}

	
	public function addRepStatus(RepStatus $l)
	{
		if ($this->collRepStatuss === null) {
			$this->initRepStatuss();
		}
		if (!in_array($l, $this->collRepStatuss, true)) { 			array_push($this->collRepStatuss, $l);
			$l->setTrackingEtapa($this);
		}
	}


	
	public function getRepStatussJoinReporte($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collRepStatuss = RepStatusPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinReporte($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
	}


	
	public function getRepStatussJoinEmail($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(TrackingEtapaPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRepStatuss === null) {
			if ($this->isNew()) {
				$this->collRepStatuss = array();
			} else {

				$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

				$this->collRepStatuss = RepStatusPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(RepStatusPeer::CA_IDETAPA, $this->ca_idetapa);

			if (!isset($this->lastRepStatusCriteria) || !$this->lastRepStatusCriteria->equals($criteria)) {
				$this->collRepStatuss = RepStatusPeer::doSelectJoinEmail($criteria, $con, $join_behavior);
			}
		}
		$this->lastRepStatusCriteria = $criteria;

		return $this->collRepStatuss;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collReportes) {
				foreach ((array) $this->collReportes as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRepStatuss) {
				foreach ((array) $this->collRepStatuss as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collReportes = null;
		$this->collRepStatuss = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseTrackingEtapa:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseTrackingEtapa::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 