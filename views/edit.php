<?php 
$title = "View";
require_once '../controllers/connection.php';
function get_content() {
    
    if(isset($_GET['id'])) {
        $food_id = intval($_GET['id']);
        global $cn;
        $queryf = "SELECT * FROM food WHERE id = $food_id" ;
        $food = mysqli_fetch_assoc(mysqli_query($cn, $queryf));
    }
    
    if(isset($_GET['idd'])) {
        $drink_id = intval($_GET['idd']);
        global $cn;
        $queryd = "SELECT * FROM beverages WHERE id = $drink_id";
        $drink = mysqli_fetch_assoc(mysqli_query($cn, $queryd));
    }
    ?>



<?php if(isset($_GET['id'])) : ?>
    <div class="container">
        <div class="row">
            <div class="col m6 offset-m3">
                <div class="card">
                    <div class="card-image">
                        <img src="<?php echo $food['food_img']; ?>">
                        <span class="card-title big-font">
                            <?php echo $food['name'] ;?>
                        </span>
                    </div>
                    <div class="card-content">
                        <p class="norm">
                            <?php echo $food['intro'] ;?>
                        </p>
                        <strong>
                            RM: <?php echo $food['price'] ;?>
                        </strong>
                    </div>
                    <div class="card-action">
                    <button data-target="modalEF"
                    class="btn modal-trigger waves-effect yellow darken-2">
                        Edit
                    </button>
                    <div id="modalEF" class="modal">
                        <div class="modal-content">
                            Edit Item
                            <form action="../web.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="edit_food">
                                <input type="hidden" name="id" value="<?php echo $food['id'] ?>">
                                <input type="text" name="name" value="<?php echo $food['name'] ?>">
                                <input type="text" name="intro" value="<?php echo $food['intro'] ?>">
                                <input type="number" name="price" value="<?php echo $food['price'] ?>">
                                <input type="hidden" name="old_img" value="<?php echo $food['food_img'] ?>">
                                <input type="file" name="img">
                                <div>
                                <br>
                                <button class="btn waves-effect green accent-3">
                                    Confirm
                                </button>
                                </div>
                            </form>
                        </div> 
                        <div class="modal-footer">
                            <button class="btn waves-effect modal-close blue accent-2">
                                Cancel
                            </button>
                        </div>
                    </div>
                    <button data-target="modalF" 
                       class="btn modal-trigger waves-effect red darken-3">
                        Delete
                       </button>
                       <div id="modalF" class="modal">
                            <div class="modal-content">
                                <h4>Delete Item</h4>
                                <p>Are you sure you want to delete <?php echo $food['name'];?></p>
                                <form action="../web.php" method="POST">
                                    <input type="hidden" name="action" value="removeF">
                                    <input type="hidden" name="id" value="<?php echo $food['id'] ?>">
                                    <button class="btn waves-effect red darken-3">
                                        Confirm
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn waves-effect modal-close blue accent-2">
                                    Cancel
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ;?>
<?php if(isset($_GET['idd'])) : ?>
    <div class="container">
        <div class="row">
            <div class="col m6 offset-m3 ">
                <div class="card">
                    <div class="card-image">
                        <img src="<?php echo $drink['bev_img'] ?>">
                        <span class="card-title big-font">
                            <?php echo $drink['name'] ;?>
                        </span>
                    </div>
                    <div class="card-content">
                        <p class="norm">
                            <?php echo $drink['bev_desc'] ;?>
                        </p>
                        <strong>
                            <?php echo $drink['bev_price'] ;?>
                        </strong>
                    </div>
                    <div class="card-action">
                    <button data-target="modalED"
                    class="btn modal-trigger waves-effect yellow darken-2">
                        Edit
                    </button>
                    <div id="modalED" class="modal">
                        <div class="modal-content">
                            Edit Item
                            <form action="../web.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="edit_drink">
                                <input type="hidden" name="id" value="<?php echo $drink['id'] ?>">
                                <input type="text" name="name" value="<?php echo $drink['name'] ?>">
                                <input type="text" name="intro" value="<?php echo $drink['bev_desc'] ?>">
                                <input type="number" name="price" value="<?php echo $drink['bev_price'] ?>">
                                <input type="hidden" name="old_img" value="<?php echo $drink['bev_img'] ?>">
                                <input type="file" name="img">
                                <div>
                                <br>
                                <button class="btn waves-effect green accent-3">
                                    Confirm
                                </button>
                                </div>
                            </form>
                        </div> 
                        <div class="modal-footer">
                            <button class="btn waves-effect modal-close blue accent-2">
                                Cancel
                            </button>
                        </div>
                    </div>
                       <button data-target="modalD" 
                       class="btn modal-trigger waves-effect red darken-3">
                        Delete
                       </button>
                       <div id="modalD" class="modal">
                            <div class="modal-content">
                                <h4>Delete Item</h4>
                                <p>Are you sure you want to delete <?php echo $drink['name'];?></p>
                                <form action="../web.php" method="POST">
                                    <input type="hidden" name="action" value="removeD">
                                    <input type="hidden" name="id" value="<?php echo $drink['id'] ?>">
                                    <button class="btn waves-effect red darken-3">
                                        Confirm
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn waves-effect modal-close blue accent-2">
                                    Cancel
                                </button>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ;?>


<?php 
}
require_once 'layout.php';
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, {});
  })
</script>