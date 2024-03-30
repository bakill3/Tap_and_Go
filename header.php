<?php 
include 'ligar_db.php';




function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                $output = array(
                    "city"           => @$ipdat->geoplugin_city,
                    "state"          => @$ipdat->geoplugin_regionName,
                    "country"        => @$ipdat->geoplugin_countryName,
                    "country_code"   => @$ipdat->geoplugin_countryCode,
                    "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                    "continent_code" => @$ipdat->geoplugin_continentCode
                );
                break;
                case "address":
                $address = array($ipdat->geoplugin_countryName);
                if (@strlen($ipdat->geoplugin_regionName) >= 1)
                    $address[] = $ipdat->geoplugin_regionName;
                if (@strlen($ipdat->geoplugin_city) >= 1)
                    $address[] = $ipdat->geoplugin_city;
                $output = implode(", ", array_reverse($address));
                break;
                case "city":
                $output = @$ipdat->geoplugin_city;
                break;
                case "state":
                $output = @$ipdat->geoplugin_regionName;
                break;
                case "region":
                $output = @$ipdat->geoplugin_regionName;
                break;
                case "country":
                $output = @$ipdat->geoplugin_countryName;
                break;
                case "countrycode":
                $output = @$ipdat->geoplugin_countryCode;
                break;
            }
        }
    }
    return $output;
}

$ip = $_SERVER['REMOTE_ADDR'];
$user_country = ip_info($ip, "Country");

$user_info = ip_info($ip, "location");

mysqli_begin_transaction($link);

try {
    // Check if IP exists in stats_main
    $stmt = mysqli_prepare($link, "SELECT COUNT(*) FROM stats_main WHERE ip_address = ?");
    mysqli_stmt_bind_param($stmt, "s", $ip);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $ip_count = (int)mysqli_fetch_row($result)[0]; // Cast to integer
    mysqli_stmt_close($stmt);

    // Check if country exists in stats_countries
    $stmt = mysqli_prepare($link, "SELECT id_country FROM stats_countries WHERE country = ?");
    mysqli_stmt_bind_param($stmt, "s", $user_info['country']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $country = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($country) {
        $id_country = $country['id_country'];
        // Update n_times in stats_countries
        $stmt = mysqli_prepare($link, "UPDATE stats_countries SET n_times = n_times + 1" . ($ip_count === 0 ? ", unique_n_times = unique_n_times + 1" : "") . " WHERE id_country = ?");
        mysqli_stmt_bind_param($stmt, "i", $id_country);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        // Insert new country
        $stmt = mysqli_prepare($link, "INSERT INTO stats_countries (country, n_times, unique_n_times) VALUES (?, 1, 1)");
        mysqli_stmt_bind_param($stmt, "s", $user_info['country']);
        mysqli_stmt_execute($stmt);
        $id_country = mysqli_insert_id($link);
        mysqli_stmt_close($stmt);
    }

    // Insert new visit record in stats_main
    $currentDateTime = date("Y-m-d H:i:s");
    $stmt = mysqli_prepare($link, "INSERT INTO stats_main (ip_address, id_country, countrycode, state, region, city, location, address, visit_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sisssssss", $ip, $id_country, $user_info['country_code'], $user_info['state'], $user_info['region'], $user_info['city'], json_encode($user_info), $user_info['address'], $currentDateTime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Commit the transaction
    mysqli_commit($link);
} catch (Exception $e) {
    // Rollback the transaction in case of error
    mysqli_rollback($link);
    error_log($e->getMessage());
    // Consider more graceful error handling for production
}




if (isset($_POST['lingua_eng'])) {
    $_SESSION['language'] = 'en';
} elseif (isset($_POST['lingua_pt'])) {
    $_SESSION['language'] = 'pt';
} elseif (isset($_POST['lingua_fr'])) {
    $_SESSION['language'] = 'fr';
}



if ($user_country == 'United Kingdom') {
    $currency = "£";
    $currency_format = "GBP";
} else {
    $currency = "€";
    $currency_format = "EUR";
}

include 'languages.php';
$language = 'en';

if (isset($_SESSION['language'])) {
    $language = $_SESSION['language'];
} else {
    $portuguese_countries = ['Portugal', 'Brasil'];
    $english_countries = ['United Kingdom', 'Ireland', 'Australia', 'United States', 'Canada', 'New Zealand'];
    $french_countries = ['France', 'Belgium', 'Canada', 'Switzerland'];

    if (in_array($user_country, $portuguese_countries)) {
        $language = 'pt';
    } elseif (in_array($user_country, $english_countries)) {
        $language = 'en';
    } elseif (in_array($user_country, $french_countries)) {
        $language = 'fr';
    }
}



function translate($key) {
    global $translations, $language;
    if (isset($translations[$language][$key])) {
        return $translations[$language][$key];
    } else {
        return "Translation not found";
    }
}

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="author" content="Tap&Go">
    <meta name="theme-color" content="#1e2833" />
    <title>Tap&Go - Boost Your Business With Google Reviews | NFC Cards</title>
    <meta name="description" content="Revolutionize the review process with Tap&Go NFC Cards! Streamline Google reviews for your favorite spots with seamless connectivity to smart devices. Elevate customer engagement, improve reputation, and boost your business with Tap&Go's inclusive technology. Explore our NFC card packs and make your mark on the reviews landscape today! Visit tapgotech.com now!">
    <meta name="keywords" content="NFC cards, Tap&Go NFC, business reviews, Google reviews, customer engagement, NFC for restaurants, NFC analytics, mobile review, SEO tools, digital business cards, Google Maps reviews, TripAdvisor integration, customer feedback, online visibility, restaurant SEO, cafe SEO, digital transformation, NFC technology, insights portal, review monitoring, English version, Portuguese version">
    <meta property="og:image" content="https://www.tapgotech.com/assets/img/logo/logo_black.png" />
    <link rel="canonical" href="https://tapgotech.com/">
    <link rel="alternate" hreflang="en" href="https://tapgotech.com/">
    <link rel="alternate" hreflang="pt-PT" href="https://tapgotech.com/">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/favicon.ico">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap">



    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TGBXLH3Q');</script>
<!-- End Google Tag Manager -->

<!-- CSS here -->
<script src="https://kit.fontawesome.com/1fe4906124.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/slicknav.min.css?ver=0.1">
<link rel="stylesheet" href="assets/css/flaticon.css">
<link rel="stylesheet" href="assets/css/progressbar_barfiller.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/animated-headline.min.css">
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<!-- <link rel="stylesheet" href="assets/css/fontawesome-all.min.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="assets/css/themify-icons.min.css">
<link rel="stylesheet" href="assets/css/slick.css">
<!-- <link rel="stylesheet" href="assets/css/nice-select.css"> -->
<link rel="stylesheet" href="assets/css/style.min.css?ver=0.0141">
<!-- <link href="fontawesome-free-5.0.1/css/fontawesome-all.min.css" rel="stylesheet" type="text/css"> -->


<script src="jquery.min.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js
" defer=""></script>
<link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css
" rel="stylesheet" media="print" onload="this.media='all'">

<!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '853020256397749');
    fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=853020256397749&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->

    <!-- <script src="https://js.stripe.com/v3/"></script> -->


    <?php
        $productTypes = [
            1 => [ // Google Review NFC Cards
                ['qnt' => 1, 'price' => '14.95', 'nameSuffix' => 'Google Review NFC Card', 'imageUrl' => 'https://tapgotech.com/assets/img/products/1_cartao_google.webp'],
                ['qnt' => 5, 'price' => '59.95', 'nameSuffix' => 'Google Review NFC Cards', 'imageUrl' => 'https://tapgotech.com/assets/img/products/5_cartoes_google.webp'],
                ['qnt' => 10, 'price' => '99.95', 'nameSuffix' => 'Google Review NFC Cards', 'imageUrl' => 'https://tapgotech.com/assets/img/products/10_cartoes_google.webp'],
                ['qnt' => 20, 'price' => '159.95', 'nameSuffix' => 'Google Review NFC Cards', 'imageUrl' => 'https://tapgotech.com/assets/img/products/20_cartoes_google.webp'],
                // Add more quantities as needed
            ],
            4 => [ // TripAdvisor NFC Cards
                ['qnt' => 1, 'price' => '14.95', 'nameSuffix' => 'TripAdvisor NFC Card', 'imageUrl' => 'https://tapgotech.com/assets/img/products/1_cartao_tripadvisor.webp'],
                ['qnt' => 5, 'price' => '59.95', 'nameSuffix' => 'TripAdvisor NFC Cards', 'imageUrl' => 'https://tapgotech.com/assets/img/products/5_cartoes_tripadvisor.webp'],
                ['qnt' => 10, 'price' => '99.95', 'nameSuffix' => 'TripAdvisor NFC Cards', 'imageUrl' => 'https://tapgotech.com/assets/img/products/10_cartoes_tripadvisor.webp'],
                ['qnt' => 20, 'price' => '159.95', 'nameSuffix' => 'TripAdvisor NFC Cards', 'imageUrl' => 'https://tapgotech.com/assets/img/products/20_cartoes_tripadvisor.webp'],
                // Add more quantities as needed
            ],
            // Define other product types if needed
        ];

        // Loop through each product type and their variants
        foreach ($productTypes as $id => $variants) {
            foreach ($variants as $variant) {
                $productName = $variant['qnt'] . " " . $variant['nameSuffix'];
                $productUrl = "https://tapgotech.com/index.php?id=" . $id . "&qnt=" . $variant['qnt'];

                $structuredData = [
                    '@context' => 'https://schema.org',
                    '@type' => 'Product',
                    'name' => $productName,
                    'image' => $variant['imageUrl'],
                    'offers' => [
                        '@type' => 'Offer',
                        'priceCurrency' => 'EUR',
                        'price' => $variant['price'],
                        'url' => $productUrl,
                        'availability' => 'https://schema.org/InStock',
                        // Add other offer details as needed
                    ],
                    // Add other product details as needed
                ];

                echo '<script type="application/ld+json">' . json_encode($structuredData, JSON_UNESCAPED_SLASHES) . '</script>';
            }
        }
        ?>



<style>
    .product_type_selection {
        border: 4px solid #007bff !important;
    }
    .cart-container,.overlay{top:0;height:100%;position:fixed}html{scroll-behavior:smooth!important}.btn-outline-secondary:not(.active-pack):hover{background-color:#007bffd9!important;color:#fff!important}@media (max-width:767px){.btn-group-toggle .btn{border-radius:0}}@font-face{font-family:'Suisse Intl';src:url('SuisseIntl-Regular.woff2') format('woff2'),url('SuisseIntl-Regular.woff') format('woff'),url('SuisseIntl-Regular.ttf') format('truetype');font-display:swap}.font-nice{font-family:'Suisse Intl',sans-serif!important}@media screen and (max-width:768px){#li_cart,#video-container-mobile{display:block!important}#li_shop{padding-top:10%!important}#li_cart{padding-top:3%}}body{overflow-x:hidden!important}.cart-container{right:0;width:300px;background-color:#f0f0f0;box-shadow:-2px 0 5px rgba(0,0,0,.2);padding:20px;z-index:9999;transform:translateX(100%);transition:transform .3s ease-in-out}.cart-container.active{transform:translateX(0);box-shadow:-8px 0 6px -6px rgba(0,0,0,.9)}.product{display:flex;align-items:center;margin-bottom:10px;padding:10px;border:1px solid #41454a}.product img{width:80px;height:80px;object-fit:cover;margin-right:10px}.product .info{flex-grow:1}.product .price,strong{font-weight:700}.product .remove-btn{color:red;cursor:pointer}.overlay{left:0;width:100%;background-color:rgba(0,0,0,.8);display:none;z-index:999}.cart-container.active~.overlay{display:block!important;z-index:1001!important}.slicknav_nav[aria-hidden=false]~.overlay{display:block!important}@media (max-width:768px){.cart-container{width:280px}}.slicknav_nav{box-shadow:0 8px 6px -6px rgba(0,0,0,.9);border-radius:0 0 5% 5%}.btns_packs{background-color:#62aeffde}.active-pack{background-color:#007bff!important}.swal2-popup{font-size:1.6rem!important}.StripeElement{width:100%;height:40px}.icons-row{display:flex;justify-content:space-between;background-color:#f4f4f4;padding:10px 20px;height:85px;border-radius:40px;align-items:center;margin:0 auto;width:58%}.platform-icon{width:34%;height:auto;transition:transform .3s}.platform-icon-product:hover,.platform-icon:hover{transform:scale(1.3);cursor:pointer}.platform-icon-product{width:16%;height:auto;transition:transform .3s}.title_accordion{font-weight:600;background-image:none;white-space:normal!important;color:#154cbf!important}.language-selector{position:fixed;bottom:20px;left:20px;z-index:1000}.toggle-checkbox{display:none}.language-options{max-height:0;overflow:hidden;flex-direction:column;align-items:center;position:absolute;left:0;bottom:45px;background-color:#f9f9f9;border-radius:4px;box-shadow:0 0 10px rgba(0,0,0,.1);transition:max-height .3s ease-in-out,opacity .3s ease-in-out;opacity:0}.toggle-checkbox:checked+.globe-icon+.language-options{max-height:500px;opacity:1}.dropdown-item{background-color:#f7f7f7;border:1px solid #ddd;padding:10px 20px;display:flex;align-items:center;cursor:pointer;transition:background-color .2s}.dropdown-item img{margin-right:10px;border-radius:4px}.dropdown-item:hover{background-color:#e7e7e7}.globe-icon{cursor:pointer}.responsive-img{width:100%}@media (min-width:768px){.responsive-container{padding-left:7%;padding-right:7%}.responsive-img{width:80%}}.img-fluid{transition:transform .3s;cursor:pointer}.img-fluid:hover{transform:scale(1.1)}.StripeElement{background-color:#fff;padding:8px 12px;border-radius:4px;border:1px solid transparent;box-shadow:0 1px 3px 0 #e6ebf1;-webkit-transition:box-shadow 150ms;transition:box-shadow 150ms}.StripeElement--focus{box-shadow:0 1px 3px 0 #cfd7df}.StripeElement--invalid{border-color:#fa755a}.StripeElement--webkit-autofill{background-color:#fefde5!important}#scrolling_banner{overflow:hidden;position:relative;white-space:nowrap;box-sizing:border-box;display:flex;align-items:center;justify-content:center}#scrolling_banner span{position:absolute;animation:11s linear infinite scrolling-text}@keyframes scrolling-text{0%{transform:translateX(100%)}100%{transform:translateX(-100%)}}.custom-e3o{display:flex;flex-direction:column;gap:10px;font-size:14px;font-weight:700;margin-top:-7px;padding-bottom:14px}#style-GDZpK.style-GDZpK{display:block}.flashing-text{color:#000;animation:2s infinite flash;font-size:small;font-weight:900}@keyframes flash{0%,100%{opacity:1}50%{opacity:0}}.star-rating{font-size:20px;color:#ebbf20;letter-spacing:-4px}


</style>
</head>

<body <?php if (basename($_SERVER['PHP_SELF']) == 'contact.php') echo ' class="contact-page"'; ?>>
    <?php
    $pagina = basename($_SERVER['PHP_SELF']);
    if ($pagina != 'product.php') {
        ?>
        <!-- ? Preloader Start -->
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="preloader-circle"></div>
                    <div class="preloader-img pere-text">
                        <img src="assets/img/logo/nfc4.webp" alt="Loading">
                    </div>
                </div>
            </div>
        </div>
        <!-- Preloader Start -->
        <?php
    }
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TGBXLH3Q"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-MBQ9YS4JX3"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-MBQ9YS4JX3');
      </script>

    <div class="language-selector">
        <input type="checkbox" id="language-toggle" class="toggle-checkbox">
        <label for="language-toggle" class="globe-icon">
            <img src="/assets/img/globe.webp" alt="Language Selector" width="32" height="32">
        </label>
        <div class="language-options">
            <form method="POST">
                <button type="submit" name="lingua_pt" class="dropdown-item">
                    <img src="/assets/img/pt_flag.webp" alt="PT" width="32" height="32"> Português
                </button>
                <button type="submit" name="lingua_fr" class="dropdown-item">
                    <img src="/assets/img/france.webp" alt="PT" width="32" height="32">Français</button>
                    <button type="submit" name="lingua_eng" class="dropdown-item">
                        <img src="/assets/img/en_flag.webp" alt="EN" width="32" height="32"> English
                    </button>
                </form>
            </div>
        </div>




        <?php 
        if ($language == 'pt') {
            echo "<div class='text-center text-white' style='background-color: #0070de;width: 100%;height: 30px; font-weight: 500;''>Entregas 48/72h em Portugal + Envio Gratuito</div>";
        } elseif ($language == 'en') {
            echo "<div class='text-center text-white' style='background-color: #0070de;width: 100%;height: 30px; font-weight: 500;''>Delivery in 5-7 Business Days with FREE SHIPPING</div>";
        } elseif ($language == 'fr') {
            echo "<div class='text-center text-white' style='background-color: #0070de;width: 100%;height: 30px; font-weight: 500;''>Livraison en 5-7 jours ouvrables avec EXPÉDITION GRATUITE</div>";
        }
        ?>
        <header style="background: rgba(30, 40, 51, 1) !important;
        color: white !important;
        box-shadow: 0px 0px 10px 3px rgba(0, 0, 0, 0.7);
        z-index: 1000 !important;
        position: relative;
        width: 100% !important;
        position: sticky;
        top: 0; z-index: 1000 !important;">
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header">
                <div class="header-bottom">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Mobile Header -->
                            <div class="mobile-header d-flex d-lg-none justify-content-between w-100">
                                <!-- Mobile Menu Button -->
                                <div class="mobile-menu-button">
                                    <div class="mobile_menu d-block d-lg-none">
                                    </div>
                                </div>

                                <!-- Logo -->
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="assets/img/logo/logo_white.png" alt="" style="width: 160px;">
                                    </a>
                                </div>

                                <!-- Cart Icon -->
                                <div class="cart-icon">
                                    <a id="cart_mobile_btn" class="header-btn toggle-btn" style="font-size: 25px;">
                                        <i class="fas fa-shopping-cart fa-xs toggle-btn"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Desktop Layout -->
                            <div class="desktop-header d-none d-lg-flex w-100">
                                <!-- Logo -->
                                <div class="col-xl-2 col-lg-2" id="logo_bar">
                                    <div class="logo">
                                        <a aria-label="Home" href="index.php" style="margin-left: 4vh;">
                                            <img src="assets/img/logo/logo_white.png" alt="" style="width: 160px;">
                                        </a>
                                    </div>
                                </div>

                                <div class="col-xl-10 col-lg-10">
                                    <div class="menu-wrapper d-flex align-items-center justify-content-end" style="height: 100%;">
                                        <!-- Main-menu -->
                                        <div class="main-menu d-none d-lg-block">
                                            <nav>
                                                <ul id="navigation">                                                                                          
                                                    <li><a href="index.php" class="menu_text" style="color: white;"><i class="fas fa-home fa-xs"></i> <?php echo translate('nav_1'); ?></a></li>
                                                    <li><a href="shop.php" class="menu_text" style="color: white;"><i class="fas fa-tag fa-xs"></i> <?php echo translate('nav_2'); ?></a></li>
                                                    <li><a href="contact.php" class="menu_text" style="color: white;"><i class="fas fa-paper-plane fa-xs"></i> <?php echo translate('nav_3'); ?></a></li>
                                                    <li><a href="/dashboard" class="menu_text" style="color: white;"><i class="fas fa-user fa-xs"></i> Dashboard</a></li>
                                                    <li id="reservar_lavagem"><a href="#" class="menu_text btn_scroll_to_products" style="color: white;" id="reservar_lavagem"><i class="fas fa-star fa-xs"></i> <?php echo translate('header_btn'); ?></a></li>
                                                    <li id="reservar_lavagem"><a href="#" class="header-btn toggle-btn"><i class="fas fa-shopping-cart fa-xs"></i> Cart </a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <!-- Header-btn -->
                                        <div class="header-right-btn d-none d-lg-block ml-20">
                                            <button class="btn header-btn btn_scroll_to_products"><?php echo translate('header_btn'); ?></button>
                                            <a class="header-btn toggle-btn" id="toggle-btn" style="cursor: pointer;"><i class="fas fa-shopping-cart toggle-btn"></i>
                                                <?php 
                                            /*
                                                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {  
                                                    echo "<sup><span class='badge badge-primary' id='count_cart_badge'>".count($_SESSION['cart'])."</span></sup>";
                                                } 
                                                */
                                                ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    <main>
        <?php if (isset($_GET['success']) && $_GET['success'] == "true"): ?>
            <div class="alert alert-success" role="alert">
                Réservation effectuée avec succès. Un email vous a été envoyé.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error']) && $_GET['error'] == "true"): ?>
            <div class="alert alert-danger" role="alert">
                Données invalides
            </div>
        <?php endif; ?>
        <!--
        <div id="scrolling_banner" class="text-white btn_scroll_to_products" style="cursor: pointer; background-color: #E91E63; width: 100%; height: 45px; font-weight: 900; font-size: 28px;">
            <span><?php echo translate('black_friday'); ?></span>
        </div>
        -->



        <div class="cart-container" style="background-color: #1e2833;">
            <h2 style="text-align: center;margin: 1%; color: white;"><?php echo translate('cart_title_your'); ?></h2>
            <span style="position: fixed;
            right: 1%;
            left: 3%;
            top: 13px;
            color: black;
            padding: 5px 10px;
            padding: 10px;
            border: none; cursor: pointer; color: white;" id="close_cart"><i class="fa-solid fa-xmark"></i></span>
            <hr>
            <div class="cart-panel" style="overflow-y: auto; height: 70vh;">
              <!-- Your product items will be added here dynamically -->
              <?php   
              if (!empty($_SESSION["cart"])) {  
                $carrinho_num = 0;
                $total = 0;  
                foreach ($_SESSION["cart"] as $keys => $values)  
                { 
                  $carrinho_num++;
                  if ($values["item_quantity"] < 1) { $values["item_quantity"] = 1; }
                  if ($values["item_quantity"] == "") { $values["item_quantity"] = 1; } 
                  ?>
                  <div class="product" style="display: block; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5),
    inset 0 4px 8px rgba(0, 0, 0, 0.3); border-radius: 15px; color: white !important;">
                    <a href="index.php?id=<?php echo $values['item_id']; ?>&qnt=<?php echo $values['qnt_pack']; ?>">
                      <img src="<?php echo $values['item_imagem']; ?>" alt="<?php echo $values['item_name']; ?>" style="vertical-align: super; display: inline-block; width: 29%;">
                      <div class="info" style="display: inline-block; width: 64%; vertical-align: top;">
                        <!-- <p style="font-weight: bold; margin: 0;">x<?php echo $values["item_quantity"]; ?></p> -->
                        <p style="margin: 0; font-weight: bold; color: white;"><?php echo $values["item_name"]; ?></p>
                        <p class="price" style="margin: 0; font-weight: 300; font-size: 15px; color: white;"><?php echo $values["item_quantity"]; ?> X <?php echo $values["item_price"]; ?> = <?php echo $values["item_quantity"] * $values["item_price"]; ?> €</p>
                        <!-- <p class="price" style="margin: 0;"><?php echo $values["item_price"]; ?>€</p> -->
                    </div>
                </a>
                <span class="remove-btn delete-btn btn btn-danger" data-key="<?php echo $keys; ?>" data-itemid="<?php echo $values['item_id']; ?>" style="background-image: none;
                color: #fff;
                background-color: #dc3545;
                border-color: #dc3545;
                width: 100%; padding: 4%;"><i class="fa-solid fa-trash" style="font-weight: bold; position: initial;"></i> <?php echo translate('cart_remove_btn'); ?></span>
                
            </div>
            <?php 
            $total = $total + ($values["item_quantity"] * $values["item_price"]);
            $total_text = "Total: ". number_format($total, 2)." €";
        }
        ?>
        <?php  
    } else {
        $no_items_cart = translate('cart_no_items');
        echo "<h1 id='no_items_cart' class='text-nice' style='font-weight: 600; text-align: center; color: white;'>$no_items_cart</h1>";
    }  
    ?>    
</div>
<h2 id="total_carrinho" style="bottom: 10%; position: fixed; font-weight: bold; color: white;"><?php $total_text = isset($total_text) ? $total_text : "Total: 0.00 €"; echo $total_text; ?></h2>



<a href="checkout.php" class="btn btn-lg btn-primary" style="width: 90%;
bottom: 1.5%;
position: fixed; background-image: none; background-color: #007bff; font-weight: 600;"><?php echo translate('cart_checkout_btn'); ?></a>


</div>
<div class="overlay"></div>


<script>
    $(document).ready(function(){let t=$(".cart-container");$(document).on("click",function(a){let e=$(a.target);e.hasClass("toggle-btn")?t.toggleClass("active"):"close_cart"===e.attr("id")?(a.stopPropagation(),t.removeClass("active")):t.is(e)||0!==t.has(e).length||t.removeClass("active")});let a=$(".slicknav_nav"),e=$(".overlay"),s=$(".slicknav_btn"),i=new MutationObserver(function(t){for(let s of t)if("attributes"===s.type&&"aria-hidden"===s.attributeName){let i=a.attr("aria-hidden");e.css("display","false"===i?"block":"none")}});i.observe(a[0],{attributes:!0}),e.on("click",function(){s.hasClass("slicknav_open")&&s.trigger("click"),e.css("display","none")})});
</script>