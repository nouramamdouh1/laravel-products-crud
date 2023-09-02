@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @elseif(session('error'))
                 <div class="alert alert-danger">
                    {{session('error')}}
                 </div>
            
            @endif
        <form method="post" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data">
            @csrf
            @method('put')
  <div class="mb-3">
    <h2 class="text-center my-3">Product</h2>
    <label for="exampleInputEmail1" class="form-label"> Name</label>
    <input type="string" name="name" class="form-control" id="exampleInputname" aria-describedby="nameHelp" value="{{$product->name}}">
    @error('name')
    <div class="text-danger ">{{$message}}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="exampleInputdescription" class="form-label">Description</label>
    <input type="text" name="description" class="form-control" id="exampleInputdescription"  value="{{$product->description}}">
    @error('description')
    <div class="text-danger ">{{$message}}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="exampleInputprice" class="form-label">Price</label>
    <input type="number" name="price" class="form-control" id="exampleInputprice" value="{{$product->price}}">
    @error('price')
    <div class="text-danger ">{{$message}}</div>
    @enderror
  </div>

<h6>Brand</h6>
  <select name="brands_id" class="form-select mb-3" aria-label="Default select example">
    @foreach($brands as $brand)
  <option @selected ($product->brands_id==$brand->id) value="{{$brand->id}}"> {{$brand->name}}</option>
  @endforeach
</select>


<div class="mb-3">
    <label for="file" class="form-label">
        Image <br>
    <img style="width:100px;height:100px" src="{{ asset('images/products/'.$product->image) }}" id="image"  alt="Preview Image" >
    </label>
    <input type="file"  name="image" class="d-none " onchange='loadfile(event)' id="file" >
   
    <div>        
  </div>
    @error('image')
    <div class="text-danger ">{{$message}}</div>
    @enderror
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
function loadfile(event) {
  var output = document.getElementById('image');
 output.src=URL.createObjectURL(event.target.files[0]);
    output.onload=function(){
        URL.revokeObjectURL(output.src);
        document.getElementById('image').classList.remove('d-none');
    } 
 }
</script>
@endsection