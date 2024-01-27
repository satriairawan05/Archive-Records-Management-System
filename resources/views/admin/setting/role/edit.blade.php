@extends('admin.layout.app')

@push('css')
    <style>
        .thead-primary {
            color: var(--dishub-color) !important;
        }
    </style>
@endpush

@section('breadcrumb')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0 justify-content-sm-start">
            <div class="welcome-text">
                <h4>{{ $name }}</h4>
            </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-sm-0 d-flex mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">{{ $name }}</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>
@endsection

@section('app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('role.update', $group->group_id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group row mt-3">
                            <div class="col-2">
                                <label for="group_name" class="col-form-label text-dark">Role Name <span
                                        class="text-danger">*</span> </label>
                            </div>
                            <div class="col-10">
                                <input type="text"
                                    class="form-control text-dark form-control-sm @error('group_name')
                                    is-invalid
                                @enderror"
                                    id="group_name" placeholder="Masukan Role Name"
                                    value="{{ old('group_name', $group->group_name) }}" name="group_name" required>
                                @error('group_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 my-3">
                                <table class="table-light table text-dark">
                                    <thead class="thead-primary">
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th class="text-center">Pages</th>
                                            <th class="text-center">Access</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($page_distincts as $d)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">{!! str_replace('_', ' ', $d->page_name) !!}</td>
                                                <td class="text-center">
                                                    @foreach ($pages as $p)
                                                        @if (str_replace('_', ' ', $p->page_name) == str_replace('_', ' ', $d->page_name))
                                                            <div class="d-inline">
                                                                <input type="checkbox" id="{!! $p->page_id !!}"
                                                                    name="{!! $p->page_id !!}" {!! $p->access == 1 ? 'checked' : '' !!}>
                                                                <label for="{!! $p->page_id !!}">
                                                                    {{ $p->action }}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{ route('role.index') }}" class="btn btn-sm btn-info mx-2"><i
                                        class="fa fa-reply-all"></i></a>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
