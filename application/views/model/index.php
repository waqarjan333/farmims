<div class="row">
	<div class="col-md-4">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">Add New Model</h3>
			</div>
			<?php echo form_open(); ?>

			<div class="card-body">
				<div class="form-group">
					<label for="brand_id" class=" control-label">Brand</label>
					<div class="">
						<select onchange="get_series()" id="brand_id" name="brand_id" class="form-control select2">
							<option value="">Select Brand</option>
							<?php
							foreach ($brands as $brand) {
								$selected = ($brand['id'] == $this->input->post('brand_id')) ? ' selected="selected"' : "";

								echo '<option value="' . $brand['id'] . '" ' . $selected . '>' . $brand['name'] . '</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="series_id" class=" control-label"><span class="text-danger">*</span>Series</label>
					<div class="">
						<select name="series_id" id="series_id" class="form-control select2">
							<option value="">Select Brand First</option>

						</select>
						<span class="text-danger"><?php echo form_error('series_id'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class=" control-label"><span class="text-danger">*</span>Name</label>
					<div class="">
						<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
						<span class="text-danger"><?php echo form_error('name'); ?></span>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>

	<div class="col-md-8">
		<div class="card card-primary">
			<div class="card-header">
				<h3 class="card-title">All Models</h3>
			</div>
			<div class="card-body">
				<table class="table table-striped table-bordered" id="mydt">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Series</th>
							<th>Brand</th>
							<th>Date Created</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	function get_series() {
		$.ajax({
			url: "<?= base_url('model/get_series_by_brand/') ?>" + $('#brand_id').val(),
			type: "POST",
			beforeSend: function() {
				 
			},
			success: function(response) { 
				$('#series_id').html(response);
			}
		});
	}
	$(document).ready(function() {
		$('#mydt').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?php echo base_url('model/get_list') ?>",
				"dataType": "json",
				"type": "POST"
			},
			"columns": [{
					"data": "id"
				},
				{
					"data": "name"
				},
				{
					"data": "series_name"
				},
				{
					"data": "brand_name"
				},
				{
					"data": "date_created"
				},
				{
					"data": "status"
				},
				{
					"data": "actions"
				},
			]

		});
	});
</script>