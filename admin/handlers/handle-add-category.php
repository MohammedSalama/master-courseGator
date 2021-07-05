<?php 

include("../../global.php");
include("$root/admin/inc/db-connect.php");



if($request->postHas('submit'))
{
    $name = mysqli_real_escape_string($conn , $request->postClean('name'));

    //validation
    $errors = [];

    //name:required | name | max:255

    $errors[] = validateName($name);
    $errors = cleanErrors($errors);

    if(empty($errors))
    {
        //insert data in reservation system
        $isInserted = insert(
            $conn , 
            "cats" , 
            "name" , 
            "'$name'"
        );
        if ($isInserted)
        {
            //redirect back with success message 
            $session->set('success' , "You added Category Successfully");

            header("location:../all-categories.php");

        }
        
        mysqli_close($conn);
        
    } else 
    {
        //store errors in sessions 
        $session->set('errors' , $errors);
        
        header("location: ../add-category.php");

    }

}

?>