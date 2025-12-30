@extends('layouts.app')

@section('title', 'Create Lead')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <center> Lead Entry Form </center>
                </h5>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('leads.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone *</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Enquiry For</label>
                        <input type="text" name="enquiry_for" class="form-control" value="{{ old('enquiry_for') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lead Type *</label>
                        <select name="lead_type" class="form-select" required>
                            <option value="">Select</option>
                            <option value="Hot">Hot</option>
                            <option value="Warm">Warm</option>
                            <option value="Cold">Cold</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            <option value="">Select</option>
                            <option value="New">New</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Closed">Closed</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lead Given Date *</label>

                        <input
                            type="date"
                            name="lead_given_date"
                            class="form-control"
                            min="{{ date('Y-m-d') }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Assigned User (Optional)</label>
                        <select name="assigned_user" class="form-select">
                            <option value="">Select</option>
                            <option value="CRE">CRE</option>
                            <option value="DSE">DSE</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary">
                            Save Lead
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection