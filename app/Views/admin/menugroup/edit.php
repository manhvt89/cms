<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1><?= isset($group) ? 'Chỉnh sửa Nhóm Menu' : 'Thêm Nhóm Menu' ?></h1>
	</div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

       <?=flash_message()?>
      
	   <div class="box box-info">
        <div class="box-body">
                <form method="post" action="<?= isset($group) ? base_url('admin/menugroup/store') : base_url('admin/menugroup/store') ?>">
                <?= csrf_field() ?>
                <?php if (isset($group['id'])): ?>
                    <input type="hidden" name="id" value="<?= $group['id'] ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Tên nhóm</label>
                    <input type="text" name="name" class="form-control" value="<?= isset($group['name']) ? esc($group['name']) : '' ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="<?= isset($group['slug']) ? esc($group['slug']) : '' ?>" required>
                </div>

                <button type="submit" class="btn btn-success">Lưu</button>
                <a href="<?= base_url('admin/menugroup') ?>" class="btn btn-secondary">Quay lại</a>
            </form>
			</div>
       </div>
</section>

<?= $this->endSection() ?>
