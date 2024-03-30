<?php 
include 'header.php';

$scrollToProductSection = false;

if (isset($_GET['id']) && isset($_GET['qnt'])) {
    $scrollToProductSection = true;
}
?>

<!-- slider Area Start-->
<div class="container-fluid" style="padding: 0; margin: 0;">
    <div class="slider-area position-relative">
        <div class="slider-active dot-style">
            <!-- Single Slider -->
            <div class="single-slider hero-overly slider-height slider-bg1 d-flex align-items-center" style="/* height: 100vh !important; */">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-9 col-lg-11 col-md-11">
                            <div class="hero__caption">
                                <div id="titulo_main_page">
                                    <h1 data-animation="fadeInUp" data-delay=".2s" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">Tap&Go</h1>
                                    <div class="stock-text" data-animation="fadeInUp" data-delay=".8s">
                                        <h2 style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">& More</h2>
                                        <h2 style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);">& More</h2>
                                    </div>
                                </div>
                                <div class="hero-details" id="texto_main_page">

                                    <P class="font-nice" id="texto_main_page_secondary" data-animation="fadeInUp" data-delay=".4s" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 1);"><?php echo translate('home_content'); ?></P>
                                    <!-- Hero-btn -->
                                    <div class="hero__btn">
                                        <a href="#" id="btn_homepage" class="btn mb-10"  data-animation="fadeInUp" data-delay=".8s"><?php echo translate('home_btn'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider Area End-->

<!--? Office environment  Start assets/img/gallery/section_bg02_compressed.png -->
<section class="office-environments wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s" style="background: none; visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
    <div class="container" style="padding-top: 5%;
    padding-right: 3%;
    padding-left: 3%;">
    <div class="environments-wrapper section-bg02" data-background="assets/img/hero/background_mobile_example.webp" style="border-radius: 10px;
        /* box-shadow: 0 0 10px #888, 0 0 20px #777, 0 0 30px #666, 0 0 40px #555, 0 0 50px #444;
        padding: 0; */">
        <div class="row">
            <div class="col-xl-7 col-lg-8 offset-xl-5 offset-lg-4">
                <div class="office-pera" id="office-pera">
                    <div class="section-tittle">
                        <h2 class="mb-30 font-nice" style="font-weight: 600 !important;" id="first_title"><?php echo translate('section_1_title'); ?> </h2>
                        <img id="imagem_homepage" src="assets/img/hero/background_mobile_example_short.webp" loading="lazy" style="width: 100%; display: none;">
                        <p class="font-nice"><?php echo translate('section_1_text'); ?></p>
                        <button class="btn btn-lg btn-primary btn_scroll_to_products" style="width: 100%; font-weight: 500;"><?php echo translate('section_1_btn'); ?></button>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<div class="video-container" style="position: relative; width: 100%; height: 70vh; overflow: hidden;">
    <!-- Video tag -->
    <video class="lazyload-video" preload="none" autoplay loop muted playsinline style="width: 100%; height: 100%; object-fit: cover;">
        <source data-src="background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

    <!-- Title 
    <div class="section-tittle" style="position: absolute; bottom: 10px; left: 0; right: 0; text-align: center; z-index: 1;">
        <h2 class="mb-30 font-nice" style="font-weight: 500 !important; color: white; text-align: center;">Enhance your business's image</h2>
    </div> -->
</div>
<!-- Office environment  End-->
<section class="office-environments wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s" style="margin-top: 5%; background-color: white; visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
    <div class="container">
        <div class="row">
            <div class="col-md-6" id="cards_video_col" style="position: relative; width: 100%; padding-bottom: 56.25%; overflow: hidden; border-radius: 10px;">
                <video class="lazyload-video" preload="none" autoplay loop muted playsinline style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" type="video/mp4">
                    <source data-src="cards.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>

                </div>
                <div class="col-md-6" id="cards_video_col2">
                    <div class="office-pera">
                        <div class="section-tittle">
                            <h2 class="mb-30 font-nice" style="font-weight: 600 !important;"><?php echo translate('section_2_title'); ?></h2>
                            <p><?php echo translate('section_2_text'); ?></p>
                            <a href="https://www.youtube.com/watch?v=uNEmF3V_c1k" class="btn popup-video" style="width: 100%;background-image: none;background-color: #007bff;font-family: 'Work Sans';"><?php echo translate('section_2_btn'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    




        <section class="categories-area section-padding40" style="margin-top: 2%;">
            <div class="container">

                <div class="row">
                    <div class="col-xl-6 col-lg-7 col-md-10 col-sm-11">
                        <div class="section-tittle mb-60">
                            <h2 class="text-nice benefits" style="letter-spacing: -.04em; font-weight: 600;"><?php echo translate('section_3_title'); ?></h2>
                            <p class="benefits"><?php echo translate('section_3_text'); ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 benefits">
                        <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <div class="cat-icon">
                                <i class="fas fa-4x fa-chart-line" style="margin-bottom: 7%;"></i>
                            </div>
                            <div class="cat-cap">
                                <h5 class="text-nice"><?php echo translate('section_3_benefit_1_title'); ?></h5>
                                <p><?php echo translate('section_3_benefit_1_text'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 benefits">
                        <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <div class="cat-icon">
                                <i class="fas fa-4x fa-mobile-alt" style="margin-bottom: 7%;"></i>
                            </div>
                            <div class="cat-cap">
                                <h5 class="text-nice"><?php echo translate('section_3_benefit_2_title'); ?></h5>
                                <p><?php echo translate('section_3_benefit_2_text'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 benefits">
                        <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".4s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.4s; animation-name: fadeInUp;">
                            <div class="cat-icon">
                                <i class="fas fa-4x fa-briefcase" style="margin-bottom: 7%;"></i>
                            </div>
                            <div class="cat-cap">
                                <h5 class="text-nice"><?php echo translate('section_3_benefit_3_title'); ?></h5>
                                <p><?php echo translate('section_3_benefit_3_text'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 benefits">
                        <div class="single-cat mb-50 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeInUp;">
                            <div class="cat-icon">
                                <i class="fas fa-4x fa-chart-pie" style="margin-bottom: 7%;"></i>
                            </div>
                            <div class="cat-cap">
                                <h5 class="text-nice"><?php echo translate('section_3_benefit_4_title'); ?></h5>
                                <p><?php echo translate('section_3_benefit_4_text'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="stats_video"></div>
        <section class="office-environments wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s" style="margin-top: 5%; background-color: white; visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6" id="stats_video_col">
                        <div class="office-pera">
                            <div class="section-tittle">
                                <h2 class="mb-30 font-nice" style="font-weight: 600 !important;"><?php echo translate('new_section_title'); ?></h2>
                                <p><?php echo translate('new_section_text'); ?></p>
                                <a href="https://www.youtube.com/watch?v=VSATSMfUHpA" class="btn popup-video" style="width: 100%;background-image: none;background-color: #007bff;font-family: 'Work Sans';"><?php echo translate('section_2_btn'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="stats_video_col2" style="position: relative; width: 100%; padding-bottom: 56.25%; overflow: hidden; border-radius: 10px;">
                        <video class="lazyload-video" preload="none" autoplay loop muted playsinline style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                            <source data-src="statistics.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                    </div>
                </div>
            </div>
        </section>
        <hr>


        <?php 
        if (isset($_GET['id'])) {
            $id = htmlspecialchars(mysqli_real_escape_string($link, $_GET['id']));
            $id = preg_replace('/[^0-9]/', '', $id);
        } else {
            $id = 1;
        }

        if (isset($_GET['qnt'])) {
            $qnt = htmlspecialchars(mysqli_real_escape_string($link, $_GET['qnt']));
            $qnt = preg_replace('/[^0-9]/', '', $qnt);
        } else {
            $qnt = 1;
        }



        if ($qnt == 1 || $qnt == 5 || $qnt == 10 || $qnt == 20) {
        //funcionou
        } else {
            echo "<script>window.location.href='index.php';</script>";
        }

        $query = mysqli_query($link, "SELECT * FROM products WHERE id='$id'");
        if (mysqli_num_rows($query) == 0) {
            echo "<script>window.location.href='index.php?id=$id&qnt=5';</script>";
        } else {
            while ($info = mysqli_fetch_array($query)) {
                $nome = $info['nome'];
                $descricao = $info['descricao'];
                $price_pack_1 = $info['price_pack_1'];
                $price_pack_5 = $info['price_pack_5'];
                $price_pack_10 = $info['price_pack_10'];
                $price_pack_20 = $info['price_pack_20'];
                $stock = $info['stock'];
                $imagem_1_pack = $info['imagem_1_pack'];
                $imagem_5_pack = $info['imagem_5_pack'];
                $imagem_10_pack = $info['imagem_10_pack'];
                $imagem_20_pack = $info['imagem_20_pack'];

                if ($qnt == 1) {
                    $imagem = $imagem_1_pack;
                    $price = $price_pack_1;
                } elseif ($qnt == 5) {
                    $imagem = $imagem_5_pack;
                    $price = $price_pack_5;
                } elseif ($qnt == 10) {
                    $imagem = $imagem_10_pack;
                    $price = $price_pack_10;
                } elseif ($qnt == 20) {
                    $imagem = $imagem_20_pack;
                    $price = $price_pack_20;
                }
            }
            if ($qnt == 1) {
                //$nome = str_replace("Cards", "Card", $nome);
            }
        }
        $extra_price = "";
        ?>

        <section id="product_section" class="py-5 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp; padding-bottom: 0% !important;" >
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6">
                        <div class="image-icons-container" style="text-align: center;">
                            <div class="position-relative">
                                <img id="imagem_produto" class="card-img-top mb-5 mb-md-0" src="<?php echo $imagem; ?>" loading="lazy" alt="..." style='border-radius: 5%; width: 85%;'/>
                                <span class="badge badge-primary position-absolute" style="top: 10px; right: 10px;">Free EU Shipping</span>
                            </div>
                            <div class="icons-row">
                                <img id="google_link" src="https://img.icons8.com/color/240/google-logo.png" loading="lazy" alt="Google Icon" class="platform-icon" data-id="1">
                                <img id="tripadvisor_link" src="https://img.icons8.com/color/240/tripadvisor.png" loading="lazy" alt="TripAdvisor Icon" class="platform-icon" data-id="4">
                                <img id="instagram_link" src="https://img.icons8.com/fluency/240/instagram-new.png" loading="lazy" alt="Instagram Icon" class="platform-icon" data-id="5">
                                <img id="whatsapp_link" src="https://img.icons8.com/color/240/whatsapp--v1.png" loading="lazy" alt="WhatsApp Icon" class="platform-icon" data-id="6">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="small mb-1"><!-- text --></div>
                        <h1 class="display-5 fw-bolder text-center-mobile" style="font-family: 'Suisse Intl', sans-serif !important; font-weight: 800; font-size: xx-large; margin-top: 10px !important; margin-bottom: 10px !important;"><?php echo "<span id='qnt_title'>".$qnt."</span> <span id='title_type'>".$nome; ?></span></h1>
                        <div class="fs-5 mb-5 text-center-mobile" style="font-size: large; margin-bottom: 2rem !important;">
                            <span id="product_price_display" style="font-weight: 700; font-size: 30px; color: #53c57f !important;"><?php echo $price; ?> €</span>
                            <span class="text-decoration-line-through" style="text-decoration: line-through; color: #b20202;" id="product_extra_price_display"><?php if (!empty($extra_price)) { echo $extra_price." €"; } ?></span>

                        </div>

                        <p class="lead" id="description_product" style="font-family: 'Suisse Intl', sans-serif !important; font-size: initial !important;"><?php echo $descricao; ?></p>
                        <input type="hidden" id="id_produto" value="<?php echo $id; ?>">
                        <input type="hidden" id="qnt" value="<?php echo $qnt; ?>">
                        <div class="d-flex">

                            <button class="btn btn-outline-dark flex-shrink-0" type="button" id="add_to_cart" style="background-image: none;
                            background-color: #154cbf;
                            font-family: 'Work Sans';" <?php if ($stock == '0') { echo "disabled"; } ?>>
                            <?php if ($stock == '0') { echo "<span style='color: red; font-weight: 700; color: #330000;'>Out of Stock</span>"; } else { echo translate('add_cart_btn'); } ?>
                        </button>

                    </div>
                    <hr id="hr_product">
                    <div>
                        <div class="btn-group btn-group-toggle-index d-flex flex-column flex-sm-row text-center" >
                            <button class="btn btn-outline-secondary btns_packs" style="background-image: none !important; padding-left: 6% !important;
    padding-right: 6% !important;" data-qnt="1">
                                Single Pack <hr style="margin: 0%; padding: 1%;">
                            </button>
                            <button class="btn btn-outline-secondary btns_packs" style="background-image: none !important; padding-left: 6% !important;
    padding-right: 6% !important;" data-qnt="5">
                                Basic Pack <hr style="margin: 0%; padding: 1%;"> <!-- <span class="badge badge-danger">52% OFF</span> -->
                            </button>
                            <button class="btn btn-outline-secondary btns_packs" style="background-image: none !important; padding-left: 6% !important;
    padding-right: 6% !important;" data-qnt="10">
                                Valued Pack <hr style="margin: 0%; padding: 1%;">  <!-- <span class="badge badge-danger">60% OFF</span> -->
                            </button>
                            <button class="btn btn-outline-secondary btns_packs" style="background-image: none !important; padding-left: 6% !important;
    padding-right: 6% !important;" data-qnt="20">
                                Premium Pack <hr style="margin: 0%; padding: 1%;">  <!-- <span class="badge badge-danger">68% OFF</span> -->
                            </button>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>

        

    </section>
    <div class="container-fluid responsive-container">
        <div class="row text-center">
            <div class="col-12 col-md-6 px-md-3">
                <img class="responsive-img" src="/assets/img/third-party-trust-badge.webp" alt="Trust Badge">
            </div>
            <div class="col-12 col-md-6 px-md-3">
                <a href="https://stripe.com/docs/security" target="_blank">
                    <img class="responsive-img" src="/assets/img/stripe-badge-white.webp" alt="Stripe">
                </a>
            </div>
            
            
        </div>
        <hr>
    </div>




    <div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        
        <div class="col-12 col-md-8">
            <div class="card">
                <!-- Jumbotron-Style Header -->
                <div class="card-header text-center text-white">
                    <h2>FAQ</h2>
                </div>
                <div class="card-body">

                        <!-- FAQ 1 -->
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left title_accordion" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <?php echo translate('faq_title_1'); ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#faqAccordion">
                                <div class="card-body" style="padding: 2%;">
                                    <?php echo translate('faq_text_1'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left title_accordion collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <?php echo translate('faq_title_2'); ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                                <div class="card-body" style="padding: 2%;">
                                    <?php echo translate('faq_text_2'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left title_accordion collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <?php echo translate('faq_title_3'); ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                                <div class="card-body" style="padding: 2%;">
                                    <?php echo translate('faq_text_3'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="card">
                            <div class="card-header" id="headingFour">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left title_accordion collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        <?php echo translate('faq_title_4'); ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#faqAccordion">
                                <div class="card-body" style="padding: 2%;">
                                    <?php echo translate('faq_text_4'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 5 -->
                        <div class="card">
                            <div class="card-header" id="headingFive">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left title_accordion collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <?php echo translate('faq_title_5'); ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <?php echo translate('faq_text_5'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ 6 -->
                        <div class="card">
                            <div class="card-header" id="headingSix">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left title_accordion collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        <?php echo translate('faq_title_6'); ?>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#faqAccordion">
                                <div class="card-body">
                                    <?php echo translate('faq_text_6'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>






    <!--? Pricing Card Start -->

    <section class="pricing-card-area fix section-padding30">
        <div class="container">
            <div class="row justify-content-center">
                <div class=""> <!-- col-xl-6 col-lg-7 col-md-10 -->
                    <div class="section-tittle text-center mb-90">
                        <h2 class="text-nice" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); text-align: center; line-height: 1; letter-spacing: -.04em;"><?php echo translate('section_5_title'); ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10 wow fadeInUp" data-wow-duration="0.7s" data-wow-delay=".2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;" >
                    <div class="single-card text-center mb-30">
                        <div class="card-top">
                            <!-- <img src="assets/img/icon/price1.svg" alt=""> -->
                            <i class="fas fa-cube fa-3x" style="margin: 5%;"></i>

                            <h4><?php echo translate('section_5_pack_1_title'); ?></h4>
                            <p><?php echo translate('section_5_pack_1_subtitle'); ?></p>
                        </div>
                        <div class="card-mid">
                            <h4><?php echo translate('section_5_pack_1_price'); ?></h4>
                            <span class="text-decoration-line-through" style="text-decoration: line-through;"><?php echo translate('section_5_pack_1_oldprice'); ?></span>
                        </div>
                        <div class="card-bottom">
                            <ul>
                                <li style="font-weight: bold;"><?php echo translate('section_5_pack_1_cardnumbers'); ?></li>
                                <li><?php echo translate('section_5_pack_1_benefit_1'); ?></li>
                                <li><?php echo translate('section_5_pack_1_benefit_2'); ?></li>
                                <li><?php echo translate('section_5_pack_1_benefit_3'); ?></li>
                                <li><?php echo translate('section_5_pack_1_benefit_4'); ?></li>
                            </ul>
                            <a href="index.php?id=1&qnt=5" class="borders-btn"><?php echo translate('section_5_packs_btn'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10 wow fadeInUp" data-wow-duration="0.7s" data-wow-delay=".2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;" >
                    <div class="single-card text-center mb-30">
                        <div class="card-top">
                            <!-- <img src="assets/img/icon/price1.svg" alt=""> -->
                            <i class="fas fa-microchip fa-3x" style="margin: 5%;"></i>

                            <h4><?php echo translate('section_5_pack_2_title'); ?></h4>
                            <p><?php echo translate('section_5_pack_2_subtitle'); ?></p>
                        </div>
                        <div class="card-mid">
                            <h4><?php echo translate('section_5_pack_2_price'); ?></h4>
                            <span class="text-decoration-line-through" style="text-decoration: line-through;"><?php echo translate('section_5_pack_2_oldprice'); ?></span>
                        </div>
                        <div class="card-bottom">
                            <ul>
                                <li style="font-weight: bold;"><?php echo translate('section_5_pack_2_cardnumbers'); ?></li>
                                <li><?php echo translate('section_5_pack_2_benefit_1'); ?></li>
                                <li><?php echo translate('section_5_pack_2_benefit_2'); ?></li>
                                <li><?php echo translate('section_5_pack_2_benefit_3'); ?></li>
                                <li><?php echo translate('section_5_pack_2_benefit_4'); ?></li>
                            </ul>
                            <a href="index.php?id=1&qnt=10" class="borders-btn"><?php echo translate('section_5_packs_btn'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-10 wow fadeInUp" data-wow-duration="0.7s" data-wow-delay=".2s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInUp;" >
                    <div class="single-card text-center mb-30">
                        <div class="card-top">
                            <!-- <img src="assets/img/icon/price1.svg" alt=""> -->
                            <i class="fas fa-star fa-3x" style="margin: 5%;"></i>
                            <h4><?php echo translate('section_5_pack_3_title'); ?></h4>
                            <p><?php echo translate('section_5_pack_3_subtitle'); ?></p>
                        </div>
                        <div class="card-mid">
                            <h4><?php echo translate('section_5_pack_3_price'); ?></h4>

                            <span class="text-decoration-line-through" style="text-decoration: line-through;"><?php echo translate('section_5_pack_3_oldprice'); ?></span>
                            <h5 class="badge badge-primary" style="color: white;">Best Offer</h5>
                        </div>
                        <div class="card-bottom">
                            <ul>
                                <li style="font-weight: bold;"><?php echo translate('section_5_pack_3_cardnumbers'); ?></li>
                                <li><?php echo translate('section_5_pack_3_benefit_1'); ?></li>
                                <li><?php echo translate('section_5_pack_3_benefit_2'); ?></li>
                                <li><?php echo translate('section_5_pack_3_benefit_3'); ?></li>
                                <li><?php echo translate('section_5_pack_3_benefit_4'); ?></li>
                            </ul>
                            <a href="index.php?id=1&qnt=20" class="borders-btn"><?php echo translate('section_5_packs_btn'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var lazyVideos = [].slice.call(document.querySelectorAll(".lazyload-video"));

            if ("IntersectionObserver" in window) {
                var videoObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(video) {
                        if (video.isIntersecting) {
                            for (var source of video.target.children) {
                                source.setAttribute('src', source.getAttribute('data-src'));
                            }
                            video.target.load();
                            video.target.play();
                            videoObserver.unobserve(video.target);
                        }
                    });
                });

                lazyVideos.forEach(function(video) {
                    videoObserver.observe(video);
                });
            }

            var scrollToProductsBtns = document.querySelectorAll(".btn_scroll_to_products");

            scrollToProductsBtns.forEach(function(btn) {
                btn.addEventListener("click", function() {
                    var productSection = document.querySelector("#product_section");
                    if (productSection) {
                        var positionToScroll = productSection.getBoundingClientRect().top + window.pageYOffset - 80;
                        window.scrollTo({
                            top: positionToScroll,
                            behavior: 'smooth'
                        });
                    }
                });
            });


        });

    </script>
    <script>
        $(document).ready(function() {
            function isMobile() {
                return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            }

            if (isMobile()) {
                $('.slider-bg1').css('background-image', 'url(/new_background_rascunho.png) !important');

                $('#titulo_main_page').remove();

                $('#texto_main_page_secondary').remove();

                $('#btn_homepage').css({
                    'position': 'fixed',
                    'width': '90%',
                    'top': '70%',
                    'font-family': "'Work Sans'",
                    'font-size': '20px',
                    'background-image': 'linear-gradient(to left, #2b333c, #1e1f24, #343744)'
                });
                $('.slider-height').css('min-height', '90vh');
        /* $('.header-area').css('background-image', 'linear-gradient(to bottom, #17181c, #15161a, #15161a)'); */
            }
            $("#btn_homepage").click(function(e) {
                e.preventDefault();  
                $('html, body').animate({
                    scrollTop: $("#first_title").offset().top - 140
                }, 600);
            });
        });
    </script>
    <?php if ($scrollToProductSection): ?>
        <script>
            window.addEventListener("DOMContentLoaded", function() {
                var productSection = document.querySelector("#product_section");
                if (productSection) {
                    productSection.scrollIntoView({ behavior: 'smooth' });
                }
            });
        </script>
    <?php endif; ?>
    
    <?php 
    include 'footer.php';
?>