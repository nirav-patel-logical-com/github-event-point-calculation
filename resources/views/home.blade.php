@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Github Event Score Calculation</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->all())
                        <div class="alert alert-danger left-icon-alert" role="alert">
                            <strong>Oh snap!</strong>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <!-- Start Form -->

                        <form class="form-horizontal" name="score_calculation" method="POST" action="{{route('event_score')}}" id="score_calculation">
                            <fieldset>
                                <!-- Text input Enter Name-->
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <input id="name" name="name" type="text" placeholder="Enter Your Name" class="form-control input-md">
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <!-- Submit Button -->

                                <div class="form-group">
                                    <div class="col-md-4">
                                        <button id="submit_btn" name="submit_btn" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>


                                @if(session()->has('point'))
                                    @php($total = 0)
                                    <ul>
                                    @foreach(session()->get('point') as $key =>$value)
                                            @php($total += $value)
                                        <li>{{$key}} : {{$value}} </li>
                                    @endforeach
                                    </ul>

                                    <h5>Total Points :  {{$total}}</h5>
                                @endif


                            </fieldset>
                        </form>

                    <!-- End Form -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
