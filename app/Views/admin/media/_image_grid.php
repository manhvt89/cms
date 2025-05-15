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