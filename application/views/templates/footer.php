<footer class="page-footer z-depth-3">
</footer>
</body>
<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/jquery-1.11.3.js");?>"></script>
<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/jquery-ui.min.js");?>"></script>
<!-- <script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/materialize.js");?>"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
<!--<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/main.js");?>"></script>-->
<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/script.js");?>"></script>
<?php if ($this->logged_as_admin() OR $this->logged_as_principal()) echo "<script type='text/javascript' src='".htmlspecialchars(STATICPATH."js/admin.js")."'></script>";?>
<?php if ($this->logged_as_admin()) echo "<script type='text/javascript' src='".htmlspecialchars(STATICPATH."js/evaluation.js")."'></script>";?>
<?php if ($this->logged_as_principal()) echo '<script type="text/javascript" src="'.htmlspecialchars(STATICPATH.'js/jquery.TableCSVExport.min.js').'"></script>';?>
<?php if ($this->logged_as_principal()) echo '<script type="text/javascript" src="'.htmlspecialchars(STATICPATH.'js/jquery.tablesorter.min.js').'"></script>';?>
<script type="text/javascript" src="<?php echo htmlspecialchars(STATICPATH."js/marci.js");?>"></script>

</html>
