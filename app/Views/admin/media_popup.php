<html>
<head>
  <title>Thư viện ảnh</title>
  <link rel="stylesheet" href="<?= base_url('public/css/mediapopup.css') ?>">
</head>
<body>
  <div class="header">
    <h2>📁 Thư viện ảnh</h2>
    		
    <form method="post" enctype="multipart/form-data" action="<?= base_url('admin/media/upload') ?>">
        <?= csrf_field() ?>
        <input type="file" name="image" required>
        <button type="submit">Tải ảnh lên</button>
    </form>
  </div>

  <div class="media-grid">
    <?php //var_dump($files); ?>
    <?php foreach($files as $file): ?>
       <?php  //echo str_replace(ROOTPATH."public/", '', $file); die(); ?>
      <?php $src = base_url(str_replace(ROOTPATH."public/", '', $file)); ?>
      <div class="media-item" onclick="selectImage('<?= $src ?>')">
        <img src="<?= $src ?>" alt="">
        <div class="filename"><?= basename($file) ?></div>
      </div>
    <?php endforeach; ?>
  </div>

  <script>
    function selectImage(url) {
      window.opener.tinymceFileCallback(url);
      window.close();
    }
  </script>
</body>
</html>
