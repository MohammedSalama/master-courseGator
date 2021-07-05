<?php 

include("../global.php");

include("$root/admin/inc/db-connect.php");

if($request->getHas('id'))
{
    $id = $request->get('id')
    ;

    // $sql = "DELETE FROM cats WHERE id = $id";
    $isDeleted = delete(
        $conn ,
        "cats" ,
        "id = $id"
    );

    if ($isDeleted)
    {
        //redirect back with success message 
        $session->set('success' , "You Deleted Category Successfully");


    }
    
    header("location: all-categories.php");
}

?>