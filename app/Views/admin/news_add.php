<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add News</h1>
	</div>
	<div class="content-header-right">
		<a href="<?php echo base_url(); ?>admin/news" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">

        	<?= flash_message()?>
			<?= form_open_multipart(base_url('admin/news/add'),['class' => 'form-horizontal','id'=>'post_form']); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Title <span>*</span></label>
							<div class="col-sm-6">
                            <?= form_input([
                                    'name'  => 'news_title',
                                    'id'    => 'news_title',
                                    'class' => 'form-control',
                                    'value' => old('news_title', ''),  // Giữ lại giá trị cũ nếu có
                                    'placeholder' => 'Enter title here'
                                ]) ?>
								
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Slug</label>
							<div class="col-sm-6">
								<span id="slug_display"></span>
								<button type="button" id="edit_slug_btn">Chỉnh sửa</button><br>
								<input class="form-control" type="text" name="slug" id="slug" style="display:none;" value="<?=old('slug')?>">	
								<span id="slug_status" style="font-size: 0.9em; margin-left: 10px;"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Short Content <span>*</span></label>
							<div class="col-sm-9">
                            <?= form_textarea([
                                    'name'  => 'news_content_short',
                                    'id'    => 'news_content_short',
                                    'class' => 'form-control',
                                    'style' => 'height:80px;',
                                    'value' => old('news_content_short', '')  // Giữ lại giá trị cũ sau khi form submit lại
                                ]) ?>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Content <span>*</span></label>
							<div class="col-sm-9">
								<textarea class="form-control editor" id="news_content" name="news_content"><?= old('news_content', '') ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Publish Date <span>*</span></label>
							<div class="col-sm-2">
								<input type="text" class="form-control" name="news_date" id="datepicker" value="<?php echo date('Y-m-d'); ?>">(Format: yy-mm-dd)
							</div>
						</div>						
						<div class="form-group">
				            <label for="" class="col-sm-2 control-label">Select Category <span>*</span></label>
				            <div class="col-sm-3">
				            	<select class="form-control select2" name="category_id">
				            		<option value="">Select a category</option>
				            		<?php
						            	$i=0;
						            	foreach ($all_category as $row) {
						            		?>
											<option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
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
									<option value="On">On</option>
									<option value="Off">Off</option>
								</select>
				            </div>
				        </div>
				        <h3 class="seo-info">Photo and Banner</h3>
	
						<div class="form-group">
							<?=form_wp_photo('featured-photo',old('featured-photo')?old('featured-photo'):'','featured-photo','Featured Photo',true,'col-sm-4')?>
							
						</div>
						<div class="form-group">
							<?=form_wp_photo('banner-photo',old('banner-photo')?old('banner-photo'):"",'banner-photo','Banner Photo',false,'col-sm-4')?>
					
						</div>
				       
						<h3 class="seo-info">SEO Information</h3>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Title </label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="meta_title" value="<?=old('meta_title')?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Keywords </label>
							<div class="col-sm-9">
								<textarea class="form-control" id="focus_keyword" name="meta_keyword" style="height:100px;"><?=old('meta_keyword')?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Meta Description </label>
							<div class="col-sm-9">
								<textarea class="form-control" id="description" name="meta_description" style="height:100px;"><?=old('meta_description')?></textarea>
							</div>
						</div>
						<div class="form-group"></div>
						<div id="seo_score_box">SEO Score: <span id="seo_score">0</span></div>
						<div id="readability_score_box">Readability: <span id="readability_score">0</span></div>
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
										?><option value="<?php echo $row['lang_id']; ?>"><?php echo $row['lang_name']; ?></option><?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1" value="1">Submit</button>
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
        if (title.toLowerCase().includes(keyword.toLowerCase())) score += 10;
        if (description.toLowerCase().includes(keyword.toLowerCase())) score += 10;
        if (keywordDensity >= 1 && keywordDensity <= 3) score += 10;
        if (keywordCount >= 2) score += 10;

        return {
            score,
            keywordCount,
            keywordDensity: keywordDensity.toFixed(2)
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
        const suggestions = [];
        if (seo.score < 30) suggestions.push("⚠️ SEO chưa tối ưu. Cần thêm từ khóa vào tiêu đề, mô tả, nội dung.");
        if (readability.flesch < 60) suggestions.push("⚠️ Văn bản khó đọc. Cần viết ngắn gọn và rõ ràng hơn.");
        if (seo.keywordDensity > 4) suggestions.push("⚠️ Mật độ từ khóa quá cao.");
        return suggestions;
    }

    function updateScore() {
        const content = document.getElementById('news_content').value;
        const keyword = document.getElementById('focus_keyword').value;
        const title = document.getElementById('news_title').value;
        const description = document.getElementById('description').value;

        const seo = analyzeSEO(content, keyword, title, description);
        const readability = analyzeReadability(content);
        const suggestions = suggestImprovements(seo, readability);

        document.getElementById('seo_score').innerText = seo.score;
        document.getElementById('readability_score').innerText = readability.flesch;
        document.getElementById('input_seo_score').value = seo.score;
        document.getElementById('input_readability_score').value = readability.flesch;

        const suggestionBox = document.getElementById('seo_suggestions');
        suggestionBox.innerHTML = suggestions.map(s => `<p>${s}</p>`).join("");
    }

    ['news_content', 'news_title', 'description', 'focus_keyword'].forEach(id => {
        document.getElementById(id).addEventListener('input', updateScore);
    });

    window.addEventListener('DOMContentLoaded', updateScore);

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
