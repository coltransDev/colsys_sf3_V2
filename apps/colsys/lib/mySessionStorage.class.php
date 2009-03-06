<?php

/*

*/
class mySessionStorage  extends sfDatabaseSessionStorage
{  
		

   /**
   * Destroys a session.
   *
   * @param  string $id  A session ID
   *
   * @return bool true, if the session was destroyed, otherwise an exception is thrown
   *
   * @throws <b>DatabaseException</b> If the session cannot be destroyed
   */
  public function sessionDestroy($id)
  {
    // get table/column
    $db_table  = $this->options['db_table'];
    $db_id_col = $this->options['db_id_col'];
	
    // delete the record associated with this id
    $sql = 'DELETE FROM '.$db_table.' WHERE '.$db_id_col.'= ?';

    try
    {
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(1, $id, PDO::PARAM_STR);
      $stmt->execute();
    }
    catch (PDOException $e)
    {
      throw new sfDatabaseException(sprintf('PDOException was thrown when trying to manipulate session data. Message: %s', $e->getMessage()));
    }
    
    return true;
  }

  /**
   * Cleans up old sessions.
   *
   * @param  int $lifetime  The lifetime of a session
   *
   * @return bool true, if old sessions have been cleaned, otherwise an exception is thrown
   *
   * @throws <b>DatabaseException</b> If any old sessions cannot be cleaned
   */
  public function sessionGC($lifetime)
  {
    // get table/column
    $db_table    = $this->options['db_table'];
    $db_time_col = $this->options['db_time_col'];
	$db_maxinactive_col = $this->options['db_maxinactive_col'];
	
    // delete the record associated with this id
    $sql = 'DELETE FROM '.$db_table.' WHERE '.$db_time_col.'+'.$db_maxinactive_col.'<'.time();
	
    try
    {
      $this->db->query($sql);
    }
    catch (PDOException $e)
    {
      throw new sfDatabaseException(sprintf('PDOException was thrown when trying to manipulate session data. Message: %s', $e->getMessage()));
    }

    return true;
  }

  /**
   * Reads a session.
   *
   * @param  string $id  A session ID
   *
   * @return string      The session data if the session was read or created, otherwise an exception is thrown
   *
   * @throws <b>DatabaseException</b> If the session cannot be read
   */
  public function sessionRead($id)
  {
    // get table/columns
    $db_table    = $this->options['db_table'];
    $db_data_col = $this->options['db_data_col'];
    $db_id_col   = $this->options['db_id_col'];
    $db_time_col = $this->options['db_time_col'];	
	$db_maxinactive_col = $this->options['db_maxinactive_col'];

    try
    {
      $sql = 'SELECT '.$db_data_col.', '.$db_time_col.', '.$db_maxinactive_col.' FROM '.$db_table.' WHERE '.$db_id_col.'=?';

      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(1, $id, PDO::PARAM_STR, 255);

      $stmt->execute();
      // it is recommended to use fetchAll so that PDO can close the DB cursor
      // we anyway expect either no rows, or one row with one column. fetchColumn, seems to be buggy #4777
      $sessionRows = $stmt->fetchAll(PDO::FETCH_NUM);
      if (count($sessionRows) == 1)
      {	  	
	  	//echo  " ultimo ".date("H:i:s", $sessionRows[0][1])." ".$sessionRows[0][2]." vencimiento ".date("H:i:s",$sessionRows[0][1]+$sessionRows[0][2])." actual ".date("H:i:s",time() );
	  	if( $sessionRows[0][1]+$sessionRows[0][2]>time() ) {
	        return base64_decode($sessionRows[0][0]);
		}else{		 
			$this->sessionDestroy( $id );  
			return "";
		}
      }
      else
      {
        // session does not exist, create it
        $sql = 'INSERT INTO '.$db_table.'('.$db_id_col.', '.$db_data_col.', '.$db_time_col.') VALUES (?, ?, ?)';

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_STR);
        $stmt->bindValue(2, '', PDO::PARAM_STR);
        $stmt->bindValue(3, time(), PDO::PARAM_INT);
        $stmt->execute();

        return '';
      }
    }
    catch (PDOException $e)
    {
      throw new sfDatabaseException(sprintf('PDOException was thrown when trying to manipulate session data. Message: %s', $e->getMessage()));
    }
  }
	
  /**
   * Writes session data.
   *
   * @param  string $id    A session ID
   * @param  string $data  A serialized chunk of session data
   *
   * @return bool true, if the session was written, otherwise an exception is thrown
   *
   * @throws <b>DatabaseException</b> If the session data cannot be written
   */
  public function sessionWrite($id, $data)
  {
  	
  	$data = base64_encode( $data );
    // get table/column
    $db_table    = $this->options['db_table'];
    $db_data_col = $this->options['db_data_col'];
    $db_id_col   = $this->options['db_id_col'];
    $db_time_col = $this->options['db_time_col'];
	$db_maxinactive_col = $this->options['db_maxinactive_col'];


    $sql = 'UPDATE '.$db_table.' SET '.$db_data_col.' = ?, '.$db_time_col.' = '.time().' WHERE '.$db_id_col.'= ? AND '.$db_time_col.'+'.$db_maxinactive_col.'>'.time();

    try
    {
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(1, $data, PDO::PARAM_STR);
      $stmt->bindParam(2, $id, PDO::PARAM_STR);
      $stmt->execute();
    }
    catch (PDOException $e)
    {
      throw new sfDatabaseException(sprintf('PDOException was thrown when trying to manipulate session data. Message: %s', $e->getMessage()));
    }

    return true;
  }
  
  /**
   * Regenerates id that represents this storage.
   *
   * @param  boolean $destroy Destroy session when regenerating?
   *
   * @return boolean True if session regenerated, false if error
   *
   */
   /*
	public function regenerate($destroy = false)
	{
		//$this->sessionDestroy( session_id() );
		 parent::regenerate($destroy);
	}*/
  
}
