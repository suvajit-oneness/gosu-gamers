@extends("admin.layouts.master")
@section("content")

 <section class="content">

   @if(Session::has('msg'))
  <div class="ar-hide @if(Session::has('msg_class')){{ Session::get('msg_class') }}@endif">{{ Session::get('msg') }}</div>
  @endif
   <div class="box" style="margin-top: 10px;">
     
     <div class="box-body">
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                <label>From Date :</label>
                <input type="date" name="from_date" id="from_date" class="form-control" placeholder="Enter From Date" autocomplete="off">
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                <label>To Date :</label>
                <input type="date" name="to_date" id="to_date" class="form-control" placeholder="Enter To Date" autocomplete="off">
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-group">
                <label>User Type :</label>
                <select name="user_type" id="user_type" class="form-control">
                  <option value="0">Select User Type</option>
                  <option value="1">Individual</option>
                  <option value="2">Team</option>
                </select>
              </div>
          </div>
          <div class="col-md-2">
            <input type="button" name="submit" id="submit" value="search" class="btn btn-primary" style="margin-top: 22px;" onclick="count_user();"/>
          </div>
        </div>
        <div id="list" style="display:none;">

        </div>
     </div>
   </div>

</section>


<script type="text/javascript">
  function count_user()
  {
     var fdate = $('#from_date').val();
     var tdate = $('#to_date').val();
     var utype = $('#user_type').val();

     $.ajax({
       type: 'POST',
        url: "{{ route('count_user') }}",
    
        data: {
          "from_date" : fdate,
          "to_date" : tdate,
          "utype" : utype,
          "_token" : "{{ csrf_token() }}"
        }, 

        cache:false,
        success: function(html) {
          $('#list').show();
          $('#list').html(html);
        },
     });
  }
</script>
@endsection