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
			<?= form_open_multipart(base_url().'admin/news/edit/'.$news['news_id'],['class' => 'form-horizontal']); ?>
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">News Title <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="news_title" value="<?php echo $news['news_title']; ?>">
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
	</script>
<?= $this->endSection() ?>
