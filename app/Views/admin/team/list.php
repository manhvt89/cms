<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?=$title?></h1>
	</div>
	<div class="content-header-right">
        <a href="<?= base_url('admin/team/add') ?>" class="btn btn-primary mb-3">Thêm Menu</a>
        
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
								<th>Photo</th>
								<th>Name</th>
								<th>Designation</th>
								<th>Language</th>
								<th width="140">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							foreach ($team_member as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td style="width:150px;"><img src="<?=base_url($row['photo']); ?>" alt="<?=$row['name']; ?>" style="width:100px;"></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['designation']; ?></td>
									<td><?php echo $row['lang_name']; ?></td>
									<td>										
										<a href="<?=base_url("admin/team/edit/{$row['id']}"); ?>" class="btn btn-primary btn-xs">Edit</a>
										<a href="<?=base_url("admin/team/delete/{$row['id']}"); ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>
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
