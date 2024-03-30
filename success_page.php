<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'header.php';

if (!isset($_SESSION['last_order_id']) || !isset($_SESSION['stripe_charge_id'])) {
    echo "<script>window.location.href='index.php';</script>";
}
?>

<div class="container mt-5" style="padding: 10%;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Order Successful</h2>
                </div>
                <div class="card-body text-center">
                    <h4>Thank you for your purchase!</h4>
                    <p>Your order details have been successfully saved. You can download a PDF containing all the details of your purchase by clicking the button below.</p>
                    <a href="generate_pdf.php" class="btn btn-primary">Download Order PDF</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
Swal.fire({
    icon: 'success',
    title: 'Order Successful!',
    text: 'Thank you for your purchase. You can now download your order details.'
});
</script>

<?php
include 'footer.php';
?>
