@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 CRUD Example </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employee.create') }}" title="Create an Employee"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p></p>
        </div>
    @endif
    <div class="search">
         <form action="{{ url('employee/search') }}" method="POST">
             
             @csrf
            <input type="text" name="searchbox" placeholder="Search" value="" />
            <input type="submit" value="Search" name="btnSearch">
        </form>
    </div>
    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Image</th>
            <th>Company</th>
            <th>Actions</th>
        </tr>
        @php
            $i = 0;
        @endphp
        @foreach ($employees as $employee)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $employee->firstname }}</td>
                <td>{{ $employee->lastname }}</td>
                <td>{{ $employee->username }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td><img src="data:image/jpeg;base64,{{ chunk_split(base64_encode($employee->image)) }}" width="100px"/></td>
                <td>{{ $employee->company }}</td>
                <td>
                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">

                        <a href="{{ route('employee.show', $employee->id) }}" title="show"><i class="fas fa-eye text-success  fa-lg"></i></a>

                        <a href="{{ route('employee.edit', $employee->id) }}"><i class="fas fa-edit  fa-lg"></i></a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <!--{!! $employees->links() !!}-->

@endsection
 