<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Photos</h1>
	</div>
	<div class="content-header-right">
		<a href="<?=base_url("admin/photo/add")?>" class="btn btn-primary btn-sm">Add New</a>
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
			        <th>Action</th>
			    </tr>
			</thead>
            <tbody>

            	<?php
            	$i=0;
            	foreach ($photo as $row) {
            		$i++;
	            	?>
	                <tr>
	                    <td><?php echo $i; ?></td>
	                    <td>
	                    	<img src="<?=base_url($row['photo_name']); ?>" width="140">
	                    </td>
	                    <td>
	                        <a href="<?=base_url("admin/photo/edit/{$row['photo_id']}")?>" class="btn btn-primary btn-xs">Edit</a>
                            <a href="<?=base_url("admin/photo/delete/{$row['photo_id']}")?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a> 
	                    </td>
	                </tr>
	                <?php
            	}
            	?>
            </tbody>
          </table>
        </div>
      </div> 

</section>

<?= $this->endSection() ?>
