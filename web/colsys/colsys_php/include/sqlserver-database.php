<?php // $Id: sqlserver-database.php,v 1.5 2002/10/13 07:24:14 alarion Exp $
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

define('dbMSSQL', 'yes');
class DlSqlServerDatabase extends DlDatabase {
    /**
    * Open the database connection
    *
    * Open the database connection
    * @return boolean
    */
    function Open() {
        $this->mDbCon = mssql_connect($this->mServer, $this->mUserName, $this->mPassword);
        if (!$this->mDbCon) {
         $this->mErrMsg = "Could not connect to the MS SQL Server.";
         return(false);
        }

        if (!mssql_select_db($this->mDbName)) {
         $this->mErrMsg = "Could not select the Database specified. Please check the spelling and permissions and try again.";
         return(false);
        }
        $this->mDbType = "MSSQL";
        return(true);
    }     // function open()
    /**
    * Close the database connection
    *
    * Close the database connection
    * @return boolean
    */
    function Close() {
        if(!mssql_close($this->DBCon)) {
            $this->mErrMsg = "Could not close connection to the MS SQL Server.";
            return(false);
        }
        return(true);
    } // function close()
    /**
    * Execute a sql query to the database
    *
    * Execute a sql query to the database, use this for queries that don't return a result set
    * @param string $sql the sql query to be executed
    * @return boolean
    */
    function Execute($sql) {
        $result = mssql_query($sql, $this->mDbCon);
        return(true);
    } // function execute
} // class DlSqlServerDatabase
?>
