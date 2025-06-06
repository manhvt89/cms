<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View About Page</h1>
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
                                <th>Heading</th>
                                <th>Language</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            foreach ($page_about as $row) {
                                $i++;
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['about_heading']; ?></td>
                                    <td><?php echo $row['lang_name']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>admin/pageabout/edit/<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
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
