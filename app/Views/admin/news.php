<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View News</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/news/add" class="btn btn-primary btn-sm">Add New</a>
	</div>
</section>


<section class="content">

	<div class="row">
		<div class="col-md-12">

			<?php
			if(session()->getFlashdata('error')) {
				?>
				<div class="callout callout-danger">
					<p><?= session()->getFlashdata('error'); ?></p>
				</div>
				<?php
			}
			if(session()->getFlashdata('success')) {
				?>
				<div class="callout callout-success">
					<p><?= session()->getFlashdata('success'); ?></p>
				</div>
				<?php
			}
			?>

			<div class="box box-info">

				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>SL</th>
								<th>Title</th>
								<th>Photo</th>
								<th>Banner</th>
								<th>Category</th>
								<th>Language</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							foreach ($news as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['news_title']; ?></td>
									<td>
										<img src="<?php echo base_url($row['photo']); ?>" alt="<?php echo $row['news_title']; ?>" style="width:100px;">
									</td>
									<td>
										<?php if($row['banner'] != ''): ?>
										<img src="<?php echo base_url($row['banner']); ?>" alt="<?php echo $row['news_title']; ?>" style="width:180px;">
										<?php endif; ?>
									</td>
									<td>
										<?php echo $row['category_name']; ?>
									</td>
									<td><?php echo $row['lang_name']; ?></td>
									<td>
									<?php $_sUrl = $row['slug'];?>										
									<a href="<?=base_url("{$_sUrl}") ?>" class="btn btn-success btn-xs" target="_blank">View</a>
										<a href="<?php echo base_url("admin/news/edit/{$row['news_id']}"); ?>" class="btn btn-primary btn-xs">Edit</a>
										<a href="<?php echo base_url(); ?>admin/news/delete/<?php echo $row['news_id']; ?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>  
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


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this item?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
