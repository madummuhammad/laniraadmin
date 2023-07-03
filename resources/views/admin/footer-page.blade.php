    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2023 <a href="https://adminlte.io">DND</a>.</strong>
      All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{url('assets')}}/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{url('assets')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{url('assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <!-- <script src="{{url('assets')}}/plugins/chart.js/Chart.min.js"></script> -->
  <!-- Sparkline -->
  <!-- <script src="{{url('assets')}}/plugins/sparklines/sparkline.js"></script> -->
  <!-- JQVMap -->
  <script src="{{url('assets')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="{{url('assets')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{url('assets')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="{{url('assets')}}/plugins/moment/moment.min.js"></script>
  <script src="{{url('assets')}}/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{url('assets')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="{{url('assets')}}/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="{{url('assets')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{url('assets')}}/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{url('assets')}}/dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="{{url('assets')}}/dist/js/pages/dashboard.js"></script> -->
  <!-- DataTables  & Plugins -->
  <script src="{{url('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="{{url('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="{{url('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="{{url('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="{{url('assets')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="{{url('assets')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="{{url('assets')}}/plugins/jszip/jszip.min.js"></script>
  <script src="{{url('assets')}}/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="{{url('assets')}}/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="{{url('assets')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="{{url('assets')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="{{url('assets')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{url('assets')}}/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{url('assets')}}/dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#add-row").click(function() {
        var newRow = '<tr>' +
        '<td><input type="text" class="form-control" name="size[]" required></td>' +
        '<td><input type="number" class="form-control" name="stok[]" required></td>' +
        '<td><input type="number" class="form-control" name="price[]" required></td>' +
        '</tr>';
        $("table").append(newRow);
      });
    });
  </script>
  <script type="text/javascript">
    $(function() {
      $('#row_dim').hide(); 
      $('#type_select').change(function(){
        if($('#type_select').val() == 'PO') {
          $('#row_dim').show(); 
        } else {
          $('#row_dim').hide(); 
        } 
      });
    });

    $("#collapse-sidebar").on('click',function(){
      if ($("body").hasClass('sidebar-collapse')) {
        $("body").removeClass('sidebar-collapse');
      } else {
        $("body").addClass('sidebar-collapse');
      }
    })
  </script>
</body>
</html>