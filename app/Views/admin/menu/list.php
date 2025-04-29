<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
    <h1>Quản lý Menu: <?= esc($group['name']) ?></h1>
	</div>
	<div class="content-header-right">
        <a href="<?= base_url('admin/menu/create/'.$group['id']) ?>" class="btn btn-primary mb-3">Thêm Menu</a>
        <a href="<?= base_url('admin/menugroup') ?>" class="btn btn-secondary mb-3">Quay lại Nhóm Menu</a>

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
            <th>Name</th>
            <th>Tiêu đề</th>
            <th>Link URL</th>
            <th>Thứ tự</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($items as $item): ?>
            <tr>
                <td><?= $item['menu_id'] ?></td>
                <td><?= esc($item['menu_name']) ?></td>
                <td><?= esc($item['title']) ?></td>
                <td><?= esc($item['url']) ?></td>
                <td><?= esc($item['sort_order']) ?></td>
                <td>
                    <a href="<?= base_url('admin/menu/edit/'.$item['menu_id']) ?>" class="btn btn-sm btn-warning">Sửa</a>
                    <a href="<?= base_url('admin/menu/delete/'.$item['menu_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
				</div>
			</div>

</section>

<?= $this->endSection() ?>
