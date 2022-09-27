<!DOCTYPE html>
<html lang="en">
   {{--include styles--}}
   @include("admin.layouts.styles")
   <body>
      {{--include header--}}
      @include("admin.layouts.header")
      <!-- Page content -->
      <div class="page-content">
         {{--include left-sidebar--}}
         @include("admin.layouts.left-sidebar")
         <!-- Main content -->
         <div class="content-wrapper">
            {{--include left-sidebar--}}
            @include("admin.layouts.page-header")
            @section("content")
            @show
            {{--include left-sidebar--}}
            @include("admin.layouts.footer")
         </div>
         <!-- /main content -->
      </div>
      <!-- /page content -->
         {{--include sweetalert--}}
      @include('sweetalert::alert')
      <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
      @yield('page-script')
   </body>
</html>

