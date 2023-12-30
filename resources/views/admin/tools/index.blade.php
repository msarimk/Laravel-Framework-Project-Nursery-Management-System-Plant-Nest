@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Tools</h4>
    <!-- Striped Rows -->
    <div class="mb-3" >
        <a href="{{route('addingTools')}}" class="btn btn-success" >Add Tools</a>
    </div>
    <div class="card">
        <h5 class="card-header">All Plants</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($tools as $tool)
              <tr>
                <td>{{$tool->name}}</td>
                <td>{{$tool->description}}</td>
                <td>{{$tool->price}}</td>
                <td><img width="50" src="{{asset($tool->image)}}" alt=""></td>
                <td>{{$tool->categories->categories}}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      
                      <a class="dropdown-item" href="{{route('deleteTools',$tool->id)}}"
                        ><i class="bx bx-trash me-1"></i> Delete</a
                      >
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach      
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Striped Rows -->
</div>
@endsection