@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="panel-title">
            <h3 style="float:left;margin-left:20px;margin-top:15px"> Gamer Tournaments Details </h3>
            <a class="list-icons-item text-teal-600" style="float:right;margin-right:20px; margin-top:15px "  href="{{ route('gamerstournaments.index') }}"><i class="icon-exit ml-2"></i>Back </a>
         </div>
         <div class="content">
            <div class="form-group">
               <strong class="text-uppercase">user_id :</strong>
               {{$gamerstournaments->user_id}} 
            </div>
            <div class="form-group">
               <strong class="text-uppercase">tournament_id:</strong>
               {{$gamerstournaments->tournament_id}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">room_code :</strong>
               {{$gamerstournaments->room_code}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">point :</strong>
               {{$gamerstournaments->point}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">payment_status :</strong>
               {{$gamerstournaments->payment_status}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">score :</strong>
               {{$gamerstournaments->score}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">earning :</strong>
               {{$gamerstournaments->earning}}
            </div>
            <div class="form-group">
               <strong class="text-uppercase"> currency_id  :</strong>
               {{$gamerstournaments-> currency_id }}
            </div>
            <div class="form-group">
               <strong class="text-uppercase">status :</strong>
               {{$gamerstournaments->status}}
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

