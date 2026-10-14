<?php
/**
* SPA-Cart
* Copyright (c) Oleg Khorev
*
* Released under the MIT License.
* https://github.com/olegkhorev/php-spa-cart
*/
?>
<h1>{lng[Statistic]}</h1>
<br />

<div class="orders_today_chart hidden">{php echo json_encode($orders_today)}</div>
<h3>{lng[Today's orders]}</h3>
<div class="chart-container chart-container--line" style="max-width: none;">
<canvas class="statistics_charts" rel="orders_today_chart"></canvas>
</div>
<div class="statistics-totals">
{lng[Total]}: {price $total_today}<br />
{lng[Total paid]}: {price $total_today_paid}<br />
</div>

<div class="orders_week_chart hidden">{php echo json_encode($orders_week)}</div>
<h3>{lng[Week's orders]}</h3>
<div class="chart-container chart-container--line" style="max-width: none;">
<canvas class="statistics_charts" rel="orders_week_chart"></canvas>
</div>
<div class="statistics-totals">
{lng[Total]}: {price $total_week}<br />
{lng[Total paid]}: {price $total_week_paid}<br />
</div>

<div class="orders_month_chart hidden">{php echo json_encode($orders_month)}</div>
<h3>{lng[Month's orders]}</h3>
<div class="chart-container chart-container--line" style="max-width: none;">
<canvas class="statistics_charts" rel="orders_month_chart"></canvas>
</div>
<div class="statistics-totals">
{lng[Total]}: {price $total_month}<br />
{lng[Total paid]}: {price $total_month_paid}<br />
</div>

<h3>{lng[Year's orders]}: {$orders_year}</h3>
<div class="statistics-totals">
{lng[Total]}: {price $total_year}<br />
{lng[Total paid]}: {price $total_year_paid}<br />
</div>

<h3>{lng[All orders]}: {$orders_all}</h3>
<div class="statistics-totals">
{lng[Total]}: {price $total_all}<br />
{lng[Total paid]}: {price $total_all_paid}<br />
</div>
