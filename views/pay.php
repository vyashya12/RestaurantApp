<?php 
$title = "Pay";
require_once '../controllers/connection.php';
function get_content() {
    $id = $_SESSION['user']['id'];
    global $cn;
    $query = "SELECT id FROM tables WHERE customer_id = $id";
    $table = mysqli_fetch_assoc(mysqli_query($cn, $query));
    $table = $table['id'];
    $query2 = "SELECT * FROM orders WHERE table_id = $table";
    $result = mysqli_query($cn, $query2);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $total = 0;

    
    ?>
    <?php if(isset($orders)): ?>
<div class="container">
    <table class="highlight centered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($orders as $order): ?>
            <?php 
            $amount = $order['amount'];
            $total += $amount;
            ?>
            <?php if($order['bev_id'] == 0): ?>
                <?php 
                    $food_id = $order['food_id'];
                    $query3 = "SELECT name FROM food WHERE id = $food_id";
                    $name = mysqli_fetch_assoc(mysqli_query($cn, $query3));
                    $name = $name['name'];
                ?>
                <tr>
                    <td>
                        <p class="norm">
                            <?php echo $name ;?>
                        </p>
                    </td>
                    <td>
                        <p class="norm">
                            <?php echo $order['quantity'] ;?>
                        </p>
                    </td>
                    <td>
                        <p class="norm">
                            RM: <?php echo $order['amount'] ;?>
                        </p>
                    </td>
                </tr>
            <?php else: ?>
                <?php 
                    $drink_id = $order['bev_id'];
                    $query4 = "SELECT name FROM beverages WHERE id = $drink_id";
                    $name = mysqli_fetch_assoc(mysqli_query($cn, $query4));
                    $name = $name['name'];
                ?>
                <tr>
                    <td>
                        <?php echo $name ;?>
                    </td>
                    <td>
                        <?php echo $order['quantity'] ;?>
                    </td>
                    <td>
                        RM: <?php echo $order['amount'] ;?>
                    </td>
                </tr>                
            <?php endif ;?>
            <?php endforeach ;?>
            <tr>
                <td></td>
                <td></td>
                <td>Total: RM <?php echo $total ;?></td>
            </tr>
        </tbody>
    </table>
    <div id="paypal-button-container" class="center-align"></div>
</div>
        <?php else :?>
            <h2>Order Something First</h2>            
        <?php endif ;?>

<script src="https://www.paypal.com/sdk/js?client-id=AUtDmvQdendRxX9koEZ3vjIRPZOIjLWWt9mDqoeiml6Ekf_ynQV-MoXM7AdFHHrfM3xCwPcVsGz11tev&currency=MYR"></script>
<script type="text/javascript">
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?php echo $total; ?>
                    }
                }]
            })
        },

        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert("Transaction completed by " + details.payer.name.given_name);
                let formData = new FormData();
                formData.append('action', 'records');
                formData.append('table_id', <?php echo $table; ?>);
                formData.append('amount', <?php echo $total; ?>);

                fetch('../web.php', {
                    method: "POST",
                    body: formData
                })
                .then(res => res.text())
                window.location = '/'
            })
        }
    }).render('#paypal-button-container');
</script>

<?php 
}
require_once 'layout.php';
?>