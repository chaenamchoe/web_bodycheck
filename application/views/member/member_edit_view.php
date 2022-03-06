<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-4 mt-5 pt-3 pb-3 bg-white from-wrapper">
      <div class="container">
        <h3><i class="bi bi-person-circle"></i>회원수정</h3>
        <hr>
        <?php 
            $id = $results->ID;
            $m_name = $results->M_NAME;
            $m_age = $results->M_AGE;
            $m_mobile = $results->M_MOBILE;
            $m_email = $results->M_EMAIL;
            $m_uid = $results->M_UID;
          ?>
        <form action=<?php echo base_url("/MemberController/updateMember/$id")?> method="post">
          <div class="form-group">
           <label for="m_name">회원명</label>
           <input type="text" class="form-control" name="m_name" id="m_name" value="<?= $m_name ?>" required>
          </div>
          <div class="form-group">
           <label for="m_age">나이</label>
           <input type="number" class="form-control" name="m_age" id="m_age" value="<?= $m_age ?>" width="20" required>
          </div>
          <div class="form-group">
           <label for="m_mobile">연락처</label>
           <input type="text" class="form-control" name="m_mobile" id="m_mobile" value="<?= $m_mobile ?>" required>
          </div>
          <div class="form-group">
           <label for="m_email"><i class="bi bi-envelope"></i>이메일</label>
           <input type="text" class="form-control" name="m_email" id="m_email" value="<?= $m_email ?>" required>
          </div>
          <div class="row my-2 justify-content-between align-items-center">
            <div class="col-12">
              <button type="submit" class="btn btn-primary"><i class="bi bi-box-arrow-in-right"></i> 저장</button>
              <a href=<?php echo base_url("/MemberController/memList")?> type="submit" class="btn btn-danger"><i class="bi bi-x-square"></i> 취소</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
