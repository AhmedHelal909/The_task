@extends('layouts.app')
@section('title')
Category Page
@endsection
@section('content')
<div class="container">
  <h1 class="text-center mb-3">View All Categories</h1>

    <button class="btn btn-primary mb-3" data-target="#exampleModal"
     data-toggle="modal">Add Category</button>
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
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">Action</th>
           
          </tr>
        </thead>
        <tbody>
            @php
                $id=0;
            @endphp
            @foreach ( $allcategory as $cat )
                
            
          <tr id="{{$cat->id}}">
            <th scope="row">{{++$id}}</th>
            <td>{{$cat->name}}</td>
            <td>
                <button class="btn btn-info edit" id="edit" data-target="#exampleModal2" data-toggle="modal" data-route = "{{url('editcat/'.$cat->id)}}">Edit</button>

                <button class="btn btn-danger delete" data-toggle="modal" data-route="{{route('category.delete',$cat->id)}}" >Delete</button>
  </td>
        
          </tr>
          @endforeach
         
        </tbody>
      </table>
      
      
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="form-group">
                  <label for="exampleFormControlInput1">Name</label>
                  <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
                  
                  
                  
                </div>
             
                
                
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add Category</button>
            </div>
          </form>
        </div>
        
      </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('category.update')}}" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="form-group">
            <input type="hidden" id="id" class="id" name="id" >

                      <label for="exampleFormControlInput1">Name</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" name="name">
                      
                      
                      
                    </div>
                 
                    
                    
                 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Edit Category</button>
                </div>
              </form>
            </div>
            
          </div>
        </div>
  </div>
@endsection
@section('script')
<script>
     $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('button.edit').on('click',function(){
                 var route = $(this).attr('data-route');
                 console.log(route);
                 $.ajax({
                   url: route,
                   type: "get",
                   success:function(data){
                     $('input[name="name"]').val(data.name);
                     $('input[name="id"]').val(data.id);

                    
                   }
                 })
                })
                ///dekete
                $('button.delete').on('click',function(){
     var route = $(this).attr('data-route');
     console.log(route);
     $.ajax({
       type: "get",
       url:route,
       success:function(data){
           console.log(data);
                $('#'+data.id).remove();
                $('div.alert').remove();
                $('div.delete').append(`<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
          <strong>${data.message}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>`);
        
       }

     })
   })
</script>
@endsection