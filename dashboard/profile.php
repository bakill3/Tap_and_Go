<?php  
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
WHERE u.id = ?;";  // Note the placeholder change

$stmt = mysqli_prepare($link, $query_txt);
mysqli_stmt_bind_param($stmt, 'i', $id);
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
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tap&Go - Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo/favicon.ico">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/aos.min.css">
    <script src="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js
    "></script>
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css
    " rel="stylesheet">

    <style>
        /* Phone frame styles */
        .phone-frame {
            width: 60vw; /* Adjusted for responsiveness */
            max-width: 300px; /* Set a maximum width */
            height: calc(60vw * 2.16); /* Maintain aspect ratio */
            max-height: 648px; /* Set a maximum height */
            border-radius: 30px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            background-color: #f0f0f0;
            margin: 50px auto;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .phone-frame:hover {
            background-color: #476cda;
        }

        /* Camera notch */
        .phone-frame .notch {
            width: 60%;
            height: 4%;
            background-color: #000;
            border-radius: 10px 10px 0 0;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        /* Pencil icon on hover */
        .phone-frame .edit-icon {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 36px; /* Larger icon */
            color: #fff;
            border: none;
            background-color: transparent;
            z-index: 2;
        }

        .phone-frame:hover .edit-icon {
            display: block;
        }

        /* iFrame styles */
        .phone-frame iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        .phone-frame::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: transparent;
            pointer-events: none; /* so it doesn't block interactions with the iframe */
            transition: background-color 0.3s;
            z-index: 1; /* so it's on top of the iframe but below the pencil icon */
        }

        .phone-frame:hover::before {
            background-color: rgba(71, 108, 218, 0.7); /* use a semi-transparent blue to overlay */
        }
        .iframe-overlay {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2; /* above the iframe but below the pencil icon */
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark toggled">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                <div class="sidebar-brand-icon rotate-n-15"></div>
                <div class="sidebar-brand-text mx-3"><img src="assets/img/logo_white.png" width="163" height="89" style="margin-right: 15px;"></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li class="nav-item"></li>
                <li class="nav-item"></li>
                <li class="nav-item"><a class="nav-link active" href="profile.php"><i class="fas fa-user-cog"></i><span>Settings</span></a></li>
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
                    <h1 class="display-6" data-aos="fade-left"><strong><?php echo $localName; ?></strong></h1>
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
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Settings</h3>
                <div class="row mb-3">
                    <div class="col-lg-8">
                        <div class="row mb-3 d-none">
                            <div class="col">
                                <div class="card text-white bg-primary shadow">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <p class="m-0">Peformance</p>
                                                <p class="m-0"><strong>65.2%</strong></p>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                        </div>
                                        <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-white bg-success shadow">
                                    <div class="card-body">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <p class="m-0">Peformance</p>
                                                <p class="m-0"><strong>65.2%</strong></p>
                                            </div>
                                            <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                        </div>
                                        <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 fw-bold">Security Settings</p>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-primary m-0 fw-bold">Change Password</p>
                                        <hr>
                                        <form>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="username"><strong>New Pasword</strong></label><input class="form-control" type="password" id="new_password" placeholder="Password" required></div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="first_name"><strong>Confirm New Password</strong></label><input class="form-control" type="password" id="new_password_repeat" placeholder="Confirm Password" required></div>
                                                </div>
                                            </div>
                                            <div class="mb-3"><button class="btn btn-danger btn-sm" type="button" id="change_password">Change Password</button></div>
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="card shadow mb-3">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 fw-bold">User Settings</p>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="username"><strong>Username</strong></label><input class="form-control" type="text" id="username-1" placeholder="Username" name="username" value="<?php echo $username; ?>"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="email"><strong>Email Address</strong></label><input class="form-control" type="email" id="email-1" placeholder="info@tapgotech.com" name="email" value="<?php echo $email; ?>"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="first_name"><strong>First Name</strong></label><input class="form-control" type="text" id="first_name-1" placeholder="Ricardo" name="first_name" value="<?php echo $nome; ?>"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="last_name"><strong>Last Name</strong></label><input class="form-control" type="text" id="last_name-1" placeholder="Manuel" name="last_name" value="<?php echo $apelido; ?>"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Save Settings</button></div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card shadow">
                                    <div class="card-header py-3">
                                        <p class="text-primary m-0 fw-bold">Contact Settings</p>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="mb-3"><label class="form-label" for="address"><strong>Address</strong></label><input class="form-control" type="text" id="address" placeholder="Sunset Blvd, 38" name="address" value="<?php echo $morada; ?>"></div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="city"><strong>City</strong></label><input class="form-control" type="text" id="city" placeholder="Arouca" name="city" value="<?php echo $cidade; ?>"></div>
                                                </div>
                                                <div class="col">
                                                    <div class="mb-3"><label class="form-label" for="country"><strong>Country</strong></label><input class="form-control" type="text" id="country" placeholder="China" name="country" value="<?php echo $pais; ?>"></div>
                                                </div>
                                            </div>
                                            <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit">Save&nbsp;Settings</button></div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Change <?php echo $localName; ?> Image</p>
                            </div>
                            <div class="card-body">
                                <div class="phone-frame" id="phoneFrame">
                                    <div class="notch"></div>
                                    <button class="btn btn-primary rounded-circle edit-icon">&#9998;</button>
                                    <iframe src="https://tapgotech.com/iframe_redirect.php?id=<?php echo $id_local; ?>" title="<?php echo $localName; ?> Image"></iframe>
                                    <div class="iframe-overlay" id="iframeOverlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<script src="assets/js/bs-init.js"></script>
<script src="assets/js/theme.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    document.getElementById('iframeOverlay').addEventListener('click', function() {
        Swal.fire({
            title: 'Upload a File',
            input: 'file',
            inputAttributes: {
                'accept': 'image/*',
                'aria-label': 'Upload your image'
            },
            showCancelButton: true,
            confirmButtonText: 'Upload',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {

                const file = result.value;
                console.log(file);
                var id_local = <?php echo $id_local; ?>;

                // Create a FormData object and append the file
                let formData = new FormData();
                formData.append('uploaded_file', file);
                formData.append('id_local', id_local);

            // Send the file via AJAX
                fetch('update_local_image.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Success!', 'Image updated.', 'success');
                    // Refresh the iframe
                        const iframe = document.querySelector('.phone-frame iframe');
                        iframe.src = iframe.src;
                    } else {
                        Swal.fire('Error!', data.message, 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'There was an error processing your request.', 'error');
                });
            }
        });
    });
</script>
<script>
    $("#change_password").click(function(e) {
        e.preventDefault();  
        var new_password = $("#new_password").val();
        var new_password_repeat = $("#new_password_repeat").val();
        if (new_password == '' || new_password_repeat == '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Fill all the inputs! Please try again...',
                confirmButtonText: 'Okay'
            });
        } else if (new_password != new_password_repeat) {
            Swal.fire({
                icon: 'info',
                title: 'Passwords don\'t match',
                text: 'Make sure your passwords match. Please try again...',
                confirmButtonText: 'Okay'
            });
        } else {
            $.ajax({
                type: "POST",
                url: "update_password.php",
                data: {
                    new_password: new_password,
                    new_password_repeat: new_password_repeat,
                },
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Password Updated',
                            text: 'Your password was sucessfully updated. Have a great day!',
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Something Failed',
                            text: 'There was an error updating your password. Please try again later...',
                            confirmButtonText: 'Okay'
                        });
                    }
                }

            });
        }
    });
</script>
</body>

</html>