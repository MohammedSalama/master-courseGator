<?php 

include("../../global.php");
include("$root/admin/inc/db-connect.php");

if($request->postHas('submit'))
{
    $email = mysqli_real_escape_string($conn , $request->postClean('email'));
    $password =  mysqli_real_escape_string($conn , $request->postClean('password'));

    //validation
    $errors = [];

    //email:required | email | max:255
    $errors[] =  validateEmail($email);


    //password: required | string | min: 5 | max: 50
    if(empty($password))
    {
        $errors[] = "password is required";
    }
        elseif (! is_string($password))
    {
        $errors[] = "password must be string ";
    }
    elseif (strlen($password) < 5 or strlen($password) > 50)
    {
        $errors[] = "password lenght between 5 and 50 characters";
    }


    $errors = cleanErrors($errors);


    if(empty($errors))
    {
        //select row by email
        $sql = "SELECT * FROM admins WHERE email = '$email' ";
        $result = mysqli_query($conn , $sql);

        if (mysqli_num_rows($result) > 0)
        {
            $admin = mysqli_fetch_assoc($result);
                if (password_verify($password , $admin['password']) )
                {
                    //save user data in session and redirect to admin/index
                     $_SESSION['adminId'] = $admin['id'];
                     $_SESSION['adminName'] = $admin['name'];
                     $_SESSION['isLogin'] = true;

                     header("location:../index.php");
                }else{
                    $_SESSION['loginError'] = "password is not correct";
                    header("location:../login.php");
                }
            }
        else
        {
            // $_SESSION['loginError'] = "email is not registered";
            $session->set('loginError' , "email is not registered");
            header("location:../login.php");
        }
    }
    else
    {
        $session->set('errors' , $errors);
        
        header("location:../login.php");
    }
}
?>