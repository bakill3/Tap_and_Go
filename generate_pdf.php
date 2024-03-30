<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'ligar_db.php'; //I also have session_start here

require_once('vendor/tecnickcom/tcpdf/tcpdf.php');

// Check if the order ID and Stripe charge ID are set in the session
if (!isset($_SESSION['payment_data'])) {
    echo "<script>window.location.href='index.php';</script>";
    exit;
}
$orderID = $_SESSION['payment_data'][0];
$stripeChargeID = $_SESSION['payment_data'][1];

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document metadata
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tap&Go');
$pdf->SetTitle('Order Details');
$pdf->SetSubject('Tap&Go Purchase Details');

// Remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Set margins
$pdf->SetMargins(20, 20, 20);

$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

// Logo
$image_file = 'https://tapgotech.com/assets/img/logo/logo_black.png';
$pdf->Image($image_file, 0, 10, 60, '', 'PNG', '', 'T', false, 300, 'C', false, false, 0, false, false, false);

// Title
$pdf->Ln(50);
$pdf->SetFont('helvetica', 'B', 24);
$pdf->Cell(0, 15, 'Tap&Go Order Details', 0, false, 'C', 0, '', 0, false, 'M', 'M');

// Fetch the order using the ID from the session
$orderSql = "SELECT * FROM orders WHERE id = ?";
$stmt = $link->prepare($orderSql);
$stmt->bind_param('i', $orderID);
$stmt->execute();
$result = $stmt->get_result();

$order = $result->fetch_assoc();

// Order Details
$pdf->Ln(20);
$pdf->SetFont('helvetica', '', 14);
$pdf->Cell(0, 15, "Name: " . $order['first_name'] . " " . $order['last_name']);
$pdf->Ln(10);
$pdf->Cell(0, 15, "Email: " . $order['email']);
$pdf->Ln(10);
$pdf->Cell(0, 15, "Address: " . $order['address1'] . " - " . $order['establishment']);
$pdf->Ln(10);
$pdf->Cell(0, 15, "Country: " . $order['country']);
$pdf->Ln(10);
$pdf->Cell(0, 15, "ZIP: " . $order['zip']);

$detailsSql = "SELECT * FROM order_details WHERE order_id = ?";
$stmt = $link->prepare($detailsSql);
$stmt->bind_param('i', $orderID);
$stmt->execute();
$detailsResult = $stmt->get_result();

$pdf->Ln(20);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 15, "Products Purchased:");

$pdf->SetFont('helvetica', '', 12);
while ($detail = $detailsResult->fetch_assoc()) {
    $pdf->Ln(10);
    $pdf->Cell(0, 15, $detail['product_name'] . " - " . $detail['quantity'] . "x - " . $detail['price_per_unit'] . "€");
}

// Footer
$pdf->SetY(-50);
$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 10, "Order ID: " . $order['id'], 0, false, 'C');
$pdf->Ln(10);
$pdf->Cell(0, 10, "Stripe Charge ID: " . $stripeChargeID, 0, false, 'C');

session_destroy();

$pdf->Output('order_details_' . $orderID . '.pdf', 'D');
?>
