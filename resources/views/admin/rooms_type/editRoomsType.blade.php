@extends('admin.mater')
@section('main-admin')
<div class="content-body">
    <!-- row -->
    <div class="container">
        <h1>ADD NEW ROOM TYPE</h1>
        <div class="row">
            <form action="{{route('rooms_type.update',$rooms_type)}}" method="POST">
              @method('PUT')
                @csrf
                {{-- <input type="hidden" name="id" value="{{$rooms_type->id}}"> --}}
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="room_type" value="{{$rooms_type->room_type}}">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </div>
</div>
@endsection