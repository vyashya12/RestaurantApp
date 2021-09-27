<?php  

require_once 'connection.php';


//Register Function
function register($request) {
    global $cn;
    $errors = 0;
    $fullname = $request['name'];
    $username = $request['username'];
    $password = $request['password'];
    $password2 = $request['password2'];

    if(strlen($username) < 8) {
        echo "Username must be greater than 8 characters";
        $errors++;
    }

    if(strlen($password) < 8) {
        echo "Password must be greater than 8 characters";
        $errors++;
    }

    if($password != $password2) {
        echo "Password do not match";
        $errors++;
    }

    if($username) {
        $query = "SELECT username FROM users WHERE username = '$username'";
        $result = mysqli_fetch_assoc(mysqli_query($cn, $query));
        if($result) {
            echo "Username is already taken";
            $errors++;
            mysqli_close($cn);
        }
    }
    if($errors === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, username, password)
                   VALUES ('$fullname', '$username', '$password')";
        mysqli_query($cn, $query);
        mysqli_close($cn);
        header('Location: /');
    }
}

//Login Function
function login($request) {
    global $cn;
    $username = $request['username'];
    $password = $request['password'];
    session_start();

    $query = "SELECT * FROM users WHERE username = '$username'";
    $user = mysqli_fetch_assoc(mysqli_query($cn, $query));
    
    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        $_SESSION['title'] = "Succesfully Logged In!";
        $_SESSION['message'] = "Logged in successfully";
        $_SESSION['icon'] = "success";
        $_SESSION['button'] = "Cool";
        mysqli_close($cn);
        header('Location: /');
    } else {
        header('Location: /');
        $_SESSION['title'] = "Error";
        $_SESSION['message'] = "Please Log in with an existing account or sign up first";
        $_SESSION['icon'] = "error";
        $_SESSION['button'] = "Retry";
    }
}

//Logout Function
function logout() {
    session_start();

    session_unset();

    session_destroy();

    header('Location: /');
}


?>