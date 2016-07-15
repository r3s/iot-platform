@extends('backend.layouts.default')
@section('main-content')
<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Create Board</h2>

						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">New Board</div>
									<div class="panel-body">
                                            {!! Form::open(array('url' => route('board.store'),'method'=>'POST', 'files'=>true, 'class'=>'form-horizontal style-form')) !!}
                                                @include('snippets.generic_form_field', ['name' => 'name','type'=>'text', 'block_field'=>true])
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
