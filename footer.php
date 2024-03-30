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
        var currency,currency_format,product_scroll="<?php echo $scrollToProductSection; ?>";$(document).ready(function(){if($(".btn-group-toggle-index .btn").first().addClass("active-pack"),$(".platform-icon-new").first().addClass("product_type_selection"),1==product_scroll){var e=$("#product_section");if(e.length){$("html, body").animate({scrollTop:e.offset().top-80},600);var t=parseInt("<?php echo $qnt; ?>",10),a=parseInt("<?php echo $id; ?>",10),r=$(".btn-group-toggle-index .btn"),c=$(".card_type_buttons .platform-icon-new");switch(r.removeClass("active-pack"),c.removeClass("product_type_selection"),t){case 1:r.eq(0).addClass("active-pack");break;case 5:r.eq(1).addClass("active-pack");break;case 10:r.eq(2).addClass("active-pack");break;case 20:r.eq(3).addClass("active-pack")}switch(a){case 1:c.eq(0).addClass("product_type_selection");break;case 4:c.eq(1).addClass("product_type_selection")}}}function o(e){var t=RegExp("[\\?&]"+(e=e.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]"))+"=([^&#]*)").exec(location.search);return null===t?"":decodeURIComponent(t[1].replace(/\+/g," "))}function i(e,t){$.ajax({url:"test_aj.php",type:"GET",data:{id:e,qnt:t},success:function(a){$("#qnt_title").text(t);var r,c=1===t?a.title.replace("Cards","Card"):a.title;switch($("#title_type").text(c),t){case 1:default:r="24.95";break;case 5:r="59.95";break;case 10:r="99.95";break;case 20:r="159.95"}$("#product_extra_price_display").text(r+" "+currency),$("#product_price_display").text(currency+a.price+" "+currency_format),$("#imagem_produto").attr("src",a.imageUrl),$("#id_produto").val(e),$("#qnt").val(t),$(".btn-group-toggle-index .btn").removeClass("active-pack"),$(".btn-group-toggle-index .btn").filter(function(){return $(this).data("qnt")==t}).addClass("active-pack")},error:function(e,t,a){console.error("Error: ",a)}})}currency="<?php echo $currency; ?>",currency_format="<?php echo $currency_format; ?>",$(".triggerButton").click(function(){var e=$(this).data("qnt");5==e?$(".btn-group-toggle-index .btn").eq(1).click():10==e?$(".btn-group-toggle-index .btn").eq(2).click():20==e&&$(".btn-group-toggle-index .btn").eq(3).click()}),$("#add_to_cart").click(function(e){e.preventDefault(),$("#no_items_cart").hide();var t=$("#id_produto").val(),a=$("#qnt").val();$.ajax({type:"POST",url:"adicionar_carrinho.php",data:{id_produto:t,qnt:a},success:function(e){"success"===e.status?($(".cart-container").addClass("active"),function e(t){var a=$(".cart-panel"),r=!1;if(a.find(".product").each(function(){var e=$(this),a=e.find("a").attr("href").split("id=")[1].split("&")[0],c=e.find("a").attr("href").split("qnt=")[1];if(a==t.id&&c==t.quantity){r=!0;var o=e.find(".price"),i=o.text().match(RegExp("^(\\d+) X (\\d+\\.\\d+) = (\\d+\\.\\d+) "+currency+"$")),n=i&&i[1]?parseInt(i[1]):0,s=i&&i[2]?parseFloat(i[2]):0,l=(n+=1)*s;return o.text(`${n} X ${s.toFixed(2)} = ${l.toFixed(2)} ${currency}`),!1}}),!r){var c=`
                    <div class="product" style="display: block;box-shadow: 8px 8px 10px rgba(0, 0, 0, 0.4), -8px -8px 10px rgba(0, 0, 0, 0.4), 8px -8px 10px rgba(0, 0, 0, 0.4), -8px 8px 10px rgba(0, 0, 0, 0.4); border-radius: 15px; color: white !important;">
                    <a href="index.php?id=${t.id}&qnt=${t.quantity}">
                    <img src="${t.image}" alt="${t.name}" style="vertical-align: super; display: inline-block; width: 29%;">
                    <div class="info" style="display: inline-block; width: 64%; vertical-align: top;">
                    <p style="margin: 0; font-weight: bold; color: white;">${t.name}</p>
                    <p class="price" style="margin: 0; font-weight: 300; font-size: 15px; color: white;">1 X ${t.price.toFixed(2)} = ${t.price.toFixed(2)} ${currency}</p>
                    </div>
                    </a>
                    <span class="remove-btn delete-btn btn btn-danger" data-key="${t.key}" data-itemid="${t.id}" style="background-image: none; color: #fff; background-color: #dc3545; border-color: #dc3545; width: 100%; padding: 4%;"><i class="fa-solid fa-trash" style="font-weight: bold; position: initial;"></i> <?php echo translate("cart_remove_btn"); ?></span>
                    </div>
                    `;a.append(c)}var o=$("#total_carrinho"),i=parseFloat(o.text().replace("Total: ","").replace(" "+currency,""));i+=t.price,o.text("Total: "+i.toFixed(2)+" "+currency)}({id:t,key:e.product.key,name:e.product.name,image:e.product.image,price:parseFloat(e.product.price),quantity:a})):alert("Failed to add product to cart. Please try again.")},error:function(){alert("An error occurred. Please try again.")}})}),$(document).on("click",".delete-btn",function(){console.log("Clicked");var e=$(this).data("key"),t=$(this).data("itemid"),a=$(this).closest(".product");$.ajax({type:"POST",url:"delete_item.php",data:{key:e,item_id:t},success:function(e){if(console.log("AJAX Success:",e),"decremented"===e.status){var t,r,c=a.find(".price"),o=c.text().match(RegExp("^(\\d+) X (\\d+\\.\\d+) = (\\d+\\.\\d+) "+currency+"$")),i=o&&o[1]?parseInt(o[1]):0;if(i>1){i-=1;var n=o&&o[2]?parseFloat(o[2]):0,s=i*n;c.text(`${i} X ${n.toFixed(2)} = ${s.toFixed(2)} ${currency}`)}}else"removed"===e.status&&a.remove();if(t=$("#total_carrinho"),r=0,$(".cart-panel .product .price").each(function(){var e=$(this).text().match(RegExp("^(\\d+) X (\\d+\\.\\d+) = (\\d+\\.\\d+) "+currency+"$"));r+=e&&e[3]?parseFloat(e[3]):0}),t.text("Total: "+r.toFixed(2)+" "+currency),0==$(".cart-panel .product").length){let l=$("#no_items_cart");l.length?l.show():$(".cart-panel").append("<h1 id='no_items_cart' class='text-nice' style='font-weight: 600; text-align: center; color: white;'><?php echo translate('cart_no_items'); ?></h1>")}},error:function(e,t,a){console.log("AJAX Error:",t,a)},dataType:"json"})}),$(".platform-icon-new").click(function(){var e=$(this).data("id"),t=$(".btn-group-toggle-index .btn.active-pack").data("qnt")||1;i(e,t),$(".platform-icon-new").removeClass("product_type_selection"),$(this).addClass("product_type_selection"),$("html, body").animate({scrollTop:$("#product_section").offset().top-80},600)}),$(".btn-group-toggle-index .btn").click(function(){var e=$("#id_produto").val(),t=$(this).data("qnt");i(e,t),$(".btn-group-toggle-index .btn").removeClass("active-pack"),$(this).addClass("active-pack"),$("html, body").animate({scrollTop:$("#product_section").offset().top-80},600)}),$(document).on("click",".btn-edit",function(){let e=$(this).data("id");Swal.fire({title:"Edit Local Details",html:'<input id="swal-input1" class="swal2-input" placeholder="Nome do Local"><h2></h2>Imagem:<input id="swal-input2" type="file" class="swal2-file">',focusConfirm:!1,preConfirm(){let t=document.getElementById("swal-input1").value,a=$("#swal-input2").prop("files")[0],r=new FormData;return r.append("file",a),r.append("id",e),r.append("nome_local",t),new Promise(function(e,t){$.ajax({url:"edit_local.php",dataType:"json",cache:!1,contentType:!1,processData:!1,data:r,type:"post",success:function(a){"success"===a.status?e(a):t(Error(a.message||"Unknown error."))},error:function(e){t(Error("Request failed."))}})})}}).then(t=>{if(t.value&&"success"===t.value.status){let a=document.getElementById("swal-input1").value,r=t.value.image_url;a&&$("#nome_local_"+e).text(a),r&&$("#imagem_local_"+e).attr("src",r),Swal.fire("Edited!","Your local has been edited.","success")}else Swal.fire("Error!",t.value.message,"error")})}),$(document).on("click",".btn-delete",function(){let e=$(this).data("id");Swal.fire({title:"Are you sure?",text:"You won't be able to revert this!",icon:"warning",showCancelButton:!0,confirmButtonText:"Yes, delete it!",cancelButtonText:"No, cancel!"}).then(t=>{t.isConfirmed&&$.ajax({url:"delete_local.php",type:"POST",data:{id:e},success:function(t){"success"===t?(Swal.fire("Deleted!","Your local has been deleted.","success"),$("#coluna_"+e).remove()):Swal.fire("Error!","Failed to delete local.","error")},error:function(){Swal.fire("Error!","Request failed. Please try again.","error")}})})}),(void 0!==window.orientation||-1!==navigator.userAgent.indexOf("IEMobile"))&&($("#cards_video_col").remove(),$("#cards_video_col2").removeClass("col-md-6"),$("#cards_video_col2").addClass("col-md-12"),$("#stats_video_col2").remove(),$("#stats_video_col").removeClass("col-md-6"),$("#stats_video_col").addClass("col-md-12"),$(".benefits").addClass("text-center")),$("#send_contact_message").click(function(e){e.preventDefault();var t=$("#contact_name").val().trim(),a=$("#contact_email").val().trim(),r=$("#contact_phone").val().trim(),c=$("#contact_message").val().trim();t&&/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(a)&&/^[+]?[\s.-]?(\d[\s.-]?){7,15}$/.test(r)&&c?$.ajax({type:"POST",url:"send_contact_message.php",data:{nome:t,email:a,telemovel:r,mensagem:c},success:function(e){"success"===e.status?Swal.fire({icon:"success",title:"Message Sent",text:"Your message was sent to us. Have a great day!",confirmButtonText:"Okay"}):Swal.fire({icon:"error",title:"Message Failed",text:"There was an error sending your message. Please try again later...",confirmButtonText:"Okay"})}}):Swal.fire({icon:"warning",title:"Invalid Input",text:"Please ensure all fields are filled correctly.",confirmButtonText:"Okay"})})});
    </script>
    

</body>
</html>
<!--
Website developed by Gabriel Brandão - https://www.github.com/bakill3
2023
-->
