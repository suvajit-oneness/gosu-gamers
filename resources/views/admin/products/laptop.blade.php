@extends("admin.layouts.master")
@section("content")
<div class="content">
   <div class="card">
      <div class="card-header header-elements-inline">
         <h5 class="card-title">Product Details</h5>
         <div class="header-elements">
            @can('Product-Create')
            <div class="list-icons">
               <a href="{{route('product.create')}}" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i>Add Product <i class="mi-add-box"></i></a>
            </div>
            @endcan
            <div class="list-icons mx-2">
               <a href="{{route('product.laptop-export')}}" class="btn bg-teal-400 text-uppercase"><i class="fas fa-plus mr-1"></i>Export<i class="mi-add-box"></i></a>
            </div>
         </div>
         
      </div>
      <div class="table-responsive">
         <table id="example1" class="table table-striped datatable-responsive">
            <thead>
               <tr class="bg-teal-400">
                  <th width="3%">SL No</th>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>System Space</th>
                  <th>Button Click Count</th>
                  <th>View Count</th>
                  @can('Product-Edit')
                  <th>Action</th>
                  @endcan
               </tr>
            </thead>
            <tbody>
               @php $slno = 1; @endphp
               @if($product)
                  @foreach($product as $data)
                     <tr>
                        <td>{{$slno}}</td>
                        <td><img src="{{URL::asset($data->image)}}" style="width:100px; height:100px; float:left; 
                           border-radius:10%; margin-right:25px;"></td>
                        <td> {{$data->title}}</td>
                        @php
                        $productCategoryData = \App\Models\product_category::findOrFail($data->product_category);
                        @endphp
                           <td>{{$productCategoryData->name}}</td>
                        <td>
                        {{$data->product_space}}
                        </td>
                        <td> {{$data->click_count}}</td>
                        <td> {{$data->view_counter}}</td>
                        <td>
                           <div class="list-icons">
                           <a href="{{$data->product_link}}" class="badge badge-primary">Link</a>
                           @can('Product-Edit')
                           @if($data->is_active == 0)
                           <a class="badge bg-danger" href="{{ URL::to('product/change-status/'.$data->id) }}">Inactive</a>
                           @else
                           <a class="badge bg-success" href="{{ URL::to('product/change-status/'.$data->id) }}">Active</a>
                           @endif  @endcan
                              @can('product-Read')
                              <a class="badge bg-secondary" href="{{route('product.show',$data->id)}}">Show</a>
                              @endcan
                              @can('Product-Edit')
                              <a class="badge bg-primary"href="{{ route('product.edit',$data->id) }}">Edit</a> 
                              @endcan
                              @can('product-Delete')
                              <a href="#" data-toggle="modal" data-target="#confirm-delete{{$data->id}}" class="badge bg-danger">Delete</a>
                           </div>
                           <div class="modal fade" id="confirm-delete{{$data->id}}" role="dialog" style="text-align: left;">
                              <div class="modal-dialog" style="width: 35%;">
                                 <!-- Modal content-->
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                       <h4 class="modal-title">Confirm Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                       <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                                       <p>Do you want to proceed?</p>
                                    </div>
                                    <div class="modal-footer">
                                       {!! Form::open(['method' => 'delete','route' => ['product.destroy', $data->id],'style'=>'display:inline']) !!}
                                       {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-fill btn-sm']) !!}
                                       <button type="button" class="btn btn-default btn-fill btn-sm" data-dismiss="modal">Cancel</button>
                                       {!! Form::close() !!}
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endcan
                        </td>
                     </tr>
                     @php $slno = $slno + 1; @endphp
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