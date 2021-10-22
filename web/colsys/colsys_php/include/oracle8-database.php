<?php
define('dbOracle', 'yes');
// $Id: oracle8-database.php,v 1.6 2002/10/23 18:31:00 alarion Exp $
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
class DlOracleDatabase extends DlDatabase {
    /**
    * Constructor
    *
    * Calls the parent constructor and sets the database type
    */
    function DlOracleDatabase($userName= "", $password = "", $databaseName = "", $serverName = "") {
        $this->DlDatabase($userName, $password, $databaseName, $serverName);
        $this->mDbType = "Oracle";
    }
    /**
    * Open the database connection
    *
    * Open the database connection
    * @return boolean
    */
    function Open() {
        $this->mDbCon = OCIPLogon($this->mUserName, $this->mPassword, $this->mDbName);
        if (!$this->mDbCon) {
            $this->mErrMsg = "Could not login in to the Oracle8 server. : "; // add the O8 error code here as well.
            return (false);
        }

        return (true);
    } // function open
    /**
    * Close the database connection
    *
    * Close the database connection
    * @return boolean
    */
    function Close() {
        if (!OCILogOff($this->mDbCon)) {
            $this->mErrMsg = "Could not logoff the Oracle 8 server.";
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
        $temp = OCIParse($this->mDbCon, $sql);
        OCIExecute($temp);
        return (true);
    } // function execute
} // class Oracle8Database
?>