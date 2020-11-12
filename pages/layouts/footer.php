    </section>
    <!-- /.content -->
  </div>
  <?php require 'includes/logic/auto.php'?>
  <footer class="main-footer main-footer1">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.3
    </div>
    <strong>Copyright &copy; 2019-2020 <a href="index.php">Thợ Việt Homecare</a>.</strong> Since 2011
  </footer>
</div>
<!-- Bootstrap 3.3.7 -->
<script src="css/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
      var myCustomScrollbar = document.querySelector('.my-custom-scrollbar');
      var ps = new PerfectScrollbar(myCustomScrollbar);
      var scrollbarY = myCustomScrollbar.querySelector('.ps__rail-y');
      myCustomScrollbar.onscroll = function () {
        scrollbarY.style.cssText = `top: ${this.scrollTop}px!important; height: 400px; right: ${-this.scrollLeft}px`;
      }
      
    </script>
</body>
</html>
