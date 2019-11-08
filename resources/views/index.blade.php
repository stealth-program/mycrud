@extends('layout')

@section('content')
    <link rel="stylesheet" href="{{asset('css/myStyle.css')}}">
    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div><br />
        @endif
            <div class="card m-2">
                <div class="row">
                    <a href="{{ route('students.create')}}" class="btn btn-primary m-2 ml-4 col-2">Register</a>
                    <div class="col-8 text-justify my-auto">
                        <h1 class="text-center my-auto">
                            <a href="{{route('students.index')}}">Students List</a>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="card m-2 p-1">
                <div class="container">
                    <div class="text-justify my-auto">
                        <form action="">
                            <div class="form-group mt-2">
                                <label for="search">
                                    <h2 class="text-left my-auto align-middle ml-1 mr-1 d-inline-block mb-0">Search</h2>
                                </label>
                                <input type="text"
                                       placeholder="File name..."
                                       name="search" id="search" class="form-control d-inline-block mb-0" style="max-width: 70%"
                                >
                                <button type="submit" class="btn btn-primary ml-2">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(isset($_GET['search']))
                <div class="card m-2">
                    <div class="row m-1">
                        <div class="col-8 text-justify my-auto">
                            <h1 class="text-center my-auto">
                                Search results for: {{$_GET['search']}}
                            </h1>
                        </div>
                    </div>
                </div>
            @endif
            <table class="table table-striped">
            <thead>
            <tr>
                <td class="{{isset($_GET['orderBy']) && $_GET['orderBy'] == 'id' ? 'click' : ''}}">
                    <a href="{{route('students.index', array_merge(
                    $_GET,['orderBy' => 'id'],
                    isset($_GET['direction']) && $_GET['direction'] == 'asc' ? ['direction' => 'desc'] : ['direction' => 'asc']))}}"
                    >ID</a>
                </td>
                <td class="{{isset($_GET['orderBy']) && $_GET['orderBy'] == 'first_name' ? 'click' : ''}}">
                    <a href="{{route('students.index', array_merge(
                    $_GET,
                    ['orderBy' => 'first_name'],
                    isset($_GET['direction']) && $_GET['direction'] == 'asc' ? ['direction' => 'desc'] : ['direction' => 'asc']))}}"
                    >First Name</a>
                </td>
                <td class="{{isset($_GET['orderBy']) && $_GET['orderBy'] == 'last_name' ? 'click' : ''}}">
                    <a href="{{route('students.index', array_merge(
                    $_GET,
                    ['orderBy' => 'last_name'],
                    isset($_GET['direction']) && $_GET['direction'] == 'asc' ? ['direction' => 'desc'] : ['direction' => 'asc']))}}"
                    >Last Name</a>
                </td>
                <td class="{{isset($_GET['orderBy']) && $_GET['orderBy'] == 'group_number' ? 'click' : ''}}">
                    <a href="{{route('students.index', array_merge(
                    $_GET,
                    ['orderBy' => 'group_number'],
                    isset($_GET['direction']) && $_GET['direction'] == 'asc' ? ['direction' => 'desc'] : ['direction' => 'asc']))}}"
                    >Group Number</a>
                </td>
                <td class="{{isset($_GET['orderBy']) && $_GET['orderBy'] == 'marks' ? 'click' : ''}}">
                    <a href="{{route('students.index', array_merge(
                    $_GET,
                    ['orderBy' => 'marks'],
                    isset($_GET['direction']) && $_GET['direction'] == 'asc' ? ['direction' => 'desc'] : ['direction' => 'asc']))}}"
                    >Marks</a>
                </td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->first_name}}</td>
                    <td>{{$student->last_name}}</td>
                    <td>{{$student->group_number}}</td>
                    <td>{{$student->marks}}</td>
                    <td><a href="{{ route('students.edit',$student->id)}}" class="btn btn-primary">Edit</a></td>
                    <td>
                        <form action="{{ route('students.destroy', $student->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="bot">
            {{ $students->appends($_GET)->links()}}

        </div>

    </div>
@endsection