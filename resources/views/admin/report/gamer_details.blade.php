@extends("admin.layouts.master")
@section("content")
<?php
$page = (isset($_GET['page']) && $_GET['page']!='')?$_GET['page']:0; 
?>
<div class="content">
   <div class="card">
       <form action="">
      <div class="card-header header-elements-inline">         
            <div class="col-md-12">
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
              <div class="col-md-4">
                <div class="form-group">
                  <button type="submit" class="btn bg-teal-400"> Search</button>
                   </div>               
               </div>
                @if($gamer)
                <a href="{{URL::to('report/gamer_detail/'.request()->get("from_date").'/'.request()->get('to_date').'/'.'export')}}" class="btn bg-teal-400 text-uppercase"> Export </a> 
               @endif  
            </div>        
      </div>
      </form>
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Gamer Details</h5>
         @php @endphp
      </div>
      <div class="table-responsive">
           @if($gamer)
         <table  class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th>Name</th>
                  <!-- <th>Image</th> -->
                  <th>Email</th>
                  <th>Mobile </th>
                  <th>User Type</th>
                  <th>Creation Date</th>
              </tr>
            </thead>
            <tbody>
               <?php
               if($page!=0){
                   $slno = (($page-1)*100)+1;
               }else{
                   $slno = 1;
               }
               
               ?>
             
               @foreach($gamer as $data)
               <tr>
                  <td>{{$slno}}</td>
                  <td> {{$data->fname}} {{$data->lname}}</td>
                  <!-- <td><img src="{{URL::asset($data->image)}}" style="width:50px; height:50px; float:left; 
                     border-radius:50%; margin-right:25px;"></td> -->
                  <td> {{$data->email}}</td>
                  <td> {{$data->mobile}}</td>
                  <td>
                     <?php
                     if($data->gamer_type==1){
                        echo "Gamer";
                     }else{
                        echo "Team Captain";
                     }
                     ?>
                  </td>
                  <td>{{date("d-M-Y h:i a",strtotime($data->created_at))}}</td>

               </tr>
               <?php $slno = $slno + 1; ?>    
               @endforeach                           
            </tbody>
         </table>
          {{ $gamer->links() }}
            @endif 
         <div>
        </div>
      </div>
   </div>
</div>



@endsection



