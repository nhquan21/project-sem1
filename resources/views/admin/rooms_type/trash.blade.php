@extends('admin.mater')
@section('main-admin')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap">
            <div class="card-action coin-tabs mb-2">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#AllRooms">All Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#ActiveEmployee">Active Employee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#InactiveEmployee">Inactive Employee</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center mb-2"> 
                <a href="{{route('rooms_type.create')}}" class="btn btn-secondary">+ New Employee</a>
                <div class="newest ms-3">
                    <select class="default-select">
                        <option>Newest</option>
                        <option>Oldest</option>
                    </select>
                </div>	
            </div>
        </div>
        <div class="row mt-4">
            @if ($message = Session::get('success'))
              <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    <strong>{{ $message }}</strong>
                </div>
              </div>
            @endif
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="tab-content">	
                            <div class="tab-pane fade active show" id="AllRooms">
                                <div class="table-responsive">
                                    <table class="table card-table display mb-4 shadow-hover table-responsive-lg" id="guestTable-all3">
                                        <thead>
                                            <tr>
                                                <th class="bg-none">
                                                    <div class="form-check style-1">
                                                      <input class="form-check-input" type="checkbox" value="" id="checkAll3">
                                                    </div>
                                                </th>
                                                <th>STT</th>
                                                <th>Room Name</th>
                                                <th class="bg-none"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deleted_at as $item)   
                                                <tr>
                                                    <td>
                                                        <div class="form-check style-1">
                                                            <input class="form-check-input" type="checkbox" value="" id="checkAll3">
                                                          </div>
                                                    </td>
                                                    <td>
                                                        {{$loop->iteration}}
                                                    </td>
                                                    <td class="">
                                                        <span class="fs-16 font-w500 text-nowrap">{{$item->room_type}}</span>
                                                    </td>

                                                    <td>
                                                        <a class=" btn btn-info pr-2" href="{{route('rooms_type.restore',$item->id)}}"><i class="fa-solid fa-trash-can-arrow-up"></i></i></a>                                                
                                                        <a class=" btn btn-danger pr-2" href="{{route('rooms_type.forceDeleted',$item->id)}}"><i class="fa-solid fa-trash"></i></i></a>                                                                                                       
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>	
                            </div>	
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection