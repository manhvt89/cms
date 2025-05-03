<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?=$title?></h1>
	</div>
	<div class="content-header-right">
        <a href="<?= base_url('admin/shop/add/category') ?>" class="btn btn-primary mb-3">Thêm Mới</a>
        
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
								<th>Category Name</th>
								<th>Category Description</th>
								<th>Publication Status</th>
								<th width="140">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							foreach ($category as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td style="width:150px;"><?=$row['category_photo']?></td>
									<td><?=$row['category_name']?></td>
									<td><?=$row['category_description'] ?></td>
									<td>
										<?=$row["publication_status"]?>
									</td>
									<td>
										<?=$row["edit_button"]?>
										<?=$row["delete_button"]?>										
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
