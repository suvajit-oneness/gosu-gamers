@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
       <form action="">
      <div class="card-header header-elements-inline">
         
            <div class="col-md-12">
               <div class="col-md-6">
                  <input type="text" class="form-control" name="transaction" placeholder="Search">
                  From Date <input type="date" class="form-control" name="from_date" placeholder="From Date">
                  To Date   <input type="date" class="form-control" name="to_date" placeholder="To Date">
               </div>
               <div class="col-md-3">
                  <button type="submit" class="btn bg-teal-400"> Search</button>
               </div>
            </div>        
      </div>
      </form>
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Transactions  List </h5>
         <div class="header-elements">
         <div class="list-icons">
               <a href="{{route('transactions.gamer')}}" class="btn bg-teal-400 text-uppercase">Gamer Transactions </a>
               <a href="{{route('transactions.team')}}" class="btn bg-teal-400 text-uppercase">Team Transactions </a>
            </div>
        </div>
      </div>
      <div class="table-responsive">
        <table id="example1" class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th>Tournament Name</th>
                  <th>Date</th>
                  <th>Team or Gamer Name</th>
                  <th>Transaction id</th>
                  <th>Amount</th>
                  <th>Currency</th>
                  <th>Gamer Type</th>
               </tr>
            </thead>
            <tbody>
               <?php $slno = 1; ?>
               @if($gamers)
               @foreach($gamers as $data)
               <tr>
                  <td>{{$slno}}</td>
                  <td> {{$data->tournaments}}</td>
                  <td>{{ date('F d, Y', strtotime($data->created_at)) }}</td>
                  <td>{{$data->name}}</td>
                  <td> {{$data->transaction_id}}</td>
                  <td> {{$data->amount}}</td>
                  <td> {{$data->cname}}</td>
                  <td> 
                  @if($data->gamer_type == 2)
                      Team
                   @else
                      Individual
                   @endif  
                  </td>                  
               </tr>
               <?php $slno = $slno + 1; ?>    
               @endforeach
               @endif
            </tbody>
         </table>
         <div>
         </div>
      </div>
   </div>
</div>
@endsection

