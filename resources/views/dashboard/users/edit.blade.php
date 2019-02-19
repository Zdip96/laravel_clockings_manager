@extends('layouts.dashboard_employee')

@section('content')
    {{-- Title --}}
    <div class="text-center">
        <h3 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h3>
        <h5 class="card-subtitle font-weight-light text-muted">{{ $user_department }} Department</h5>
    </div>

    <!-- if there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::model($user, array('route' => array('panel_users_update', $id), 'method' => 'PUT')) }}
    
    {{-- Company data --}}
    <h5 class="text-muted mt-5">Company data</h5>
    <div class="form-group">
        <div class="row">
            {{-- Department--}}
            <div class="col">
                {{ Form::label('department', 'Department *', ['class' => 'control-label']) }}
                {{ Form::select('department', $departments, $user->department_id, ['id' => 'js-department', 'class' => 'custom-select', 'autofocus', 'required']) }}
            </div>
            {{-- Function--}}
            <div class="col">
                {{ Form::label('function', 'Function *', ['class' => 'control-label']) }}
                {{ Form::select('function', $functions, $user->function_id, ['id' => 'js-function', 'class' => 'custom-select', 'autofocus', 'required']) }}
            </div>
        </div>
    </div>

    {{-- Personal data --}}
    <h5 class="text-muted mt-5">Personal data</h5>
    <div class="form-group">
        <div class="row">
            {{-- First name --}}
            <div class="col">
                {{ Form::label('first_name', 'First name *', ['class' => 'control-label']) }}
                {{ Form::text('first_name', $user->first_name, ['id' => 'js-first-name', 'class' => 'form-control', 'autofocus', 'required']) }}
            </div>
            {{-- Middle name --}}
            <div class="col">
                {{ Form::label('middle_name', 'Middle name', ['class' => 'control-label']) }}
                {{ Form::text('middle_name', $user->middle_name, ['id' => 'js-middle-name', 'class' => 'form-control', 'autofocus', 'placeholder' => 'Optional']) }}
            </div>
            {{-- Last name --}}
            <div class="col">
                {{ Form::label('last_name', 'Last name *', ['class' => 'control-label']) }}
                {{ Form::text('last_name', $user->last_name, ['id' => 'js-last-name', 'class' => 'form-control', 'autofocus', 'required']) }}
            </div>
        </div>
    </div>

    {{-- Account data --}}
    <h5 class="text-muted mt-5">Account data</h5>
    <div class="form-group">
        <div class="row">
            {{-- Email --}}
            <div class="col">
                {{ Form::label('email', 'Email address *', ['class' => 'control-label']) }}
                {{ Form::email('email', $user->email, ['class' => 'js-email form-control', 'autofocus', 'required']) }}
            </div>
            {{-- Date hired--}}
            <div class="col">
                {{ Form::label('date_hired', 'Date hired', ['class' => 'control-label']) }}
                {{ Form::date('date_hired', \Carbon\Carbon::createFromFormat('Y-m-d', $user->date_hired), ['class' => 'form-control', 'required']) }}
            </div>
            {{-- Active --}}
            <div class="col-auto">
                {{ Form::label(null, 'Active user', ['class' => 'control-label']) }}
                <div class="custom-control custom-switch mt-1 mr-sm-2">
                    {{ Form::hidden('active', '0', false, ['id' => 'active', 'class' => 'custom-control-input']) }}
                    @if ($user->active === 1)
                        {{ Form::checkbox('active', '1', true, ['id' => 'active', 'class' => 'custom-control-input']) }}
                        {{ Form::label('active', 'Yes', ['class' => 'custom-control-label']) }}
                    @else
                        {{ Form::checkbox('active', '1', false, ['id' => 'active', 'class' => 'custom-control-input']) }}
                        {{ Form::label('active', 'No', ['class' => 'custom-control-label']) }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="form-group text-center mt-5">
        {{ Form::submit('Submit modifications', ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}
@endsection
