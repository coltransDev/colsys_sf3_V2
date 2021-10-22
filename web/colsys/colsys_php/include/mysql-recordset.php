<?php
define('rsMySQL', 'yes');
// $Id: mysql-recordset.php,v 1.8 2002/10/27 18:02:40 alarion Exp $
/********************************************************************************/
/** Datalib v0.5beta                                                           **/
/** Copyright (C)2000-2001 Sean Finkel                                         **/
/**                                                                            **/
/**                                                                            **/
/** This library is free software; you can redistribute it and/or              **/
/** modify it under the terms of the GNU Lesser General Public                 **/
/** License as published by the Free Software Foundation; either               **/
/** version 2.1 of the License, or (at your option) any later version.         **/
/**                                                                            **/
/** This library is distributed in the hope that it will be useful,            **/
/** but WITHOUT ANY WARRANTY; without even the implied warranty of             **/
/** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU          **/
/** Lesser General Public License for more details.                            **/
/**                                                                            **/
/** You should have received a copy of the GNU Lesser General Public           **/
/** License along with this library; if not, write to the Free Software        **/
/** Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA  **/
/**                                                                            **/
/** @author Sean Finkel <alarion@databound-software.com>                       **/
/** @package DataLib                                                           **/
/********************************************************************************/
class DlMySqlRecordset extends DlRecordset {
    /**
    * Executes the query
    *
    * Executes the SQL query and loads the data into a dataset/table
    * @param string $sql the SQL query to execute
    * @return boolean
    */
    function Open($sql) {          // initialize some members and open the result set
        $this->mResultSet = null;                  // initialize to Null
        $this->mSql = $sql;
        mysql_select_db($this->mDbName);
        $this->mResultSet = mysql_query($this->mSql, $this->mDbCon);

        if (!$this->mResultSet)                    // query failed
        {
            $this->mErrMsg = "There was an error executing this query: '$this->mSql'.<br>MySQL said: " . mysql_errno($this->mDbCon) . ":" . mysql_error($this->mDbCon);
            return (false);
         }

        $this->mColumnCount = mysql_num_fields($this->mResultSet);
        $this->mRowCount = mysql_num_rows($this->mResultSet);
        $this->LoadData();
        $this->MoveFirst();
        return (true);
    } // function open

    /**
    * Loads all the rows
    *
    * Fetches all rows and loads them into the local dataset
    */
    function LoadData() {
        $this->mDataSet = array();
        while ($row = mysql_fetch_array($this->mResultSet, MYSQL_BOTH)) {
            array_push($this->mDataSet, $row);
        }

    }

    /**
    * Frees memory associated with the recordset
    *
    * Closes the recordset and frees associated memory
    * @return boolean
    */
    function Close()                         // free memory associated with the result set
    {
        if (!mysql_free_result($this->mResultSet))
        {
            $this->mErrMsg = "Could not free memory.";
            return (false);
        }

        return (true);
    } // function close
} // class DlMySQLRecordset
?>
