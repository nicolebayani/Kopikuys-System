<?php
include('includes/header.php');
include('../../config/dbcon.php');
?>

<style>
    .report-card {
        background-color: #f0e7db;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .report-title {
        font-size: 1.5rem;
        color: #5a4a42;
        margin-bottom: 10px;
    }
    .report-value {
        font-size: 2rem;
        font-weight: bold;
        color: #3b2f2f;
    }
</style>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header" style="background-color: #d9c8b4 !important; color: #3b2f2f;">
            <h4 class="mb-0"><i class="fas fa-chart-line"></i> Sales Report</h4>
        </div>
        <div class="card-body">

<?php
// Total Sales Amount
$total_sales_query = "SELECT SUM(total) as total_sales FROM orders";
$total_sales_result = mysqli_query($conn, $total_sales_query);
$total_sales = mysqli_fetch_assoc($total_sales_result)['total_sales'] ?? 0;

// Number of Orders
$order_count_query = "SELECT COUNT(*) as order_count FROM orders";
$order_count_result = mysqli_query($conn, $order_count_query);
$order_count = mysqli_fetch_assoc($order_count_result)['order_count'] ?? 0;

// Total Items Sold
$items_sold_query = "SELECT SUM(quantity) as total_items FROM order_items";
$items_sold_result = mysqli_query($conn, $items_sold_query);
$total_items_sold = mysqli_fetch_assoc($items_sold_result)['total_items'] ?? 0;

// Sales by Payment Mode
$payment_modes_query = "SELECT payment_mode, SUM(total) as mode_total FROM orders GROUP BY payment_mode";
$payment_modes_result = mysqli_query($conn, $payment_modes_query);

// Daily Sales for Chart (last 7 days)
$daily_sales_query = "
    SELECT DATE(created_at) as sale_date, SUM(total) as daily_total 
    FROM orders 
    WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
    GROUP BY sale_date
    ORDER BY sale_date ASC
";
$daily_sales_result = mysqli_query($conn, $daily_sales_query);

$daily_dates = [];
$daily_totals = [];

while($row = mysqli_fetch_assoc($daily_sales_result)){
    $daily_dates[] = date('M j', strtotime($row['sale_date']));
    $daily_totals[] = $row['daily_total'];
}
?>

        <div class="row">
            <div class="col-md-4">
                <div class="report-card text-center">
                    <div class="report-title">Total Sales</div>
                    <div class="report-value">₱<?= number_format($total_sales, 2) ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="report-card text-center">
                    <div class="report-title">Number of Orders</div>
                    <div class="report-value"><?= $order_count ?></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="report-card text-center">
                    <div class="report-title">Total Items Sold</div>
                    <div class="report-value"><?= $total_items_sold ?></div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h5 class="mb-3" style="color: #5a4a42;">Sales by Payment Method</h5>
            <ul class="list-group">
                <?php if(mysqli_num_rows($payment_modes_result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($payment_modes_result)): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= ucfirst($row['payment_mode']) ?>
                            <span>₱<?= number_format($row['mode_total'], 2) ?></span>
                        </li>
                    <?php endwhile; ?>
                <?php else: ?>
                    <li class="list-group-item">No Sales Found</li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="mt-5">
            <h5 class="mb-3" style="color: #5a4a42;">Daily Sales (Last 7 Days)</h5>
            <canvas id="dailySalesChart"></canvas>
        </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('dailySalesChart').getContext('2d');
    const dailySalesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($daily_dates) ?>,
            datasets: [{
                label: '₱ Sales',
                data: <?= json_encode($daily_totals) ?>,
                backgroundColor: '#8c7355',
                borderRadius: 5,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₱' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>

<?php include('includes/footer.php'); ?>
