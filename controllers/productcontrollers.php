<?php 

function add_food($request) {
    global $cn;

    $name = $request['name'];
    $price = $request['price'];
    $desc = $request['desc'];
    $img = "";
    $errors = 0;

    

    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    $upload_dir = "/public/";
    $img = $upload_dir.$_FILES['img']['name'];

    
    if(strlen($name) < 4) {
        echo "Food Name must be greater than 4 characters";
        $errors++;
    }

    if(strlen($desc) < 10) {
        echo "Food Description must be greater than 10 characters";
        $errors++;
    }

    if($price < 1) {
        echo "Please enter a number greater than 1";
        $errors++;
    } 

    $file_name = $_FILES['img']['name'];
    $temp_name = $_FILES['img']['tmp_name'];
    $file = pathinfo($img, PATHINFO_EXTENSION);

    if(in_array($file, $extensions)) {
        move_uploaded_file($temp_name, $_SERVER['DOCUMENT_ROOT'].$upload_dir.$file_name);
    } else {
        echo "File type not supported";
        $errors++;
    }
    
    if($errors == 0) {
        $query1 = "INSERT INTO food (name, intro, price, food_img)
                    VALUES ('$name', '$desc', $price, '$img')";
        mysqli_query($cn, $query1);
        mysqli_close($cn);
    
        session_start();
    
        $_SESSION['title'] = "Item Added";
        $_SESSION['message'] = "Food Added Succesfully";
        $_SESSION['icon'] = "success";
        $_SESSION['button'] = "Cool";
        header('Location: /');
    }
}

function add_drink($request) {
    global $cn;

    $name = $request['name'];
    $price = $request['price'];
    $desc = $request['desc'];
    $img = "";
    $errors = 0;

    

    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    $upload_dir = "/public/";
    $img = $upload_dir.$_FILES['img']['name'];

    
    if(strlen($name) < 4) {
        echo "Drink Name must be greater than 4 characters";
        $errors++;
    }

    if(strlen($desc) < 10) {
        echo "Drink Description must be greater than 10 characters";
        $errors++;
    }

    if($price < 1) {
        echo "Please enter a number greater than 1";
        $errors++;
    } 

    $file_name = $_FILES['img']['name'];
    $temp_name = $_FILES['img']['tmp_name'];
    $file = pathinfo($img, PATHINFO_EXTENSION);

    if(in_array($file, $extensions)) {
        move_uploaded_file($temp_name, $_SERVER['DOCUMENT_ROOT'].$upload_dir.$file_name);
    } else {
        echo "File type not supported";
        $errors++;
    }
    
    if($errors == 0) {
        $query2 = "INSERT INTO beverages (name, bev_desc, bev_price, bev_img)
                    VALUES ('$name', '$desc', $price, '$img')";
        mysqli_query($cn, $query2);
        mysqli_close($cn);
    
        session_start();
    
        $_SESSION['title'] = "Item Added";
        $_SESSION['message'] = "Drink Added Succesfully";
        $_SESSION['icon'] = "success";
        $_SESSION['button'] = "Cool";
        header('Location: /');
    }
}

function remove_drink($request) {
    global $cn;
    $drink_id = $request['id'];

    $query4 = "DELETE FROM beverages WHERE id = $drink_id";
    mysqli_query($cn, $query4);
    mysqli_close($cn);

    session_start();
    
    $_SESSION['title'] = "Drink Deleted";
    $_SESSION['message'] = "Drink Deleted Succesfully";
    $_SESSION['icon'] = "success";
    $_SESSION['button'] = "Cool";
    header('Location: /');

}

function remove_food($request) {
    global $cn;
    $food_id = $request['id'];

    $query3 = "DELETE FROM food WHERE id = $food_id";
    mysqli_query($cn, $query3);
    mysqli_close($cn);

    session_start();
    
    $_SESSION['title'] = "Food Deleted";
    $_SESSION['message'] = "Food Deleted Succesfully";
    $_SESSION['icon'] = "success";
    $_SESSION['button'] = "Cool";
    header('Location: /');

    
}

function edit_food($request) {
    global $cn;

    $food_id = $request['id'];
    $name = $request['name'];
    $intro = $request['intro'];
    $price = $request['price'];

    $errors = 0;
    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    $upload_dir = "/public/";
    $img = $upload_dir.$_FILES['img']['name'];


    if(strlen($name) < 4) {
        echo "Food Name must be greater than 4 characters";
        $errors++;
    }

    if(strlen($intro) < 10) {
        echo "Food Description must be greater than 10 characters";
        $errors++;
    }

    if($price < 1) {
        echo "Please enter a number greater than 1";
        $errors++;
    } 

    $file_name = $_FILES['img']['name'];
    $temp_name = $_FILES['img']['tmp_name'];
    $file = pathinfo($img, PATHINFO_EXTENSION);

    if(in_array($file, $extensions)) {
        move_uploaded_file($temp_name, $_SERVER['DOCUMENT_ROOT'].$upload_dir.$file_name);
    } else {
        $img = $request['old_img'];
    }
    
    if($errors == 0) {
        $query5 = "UPDATE food SET name = '$name', intro = '$intro', price = $price, food_img = '$img'
                    WHERE id = $food_id";
        mysqli_query($cn, $query5);
        mysqli_close($cn);
    
        session_start();
    
        $_SESSION['title'] = "Item Edited";
        $_SESSION['message'] = $name." Edited Succesfully";
        $_SESSION['icon'] = "success";
        $_SESSION['button'] = "Cool";
        header('Location: /');
    
    }
    //stopped here yesterday food edit then drink edit then automate table and orders
    //then add a session msg for the delete tmr
}

function edit_drink($request) {
    global $cn;

    $drink_id = $request['id'];
    $name = $request['name'];
    $intro = $request['intro'];
    $price = $request['price'];

    $errors = 0;
    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
    $upload_dir = "/public/";
    $img = $upload_dir.$_FILES['img']['name'];


    if(strlen($name) < 4) {
        echo "Drink Name must be greater than 4 characters";
        $errors++;
    }

    if(strlen($intro) < 10) {
        echo "Drink Description must be greater than 10 characters";
        $errors++;
    }

    if($price < 1) {
        echo "Please enter a number greater than 1";
        $errors++;
    } 

    $file_name = $_FILES['img']['name'];
    $temp_name = $_FILES['img']['tmp_name'];
    $file = pathinfo($img, PATHINFO_EXTENSION);

    if(in_array($file, $extensions)) {
        move_uploaded_file($temp_name, $_SERVER['DOCUMENT_ROOT'].$upload_dir.$file_name);
    } else {
        $img = $request['old_img'];
    }
    
    if($errors == 0) {
        $query6 = "UPDATE beverages SET name = '$name', bev_desc = '$intro', bev_price = $price, bev_img = '$img'
                    WHERE id = $drink_id";
        mysqli_query($cn, $query6);
        mysqli_close($cn);
    
        session_start();
    
        $_SESSION['title'] = "Item Edited";
        $_SESSION['message'] = $name." Edited Succesfully";
        $_SESSION['icon'] = "success";
        $_SESSION['button'] = "Cool";
        header('Location: /');
    
    }
}

function book_table($request) {
    global $cn;
    date_default_timezone_set('Asia/Kuala_Lumpur');

    $id = $request['customer_id'];
    $date = $request['date'];
    date('Y-m-d', strtotime($date));
    $time = $request['time'];
    $people = $request['people'];

    $query8 = "SELECT * FROM tables WHERE customer_id = $id";
    $table = mysqli_fetch_assoc(mysqli_query($cn, $query8));

    if(isset($table)) {
        session_start();

        $_SESSION['title'] = "Error";
        $_SESSION['message'] = "You already booked a table";
        $_SESSION['icon'] = "error";
        $_SESSION['button'] = "Cool";
        header('Location: /');

    } else {

        $query7 = "INSERT INTO tables(customer_id, date, time, paxs)
                    VALUES($id, '$date', '$time', $people)";
        mysqli_query($cn, $query7);
        mysqli_close($cn);

        session_start();

        $_SESSION['title'] = "Table Booked";
        $_SESSION['message'] = "Succesfully booked a table. You can Order Now";
        $_SESSION['icon'] = "success";
        $_SESSION['button'] = "Cool";
        header('Location: /');
    }
}

function order($request) {
    if(isset($request['food_id'])) {
        global $cn;

        $food = $request['name'];
        $customer = $request['customer_id'];
        $food_id = intval($request['food_id']);
        $food_quantity = intval($request['quantity']);
        $food_extra = $request['extras'];
        $amount = intval($request['price']) * $food_quantity;
        $bev = 0;

        $query9 = "SELECT id FROM tables WHERE customer_id = $customer";
        $table_id = mysqli_fetch_assoc( mysqli_query($cn, $query9));
        $table_id = intval($table_id['id']);

        $queryS = "SET foreign_key_checks = 0";
        mysqli_query($cn, $queryS);

        $query10 = "INSERT INTO orders (food_id, bev_id, quantity, extras, table_id, amount)
                    VALUES ($food_id, $bev, $food_quantity, '$food_extra', $table_id, $amount)";
        
        mysqli_query($cn, $query10);
        mysqli_close($cn);

        session_start();

        $_SESSION['title'] = "Food Ordered";
        $_SESSION['message'] = "Succesfully Ordered $food";
        $_SESSION['icon'] = "success";
        $_SESSION['button'] = "Cool";
        header('Location: '. $_SERVER['HTTP_REFERER']);

    }

    if(isset($request['drink_id'])) {
        global $cn;

        $customer = $request['customer_id'];
        $drink = $request['name'];
        $drink_id = intval($request['drink_id']);
        $drink_quantity = intval($request['quantity']);
        $drink_extra = $request['extras'];
        $amount = intval($drink_quantity) * $request['price'];
        $food = 0;

        $query11 = "SELECT id FROM tables WHERE customer_id = $customer";
        $table_id = mysqli_fetch_assoc(mysqli_query($cn, $query11));
        $table_id = intval($table_id['id']);

        $queryF = "SET foreign_key_checks = 0";
        mysqli_query($cn, $queryF);

        $query12 = "INSERT INTO orders (food_id, bev_id, quantity, extras, table_id, amount)
                    VALUES ($food, $drink_id, $drink_quantity, '$drink_extra', $table_id, $amount)";

        mysqli_query($cn, $query12);
        mysqli_close($cn);

        session_start();

        $_SESSION['title'] = "Drink Ordered";
        $_SESSION['message'] = "Succesfully Ordered $drink";
        $_SESSION['icon'] = "success";
        $_SESSION['button'] = "Cool";
        header('Location: '. $_SERVER['HTTP_REFERER']);
    }
}

function records($request) {
    global $cn;
    $date = date('Y-m-d');
    $total = intval($request['amount']);
    $table = intval($request['table_id']);

    //Inserting the table id and amount and date payed to the records table
    $query13 = "INSERT INTO records (table_id, amount, date)
                 VALUES ($table, $total, '$date')";
    mysqli_query($cn, $query13);

    //Deleting the orders since its payed
    $query14 = "DELETE FROM orders WHERE table_id = $table";
    mysqli_query($cn, $query14);

    // // Delete the table so that other people can use the table
    $query15 = "DELETE FROM tables WHERE id = $table";
    mysqli_query($cn, $query15);
    mysqli_close($cn);

    session_start();

    $_SESSION['title'] = "Bill Paid";
    $_SESSION['message'] = "Succesfully Paid Bill";
    $_SESSION['icon'] = "success";
    $_SESSION['button'] = "Cool";

}


?>