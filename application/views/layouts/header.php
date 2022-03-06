<!DOCTYPE html>
<html lang="kr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url()?>/public/css/style.css">
    <link rel="stylesheet" href="<?= base_url()?>/public/css/lightbox.min.css">
    <link rel="stylesheet" href="<?= base_url()?>/public/DataTables/DataTables-1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title></title>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <?php if(get_cookie('user_id') > 0){ ?>
          <a class="navbar-brand" href="<?= base_url('MemberController/index') ?>">BodyCheck</a>
        <?php } else { ?>
          <a class="navbar-brand" href="<?= base_url('UserController/login') ?>">BodyCheck</a>
        <?php } ?>  
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <?php if (1==1): ?>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link"  href="<?= base_url('/MemberController/index') ?>">회원관리</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="<?= base_url('/UploadController/index') ?>">업로드</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="<?= base_url('/DrawController/draw') ?>">분석</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="<?= base_url('/DrawController/draw2') ?>">분석2</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="<?= base_url('/DrawController/draw_arrow') ?>">화살표</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="<?= base_url('/DrawController/compareImage') ?>">비교</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="<?= base_url('/DrawController/postureView') ?>">자세사진</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/profile">Profile</a>
          </li>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/UserController/logout') ?>">Logout</a>
          </li>
        </ul>
      <?php else: ?>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register">Register</a>
          </li>
        </ul>
        <?php endif; ?>
      </div>
      </div>
    </nav>
