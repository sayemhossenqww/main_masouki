<div class="card shadow-sm mb-3">
    <div class="card-body">
        <h5 class="card-title">Profile Information</h5>
        <h6 class="card-subtitle mb-2 text-muted">
            Update your account profile information and email address.
        </h6>
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name*</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') ? old('name') : $user->name }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email') ? old('email') : $user->email }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <button class="btn btn-primary px-4">Save</button>

        </form>
    </div>
</div>
