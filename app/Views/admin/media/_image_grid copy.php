<?php foreach ($files as $img): 
  $_sSrc = str_replace(ROOTPATH . 'public', '', $img);
?>
  <div class="image-item">
    <img src="<?= base_url($_sSrc) ?>" data-src="<?= base_url($_sSrc) ?>" onclick="selectImage(this)">
  </div>
<?php endforeach; ?>