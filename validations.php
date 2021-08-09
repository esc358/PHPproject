<?php

function is_logged_in()
{
    return isset($_SESSION['user_id']); //checks whether variable is set/declared
}

function require_login()
{
    if(!is_logged_in()) //not logged in therefore redirect to login php
    {
        header("Location:login.php");
        exit;
    }
}

function validate_game($game){ //function to catch user input errors
    $errors = [];
    // check if all inputs are valid
    $player = $game['player'];
    if (empty($player)) {
        $errors['player'] = "Please enter a player";
    } else if(strlen($player) > 50){
        $errors['player'] = "Player name only has 50 characters";
    }

    $comments = $game['comments'];
    if (empty($comments)) {
        $errors['comments'] = "Please enter a comment";
    }

    //level validation
    $level_regex = "/([1-9]|[1-9][0-9]|100)/";
    $level = $game['level'];

    if ($level < 0 || $level > 100 || !preg_match($level_regex, $level))
    {
        $errors['level'] = "Please enter a valid level between 1-100";
    }
    return $errors;
}

function validate_image($size, $type, $name){
    $errors = [];
     // check if all inputs are valid
     if($size > 100000)
     {
         $errors['pic'] = "Img must be less than 1MB";
     }
     
     if(!($type == 'image/jpeg' || $type == 'image/png'))
     {
         $errors['pic'] = "Image formate must be .jpeg or png.";
     }
     if(empty($name))
     {
         $errors['pic'] = "Image is empty";
     }
    return $errors;
}

function validate_registration($user, $conn){
    $errors = [];

        if(empty(trim($user['email']))){
            $errors['email'] = "Email cannot be blank";
        }

        $email_regex = "/.+\@.+\..+/";
        if(!preg_match($email_regex, $user['email'])){
            $errors['email'] = "Username email must be valid";
        }

        if(empty(trim($user['new-password']))){
            $errors['password'] = "Password cannot be blank";
        }

        if(empty(trim($user['confirm-password']))){   
            $errors['confirm'] = "Confirm password cannot be blank";
        }

        $sql = "SELECT * FROM users_dota WHERE username='" . $user['email'] . "'";
        $cmd = $conn -> prepare($sql);
        $cmd -> execute();
        $found_username = $cmd -> fetch();

        if($found_username){
            $errors['email'] = 'Username already taken';
        }
    return $errors;
}


function display_toast($t, $msg)
{
    if(!($t && $msg) || $t>4)
    {
        return;
    }
    $msgs = [];
    $msgs ['3'] = "Successfuly Added";
    $msgs ['1'] = "Successfuly Deleted";
    $msgs ['2'] = "Successfuly Edited";
    return;
}