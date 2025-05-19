<!-- media_popup.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="csrf-token" content="<?= csrf_hash() ?>">
  <meta name="csrf-header" content="<?= csrf_header() ?>">

  <title>Thư viện hình ảnh</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
  <style>
    .image-grid { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 15px; }
    .image-item { position: relative; }
    .image-item img { width: 120px; height: 100px; object-fit: cover; cursor: pointer; border: 2px solid transparent; }
    .image-item img:hover { border-color: #0d6efd; }
    .image-meta { margin-top: 10px; font-size: 14px; }
    .image-selected { border-color: #198754 !important; }
  </style>
</head>
<body>
<div class="container mt-4">
  <ul class="nav nav-tabs" id="mediaTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="library-tab" data-bs-toggle="tab" data-bs-target="#library" type="button" role="tab">Thư viện</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload" type="button" role="tab">Tải ảnh lên</button>
    </li>
  </ul>
  <div class="tab-content mt-3">
    <!-- Thư viện ảnh -->
    <div class="tab-pane fade show active" id="library" role="tabpanel">
      <div class="row">
        <div class="col-md-8">
          <div class="image-grid">
          <?php foreach ($files as $img): 
            $_sSrc = str_replace(ROOTPATH . 'public', '', $img);
          ?>
            <div class="image-item">
              <img src="<?= base_url($_sSrc) ?>" data-src="<?= base_url($_sSrc) ?>" onclick="selectImage(this)">
            </div>
          <?php endforeach; ?>

          <div class="pagination mt-3">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
              <button class="btn btn-sm <?= $i == $currentPage ? 'btn-primary' : 'btn-outline-primary' ?> me-1" onclick="loadPage(<?= $i ?>)">
                <?= $i ?>
              </button>
            <?php endfor; ?>
          </div>
          </div>
        </div>
        <div class="col-md-4">
          <div id="imageInfo" class="d-none">
            <img id="previewImage" src="" class="img-fluid mb-2" />
            <input type="text" id="altText" class="form-control mb-2" placeholder="Văn bản thay thế (ALT)">
            <input type="text" id="imgWidth" class="form-control mb-2" placeholder="Chiều rộng">
            <input type="text" id="imgHeight" class="form-control mb-2" placeholder="Chiều cao">
            <button class="btn btn-primary" onclick="insertSelectedImage()">Chọn ảnh này</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Tải ảnh lên -->
    <div class="tab-pane fade" id="upload" role="tabpanel">
      <form action="<?= base_url('admin/media/upload') ?>" class="dropzone" id="myDropzone">
       
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
  let selectedImageUrl = '';

  function loadPage(page) {
      fetch('<?= base_url("admin/media/ajaxLibrary") ?>?page=' + page)
          .then(res => res.text())
          .then(html => {
              document.querySelector("#library .image-grid").innerHTML = html;
          });
  }


  function selectImage(el) {
    const allImages = document.querySelectorAll('.image-item img');
    allImages.forEach(img => img.classList.remove('image-selected'));

    el.classList.add('image-selected');
    selectedImageUrl = el.dataset.src;

    document.getElementById('imageInfo').classList.remove('d-none');
    document.getElementById('previewImage').src = selectedImageUrl;
    document.getElementById('altText').value = '';
    document.getElementById('imgWidth').value = '';
    document.getElementById('imgHeight').value = '';
  }

  function insertSelectedImage() {
    console.log('insertSelectedImage');
    console.log(window.parent);
    if (window.parent && typeof window.parent.setImageFromPopup === 'function'){
      console.log('insertSelectedImage');
      const selectedUrl = selectedImageUrl; // bạn lấy từ biến toàn cục khi click ảnh
      window.parent.setImageFromPopup(selectedUrl);
      window.close();
    }
  }

/*
  function insertSelectedImage() {
    if (window.opener && window.opener.tinymceFileCallback && selectedImageUrl) {
      let alt = document.getElementById('altText').value;
      let width = document.getElementById('imgWidth').value;
      let height = document.getElementById('imgHeight').value;
      let format = '';
      let classAttr = format ? ` class="${format}"` : '';
      const html = `<img src="${selectedImageUrl}" alt="${alt}" width="${width}" height="${height}"${classAttr}>`;
        window.opener.tinymce.activeEditor.execCommand('mceInsertContent', false, html);
      window.close();
      window.opener.tinymce.activeEditor.windowManager.close();

      /*let alt = document.getElementById('altText').value;
      let width = document.getElementById('imgWidth').value;
      let height = document.getElementById('imgHeight').value;
      let html = `<img src="${selectedImageUrl}" alt="${alt}" ${width ? `width='${width}'` : ''} ${height ? `height='${height}'` : ''}>`;
      window.opener.tinymceFileCallback(html);
      window.close();
      */
  //  }
  //}

  Dropzone.options.myDropzone = {
    paramName: "file", // tên biến trong request
    maxFilesize: 5, // MB
    acceptedFiles: "image/*",

    init: function () {
      this.on("sending", function(file, xhr, formData) {
        // Gửi CSRF token trong formData
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log("Token: "+csrfToken);
        const csrfName = "<?= csrf_token() ?>"; // ví dụ: csrf_test_name
        formData.append(csrfName, csrfToken);
      });
      this.on("success", function (file, response) {
        console.log("Upload response:", response);
        if (response.csrf_hash) {
          console.log("Tạo mới token: "+response.csrf_hash);
          document.querySelector('meta[name="csrf-token"]').setAttribute('content', response.csrf_hash);
          var _csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          console.log("Đã thiết lập token: "+_csrfToken);
          localStorage.setItem("latest_csrf_token", response.csrf_hash); //lưu lại local
        }

        
        // Nếu response là object, ví dụ: { success: true, url: '...' }
        if (response && response.url) {
          // 1. Chờ tab "Thư viện" active xong (đợi sự kiện `shown.bs.tab`)
          //console.log(document.querySelector('#mediaTab'));
          document.querySelector('#mediaTab').addEventListener('shown.bs.tab', function (event) {
            console.log("tab show");
            console.log(event.target);
            if (event.target.id == 'library-tab') {
                console.log('into tab');
              // 3. Fetch HTML mới cho thư viện
                  fetch("<?= base_url('admin/media/ajaxLibrary') ?>")
                    .then(res => res.text())
                    .then(html => {
                          const gridContainer = document.querySelector("#library .image-grid");
                          if (gridContainer) {
                            gridContainer.innerHTML = html;
                            // 3. Sau khi gán HTML xong, chọn ảnh vừa upload
                            const firstImg = gridContainer.querySelector('.image-item img');
                            if (firstImg) {
                              firstImg.click();
                              // Optional: scroll vào ảnh nếu muốn
                              // firstImg.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                          }
                        });
                    }
            }, { once: true }); // Đảm bảo chỉ chạy một lần duy nhất
          //2   
          let libraryTab = document.querySelector('#library-tab');
          let bsTab = new bootstrap.Tab(libraryTab);
          bsTab.show();
          
          this.removeFile(file);
          
        } else {
          // Nếu không đúng định dạng hoặc lỗi
          alert("Upload thất bại: " + JSON.stringify(response));
        }
      });

      this.on("error", function(file, errorMessage) {
        alert("Lỗi khi upload: " + JSON.stringify(errorMessage));
      });
    }
  };
</script>
</body>
</html>