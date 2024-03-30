<?php
include 'ligar_db.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $id = mysqli_real_escape_string($link, $id);

    $stmt = $link->prepare("SELECT nome_local, link_local, logo_url FROM locals WHERE id_local=?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $info = $result->fetch_assoc();
        $nome_local = $info['nome_local'];
        $link_local = $info['link_local'];
        $logo_url = $info['logo_url'];
    } else {
        echo "<script>window.location.href='index.php';</script>";
        exit;
    }
} else {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}

$ip = $_SERVER['REMOTE_ADDR']; 
$user_agent = $_SERVER['HTTP_USER_AGENT'];

function getOS() { 

    global $user_agent;

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

        return $os_platform;
    }

    function getBrowser() {

        global $user_agent;

        $browser        = "Unknown Browser";

        $browser_array = array(
            '/msie/i'      => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Chrome',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/netscape/i'  => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i'    => 'Handheld Browser'
        );

        foreach ($browser_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $browser = $value;

            return $browser;
        }


        $user_os        = getOS();
        $user_browser   = getBrowser();

        $date = new DateTime('now', new DateTimeZone('Europe/Lisbon'));
        $lisbonTimestamp = $date->format('Y-m-d H:i:s');

        $stmt = $link->prepare("INSERT INTO locals_links(id_local, ip, browser, sistema_operativo, data) VALUES(?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $id, $ip, $user_browser, $user_os, $lisbonTimestamp);
        $stmt->execute();

        if (empty($logo_url)) {
            $logo_url = "assets/img/hero/background_mobile_final.png";
        }
        ?>
        <html>
        <head>
          <meta charset="utf-8">
          <meta http-equiv="x-ua-compatible" content="ie=edge">
          <title>Tap&Go - Boost Your Business With Seamless Reviews</title>
          <meta name="description" content="">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
          <style type="text/css">
            body,
            html {
              height: 100%;
              margin: 0;
          }

          .bg {
            background-image: url("<?php echo $logo_url; ?>");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        div>#overlay-header {
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.5);
      }

      .center {
          min-height: 100%;
          /* Fallback for browsers do NOT support vh unit */
          min-height: 100vh;
          /* These two lines are counted as one :-)       */
          margin: 0;
          display: flex;
          align-items: center;
      }

      .spinner-border {
          width: 3rem;
          height: 3rem;
      }

      .foot-message {
          position: fixed;
          left: 50%;
          bottom: 20px;
          transform: translate(-50%, -50%);
          margin: 0 auto;
      }
  </style>
</head>
<body>
    <div class="bg">

      <div id="overlay-header">
        <img src="https://tapgotech.com/assets/img/logo/logo_white.png" style="width: 70%; position: fixed; top: 20%; left: 50%; transform: translate(-50%, -50%);">

        <div class="text-center center">

          <div class="container">

            <div class="row spinner-border text-light" role="status">
              <span class="sr-only"></span>
          </div>
      </div>
  </div>
</div>
<div class="foot-message">
    <p class="text-white">You are being redirected to <a class="text-warning" href="https://tapgotech.com"><?php echo $nome_local; ?></a></p>
</div>
</div>

<script>
    window.onload = function() {
      function sleep(milliseconds) {
        return new Promise(resolve => setTimeout(resolve, milliseconds));
    }

            // Usage
    console.log("Start");
    sleep(1000).then(() => {
      console.log("After 5 seconds");
      window.location.href='<?php echo $link_local; ?>';
  });
    console.log("HTML and CSS loaded. Delayed execution completed.");
};
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>