<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-4 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3><i class="bi bi-person-circle"></i>신규회원등록</h3>
        <hr>
        <form action=<?php echo base_url("/MemberController/saveMember")?> method="post">
          <div class="form-group">
           <label for="m_name">회원명</label>
           <input type="text" class="form-control" name="m_name" id="m_name" value="<?= set_value('m_name') ?>" required>
          </div>
          <div class="form-group">
           <label for="m_age">나이</label>
           <input type="number" class="form-control" name="m_age" id="m_age" value="<?= set_value('m_age') ?>" width="20" required>
          </div>
          <div class="form-group">
           <label for="m_mobile">연락처</label>
           <input type="text" class="form-control" name="m_mobile" id="m_mobile" value="<?= set_value('m_mobile') ?>" required>
          </div>
          <div class="form-group">
           <label for="m_email"><i class="bi bi-envelope"></i>이메일</label>
           <input type="text" class="form-control" name="m_email" id="m_email" value="<?= set_value('m_email') ?>" required>
          </div>
          <div class="row my-2 justify-content-between align-items-center">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i>저장</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
