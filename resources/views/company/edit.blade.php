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
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif

                    <form action="{{route('companies.update', $company->id)}}" method="post" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="email">Name:</label>
                            <input type="text" class="form-control" id="email" name="name" value="{{ $company->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Website:</label>
                            <input type="text" class="form-control" id="email" name="website" value="{{ $company->website }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Logo:</label>
                            <input type="file" class="form-control" id="email" name="logo">
                            <img src="{{ asset($company->logo) }}" width="100" height="100">
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
