<script>
  $(document).ready(function(){
    $("#myTable").DataTable({
      "language": {
            "decimal":        "",
            "emptyTable":     "표에서 사용할 수있는 데이터가 없습니다.",
            "info":           "전체: _TOTAL_건중 _START_/_END_페이지",
            "infoEmpty":      "0 개 항목 중 0 ~ 0 개 표시",
            "infoFiltered":   "(_MAX_ 총 항목에서 필터링 됨)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "페이지당/라인수: _MENU_",
            "loadingRecords": "로드 중 ...",
            "processing":     "처리 중 ...",
            "search":         "검색:",
            "zeroRecords":    "일치하는 레코드가 없습니다.",
            "paginate": {
                "first":      "처음",
                "last":       "마지막",
                "next":       "다음",
                "previous":   "이전"
            },
            "aria": {
                "sortAscending":  ": 오름차순으로 정렬",
                "sortDescending": ": 내림차순으로 정렬"
            }
      }
    });
  });
</script>
<div class="container">
    <div class="row justify-content-center mt-2">
      <div class="col text-center">
          <h2>회원리스트(<?php echo get_cookie('user_name');?>)</h2>
          <hr>
            <a href="<?= base_url() ?>MemberController/newmem" class="btn btn-primary btn-md">신규회원등록</a> 
            <span style="color:red">신규회원 등록시 이전 등록회원을 먼저 검색한 후에 등록하세요. 회원 중복 방지!!!</span>   
        </div>
    </div>
    <hr>
    <div class="row justify-content-center mt-1">
        <div class="col-md-12 text-center">
            <table id="myTable" class="table table-light table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                    <td>No</td>
                    <td>회원명</td>
                    <td>나이</td>
                    <td class="d-none d-md-table-cell">연락처</td>
                    <td class="d-none d-md-table-cell">이메일</td>
                    <td>수정/삭제</td>
                    <td>사진</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                      $sdate=date("Y-m-d");
                      $edate=date("Y-m-d");
                      foreach ($results as $row):
                        $id = $row['ID'];
                        $m_name = $row['M_NAME'];
                        $m_age = $row['M_AGE'];
                        $m_mobile = $row['M_MOBILE'];
                        $m_email = $row['M_EMAIL'];
                        $m_indate = $row['M_INDATE'];
                        $m_uid = $row['M_UID'];
                        ?>
                    <tr>
                        <td ><?=$id ?></td>
                        <td><?=$m_name ?></td>
                        <td><?=$m_age ?></td>
                        <td class="d-none d-md-table-cell"><?=$m_mobile ?></td>
                        <td class="d-none d-md-table-cell"><?=$m_email ?></td>
                        <!-- 수정/삭제 -->
                        <td><a href=<?php echo base_url("MemberController/editMember/$id")?> class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></a> 
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#myModal"><i class="bi bi-x-circle"></i></button>
                        </td>
                        <!-- 사진업로드 -->
                        <td><a href=<?php echo base_url("MemberController/memberPicture/$id/$sdate/$edate")?> class="btn btn-primary btn-sm"><i class="bi bi-upload"></i></a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <hr>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">회원삭제</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        회원자료 삭제할까요?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <a href=<?php echo base_url("MemberController/deleteMember/$id")?> type="button" class="btn btn-primary">예</a>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">아니오</button>
      </div>

    </div>
  </div>
</div>
