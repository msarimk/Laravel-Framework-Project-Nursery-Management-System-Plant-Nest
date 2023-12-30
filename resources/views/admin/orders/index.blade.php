@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> Orders</h4>
    <!-- Striped Rows -->
    <div class="card">
        <h5 class="card-header">All Orders</h5>
        <div class="table-responsive text-nowrap">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Plants</th>
                <th>Quantity</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                {{-- <th>Actions</th> --}}
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach ($orders as $key => $item)
              <tr>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $key + 1 }}</strong></td>
                <td>{{$item->users->name}}</td>
                <td>{{$item->plants->name}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->order_date}}</td>
                <td>{{$item->total_amount}}</td>
                @if($item->is_delivered == 1)
                  <td>Delivered</td>
                @else
                  <td>Pending</td>
                @endif
                {{-- <td>
                  <div class="dropdown">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-edit-alt me-1"></i> Edit</a
                      >
                      <a class="dropdown-item" href="javascript:void(0);"
                        ><i class="bx bx-trash me-1"></i> Delete</a
                      >
                    </div>
                  </div>
                </td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Striped Rows -->
</div>
@endsection
