<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Languages</h1>
	</div>
	<div class="content-header-right">
		<a href="<?=base_url("admin/lang/add")?>" class="btn btn-primary btn-sm">Add New</a>
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
			        <th width="50">SL</th>
			        <th>Language Name</th>
			        <th>Language Short Name</th>
			        <th>Layout Direction</th>
			        <th>Language Default</th>
			        <th width="200">Action</th>
			    </tr>
			</thead>
            <tbody>
	            <?php
	            	$i=0;
	            	foreach ($lang as $row) {
	            		$i++;
		            	?>
			            <tr>
			                <td><?=$i; ?></td>
			                <td><?=$row['lang_name']; ?></td>
			                <td><?=$row['lang_short_name']; ?></td>
			                <td><?=$row['layout_direction']; ?></td>
			                <td><?=$row['lang_default']; ?></td>
			                <td>
			                    <a href="<?=base_url("admin/lang/detail/{$row['lang_id']}")?>" class="btn btn-warning btn-xs">Update Details</a>
			                    <a href="<?=base_url("admin/lang/edit/{$row['lang_id']}") ?>" class="btn btn-primary btn-xs">Edit</a>
			                    <a href="<?=base_url("admin/lang/delete/{$row['lang_id']}")?>" class="btn btn-danger btn-xs" onClick="return confirm('Are you sure?');">Delete</a> 
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
