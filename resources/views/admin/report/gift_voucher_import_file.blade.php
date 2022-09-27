@extends("admin.layouts.master")
@section("content")
<?php
$page = (isset($_GET['page']) && $_GET['page']!='')?$_GET['page']:0; 
?>
<div class="content">
   <div class="card">
        <div class="card-body">
            <h2 class="mb-3">
                Gift Voucher Import Excel & CSV File
            </h2>
            <form action="{{ route('report.voucher-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="custom-file text-left">
                                <input type="file" name="file" class="form-control-file" id="customFile">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <button class="btn bg-teal-400">Import</button>
                </div>
            </form>
        </div>
   </div>
</div>



@endsection



