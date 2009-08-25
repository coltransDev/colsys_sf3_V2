<?php


abstract class BaseHdeskTicket extends BaseObject  implements Persistent {


  const PEER = 'HdeskTicketPeer';

	
	protected static $peer;

	
	protected $ca_idticket;

	
	protected $ca_idgroup;

	
	protected $ca_idproject;

	
	protected $ca_login;

	
	protected $ca_title;

	
	protected $ca_text;

	
	protected $ca_priority;

	
	protected $ca_opened;

	
	protected $ca_type;

	
	protected $ca_assignedto;

	
	protected $ca_action;

	
	protected $ca_idtarea;

	
	protected $ca_idseguimiento;

	
	protected $aHdeskGroup;

	
	protected $aUsuario;

	
	protected $aHdeskProject;

	
	protected $aNotTarea;

	
	protected $collHdeskResponses;

	
	private $lastHdeskResponseCriteria = null;

	
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

	
	public function getCaIdticket()
	{
		return $this->ca_idticket;
	}

	
	public function getCaIdgroup()
	{
		return $this->ca_idgroup;
	}

	
	public function getCaIdproject()
	{
		return $this->ca_idproject;
	}

	
	public function getCaLogin()
	{
		return $this->ca_login;
	}

	
	public function getCaTitle()
	{
		return $this->ca_title;
	}

	
	public function getCaText()
	{
		return $this->ca_text;
	}

	
	public function getCaPriority()
	{
		return $this->ca_priority;
	}

	
	public function getCaOpened($format = 'Y-m-d H:i:s')
	{
		if ($this->ca_opened === null) {
			return null;
		}



		try {
			$dt = new DateTime($this->ca_opened);
		} catch (Exception $x) {
			throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->ca_opened, true), $x);
		}

		if ($format === null) {
						return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	
	public function getCaType()
	{
		return $this->ca_type;
	}

	
	public function getCaAssignedto()
	{
		return $this->ca_assignedto;
	}

	
	public function getCaAction()
	{
		return $this->ca_action;
	}

	
	public function getCaIdtarea()
	{
		return $this->ca_idtarea;
	}

	
	public function getCaIdseguimiento()
	{
		return $this->ca_idseguimiento;
	}

	
	public function setCaIdticket($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idticket !== $v) {
			$this->ca_idticket = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_IDTICKET;
		}

		return $this;
	} 
	
	public function setCaIdgroup($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idgroup !== $v) {
			$this->ca_idgroup = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_IDGROUP;
		}

		if ($this->aHdeskGroup !== null && $this->aHdeskGroup->getCaIdgroup() !== $v) {
			$this->aHdeskGroup = null;
		}

		return $this;
	} 
	
	public function setCaIdproject($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idproject !== $v) {
			$this->ca_idproject = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_IDPROJECT;
		}

		if ($this->aHdeskProject !== null && $this->aHdeskProject->getCaIdproject() !== $v) {
			$this->aHdeskProject = null;
		}

		return $this;
	} 
	
	public function setCaLogin($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_login !== $v) {
			$this->ca_login = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_LOGIN;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getCaLogin() !== $v) {
			$this->aUsuario = null;
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
			$this->modifiedColumns[] = HdeskTicketPeer::CA_TITLE;
		}

		return $this;
	} 
	
	public function setCaText($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_text !== $v) {
			$this->ca_text = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_TEXT;
		}

		return $this;
	} 
	
	public function setCaPriority($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_priority !== $v) {
			$this->ca_priority = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_PRIORITY;
		}

		return $this;
	} 
	
	public function setCaOpened($v)
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

		if ( $this->ca_opened !== null || $dt !== null ) {
			
			$currNorm = ($this->ca_opened !== null && $tmpDt = new DateTime($this->ca_opened)) ? $tmpDt->format('Y-m-d\\TH:i:sO') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d\\TH:i:sO') : null;

			if ( ($currNorm !== $newNorm) 					)
			{
				$this->ca_opened = ($dt ? $dt->format('Y-m-d\\TH:i:sO') : null);
				$this->modifiedColumns[] = HdeskTicketPeer::CA_OPENED;
			}
		} 
		return $this;
	} 
	
	public function setCaType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_type !== $v) {
			$this->ca_type = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_TYPE;
		}

		return $this;
	} 
	
	public function setCaAssignedto($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_assignedto !== $v) {
			$this->ca_assignedto = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_ASSIGNEDTO;
		}

		return $this;
	} 
	
	public function setCaAction($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->ca_action !== $v) {
			$this->ca_action = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_ACTION;
		}

		return $this;
	} 
	
	public function setCaIdtarea($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idtarea !== $v) {
			$this->ca_idtarea = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_IDTAREA;
		}

		if ($this->aNotTarea !== null && $this->aNotTarea->getCaIdtarea() !== $v) {
			$this->aNotTarea = null;
		}

		return $this;
	} 
	
	public function setCaIdseguimiento($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->ca_idseguimiento !== $v) {
			$this->ca_idseguimiento = $v;
			$this->modifiedColumns[] = HdeskTicketPeer::CA_IDSEGUIMIENTO;
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

			$this->ca_idticket = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->ca_idgroup = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->ca_idproject = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->ca_login = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->ca_title = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->ca_text = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->ca_priority = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->ca_opened = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->ca_type = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->ca_assignedto = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->ca_action = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->ca_idtarea = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
			$this->ca_idseguimiento = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

						return $startcol + 13; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HdeskTicket object", $e);
		}
	}

	
	public function ensureConsistency()
	{

		if ($this->aHdeskGroup !== null && $this->ca_idgroup !== $this->aHdeskGroup->getCaIdgroup()) {
			$this->aHdeskGroup = null;
		}
		if ($this->aHdeskProject !== null && $this->ca_idproject !== $this->aHdeskProject->getCaIdproject()) {
			$this->aHdeskProject = null;
		}
		if ($this->aUsuario !== null && $this->ca_login !== $this->aUsuario->getCaLogin()) {
			$this->aUsuario = null;
		}
		if ($this->aNotTarea !== null && $this->ca_idtarea !== $this->aNotTarea->getCaIdtarea()) {
			$this->aNotTarea = null;
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
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

				
		$stmt = HdeskTicketPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); 
		if ($deep) {  
			$this->aHdeskGroup = null;
			$this->aUsuario = null;
			$this->aHdeskProject = null;
			$this->aNotTarea = null;
			$this->collHdeskResponses = null;
			$this->lastHdeskResponseCriteria = null;

		} 	}

	
	public function delete(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskTicket:delete:pre') as $callable)
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
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			HdeskTicketPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseHdeskTicket:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	
	public function save(PropelPDO $con = null)
	{

    foreach (sfMixer::getCallables('BaseHdeskTicket:save:pre') as $callable)
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
			$con = Propel::getConnection(HdeskTicketPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseHdeskTicket:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			HdeskTicketPeer::addInstanceToPool($this);
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

												
			if ($this->aHdeskGroup !== null) {
				if ($this->aHdeskGroup->isModified() || $this->aHdeskGroup->isNew()) {
					$affectedRows += $this->aHdeskGroup->save($con);
				}
				$this->setHdeskGroup($this->aHdeskGroup);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified() || $this->aUsuario->isNew()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}

			if ($this->aHdeskProject !== null) {
				if ($this->aHdeskProject->isModified() || $this->aHdeskProject->isNew()) {
					$affectedRows += $this->aHdeskProject->save($con);
				}
				$this->setHdeskProject($this->aHdeskProject);
			}

			if ($this->aNotTarea !== null) {
				if ($this->aNotTarea->isModified() || $this->aNotTarea->isNew()) {
					$affectedRows += $this->aNotTarea->save($con);
				}
				$this->setNotTarea($this->aNotTarea);
			}

			if ($this->isNew() ) {
				$this->modifiedColumns[] = HdeskTicketPeer::CA_IDTICKET;
			}

						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HdeskTicketPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCaIdticket($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HdeskTicketPeer::doUpdate($this, $con);
				}

				$this->resetModified(); 			}

			if ($this->collHdeskResponses !== null) {
				foreach ($this->collHdeskResponses as $referrerFK) {
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


												
			if ($this->aHdeskGroup !== null) {
				if (!$this->aHdeskGroup->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHdeskGroup->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}

			if ($this->aHdeskProject !== null) {
				if (!$this->aHdeskProject->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aHdeskProject->getValidationFailures());
				}
			}

			if ($this->aNotTarea !== null) {
				if (!$this->aNotTarea->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNotTarea->getValidationFailures());
				}
			}


			if (($retval = HdeskTicketPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collHdeskResponses !== null) {
					foreach ($this->collHdeskResponses as $referrerFK) {
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
		$pos = HdeskTicketPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCaIdticket();
				break;
			case 1:
				return $this->getCaIdgroup();
				break;
			case 2:
				return $this->getCaIdproject();
				break;
			case 3:
				return $this->getCaLogin();
				break;
			case 4:
				return $this->getCaTitle();
				break;
			case 5:
				return $this->getCaText();
				break;
			case 6:
				return $this->getCaPriority();
				break;
			case 7:
				return $this->getCaOpened();
				break;
			case 8:
				return $this->getCaType();
				break;
			case 9:
				return $this->getCaAssignedto();
				break;
			case 10:
				return $this->getCaAction();
				break;
			case 11:
				return $this->getCaIdtarea();
				break;
			case 12:
				return $this->getCaIdseguimiento();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = HdeskTicketPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCaIdticket(),
			$keys[1] => $this->getCaIdgroup(),
			$keys[2] => $this->getCaIdproject(),
			$keys[3] => $this->getCaLogin(),
			$keys[4] => $this->getCaTitle(),
			$keys[5] => $this->getCaText(),
			$keys[6] => $this->getCaPriority(),
			$keys[7] => $this->getCaOpened(),
			$keys[8] => $this->getCaType(),
			$keys[9] => $this->getCaAssignedto(),
			$keys[10] => $this->getCaAction(),
			$keys[11] => $this->getCaIdtarea(),
			$keys[12] => $this->getCaIdseguimiento(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HdeskTicketPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCaIdticket($value);
				break;
			case 1:
				$this->setCaIdgroup($value);
				break;
			case 2:
				$this->setCaIdproject($value);
				break;
			case 3:
				$this->setCaLogin($value);
				break;
			case 4:
				$this->setCaTitle($value);
				break;
			case 5:
				$this->setCaText($value);
				break;
			case 6:
				$this->setCaPriority($value);
				break;
			case 7:
				$this->setCaOpened($value);
				break;
			case 8:
				$this->setCaType($value);
				break;
			case 9:
				$this->setCaAssignedto($value);
				break;
			case 10:
				$this->setCaAction($value);
				break;
			case 11:
				$this->setCaIdtarea($value);
				break;
			case 12:
				$this->setCaIdseguimiento($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HdeskTicketPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCaIdticket($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCaIdgroup($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCaIdproject($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCaLogin($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCaTitle($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCaText($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCaPriority($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCaOpened($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setCaType($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCaAssignedto($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCaAction($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCaIdtarea($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setCaIdseguimiento($arr[$keys[12]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);

		if ($this->isColumnModified(HdeskTicketPeer::CA_IDTICKET)) $criteria->add(HdeskTicketPeer::CA_IDTICKET, $this->ca_idticket);
		if ($this->isColumnModified(HdeskTicketPeer::CA_IDGROUP)) $criteria->add(HdeskTicketPeer::CA_IDGROUP, $this->ca_idgroup);
		if ($this->isColumnModified(HdeskTicketPeer::CA_IDPROJECT)) $criteria->add(HdeskTicketPeer::CA_IDPROJECT, $this->ca_idproject);
		if ($this->isColumnModified(HdeskTicketPeer::CA_LOGIN)) $criteria->add(HdeskTicketPeer::CA_LOGIN, $this->ca_login);
		if ($this->isColumnModified(HdeskTicketPeer::CA_TITLE)) $criteria->add(HdeskTicketPeer::CA_TITLE, $this->ca_title);
		if ($this->isColumnModified(HdeskTicketPeer::CA_TEXT)) $criteria->add(HdeskTicketPeer::CA_TEXT, $this->ca_text);
		if ($this->isColumnModified(HdeskTicketPeer::CA_PRIORITY)) $criteria->add(HdeskTicketPeer::CA_PRIORITY, $this->ca_priority);
		if ($this->isColumnModified(HdeskTicketPeer::CA_OPENED)) $criteria->add(HdeskTicketPeer::CA_OPENED, $this->ca_opened);
		if ($this->isColumnModified(HdeskTicketPeer::CA_TYPE)) $criteria->add(HdeskTicketPeer::CA_TYPE, $this->ca_type);
		if ($this->isColumnModified(HdeskTicketPeer::CA_ASSIGNEDTO)) $criteria->add(HdeskTicketPeer::CA_ASSIGNEDTO, $this->ca_assignedto);
		if ($this->isColumnModified(HdeskTicketPeer::CA_ACTION)) $criteria->add(HdeskTicketPeer::CA_ACTION, $this->ca_action);
		if ($this->isColumnModified(HdeskTicketPeer::CA_IDTAREA)) $criteria->add(HdeskTicketPeer::CA_IDTAREA, $this->ca_idtarea);
		if ($this->isColumnModified(HdeskTicketPeer::CA_IDSEGUIMIENTO)) $criteria->add(HdeskTicketPeer::CA_IDSEGUIMIENTO, $this->ca_idseguimiento);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);

		$criteria->add(HdeskTicketPeer::CA_IDTICKET, $this->ca_idticket);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCaIdticket();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCaIdticket($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCaIdgroup($this->ca_idgroup);

		$copyObj->setCaIdproject($this->ca_idproject);

		$copyObj->setCaLogin($this->ca_login);

		$copyObj->setCaTitle($this->ca_title);

		$copyObj->setCaText($this->ca_text);

		$copyObj->setCaPriority($this->ca_priority);

		$copyObj->setCaOpened($this->ca_opened);

		$copyObj->setCaType($this->ca_type);

		$copyObj->setCaAssignedto($this->ca_assignedto);

		$copyObj->setCaAction($this->ca_action);

		$copyObj->setCaIdtarea($this->ca_idtarea);

		$copyObj->setCaIdseguimiento($this->ca_idseguimiento);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach ($this->getHdeskResponses() as $relObj) {
				if ($relObj !== $this) {  					$copyObj->addHdeskResponse($relObj->copy($deepCopy));
				}
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCaIdticket(NULL); 
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
			self::$peer = new HdeskTicketPeer();
		}
		return self::$peer;
	}

	
	public function setHdeskGroup(HdeskGroup $v = null)
	{
		if ($v === null) {
			$this->setCaIdgroup(NULL);
		} else {
			$this->setCaIdgroup($v->getCaIdgroup());
		}

		$this->aHdeskGroup = $v;

						if ($v !== null) {
			$v->addHdeskTicket($this);
		}

		return $this;
	}


	
	public function getHdeskGroup(PropelPDO $con = null)
	{
		if ($this->aHdeskGroup === null && ($this->ca_idgroup !== null)) {
			$c = new Criteria(HdeskGroupPeer::DATABASE_NAME);
			$c->add(HdeskGroupPeer::CA_IDGROUP, $this->ca_idgroup);
			$this->aHdeskGroup = HdeskGroupPeer::doSelectOne($c, $con);
			
		}
		return $this->aHdeskGroup;
	}

	
	public function setUsuario(Usuario $v = null)
	{
		if ($v === null) {
			$this->setCaLogin(NULL);
		} else {
			$this->setCaLogin($v->getCaLogin());
		}

		$this->aUsuario = $v;

						if ($v !== null) {
			$v->addHdeskTicket($this);
		}

		return $this;
	}


	
	public function getUsuario(PropelPDO $con = null)
	{
		if ($this->aUsuario === null && (($this->ca_login !== "" && $this->ca_login !== null))) {
			$c = new Criteria(UsuarioPeer::DATABASE_NAME);
			$c->add(UsuarioPeer::CA_LOGIN, $this->ca_login);
			$this->aUsuario = UsuarioPeer::doSelectOne($c, $con);
			
		}
		return $this->aUsuario;
	}

	
	public function setHdeskProject(HdeskProject $v = null)
	{
		if ($v === null) {
			$this->setCaIdproject(NULL);
		} else {
			$this->setCaIdproject($v->getCaIdproject());
		}

		$this->aHdeskProject = $v;

						if ($v !== null) {
			$v->addHdeskTicket($this);
		}

		return $this;
	}


	
	public function getHdeskProject(PropelPDO $con = null)
	{
		if ($this->aHdeskProject === null && ($this->ca_idproject !== null)) {
			$c = new Criteria(HdeskProjectPeer::DATABASE_NAME);
			$c->add(HdeskProjectPeer::CA_IDPROJECT, $this->ca_idproject);
			$this->aHdeskProject = HdeskProjectPeer::doSelectOne($c, $con);
			
		}
		return $this->aHdeskProject;
	}

	
	public function setNotTarea(NotTarea $v = null)
	{
		if ($v === null) {
			$this->setCaIdtarea(NULL);
		} else {
			$this->setCaIdtarea($v->getCaIdtarea());
		}

		$this->aNotTarea = $v;

						if ($v !== null) {
			$v->addHdeskTicket($this);
		}

		return $this;
	}


	
	public function getNotTarea(PropelPDO $con = null)
	{
		if ($this->aNotTarea === null && ($this->ca_idtarea !== null)) {
			$c = new Criteria(NotTareaPeer::DATABASE_NAME);
			$c->add(NotTareaPeer::CA_IDTAREA, $this->ca_idtarea);
			$this->aNotTarea = NotTareaPeer::doSelectOne($c, $con);
			
		}
		return $this->aNotTarea;
	}

	
	public function clearHdeskResponses()
	{
		$this->collHdeskResponses = null; 	}

	
	public function initHdeskResponses()
	{
		$this->collHdeskResponses = array();
	}

	
	public function getHdeskResponses($criteria = null, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
			   $this->collHdeskResponses = array();
			} else {

				$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

				HdeskResponsePeer::addSelectColumns($criteria);
				$this->collHdeskResponses = HdeskResponsePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

				HdeskResponsePeer::addSelectColumns($criteria);
				if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
					$this->collHdeskResponses = HdeskResponsePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHdeskResponseCriteria = $criteria;
		return $this->collHdeskResponses;
	}

	
	public function countHdeskResponses(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);
		} else {
			$criteria = clone $criteria;
		}

		if ($distinct) {
			$criteria->setDistinct();
		}

		$count = null;

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
				$count = 0;
			} else {

				$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

				$count = HdeskResponsePeer::doCount($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

				if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
					$count = HdeskResponsePeer::doCount($criteria, $con);
				} else {
					$count = count($this->collHdeskResponses);
				}
			} else {
				$count = count($this->collHdeskResponses);
			}
		}
		return $count;
	}

	
	public function addHdeskResponse(HdeskResponse $l)
	{
		if ($this->collHdeskResponses === null) {
			$this->initHdeskResponses();
		}
		if (!in_array($l, $this->collHdeskResponses, true)) { 			array_push($this->collHdeskResponses, $l);
			$l->setHdeskTicket($this);
		}
	}


	
	public function getHdeskResponsesJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		if ($criteria === null) {
			$criteria = new Criteria(HdeskTicketPeer::DATABASE_NAME);
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHdeskResponses === null) {
			if ($this->isNew()) {
				$this->collHdeskResponses = array();
			} else {

				$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

				$this->collHdeskResponses = HdeskResponsePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		} else {
									
			$criteria->add(HdeskResponsePeer::CA_IDTICKET, $this->ca_idticket);

			if (!isset($this->lastHdeskResponseCriteria) || !$this->lastHdeskResponseCriteria->equals($criteria)) {
				$this->collHdeskResponses = HdeskResponsePeer::doSelectJoinUsuario($criteria, $con, $join_behavior);
			}
		}
		$this->lastHdeskResponseCriteria = $criteria;

		return $this->collHdeskResponses;
	}

	
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collHdeskResponses) {
				foreach ((array) $this->collHdeskResponses as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} 
		$this->collHdeskResponses = null;
			$this->aHdeskGroup = null;
			$this->aUsuario = null;
			$this->aHdeskProject = null;
			$this->aNotTarea = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseHdeskTicket:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseHdeskTicket::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} 