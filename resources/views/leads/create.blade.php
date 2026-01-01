@extends('layouts.app')

@section('title', 'Create Lead')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow-sm">
            <div class="card-header" style="background-color: #ff6666; color: #fff;">
                <h5 class="mb-0 text-center">
                    Lead Entry Form
                </h5>
            </div>

            <div class="card-body">

                {{-- GLOBAL VALIDATION ERRORS --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('leads.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone *</label>
                        <input
                            type="text"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone') }}"
                        >
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Enquiry For</label>
                        <input
                            type="text"
                            name="enquiry_for"
                            class="form-control @error('enquiry_for') is-invalid @enderror"
                            value="{{ old('enquiry_for') }}"
                        >
                        @error('enquiry_for')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea
                            name="address"
                            class="form-control @error('address') is-invalid @enderror"
                        >{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lead Type *</label>
                        <select
                            name="lead_type"
                            class="form-select @error('lead_type') is-invalid @enderror"
                        >
                            <option value="">Select</option>
                            <option value="Hot" {{ old('lead_type') == 'Hot' ? 'selected' : '' }}>Hot</option>
                            <option value="Warm" {{ old('lead_type') == 'Warm' ? 'selected' : '' }}>Warm</option>
                            <option value="Cold" {{ old('lead_type') == 'Cold' ? 'selected' : '' }}>Cold</option>
                        </select>
                        @error('lead_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <select
                            name="status"
                            class="form-select @error('status') is-invalid @enderror"
                        >
                            <option value="">Select</option>
                            <option value="New" {{ old('status') == 'New' ? 'selected' : '' }}>New</option>
                            <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Closed" {{ old('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lead Given Date *</label>
                        <input
                            type="date"
                            name="lead_given_date"
                            class="form-control @error('lead_given_date') is-invalid @enderror"
                            value="{{ old('lead_given_date') }}"
                            min="{{ date('Y-m-d') }}"
                        >
                        @error('lead_given_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Assigned User (Optional)</label>
                        <select
                            name="assigned_user"
                            class="form-select @error('assigned_user') is-invalid @enderror"
                        >
                            <option value="">Select</option>
                            <option value="CRE" {{ old('assigned_user') == 'CRE' ? 'selected' : '' }}>CRE</option>
                            <option value="DSE" {{ old('assigned_user') == 'DSE' ? 'selected' : '' }}>DSE</option>
                        </select>
                        @error('assigned_user')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary px-5">
                            Save Lead
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>


@endsection
