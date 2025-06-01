<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?=$title?></h1>
	</div>
	<div class="content-header-right">
        <a href="<?= base_url('admin/feature/add') ?>" class="btn btn-primary mb-3">Thêm mới</a>
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
								<th>Name</th>
								<th>Content</th>
								<th>Icon</th>
								
								<th width="140">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;							
							foreach ($items as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['content']; ?></td>
									<td style="width:200px;"><?=$row['icon']?></td>
									
									<td>
										<a href="<?php echo base_url(); ?>admin/feature/edit/<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
										<a href="<?php echo base_url(); ?>admin/feature/delete/<?php echo $row['id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a> 
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
