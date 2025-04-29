<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?= isset($item) ? 'Chỉnh sửa Menu' : 'Thêm Menu' ?></h1>
	</div>
	<div class="content-header-right">
          </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

       <?=flash_message()?>
      
	   <div class="box box-info">
        <div class="box-body">

            <form method="post" action="<?= base_url("admin/menu/store/{$item['group_id']}") ?>">
                    <?php if (isset($item['menu_id'])): ?>
                        <input type="hidden" name="menu_id" value="<?= $item['menu_id'] ?>">
                        <?=csrf_field()?>
                    <?php endif; ?>
 
                    <input type="hidden" name="group_id" value="<?= isset($item['group_id']) ? $item['group_id'] : (isset($group_id) ? $group_id : '') ?>">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="menu_name" class="form-control" value="<?= isset($item['menu_name']) ? esc($item['menu_name']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="title" class="form-control" value="<?= isset($item['title']) ? esc($item['title']) : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text" name="url" class="form-control" value="<?= isset($item['url']) ? esc($item['url']) : '' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parent Menu (nếu có)</label>
                        <input type="number" name="parent_id" class="form-control" value="<?= isset($item['parent_id']) ? esc($item['parent_id']) : 0 ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thứ tự hiển thị</label>
                        <input type="number" name="order" class="form-control" value="<?= isset($item['sort_order']) ? esc($item['sort_order']) : 0 ?>">
                    </div>

                    <button type="submit" class="btn btn-success">Lưu</button>
                    
                </form>
			</div>
            </div>

</section>

<?= $this->endSection() ?>
