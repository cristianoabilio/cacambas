

        <?php 
        	$path_front = "/front/dev"; 
            $path_packs = $path_front.'/packages'; 
            $path_libs = $path_front.'/js/libs'; 
        	$path_app = $path_front.'/app';
        ?>	

        
        <!-- build:js(.) scripts/oldieshim.js -->
        <!--[if lt IE 9]>
        <script src="<?= $path_packs; ?>/es5-shim/es5-shim.js"></script>
        <script src="<?= $path_packs; ?>/json3/lib/json3.min.js"></script>
        <![endif]-->
        <!-- endbuild -->

        <!-- build:js(.) scripts/vendor.js -->
        <!-- bower:js -->
        <?php /** Scripts para Interface (GUI) */?>
        <script src="<?= $path_packs; ?>/jquery/dist/jquery.js"></script>
        <script src="<?= $path_packs; ?>/spin.js/spin.js"></script>
        <script src="<?= $path_packs; ?>/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?= $path_packs; ?>/jQuery.mmenu/src/js/jquery.mmenu.min.js"></script>
        <script src="<?= $path_libs; ?>/jquery.clearsearch.js"></script>


        <script src="<?= $path_packs; ?>/angular/angular.js"></script>
        <script src="<?= $path_packs; ?>/json3/lib/json3.js"></script>
        <script src="<?= $path_packs; ?>/angular-resource/angular-resource.js"></script>
        <script src="<?= $path_packs; ?>/angular-cookies/angular-cookies.js"></script>
        <script src="<?= $path_packs; ?>/angular-sanitize/angular-sanitize.js"></script>
        <script src="<?= $path_packs; ?>/angular-animate/angular-animate.js"></script>
        <script src="<?= $path_packs; ?>/angular-touch/angular-touch.js"></script>
        <script src="<?= $path_packs; ?>/angular-route/angular-route.js"></script>
        <script src="<?= $path_packs; ?>/angular-route-segment/build/angular-route-segment.js"></script>
        <script src="<?= $path_packs; ?>/trNgGrid/release/trNgGrid.min.js"></script>

        <!-- endbower -->
        <!-- endbuild -->

        <!-- build:js({.tmp,app}) scripts/scripts.js -->
        <script src="<?= $path_app; ?>/app.js"></script>
        <script src="<?= $path_app; ?>/common/UIBaseService.js"></script>
        <script src="<?= $path_app; ?>/common/UIBaseController.js"></script>
        <script src="<?= $path_app; ?>/common/UIBaseDirectives.js"></script>
        <script src="<?= $path_app; ?>/common/AuthService.js"></script>
        <script src="<?= $path_app; ?>/modules/login/LoginController.js"></script>
        <script src="<?= $path_app; ?>/modules/usuarios/UsuariosController.js"></script>
        <script src="<?= $path_app; ?>/modules/cacambas/CacambasController.js"></script>


        <!-- endbuild -->
        
    </body>
</html>