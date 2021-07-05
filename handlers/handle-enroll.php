<?php

include("../global.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coursegator";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if($request->postHas('submit'))
{
    $name = mysqli_real_escape_string($conn , $request->postClean('name'));
    $email = mysqli_real_escape_string($conn , $request->postClean('email'));
    $phone = mysqli_real_escape_string($conn , $request->postClean('phone'));
    $spec = mysqli_real_escape_string($conn , $request->postClean('spec'));
    $course_id = mysqli_real_escape_string($conn , $request->postClean('course_id'));

    //validation
    $errors = [];

    //name:required | string | max:255
   $errors[] = validateName($name);


    //email:required | email | max:255
  $errors[] =  validateEmail($email);

}
    //phone: required | string | max:255
    if(empty($phone))
    {
        $errors[] = "phone is required";
    }
        elseif (! is_string($phone))
    {
        $errors[] = "phone must be string containing characters";
    }
        elseif (strlen($phone) > 255)
    {
        $errors[] = "phone lenght should not exceed 255 characters";
    }


    //spec:string | max:25
    if (! empty($spec))
    {
        if (! is_string($spec))
        {
            $errors[] = "spec must be string containing characters";
        }
            elseif (strlen($spec) > 255)
        {
            $errors[] = "spec lenght should not exceed 255 characters";
        }
    }

//course_id: required | [in:courses.id]
if(empty($course_id))
{
    $errors[] = "course id is required";
}

$errors = cleanErrors($errors);


if(empty($errors))
{
    //insert data in reservation table 
    $isInserted = insert(
        $conn , 
        "reservations" , "name , email , phone , spec , course_id" , 
        "'$name' , '$email' , '$phone' , '$spec' , '$course_id'"
    );
    
    if ($isInserted)
    {
        //redirect back with success message 
        $_SESSION['success'] = "You enrolled to course Successfully";
        header("location: ../enroll.php");

    }else
    {
        $_SESSION['queryError'] = "error happened while storing , please try again";
        header("location:../enroll.php");

    }
    
    mysqli_close($conn);
    
} else 
{
    //store errors in sessions 
    $_SESSION['errors'] = $errors;
    header("location: $url " . " enroll.php");
}

?>