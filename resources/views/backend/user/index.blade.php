@extends('backend.layouts.default')
@section('main-content')
<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 ">{{$boardCount}}</div>
													<div class="stat-panel-title text-uppercase">Boards</div>
												</div>
											</div>
											<a href="{{route('board.create')}}" class="block-anchor panel-footer text-center">Create New Board&nbsp; <i class="fa fa-plus"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 ">{{$deviceCount}}</div>
													<div class="stat-panel-title text-uppercase">Devices</div>
												</div>
											</div>
											<a href="{{route('device.create')}}" class="block-anchor panel-footer text-center">Create New Device &nbsp; <i class="fa fa-plus"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>

						{{-- <div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">Sales Report</div>
									<div class="panel-body">
										<div class="chart">
											<canvas id="dashReport" height="310" width="600"></canvas>
										</div>
										<div id="legendDiv"></div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">Recent Boards and Devices</div>
									<div class="panel-body">
										<div class="alert alert-dismissible alert-success">
											<button type="button" class="close" data-dismiss="alert"><i class="fa fa-close"></i></button>
											<strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
										</div>
										<table class="table table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>Username</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">1</th>
													<td>Mark</td>
													<td>Otto</td>
													<td>@mdo</td>
												</tr>
												<tr>
													<th scope="row">2</th>
													<td>Jacob</td>
													<td>Thornton</td>
													<td>@fat</td>
												</tr>
												<tr>
													<th scope="row">3</th>
													<td>Larry</td>
													<td>the Bird</td>
													<td>@twitter</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div> --}}
						</div>

					</div>
				</div>

			</div>
		</div>
@stop

@section('extra-js')
<script>
window.onload = function(){
		// // Line chart from swirlData for dashReport
		// var ctx = document.getElementById("dashReport").getContext("2d");
		// window.myLine = new Chart(ctx).Line(swirlData, {
		// 	responsive: true,
		// 	scaleShowVerticalLines: false,
		// 	scaleBeginAtZero : true,
		// 	multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		// });

		// // Pie Chart from doughutData
		// var doctx = document.getElementById("chart-area3").getContext("2d");
		// window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// // Dougnut Chart from doughnutData
		// var doctx = document.getElementById("chart-area4").getContext("2d");
		// window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
</script>
@stop
