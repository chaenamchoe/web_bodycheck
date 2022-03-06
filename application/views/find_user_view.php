<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-4 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3><i class="bi bi-person-circle"></i>사용자 로그인</h3>
        <hr>
        <form class="" action=<?php echo base_url("UserController/sendEmail")?> method="post">
          <div class="form-group">
           <label for="u_email"><i class="bi bi-envelope"></i>이메일</label>
           <input type="text" class="form-control" name="u_email" id="u_email" value="<?= set_value('u_email') ?>" required>
          </div>
          <div class="row my-2 justify-content-between align-items-center">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> 확인 </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
