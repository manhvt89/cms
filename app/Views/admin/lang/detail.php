<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Language Detail</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url("admin/lang")?>" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

       <?=flash_message()?>
	   <?=form_open(base_url("admin/lang/detail/{$id}"),array('class' => 'form-horizontal')); ?>
	        <div class="box box-info">
	            <div class="box-body">
	            	
	            	<?php for($i=0;$i<count($arr1);$i++): ?>
	                <div class="form-group">
	                    <label for="" class="col-sm-4 control-label"><?php echo $arr2[$i]; ?></label>
	                    <div class="col-sm-7">
	                        <input type="text" class="form-control" name="new_arr[]" value="<?php echo $arr3[$i]; ?>">
	                    </div>
	                </div>
	                <input type="hidden" name="new_arr1[]" value="<?php echo $arr1[$i]; ?>">
	                <input type="hidden" name="id" value="<?php echo $id; ?>">
	            	<?php endfor; ?>

	                <div class="form-group">
	                	<label for="" class="col-sm-4 control-label"></label>
	                    <div class="col-sm-6">
	                      <button value="1" type="submit" class="btn btn-success pull-left" name="form1">Update</button>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <?=form_close(); ?>

</section>

<?= $this->endSection() ?>
