@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Users</h4>
    <!-- Striped Rows -->
    <div class="card">
        <h5 class="card-header">All Users</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Phone</th>
                {{-- <th>Users</th> --}}
                {{-- <th>Status</th> --}}
                <th>Email</th>
                <th>Joining Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($users as $user)
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$user->name}}</strong></td>
                <td>{{$user->phone}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->joining_date}}</td>
                {{-- <td>
                  <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                    <li
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up"
                      title="Lilian Fuller"
                    >
                      <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up"
                      title="Sophia Wilkerson"
                    >
                      <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                    </li>
                    <li
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="top"
                      class="avatar avatar-xs pull-up"
                      title="Christina Parker"
                    >
                      <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                    </li>
                  </ul>
                </td> --}}
                {{-- <td><span class="badge bg-label-primary me-1">Active</span></td> --}}
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      {{-- <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-edit-alt me-1"></i> Edit</a
                      > --}}
                      <a class="dropdown-item"href="{{route('deleteUsers',$user->id)}}"
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
