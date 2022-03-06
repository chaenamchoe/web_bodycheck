<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
        <h2>회원명: <?php echo get_cookie('member_name') ?></h2>
        <hr>
            <form method="post" action=<?= base_url("UploadController/uploadFile") ?> enctype="multipart/form-data">
            <div class="form-group">
                <label>파일선택(다중파일 선택가능)</label>
                <input type="file" class="form-control mt-1" name="files[]" multiple/>
            </div>
            <div class="form-group col-md-6 mt-2 d-flex flex-row">
                <input class="form-control btn btn-primary" type="submit" name="fileSubmit" value="업로드">
                <a href="javascript:history.back()" class="form-control btn btn-warning btn-md mx-2">뒤로가기</a>
            </div>
        </form>
        </div>
    </div>
    <hr>
    <!-- Display uploaded images -->
    <div class="row justify-content-center mt-2 mx-auto">
        <div class="col-md-12 justify-content-center">
                <?php if(!empty($results2)){ 
                    foreach($results2 as $file){ 
                        $user_id = get_cookie('user_id');
                        $img_name = $file['IMG_NAME'];   
                    ?>
                        <!-- <p><?php echo date("Y-m-d",strtotime($file['PIC_DATE'])); ?></p> -->
                        <img src=<?php echo base_url("public/upload/$user_id/$img_name") ?> width="100px" class="img-fluid">
                <?php } }else{ ?>
                <p>File(s) not found...</p>
                <?php } ?>
        </div>
    </div>
</div>