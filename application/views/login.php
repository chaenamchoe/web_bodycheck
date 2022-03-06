<script>
  function check_email(){
    let u_email = document.getElementById('u_email').value;
    if(u_email===''){
      alert('이메일주소를 입력하세요.');
      document.getElementById('#u_email').focus();
    }else{
      const encoded = encodeURI(u_email); 
      var url = '<?php echo base_url("UserController/findUser/' + encoded + '")?>';
      console.log(encoded, url);
      window.location = encodeURI(url);
    }
  }
</script>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-4 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3><i class="bi bi-person-circle"></i>사용자 로그인</h3>
        <hr>
        <form class="" action=<?php echo base_url("UserController/check_login")?> method="post">
          <div class="form-group">
           <label for="u_email"><i class="bi bi-envelope"></i>이메일</label>
           <input type="text" class="form-control" name="u_email" id="u_email" value="<?= set_value('u_email') ?>" required>
          </div>
          <div class="form-group">
           <label for="u_pass"><i class="bi bi-key"></i>비밀번호</label>
           <input type="password" class="form-control" name="u_pass" id="u_pass">
          </div>
          <div class="row my-2 justify-content-between align-items-center">
            <div class="col-12 col-sm-4 text-right">
              <a href=<?= base_url("UserController/registUser")?> class="btn btn-warning">신규등록</a>
            </div>
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> 로그인</button>
            </div>
            <div class="col-12 col-sm-4 text-right">
              <a href=<?php echo base_url("UserController/findUser")?> class="btn btn-warning">비번찾기</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
