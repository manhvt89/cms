<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="content-header-left">
        <h1><?=$title?></h1>
    </div>
    <div class="content-header-right">
        <a href="<?=base_url($index_url)?>" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
       <?=flash_message()?>
       <?php echo form_open_multipart(base_url("{$edit_url}/{$page['id']}"), array('class' => 'form-horizontal'));?>
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Heading </label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="heading" value="<?php echo $page['heading']; ?>">
                            </div>
                        </div>    
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Content </label>
                            <div class="col-sm-9">
                                <textarea class="form-control editor" name="content" style="height:60px;"><?php echo $page['content']; ?></textarea>
                            </div>
                        </div>                               
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Title </label>
                            <div class="col-sm-9">
                                <input type="text" autocomplete="off" class="form-control" name="mt" value="<?php echo $page['mt']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Keyword </label>
                            <div class="col-sm-9">
                               <textarea class="form-control h_100" name="mk"><?php echo $page['mk']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Meta Description </label>
                            <div class="col-sm-9">
                               <textarea class="form-control h_100" name="md"><?php echo $page['md']; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Language </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="" value="<?php echo $page['lang_name']; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button value="1" type="submit" class="btn btn-success pull-left" name="form1">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
    <?=form_close(); ?>

</section>

<?= $this->endSection() ?>
