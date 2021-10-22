<?php
define('rsMSSQL', 'yes');
// $Id: sqlserver-recordset.php,v 1.6 2002/10/27 18:02:40 alarion Exp $
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
class DlSqlServerRecordset extends DlRecordset {


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
        /* Kludge: 10/11/2002 - Not exactly sure what the following three lines are for
         rather, why they are needed */
        $connection = $this->mDbConnection;
        $this->mDbName = $connection->mDbName;
        unset($connection);

        $this->mResultSet = mssql_query($this->mSql, $this->mDbCon);

        if (!$this->mResultSet) {                    // query failed
            $this->mErrMsg = "Query could not be executed";
            return(false);
        }

        $this->mColumnCount = mssql_num_fields($this->mResultSet);
        $this->mRowCount = mssql_num_rows($this->mResultSet);
        $this->LoadData();
        return true;
    } // function open

    /**
    * Load an array used internally for adding and updating
    *
    * Used internally to track changed/new rows in the dataset
    */
    function LoadData() {
        $this->mDataSet = array();
        while ($row = mssql_fetch_array($this->mResultSet)) {
            array_push($this->mDataSet, $row);
        }
    } // function loaddata

    /**
    * Gets the number of rows in the current result set
    *
    * Gets the number of rows in the current result set
    * @return boolean
    */
    function GetRowCount() {
        return $this->mRowCount;
    }

    /**
    * Frees memory associated with the recordset
    *
    * Closes the recordset and frees associated memory
    * @return boolean
    */
    function Close() {                        // free memory associated with the result set
        if (!mssql_free_result($this->mResultSet)) {
            $this->mErrMsg = "Could not free memory.";
            return(false);
        }
        return(true);
    } // function close
} // class DlSqlServerRecordset
?>
