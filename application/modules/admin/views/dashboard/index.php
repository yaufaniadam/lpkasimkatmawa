<div class="row">
	<div class="col-xl-6 col-lg-6">
		<div class="card mb-4">
			<div class="card-body p-5">
				<div class="row justify-content-between">
					<div class="col">
						<h2 class="text-primary">Selamat Datang,</h2>
						<h3 class="text-primary"><?php echo $_SESSION['fullname']; ?>!</h3>
						<p class="text-gray-700">Ini merupakan halaman pengelolaan SIM Pelayanan Mahasiswa Program Pascasarjana UMY.</p>
						<a class="btn btn-primary btn-sm px-3 py-2" href="<?= base_url("admin/surat/index/" . $this->session->userdata('role')); ?>">
							Lihat Surat masuk
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right ml-1">
								<line x1="5" y1="12" x2="19" y2="12"></line>
								<polyline points="12 5 19 12 12 19"></polyline>
							</svg>
						</a>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-6 col-lg-6">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Menunggu Diproses</h6>
				<div class="dropdown no-arrow">
					<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
						<div class="dropdown-header">Dropdown Header:</div>
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</div>
			</div>
			<!-- Card Body -->
			<div class="card-body">

				<div class="overflow-auto m-2 ml-3">
					<?php
					if ($notif->num_rows() > 0) {
						foreach ($notif->result_array() as $notif) {
					?>

							<div>

								<div class="small text-gray-500"><?= $notif['date_full']; ?> <?= $notif['time']; ?></div>
								<span class="font-weight-bold text-<?= $notif['badge']; ?>"> <i class="<?= $notif['icon']; ?>"></i> <?= $notif['judul_notif']; ?> </span> &raquo; <span class="font-weight-bold"><?= $notif['kategori_surat']; ?> </span>
								<span class="font-weight-normal">(<?= $notif['fullname']; ?>)</span>

								<a class="" href="<?= base_url('notif/detail/' . $notif['notif_id']); ?>">Lihat</a>

							</div>


						<?php } // end foreach
					} else { ?>

						<div>
							<span class="text-gray-500">Belum ada surat yang perlu diproses.</span>
						</div>

					<?php	}	?>
				</div>


			</div>
		</div>
	</div>
</div>
<div class="row">

	<!-- Area Chart -->

	<div class="col-xl-8 col-lg-7">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Laporan Bulanan</h6>
				<div class="dropdown no-arrow">
					<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
						<div class="dropdown-header">Menu:</div>
						<a class="dropdown-item" href="#">Pertahun</a>
						<a class="dropdown-item" href="#">Perbulan</a>
						<!-- <div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a> -->
					</div>
				</div>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="chart-area">
					<div class="chartjs-size-monitor">
						<div class="chartjs-size-monitor-expand">
							<div class=""></div>
						</div>
						<div class="chartjs-size-monitor-shrink">
							<div class=""></div>
						</div>
					</div>
					<canvas id="myAreaChart" width="668" height="320" class="chartjs-render-monitor" style="display: block; width: 668px; height: 320px;"></canvas>
				</div>
			</div>
		</div>
	</div>

	<!-- Pie Chart -->
	<div class="col-xl-4 col-lg-5">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-primary">Chart Surat</h6>
				<div class="dropdown no-arrow">
					<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
						<div class="dropdown-header">Dropdown Header:</div>
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</div>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div class="chart-pie pt-4 pb-2">
					<div class="chartjs-size-monitor">
						<div class="chartjs-size-monitor-expand">
							<div class=""></div>
						</div>
						<div class="chartjs-size-monitor-shrink">
							<div class=""></div>
						</div>
					</div>
					<canvas id="myPieChart" width="301" height="245" class="chartjs-render-monitor" style="display: block; width: 301px; height: 245px;"></canvas>
				</div>
				<div class="mt-4 text-center small">
					<span class="mr-2">
						<i class="fas fa-circle text-primary"></i> Semua Surat
					</span>
					<span class="mr-2">
						<i class="fas fa-circle text-success"></i> Diterbitkan
					</span>

				</div>
			</div>
		</div>
	</div>
</div>


<script src="<?= base_url() ?>public/vendor/chart.js/Chart.min.js"></script>
<script>
	// Set new default font family and font color to mimic Bootstrap's default styling
	Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#858796';

	function number_format(number, decimals, dec_point, thousands_sep) {
		// *     example: number_format(1234.56, 2, ',', ' ');
		// *     return: '1 234,56'
		number = (number + '').replace(',', '').replace(' ', '');
		var n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function(n, prec) {
				var k = Math.pow(10, prec);
				return '' + Math.round(n * k) / k;
			};
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	}

	// Area Chart Example
	var ctx = document.getElementById("myAreaChart");
	var myLineChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [{
				label: "Surat: ",
				lineTension: 0.3,
				backgroundColor: "rgba(78, 115, 223, 0.05)",
				borderColor: "rgba(78, 115, 223, 1)",
				pointRadius: 3,
				pointBackgroundColor: "rgba(78, 115, 223, 1)",
				pointBorderColor: "rgba(78, 115, 223, 1)",
				pointHoverRadius: 3,
				pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
				pointHoverBorderColor: "rgba(78, 115, 223, 1)",
				pointHitRadius: 10,
				pointBorderWidth: 2,
				data: [8, 12, 14, 18, 16, 20, 18, 22, 20, 24, 22, 26],
			}],
		},
		options: {
			maintainAspectRatio: false,
			layout: {
				padding: {
					left: 10,
					right: 25,
					top: 25,
					bottom: 0
				}
			},
			scales: {
				xAxes: [{
					time: {
						unit: 'date'
					},
					gridLines: {
						display: false,
						drawBorder: false
					},
					ticks: {
						maxTicksLimit: 7
					}
				}],
				yAxes: [{
					ticks: {
						maxTicksLimit: 5,
						padding: 10,
						// Include a dollar sign in the ticks
						callback: function(value, index, values) {
							return number_format(value);
						}
					},
					gridLines: {
						color: "rgb(234, 236, 244)",
						zeroLineColor: "rgb(234, 236, 244)",
						drawBorder: false,
						borderDash: [2],
						zeroLineBorderDash: [2]
					}
				}],
			},
			legend: {
				display: false
			},
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				titleMarginBottom: 10,
				titleFontColor: '#6e707e',
				titleFontSize: 14,
				borderColor: '#dddfeb',
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				intersect: false,
				mode: 'index',
				caretPadding: 10,
				callbacks: {
					label: function(tooltipItem, chart) {
						var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
						return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
					}
				}
			}
		}
	});
</script>
<script>
	// Set new default font family and font color to mimic Bootstrap's default styling
	Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#858796';

	// Pie Chart Example
	var ctx = document.getElementById("myPieChart");
	var myPieChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ["Semua Surat", "Diterbitkan"],
			datasets: [{
				data: [550, 530],
				backgroundColor: ['#4e73df', '#1cc88a'],
				hoverBackgroundColor: ['#2e59d9', '#17a673'],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			}],
		},
		options: {
			maintainAspectRatio: false,
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				borderColor: '#dddfeb',
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				caretPadding: 10,
			},
			legend: {
				display: false
			},
			cutoutPercentage: 80,
		},
	});
</script>