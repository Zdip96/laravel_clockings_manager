@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Register') }}</div>

                <div class="card-body">
                    <!-- if there are creation errors, they will show here -->
                    {{ Html::ul($errors->all()) }}

                    {{ Form::open(array('route' => array('register'))) }}
                    
                    <h6 class="mt-4">Company data</h6>
                    <hr class="mt-0 mb-4">

                    <div class="form-group">
                        <div class="row">
                            {{-- Department--}}
                            <div class="col">
                                {{ Form::label('department', 'Department *', ['class' => 'control-label']) }}
                                {{ Form::select('department', array('0' => 'Pick a department') + $departments->toArray(), '0', ['id' => 'js-department', 'class' => 'custom-select', 'autofocus', 'required']) }}
                            </div>
                            {{-- Function--}}
                            <div class="col">
                                {{ Form::label('function', 'Function *', ['class' => 'control-label']) }}
                                {{ Form::select('function', ['0' => 'Pick a function'], '0', ['id' => 'js-function', 'class' => 'custom-select', 'autofocus', 'required']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <h6 class="mt-5">Employee name</h6>
                        <hr class="mt-0 mb-4">
                        <div class="row">
                            {{-- First name --}}
                            <div class="col">
                                {{ Form::label('first_name', 'First name *', ['class' => 'control-label']) }}
                                {{ Form::text('first_name', null, ['id' => 'js-first-name', 'class' => 'form-control', 'autofocus', 'required']) }}
                            </div>
                            {{-- Middle name --}}
                            <div class="col">
                                {{ Form::label('middle_name', 'Middle name', ['class' => 'control-label']) }}
                                {{ Form::text('middle_name', null, ['id' => 'js-middle-name', 'class' => 'form-control', 'autofocus', 'placeholder' => 'Optional']) }}
                            </div>
                            {{-- Last name --}}
                            <div class="col">
                                {{ Form::label('last_name', 'Last name *', ['class' => 'control-label']) }}
                                {{ Form::text('last_name', null, ['id' => 'js-last-name', 'class' => 'form-control', 'autofocus', 'required']) }}
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-5">Account data</h6>
                    <hr class="mt-0 mb-4">

                    <div class="form-group">
                        <div class="row">
                            {{-- Email --}}
                            <div class="col">
                                {{ Form::label('email', 'Email address *', ['class' => 'control-label']) }}
                                {{ Form::email('email', null, ['class' => 'js-email form-control', 'autofocus', 'required', 'placeholder' => 'nume@exemplu.ro']) }}
                            </div>
                            {{-- Password --}}
                            <div class="col">
                                {{ Form::label('password', 'Password *', ['class' => 'control-label']) }}
                                {{ Form::password('password', ['class' => 'form-control', 'autofocus', 'required']) }}
                            </div>
                            {{-- Password confirmation --}}
                            <div class="col">
                                {{ Form::label('password_confirmation', 'Confirm password *', ['class' => 'control-label']) }}
                                {{ Form::password('password_confirmation', ['class' => 'form-control', 'autofocus', 'required']) }}
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-5">Other</h6>
                    <hr class="mt-0 mb-4">

                    <div class="form-group">
                        <div class="row">
                            {{-- User role --}}
                            <div class="col">
                                {{ Form::label('user_role', 'User role', ['class' => 'control-label']) }}
                                {{ Form::select('user_role', array('0' => 'Pick a role') + $user_roles->toArray(), null, ['class' => 'custom-select', 'autofocus', 'required']) }}
                            </div>
                            {{-- Date hired --}}
                            <div class="col">
                                {{ Form::label('date_hired', 'Hiring date', ['class' => 'control-label']) }}
                                {{ Form::date('date_hired', \Carbon\Carbon::createFromFormat('Y-m-d', '2019-01-01'), ['class' => 'form-control', 'required']) }}
                            </div>
                            {{-- Active --}}
                            <div class="col-auto mr-3">
                                {{ Form::label(null, 'Active employee', ['class' => 'control-label']) }}
                                <div class="custom-control custom-switch mt-1 mr-sm-2">
                                    {{ Form::hidden('active', '0', false, ['id' => 'active', 'class' => 'custom-control-input']) }}
                                    {{ Form::checkbox('active', '1', true, ['id' => 'active', 'class' => 'custom-control-input']) }}
                                    {{ Form::label('active', 'Yes', ['class' => 'custom-control-label']) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-center mt-5">
                        {{ Form::submit('Register', ['class' => 'btn btn-primary']) }}
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
