<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chọn ảnh</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    .image-list img {
      cursor: pointer;
      max-width: 100%;
      height: auto;
      margin-bottom: 10px;
      border: 2px solid transparent;
    }
    .image-list img.selected {
      border-color: #0d6efd;
    }
    .preview-img {
      max-width: 100%;
      height: auto;
      border: 1px solid #ddd;
      margin-bottom: 10px;
    }
  </style>
</head>
<body class="container py-4">
  <div class="row">
    <!-- Danh sách ảnh -->
    <div class="col-md-6 image-list border-end">
      <h5>Thư viện ảnh</h5>
      <div class="row">
        <?php foreach ($files as $image): 
          $_sSrc = str_replace(ROOTPATH.'public','',$image);
          ?>
          <div class="col-4 mb-3">
            <img src="<?= base_url($_sSrc) ?>" data-src="<?= base_url($_sSrc) ?>" class="img-thumbnail">
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Preview và điền thông tin -->
    <div class="col-md-6">
      <h5>Xem trước ảnh</h5>
      <img id="preview" src="" class="preview-img d-none">
      <input type="hidden" id="image-url" value="">
      <div class="mb-2">
        <label>Alt Text:</label>
        <input type="text" id="alt" class="form-control">
      </div>
      <div class="mb-2 row">
        <div class="col">
          <label>Width:</label>
          <input type="text" id="width" class="form-control" placeholder="auto">
        </div>
        <div class="col">
          <label>Height:</label>
          <input type="text" id="height" class="form-control" placeholder="auto">
        </div>
      </div>
      <div class="mb-2 row">
        <label>Format:</label>
        <select id="format" class="form-control">
          <option value="">Mặc định</option>
          <option value="align-left">Căn trái</option>
          <option value="align-center">Căn giữa</option>
          <option value="align-right">Căn phải</option>
          <option value="img-fluid">Responsive</option>
        </select>
      </div>

      <button id="insert" class="btn btn-primary mt-2">Chèn vào bài viết</button>
    </div>
  </div>

  <script>
    const imgs = document.querySelectorAll('.image-list img');
    let selected = null;

    imgs.forEach(img => {
      img.addEventListener('click', () => {
        if (selected) selected.classList.remove('selected');
        img.classList.add('selected');
        selected = img;

        const url = img.getAttribute('data-src');
        document.getElementById('preview').src = url;
        document.getElementById('preview').classList.remove('d-none');
        document.getElementById('image-url').value = url;
      });
    });

    document.getElementById('insert').addEventListener('click', () => {
      const url = document.getElementById('image-url').value;
      const alt = document.getElementById('alt').value;
      const width = document.getElementById('width').value;
      const height = document.getElementById('height').value;
      const format = document.getElementById('format').value;

      let classAttr = format ? ` class="${format}"` : '';

      if (window.opener && window.opener.tinymceFileCallback) {
        const html = `<img src="${url}" alt="${alt}" width="${width}" height="${height}"${classAttr}>`;
        window.opener.tinymce.activeEditor.execCommand('mceInsertContent', false, html);
        window.close();
      } else {
        alert("Không thể truyền ảnh về trình soạn thảo.");
      }
    });

  </script>
</body>
</html>