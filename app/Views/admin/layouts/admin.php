<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Panel</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/datepicker3.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/all.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/dataTables.bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/jquery.fancybox.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/magnific-popup.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/admin/css/style.css">
	


	<style>
		.skin-blue .wrapper,
		.skin-blue .main-header .logo,
		.skin-blue .main-header .navbar,
		.skin-blue .main-sidebar,
		.content-header .content-header-right a,
		.content .form-horizontal .btn-success {
			background-color: #4172a5!important;
		}

		.content-header .content-header-right a,
		.content .form-horizontal .btn-success {
			border-color: #4172a5!important;
		}
		
		.content-header>h1,
		.content-header .content-header-left h1,
		h3 {
			color: #4172a5!important;
		}

		.box.box-info {
			border-top-color: #4172a5!important;
		}

		.nav-tabs-custom>.nav-tabs>li.active {
			border-top-color: #f4f4f4!important;
		}

		.skin-blue .sidebar a {
			color: #fff!important;
		}

		.skin-blue .sidebar-menu>li>.treeview-menu {
			margin: 0!important;
		}
		.skin-blue .sidebar-menu>li>a {
			border-left: 0!important;
		}

		.nav-tabs-custom>.nav-tabs>li {
			border-top-width: 1px!important;
		}

		.wp-featured-wrapper {
  border: 1px solid #e2e8f0;
  border-radius: 8px;
  background: #fff;
  padding: 12px;
  max-width: 400px;
  margin: 20px auto;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
  text-align: center;
}

.wp-featured-wrapper img {
  max-width: 100%;
  max-height: 220px;
  object-fit: contain;
  margin-bottom: 12px;
  border-radius: 6px;
  border: 1px solid #ccc;
  background: #f9f9f9;
}

.wp-featured-wrapper .wp-btns {
  display: flex;
  justify-content: center;
  gap: 10px;
}

.wp-featured-wrapper .btn {
  flex: 1;
  padding: 8px 12px;
  font-size: 14px;
  font-weight: bold;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
}

.wp-featured-wrapper .btn-primary {
  background-color: #0073aa;
  color: #fff;
}

.wp-featured-wrapper .btn-primary:hover {
  background-color: #005f8d;
}

.wp-featured-wrapper .btn-danger {
  background-color: #d63638;
  color: #fff;
}

.wp-featured-wrapper .btn-danger:hover {
  background-color: #b52b2c;
}


	</style>
    <!-- Custom head -->
    <?= $this->renderSection('head') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    
    <!-- Header -->
    <?= $this->include('admin/partials/header') ?>

    <!-- Sidebar -->
    <?= $this->include('admin/partials/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?= $this->renderSection('content') ?>
    </div>

    <!-- Footer -->
    <?= $this->include('admin/partials/footer') ?>

</div>
<!-- Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" style="max-width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mediaModalLabel">Chọn ảnh</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body p-0">
        <iframe id="mediaIframe" src="" style="width:100%; height:80vh; border:0;"></iframe>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<script src="<?php echo base_url(); ?>public/admin/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/select2.full.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jscolor.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.date.extensions.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.inputmask.extensions.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/icheck.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/fastclick.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.fancybox.pack.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/app.min.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/js/jquery.magnific-popup.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>public/admin/ckeditor/ckeditor.js"></script> -->
	<script src="<?php echo base_url(); ?>public/admin/js/demo.js"></script>
	<script src="<?php echo base_url(); ?>public/admin/tinymce/tinymce.min.js"></script>
	<!-- Bootstrap 5 JS + Popper (required) -->

	<script>

	(function($) {
		
		$(document).ready(function() {
			
	        // $('#editor1').summernote({
	        // 	height: 300
	        // });
	        // $('#editor2').summernote({
	        // 	height: 300
	        // });
	        // $('#editor3').summernote({
	        // 	height: 300
	        // });
	        // $('#editor4').summernote({
	        // 	height: 300
	        // });
	        // $('#editor5').summernote({
	        // 	height: 300
	        // });
	        // $('#editor6').summernote({
	        // 	height: 300
	        // });
	        // $('.editor').summernote({
	        // 	height: 300
	        // });
	        // $('.editor_short').summernote({
	        // 	height: 150
	        // });


	    });

	    //Initialize Select2 Elements
	    $(".select2").select2();

	    //Datemask dd/mm/yyyy
	    $("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
	    //Datemask2 mm/dd/yyyy
	    $("#datemask2").inputmask("mm-dd-yyyy", {"placeholder": "mm-dd-yyyy"});
	    //Money Euro
	    $("[data-mask]").inputmask();

	    //Date picker
	    $('.datepicker').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });
	    $('#datepicker').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });

	    $('#datepicker1').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });

	    $('#datepicker2').datepicker({
	      autoclose: true,
	      format: 'yyyy-mm-dd',
	      todayBtn: 'linked',
	    });

	    //iCheck for checkbox and radio inputs
	    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	      checkboxClass: 'icheckbox_minimal-blue',
	      radioClass: 'iradio_minimal-blue'
	    });
	    //Red color scheme for iCheck
	    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
	      checkboxClass: 'icheckbox_minimal-red',
	      radioClass: 'iradio_minimal-red'
	    });
	    //Flat red color scheme for iCheck
	    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	      checkboxClass: 'icheckbox_flat-green',
	      radioClass: 'iradio_flat-green'
	    });


	    $("#example1").DataTable();
	    $('#example2').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false
	    });

	    $('#confirm-delete').on('show.bs.modal', function(e) {
	      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
	    });

	    $(document).ready(function () {
	    	//CKEDITOR.replaceAll( 'editor' );
			
	  	}); 
		/////////////////////////////#4172a5
		
		tinymce.init({
  selector: 'textarea.editor',
  height: 400,
  plugins: 'image link',
  toolbar: 'insertCustomImage | undo redo | bold italic | alignleft aligncenter alignright | link',
  contextmenu: 'link editCustomImage', // 👈 menu chuột phải
  setup: function (editor) {
    // 📌 Mở popup chọn ảnh từ thư viện
    function openImageDialog(initialData = {}, callback) {
		let imageUrl = initialData.src || '';
		console.log(initialData);
		/// Manager OPEN
		
		const dialog = editor.windowManager.open({
			title: 'Chèn / Chỉnh sửa ảnh',
			initialData: {
				src: initialData.src || '',
				alt: initialData.alt || '',
				align: initialData.align || '',
				class: initialData.class || '',
				width: initialData.width || '',
				height: initialData.height || ''
			},
			body: {
			type: 'panel',
			items: [
				{ type: 'input', name: 'src', label: 'URL ảnh' },
				{
				type: 'button',
				name: 'choose',
				text: 'Chọn từ thư viện',
				buttonType: 'secondary'
				},
				{ type: 'input', name: 'alt', label: 'Văn bản thay thế (alt)' },
				{ type: 'input', name: 'width', label: 'Chiều rộng (px)' },
				{ type: 'input', name: 'height', label: 'Chiều cao (px)' },
				{
				type: 'selectbox',
				name: 'align',
				label: 'Căn ảnh',
				items: [
					{ text: 'Trái', value: 'left' },
					{ text: 'Phải', value: 'right' },
					{ text: 'Giữa', value: 'center' },
					{ text: 'Inline', value: 'inline' }
				]
				},
				{
				type: 'selectbox',
				name: 'class',
				label: 'Kiểu ảnh',
				items: [
					{ text: 'Mặc định', value: '' },
					{ text: 'Bo tròn', value: 'rounded' },
					{ text: 'Đổ bóng', value: 'shadow' },
					{ text: 'Viền ảnh', value: 'border' }
				]
				}
			]
			},
			buttons: [
			{ type: 'cancel', text: 'Hủy' },
			{ type: 'submit', text: 'Chèn', primary: true }
			],
			onAction: function (api, details) {
			if (details.name === 'choose') {
				const win = window.open('<?= base_url('/admin/media/popup') ?>', 'FileManager', 'width=900,height=600');
				window.setImageFromPopup = function (url) {
				imageUrl = url;
				api.setData({ src: url });

				// 🔁 Cập nhật lại CSRF token
				let newToken = localStorage.getItem("latest_csrf_token");
				console.log(newToken);
				console.log('WL');
				localStorage.removeItem("latest_csrf_token");
				if (newToken) {
					console.log('ifInto');
					let csrfInput = document.querySelector('input[name="csrf_test_name"]');
					if (csrfInput) {
						console.log('login');
						csrfInput.value = newToken;
					}
				}
				win.close();
				};
			}
			},
			onSubmit: function (api) {
			const data = api.getData();
			const src = imageUrl || data.src;
			console.log(data);
			let alignStyle = '';
			if (data.align === 'left') alignStyle = 'float: left; margin: 5px 10px 5px 0;';
			else if (data.align === 'right') alignStyle = 'float: right; margin: 5px 0 5px 10px;';
			else if (data.align === 'center') alignStyle = 'display: block; margin: 0 auto;';
			else if (data.align === 'inline') alignStyle = 'display: inline-block;';

			// Lấy giá trị width và height nếu người dùng nhập
			const width = parseInt(data.width);
			const height = parseInt(data.height);

			// Validate và thêm vào style nếu hợp lệ
			if (data.width && (!isNaN(width) && width > 0)) {
				alignStyle += ` width: ${width}px;`;
			}

			if (data.height && (!isNaN(height) && height > 0)) {
				alignStyle += ` height: ${height}px;`;
			}

			const imgHTML = `<img src="${src}" alt="${data.alt}" class="${data.class}" style="${alignStyle}">`;
			
			//const imgHTML = `<img src="${src}" alt="${data.alt}" class="${data.class}" style="${alignStyle}">`;
			callback(imgHTML);
			api.close();
			}
		});
		
		/// ENDDDDDDDDDDDDĐ	
    }

    // 🧩 Nút toolbar
    editor.ui.registry.addButton('insertCustomImage', {
      icon: 'image',
      tooltip: 'Chèn ảnh từ thư viện',
      onAction: function () {
        openImageDialog({}, function (imgHTML) {
          editor.insertContent(imgHTML);
        });
      }
    });

    // 🧩 Context menu - chèn ảnh
    editor.ui.registry.addMenuItem('insertCustomImage', {
      icon: 'image',
      text: 'Chèn ảnh từ thư viện',
      onAction: function () {
        openImageDialog({}, function (imgHTML) {
          editor.insertContent(imgHTML);
        });
      }
    });

    // 🧩 Context menu - chỉnh sửa ảnh
    editor.ui.registry.addMenuItem('editCustomImage', {
      icon: 'edit-block',
      text: 'Chỉnh sửa ảnh',
      onAction: function () {
        const imgNode = editor.selection.getNode();
		console.log(imgNode);
        if (imgNode.nodeName === 'IMG') {
			const style = imgNode.getAttribute('style') || '';
			// Regex để lấy width và height trong style
			const widthMatch = style.match(/width:\s*(\d+)px/);
      		const heightMatch = style.match(/height:\s*(\d+)px/);
          const data = {
            src: imgNode.getAttribute('src'),
            alt: imgNode.getAttribute('alt') || '',
            class: imgNode.getAttribute('class') || '',
			width: widthMatch ? widthMatch[1] : '',
        	height: heightMatch ? heightMatch[1] : '',
            align: (() => {
              const style = imgNode.getAttribute('style') || '';
              if (style.includes('float: left')) return 'left';
              if (style.includes('float: right')) return 'right';
              if (style.includes('display: block')) return 'center';
              if (style.includes('inline-block')) return 'inline';
              return '';
            })()
          };
          openImageDialog(data, function (imgHTML) {
            editor.selection.setContent(imgHTML);
          });
        }
      }
    });
  }
});



	
	/*
		  tinymce.init({
			selector: 'textarea.editor',
			plugins: 'image link media code',
			toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image media | code',
			height: 400,
			file_picker_callback: function(callback, value, meta) {
				window.tinymceFileCallback = callback;
				window.open('<?= base_url('admin/media/popup') ?>', 'popup', 'width=800,height=600');
			}
			}); */
			

 
	})(jQuery);

	</script>

	<script type="text/javascript">
		function openMediaPopup(name, mode = 'single') {
			const iframeUrl = `<?= base_url('/admin/media/popup') ?>?mode=${mode}&target=${name}`;
			document.getElementById('mediaIframe').src = iframeUrl;

			// Gán callback tương ứng
			if (mode === 'single') {
				window.setImageFromPopup = function (url) {
					const baseUrl = '<?= base_url() ?>';
					const relativeUrl = url.replace(baseUrl, '/');

					document.getElementById(name).value = relativeUrl;
					document.getElementById(name + '-preview').src = baseUrl + relativeUrl;

					$('#mediaModal').modal('hide');
				};
			} else {
				window.setImagesFromPopup = function (urls) {
					const baseUrl = '<?= base_url() ?>';
					const relativeUrls = urls.map(url => url.replace(baseUrl, '/'));

					document.getElementById(name).value = relativeUrls.join(',');

					const previewContainer = document.getElementById(name + '-preview');
					previewContainer.innerHTML = '';
					relativeUrls.forEach(rel => {
						const img = document.createElement('img');
						img.src = baseUrl + rel;
						img.style.height = '100px';
						img.style.marginRight = '5px';
						previewContainer.appendChild(img);
					});
					$('#mediaModal').modal('hide');
					
				};
			}

			// Hiện modal
			$('#mediaModal').modal('show');
		}

		function openMediaPopup1(name, mode = 'single') {
			const win = window.open('<?= base_url("/admin/media/popup") ?>'+'?mode='+mode, 'FileManager', 'width=900,height=600');
			if(mode == 'single')
			{
				window.setImageFromPopup = function (url) {
					console.log('Full URL:', url);

					// Chuyển về relative URL
					const baseUrl = '<?= base_url() ?>'; // Ví dụ: https://cmsdev.com/
					const relativeUrl = url.replace(baseUrl, '/'); // Bỏ domain => còn lại /uploads/images/xxx.png

					console.log('Relative URL:', relativeUrl);

					document.getElementById(name).value = relativeUrl;

					// Hiển thị ảnh
					document.getElementById(name + '-preview').src = baseUrl + relativeUrl;

					// 🔁 Cập nhật lại CSRF token
					let newToken = localStorage.getItem("latest_csrf_token");
					localStorage.removeItem("latest_csrf_token");
					console.log('ƯL');
					console.log(newToken);
					if (newToken) {
						console.log('IFINTO');
						let csrfInput = document.querySelector('input[name="csrf_test_name"]');
						if (csrfInput) {
							console.log('GETINTO');
							csrfInput.value = newToken;
						}
					}

					win.close();
				};
			} else {
				window.setImagesFromPopup = function (urls) {
				console.log('Selected URLs:', urls);

				const baseUrl = '<?= base_url() ?>';
				const relativeUrls = urls.map(url => url.replace(baseUrl, '/'));

				document.getElementById(name).value = relativeUrls.join(',');

				const previewContainer = document.getElementById(name + '-preview');
				if (previewContainer) {
					previewContainer.innerHTML = ''; // Clear old
					relativeUrls.forEach(rel => {
						const img = document.createElement('img');
						img.src = baseUrl + rel;
						img.style.height = '100px';
						img.style.marginRight = '5px';
						previewContainer.appendChild(img);
					});
				}

				let newToken = localStorage.getItem("latest_csrf_token");
				localStorage.removeItem("latest_csrf_token");
				if (newToken) {
					let csrfInput = document.querySelector('input[name="csrf_test_name"]');
					if (csrfInput) csrfInput.value = newToken;
				}

				win.close();
			};
			}
		}

		function removeFeaturedPhoto(name) {
			document.getElementById(name).value = '';
			document.getElementById(name+'-preview').src = 'https://via.placeholder.com/300x200?text=Chưa+chọn+ảnh';
		}

        $(document).ready(function () {

		    $("#btnAddNew").click(function () {

		        var rowNumber = $("#PhotosTable tbody tr").length;

		        var trNew = "";              

		        var addLink = "<div class=\"upload-btn" + rowNumber + "\"><input type=\"file\" name=\"photos[]\"></div>";
		           
		        var deleteRow = "<a href=\"javascript:void()\" class=\"Delete btn btn-danger btn-xs\">X</a>";

		        trNew = trNew + "<tr> ";

		        trNew += "<td>" + addLink + "</td>";
		        trNew += "<td style=\"width:28px;\">" + deleteRow + "</td>";

		        trNew = trNew + " </tr>";

		        $("#PhotosTable tbody").append(trNew);

		    });

		    $('#PhotosTable').delegate('a.Delete', 'click', function () {
		        $(this).parent().parent().fadeOut('slow').remove();
		        return false;
		    });


		});

		selectEmailMethod = $('#selectEmailMethod').val();
        $('#selectEmailMethod').on('change',function() {
            selectEmailMethod = $('#selectEmailMethod').val();
            if ( selectEmailMethod == 'Normal' ) {
               	$('#smtpContainer').hide();
            } else if ( selectEmailMethod == 'SMTP' ) {
               	$('#smtpContainer').show();
            }
        });
        
    </script>

<?= $this->renderSection('script') ?>
</body>
</html>
