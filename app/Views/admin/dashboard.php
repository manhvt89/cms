<?= $this->extend('admin/layouts/admin') ?>
<?= $this->section('content') ?>

<section class="content-header">
  <h1>Dashboard</h1>
</section>

<section class="content">
  <div class="row">

    <!-- Bắt đầu vòng lặp hoặc từng info-box -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-folder"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total News Categories</span>
          <span class="info-box-number"><?= esc($total_category) ?></span>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-newspaper-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total News</span>
          <span class="info-box-number"><?= esc($total_news) ?></span>
        </div>
      </div>
    </div>

    <!-- Các khối tiếp theo tương tự -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Events</span>
          <span class="info-box-number"><?= esc($total_event) ?></span>
        </div>
      </div>
    </div>

    <!-- Tiếp tục với các item khác như team_member, client, service, testimonial, photo, pricing -->
    <!-- ... -->
    
  </div>
</section>

<?= $this->endSection() ?>
