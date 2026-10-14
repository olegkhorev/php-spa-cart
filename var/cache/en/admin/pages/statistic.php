<?php 
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>Statistic</h1>
<br />

<div class="orders_today_chart hidden"><?php echo json_encode($orders_today); ?></div>
<h3>Today's orders</h3>
<div class="chart-container chart-container--line" style="max-width: none;">
<canvas class="statistics_charts" rel="orders_today_chart"></canvas>
</div>
<div class="statistics-totals">
Total: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_today); ?><br />
Total paid: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_today_paid); ?><br />
</div>

<div class="orders_week_chart hidden"><?php echo json_encode($orders_week); ?></div>
<h3>Week's orders</h3>
<div class="chart-container chart-container--line" style="max-width: none;">
<canvas class="statistics_charts" rel="orders_week_chart"></canvas>
</div>
<div class="statistics-totals">
Total: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_week); ?><br />
Total paid: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_week_paid); ?><br />
</div>

<div class="orders_month_chart hidden"><?php echo json_encode($orders_month); ?></div>
<h3>Month's orders</h3>
<div class="chart-container chart-container--line" style="max-width: none;">
<canvas class="statistics_charts" rel="orders_month_chart"></canvas>
</div>
<div class="statistics-totals">
Total: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_month); ?><br />
Total paid: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_month_paid); ?><br />
</div>

<h3>Year's orders: <?php echo $orders_year;?></h3>
<div class="statistics-totals">
Total: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_year); ?><br />
Total paid: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_year_paid); ?><br />
</div>

<h3>All orders: <?php echo $orders_all;?></h3>
<div class="statistics-totals">
Total: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_all); ?><br />
Total paid: <?php echo '<span class="currency">'.currency_symbol().'</span>'.price_format_currency($total_all_paid); ?><br />
</div>
