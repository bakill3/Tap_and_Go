<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../ligar_db.php';
if (!isset($_SESSION['login_dashboard'])) {
    header('Location: login.php');
    exit(0);
}
$id = $_SESSION['login_dashboard'][0];
$username = $_SESSION['login_dashboard'][1];
$nome = $_SESSION['login_dashboard'][2];
$apelido = $_SESSION['login_dashboard'][3];
$morada = $_SESSION['login_dashboard'][4];
$cidade = $_SESSION['login_dashboard'][5];
$pais = $_SESSION['login_dashboard'][6];
$id_local = $_SESSION['login_dashboard'][7];
$email = $_SESSION['login_dashboard'][8];
$role = $_SESSION['login_dashboard'][9];

if ($role == 0) {
    $query_txt = "SELECT 
    l.*,
    COALESCE(today_usage.todays_count, 0) AS todays_usage,
    COALESCE(total_usage.total_count, 0) AS total_usage,
    COALESCE(last_7_days_usage.day_count, 0) AS last_7_days_usage,
    COALESCE(os_usage.android_percentage, 0) AS android_percentage,
    COALESCE(os_usage.iphone_percentage, 0) AS iphone_percentage,
    COALESCE(os_usage.other_percentage, 0) AS other_percentage
    FROM locals l
    JOIN users u ON u.id_local = l.id_local
    LEFT JOIN (
        SELECT id_local, COUNT(id_link) AS todays_count
        FROM locals_links 
        WHERE DATE(data) = CURDATE()
        GROUP BY id_local
        ) AS today_usage ON l.id_local = today_usage.id_local
    LEFT JOIN (
        SELECT id_local, COUNT(id_link) AS total_count
        FROM locals_links
        GROUP BY id_local
        ) AS total_usage ON l.id_local = total_usage.id_local
    LEFT JOIN (
        SELECT id_local, COUNT(id_link) AS day_count
        FROM locals_links 
        WHERE data BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()
        GROUP BY id_local
        ) AS last_7_days_usage ON l.id_local = last_7_days_usage.id_local
    LEFT JOIN (
        SELECT 
        id_local,
        SUM(CASE WHEN sistema_operativo = 'Android' THEN 1 ELSE 0 END) / COUNT(id_link) * 100 AS android_percentage,
        SUM(CASE WHEN sistema_operativo = 'iPhone' THEN 1 ELSE 0 END) / COUNT(id_link) * 100 AS iphone_percentage,
        SUM(CASE WHEN sistema_operativo NOT IN ('Android', 'iPhone') THEN 1 ELSE 0 END) / COUNT(id_link) * 100 AS other_percentage
        FROM locals_links
        GROUP BY id_local
        ) AS os_usage ON l.id_local = os_usage.id_local
    WHERE u.id = ?;";  
} else {
    $query_txt = "
    SELECT 
    l.*,
    COALESCE(today_usage.todays_count, 0) AS todays_usage,
    COALESCE(total_usage.total_count, 0) AS total_usage,
    COALESCE(last_7_days_usage.day_count, 0) AS last_7_days_usage,
    COALESCE(os_avg_percentage.avg_android_percentage, 0) AS android_percentage,
    COALESCE(os_avg_percentage.avg_iphone_percentage, 0) AS iphone_percentage,
    COALESCE(os_avg_percentage.avg_other_percentage, 0) AS other_percentage
    FROM locals l
    LEFT JOIN (
        SELECT COUNT(id_link) AS todays_count
        FROM locals_links 
        WHERE DATE(data) = CURDATE()
        ) AS today_usage ON 1 = 1
    LEFT JOIN (
        SELECT COUNT(id_link) AS total_count
        FROM locals_links
        ) AS total_usage ON 1 = 1
    LEFT JOIN (
        SELECT COUNT(id_link) AS day_count
        FROM locals_links 
        WHERE data BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()
        ) AS last_7_days_usage ON 1 = 1
    LEFT JOIN (
        SELECT 
        AVG(android_percentage) AS avg_android_percentage,
        AVG(iphone_percentage) AS avg_iphone_percentage,
        AVG(other_percentage) AS avg_other_percentage
        FROM (
            SELECT 
            id_local,
            SUM(CASE WHEN sistema_operativo = 'Android' THEN 1 ELSE 0 END) / COUNT(id_link) * 100 AS android_percentage,
            SUM(CASE WHEN sistema_operativo = 'iPhone' THEN 1 ELSE 0 END) / COUNT(id_link) * 100 AS iphone_percentage,
            SUM(CASE WHEN sistema_operativo NOT IN ('Android', 'iPhone') THEN 1 ELSE 0 END) / COUNT(id_link) * 100 AS other_percentage
            FROM locals_links
            GROUP BY id_local
            ) AS individual_percentages
    ) AS os_avg_percentage ON 1 = 1";



}



$stmt = mysqli_prepare($link, $query_txt);
if ($role == 0) {
    mysqli_stmt_bind_param($stmt, 'i', $id);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$info = mysqli_fetch_assoc($result);
$localId = $info['id_local'];
$localName = $info['nome_local'];
$localLink = $info['link_local'];
$localLogo = $info['logo_url'];
$todayUsage = $info['todays_usage'];
$totalUsage = $info['total_usage'];
$last7DaysUsage = $info['last_7_days_usage'];

$androidPercentage = $info['android_percentage'];
$iphonePercentage = $info['iphone_percentage'];
$otherPercentage = $info['other_percentage'];


if (isset($_POST['adicionar_local'])) {
    $nome_local = htmlspecialchars(mysqli_real_escape_string($link, $_POST['nome_local']));
    $link_local = $_POST['link_local'];

    if (!empty($nome_local) && !empty($link_local)) {

        // Check for uploaded file
        if (isset($_FILES['uploaded_image'])) {

            $file_tmp = $_FILES['uploaded_image']['tmp_name'];
            $file_name = basename($_FILES['uploaded_image']['name']);

            // Ensure the directory exists
            $dir = __DIR__ . "/../assets/img/uploaded_locals/";
            if (!is_dir($dir)) {
                echo "The directory does not exist.";
                exit; // Exit the script if directory doesn't exist
            }
            
            $target_file = $dir . $file_name;
            
            // Attempt to move the uploaded file to the target location
            if (move_uploaded_file($file_tmp, $target_file)) {
                echo "The file has been uploaded.";
            } else {
                echo "There was an error uploading your file.";
                exit; // Exit the script if there's an error in moving the file
            }
            $image_final = "/assets/img/uploaded_locals/".$file_name;
            
            // At this point, the file is uploaded successfully, so we proceed to the database insertion
            mysqli_query($link, "INSERT INTO locals(nome_local, link_local, logo_url) VALUES('$nome_local', '$link_local', '$image_final');") or die(mysqli_error($link));
            
            $id_local = mysqli_insert_id($link);
            $link_redirect = "https://tapgotech.com/redirect.php?id=$id_local";
            
            //session_destroy();  // Uncomment this if you want to destroy the session
            
            $_SESSION['admin_link'] = $link_redirect;
            //echo "<script>window.location.href='index.php';</script>";
            header('Location: index.php');
            exit(0);
        } else {
            echo "No file was uploaded.";
        }
    }
}


?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tap&Go - Dashboard</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/aos.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo/favicon.ico">
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js
    "></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css
    " rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark toggled" id="navbar_dashboard">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon rotate-n-15"></div>
                <div class="sidebar-brand-text mx-3"><img src="assets/img/logo_white.png" width="163" height="89" style="margin-right: 15px;"></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li class="nav-item"></li>
                <li class="nav-item"></li>
                <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user-cog"></i><span>Settings</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/index.php"><i class="fas fa-home"></i><span>Tap&Go</span></a></li>
                <li class="nav-item"><a class="nav-link" href="/logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
            </ul>
            <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                    <h1 class="display-6" data-aos="fade-left"><strong><?php if($role==0) { echo $localName; } else { echo "Admin Panel"; } ?></strong></h1>
                    <ul class="navbar-nav flex-nowrap ms-auto">
                        <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                            <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="me-auto navbar-search w-100">
                                    <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                        <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid" style="color: rgb(54, 185, 204);">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-dark mb-0">Dashboard</h3>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span style="color: rgb(54, 185, 204);">Today's Card usage</span></div>
                                        <div class="text-dark fw-bold h5 mb-0"><span><?php echo $todayUsage; ?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-sync fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span style="color: rgb(28, 200, 138);">total Card usage</span></div>
                                        <div class="text-dark fw-bold h5 mb-0"><span><?php echo $totalUsage; ?></span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Today's Reviews</span></div>
                                        <div class="text-dark fw-bold h5 mb-0"><span>--</span></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-comments fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-start-warning py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col me-2">
                                        <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>total reviews</span></div>
                                        <div class="text-dark fw-bold h5 mb-0"><span>--</span></div>
                                    </div>
                                    <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -32 576 576" width="1em" height="1em" fill="currentColor" class="fa-2x text-gray-300">
                                        <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                        <path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path>
                                    </svg></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                // Preparing dates array for the last 7 days
                $dates = [];
                for ($i = 6; $i >= 0; $i--) {
                    $dates[] = date('d/m', strtotime("-{$i} days"));
                }
                $dayTotals = array_fill(0, 7, 0); // Initializing with zeros

                if ($role == 0) {
                    $query_daily_usage = "
                    SELECT DATE(data) AS day_date, COUNT(id_link) AS day_count 
                    FROM locals_links 
                    WHERE id_local = ? AND data >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
                    GROUP BY DATE(data) 
                    ORDER BY day_date ASC;
                    ";
                    $stmt = mysqli_prepare($link, $query_daily_usage);
                    mysqli_stmt_bind_param($stmt, 'i', $id_local);
                } else {
                    $query_daily_usage = "
                    SELECT DATE(data) AS day_date, COUNT(id_link) AS day_count 
                    FROM locals_links WHERE data >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                    GROUP BY DATE(data) 
                    ORDER BY day_date ASC;
                    ";
                    $stmt = mysqli_prepare($link, $query_daily_usage);
                }

                
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (!$result) {
                    printf("Error: %s\n", mysqli_error($link));
                    exit();
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    $index = array_search(date('d/m', strtotime($row['day_date'])), $dates);
                    if($index !== false) {
                        $dayTotals[$index] = $row['day_count'];
                    }
                }
                ?>
                <div class="row">
                    <div class="col-lg-7 col-xl-8">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary fw-bold m-0">Weekly Card Usage Over Time</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area">

                                    <canvas data-bss-chart='{"type":"line","data":{"labels":["<?php echo implode('","', $dates); ?>"],"datasets":[{"label":"Daily Card Usage","fill":true,"data":[<?php echo implode(',', $dayTotals); ?>],"backgroundColor":"rgba(78, 115, 223, 0.05)","borderColor":"rgba(78, 115, 223, 1)"}]},"options":{"maintainAspectRatio":false,"legend":{"display":false,"labels":{"fontStyle":"normal"},"position":"left"},"title":{"fontStyle":"normal"},"scales":{"xAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"],"drawOnChartArea":false},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}],"yAxes":[{"gridLines":{"color":"rgb(234, 236, 244)","zeroLineColor":"rgb(234, 236, 244)","drawBorder":false,"drawTicks":false,"borderDash":["2"],"zeroLineBorderDash":["2"]},"ticks":{"fontColor":"#858796","fontStyle":"normal","padding":20}}]}}}'></canvas>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="text-primary fw-bold m-0">Most Operating Systems Used</h6>
                                <div class="dropdown no-arrow"><button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" type="button"><i class="fas fa-ellipsis-v text-gray-400"></i></button>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--fade-in">
                                        <p class="text-center dropdown-header">dropdown header:</p><a class="dropdown-item" href="#">&nbsp;Action</a><a class="dropdown-item" href="#">&nbsp;Another action</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#">&nbsp;Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area"><canvas data-bss-chart="{&quot;type&quot;:&quot;pie&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Android&quot;,&quot;iPhone&quot;,&quot;Other&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;<?php echo $androidPercentage; ?>&quot;,&quot;<?php echo $iphonePercentage; ?>&quot;,&quot;<?php echo $otherPercentage; ?>&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;},&quot;reverse&quot;:false},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}}"></canvas></div>
                                <div class="text-center small mt-4"><span class="me-2"><i class="fas fa-circle text-primary"></i>&nbsp;Android</span><span class="me-2"><i class="fas fa-circle text-success"></i>iPhone</span><span class="me-2"><i class="fas fa-circle text-info"></i>&nbsp;Other</span></div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    if ($role != 0) {
                        ?>

                        <!-- !!! -->
                        <?php 
                        $result = mysqli_query($link, "SELECT l.*, COUNT(ll.id_link) AS link_count FROM locals l LEFT JOIN locals_links ll ON l.id_local = ll.id_local GROUP BY l.id_local");
                        $modals = "";
                        ?>
                        <hr>
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <h2 class="text-primary m-0 fw-bold text-center">Estabelecimentos</h2>
                                </div>
                                <div class="card-body">


                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Local</th>
                                                    <th scope="col">Imagem</th>
                                                    <th scope="col">Link</th>
                                                    <th scope="col">Accessos</th>
                                                    <th scope="col">Detalhes</th>
                                                    <th scope="col">Edit</th> 
                                                    <th scope="col">Delete</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                                    <tr id="coluna_<?php echo $row['id_local']; ?>">
                                                        <th scope="row"><?php echo $row['id_local']; ?></th>
                                                        <td id="nome_local_<?php echo $row['id_local']; ?>"><?php echo $row['nome_local']; ?></td>
                                                        <td><img src="<?php echo $row['logo_url']; ?>" alt="Logo" width="50px" id="imagem_local_<?php echo $row['id_local']; ?>"></td>
                                                        <td><a href="https://tapgotech.com/redirect.php?id=<?php echo $row['id_local']; ?>" target="_blank" style="color: blue;">https://tapgotech.com/redirect.php?id=<?php echo $row['id_local']; ?></a></td>
                                                        <td><?php echo $row['link_count']; ?></td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#localDetailsModal<?php echo $row['id_local']; ?>" style="background-image: none;">Stats</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-info btn-edit" data-id="<?php echo $row['id_local']; ?>" style="background-image: none;">Editar</button>
                                                        </td>

                                                        <!-- Delete Button -->
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-delete" data-id="<?php echo $row['id_local']; ?>" style="background-image: none;">Eliminar</button>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $modals .= '<div class="modal fade" id="localDetailsModal' . $row['id_local'] . '" tabindex="-1" aria-labelledby="localDetailsLabel' . $row['id_local'] . '" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title text-nice" id="localDetailsLabel' . $row['id_local'] . '">Details for ' . $row['nome_local'] . '</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                    <th>IP</th>
                                                    <th>Browser</th>
                                                    <th>OS</th>
                                                    <th>Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>';

                                                    $details_result = mysqli_query($link, "SELECT * FROM locals_links WHERE id_local='{$row['id_local']}'");
                                                    while ($detail = mysqli_fetch_assoc($details_result)): 
                                                        $modals .= '<tr>
                                                        <td>' . $detail['ip'] . '</td>
                                                        <td>' . $detail['browser'] . '</td>
                                                        <td>' . $detail['sistema_operativo'] . '</td>
                                                        <td>' . $detail['data'] . '</td>
                                                        </tr>';
                                                    endwhile;

                                                    $modals .= '        </tbody>
                                                    </table>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>';
                                                    ?>

                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>




                                </div>
                            </div>
                        </div>
                        <?php 
                        echo $modals;
                        ?>
                        <hr>
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <h2 class="text-primary m-0 fw-bold text-center">Adicionar Estabelecimento</h2>
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nome do Local</label>
                                            <input type="text" class="form-control" placeholder="Nome do Establecimento" name="nome_local" required>
                                            <small id="emailHelp" class="form-text text-muted">Não te enganes boi...</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input type="text" class="form-control" placeholder="Link Google Maps" name="link_local" value="https://search.google.com/local/writereview?placeid=ID" required>
                                            <small class="form-text text-muted">Para encontrar o id do link, carrega <a href='https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder#maps_places_placeid_finder-typescript' target="_blank" style="color: blue;">aqui</a>.</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload Logo</label>
                                            <input type="file" class="form-control" name="uploaded_image" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin: 1%;" name="adicionar_local">Adicionar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php 
                        $query = mysqli_query($link, "SELECT * FROM mensagens");
                        ?>
                        <hr>
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <h2 class="text-primary m-0 fw-bold text-center">Mensagens</h2>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Telefone</th>
                                                    <th scope="col">Mensagem</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                while ($info = mysqli_fetch_array($query)) {
                                                    $id_mensagem = $info['id'];
                                                    $nome = $info['nome'];
                                                    $mensagem = $info['mensagem'];
                                                    $email = $info['email'];
                                                    $telemovel = $info['telemovel'];
                                                    $mensagem = $info['mensagem'];

                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $id_mensagem; ?></th>
                                                        <td><?php echo $nome; ?></td>
                                                        <td><?php echo $email; ?></td>
                                                        <td><?php echo $telemovel; ?></td>
                                                        <td><?php echo $mensagem; ?></td>
                                                    </tr>
                                                <?php
                                                } 
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php 
                        $query = mysqli_query($link, "SELECT * FROM products");
                        ?>
                        <hr>
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <h2 class="text-primary m-0 fw-bold text-center">Produtos</h2>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Editar</th>
                                                    <th scope="col">Eliminar</th>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Descrição</th>
                                                    <th scope="col">price_pack_5</th>
                                                    <th scope="col">price_pack_10</th>
                                                    <th scope="col">price_pack_20</th>
                                                    <th scope="col">Stock</th>
                                                    <th scope="col">imagem_5_pack</th>
                                                    <th scope="col">imagem_10_pack</th>
                                                    <th scope="col">imagem_20_pack</th>
                                                    <th scope="col">price_pack_10</th>
                                                    <th scope="col">Type</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                while ($info = mysqli_fetch_array($query)) {
                                                    $id_produto = $info['id'];
                                                    $nome_produto = $info['nome'];
                                                    $descricao = $info['descricao'];
                                                    $stock = $info['stock'];
                                                    $imagem_5_pack = $info['imagem_5_pack'];
                                                    $imagem_10_pack = $info['imagem_10_pack'];
                                                    $imagem_20_pack = $info['imagem_20_pack'];
                                                    $price_pack_5 = $info['price_pack_5'];
                                                    $price_pack_10 = $info['price_pack_10'];
                                                    $price_pack_20 = $info['price_pack_20'];
                                                    $short_description = substr($descricao,0,100).'...';
                                                    $type = $info['type'];

                                                ?>
                                                <input type="hidden" id="descricao_completa_<?php echo $id_produto; ?>" value="<?php echo $descricao; ?>">
                                                    <tr>
                                                        <td><button type="button" data-id="<?php echo $id_produto; ?>" class="btn btn-info edit-product" style="background-image: none;">Editar</button></td>
                                                        <td><button type="button" id="delete_product" data-id="<?php echo $id_produto; ?>" class="btn btn-danger delete-product" style="background-image: none;">Eliminar</button></td>
                                                        <th scope="row"><?php echo $id_produto; ?></th>
                                                        <td><?php echo $nome_produto; ?></td>
                                                        <td><?php echo $short_description; ?></td>
                                                        <td><?php echo $price_pack_5. "€"; ?></td>
                                                        <td><?php echo $price_pack_10. "€"; ?></td>
                                                        <td><?php echo $price_pack_20. "€"; ?></td>
                                                        <td><?php echo $stock; ?></td>
                                                        <td><img src='/<?php echo $imagem_5_pack; ?>' style='width: 100px;'></td>
                                                        <td><img src='/<?php echo $imagem_10_pack; ?>' style='width: 100px;'></td>
                                                        <td><img src='/<?php echo $imagem_20_pack; ?>' style='width: 100px;'></td>
                                                        <td><?php echo $type; ?></td>
                                                        
                                                    </tr>
                                                <?php
                                                } 
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <?php
                        $query = mysqli_query($link, "SELECT * FROM orders");
                        ?>

                        <hr>
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <h2 class="text-primary m-0 fw-bold text-center">Orders</h2>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="accordion" id="orderAccordion">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Order ID</th>
                                                        <th scope="col">First Name</th>
                                                        <th scope="col">Last Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Address</th>
                                                        <th scope="col">Establishment</th>
                                                        <th scope="col">Country</th>
                                                        <th scope="col">ZIP</th>
                                                        <th scope="col">Payment Method</th>
                                                        <th scope="col">Total Price</th>
                                                        <th scope="col">Stripe Charge ID</th>
                                                        <th scope="col">Order Status</th>
                                                        <th scope="col">Created At</th>
                                                        <th scope="col">Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    while ($order = mysqli_fetch_array($query)) {
                                                        $order_id = $order['id'];
                                                        $accordion_id = "details".$order_id;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $order['id']; ?></td>
                                                            <td><?php echo $order['first_name']; ?></td>
                                                            <td><?php echo $order['last_name']; ?></td>
                                                            <td><?php echo $order['email']; ?></td>
                                                            <td><?php echo $order['address1']; ?></td>
                                                            <td><?php echo $order['establishment']; ?></td>
                                                            <td><?php echo $order['country']; ?></td>
                                                            <td><?php echo $order['zip']; ?></td>
                                                            <td><?php echo $order['payment_method']; ?></td>
                                                            <td><?php echo $order['total_price']."€"; ?></td>
                                                            <td><?php echo $order['stripe_charge_id']; ?></td>
                                                            <td><?php echo $order['order_status']; ?></td>
                                                            <td><?php echo $order['created_at']; ?></td>
                                                            <td>
                                                                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $accordion_id; ?>" aria-expanded="true" aria-controls="<?php echo $accordion_id; ?>">
                                                                    Details
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="14">
                                                                <div id="<?php echo $accordion_id; ?>" class="collapse" aria-labelledby="headingOne" data-bs-parent="#orderAccordion">
                                                                    <div class="card-body">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Detail ID</th>
                                                                                    <th>Product ID</th>
                                                                                    <th>Product Name</th>
                                                                                    <th>Quantity</th>
                                                                                    <th>Price per Unit</th>
                                                                                    <th>Total Price</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php
                                                                                $details_query = mysqli_query($link, "SELECT * FROM order_details WHERE order_id = $order_id");
                                                                                while ($detail = mysqli_fetch_array($details_query)) {
                                                                                ?>
                                                                                    <tr>
                                                                                        <td><?php echo $detail['id']; ?></td>
                                                                                        <td><?php echo $detail['product_id']; ?></td>
                                                                                        <td><?php echo $detail['product_name']; ?></td>
                                                                                        <td><?php echo $detail['quantity']; ?></td>
                                                                                        <td><?php echo $detail['price_per_unit']."€"; ?></td>
                                                                                        <td><?php echo $detail['total_price']."€"; ?></td>
                                                                                    </tr>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                    <!-- !!! -->
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Tap&amp;Go 2023</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
</div>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/aos.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="assets/js/theme.js"></script>

<?php 
if ($role == 1) {
    ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>

        $('.edit-product').click(function() {
            var productId = $(this).data('id');
            var currentRow = $(this).closest('tr');

            // Fetch current product details from the table row
            var currentName = currentRow.find('td:nth-child(4)').text();
            //var currentDesc = currentRow.find('td:nth-child(5)').text();
            var currentDesc = $('#descricao_completa_' + productId).val();
            var currentPrice5 = currentRow.find('td:nth-child(6)').text().slice(0, -1);  // Removing the € symbol
            var currentPrice10 = currentRow.find('td:nth-child(7)').text().slice(0, -1);
            var currentPrice20 = currentRow.find('td:nth-child(8)').text().slice(0, -1);
            var currentStock = currentRow.find('td:nth-child(9)').text();
            var currentType = currentRow.find('td:nth-child(13)').text();

            Swal.fire({
                title: "Edit Product",
                html:
                    '<input id="swal-input-name" class="swal2-input" placeholder="Product Name" value="' + currentName + '">' +
                    '<textarea id="swal-input-description" class="swal2-textarea" placeholder="Product Description">' + currentDesc + '</textarea>' +
                    '<input id="swal-input-price5" class="swal2-input" placeholder="Price Pack 5" value="' + currentPrice5 + '">' +
                    '<input id="swal-input-price10" class="swal2-input" placeholder="Price Pack 10" value="' + currentPrice10 + '">' +
                    '<input id="swal-input-price20" class="swal2-input" placeholder="Price Pack 20" value="' + currentPrice20 + '">' +
                    '<input id="swal-input-stock" class="swal2-input" placeholder="Stock" value="' + currentStock + '">' +
                    '<input id="swal-input-type" class="swal2-input" placeholder="Type" value="' + currentType + '">' +
                    '<label for="swal-input-image5">Basic Pack Image</label>' +
                    '<input id="swal-input-image5" type="file" class="swal2-input">' +
                    '<label for="swal-input-image10">Value Pack Image</label>' +
                    '<input id="swal-input-image10" type="file" class="swal2-input">' +
                    '<label for="swal-input-image20">Premium Pack Image</label>' +
                    '<input id="swal-input-image20" type="file" class="swal2-input">',
                focusConfirm: false,
                preConfirm: () => {
                    return {
                        nome: document.getElementById('swal-input-name').value,
                        descricao: document.getElementById('swal-input-description').value,
                        price_pack_5: document.getElementById('swal-input-price5').value,
                        price_pack_10: document.getElementById('swal-input-price10').value,
                        price_pack_20: document.getElementById('swal-input-price20').value,
                        stock: document.getElementById('swal-input-stock').value,
                        type: document.getElementById('swal-input-type').value,
                        imagem_5_pack: document.getElementById('swal-input-image5').files[0],
                        imagem_10_pack: document.getElementById('swal-input-image10').files[0],
                        imagem_20_pack: document.getElementById('swal-input-image20').files[0]
                    }
                }
            })
            .then((result) => {
                if(result.value) {
                    var formData = new FormData();
                    formData.append('update_product', '1');
                    formData.append('product_id', productId);
                    formData.append('nome', result.value.nome);
                    formData.append('descricao', result.value.descricao);
                    formData.append('price_pack_5', result.value.price_pack_5);
                    formData.append('price_pack_10', result.value.price_pack_10);
                    formData.append('price_pack_20', result.value.price_pack_20);
                    formData.append('stock', result.value.stock);
                    formData.append('type', result.value.type);
                    if (result.value.imagem_5_pack) {
                        formData.append('imagem_5_pack', result.value.imagem_5_pack);
                    }
                    if (result.value.imagem_10_pack) {
                        formData.append('imagem_10_pack', result.value.imagem_10_pack);
                    }
                    if (result.value.imagem_20_pack) {
                        formData.append('imagem_20_pack', result.value.imagem_20_pack);
                    }


                    for (var pair of formData.entries()) {
                        console.log(pair[0]+ ', ' + pair[1]); 
                    }

                    // Make AJAX request to update product
                    $.ajax({
                        url: 'edit_product.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (response.success) {
                                currentRow.find('td:nth-child(4)').text(result.value.nome);
                                currentRow.find('td:nth-child(5)').text(result.value.descricao);
                                currentRow.find('td:nth-child(6)').text(result.value.price_pack_5 + "€");
                                currentRow.find('td:nth-child(7)').text(result.value.price_pack_10 + "€");
                                currentRow.find('td:nth-child(8)').text(result.value.price_pack_20 + "€");
                                currentRow.find('td:nth-child(9)').text(result.value.stock);
                                currentRow.find('td:nth-child(13)').text(result.value.type);
                                $('#descricao_completa_' + productId).val(result.value.descricao);

                                if(result.value.imagem_5_pack) {
                                    currentRow.find('td:nth-child(10) img').attr('src', '../assets/img/hero/' + result.value.imagem_5_pack.name);
                                }
                                if(result.value.imagem_10_pack) {
                                    currentRow.find('td:nth-child(11) img').attr('src', '../assets/img/hero/' + result.value.imagem_10_pack.name);
                                }
                                if(result.value.imagem_20_pack) {
                                    currentRow.find('td:nth-child(12) img').attr('src', '../assets/img/hero/' + result.value.imagem_20_pack.name);
                                }

                                Swal.fire("Product updated successfully!", { icon: "success" });
                            } else {
                                Swal.fire("Error updating product!", { icon: "error" });
                            }
                        }
                    });
                }
            });
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
                            url: '../edit_local.php',
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
                        url: '../delete_local.php',
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

    </script>
    <?php    
}
?>
</body>

</html>