@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('employees.index') }}">Employee</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('companies.index') }}">Company</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <a href="{{ route('employees.create') }}" class="btn btn-success">Add Employee</a> &nbsp;
                    <a href="{{ route('exportEmployee') }}" class="btn btn-success">Export</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($employees) > 0)
                                @foreach($employees as $key => $employee)
                                    <tr>
                                        <td>{{ $employee->first_name }}</td>
                                        <td>{{ $employee->last_name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->company->name }}</td>
                                        <td>
                                            <a href="{{ route('employees.edit', $employee->id) }}">Edit</a> &nbsp;
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit">Delete</button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
