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

                    <form action="{{route('employees.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="email">Fiirst Name:</label>
                            <input type="text" class="form-control" id="email" name="first_name" value="{{ old('first_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Last Name:</label>
                            <input type="text" class="form-control" id="email" name="last_name" value="{{ old('last_name') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Phone:</label>
                            <input type="text" class="form-control" id="email" name="phone" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Company:</label>
                            <select class="form-control" name="company_id">
                                <option disabled="true" selected="true"><- Select comapny -></option>
                                @if(count($companies) > 0)
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
