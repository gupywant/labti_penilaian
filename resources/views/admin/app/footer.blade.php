  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright 2020 Gupy Wantoro.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0-pre
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ URL::asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('admin/dist/js/adminlte.js') }}"></script>
@if(!empty($p))
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#nilai').DataTable({
		    	dom: 'Bfrtip',
		        buttons: [
		            {
					    extend: 'excelHtml5',
					    title: "List Nilai @if(!empty($p)){{$p->kelas}}-{{$p->nama_praktikum}}@endif",
					    text: 'Excel',
					    exportOptions: {
					        stripNewlines: true
					    }
					}
		        ],
		        order: [],
		    });
		} );
	</script>
@endif
@if(!empty($urut))
	<script type="text/javascript">
		$(document).ready( function () {
		    $('#nilai').DataTable({
		    	dom: 'Bfrtip',
		        buttons: [
		            {
					    extend: 'excelHtml5',
					    title: "List Nilai Convert",
					    text: 'Download Excel',
					    exportOptions: {
					        stripNewlines: true
					    }
					}
		        ],
		        order: [],
		    });
		    $('#nilaiasli').DataTable({
		    	dom: 'Bfrtip',
		        buttons: [
		            {
					    extend: 'excelHtml5',
					    title: "List Nilai Asli",
					    text: 'Download Excel',
					    exportOptions: {
					        stripNewlines: true
					    }
					}
		        ],
		        order: [],
		    });
		} );
	</script>
@endif

</body>
</html>