</main>
<footer>
    <div class="footer-wrapper section-bg2"  data-background="assets/img/gallery/footer-bg.webp">
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-5 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo mb-35">
                                    <a href="index.php"><img src="assets/img/logo/logo_white.png" alt="" style="width: 200px;"></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p style="color: white;"><?php echo translate('footer_slogan'); ?></p>
                                    </div>
                                    <ul class="mb-40">
                                        <li class="number" style="color: white;"><a href="https://www.instagram.com/tapandgo.tech" target="_blank" aria-label="Contact Us">Contact Us</a></li>
                                        <li class="number2" style="color: white;"><a href="#">info@tapgotech.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>About Us</h4>
                                <ul>
                                    <li style="color: white;"><?php echo translate('footer_about_us'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Navigation</h4>
                                <ul>
                                    <li><a href="#" style="color: white;"><?php echo translate('footer_link_1'); ?></a></li>
                                    <li><a href="#product_section" style="color: white;"><?php echo translate('footer_link_2'); ?></a></li>
                                    <li><a href="#section_benefits" style="color: white;"><?php echo translate('footer_link_3'); ?></a></li>
                                    <li><a href="contact.php" style="color: white;"><?php echo translate('footer_link_4'); ?></a></li>
                                    <li><a target="_blank" href="https://www.instagram.com/tapandgo.tech" style="color: white;"><?php echo translate('footer_link_5'); ?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <!-- social -->
                            <div class="footer-social">
                                <a href="https://www.instagram.com/tapandgo.tech" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.facebook.com/people/TapGo/100066408062528/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="footer-border">
                    <div class="row">
                        <div class="col-xl-12 ">
                            <div class="footer-copy-right text-center">
                                <p>2023 All rights reserved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </div>
    </footer>
    <!-- Scroll Up -->
    <div id="back-top" style="z-index: 900;">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <?php
    if (!isset($imagem_1_pack) || !isset($imagem_5_pack) || !isset($imagem_10_pack) || !isset($imagem_20_pack) || !isset($price_pack_1) || !isset($price_pack_5) || !isset($price_pack_10) || !isset($price_pack_20) || !isset($extra_price)) {
        $imagem_1_pack = '---';
        $imagem_5_pack = '---';
        $imagem_10_pack = '---';
        $imagem_20_pack = '---';
        $price_pack_1 = 0;
        $price_pack_5 = 0;
        $price_pack_10 = 0;
        $price_pack_20 = 0;
        $extra_price = 0;
    }
    ?>
    <!-- JS here -->

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <!-- <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script> -->
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>


    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

    <script>
        var currency;
        var currency_format;
        var product_scroll = "<?php echo $scrollToProductSection; ?>";
        $(document).ready(function() {
            $('.btn-group-toggle-index .btn').first().addClass('active-pack');
            $('.platform-icon-new').first().addClass('product_type_selection');

            if (product_scroll == 1) {
                var productSection = $("#product_section");
                if (productSection.length) {
                    $('html, body').animate({
                        scrollTop: productSection.offset().top - 80
                    }, 600);

                    var qnt = parseInt("<?php echo $qnt; ?>", 10);
                    var id = parseInt("<?php echo $id; ?>", 10);
                    var quantityButtons = $('.btn-group-toggle-index .btn');
                    var typeButtons = $('.card_type_buttons .platform-icon-new');

                    quantityButtons.removeClass('active-pack');
                    typeButtons.removeClass('product_type_selection');

                    switch(qnt) {
                        case 1:
                            quantityButtons.eq(0).addClass('active-pack');
                            break;
                        case 5:
                            quantityButtons.eq(1).addClass('active-pack');
                            break;
                        case 10:
                            quantityButtons.eq(2).addClass('active-pack');
                            break;
                        case 20:
                            quantityButtons.eq(3).addClass('active-pack');
                            break;
                    }

                    switch(id) {
                        case 1:
                            typeButtons.eq(0).addClass('product_type_selection');
                            break;
                        case 4:
                            typeButtons.eq(1).addClass('product_type_selection');
                            break;
                    }
                }
            }

            currency = "<?php echo $currency; ?>";
            currency_format = "<?php echo $currency_format; ?>";

            $('.triggerButton').click(function() {
                var qnt_trigger = $(this).data('qnt');

                if (qnt_trigger == 5) {
                    $('.btn-group-toggle-index .btn').eq(1).click(); // eq(1) for the second button
                } else if (qnt_trigger == 10) {
                    $('.btn-group-toggle-index .btn').eq(2).click(); // eq(2) for the third button
                } else if (qnt_trigger == 20) {
                    $('.btn-group-toggle-index .btn').eq(3).click(); // eq(3) for the fourth button
                }
            });
            

            $("#add_to_cart").click(function(e) {
                e.preventDefault();

                $("#no_items_cart").hide();

                var productId = $("#id_produto").val();
                var currentQnt = $("#qnt").val();

                $.ajax({
                    type: "POST",
                    url: "adicionar_carrinho.php",
                    data: {
                        id_produto: productId,
                        qnt: currentQnt
                    },
                    success: function(response) {
                        if(response.status === 'success') {
                            $('.cart-container').addClass('active');
                            var product = {
                                id: productId,
                                key: response.product.key, 
                                name: response.product.name,
                                image: response.product.image,
                                price: parseFloat(response.product.price),
                                quantity: currentQnt
                            };
                            addProductToCart(product);
                        } else {
                            alert('Failed to add product to cart. Please try again.');
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            });

    // Delete product from cart
            $(document).on("click", ".delete-btn", function() {
                console.log("Clicked");
                var key = $(this).data("key");
                var itemId = $(this).data("itemid");
                var productElement = $(this).closest('.product');

                $.ajax({
                    type: "POST",
                    url: "delete_item.php",
                    data: {
                        key: key,
                        item_id: itemId
                    },
                    success: function(response) {
                        console.log("AJAX Success:", response);
                        if(response.status === 'decremented') {
                    // Update the product quantity and price displayed in the cart
                            var priceElement = productElement.find('.price');
                            var matches = priceElement.text().match(new RegExp("^(\\d+) X (\\d+\\.\\d+) = (\\d+\\.\\d+) " + currency + "$"));
                            var currentQuantity = (matches && matches[1]) ? parseInt(matches[1]) : 0;

                            if (currentQuantity > 1) {
                                currentQuantity -= 1;
                                var productPrice = (matches && matches[2]) ? parseFloat(matches[2]) : 0;
                                var newTotalForProduct = currentQuantity * productPrice;
                                priceElement.text(`${currentQuantity} X ${productPrice.toFixed(2)} = ${newTotalForProduct.toFixed(2)} ${currency}`);
                            }
                        } else if(response.status === 'removed') {
                            productElement.remove();
                        }

                // Update the total price in the cart
                        updateCartTotal();
                        if ($(".cart-panel .product").length == 0) {
                            const noItemsElement = $("#no_items_cart");
                            if (noItemsElement.length) {
                                noItemsElement.show();
                            } else {
                                $(".cart-panel").append("<h1 id='no_items_cart' class='text-nice' style='font-weight: 600; text-align: center; color: white;'><?php echo translate('cart_no_items'); ?></h1>");
                            }
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("AJAX Error:", textStatus, errorThrown);
                    },
                    dataType: 'json'
                });
            });

            function updateCartTotal() {
                var totalElement = $("#total_carrinho");
                var total = 0;
                $(".cart-panel .product .price").each(function() {
                    var matches = $(this).text().match(new RegExp("^(\\d+) X (\\d+\\.\\d+) = (\\d+\\.\\d+) " + currency + "$"));
                    var productTotal = (matches && matches[3]) ? parseFloat(matches[3]) : 0;
                    total += productTotal;
                });
                totalElement.text('Total: ' + total.toFixed(2) + ' ' + currency);
            }

            function addProductToCart(product) {
                var $productList = $(".cart-panel");
                var productExists = false;

                $productList.find(".product").each(function() {
                    var $this = $(this);
                    var existingProductId = $this.find("a").attr("href").split("id=")[1].split("&")[0];
                    var existingProductQnt = $this.find("a").attr("href").split("qnt=")[1];

                    if (existingProductId == product.id && existingProductQnt == product.quantity) {
                        productExists = true;

                        var priceElement = $this.find('.price');
                        var matches = priceElement.text().match(new RegExp("^(\\d+) X (\\d+\\.\\d+) = (\\d+\\.\\d+) " + currency + "$"));
                        var currentQuantity = (matches && matches[1]) ? parseInt(matches[1]) : 0;
                        var unitPrice = (matches && matches[2]) ? parseFloat(matches[2]) : 0;

                        currentQuantity += 1;
                        var newTotalForProduct = currentQuantity * unitPrice;
                        priceElement.text(`${currentQuantity} X ${unitPrice.toFixed(2)} = ${newTotalForProduct.toFixed(2)} ${currency}`);

            return false;  // Exit the loop
        }
    });

                if (!productExists) {
                    var productHTML = `
                    <div class="product" style="display: block;box-shadow: 8px 8px 10px rgba(0, 0, 0, 0.4), -8px -8px 10px rgba(0, 0, 0, 0.4), 8px -8px 10px rgba(0, 0, 0, 0.4), -8px 8px 10px rgba(0, 0, 0, 0.4); border-radius: 15px; color: white !important;">
                    <a href="index.php?id=${product.id}&qnt=${product.quantity}">
                    <img src="${product.image}" alt="${product.name}" style="vertical-align: super; display: inline-block; width: 29%;">
                    <div class="info" style="display: inline-block; width: 64%; vertical-align: top;">
                    <p style="margin: 0; font-weight: bold; color: white;">${product.name}</p>
                    <p class="price" style="margin: 0; font-weight: 300; font-size: 15px; color: white;">1 X ${product.price.toFixed(2)} = ${product.price.toFixed(2)} ${currency}</p>
                    </div>
                    </a>
                    <span class="remove-btn delete-btn btn btn-danger" data-key="${product.key}" data-itemid="${product.id}" style="background-image: none; color: #fff; background-color: #dc3545; border-color: #dc3545; width: 100%; padding: 4%;"><i class="fa-solid fa-trash" style="font-weight: bold; position: initial;"></i> <?php echo translate("cart_remove_btn"); ?></span>
                    </div>
                    `;

                    $productList.append(productHTML);
                }

    // Update the total price in the cart
                var totalElement = $("#total_carrinho");
                var currentTotal = parseFloat(totalElement.text().replace('Total: ', '').replace(' ' + currency, ''));
                currentTotal += product.price;
                totalElement.text('Total: ' + currentTotal.toFixed(2) + ' ' + currency);
            }

            function getUrlParameter(name) {
                name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                var results = regex.exec(location.search);
                return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            }

            function updateProductInfo(productId, quantity) {
                $.ajax({
                    url: 'test_aj.php', // Server script URL
                    type: 'GET',
                    data: { id: productId, qnt: quantity },
                    success: function(response) {
                        // Update the quantity
                        $('#qnt_title').text(quantity);

                        // Construct the title text with proper singular or plural form
                        var titleText = quantity === 1 ? response.title.replace('Cards', 'Card') : response.title;
                        $('#title_type').text(titleText);

                        // Update the other DOM elements with the received data
                        var extraPrice;
                        switch (quantity) {
                            case 1:
                                extraPrice = '24.95';
                                break;
                            case 5:
                                extraPrice = '59.95';
                                break;
                            case 10:
                                extraPrice = '99.95';
                                break;
                            case 20:
                                extraPrice = '159.95';
                                break;
                            default:
                                extraPrice = '24.95'; // Default value or some other logic
                        }
                        $("#product_extra_price_display").text(extraPrice + ' ' + currency);
                        $("#product_price_display").text(currency + response.price + " " + currency_format);
                        $('#imagem_produto').attr('src', response.imageUrl);

                        // Update the hidden input values
                        $("#id_produto").val(productId);
                        $("#qnt").val(quantity);

                        // Update the active state of the quantity buttons
                        $('.btn-group-toggle-index .btn').removeClass('active-pack');
                        $('.btn-group-toggle-index .btn').filter(function() {
                            return $(this).data('qnt') == quantity;
                        }).addClass('active-pack');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: ", error);
                    }
                });
            }


            $('.platform-icon-new').click(function() {
                var productId = $(this).data('id');
                /* var currentQnt = $("#qnt").val(); */
                var activeQnt = $('.btn-group-toggle-index .btn.active-pack').data('qnt') || 1;

                updateProductInfo(productId, activeQnt);
                $('.platform-icon-new').removeClass('product_type_selection');

                $(this).addClass('product_type_selection');

                $('html, body').animate({
                    scrollTop: $("#product_section").offset().top - 80
                }, 600);
            });

            $('.btn-group-toggle-index .btn').click(function() {
                var productId = $("#id_produto").val();
                var quantity = $(this).data('qnt');

                updateProductInfo(productId, quantity);

                $('.btn-group-toggle-index .btn').removeClass('active-pack');
                $(this).addClass('active-pack');

                $('html, body').animate({
                    scrollTop: $("#product_section").offset().top - 80
                }, 600);
            });



            $(document).on('click', '.btn-edit', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Edit Local Details',
                    html:
                    '<input id="swal-input1" class="swal2-input" placeholder="Nome do Local">' +
                    '<h2></h2>' +
                    'Imagem:<input id="swal-input2" type="file" class="swal2-file">',
                    focusConfirm: false,
                    preConfirm: () => {
                        let nome_local = document.getElementById('swal-input1').value;
                        let file_data = $('#swal-input2').prop('files')[0];   
                        let form_data = new FormData();                  
                        form_data.append('file', file_data);
                        form_data.append('id', id);
                        form_data.append('nome_local', nome_local);

                        return new Promise(function(resolve, reject) {
                            $.ajax({
                                url: 'edit_local.php',
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: form_data,                         
                                type: 'post',
                                success: function(data) {
                                    if (data.status === "success") {
                                        resolve(data);
                                    } else {
                                        reject(new Error(data.message || 'Unknown error.'));
                                    }
                                },
                                error: function(error) {
                                    reject(new Error('Request failed.'));
                                }
                            });
                        });
                    }
                }).then((result) => {
                    if (result.value && result.value.status === "success") {
                        let newName = document.getElementById('swal-input1').value;
                        let newImageUrl = result.value.image_url;

                        if (newName) {
                            $("#nome_local_" + id).text(newName);
                        }

                        if (newImageUrl) {
                            $("#imagem_local_" + id).attr('src', newImageUrl);
                        }

                        Swal.fire('Edited!', 'Your local has been edited.', 'success');
                    } else {
                        Swal.fire('Error!', result.value.message, 'error');
                    }
                });
            });



            $(document).on('click', '.btn-delete', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'delete_local.php',
                            type: 'POST',
                            data: {
                                id: id
                            },
                            success: function(data) {
                                if (data === "success") {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your local has been deleted.',
                                        'success'
                                        );
                                    $("#coluna_" + id).remove();
                        // You can also remove the table row using jQuery here
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete local.',
                                        'error'
                                        );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'Request failed. Please try again.',
                                    'error'
                                    );
                            }
                        });
                    }
                });
            });




            function isMobileDevice() {
                return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
            };

            if (isMobileDevice()) {
                $('#cards_video_col').remove();
                $('#cards_video_col2').removeClass('col-md-6');
                $('#cards_video_col2').addClass('col-md-12');
                //$('#video-container-pc').remove();

                
                $('#stats_video_col2').remove();
                $('#stats_video_col').removeClass('col-md-6');
                $('#stats_video_col').addClass('col-md-12');

                $('.benefits').addClass('text-center');
            }

            $("#send_contact_message").click(function(e) {
                e.preventDefault();  

                var nome = $("#contact_name").val().trim();
                var email = $("#contact_email").val().trim();
                var telemovel = $("#contact_phone").val().trim();
                var mensagem = $("#contact_message").val().trim();

                var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                var phonePattern = /^[+]?[\s.-]?(\d[\s.-]?){7,15}$/;

                if (!nome || !emailPattern.test(email) || !phonePattern.test(telemovel) || !mensagem) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Invalid Input',
                        text: 'Please ensure all fields are filled correctly.',
                        confirmButtonText: 'Okay'
                    });
                } else {

                    $.ajax({
                        type: "POST",
                        url: "send_contact_message.php",
                        data: {
                            nome: nome,
                            email: email,
                            telemovel: telemovel,
                            mensagem: mensagem,
                        },
                        success: function(response) {
                            if(response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Message Sent',
                                    text: 'Your message was sent to us. Have a great day!',
                                    confirmButtonText: 'Okay'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Message Failed',
                                    text: 'There was an error sending your message. Please try again later...',
                                    confirmButtonText: 'Okay'
                                });
                            }
                        }
                    
                    });
                }

            });


        });
    </script>
    

</body>
</html>

