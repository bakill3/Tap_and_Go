<?php
require 'vendor/autoload.php';
require 'ligar_db.php'; // Adjust the path as necessary

// Function to get IP statistics including country
function getIpStatisticsWithCountry($link) {
    $query = "SELECT 
                sm.ip_address, 
                sc.country,
                COUNT(sm.id) AS total_visits, 
                MIN(sm.visit_date) AS first_visit, 
                MAX(sm.visit_date) AS last_visit 
              FROM stats_main sm
              JOIN stats_countries sc ON sm.id_country = sc.id_country
              WHERE sm.visit_date > NOW() - INTERVAL 1 DAY
              GROUP BY sm.ip_address, sc.country 
              ORDER BY total_visits DESC, last_visit DESC;";
    
    $result = mysqli_query($link, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    return $data;
}

// Function to get country visit statistics
function getCountryVisitStatistics($link) {
    $query = "SELECT 
                sc.country,
                sc.unique_n_times,
                COUNT(sm.id) AS total_visits
              FROM stats_main sm
              JOIN stats_countries sc ON sm.id_country = sc.id_country
              WHERE sm.visit_date > NOW() - INTERVAL 1 DAY
              GROUP BY sc.country
              ORDER BY total_visits DESC;";

    $result = mysqli_query($link, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    return $data;
}

// Function to create a Bootstrap table from the data
function createBootstrapTable($data, $headers) {
    $tableHtml = '<table class="table">';
    $tableHtml .= '<thead><tr>';
    foreach ($headers as $header) {
        $tableHtml .= '<th>' . $header . '</th>';
    }
    $tableHtml .= '</tr></thead><tbody>';

    foreach ($data as $row) {
        $tableHtml .= '<tr>';
        foreach ($row as $cell) {
            $tableHtml .= '<td>' . $cell . '</td>';
        }
        $tableHtml .= '</tr>';
    }

    $tableHtml .= '</tbody></table>';
    return $tableHtml;
}

// Main logic
try {
    $ipStatistics = getIpStatisticsWithCountry($link);
    $ipTableHtml = createBootstrapTable($ipStatistics, ['IP Address', 'Country', 'Total Visits', 'First Visit', 'Last Visit']);

    $countryStatistics = getCountryVisitStatistics($link);
    $countryTableHtml = createBootstrapTable($countryStatistics, ['Country', 'Unique Visits', 'Total Visits']);

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    // Load your email template and replace placeholders
    $emailContent = file_get_contents('emaiL_template_cron.html'); 
    if ($emailContent === false) {
        die("Failed to load the email template.");
    }
    $emailContent = str_replace('PLACEHOLDER_IP_TABLE', $ipTableHtml, $emailContent);
    $emailContent = str_replace('PLACEHOLDER_COUNTRY_TABLE', $countryTableHtml, $emailContent);

    // PHPMailer configurations
    $mail->isSMTP();
    $mail->Host = 'mail.tapgotech.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@tapgotech.com';
    $mail->Password = '(6!9Y9aE)Urg';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('noreply@tapgotech.com', 'Tap&Go');
    $mail->addAddress('deostulti2@gmail.com', 'Gabriel Brandão');
    $mail->addReplyTo('noreply@tapgotech.com', 'No Reply');

    $mail->isHTML(true);
    $mail->Subject = 'IP and Country Statistics Report';
    $mail->Body = $emailContent;
    $mail->CharSet = 'UTF-8';

    if(!$mail->send()) {
        die('Mailer Error: ' . $mail->ErrorInfo);
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

mysqli_close($link);
?>
