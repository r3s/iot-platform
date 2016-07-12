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
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 ">
														<a href="#">
															<i class="fa fa-plus"></i>
														</a>
													</div>
													<div class="stat-panel-title text-uppercase">Board</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 ">8</div>
													<div class="stat-panel-title text-uppercase">Support Tickets</div>
												</div>
											</div>
											<a href="#" class="block-anchor panel-footer text-center">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 ">58</div>
													<div class="stat-panel-title text-uppercase">New Orders</div>
												</div>
											</div>
											<a href="#" class="block-anchor panel-footer text-center">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-warning text-light">
												<div class="stat-panel text-center">
													<div class="stat-panel-number h1 ">18</div>
													<div class="stat-panel-title text-uppercase">New Comments</div>
												</div>
											</div>
											<a href="#" class="block-anchor panel-footer text-center">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Device Details</div>
									<div class="panel-body">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>Name</td>
                                                    <td>{{$device->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Topic</td>
                                                    <td>{{$device->topic}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Device Type</td>
                                                    <td>{{$device->display_type}}</td>
                                                </tr>
                                                <tr>
                                                	<td>Output Enabled</td>
                                                	<td>
                                                		@if($device->output_enabled)
                                                		Yes
                                                		@else
                                                		No
                                                		@endif
                                                	</td>
                                                </tr>
                                                <tr>
                                                	<td>Board</td>
                                                	<td>{{$device->board->name}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
										<div id="legendDiv"></div>
										<a href="{{route('device.create')}}" class="btn btn-primary">Create a device under this board</a>
										<div id="legendDiv"></div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
@stop
