<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit News</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/news" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">
        <?php
			if(session()->getFlashdata('error')) {
				?>
				<div class="callout callout-danger">
					<p><?= session()->getFlashdata('error'); ?></p>
				</div>
				<?php
			}
			if(session()->getFlashdata('success')) {
				?>
				<div class="callout callout-success">
					<p><?= session()->getFlashdata('success'); ?></p>
				</div>
				<?php
			}
			?>
			<?= form_open_multipart(base_url().'admin/news/edit/'.$news['news_id'],['class' => 'form-horizontal','id'=>'post_form']); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Title <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" id="news_title" name="news_title" value="<?php echo $news['news_title']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Slug</label>
							<div class="col-sm-6">
								<span id="slug_display"><?=$news['slug']?></span>
								<button type="button" id="edit_slug_btn">Chỉnh sửa</button><br>
								<input class="form-control" type="text" name="slug" id="slug" style="display:none;" value="<?=$news['slug']?>">	
								<span id="slug_status" style="font-size: 0.9em; margin-left: 10px;"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Short Content <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control" name="news_content_short" style="height:80px;"><?php echo $news['news_content_short']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Content <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="news_content" id="news_content"><?php echo $news['news_content']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Publish Date <span>*</span></label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="news_date" id="datepicker" value="<?php echo $news['news_date']; ?>">(Format: yy-mm-dd)
							</div>
						</div>
						
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Categories <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="category_id">
								<?php
				            	$i=0;
				            	foreach ($all_category as $row) {
									?>
									<option value="<?php echo $row['category_id']; ?>" <?php if($row['category_id']==$news['category_id']){echo 'selected';} ?>><?php echo $row['category_name']; ?></option>
	                                <?php
								}
								?>
								</select>
				            </div>
				        </div>

				        <div class="form-group">
				            <label for="" class="col-sm-2 control-label">Comment <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="comment">
									<option value="On" <?php if($news['comment'] == 'On') {echo 'selected';} ?>>On</option>
									<option value="Off" <?php if($news['comment'] == 'Off') {echo 'selected';} ?>>Off</option>
								</select>
				            </div>
				        </div>
				        <h3 class="seo-info">Photo and Banner</h3>
						<div class="form-group">
							<label for="featured-photo" class="col-sm-2 control-label">Featured Photo *</label>
							<div id="featured-photo-wrapper" class="wp-featured-wrapper">
								
								<?php if ($news['photo']): ?>
									<img src="<?= base_url($news['photo']) ?>" alt="Featured" style="max-height: 150px; display:block;" id="featured-photo-preview">
								<?php else: ?>
									<img src="https://via.placeholder.com/300x200?text=Chưa+chọn+ảnh" alt="Featured" id="featured-photo-preview">
								<?php endif; ?>
								
								<input type="hidden" name="featured-photo" id="featured-photo" value="<?= $news['photo'] ?>">
								<div class="wp-btns">
									<button type="button" class="btn btn-primary btn-sm" onclick="openMediaPopup('featured-photo')">Chọn ảnh</button>
									<button type="button" class="btn btn-danger btn-sm" onclick="removeFeaturedPhoto('featured-photo')">Xóa</button>
								</div>
		
							</div>
						</div>

						<div class="form-group">
							<label for="banner-photo" class="col-sm-2 control-label">Banner Photo *</label>
							<div id="banner-photo-wrapper" class="wp-featured-wrapper">
								<?php if ($news['banner']): ?>
									<img src="<?= base_url($news['banner']) ?>" alt="Banner" style="max-height: 150px; display:block;" id="banner-photo-preview">
								<?php else: ?>
									<img src="https://via.placeholder.com/300x200?text=Chưa+chọn+ảnh" alt="Featured" id="banner-photo-preview">
								
								<?php endif; ?>
							
								<input type="hidden" name="banner-photo" id="banner-photo" value="<?= $news['banner'] ?>">
								<div class="wp-btns">
									<button type="button" class="btn btn-primary btn-sm" onclick="openMediaPopup('banner-photo')">Chọn ảnh</button>
									<button type="button" class="btn btn-danger btn-sm" onclick="removeFeaturedPhoto('banner-photo')">Xóa</button>
								</div>
								
							</div>
						</div>
						
						<h3 class="seo-info">SEO Information</h3>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Title </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_title" id="meta_title" value="<?php echo $news['meta_title']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Keywords </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_keyword" id="meta_keyword" value="<?php echo $news['meta_keyword']; ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Description </label>
							<div class="col-sm-9">
								<textarea class="form-control" name="meta_description" id="meta_description" style="height:200px;"><?php echo $news['meta_description']; ?></textarea>
							</div>
						</div>
						<div class="form-group"></div>
						<div style="margin: 10px 0;">
  <label>SEO Score:</label>
  <span id="seo_score" style="padding: 4px 10px; border-radius: 4px; color: #fff;">0</span>
</div>

<div style="margin: 10px 0;">
  <label>Readability:</label>
  <span id="readability_score" style="padding: 4px 10px; border-radius: 4px; color: #fff;">0</span>
</div>

<!-- Nút mở modal -->
<button type="button" onclick="showPreview()" style="margin: 10px 0;">🔍 Xem đánh giá chi tiết</button>

<!-- Modal -->
<div id="seo_modal" style="display: none; position: fixed; top: 10%; left: 50%; transform: translateX(-50%); background: white; border: 1px solid #ccc; padding: 20px; z-index: 9999; width: 60%; box-shadow: 0 0 20px rgba(0,0,0,0.2); border-radius: 10px;">
  <h3>🧠 Đánh giá SEO & Readability</h3>
  <div id="modal_content"></div>
  <button type="button" onclick="closePreview()">Đóng</button>
</div>

<!-- Lớp phủ nền -->
<div id="seo_modal_overlay" style="display: none; position: fixed; top: 0; left: 0; width:100%; height: 100%; background: rgba(0,0,0,0.4); z-index: 9998;" onclick="closePreview()"></div>

						<div id="seo_suggestions"></div>

						<input type="hidden" name="seo_score" id="input_seo_score" />
						<input type="hidden" name="readability_score" id="input_readability_score" />
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Language </label>
							<div class="col-sm-2">
								<select name="lang_id" class="form-control select2">
									<?php
									foreach($all_lang as $row)
									{
										?><option value="<?php echo $row['lang_id']; ?>" <?php if($news['lang_id'] == $row['lang_id']) {echo 'selected';} ?>><?php echo $row['lang_name']; ?></option><?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1" value="1">Update</button>
							</div>
						</div>
					</div>
				</div>
			<?= form_close(); ?>
		</div>
	</div>

</section>
<script>
function analyzeSEO(content, keyword, title, description) {
        const keywordCount = content.toLowerCase().split(keyword.toLowerCase()).length - 1;
        const keywordDensity = (keywordCount / content.split(" ").length) * 100;

        let score = 0;
		let _oTitle = {};
		let	_oDescription = {};
		let	_oContent = {};
		let suggestions = [];
        if (title.toLowerCase().includes(keyword.toLowerCase())){
			let msg = "";
			if (title.length < 30 || title.length > 60)
			{
				msg = "⚠️ Tiêu đề nên nằm trong khoảng 30-60 ký tự.";
				_oTitle.score = 5;
			} else {
				msg = "Tốt.";
				_oTitle.score = 10;
			}
			_oTitle.message = msg;
			suggestions.push(_oTitle.message);
		}  else {
			_oTitle.score = 0;
			_oTitle.message = "⚠️ Không có từ khóa trong tiêu đề.";
			suggestions.push(_oTitle.message);
		}
        score += _oTitle.score;
		if (description.toLowerCase().includes(keyword.toLowerCase()))
		{
			if (description.length < 70 || description.length > 160)
			{
				_oDescription.score = 5;
				_oDescription.message = "⚠️ Mô tả nên nằm trong khoảng 70-160 ký tự.";
			} else {
				_oDescription.score = 10;
				_oDescription.message = "Tốt.";
			}
			suggestions.push(_oDescription.message);
			
		} else {
			_oDescription.score = 0;
			_oDescription.message = "⚠️ Chưa có từ khóa trong mô tả.";
			suggestions.push(_oDescription.message);
		}
		
		score += _oDescription.score;

        if (keywordDensity >= 1 && keywordDensity <= 3) score += 10;
        if (keywordCount >= 2) score += 10;

		const first100Words = content.toLowerCase().split(/\s+/).slice(0, 100).join(" ");
		if (!first100Words.includes(keyword.toLowerCase())) {
			_oContent.message = "⚠️ Từ khóa nên xuất hiện trong 100 từ đầu tiên của nội dung.";
			_oContent.score = 5;
			suggestions.push(_oContent.message);
		} else {
			_oContent.score = 10;
			_oContent.message = "Tốt";
			suggestions.push(_oContent.message);
		}

		const headings = content.match(/<h[1-6][^>]*>(.*?)<\/h[1-6]>/gi) || [];
		const keywordInHeadings = headings.some(h => h.toLowerCase().includes(keyword.toLowerCase()));
		if (!keywordInHeadings) {
			suggestions.push("⚠️ Nên chèn từ khóa vào các tiêu đề phụ (heading).");
		}
        return {
            score,
            keywordCount,
            keywordDensity: keywordDensity.toFixed(2),
			_oTitle,
			_oDescription,
			_oContent,
			suggestions
        };
    }

    function analyzeReadability(content) {
        const words = content.trim().split(/\s+/).length;
        const sentences = content.split(/[.!?]/).filter(Boolean).length;
        const avgWordsPerSentence = words / (sentences || 1);
        const flesch = 206.835 - 1.015 * avgWordsPerSentence - 84.6 * (syllables(content) / words);

        return {
            flesch: flesch.toFixed(2),
            sentences,
            words
        };
    }

    function syllables(text) {
        return text.toLowerCase().split(/[^aeiouy]+/).filter(s => s.length > 0).length;
    }

    function suggestImprovements(seo, readability) {
        let suggestions = seo.suggestions;
        if (seo.score < 30) suggestions.push("⚠️ SEO chưa tối ưu. Cần thêm từ khóa vào tiêu đề, mô tả, nội dung.");
        if (readability.flesch < 60) suggestions.push("⚠️ Văn bản khó đọc. Cần viết ngắn gọn và rõ ràng hơn.");
        if (seo.keywordDensity > 4) suggestions.push("⚠️ Mật độ từ khóa quá cao.");
        return suggestions;
    }

    function updateScore() {
		const content = document.getElementById('news_content').value;
		const keyword = document.getElementById('meta_keyword').value;
		const title = document.getElementById('meta_title').value;
		const description = document.getElementById('meta_description').value;

		const seo = analyzeSEO(content, keyword, title, description);
		const readability = analyzeReadability(content);
		const suggestions = suggestImprovements(seo, readability);

		const seoElem = document.getElementById('seo_score');
		const readElem = document.getElementById('readability_score');

		seoElem.innerText = seo.score;
		readElem.innerText = readability.flesch;

		// Màu cho điểm SEO
		seoElem.style.backgroundColor = seo.score >= 40 ? (seo.score >= 70 ? '#28a745' : '#ffc107') : '#dc3545';
		// Màu cho Readability
		readElem.style.backgroundColor = readability.flesch >= 60 ? '#28a745' : (readability.flesch >= 40 ? '#ffc107' : '#dc3545');

		// Ẩn suggestion chi tiết (nếu cần)
		const suggestionBox = document.getElementById('seo_suggestions');
		suggestionBox.innerHTML = suggestions.map(s => `<p>${s}</p>`).join("");

		// Gán giá trị cho form
		document.getElementById('input_seo_score').value = seo.score;
		document.getElementById('input_readability_score').value = readability.flesch;

		// Gán thông tin vào modal
		document.getElementById('modal_content').innerHTML = `
			<p><strong>Từ khoá chính:</strong> ${keyword}</p>
			<p><strong>Mật độ từ khoá:</strong> ${seo.keywordDensity}% (${seo.keywordCount} lần)</p>
			<p><strong>Số câu:</strong> ${readability.sentences}</p>
			<p><strong>Số từ:</strong> ${readability.words}</p>
			<p><strong>Chỉ số Flesch:</strong> ${readability.flesch}</p>
			<h4>🔧 Gợi ý cải thiện:</h4>
			${suggestions.map(s => `<li>${s}</li>`).join('')}
		`;
	}


    ['news_content', 'meta_title', 'meta_description', 'meta_keyword'].forEach(id => {
		console.log(document.getElementById(id));
        document.getElementById(id).addEventListener('input', updateScore);
    });

    window.addEventListener('DOMContentLoaded', updateScore);

	function showPreview() {
		document.getElementById('seo_modal').style.display = 'block';
		document.getElementById('seo_modal_overlay').style.display = 'block';
	}

	function closePreview() {
		document.getElementById('seo_modal').style.display = 'none';
		document.getElementById('seo_modal_overlay').style.display = 'none';
	}

	let slugEdited = false;
	let slugValid = true;

	// ✅ HÀM kiểm tra slug
	function checkSlug() {
		const slugInput = document.getElementById('slug');
		const slug = slugify(slugInput.value);
		slugInput.value = slug;
		
		$.get('<?=base_url('get-csrf-token')?>', function (tokenData) {

			$.ajax({
                url: '<?=base_url('admin/news/check-slug')?>',
                type: 'POST',
                data: {
                    'slug': slug,
					'id': id,
                    [tokenData.csrfName]: tokenData.csrfHash
                },
				success: function (response)
				{
					const status = document.getElementById('slug_status');
					if (response.exists || slug.length < 1) {
						slugValid = false;
						status.innerText = '❌ ' + (slug.length < 1 ? 'Slug không được để trống.' : response.message);
						status.style.color = 'red';
					} else {
						slugValid = true;
						status.innerText = '✅ ' + response.message;
						status.style.color = 'green';
					}
				},
				error: function (xhr) {
                    console.log(xhr.responseJSON);
                    $('#slug_status').html('<span style="color:red;">' + xhr.responseJSON.message + '</span>');
                }
			
			});
		});
	}
	document.addEventListener("DOMContentLoaded", () => {
		document.getElementById('news_title').addEventListener('input', function () {
			if (!slugEdited) {
				const autoSlug = slugify(this.value);
				document.getElementById('slug_display').textContent = autoSlug;
				document.getElementById('slug').value = ''; // gửi rỗng để server tạo lại
			}
		});

		document.getElementById('edit_slug_btn').addEventListener('click', function () {
			const slugInput = document.getElementById('slug');
			const slugSpan = document.getElementById('slug_display');
			const title = document.getElementById('news_title');

			if (slugInput.style.display === 'none') {
				slugInput.style.display = 'inline';
				slugSpan.style.display = 'none';
				slugInput.value = slugSpan.textContent;
				slugEdited = true;
				this.textContent = 'Xong';
			} else {
				const edited = slugify(slugInput.value);
				slugInput.value = edited;
				slugSpan.textContent = edited;
				slugInput.style.display = 'none';
				slugSpan.style.display = 'inline';
				checkSlug(); // kiểm tra trùng slug
				if(slugInput.value == "")
				{
					slugSpan.textContent = slugify(title.value);
				}
				this.textContent = 'Chỉnh sửa';
			}
		});

		document.getElementById('slug').addEventListener('blur', function () {
			checkSlug();
		});
	});

	document.addEventListener('DOMContentLoaded', function () {
	// Chặn submit nếu slug không hợp lệ
		document.getElementById('post_form').addEventListener('submit', function (e) {
			e.preventDefault(); // chặn mặc định
			//console.log('123'); 
			const form = this; // ✅ lưu lại tham chiếu đến form
			const slugInput = document.getElementById('slug');
			const title = document.getElementById('news_title').value.trim();
			const slug = slugInput.value.trim() || slugify(title);
			
			$.get('<?=base_url('get-csrf-token')?>', function (tokenData) {	
				if (slug.length === 0 || !slugValid) {
					e.preventDefault();
					alert('Slug không hợp lệ hoặc đã tồn tại. Vui lòng chỉnh sửa!');
					return false;
				}	
				
				const tokenInput = document.querySelector(`input[name="${tokenData.csrfName}"]`);
				console.log(tokenData);
				if (tokenInput) tokenInput.value = tokenData.csrfHash;
				console.log(tokenInput);
				const t = document.querySelector(`input[name="${tokenData.csrfName}"]`);
				console.log(t);
				form.submit();
			});
		});
	});
	</script>
<?= $this->endSection() ?>
