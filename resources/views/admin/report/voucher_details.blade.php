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
                @if($voucher)
                <a href="{{URL::to('report/voucher_detail/'.request()->get("from_date").'/'.request()->get('to_date').'/'.'export')}}" class="btn bg-teal-400 text-uppercase"> Export </a> 
               @endif  
            </div>        
      </div>
      </form>
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Voucher Redeemed Details</h5>
         @php @endphp
      </div>
      <div class="row justify-content-center">
         <div class="col-8">
            <div class="table-responsive">
               @if($voucher)
             <table  class="table table-striped datatable-responsive">
                <thead>
                   <tr class="bg-teal-400">
                      <th width="3%">SL No</th>
                      <th>points</th>
                      <th>Total Data</th>
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
                 @foreach ($voucher as $vc => $count) 
                 <tr>
                    @if($count->points)
                     @if($count->points == -500 || $count->points == -1500 || $count->points == -1000 || $count->points == -750)
                    <td>{{$slno}}</td>
                    <td>{{$count->points}}</td>
                    <td>{{$count->count}}</td>
                    @endif
                    @endif
                 </tr>
                <?php $slno = $slno + 1; ?>    
                @endforeach                           
                </tbody>
             </table>
              {{-- {{ $registration->links() }} --}}
                @endif 
             <div>
            </div>
          </div>
         </div>
      </div>
   </div>
</div>



@endsection



