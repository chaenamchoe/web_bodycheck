<div class="container">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3>사용자 등록</h3>
        <hr>
        <form class="" action="<?= base_url()?>/UserController/saveUser" method="post">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="u_name">사용자명</label>
               <input type="text" class="form-control" name="u_name" id="u_name" value="<?= set_value('u_name') ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
               <label for="u_email">이메일</label>
               <input type="text" class="form-control" name="u_email" id="u_email" value="<?= set_value('u_email') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
               <label for="u_pass">비밀번호</label>
               <input type="password" class="form-control" name="u_pass" id="u_pass" value="">
             </div>
           </div>
           <div class="col-12 col-sm-6">
             <div class="form-group">
              <label for="password_confirm">비밀번호확인</label>
              <input type="password" class="form-control" name="password_confirm" id="password_confirm" value="">
            </div>
          </div>
          <?php if (isset($validation)): ?>
            <div class="col-12">
              <div class="alert alert-danger" role="alert">
                <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
          </div>

          <div class="row mt-2">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary">등록</button>
            </div>
            <div class="col-12 col-sm-8 text-right">
              <a href="/">이미 등록했으면 로그인</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
