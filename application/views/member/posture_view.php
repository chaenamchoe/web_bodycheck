<style>
#gallery{
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    grid-template-rows: auto;
    grid-auto-rows: minmax(100px, auto);
    grid-gap: 5px;
}
img{
    width: 100%;
    height: 100%;
    padding: 0 5 5 5;
    object-fit: contain;
}
</style>
<script>
    function reload_member_picture(memID){
        let sdate = document.getElementById('startDate').value;
        let edate = document.getElementById('endDate').value;
        // alert(sdate);
        window.location = '<?php echo base_url("MemberController/memberPicture/' + memID + '/' + sdate + '/' + edate + '")?>';
    };
    function delete_image(id){
        let sdate = document.getElementById('startDate').value;
        let edate = document.getElementById('endDate').value;
        // alert('<?php echo base_url("MemberController/deletePicture/' + id + '/' + sdate + '/' + edate + '")?>');
        //alert(id);
        if(confirm("정말 삭제할까요?"))
        {
            window.location = '<?php echo base_url("MemberController/deletePicture/' + id + '/' + sdate + '/' + edate + '")?>';
        }
    }
</script>
<div class="container">
    <div class="row justify-content-center mt-2">
        <div class="text-center">
            <h2 class="text-dark fw-bold">회원자세사진(<?php echo $mem_info->M_NAME ?>)</h2>
        </div>
    </div>
    <?php 
        // $member_id = get_cookie('member_id');
        $user_id = get_cookie('user_id'); 
    ?>
    <div class="row justify-content-center">
        <div class="text-center d-flex gap-2">
            <div class="col-sm-6 d-flex">
                <div><input id="startDate" class="form-control" type="date" value="<?php echo date($sdate)?>"/></div>&nbsp;
                <div><input id="endDate" class="form-control" type="date" value="<?php echo date($edate)?>"/></div>&nbsp;
                <a href="#" onclick="reload_member_picture(<?=$member_id ?>)" class="btn btn-primary btn-md">확인</a>
            </div>
            <div class="col-sm-6">
                <a href=<?php echo base_url("MemberController/index")?> class="btn btn-success btn-md">회원관리</a>
                <a href=<?php echo base_url("MemberController/uploadImages")?> class="btn btn-primary btn-md">사진추가</a>
                <!-- <a href="#" class="btn btn-danger btn-md">사진삭제</a> -->
            </div>
        </div>
    </div>
    <hr>
    <div class="row justify-content-center mt-2">
        <div class="col mx-auto" id="gallery">
            <?php
            foreach ($pic_info as $row):
                $img_id = $row['ID'];
                $pic_date = $row['PIC_DATE'];
                $img_name = $row['IMG_NAME'];    
            ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span><?php echo substr($pic_date, 0, 10);?></span>
                    <span><a class="btn-close" aria-label="Close" onclick="delete_image(<?=$img_id?>)"></a></span>
                    <!-- <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#myModal"></button> -->
                </div>
                <div class="card-body">
                    <a href=<?php echo base_url("/public/upload/$user_id/$img_name")?> data-lightbox="gallery">
                    <img src=<?php echo base_url("/public/upload/$user_id/$img_name")?> class="img-fluid img-thumbnail mx-auto d-block"></a>
                </div>
            </div>
            <?php endforeach; ?>    
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">사진삭제</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        사진자료 삭제할까요?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <a onclick="delete_image(<?=$img_id?>)" type="button" class="btn btn-primary">예<?=$img_id?></a>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">아니오</button>
      </div>

    </div>
  </div>
</div>
