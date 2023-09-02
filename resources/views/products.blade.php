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
            <a class="btn btn-success"href="{{route('products.create')}}">Add product</a>
            <table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>name</th>
      <th>description</th>
      <th>price</th>
      <th>brand</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
    <tr>
      <th > {{$loop->iteration}}</th>
      <td>{{$product->name}}</td>
      <td>{{$product->description}}</td>
      <td>{{$product->price}}</td>
      <td>{{$product->brands_id}}</td>
      <td>
        <a class="btn btn-primary" href="{{route('products.edit', $product->id)}}">Edit
          </a>
        </td>
        
      
      <td>
        <form method="post" action="{{route('products.destroy',$product->id)}}">
        @csrf
        @method('delete')
      <input type="submit" value="Delete" class="btn btn-danger" >
      </form>
    </td>
    </tr>
    @endforeach
    
  </tbody>
</table>
        </div>
    </div>
</div>
@endsection