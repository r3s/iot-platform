@extends('backend.layouts.default')

@section('main-content')
<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Dashboard</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">My Boards</div>
									<div class="panel-body">

										<table id="boards" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
											<thead>
					                            <tr>
					                                <th>Board Name</th>
					                                <th>Created At</th>
					                                <th>Active</th>
					                                <th>Actions</th>
					                            </tr>
					                        </thead>
										</table>
										
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

@section('extra-js')
<script type="text/javascript">
	$(document).ready(function(){
	    var boards = '{{ route('board.table') }}';
	    var reqTable = $('#boards').DataTable({
	        "processing": true,
	        "serverSide": true,
	        "ajax": boards,
	        
	    });
	});
</script>
@stop