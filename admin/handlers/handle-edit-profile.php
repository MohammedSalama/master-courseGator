<?php 

include("../../global.php");
include("$root/admin/inc/db-connect.php");

if($request->postHas('submit'))
{
    $id = $session->get('adminId');
    $name = mysqli_real_escape_string($conn , $request->postClean('name'));
    $email = mysqli_real_escape_string($conn , $request->postClean('email'));
    $password = $request->post('password');
    $confirm_password = $request->post('confirm_password');


    //validation
    $errors = [];

    //name:required | name | max:255
    $errors[] = cleanErrors($errors);
    

      //email:required | email | max:255
      $errors[] =  validateEmail($email);

      //password: 
      if(! empty($password))
      {
        if (! is_string($password) )
        {
            $errors[] = "password must be string";
        }
        elseif (strlen($password) < 5 or strlen($password) > 50)
        {
            $errors[] = "password lenght between 5 and 50 characters";
        }
        elseif($password != $confirm_password)
        {
            $errors[] = "password and confirm doesn't match";
        }
        $hashedPassword = password_hash($password , PASSWORD_DEFAULT);
    }

    $errors = cleanErrors($errors);


    if(empty($errors))
    {
        //insert data in reservation system
        if(! empty($password))
        {
              $isUpdated = update(
                $conn , 
                "admins" , 
                "name = '$name' , 
                email = '$email' , 
                `password` = '$hashedPassword'" ,
                "id = $id"
            );
        }
        else
        {
            $isUpdated = update(
                $conn , 
                "admins" , 
                "name = '$name' , 
                email = '$email' ", 
                "id = $id"
            );

        }

        if ($isUpdated)
        {
            //redirect back with success message 
            $session->set('success' , "You Updated Profile Successfully");
            $session->set('adminName' , $name);
        }

        mysqli_close($conn);

    }
    else
    {
        //store errors in sessions 
        $session->set('errors' , $errors);
    }
    header("location:../edit-profile.php");
}

?>