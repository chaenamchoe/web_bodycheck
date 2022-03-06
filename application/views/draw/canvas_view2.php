<script src="<?= base_url()?>/public/js/fabric.min.js"></script>
<!-- <link href="<?= base_url()?>/public/css/draw.css" type="text/css" rel="stylesheet"/> -->
<!-- <link href="<?= base_url()?>/public/css/draw.css" type="text/css" rel="stylesheet"/> -->
<div class="container">
    <div class="text-center mt-1">
        <h2 class="text-light">Bodycheck Canvas</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-2 g-2 text-end">
            <div class="my-2"><button onClick="drawQuadratic()" type="button" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></button></div>
        </div>
        <div class="col-md-4">
            <canvas id="canvas" style="width: 100%; height=700px"></canvas>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>
<script src="<?= base_url()?>/public/js/line_curv.js"></script>
<!-- <script src="<?= base_url()?>/public/js/ccn_draw.js"></script> -->
