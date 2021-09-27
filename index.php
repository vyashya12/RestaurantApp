<?php  
$title = "Home";
date_default_timezone_set('Asia/Kuala_Lumpur');
require_once './controllers/connection.php';
function get_content() {
?>

    <?php if(!isset($_SESSION['user'])) :?>
        <div class="slider">
            <ul class="slides">
                <li>
                    <img src="./assets/images/2.png">
                    <div class="caption left-align">
                        <h3 class="big-font">
                            Welcome to Tastes of India
                        </h3>
                    </div>
                </li>
                <li>
                    <img src="./assets/images/1.png">
                    <div class="caption center-align">
                        <h3 class="big-font">
                            Indian-styled Restaurant
                        </h3>
                    </div>
                </li>
                <li>
                    <img src="./assets/images/3.png">
                    <div class="caption right-align">
                        <h3 class="big-font">
                            Order, Eat, Repeat
                        </h3>
                    </div>
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="row">
                <h4 class="big-font center-align orange-text animate__animated animate__bounceInLeft">
                    Our Story
                </h4>
                <div class="row">
                    <div class="col s4">
                        <h5 class="big-font center-align">
                            Our History
                        </h5>
                        <h6 class="norm">
                            Tastes of India has been operating for 25 years,
                            we have perfected our recipes with the time that we have been open.
                            The traditional dishes has been passed on by our grandparents and we decided
                            to carry on the legacy.
                        </h6>
                    </div>
                    <div class="col s4">
                        <h5 class="big-font center-align">
                            Our Mission
                        </h5>
                        <h6 class="norm">
                            To provide a restaurant that serves traditional Indian dishes for our customers,
                            while also supporting local farmers and utilizing the freshest ingredients. We value 
                            teamwork, dedication to culinary arts and community involvement.
                        </h6>
                    </div>
                    <div class="col s4">
                        <h5 class="big-font center-align">
                            Our Customers
                        </h5>
                        <h6 class="norm">
                            I love this restaurant's atmosphere and their Indian cuisine. Nice staff and 
                            excellent service. Food was good and freshly prepared. Their Tandoori Chicken was 
                            delicious but a little spicy.&emsp;  -Manisha-
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ;?>
    <div class="container">
        <?php if(isset($_SESSION['user'])): ?>
        <div class="row">
            <?php if($_SESSION['user']['isCustomer'] == 1): ?>
            <h4 class="big-font center-align animate__animated animate__bounceInLeft">
                Welcome <?php echo $_SESSION['user']['name'] ;?>
            </h4>
            <?php endif; ?>
            <?php if($_SESSION['user']['isCustomer'] == 0): ?>
            <h4 class="big-font center-align animate__animated animate__bounceInLeft">
                Welcome to your dashboard <?php echo $_SESSION['user']['name'] ;?>
            </h4>
            <?php endif ;?>
        </div>
        <?php endif ;?>
        <?php if(isset($_SESSION['user']) && $_SESSION['user']['isCustomer'] == 1): ?>
            <div class="row">
                <h3 class="big-font center-align animate__animated animate__bounce">
                    Book A Table
                </h3>
                <form action="web.php" method="POST" class="col s8 offset-s2">
                    <input type="hidden" name="action" value="book_table">
                    <input type="hidden" name="customer_id" value="<?php echo $_SESSION['user']['id'] ?>">
                    <div class="input-field">
                        <input type="text" name="date" class="datepicker" min="<?php echo date('Y-m-d'); ?>">
                        <label for="date">Please Pick a Date</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="time" class="timepicker">
                        <label for="time">Please Pick Time</label>
                    </div>
                    <div class="input-field">
                        <input type="number" name="people" min="1" max="8">
                        <label for="people">Number of People</label>
                    </div>
                    <button class="btn waves-effect orange darken-2">
                        Book
                    </button>
                </form>
            </div>
        <?php endif ;?>
        <?php if(isset($_SESSION['user']) && $_SESSION['user']['isCustomer'] == 0): ?>
        <div class="row">
            <form action="/web.php" method="POST" class="col s12  offset-s2" enctype="multipart/form-data">
                <label>
                    <input type="radio" name="action" value="add_food" checked />
                    <span>Add Food</span>
                </label>
                <label>
                    <input type="radio" name="action" value="add_drink" />
                    <span>Add Drink</span>
                </label>
                <div class="row">
                    <div class="input-field col s4">
                        <input type="text" name="name">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field col s4">
                        <input type="number" min="0" name="price">
                        <label for="price">Price</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s8">
                        <input type="text" name="desc">
                        <label for="desc">Description</label>
                    </div>
                    <div class="input-field file-field col s8">
                        <div class="btn orange darken-3">
                            <span>File</span>
                            <input type="file" name="img" id="img">
                        </div>
                        <div class="file-path-wrapper">
                            <input type="text" placeholder="Please upload 1 Image" class="file-path-validate">
                        </div>
                    </div>
                </div>
                <button class="btn waves-effect orange darken-2">Add Item</button>
            </form>
        </div>
        <?php endif ;?>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        
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

        let date = document.querySelectorAll('.datepicker');
        let works = M.Datepicker.init(date, {
            format: "yyyy-mm-dd"
        });

        let time = document.querySelectorAll('.timepicker');
        let picker = M.Timepicker.init(time, {});

        let slider = document.querySelectorAll('.slider');
        let slideWorker = M.Slider.init(slider, {
            indicators: false,
            interval: 2000
        });
    })
</script>

<?php  
}
require_once 'views/layout.php';
?>