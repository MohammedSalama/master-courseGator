<?php 

class Db 
{
    private $conn;
    public function __construct($servername , $username , $password , $dbname)
    {
        $this->conn = mysqli_connect($servername , $username , $password , $dbname);
    }
        function insert($table , $fields , $values)
    {
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        $isInserted = mysqli_query($this->conn , $sql);
        
        return $isInserted;
    }

    function update($table , $set , $condition)
    {
        $sql = "UPDATE $table SET $set WHERE $condition";
        $isUpdated = mysqli_query($this->conn , $sql);
        
        return $isUpdated;
    }

    function delete($table , $condition)
    {
        $sql = "DELETE FROM $table WHERE $condition";
        $isDeleted = mysqli_query($this->conn , $sql);

        return $isDeleted;
        
    }

        function select($fields , $table , $others = null)
    {
        $sql = "SELECT $fields FROM $table";

        //if others added , then concat to the query 
        if ($others !== null)
        {
            $sql .= " $others";
        }
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $rows = mysqli_fetch_all($result , MYSQLI_ASSOC);
        } else {
            $rows = [];
        }

        return $rows;
    }

    function selectOne( $fields , $table , $others = null)
    {
        $sql = "SELECT $fields FROM $table";

        //if others added , then concat to the query 
        if ($others !== null)
        {
            $sql .= " $others";
        }

        $sql .= " LIMIT 1";
        
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
        } else {
            $row = [];
        }

        return $row;
    }

    function selectJoin($fields , $tables , $on , $others = null)
    {
        $sql = "SELECT $fields FROM $tables ON $on";

        //if others added , then concat to the query 
        if ($others !== null)
        {
            $sql .= " $others";
        }
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $rows = mysqli_fetch_all($result , MYSQLI_ASSOC);
        } else {
            $rows = [];
        }

        return $rows;
    }

    function selectJoinOne($fields , $tables , $on , $others = null)
    {
        $sql = "SELECT $fields FROM $tables ON $on ";

        //if others added , then concat to the query 
        if ($others !== null)
        {
            $sql .= " $others";
        }

        $sql .= " LIMIT 1";
        
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // output data of each row
            $row = mysqli_fetch_assoc($result);
        } else {
            $row = [];
        }

        return $row;
    }
}

?>