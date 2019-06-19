@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new content</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form method="post" action="{{route('content.store')}}" class="needs-validation"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" rows="3" name="description"></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="datetimepicker1">Schedule on</label>
                                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">

                                    <input name="schedule_on" type="text" class="form-control datetimepicker-input"
                                           id="datetimepicker1" data-target="#datetimepicker1"/>
                                    <div class="input-group-append" data-target="#datetimepicker1"
                                         data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" class="form-control-file  @error('image') is-invalid @enderror"
                                       id="image" name="image">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>


                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection