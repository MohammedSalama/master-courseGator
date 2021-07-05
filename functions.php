<?php

//validation

function validateEmail($email)

{
    if(empty($email))
    {
        return "email is required";
    }
    elseif (! filter_var($email , FILTER_VALIDATE_EMAIL))
    {
        return "email is not valid";
    }
    elseif (strlen($email) > 255)
    {
        return "email lenght should not exceed 255 characters";
    }

}


function validateName($name)
{
if(empty($name))
{
    return "name is required";
}
elseif (! is_string($name) or is_numeric($name))
{
    return "name must be string containing characters";
}
elseif (strlen($name) > 255)
{
    return "name lenght should not exceed 255 characters";
}
}


function cleanErrors($errors)
{
    foreach ($errors as $index => $error)
{
    if ($error == null)
    {
        unset($errors[$index]);
    }
}

    return $errors;
}


//database
function insert($conn ,$table , $fields , $values)
{
    $sql = "INSERT INTO $table ($fields) VALUES ($values)";
    $isInserted = mysqli_query($conn , $sql);
    
    return $isInserted;
}

function update($conn , $table , $set , $condition)
{
    $sql = "UPDATE $table SET $set WHERE $condition";
    $isUpdated = mysqli_query($conn , $sql);
    
    return $isUpdated;
}

function delete($conn , $table , $condition)
{
    $sql = "DELETE FROM $table WHERE $condition";
    $isDeleted = mysqli_query($conn , $sql);

    return $isDeleted;
    
}

function select($conn , $fields , $table , $others = null)
{
    $sql = "SELECT $fields FROM $table";

    //if others added , then concat to the query 
    if ($others !== null)
    {
        $sql .= " $others";
    }
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $rows = mysqli_fetch_all($result , MYSQLI_ASSOC);
    } else {
        $rows = [];
    }

    return $rows;
}

function selectOne($conn , $fields , $table , $others = null)
{
    $sql = "SELECT $fields FROM $table";

    //if others added , then concat to the query 
    if ($others !== null)
    {
        $sql .= " $others";
    }

    $sql .= " LIMIT 1";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
    } else {
        $row = [];
    }

    return $row;
}

function selectJoin($conn , $fields , $tables , $on , $others = null)
{
    $sql = "SELECT $fields FROM $tables ON $on";

    //if others added , then concat to the query 
    if ($others !== null)
    {
        $sql .= " $others";
    }
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $rows = mysqli_fetch_all($result , MYSQLI_ASSOC);
    } else {
        $rows = [];
    }

    return $rows;
}

function selectJoinOne($conn , $fields , $tables , $on , $others = null)
{
    $sql = "SELECT $fields FROM $tables ON $on ";

    //if others added , then concat to the query 
    if ($others !== null)
    {
        $sql .= " $others";
    }

    $sql .= " LIMIT 1";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // output data of each row
        $row = mysqli_fetch_assoc($result);
    } else {
        $row = [];
    }

    return $row;
}

?>