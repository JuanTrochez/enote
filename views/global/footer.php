        </section>
        <footer class="foot">
<!--            <div>
                <div class="faq"><a href="#">FAQ</a></div>
                <div class="faq"><a href="#">Contactez nous</a></div>
            </div>-->
        </footer>
        
        
        <script src="<?php echo $basePath ?>vendor/jquery/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $basePath ?>vendor/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>        
        <?php if (isset($_GET['page']) && $_GET['page'] == 'admin' && isset($_GET['section']) && $_GET['section'] == 'statistique') { ?>
            <script src="<?php echo $basePath ?>vendor/Chartjs/Chart.min.js"></script>            
            <script src="<?php echo $basePath ?>js/stat.js"></script>
        <?php } ?>
        <script src="<?php echo $basePath ?>js/app.js"></script>
    </body>
</html>
