<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 25px;
}
.switch input {display:none;}
.slider {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: #ccc;
  transition: .4s;
  border-radius: 25px;
}
.slider:before {
  position: absolute;
  content: "";
  height: 19px;
  width: 19px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .4s;
  border-radius: 50%;
}
input:checked + .slider {
  background-color: #28a745;
}
input:checked + .slider:before {
  transform: translateX(25px);
}
</style>
<section class="content-header">
	<div class="content-header-left">
    	<h1><?=$title?></h1>
	</div>
	<div class="content-header-right">
	<a href="<?= base_url('admin/shop/manage/product') ?>" class="btn btn-primary mb-3">View All</a>
    
    </div>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">

       <?=flash_message()?>
       <?php echo form_open_multipart(base_url("admin/shop/add/product"),array('class' => 'form-horizontal')); ?>
			<div class="box box-info">
				<div class="box-body">
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Product title <span>*</span></label>
						<div class="col-sm-6">
							<input type="text" autocomplete="off" class="form-control" name="product_title" value="<?=old('product_title'); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Short Description <span></span></label>
						<div class="col-sm-6">
							<textarea autocomplete="off" class="form-control editor" name="product_short_description" ><?=old('product_short_description'); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Description <span></span></label>
						<div class="col-sm-6">
							<textarea autocomplete="off" class="form-control editor" name="product_long_description" ><?=old('product_long_description'); ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<?=form_wp_photo('product_image',old('product_image')??"",'product_image','Image',true,'col-sm-4')?>
						
					</div>

					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Product price <span>*</span></label>
						<div class="col-sm-6">
							<input 	type="text"  
									data-error-id="price-error"
									data-field-name="Price" 
									autocomplete="off" 
									class="form-control number" 
									id="price" name="product_price" 
									value="<?=old('product_price'); ?>">
							<small id="price-error" style="color: red;"></small>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">Product Quantity <span>*</span></label>
						<div class="col-sm-6">
							<input type="text" data-error-id="quantity-error"
											data-field-name="Quantity"
											 autocomplete="off" class="form-control number" id="quantity" name="product_quantity" value="<?=old('product_quantity'); ?>">
							<small id="quantity-error" style="color: red;"></small>
						</div>
					</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Product Slug <span></span></label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="product_slug" value="<?=old('product_slug'); ?>">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Product Keyword <span></span></label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="product_keyword" value="<?=old('product_keyword'); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="publication_status" class="col-sm-2 control-label">Hiển thị</label>
							<div class="col-sm-6">
								<label class="switch">
								<input type="checkbox" id="publication_status" name="publication_status" value="1" <?= old('publication_status') ? 'checked' : '' ?>>
								<span class="slider"></span>
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button value="1" type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
       
    </div>
  </div>          

</section>
<script>
	function formatPrice(input) {
		let value = input.value.replace(/\./g, ''); // Bỏ dấu . cũ
		if (!isNaN(value)) {
			input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}
	}
	function validateNumberInput(input) {
		const errorId = input.dataset.errorId;
		const fieldName = input.dataset.fieldName || 'Value';
		const errorEl = errorId ? document.getElementById(errorId) : null;

		let value = input.value.replace(/\./g, '');

		if (!/^\d*$/.test(value)) {
			input.classList.add('is-invalid');
			if (errorEl) errorEl.textContent = `${fieldName} must be a positive number`;
		} else {
			input.classList.remove('is-invalid');
			if (errorEl) errorEl.textContent = '';
			input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}
	}
	window.addEventListener('DOMContentLoaded', function () {
		const priceInput = document.getElementById('price');
		if (priceInput.value !== '') {
			formatPrice(priceInput);
		}
		const quantityInput = document.getElementById('quantity');
		if (quantityInput.value !== '') {
			formatPrice(quantityInput);
		}
		document.querySelectorAll("input.number").forEach(function (input) {
			input.addEventListener("input", function () {
				validateNumberInput(input);
			});
		});
	});
</script>
<?= $this->endSection() ?>
