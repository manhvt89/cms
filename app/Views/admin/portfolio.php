<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Portfolio</h1>
	</div>
	<div class="content-header-right">
		<a href="<?=base_url("admin/portfolio/add")?>" class="btn btn-primary btn-sm">Add New</a>
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
								<th>Category</th>
								<th>Photo</th>
								<th>Language</th>
								<th width="140">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;						
							foreach ($portfolio as $row) {
								$i++;
								?>
								<tr>
									<td style="width:100px;"><?php echo $i; ?></td>
									<td><?=$row['name']?></td>
									<td><?=$row['category_name']?></td>
									<td style="width:250px;"><img src="<?=base_url($row['photo'])?>" alt="<?=$row['name'] ?>" style="width:150px;"></td>
									<td><?=$row['lang_name']?></td>
									<td>
										<a class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal<?=$i ?>">Details</a>						
										<a href="<?=base_url("admin/portfolio/edit/{$row['id']}")?>" class="btn btn-primary btn-xs">Edit</a>
										<a href="<?=base_url("admin/portfolio/delete/{$row['id']}")?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a>
									</td>
								</tr>
								<div class="modal fade" id="myModal<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			                        <div class="modal-dialog" role="document">
			                            <div class="modal-content">
			                                <div class="modal-header">
			                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                                    <h4 class="modal-title" id="myModalLabel">View Details</h4>
			                                </div>
			                                <div class="modal-body">
			                                    <div class="rTable">
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Name</strong></div>
			                                            <div class="rTableCell">
			                                                <?=$row['name']?>
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Content</strong></div>
			                                            <div class="rTableCell">
			                                                <?=$row['content']?>
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Client Name</strong></div>
			                                            <div class="rTableCell">
			                                                <?=$row['client_name']?>
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Client Company</strong></div>
			                                            <div class="rTableCell">
			                                                <?=$row['client_company']?>
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Project Start Date</strong></div>
			                                            <div class="rTableCell">
			                                                <?=$row['start_date']?>
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Project End Date</strong></div>
			                                            <div class="rTableCell">
			                                                <?=$row['end_date']?>
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Website</strong></div>
			                                            <div class="rTableCell">
			                                                <?=$row['website']?>
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Cost</strong></div>
			                                            <div class="rTableCell">
			                                                <?=$row['cost']?>
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Client Comment</strong></div>
			                                            <div class="rTableCell">
			                                                <?=$row['client_comment']?>
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Category</strong></div>
			                                            <div class="rTableCell">
			                                               	<?=$row['category_name']?>
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Featured Photo</strong></div>
			                                            <div class="rTableCell">
			                                                <img src="<?php echo base_url().'public/uploads/'.$row['photo']; ?>" alt="" style="width:120px;">
			                                            </div>
			                                        </div>
			                                        <div class="rTableRow">
			                                            <div class="rTableHead"><strong>Other Photos</strong></div>
			                                            <div class="rTableCell">
			                                                <?php
			                                                $photos = $all_photos[$row['id']];
			                                                foreach ($photos as $row1) {
			                                                	?>
																	<img src="<?php echo base_url().'public/uploads/portfolio_photos/'.$row1['photo']; ?>" alt="" style="width:120px;">
			                                                	<?php
			                                                }
			                                                ?>
			                                            </div>
			                                        </div>
			                                    </div>
			                                </div>
			                                <div class="modal-footer">
			                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
								<?php
							}
							?>							
						</tbody>
					</table>
        </div>
      </div> 

</section>

<?= $this->endSection() ?>
