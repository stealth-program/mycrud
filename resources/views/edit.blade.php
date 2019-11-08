@extends('layout')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Edit Student
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('students.update', $student->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{$student->first_name}}"/>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{$student->last_name}}"/>
                </div>
                <div class="form-group">
                    <label for="group">Group Number:</label>
                    <input type="text" class="form-control" name="group_number" id="group" value="{{$student->group_number}}"/>
                </div>
                <div class="form-group">
                    <label for="marks">Marks:</label>
                    <input type="text" class="form-control" name="marks" id="marks" value="{{$student->marks}}"/>
                </div>
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="{{ route('students.index')}}" class="btn btn-secondary m-2 ml-4">Back</a>
            </form>
        </div>
    </div>
@endsection