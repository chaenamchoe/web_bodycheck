<div class="container">
    <div class="row justify-content-center mt-2">
        <div class="text-center">
            <h2 class="text-dark fw-bold">Bodycheck Before/After</h2>
        </div>
    </div>
    <div id="compareWin" class="border border-2 mt-2">
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/before-after-slider@1.0.0/dist/slider.bundle.js"></script>
<script>
    window.onload = function() {
      new SliderBar({
        el: "#compareWin",
        beforeImg: 'http://localhost/bodycheck/public/images/1.jpeg',
        afterImg: 'http://localhost/bodycheck/public/images/2.jpeg',
        width: "90%",
        height: "80vh",
        line: true
      });
    }
</script>