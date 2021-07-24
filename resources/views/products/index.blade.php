@extends('layouts.app')
@section('title')
Product Page
@endsection

@section('content')
<div class="container">
    <h1 class="text-center mb-3">View All Products</h1>
    <table class="table text-center" >
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantitiy</th>
            <th scope="col">Category</th>
            <th scope="col">Image</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="cont-data">
          @php
              $id = 0;
          @endphp
          @if (session()->has('Error'))
          <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
              <strong>{{ session()->get('Error') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif
          @if (session()->has('Add'))
          <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
              <strong>{{ session()->get('Add') }}</strong>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif
      @if (session()->has('Update'))
      <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
          <strong>{{ session()->get('Update') }}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif
<div class="delete">

</div>

  
  
  
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ( $errors -> all() as $error )
            
          
          <li>
            {{$error}}
          </li>
          @endforeach
        </ul>
      </div>
        
      @endif
          <button class="btn btn-primary mb-3" data-target="#exampleModal" data-toggle="modal">Add Product</button>
        
          @foreach ( $allproduct as $pro )
            
          
          <tr id="{{$pro->id}}">
            <th scope="row">{{++$id}}</th>
            <td>{{$pro->name}}</td>
            <td>{{$pro->price}}</td>
            <td>{{$pro->quantity}}</td>
            <td>{{$pro->category->name}}</td>
            <td>
              
              <img src="{{url('images/products/'.$pro->image)}}" alt="image" width="50" height="50">

            </td>
            <td>
              <button class="btn btn-info edit" id="edit" data-target="#exampleModal2" data-toggle="modal" data-route="{{url('edit/'.$pro->id)}}">Edit</button>
              <button class="btn btn-danger delete" data-toggle="modal" data-route="{{route('product.delete',$pro->id)}}">Delete</button>
            </td>
            
          </tr>
          @endforeach
         
         
        </tbody>
      </table>
     
      
      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
          @csrf
          @method('post')
          <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
            <label for="exampleFormControlInput1">price</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="price">
            <label for="exampleFormControlInput1">quantity</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="quantity">
            <label for="exampleFormControlSelect1">category</label>
            
            <select class="form-control" id="exampleFormControlSelect1"  name="cat_id">
              @foreach ( $allcategory as $category )
              <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
          </div>
       
          
          
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Product</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul id="errorUpdate" class="list-unstyled"></ul>
        <form method="post"  action="{{route('product.update')}}"class="edit" id="myform10" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
            <input type="hidden" id="id" class="id" name="id" >
            <label for="exampleFormControlInput1">price</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="price">
            <label for="exampleFormControlInput1">quantity</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="quantity">
            <label for="exampleFormControlSelect1">category</label>
            
            <select class="form-control"  class="selectbox" id="exampleFormControlSelect2"  name="cat_id">
              @foreach ( $allcategory as $category )
              <option value="{{$category->id}}">{{$category->name}}</option>
              @endforeach
            </select>
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
          </div>
       
          
          
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

</div>

@endsection
@section('script')
<script>
  var log = console.log;
    $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('button.edit').on('click',function(){
                 var route = $(this).attr('data-route');
                 $.ajax({
                   url: route,
                   type: "get",
                   success:function(data){
                     $('input[name="name"]').val(data.name);
                     $('input[name="id"]').val(data.id);
                     $('input[name="quantity"]').val(data.quantity);
                     $('input[name="price"]').val(data.price);
                     $('#exampleFormControlSelect2').val(data.cat_id);
                   }
                 })
                })
////////////////update
 
   ////////delete
   $('button.delete').on('click',function(){
     var route = $(this).attr('data-route');
     console.log(route);
     $.ajax({
       type: "get",
       url:route,
       success:function(data){
                $('#'+data.id).remove();
                $('div.alert').remove();
                $('div.delete').append(`<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
          <strong>${data.message}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>`);
        
       },

     })
   })       
                
</script>
@endsection
