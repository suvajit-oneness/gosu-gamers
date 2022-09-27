@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">     
      <div class="card-body">
      <h5 class="card-title">Gamer Position</h5>
         <form method="post" action="{{route('positionsindiv.store')}}" enctype="multipart/form-data">
            @csrf
            <fieldset class="mb-3">
                  <div class="row">                  
                     @for ($i = 1; $i <= 10; $i++)
                     <div class="col-md-3">
                        <td width="15%" class="text-right border-right text-uppercase">{{$i}} Position *</td>
                        <td colspan="3">
                           <select class='form-control select2'  name='gamer_id[]'>
                           <option value="">--Select Team --</option>
                              @if($players)
                              @foreach($players as $index => $gamer)
                              <option value="{{ $gamer->user_id }}">{{ ucfirst($gamer->fname) }}  {{ ucfirst($gamer->lname) }}</option>
                              @endforeach
                              @endif
                           </select>
                        </td>
                        </div>
                        @endfor
                        </div>
                    <input type='hidden' value="{{$tournament->id}}" name='tournament_id'>    
            </fieldset>
            <div class="text-left">
               <div class="header-elements">
                  <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<div class="content">
   <div class="card">     
      <div class="card-body">
      <h5 class="card-title">Team Position</h5>
      <div class="table-responsive">
         <table id="example1" class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th width="3%">Tournament Name</th>
                  <th width="3%">1st Position</th>
                  <th width="3%">Player Name </th>
                  <th width="3%">Email</th>
                  <th width="3%">Mobile</th>
                  <th width="3%">Action</th>                     
               </tr>
            </thead>
            <tbody>
               <?php $slno = 1; ?>
               @if($position)
               @foreach($position as $data)
               <tr>
                  <td>{{$slno}}</td>
                  <td> {{$data->tournaments}}</td>
                  <td> {{$data->fname}} </td>
                  <td> {{$data->fname}} {{$data->lname}} </td>
                  <td> {{$data->email}}</td>
                  <td> {{$data->mobile}}</td>
                 <td> </td>
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
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>
<script>
$(document).ready(function(){  
  $("select").change(function() {   
    $("select").not(this).find("option[value="+ $(this).val() + "]").attr('disabled', true);
  }); 
}); 
</script>
@endsection