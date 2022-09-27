

@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div><a class="list-icons-item text-teal-600" style="float:right;margin-right:80px; margin-top:10px "  href="{{ route('teams.index') }}"><i class="icon-exit ml-2"></i> Back</a></div>
      <div class="card-body">
         <div class="modal-body">
            <form action="{{route('addteammembers.create')}}" method="post" accept-charset="utf-8" onSubmit="return gamerSelectLimit();">
               @csrf 
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Team Id : <em>*</em></label> <br>
                        <input type="text" name="team_id" id="team_id" value="{{ $id }}" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Name : <em>*</em></label> <br>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Email : <em>*</em></label> <br>
                        <input type="email" name="email" id="email" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Mobile : <em>*</em></label> <br>
                        <input type="text" name="mobile" id="mobile" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Platform : <em>*</em></label> <br>
                        <select class="form-control" name='platform_id'>
                           <option>Select Platform</option>
                           @foreach($platforms as $plat)
                           <option value="{{$plat->id}}">{{$plat->name}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>InGame Name : <em>*</em></label> <br>
                        <input type="text" name="platfromname" id="platfromname" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Player Game ID : <em>*</em></label> <br>
                        <input type="text" name="platfromnumber" id="platfromnumber" class="form-control" autocomplete="off" required="required">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <button type="submit" class="btn bg-teal-400"><i class="fas fa-save mr-1"></i> Save</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
   $('.select2').select2();
</script>
@endsection

