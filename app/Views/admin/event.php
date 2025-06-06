<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Event</h1>
	</div>
	<div class="content-header-right">
		<a href="<?= base_url("admin/event/add")?>" class="btn btn-primary btn-sm">Add New</a>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">
			<?=flash_message()?>
			<div class="box box-info">
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Title</th>
								<th>Photo</th>
								<th>Banner</th>
								<th style="width:60px;">Start Date</th>
								<th style="width:60px;">End Date</th>
								<th>Status</th>
								<th>Language</th>
								<th style="width:100px;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							foreach ($event as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['event_title']; ?></td>
									<td>
										<img src="<?php echo base_url(); ?>public/uploads/<?php echo $row['photo']; ?>" alt="<?php echo $row['event_title']; ?>" style="width:100px;">
									</td>
									<td>
										<img src="<?php echo base_url(); ?>public/uploads/<?php echo $row['banner']; ?>" alt="<?php echo $row['event_title']; ?>" style="width:180px;">
									</td>
									<td>
										<?php echo $row['event_start_date']; ?>
									</td>
									<td>
										<?php echo $row['event_end_date']; ?>
									</td>
									<td>
										<?php
										$today = date('Y-m-d');
										if($today>=$row['event_start_date'] && $today<=$row['event_end_date']) {
											echo 'Current Event';
										}
										if($today<$row['event_start_date']) {
											echo 'Upcoming Event';
										}
										if($today>$row['event_end_date']) {
											echo 'Past Event';
										}
										?>
									</td>
									<td><?php echo $row['lang_name']; ?></td>
									<td>
                                        <a href="<?=base_url("#/{$row['event_id']}") ?>" class="btn btn-primary btn-xs">View</a>										
										<a href="<?=base_url("admin/event/edit/{$row['event_id']}") ?>" class="btn btn-primary btn-xs">Edit</a>
										<a href="<?= base_url("admin/event/delete/{$row['event_id']}"); ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>  
									</td>
								</tr>
								<?php
							}
							?>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<?= $this->endSection() ?>
