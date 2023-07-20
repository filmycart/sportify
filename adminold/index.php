<?php require_once('../private/init.php'); ?>

<?php

$admin = Session::get_session(new Admin());
if(empty($admin)) Helper::redirect_to("login.php");
else{
	$panel_setting = new Setting();
	$panel_setting = $panel_setting->where(["admin_id"=> $admin->id])->one();
}
?>

<?php require("common/php/php-head.php"); ?>

<body>

<?php require("common/php/header.php"); ?>

<div class="main-container">
	
	<?php require("common/php/sidebar.php"); ?>

	<div class="main-content">
		<div class="item-wrapper three">
			<div class="item item-dahboard">
				<div class="item-inner">

					<?php 
						$products = new Product();
						$event = new Event();
						$categories = new Category();
						$users = new User(); 
					?>
					<div class="item-content">
						<h2 class="title"><b><?php echo $event->where(["admin_id"=>$admin->id])->count(); ?></b></h2>
						<h4 class="desc">Events</h4>
					</div><!--item-content-->

					<div class="icon"><i class="ion-android-film"></i></div>

					<div class="item-footer">
						<a href="events.php">More info <i class="ml-10 ion-chevron-right"></i><i class="ion-chevron-right"></i></a>
					</div><!--item-footer-->

				</div><!--item-inner-->
			</div><!--item-->


			<div class="item item-dahboard">
				<div class="item-inner">
					<div class="item-content">
						<h2 class="title"><b><?php echo $categories->where(["admin_id"=>$admin->id])->count(); ?></b></h2>
						<h4 class="desc">Categories</h4>
					</div>
					<div class="icon"><i class="ion-ios-download"></i></div>
					<div class="item-footer">
						<a href="categories.php">More info <i class="ml-10 ion-chevron-right"></i><i class="ion-chevron-right"></i></a>
					</div><!--item-footer-->
				</div><!--item-inner-->
			</div><!--item-->

			<div class="item item-dahboard">
				<div class="item-inner">
					<div class="item-content">
						<h2 class="title"><b><?php echo $users->where(["admin_id"=>$admin->id])->count(); ?></b></h2>
						<h4 class="desc">Users</h4>
					</div>
					<div class="icon"><i class="ion-social-buffer"></i></div>
					<div class="item-footer">
						<a href="users.php">More info <i class="ml-10 ion-chevron-right"></i><i class="ion-chevron-right"></i></a>
					</div><!--item-footer-->
				</div><!--item-inner-->
			</div><!--item-->

			<?php

			$order_status = [];
			$order_status[PENDING] = "Pending";
			$order_status[CLEAR] = "Clear";

			$first_day_this_month = date("Y-m-01"); // hard-coded '01' for first day
			$last_day_this_month  = date("Y-m-t");

			$total_order = new Orders();
			$total_order = $total_order->where(["admin_id" => $admin->id])->count();

			$current_month_order = new Orders();
			$current_month_order = $current_month_order->where(["admin_id" => $admin->id])
				->greater_eq(["created" => $first_day_this_month])->less_eq(["created" => $last_day_this_month])->count();

			$total_revenue = new Ordered_Product();
			$total_revenue = $total_revenue->where(["admin_id" => $admin->id])->sum("revenue");

			if(empty($total_revenue)) $total_revenue = 0;

			$current_month_revenue = new Ordered_Product();
			$current_month_revenue = $current_month_revenue->where(["admin_id" => $admin->id])
				->greater_eq(["created" => $first_day_this_month])->less_eq(["created" => $last_day_this_month])->sum("revenue");

			if(empty($current_month_revenue)) $current_month_revenue = 0;

			$total_product_sold = new Ordered_Product();
			$total_product_sold = $total_product_sold->where(["admin_id" => $admin->id])->sum("quantity");

			if(empty($total_product_sold)) $total_product_sold = 0;
			
			$current_month_product_sold = new Ordered_Product();
			$current_month_product_sold = $current_month_product_sold->where(["admin_id" => $admin->id])
				->greater_eq(["created" => $first_day_this_month])->less_eq(["created" => $last_day_this_month])->sum("quantity");

			if(empty($current_month_product_sold)) $current_month_product_sold = 0;
			
			$recent_orders = new Orders();
			$recent_orders = $recent_orders->where(["admin_id" => $admin->id])
				->orderBy("created")
				->orderType("DESC")->limit(1, DASHBOARD_ITEM_COUNT)
				->all();
			?>


		<div class="w-100">
			<?php
			$latest_reviews = new Review();
			$latest_reviews = $latest_reviews->where(["admin_id" => $admin->id])
				->orderBy("created")->orderType("DESC")
				->limit(0, DASHBOARD_ITEM_COUNT)->all(); 
				
			if(!empty($latest_reviews)){ ?>
				
				
			

			<div class="w-50 w-xl-100 float-l pr-10 mb-30 mt-30 pr-xl-0">
				<div class="tbl-wrapper">
					<div class="oflow-hidden mt-10 mb-10">
						<h5 class="float-l mtb-10">Recent Reviews</h5>
						<h6 style="display:none" class="float-r mtb-10"><a class="link plr-15" href="orders.php"><b>SEE ALL</b></a></h6>
					</div>
					<table class="order-table">
						<thead>
						<tr>
							<th>Product</th>
							<th>User</th>
							<th>Rating</th>
							<th>Review</th>
							<th>Created</th>
						</tr>
						</thead>
						<tbody>

						<?php if(count($latest_reviews) > 0){
						foreach ($latest_reviews as $item){ ?>

						<tr>
							<td>
								<?php $product = new Product();
								$product = $product->where(["id" => $item->item_id])->one("title"); ?>
								<a href="event-form.php?id=<?php echo $item->item_id; ?>"><?php echo $product->title; ?></a>
							</td>

							<td>
								<?php $user = new User();
								$user = $user->where(["id" => $item->user_id])->one("username"); ?>
								<?php echo $user->username; ?>
							</td>

							<td><?php echo $item->rating; ?></td>
							<td><?php echo Helper::format_text($item->review); ?></td>
							<td><?php echo Helper::days_ago($item->created); ?></td>

							<?php }
							} ?>
						</tr>
						</tbody>
					</table>

				</div><!--tbl-wrapper-->
			</div>
			
			<?php }	?>
		</div>

	</div><!--main-content-->
</div><!--main-container-->

<?php require("common/php/php-footer.php"); ?>


<!-- Apex Chart library -->
<script src="plugin-frameworks/apexcharts.min.js"></script>


	<!--REVENUE-->

	<?php

	$order_method_report = new Orders();
	$order_method_report = $order_method_report->groupBy("method")->all("method, COUNT(method) AS method_count");
	

	
	$sales_report = new Orders();
	$sales_report = $sales_report->groupBy("date_only")->orderBy("date_only")->orderType("ASC")
		->where(["admin_id" => $admin->id])
		->greater_eq(["created" => $first_day_this_month])->less_eq(["created" => $last_day_this_month])
		->all("DATE(created) date_only, sum(amount) as order_amount, count(id) as order_count");

	$orders_sales_report = [];
	foreach($sales_report as $item){
		$orders_sales_report[Helper::format_date($item->date_only)] = $item->to_valid_array();
	}

	$revenue_report = new Ordered_Product();
	$revenue_report = $revenue_report->groupBy("date_only")->orderBy("date_only")->orderType("ASC")
		->where(["admin_id" => $admin->id])
		->greater_eq(["created" => $first_day_this_month])->less_eq(["created" => $last_day_this_month])
		->all("DATE(created) date_only, sum(revenue) as revenue, count(id) as sell_count");
	

	$revenue_arr = [];
	foreach($revenue_report as $item){
		$revenue_arr[Helper::format_date($item->date_only)] = $item->to_valid_array();
	}

	?>


<script>
	/*MAIN SCRIPTS*/
	(function ($) {
		"use strict";

		$('.order-status').on('change', function(){
			var $this = $(this),
				url = $this.closest('select').data('action') + "&&status=" + $this.val(),
				dDownLoader = $this.closest('.status-wrapper').find('.d-down-loader');

			$(dDownLoader).addClass('active');

			var a = $.ajax({
				url: url,
				dataType: 'text',
				cache: false,
				type: 'GET',
				success: function(res) {

					$(dDownLoader).removeClass('active');
				}
			});
		});


		var ordersSalesReport = <?php echo json_encode($orders_sales_report); ?>,
			revenueReport = <?php echo json_encode($revenue_arr); ?>,
			date = new Date(),
			firstDay = new Date(date.getFullYear(), date.getMonth(), 1),
			lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0),
			saleLabels = [], salesCount = [], salesAmount = [],
			revenueAmount = [], revenueSalesCount = [];


		for(var i = firstDay.getDate(); i<= lastDay.getDate(); i++){
			saleLabels.push(i);
			var currentDay = lastDay.getFullYear() + '-' + (lastDay.getMonth() + 1) + '-' + i;

			if(ordersSalesReport[currentDay] != null) {
				salesCount.push(ordersSalesReport[currentDay]['order_count']);
				salesAmount.push(ordersSalesReport[currentDay]['order_amount']);
			}else{
				salesCount.push(0);
				salesAmount.push(0);
			}

			if(revenueReport[currentDay] != null) {
				revenueSalesCount.push(revenueReport[currentDay]['sell_count']);
				revenueAmount.push(revenueReport[currentDay]['revenue']);
			}else{
				revenueSalesCount.push(0);
				revenueAmount.push(0);
			}
		}

		var YearMonth = lastDay.getFullYear() + '-' + (lastDay.getMonth() + 1) + '-';

		var salesReportOptions = {
			chart: { height: 350, type: 'line', toolbar: { show: false }, },
			stroke: { curve: 'smooth' },
			series: [{ name: 'AMOUNT', type: 'area', data: salesAmount },
				{ name: 'SALES', type: 'line', data: salesCount }],

			fill: { type:'solid', opacity: [0.35, 1], },
			labels: saleLabels,
			markers: { size: 1 },
			xaxis: {
				tooltip: {formatter: function(val, opts) { return YearMonth + val;}}
			},
			yaxis: [
				{ show: false,
					title: { text: 'Series A', },
				},{ show: false, opposite: false,
					title: { text: 'Series B', }, }, ],

			tooltip: { shared: true, intersect: false,
				x: { formatter: (value) => { return YearMonth + value } },
				y: {

					formatter: function (y, { series, seriesIndex, dataPointIndex, w }) {
						if(seriesIndex == 0) var preText =  "$";
						else var preText =  "";

						if(typeof y !== "undefined") return  preText + y.toFixed(0);
						return y;
					}
				}
			}
		};

		var salesReport = new ApexCharts(
			document.querySelector("#sales-report"),
			salesReportOptions
		);
		salesReport.render();

		var ordersMethodReport = <?php echo json_encode($order_method_report); ?>,
			methodCount = [], methodLabel = [];

		for(var i = 0; i < ordersMethodReport.length; i++){
			methodLabel.push(ordersMethodReport[i].method);
			methodCount.push(parseInt(ordersMethodReport[i].method_count));
		}
		
		var paymentReportOptions = {
			chart: { height: 300, type: 'pie', },
			labels: methodLabel,
			series:  methodCount,
			responsive: [{
				breakpoint: 480,
				options: {
					chart: { width: 200 },
					legend: { position: 'bottom' }
				}
			}],
			tooltip: {
				y: {
					formatter: function (y) {
						return y;
					}
				}
			}
		};

		var paymentReport = new ApexCharts(
			document.querySelector("#method-report"),
			paymentReportOptions
		);
		paymentReport.render();



		var oderRevenueOptions = {
			chart: { height: 275, type: 'line', toolbar: { show: false }, },

			series: [{
				name: 'Revenue',
				type: 'column',
				data: revenueAmount
			}, {
				name: 'Sell Count',
				type: 'line',
				data: revenueSalesCount
			}],
			stroke: { width: [0, 4] },
			labels: saleLabels,
			xaxis: {
				tooltip: {formatter: function(val, opts) { return YearMonth + val;}}
			},
			yaxis: [
				{ show: false,
					title: { text: 'Series A', },
				},{ show: false, opposite: false,
					title: { text: 'Series B', }, }, ],

			tooltip: { shared: true, intersect: false,
				x: { formatter: (value) => { return YearMonth + value } },
				y: {

					formatter: function (y, { series, seriesIndex, dataPointIndex, w }) {
						if(seriesIndex == 0) var preText =  "$";
						else var preText =  "";

						if(typeof y !== "undefined") return  preText + y.toFixed(0);
						return y;
					}
				}
			}

		};

		var chart = new ApexCharts(
			document.querySelector("#revenue-report"),
			oderRevenueOptions
		);

		chart.render();


	})(jQuery);
</script>

