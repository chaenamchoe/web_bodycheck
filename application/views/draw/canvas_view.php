<script src="<?= base_url()?>/public/js/fabric.min.js"></script>
<!-- <link href="<?= base_url()?>/public/css/draw.css" type="text/css" rel="stylesheet"/> -->
<link href="<?= base_url()?>/public/css/draw.css" type="text/css" rel="stylesheet"/>
<div class="container">
    <div class="text-center mt-1">
        <h2 class="text-light">Bodycheck Canvas</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-2 g-2 text-end">
            <div class="my-2"><button id="selectBtn" type="button" class="btn btn-primary btn-sm"><i class="bi bi-hand-index"></i></button></div>
            <div class="my-2"><button id="lineBtn" type="button" class="btn btn-primary btn-sm"><i class="bi bi-slash-lg"></i></button></div>
            <div class="my-2"><button onClick="draw_free()" type="button" class="btn btn-primary btn-sm"><i class="bi bi-pencil"></i></button></div>
            <div class="my-2"><button onClick="draw_text()" type="button" class="btn btn-primary btn-sm"><i class="bi bi-type"></i></button></div>
            <div class="my-2"><button onClick="clear_select()" type="button" class="btn btn-primary btn-sm"><i class="bi bi-ui-checks"></i></button></div>
            <div class="my-2"><button onClick="clear_all()" type="button" class="btn btn-primary btn-sm"><i class="bi bi-trash"></i></button></div>
            <div><button onClick="change_color('FF0000')" class="btn btn-danger color_button"></button></div>
            <div><button onClick="change_color('0000FF')" class="btn btn-primary color_button"></button></div>
            <div><button onClick="change_color('008000')" class="btn btn-success color_button"></button></div>
            <div><button onClick="change_color('FFFF00')" class="btn btn-warning color_button"></button></div>
            <div><button onClick="change_color('000000')" class="btn btn-dark color_button"></button></div>
        </div>
        <div class="col-md-4">
            <canvas id="canvas" style="width: 600px; height=800px"></canvas>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>
<script src="<?= base_url()?>/public/js/line2.js"></script>
<!-- <script src="<?= base_url()?>/public/js/ccn_draw.js"></script> -->
