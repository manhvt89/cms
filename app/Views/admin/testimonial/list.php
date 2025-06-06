<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?=$title?></h1>
	</div>
	<div class="content-header-right">
        <a href="<?= base_url('admin/testimonial/add') ?>" class="btn btn-primary mb-3">Thêm Menu</a>
        
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
								<th width="30">SL</th>
								<th>Photo</th>
								<th width="100">Name</th>
								<th width="100">Designation</th>
								<th>Comment</th>
								<th>Language</th>
								<th width="80">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;							
							foreach ($testimonial as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td style="width:130px;"><img src="<?=base_url($row['photo']) ?>" alt="<?=$row['name']; ?>" style="width:120px;"></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['designation']; ?></td>
									<td><?php echo $row['comment']; ?></td>
									<td><?php echo $row['lang_name']; ?></td>
									<td>										
										<a href="<?php echo base_url(); ?>admin/testimonial/edit/<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
										<a href="<?php echo base_url(); ?>admin/testimonial/delete/<?php echo $row['id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>
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
