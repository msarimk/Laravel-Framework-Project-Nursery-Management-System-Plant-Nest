@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Categories</h4>
    <!-- Striped Rows -->
    <div class="mb-3" >
      <a href="{{ route('addingCategories') }}" class="btn btn-success" >Add Categories</a>
  </div>
    <div class="card">
        <h5 class="card-header">All Categories</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>

                <th>Categories</th>
                <th>Sub Categories</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($categories as $key => $category)
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $key + 1 }}</strong></td>
                <td>{{$category->categories}}</td>
                <td>{{$category->sub_categories}}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="{{ route('editPageCategory',$category->id) }}"
                        ><i class="bx bx-edit-alt me-1"></i> Edit</a
                      >
                      {{-- <a class="dropdown-item" href="{{ route('deleteCategories',$category->id) }}"
                        ><i class="bx bx-trash me-1"></i> Delete</a
                      > --}}
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