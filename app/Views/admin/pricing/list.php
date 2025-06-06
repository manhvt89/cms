<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?=$title?></h1>
	</div>
	<div class="content-header-right">
        <a href="<?= base_url('admin/pricing/add') ?>" class="btn btn-primary mb-3">Thêm Menu</a>
        
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
								<th>Icon</th>
								<th>Title</th>
								<th>Price</th>
								<th>Subtitle</th>
								<th>Language</th>
								<th width="140">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;							
							foreach ($pricing_table as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><i class="<?php echo $row['icon']; ?>" style="color:#333;font-size:40px;"></i></td>
									<td><?php echo $row['title']; ?></td>
									<td><?php echo $row['price']; ?></td>
									<td><?php echo $row['subtitle']; ?></td>
									<td><?php echo $row['lang_name']; ?></td>
									<td>
										<a href="<?php echo base_url(); ?>admin/pricing/edit/<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
										<a href="<?php echo base_url(); ?>admin/pricing/delete/<?php echo $row['id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a> 
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
