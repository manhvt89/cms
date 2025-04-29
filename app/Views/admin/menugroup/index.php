<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Quản lý Nhóm Menu</h1>
	</div>
	<div class="content-header-right">
		<a href="<?= base_url('admin/menugroup/create') ?>" class="btn btn-primary mb-3">Thêm Nhóm Menu</a>
	</div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

       <?=flash_message()?>
      
	   <div class="box box-info">
				<div class="box-body table-responsive">
				<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên nhóm</th>
            <th>Slug</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($menuGroups as $group): ?>
            <tr>
                <td><?= $group['id'] ?></td>
                <td><?= esc($group['name']) ?></td>
                <td><?= esc($group['slug']) ?></td>
                <td>
                    <a href="<?= base_url('admin/menugroup/edit/'.$group['id']) ?>" class="btn btn-sm btn-warning">Sửa</a>
                    <a href="<?= base_url('admin/menugroup/delete/'.$group['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                    <a href="<?= base_url('admin/menu/index/'.$group['id']) ?>" class="btn btn-sm btn-info">Quản lý Menu</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
				</div>
			</div>

</section>

<?= $this->endSection() ?>
