<?php
define('rsSybase', 'yes');
// $Id: sybase-recordset.php,v 1.8 2002/10/27 18:02:40 alarion Exp $
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
class DlSybaseRecordset extends DlRecordset {


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
        $connection = $this->mDbConnection;
        $this->mDbName = $connection->mDbName;
        unset($connection);
        $this->mResultSet = sybase_query($this->mSql, $this->mDbCon);
        if (!$this->mResultSet) {                    // query failed
            $this->mErrMsg = "Query could not be executed";
            return(false);
        }
        $this->mColumnCount = sybase_num_fields($this->mResultSet);
        $this->mRowCount = sybase_num_rows($this->mResultSet);
        $this->LoadData();
        return true;
    } // function open


    /**
    * Loads all rows into array
    *
    * Loads the entire result set into an array
    */
    function LoadData() {
        $this->mDataSet = array();
        while ($row = sybase_fetch_array($this->mResultSet)) {
            array_push($this->mDataSet, $row);
        }

    } // function loaddata

    /**
    * Frees memory associated with the recordset
    *
    * Closes the recordset and frees associated memory
    * @return boolean
    */
    function Close() {
        if (!sybase_free_result($this->mResultSet)) {
            $this->mErrMsg = "Could not free memory.";
            return(false);
        }
        return(true);
    } // function close
} // class DlSybaseSQLRecordset
?>
