<?php 
if(isset($_SESSION['user']) && $_SESSION['user']['isCustomer'] == 1) {
    global $cn;
$id = $_SESSION['user']['id'];
$query = "SELECT id FROM tables WHERE customer_id = $id";
$table_id = mysqli_fetch_assoc(mysqli_query($cn, $query));
if(isset($table_id)) {
$table_id = intval($table_id['id']);
$query2 = "SELECT id FROM orders WHERE table_id = $table_id";
$order = mysqli_fetch_assoc(mysqli_query($cn, $query2));
}
}
?>
<nav class="deep-orange">
<a href="#" data-target="slide-out" class="sidenav-trigger white-text"><i class="large material-icons">menu</i></a>
<div class="nav-wrapper">
    <div class="container">
        <a href="/" class="brand-logo waves-effect">Home</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php if(!isset($_SESSION['user'])): ?>
                <li>
                    <a href="/views/register.php" class="waves-effect">Register</a>
                </li>
                <li>
                    <a href="/views/login.php" class="waves-effect">Login</a>
                </li>
            <?php endif ;?>
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['isCustomer'] == 1): ?>
                <li>
                    <a class="dropdown-trigger" data-target="dropdown1">
                        Order Now
                        <i class="material-icons right">arrow_drop_down</i></a>
                </li>
            <?php if(isset($order)): ?>
                <li>
                    <a href="/views/pay.php" class="waves-effect">
                        Pay Now
                    </a>
                </li>
            <?php endif ;?>
            <?php endif ;?>
            <?php if(isset($_SESSION['user']) && $_SESSION['user']['isCustomer'] == 0): ?>
                <li>
                    <a class="waves-effect" href="/views/viewall.php">View All</a>
                </li>
            <?php endif ;?>
            <?php if(isset($_SESSION['user'])): ?>
            <li>
                <a href="/web.php/logout" class="waves-effect">Logout</a>
                <span class="white-text name"><?php echo $_SESSION['user']['name'] ;?></span>
            </li>
            <?php endif ;?>
        </ul>
    </div>
</div>
<ul id="dropdown" class="dropdown-content">
    <li><a href="/views/foods.php">Order Food</a></li>
    <li class="divider"></li>
    <li><a href="/views/drinks.php">Order Drinks</a></li>
</ul>
<ul id="dropdown1" class="dropdown-content">
    <li><a href="/views/foods.php">Order Food</a></li>
    <li class="divider"></li>
    <li><a href="/views/drinks.php">Order Drinks</a></li>
</ul>

</nav>
<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view">
            <?php if(isset($_SESSION['user'])): ?>
            <div class="background">
                <img src="../../assets/images/sidenavbg.jpg">
            </div>
            <!-- <a href="#user"><img src="" class="circle"></a> -->
            <a href="#name"><span class="white-text name"><?php echo $_SESSION['user']['name'] ;?></span></a>
            <a href="#email"><span class="white-text email"><?php echo $_SESSION['user']['username'] ;?></span></a>
            <?php endif ;?>
        </div>
    </li>
    <?php if(!isset($_SESSION['user'])) :?>
    <li>
        <a href="/views/register.php" class="waves-effect">Register</a>
    </li>
    <li><div class="divider"></div></li>
    <li>
        <a href="/views/login.php" class="waves-effect">Login</a>
    </li>
    <li><div class="divider"></div></li>
    <?php endif ;?>

            <?php if(isset($_SESSION['user']) && $_SESSION['user']['isCustomer'] == 1): ?>
                <li>
                    <a class="dropdown-trigger" data-target="dropdown">
                        Order Now
                        <i class="material-icons right">arrow_drop_down</i></a>
                </li>
            <?php if(isset($order)): ?>
                <li>
                    <a href="/views/pay.php" class="waves-effect">
                        Pay Now
                    </a>
                </li>
            <?php endif ;?>
            <?php else: ?>
                <li>
                    <a class="waves-effect" href="/views/viewall.php">View All</a>
                </li>
            <?php endif ;?>
    <?php if(isset($_SESSION['user'])): ?>
    <li>
        <a href="/web.php/logout" class="waves-effect">Logout</a>
    </li>
    <?php endif ;?>
</ul>


