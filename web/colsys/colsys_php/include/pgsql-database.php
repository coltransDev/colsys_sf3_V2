<?php
define('dbPGSQL', 'yes');
// $Id: pgsql-database.php,v 1.7 2002/10/27 18:02:40 alarion Exp $
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


class DlPgSqlDatabase extends DlDatabase {
    /**
    * Open the database connection
    *
    * Open the database connection
    * @return boolean
    */
    function Open() {
        $conn_string = "user=" . $this->mUserName . " password=" .  $this->mPassword . " dbname=" . $this->mDbName . " host=" . $this->mServer;
        $this->mDbCon = pg_connect(utf8_encode($conn_string));
        if (!$this->mDbCon) {
            $this->mErrMsg = "Could not connect to the PostgreSQL server.<br>PostgreSQL said: " . @pg_ErrorMessage($this->mDbCon);
            return (false);
        }
        $this->mDbType = "PGSQL";
        return (true);
    } // function open
    /**
    * Close the database connection
    *
    * Close the database connection
    * @return boolean
    */
    function Close() {
        if (!@pg_close($this->mDbCon)) {
            $this->mErrMsg = "Could not logoff the PostgreSQL server.";
            return (false);
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
//      if(!@pg_query($this->mDbCon, $sql)) {
        if(!@pg_Exec($this->mDbCon, $sql)) {
            $this->mErrMsg = "Error executing query: $SQL.<br>PostgreSQL said: " . @pg_ErrorMessage($this->mDbCon);
            return (false);
        }
        return (true);
    } // function execute
} // class PGSQLDatabase
?>