@extends('main')

@section('content')

@if(Session::has('message'))
	<p class="alert alert-success"> {{Session::get('message')}}</p>
@endif	
	
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-key fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$data['occupiedRooms']}}</div>
                                    <div>Occupied Rooms</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('admin.availability.index')}}">
                            <div class="panel-footer">
                                <span class="pull-left">more</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$data['activeBookings']}}</div>
                                    <div>Active Bookings</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('admin.booking.index')}}">
                            <div class="panel-footer">
                                <span class="pull-left">more</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-times-circle fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$data['canceledBookings']}}</div>
                                    <div>Canceled Bookings</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('admin.booking.canceled')}}">
                            <div class="panel-footer">
                                <span class="pull-left">more</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-lock fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$data['disabledRooms']}}</div>
                                    <div>Disabled Rooms</div>
                                </div>
                            </div>
                        </div>
                        <a href="{{route('admin.room_types.index')}}">
                            <div class="panel-footer">
                                <span class="pull-left">more</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            
            <div class="panel panel-default">
            	<div class="panel-heading">
                	<i class="fa fa-clock-o fa-fw"></i> Last 10 Bookings
                </div>
                <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Check In</th>
                                                    <th>Nights</th>
                                                    <th>Room</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data['lastBookings'] as $booking)
                                                <tr>
                                                	<td>{{$booking->personData->full_name or ''}}</td>
                                                	<td>{{$booking->check_in or ''}}</td>
                                                	<td>{{$booking->number_of_days or ''}}</td>
                                                	<td>{{$booking->roomType->name or ''}}</td>
                                                </tr>                                                
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                
                                
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
             </div>
             <!-- /.panel -->
             
             <div class="panel panel-default">
            	<div class="panel-heading">
                	<i class="fa fa-bar-chart-o fa-fw"></i> Bookings Per Month
                </div>
                <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
								<div id="uv-div"></div>                            
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
             </div>
             <!-- /.panel -->


@endsection

@include('admin.dashboard.partials.scripts')
@include('menu')