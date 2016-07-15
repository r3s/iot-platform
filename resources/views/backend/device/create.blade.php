@extends('backend.layouts.default')
@section('main-content')
<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Create Device</h2>


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
