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
													<div class="stat-panel-title text-uppercase">Add a new Board</div>
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
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">New Device</div>
									<div class="panel-body">
                                        {!! Form::open(array('url' => route('device.store'),'method'=>'POST', 'class'=>'form-horizontal style-form')) !!}
                                            <div class="">
                                            	<label for="name" class="control-label">Name</label>
                                            	<input type="text" name="name" class="form-control">
                                            </div>
                                            <div class="">
                                            	<div class="checkbox checkbox-primary">
                                                	<input type="checkbox" name="output">
                                                	<label>Enable Output</label>
                                                </div>
                                            </div>
                                            <div class="">
                                            	<label for="display_type" class="control-label">Device Type</label>
                                            	<select class="form-control" name="display_type">
                                            		{{ $displayTypes = App\DisplayType::all() }}
                                            		@foreach ($displayTypes as $displayType)
                                            			<option value="{{ $displayType->id }}">{{$displayType->name}}</option>
                                            		@endforeach
                                            	</select>
                                            </div>
											<div class="">
												<label class="control-label">Choose Board</label>
												<select name="board" class="form-control">
													@foreach ($boards as $board)
														<option value="{{$board->id}}" 
														         @if(session('current_board') == $board->id)
														         selected
														         @endif
														         >
															{{$board->name}}
														</option>	
													@endforeach
												</select>
											</div>
                                            <div class="hr-dashed"></div>
                                            <div class="col-sm-11 col-sm-offset-1">
                                                    <button class="btn btn-success pull-right" type="submit">Create   </button>
                                            </div>
                                        {!! Form::close() !!}  
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
