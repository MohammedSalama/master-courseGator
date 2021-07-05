<?php 

include("../global.php");
include("$root/admin/inc/db-connect.php");

if($request->getHas('id'))
{
    $id = $request->get('id');
    $imgOldName = $request->get('imgOldName');
    
    unlink("../uploads/courses/$imgOldName");
    // $sql = "DELETE FROM courses WHERE id = $id";
    $isDeleted = delete(
        $conn ,
        "courses" ,
        "id = $id"
    );

    if ($isDeleted)
    {
        //redirect back with success message 
        $session->set('success' , "You Deleted Course Successfully");


    }
    
    header("location: all-courses.php");
}

?>