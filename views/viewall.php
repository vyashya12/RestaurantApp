<?php 
$title = "View All";
require_once '../controllers/connection.php';
function get_content() {
    global $cn;
    $query = "SELECT * FROM food";
    $result = mysqli_query($cn, $query);
    $foods = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    $query1 = "SELECT * FROM beverages";
    $result = mysqli_query($cn, $query1);
    $drinks = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h2 class="center-align big-font animate__animated animate__tada">Edit Food</h2>
    <div class="row">
        <?php foreach($foods as $food) : ?>
            <div class="col s4">
                <div class="card">
                    <div class="card-image">
                        <img src="<?php echo $food['food_img']; ?>">
                        <span class="card-title big-font">
                            <?php echo $food['name'] ;?>
                        </span>
                        <a href="" class="btn-floating halfway-fab waves-effect waves-light red">
                            <i class="material-icons">add</i>
                        </a>
                    </div>
                    <div class="card-content">
                        <p class="norm">
                            <?php echo $food['intro']; ;?>
                        </p>
                        <strong>RM: <?php echo $food['price'] ;?></strong>
                        <a href="/views/edit.php?id=<?php echo $food['id']; ?>" 
                        class="btn waves-effect yellow darken-2">View</a>
                    </div>
                </div>
            </div>
        <?php endforeach ;?>
     </div>

<h2 class="center-align big-font animate__animated animate__tada">Edit Drinks</h2>
<div class="row">
    <?php foreach($drinks as $drink) : ?>
        <div class="col s4">
            <div class="card">
                <div class="card-image">
                    <img src="<?php echo $drink['bev_img']; ?>">
                    <span class="card-title big-font">
                        <?php echo $drink['name'] ;?>
                    </span>
                    <a href="" class="btn-floating halfway-fab waves-effect waves-light red">
                        <i class="material-icons">add</i>
                    </a>
                </div>
                <div class="card-content">
                    <p class="norm">
                        <?php echo $drink['bev_desc']; ;?>
                    </p>
                    <strong>RM: <?php echo $drink['bev_price']; ?></strong>
                    <a href="/views/edit.php?idd=<?php echo $drink['id']; ?>" 
                    class="btn waves-effect yellow darken-2">View</a>
                </div>
            </div>
        </div>
    <?php endforeach ;?>
 </div>



<?php 
}
require_once 'layout.php';
?>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        let elems = document.querySelectorAll('.modal');
        let instances = M.Modal.init(elems, {});
    })
</script>