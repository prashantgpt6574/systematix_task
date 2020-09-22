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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('companies.create') }}" class="btn btn-success">Add Company</a> &nbsp;
                    <a href="{{ route('exportCompany') }}" class="btn btn-success">Export</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Logo</th>
                                <th>Website</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($companies) > 0)
                                @foreach($companies as $key => $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>
                                            <a href="{{ asset($company->logo) }}">View</a>
                                        </td>
                                        <td>{{ $company->website }}</td>
                                        <td>
                                            <a href="{{ route('companies.edit', $company->id) }}">Edit</a> &nbsp;

                                            <form action="{{ route('companies.destroy', $company->id) }}" method="post">
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
