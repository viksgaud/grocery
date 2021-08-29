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
    <link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css"
        rel="stylesheet">
    <link href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css"
        rel="stylesheet">
    <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/vendors/jquery.min.js">
    </script>
    <script src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js">
    </script>
    <style>
   
    </style>
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



                <li class="nav-item px-xl-2 pl-3 pt-xl-2">
                    <a href="digital_innovation/digital_innovation.php" class="nav-link text-light">
                        <i class="fas fa-user-lock">Admin</i>
                    </a>
                </li>


            </ul>


        </div>
    </nav>

    <div class="alert alert-success" role="alert" id="message_success" style="display:none;margin-top:80px;">

    </div>

    <div class="alert alert-danger" role="alert" id="message_fail" style="display:none;margin-top:80px;">
    </div>

    <div class="pt-5 mt-5 text-center">
        <h1>Products</h1>
    </div>
    <div class="container-fluid">
        <div class="row" id="vikas">
           
        </div>
    </div>




    <!-- <div class="container">
	<div class="row align-items-center">
		<div class="col-12 col-carousel">
			<div class="owl-carousel carousel-main" >
				<div></div>
				
			</div>
		</div>
	</div> -->
    </div>




    <script>
    $('.carousel-main').owlCarousel({

        loop: true,
        autoplay: true,
        autoplayTimeout: 1500,
        margin: 10,
        nav: true,
        dots: false,
        navText: ['<span class="fas fa-chevron-left fa-2x text-dark"></span>',
            '<span class="fas fa-chevron-right fa-2x text-dark"></span>'
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
    </script>

    <script>
    $(document).ready(function() {
        // $("#vikas").hide();
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: "<?php echo base_url(); ?>/welcome/cart",
            dataType: 'json',
            success: function(response) {
                $("#items").html(response);

            }
        });


        $.ajax({
            type: 'ajax',
            method: 'get',
            url: "<?php echo base_url(); ?>/welcome/product",
            dataType: 'json',
            success: function(response) {

                var html = '';
                var i;
                for (i = 0; i < response.length; i++) {
                    $('#vikas').html(
                        html +=
                        '<div class="col-2">' +
                        '<div class="card" style="width: 18rem;">' +
                        '<img class="card-img-top" src="<?php echo base_url(); ?>../images/' + response[i].product_img + '" alt="Card image cap" style="height:200px;">' +
                        '<div class="card-body text-center">' +
                        '<h5 class="card-title">' + response[i].product_name + '</h5>' +
                        '<p class="card-text">Price : ' + response[i].product_price + '</p>' +
                        '<button class="btn btn-primary add_cart" id="add_cart" data="' +
                        response[i].product_id + '">ADD TO CART</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>'

                    );
                };

            }
        });



        $('#vikas').on('click', '.add_cart', function() {

            var id = $(this).attr('data');

            $.ajax({
                url: '<?php echo base_url(); ?>welcome/addCart',
                type: 'ajax',
                method: 'post',
                data: {
                    pro_id: id
                },
                success: function(data) {

                   
                        $('#message_success').html("<h6>Product Inserted</h6>").fadeIn()
                            .delay(4000).fadeOut('slow');
                   
                       

                    $.ajax({
                        type: 'ajax',
                        method: 'get',
                        url: "<?php echo base_url(); ?>/welcome/cart",
                        dataType: 'json',
                        success: function(response) {
                            $("#items").html(response);

                        }
                    });

                },
                error: function(data) {
                    $('#message_fail').html("<h6>Product Not Inserted</h6>").fadeIn()
                        .delay(4000).fadeOut('slow');
                }
            })

        });




    });
    </script>
</body>

</html>