@extends('layouts.dashboard_employee')

@section('content')
    {{-- Title --}}
    <div class="text-center">
        <h3 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h3>
        <h5 class="card-subtitle font-weight-light text-muted">{{ $user_department }} Department</h5>
    </div>

    {{-- User details --}}
    <div class="row my-5">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Role</h5>
                    <p class="card-text">{{ $user_role }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Department</h5>
                    <p class="card-text">{{ $user_department }}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Function</h5>
                    <p class="card-text">{{ $user_function }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
