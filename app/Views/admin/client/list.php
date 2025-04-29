<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?=$title?></h1>
	</div>
	<div class="content-header-right">
        <a href="<?= base_url('admin/client/add') ?>" class="btn btn-primary mb-3">Thêm Menu</a>
        
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
								<th width="100">URL</th>
								<th width="80">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;							
							foreach ($client as $row) {
								$i++;
								?>
								<tr>
									<td><?=$row['no'] ?></td>
									<td style="width:130px;">
										<?=$row['photo']?>
									</td>
									<td><?=$row['name'] ?></td>
									<td><?=$row['url'] ?></td>
									<td>										
										<?=$row['edit_button']?>
										<?=$row['delete_button']?>
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
