<?php  
$title = "Order Drinks";
require_once '../controllers/connection.php';
function get_content() {

    global $cn;
    $query = "SELECT * FROM beverages";
    $result = mysqli_query($cn, $query);
    $drinks = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<h2 class="center-align big-font animate__animated animate__tada">Order your Drinks Here</h2>
<div class="row">
    <?php foreach($drinks as $drink) : ?>
        <div class="col s4">
            <div class="card">
                <div class="card-image">
                    <img src="<?php echo $drink['bev_img']; ?>">
                    <span class="card-title big-font">
                        <?php echo $drink['name'] ;?>
                    </span>
                    <a href="#modal-<?php echo $drink['id'] ?>" class="btn-floating modal-trigger halfway-fab waves-effect waves-light red">
                        <i class="material-icons">add</i>
                    </a>
                    <div class="modal" id="modal-<?php echo $drink['id'] ?>">
                        <div class="modal-content">
                            Order <?php echo $drink['name'] ?>
                            <form action="../web.php" method="POST">
                                <input type="hidden" name="action" value="order">
                                <input type="hidden" name="drink_id" value="<?php echo $drink['id'] ?>">
                                <input type="hidden" name="name" value="<?php echo $drink['name'] ?>">
                                <input type="hidden" name="price" value="<?php echo $drink['bev_price'] ?>">
                                <input type="hidden" name="customer_id" value="<?php echo $_SESSION['user']['id'] ?>">
                                <div class="input-field">
                                    <input type="number" name="quantity" min="1">
                                    <label for="quantity">Quantity</label>
                                </div>
                                <div class="input-field">
                                    <input type="text" name="extras">
                                    <label for="extras">Anything you would like to add</label>
                                </div>
                                <div>
                                    <button class="btn waves-effect green darken-2">Confirm</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn modal-close waves-effect blue accent-2">Close</button>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <p class="norm">
                        <?php echo $drink['bev_desc']; ;?>
                    </p>
                    <strong>RM: <?php echo $drink['bev_price']; ?></strong>
                </div>
            </div>
        </div>
    <?php endforeach ;?>
 </div>






<?php 
}
require_once 'layout.php';
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let modal = document.querySelectorAll('.modal');
        let start = M.Modal.init(modal, {});

        <?php if(isset($_SESSION['message'])): ?>
        Swal.fire({
            title: '<?php echo $_SESSION['title'] ?>',
            text: '<?php echo $_SESSION['message'] ?>',
            icon: '<?php echo $_SESSION['icon'] ?>',
            confirmButtonText: '<?php echo $_SESSION['button'] ?>'
        })
        <?php endif; ?>

        setTimeout(() => {
            <?php unset($_SESSION['title']) ?>
            <?php unset($_SESSION['message']); ?>
            <?php unset($_SESSION['icon']); ?>
            <?php unset($_SESSION['button']); ?>
        }, 3000)
    })
</script>