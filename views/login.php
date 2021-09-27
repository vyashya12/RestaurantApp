<?php  
$title = "Login";
function get_content() {
?>

<br>
<style>
    main {
        height: 78vh;
    }
</style>
<div class="container">
    <div class="row">
        <form action="../web.php" method="POST" class="col s6 offset-s3">
        <input type="hidden" name="action" value="login">
            <div class="input-field">
                <input type="text" name="username">
                <label for="username">Username</label>
            </div>
            <div class="input-field">
                <input type="password" name="password">
                <label for="password">Password</label>
            </div>
            <button class="btn waves-effect light-green accent-3">Login</button>
        </form>
    </div>
</div>



<?php 
}
require_once 'layout.php';
?>