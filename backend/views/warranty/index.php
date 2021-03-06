<div class="container-fluid">

	<div class="row">
		<div class="col-12">
			<div class="page-title-box">
				<h4 class="page-title float-left">Warranty</h4>

				<ol class="breadcrumb float-right">
					<li class="breadcrumb-item"><a href="#">Warranty</a></li>
				</ol>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-12">
			<div class="card-box table-responsive m-b-30">
				<h4 class="m-t-0 header-title m-b-30"><b>Filter Warranty</b></h4>
				
				<div class="form-row">
					<div class="form-group col-md-12">
						<label for="inputEmail4" class="col-form-label">Warranty Created Date :</label>
						<div class="form-row">
							<div class="col-md-8">
								<div class="form-group row">
									<div class="col-3" style="padding-right: 0;">
										<input class="form-control" type="date" name="date_from" value="<?php echo date('Y-m-d'); ?>">
									</div>
									<div class="col-1" style="padding-left: 0; max-width: 19%;">
										<span class="input-group-addon" style="height: 38.36px;">
                                            <span class="dripicons-calendar"></span>&nbsp; From &nbsp;
                                        </span>
									</div>
									<div class="col-3" style="padding-right: 0;">
										<input class="form-control" type="date" name="date_to" value="<?php echo date('Y-m-d'); ?>">
									</div>
									<div class="col-1" style="padding-left: 0; max-width: 19%;">
										<span class="input-group-addon" style="height: 38.36px;">
											<span class="dripicons-calendar"></span>&nbsp; To &nbsp;
										</span>
									</div>
								</div>
							</div>
						</div>
						<label for="inputEmail4" class="col-form-label">Warranty Status :</label>
						<div class="form-row">
							<div class="col-md-6">
								<div class="form-group row">
									<select name="warranty_status" class="form-control" style="margin-left: 15px;">
										<option value="ALL">ALL</option>
										<option value="AVAILABLE">Avaliable</option>
										<option value="USED">Used</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-12">
								<div class="pull-right">
								    <button type="button" id="export-warranty" class="btn btn-primary waves-effect waves-light"><i class="fa fa-search"></i> Export QR Code</button>
									<button type="button" id="filter-warranty" class="btn btn-primary waves-effect waves-light"><i class="fa fa-search"></i> Filter</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="card-box table-responsive">
				<h4 class="m-t-0 header-title m-b-30"><b>Warranty List</b></h4>
				
				<div class="btn-toolbar m-b-30">
					<a class="btn btn-info waves-effect waves-light" href="<?php echo Yii::$app->urlManager->getBaseUrl(); ?>/warranty/create" target="_blank"> <i class="fa fa-cart-plus m-r-5"></i> <span>Add New</span> </a>
				</div>
				
				<table id="data-warranty" class="table table-bordered" width=100%>
					<thead>
					<tr>
						<th width=5%>No</th>
						<th width=15%>Code</th>
						<th width=15%>Number</th>
						<th width=20%>Type</th>
						<th width=20%>Status</th>
						<th width=20%>Create Date</th>
						<th width=5%>#</th>
					</tr>
					</thead>

					<tbody>
					
					</tbody>
				</table>
			</div>
		</div>
	</div> <!-- end row -->
</div>

<script>
var dataUrl = baseUrl + "/warranty/getallwarranty",
	dataColumn = [
        { "data" : "No", "name" : "No", "searchable" : false },
        { "data" : "warranty_code", "name" : "warranty_code" },
		{ "data" : "warranty_number", "name" : "warranty_number" },
		{ "data" : "warranty_type", "name" : "warranty_type" },
		{ "data" : "warranty_status", "name" : "warranty_status" },
		{ "data" : "date", "name" : "date" },
		{ "data" : "action", "name" : "action", "searchable" : false },
		{ "data" : "warranty_date_from", "name" : "order_date_from", "searchable" : false },
		{ "data" : "warranty_date_to", "name" : "order_date_to", "searchable" : false }
    ];
</script>