<?php // $Id: odbc-database.php,v 1.5 2002/10/13 07:24:14 alarion Exp $
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

define('dbODBC', 'yes');
class DlOdbcDatabase extends DlDatabase
{
    /**
    * Constructor
    *
    * Calls the parent constructor and sets the database type
    */
    function DlOdbcDatabase($userName= "", $password = "", $databaseName = "", $serverName = "") {
        $this->DlDatabase($userName, $password, $databaseName, $serverName);
        $this->mDbType = "ODBC";
    }
    /**
    * Open the database connection
    *
    * Open the database connection
    * @return boolean
    */
    function Open() {
        $this->mDbCon = odbc_connect($this->mDbName, $this->mUserName, $this->mPassword);
        if (!$this->mDbCon) {
            $this->mErrMsg = "Could not connect to the ODBC database. Please verify the DSN, User Name and Password are correct!";
            return (false);
        }

        return (true);
    } // function open()
    /**
    * Close the database connection
    *
    * Close the database connection
    * @return boolean
    */
    function Close() {
        if (!odbc_close($this->mDbCon)) {
            $this->mErrMsg = "Could not close connection to the ODBC database.";
            return (false);
        }
        return (true);
    } // function close()
    /**
    * Execute a sql query to the database
    *
    * Execute a sql query to the database, use this for queries that don't return a result set
    * @param string $sql the sql query to be executed
    * @return boolean
    */
    function Execute($sql) {
        $result = odbc_exec($this->mDbCon, $sql);
        if (!$result) {
            $this->mErrMsg = "Could not execute SQL statement: $sql.";
            return (false);
        } else return (true);
    } // function execute
} // class ODBCDatabase
?>
