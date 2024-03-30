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

    <!-- Date Picker -->
    <!-- Nice-select, sticky -->
    <!-- <script src="./assets/js/jquery.nice-select.min.js"></script> -->
    <script src="./assets/js/jquery.sticky.js"></script>
    <!-- Progress -->
    <script src="./assets/js/jquery.barfiller.js"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/jquery.countdown.min.js"></script>
    <script src="./assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

    <script>
        var currency;
        var currency_format;
        $(document).ready(function() {
            currency = "<?php echo $currency; ?>";
            currency_format = "<?php echo $currency_format; ?>";
            

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
                                $(".cart-panel").append("<h1 id='no_items_cart' class='text-nice' style='font-weight: 600; text-align: center;'>No items in the cart</h1>");
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
                    <div class="product" style="display: block;">
                    <a href="product.php?id=${product.id}&qnt=${product.quantity}">
                    <img src="${product.image}" alt="${product.name}" style="vertical-align: super; display: inline-block; width: 29%;">
                    <div class="info" style="display: inline-block; width: 64%; vertical-align: top;">
                    <p style="margin: 0; font-weight: bold;">${product.name}</p>
                    <p class="price" style="margin: 0; font-weight: 300; font-size: 15px;">1 X ${product.price.toFixed(2)} = ${product.price.toFixed(2)} ${currency}</p>
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

            const productData = {
                1: {
                    title: '1',
                    imageUrl: '<?php echo $imagem_1_pack; ?>',
                    price: '<?php echo $price_pack_1; ?>',
                    extra_price: '24.95'
                },
                5: {
                    title: '5',
                    imageUrl: '<?php echo $imagem_5_pack; ?>',
                    price: '<?php echo $price_pack_5; ?>',
                    extra_price: '59.95'
                },
                10: {
                    title: '10',
                    imageUrl: '<?php echo $imagem_10_pack; ?>',
                    price: '<?php echo $price_pack_10; ?>',
                    extra_price: '99.95'
                },
                20: {
                    title: '20',
                    imageUrl: '<?php echo $imagem_20_pack; ?>',
                    price: '<?php echo $price_pack_20; ?>',
                    extra_price: '159.95'
                }
            };

// Extract the id and qnt from the URL using jQuery
            let params = new URLSearchParams(window.location.search);
            let id = params.get('id');
            let currentQnt = params.get('qnt');

// Function to update product details based on quantity
            function updateProductDetails(qnt) {
                if (productData[qnt]) {
                    $('#qnt_title').text(productData[qnt].title);
                    if (productData[qnt].title == '0') { //Mudar para 1 - UPDATE_NEW
                        $("#product_extra_price_display").text('');
                    } else {
                        $("#product_extra_price_display").text(productData[qnt].extra_price + currency);
                    }
                    $("#product_price_display").text(currency + productData[qnt].price + " " + currency_format);
                    $('#imagem_produto').attr('src', productData[qnt].imageUrl);

                }
            }

// Initially set the product details based on current quantity
            updateProductDetails(currentQnt);

            $('.btn-group-toggle-index .btn').each(function() {
                let qnt = $(this).data('qnt');

                currentQnt = $("#qnt").val();
                // Set the active state based on the current quantity
                if (qnt == currentQnt) {  // Use == to handle type coercion
                    $(this).addClass('active-pack');
                }

                // Add click event listener to each button
                $(this).click(function() {
                    $('html, body').animate({
                        scrollTop: $("#product_section").offset().top - 80
                    }, 600);

                    // Update the URL without refreshing the page
                    var id = $("#id_produto").val();
                    let newUrl = `index.php?id=${id}&qnt=${qnt}`;
                    history.pushState(null, null, newUrl);

                    // Update the product details
                    updateProductDetails(qnt);

                    // Set the active state of the buttons
                    $('.btn-group-toggle-index .btn').removeClass('active-pack');
                    $(this).addClass('active-pack');
                    $("#qnt").val(qnt);

                    

                    
                });
            });

            $('.platform-icon-new').click(function() {
                var productId = $(this).data('id');  
                var currentQnt = $("#qnt").val() || 5;  

                // Update the URL without refreshing the page
                let newUrl = `index.php?id=${productId}&qnt=${currentQnt}`;
                history.pushState(null, null, newUrl);

                window.location.reload();  
                $('html, body').animate({
                    scrollTop: $("#product_section").offset().top - 80
                }, 600);
            });

            $('.platform-icon-product').click(function() {
                var productId = $(this).data('id');  
                var currentQnt = $("#qnt").val() || 5;  

                // Update the URL without refreshing the page
                let newUrl = `product.php?id=${productId}&qnt=${currentQnt}`;
                history.pushState(null, null, newUrl);

                window.location.reload();  
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

                $('#stats_video').append(`
                    <div class="video-container" style="position: relative; width: 100%; height: 70vh; overflow: hidden;">
                    <!-- Video tag -->
                    <video class="lazyload-video" preload="none" autoplay loop muted playsinline style="width: 100%; height: 100%; object-fit: cover;">
                    <source data-src="statistics.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>

                    <!-- Title is commented out, but can be uncommented if needed
                    <div class="section-tittle" style="position: absolute; bottom: 10px; left: 0; right: 0; text-align: center; z-index: 1;">
                    <h2 class="mb-30 font-nice" style="font-weight: 500 !important; color: white; text-align: center;">Enhance your business's image</h2>
                    </div> -->
                    </div>
                    `);
                $('#stats_video_col2').remove();
                $('#stats_video_col').removeClass('col-md-6');
                $('#stats_video_col').addClass('col-md-12');

                $('.benefits').addClass('text-center');
            }

            /*
            $('#google_link').click(function() {
                window.location.href = 'product.php?id=1&qnt=5';
            });
            $('#tripadvisor_link').click(function() {
                window.location.href = 'product.php?id=4&qnt=5';
            });
            $('#instagram_link').click(function() {
                window.location.href = 'product.php?id=5&qnt=5';
            });
            $('#whatsapp_link').click(function() {
                window.location.href = 'product.php?id=6&qnt=5';
            });
            */

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

