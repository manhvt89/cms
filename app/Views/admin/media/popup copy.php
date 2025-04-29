<!DOCTYPE html>
<html>
<head>
  <title>Chọn ảnh</title>
  <style>
    img { max-width: 150px; margin: 10px; border: 1px solid #ccc; cursor: pointer; }
  </style>
</head>
<body>
  <h3>Chọn ảnh</h3>

  <!-- Danh sách ảnh -->
  <?php foreach ($files as $img): ?>
    <img src="<?= base_url(str_replace(ROOTPATH.'public','' , $img)) ?>" 
         onclick="selectImage('<?= base_url(str_replace(ROOTPATH.'public','', $img)) ?>')">
  <?php endforeach; ?>

  <h3>Hoặc upload ảnh mới</h3>
  <form action="<?= base_url('admin/media/upload') ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <button type="submit">Tải lên</button>
  </form>

  <h3>Thông tin ảnh</h3>
  <input type="text" id="image-url" placeholder="Image URL" readonly><br>
  <input type="text" id="image-alt" placeholder="Alt text"><br>
  <input type="number" id="image-width" placeholder="Width"><br>
  <input type="number" id="image-height" placeholder="Height"><br>
  <button onclick="insertImage()">Chèn vào TinyMCE</button>

  <script>
    function selectImage(url) {
      document.getElementById('image-url').value = url;

      const img = new Image();
      img.onload = function () {
        document.getElementById('image-width').value = img.width;
        document.getElementById('image-height').value = img.height;
      };
      img.src = url;
    }

    function insertImage() {
      const url = document.getElementById('image-url').value;
      const alt = document.getElementById('image-alt').value;
      const width = document.getElementById('image-width').value;
      const height = document.getElementById('image-height').value;

      if (window.opener && window.opener.tinymceFileCallback) {
        window.opener.tinymceFileCallback(url, { alt, width, height });
        window.close();
      }
    }
  </script>
</body>
</html>
