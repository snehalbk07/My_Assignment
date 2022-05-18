@extends('layouts.app')
@section('css')
  <link rel="stylesheet" href="{{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }} ">
  <link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }} ">
  <link rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }} ">

@endsection

@if(Session::has('flash_message'))
  <input type="hidden"  class="toastrDefaultSuccess" value="{{ Session::get('flash_message') }}">
@endif

@if(Session::has('delete_message'))
  <input type="hidden"  class="toastrDefaultError" value="{{ Session::get('delete_message') }}">
@endif


@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header" style="border-bottom: 0px;">
              <div class="box-header" style="float: right;">
                <a href="{{ route('user_add') }}" class="btn btn-success pull-right">Add </a>
              </div>
            </div>
            <div class="card-body">
              <table id="user_table" class="table table-bordered table-hover">
                <thead>

                  <tr>
                    <th>Sr no</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>

                </thead>
                <tbody>
                </tbody>

                <tfoot>
                  <tr>
                    <th>Sr no</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </tfoot>

              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

@section('js')
  <script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
  <!-- DataTables  & Plugins -->
  <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js') }} "></script>
  <script src="{{ URL::asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <script src="{{ URL::asset('dist/js/adminlte.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ URL::asset('plugins/toastr/toastr.min.js') }}"></script>

  <script>
    $(document).ready(function () {
      var table = $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("users") !!}',
        lengthMenu: [[10, 15, 30, 50],[10, 15, 30, 50]],
        responsive: {
          details: true
        },
        orderCellsTop: true,
        fixedHeader: true,

        "columns": [{
            data: 'DT_RowIndex',
            orderable: true,
            searchable: false
          },
          {data: 'name'},
          {data: 'edit',orderable: false},
        ],

      });
      // Setup - add a text input to each header cell
      $('#example thead tr:eq(1) th').each(function (i) {
        if (i != 0 && i != 6) {
          var title = $('#example thead tr:eq(0) th').eq($(this).index()).text();
          $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        }
      });

      // Apply the search
      table.columns().every(function (index) {
        $('#example thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
          table.column($(this).parent().index() + ':visible')
            .search(this.value)
            .draw();
        });
      });

      window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 4000);
    });
  </script>

  <script>
    $(document).ready(function(){
      var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });


    $('.toastrDefaultSuccess').click(function() {
      toastr.success($(this).val())
    }).trigger('click');

    $('.toastrDefaultError').click(function() {
      toastr.error($(this).val())
    }).trigger('click');

    

    });
  </script>
@endsection