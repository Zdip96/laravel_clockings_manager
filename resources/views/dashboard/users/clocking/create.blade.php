@extends('layouts.dashboard_employee')

@section('content')
    <style>
    /* Date range picker */
    .datepicker__container .daterangepicker::before,
    .datepicker__container .daterangepicker::after,
    .drp-calendar.right { display: none !important; }
    .prev.available, .next.available { visibility: hidden; }
    /* .datepicker__container { height:316px; width:245px; margin:0 auto; } */
    .datepicker__container .daterangepicker { position:relative !important; top:auto !important; left:auto !important; min-width:100%; }
    .drp-calendar.left { min-width:100%; margin:0; padding:0 !important; }
    .calendar-table { padding:0 !important; }
    /* .datepicker__container { height: 318px; }s */
    /* .datepicker__container .daterangepicker .drp-calendar { box-sizing: border-box; width:50%; max-width:50%; } */
    .datepicker__input { width:340px; }
    </style>
                    
    {{-- Title --}}
    <div class="text-center">
        <h3 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h3>
        <h5 class="card-subtitle font-weight-light text-muted">{{ $user_department }} Department</h5>
    </div>

    <!-- If there are creation errors, they will show here -->
    {{ Html::ul($errors->all()) }}

    {{ Form::open(array('route' => array('panel_users_clockings_store', $id))) }}
    
        {{-- User --}}
        {{-- {{ Form::label('user', 'User *', ['class' => 'control-label']) }} --}}
        {{ Form::hidden('user', $id, ['id' => 'js-user', 'class' => 'form-control', 'required']) }}
        {{-- User role --}}
        {{-- {{ Form::label('department', 'User role *', ['class' => 'control-label']) }} --}}
        {{ Form::hidden('user_role', $user_role_id, ['id' => 'js-user_role', 'class' => 'form-control', 'required']) }}
        {{-- Department --}}
        {{-- {{ Form::label('department', 'Department *', ['class' => 'control-label']) }} --}}
        {{ Form::hidden('department', $user_department_id, ['id' => 'js-department', 'class' => 'form-control', 'required']) }}
        {{-- Function --}}
        {{-- {{ Form::label('function', 'Function *', ['class' => 'control-label']) }} --}}
        {{ Form::hidden('function', $user_function_id, ['id' => 'js-function', 'class' => 'form-control', 'required']) }}

        <h5 class="mt-5">Clocking date</h5>
        <hr class="mt-0 mb-4">
        
        <div class="form-group">
            <div class="row">
                <div class="col">
                    {{-- Clocking type --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {{ Form::label('clocking_type', 'Type *', ['class' => 'control-label']) }}
                                {{ Form::select('clocking_type', ['0' => 'Pick the clocking type'] + $clocking_types->toArray(), '', ['id' => 'js-department', 'class' => 'custom-select', 'autofocus', 'required']) }}
                            </div>
                        </div>
                    </div>

                    {{-- Clocking date/period --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {{ Form::label('clocking_date', 'Clocking date/period *', ['class' => 'control-label']) }}
                                {{ Form::text('clocking_date', '', ['class' => 'js-datepicker__input datepicker__input form-control']) }}
                            </div>
                        </div>
                    </div>

                    {{-- Clocking hours --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                {{ Form::label('clocking_hours', 'Hours *', ['class' => 'control-label']) }}
                                {{ Form::number('clocking_hours', '8', ['min' => '0', 'max' => '12', 'class' => 'js-clocking-hours form-control', 'required']) }}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Clocking date/period --}}
                <div class="col">
                    <div class="datepicker">
                        <div class="js-datepicker__container datepicker__container"></div>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="mt-5">Other</h5>
        <hr class="mt-0 mb-4">
        
        <div class="form-group">
            <div class="row">
                {{-- Clocking presence --}}
                <div class="col">
                    {{ Form::label(null, 'Is present', ['class' => 'control-label']) }}
                    <div class="custom-control custom-switch mt-1 mr-sm-2">
                        {{ Form::hidden('clocking_presence', '0', false, ['id' => 'clocking_presence', 'class' => 'custom-control-input']) }}
                        {{ Form::checkbox('clocking_presence', '1', true, ['id' => 'clocking_presence', 'class' => 'custom-control-input']) }}
                        {{ Form::label('clocking_presence', 'Yes', ['class' => 'custom-control-label']) }}
                    </div>
                </div>

                {{-- Clocking overtime --}}
                <div class="col">
                    {{ Form::label(null, 'Overtime', ['class' => 'control-label']) }}
                    <div class="custom-control custom-switch mt-1 mr-sm-2">
                        {{ Form::hidden('clocking_overtime', '0', false, ['id' => 'clocking_overtime', 'class' => 'custom-control-input']) }}
                        {{ Form::checkbox('clocking_overtime', '1', false, ['id' => 'clocking_overtime', 'class' => 'js-clocking-overtime custom-control-input', 'disabled']) }}
                        {{ Form::label('clocking_overtime', 'Yes', ['class' => 'custom-control-label']) }}
                    </div>
                </div>

                {{-- Clocking weekend --}}
                <div class="col">
                    {{ Form::label(null, 'Weekend', ['class' => 'control-label']) }}
                    <div class="custom-control custom-switch mt-1 mr-sm-2">
                        {{ Form::hidden('clocking_weekend', '0', false, ['id' => 'clocking_weekend', 'class' => 'custom-control-input']) }}
                        {{ Form::checkbox('clocking_weekend', '1', false, ['id' => 'clocking_weekend', 'class' => 'js-clocking-weekend custom-control-input', 'disabled']) }}
                        {{ Form::label('clocking_weekend', 'Yes', ['class' => 'custom-control-label']) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group text-center mt-5">
            {{ Form::submit('Add clocking/s', ['class' => 'btn btn-primary']) }}
        </div>

    {{ Form::close() }}

    <br />
    @include('dashboard.users.clocking.index', ['clockings' => $clockings])

    
    {{-- Calendar script --}}
    <script type="text/javascript">
        let picker = $('.js-datepicker__input').daterangepicker({
        parentEl: ".js-datepicker__container",
        isInvalidDate: function(date) {
            let start = moment().startOf('month').format('YYYY-MM-DD');
            let end = moment().endOf('month').format('YYYY-MM-DD')
            
            if (date >= moment(start) && date <= moment(end) && date.weekday() !== 0) {
                return false;
            } else {
                return true; 
            }
        },
        alwaysShowCalendars: true,
        applyButtonClasses: "btn-primary",
        locale: {
            format: 'YYYY-MM-DD',
            separator: " / ",
            firstDay: 1
        },
        maxSpan: {
            "days": 30
        }
        });
        // range update listener
        picker.on('apply.daterangepicker', function(ev, picker) {
            let startDate = picker.startDate.format('YYYY-MM-DD');
            let endDate = picker.endDate.format('YYYY-MM-DD');

            // Set the new date range value
            $('.js-datepicker__input').val(`${startDate} / ${endDate}`);
            console.log(`${startDate} / ${endDate}`);

            let start = moment(startDate);
            let end = moment(endDate);

            // Create array of dates in the range
            var dates = [];
            while (end >= start || start === end) {
                if(end.weekday() !== 0 && start.weekday() !== 0) {
                    dates.push(start.format('YYYY-MM-DD'));
                }
                start.add(1, 'day');
            }

            for(let date of dates) {
                let start = $('.start-date').text();
                let end = $('.end-date').text();

                // Check if not a singular day
                if(start !== end) {
                    // Get weekend day td
                    $('.calendar-table').filter(function() {
                        $(this).find('td.start-date.weekend.available, td.in-range.weekend.available').each(function() {
                            $(this).removeClass('in-range active');

                            // Modify start date
                            if($(this).hasClass('start-date')) {
                                $(this).removeClass('start-date');
                                $(this).closest('tr').next().children('.available').first().addClass('start-date active');
                            }
                            
                            // Modify end date
                            if($(this).hasClass('end-date')) {
                                $(this).removeClass('end-date');
                                $(this).prev().addClass('end-date active');
                            }

                            // Set weekend switch back to false
                            $('.js-clocking-weekend').attr('checked', false);
                        })

                        // Change the value of the new start and end dates
                        if($('.start-date').text() === moment(date).format('D')) {
                            startDate = date;
                        }

                        if($('.end-date').text() === moment(date).format('D')) {
                            endDate = date;
                        }
                        // Update the input with the new values
                        $('.js-datepicker__input').val(`${startDate} / ${endDate}`);
                    });
                }
            }
            
            // Callback
            checkWeekend(startDate, endDate);
        });
        // prevent hide after range selection
        picker.data('daterangepicker').hide = function () {};
        // show picker on load
        picker.data('daterangepicker').show();

        
        // 2. Hours clocked trigger overtime switch/checkbox
        let clockingHours = $('.js-clocking-hours').val();
        console.log(clockingHours);

        $('.js-clocking-hours').change(() => {
            let clockingHours = $('.js-clocking-hours').val();
            if (clockingHours > 8) {
                $('.js-clocking-overtime').attr('checked', true);
            } else {
                $('.js-clocking-overtime').attr('checked', false);
            }
        });
        
        // 2. Clocked date triggers weekend switch/checkbox
        function checkWeekend(dateStart, dateEnd) {
            if(dateStart == dateEnd) {
            // If date is saturday, then it triggers the weekend switch
                if(moment(dateStart).weekday() === 6) {
                    $('.js-clocking-weekend').attr('checked', true);
                } else {
                    $('.js-clocking-weekend').attr('checked', false);
                }
            }
            
        }

        $('.js-datepicker__input').on('input', function() {
            let clockingWeekend = $('.js-datepicker__input').val();
            // alert(clockingWeekend);
            // if (clockingWeekend >= '2019-02-02') {
            // } else {
            // }
        });

        // 3. Prevent overtime checking if selected hours are less than 9
        $('.js-clocking-overtime').on('switchChange.bootstrapSwitch', () => {
                console.log('checked');
                console.log('not');
        });
    </script>
@endsection