<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GROCERY</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;1,500&display=swap"
        rel="stylesheet">
    
   
</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-light fixed-top bg-secondary" style="background:;">
        <a class="navbar-brand p-2 pl-xl-4 text-light" href="<?php echo base_url(); ?>welcome">GROCERY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse float-right" style="float:right;" id="navbarSupportedContent">
            <div class="mr-auto"></div>
            <ul class="navbar-nav" data-aos="slide-down">
                <li class="nav-item px-xl-2 pl-3">
                    <a href="<?php echo base_url(); ?>cart" class="nav-link">

                        <button type="button" class="btn btn-light">
                            <i class="fas fa-cart-arrow-down"></i> <span class="badge bg-primary" id="items">0</span>
                        </button>
                    </a>
                </li>


            </ul>


        </div>
    </nav>

    <div class="alert alert-success" role="alert" id="message_success" style="display:none;margin-top:80px;">

    </div>

    <div class="alert alert-danger " role="alert" id="message_fail" style="display:none;margin-top:80px;">
    </div>
    <div class="pt-5 mt-5 text-center">
        <h1>Cart Items</h1>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 col-xl-9">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quntity</th>
                            <th scope="col">SubPrice</th>
                            <th scope="col">Update</th>
                            <th scope="col">Delete</th>

                        </tr>
                    </thead>
                    <tbody class="items_cart">

                    </tbody>
                </table>

            </div>
            <div class="col-12 col-xl-3">

                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Total Price </h5>
                        <h6 class="card-subtitle mb-2 text-muted"> <span class="total_price"></span></h6>
                        <!-- <p class="card-text">Pay Amount </p> -->
                    </div>
                </div>
            </div>
        </div>


    </div>



    <script>
    $(document).ready(function() {

        showCart();


        $('.items_cart').on('click', '.delete', function() {

            var id = $(this).attr('data');

            $.ajax({
                type: 'ajax',
                method: 'post',
                url: "<?php echo base_url(); ?>/cart/delete_cart",
                data: {
                    id: id
                },
                asynk: false,
                dataType: 'json',
                success: function(response) {
                    showCart();
                    $('#message_success').html("<h6>Cart Deleted</h6>").fadeIn()
                        .delay(4000).fadeOut('slow');
                },
                error: function() {
                    alert('Not Added');
                    $('#message_fail').html("<h6>Not Deleted</h6>").fadeIn()
                        .delay(4000).fadeOut('slow');
                }
            })

        });




        $('.items_cart').on('click', '.update', function() {

            var id = $(this).attr('data');
            var qty = $("input[name='quantity" + id + "']").val();

            $.ajax({
                type: 'ajax',
                method: 'post',
                url: "<?php echo base_url(); ?>/cart/update_cart",
                data: {
                    id: id,
                    qty: qty
                },
                asynk: false,
                dataType: 'json',
                success: function(response) {
                    showCart();
                    $('#message_success').html("<h6>Card Updated</h6>").fadeIn()
                        .delay(4000).fadeOut('slow');
                        $('.total_item').val("dddd");
                },
                error: function() {
                    alert('Not Added');
                    $('#message_fail').html("<h6>Not updated</h6>").fadeIn()
                        .delay(4000).fadeOut('slow');
                }
            })




        });


        function showCart() {
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: "<?php echo base_url(); ?>/cart/cart_item",
                dataType: 'json',
                success: function(response) {

                    var subPrice = 0;
                    var html = '';
                    var total = 0;

                    $.each(response, function(key, value) {

                        subPrice = value.quantity * value.product_price;

                        $(".items_cart").html(
                            html +=
                            '<tr>' +
                            '<td>' + value.cart_id + '</td>' +
                            '<td>' + value.product_name + '</td>' +
                            '<td>' + value.product_price + '</td>' +
                            '<td><input type="number" class="quantity" name="quantity' +
                            value.cart_id + '" min="1" max="10" value ="' + value
                            .quantity +
                            '" >' +
                            '</td>' +
                            '<td>' + subPrice + '</td>' +
                            '<td><button class="btn btn-success update" data=' + value
                            .cart_id + '>Update</button></td>' +
                            '<td><button class="btn btn-danger delete" data=' + value
                            .cart_id + '>Delete</button></td>' +
                            '<tr>'
                        );

                     total += subPrice;

                        $(".total_price").html(total);
                    })



                }
            });

            $.ajax({
            type: 'ajax',
            method: 'get',
            url: "<?php echo base_url(); ?>/welcome/cart",
            dataType: 'json',
            success: function(response) {
                $("#items").html(response);

            }
        });
        }










    });
    </script>
</body>

</html>