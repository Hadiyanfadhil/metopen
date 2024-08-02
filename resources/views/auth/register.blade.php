@extends('frontEnd.layouts.app')
@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row my-5">
                <div class="col-md-6">
                    <img src="{{ asset('images/group-12.svg') }}" class="img-fluid" alt="Group 12">
                    <div class="mt-4 text-center">
                       
                    </div>
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="card border-0 shadow" style="border-radius: 10px;">
                        <div class="card-header bg-transparent text-center">
                            <h3 class="mb-0 py-2">Register</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" required autocomplete="new-password">
                                        <span class="input-group-text">
                                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
                                        <span class="input-group-text">
                                            <i class="bi bi-eye-slash" id="togglePasswordConfirmation"></i>
                                        </span>
                                    </div>
                                    @error('password_confirmation')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-grid gap-2">
                                    <button class="btn btn-danger btn-block" type="submit">REGISTER</button>
                                </div>

                                <div class="text-center mt-3">
                                    <p>Or login with</p>
                                    <button class="btn btn-outline-primary me-2"><i class="bi bi-google"></i> Google</button>
                                    <button class="btn btn-outline-primary"><i class="bi bi-facebook"></i> Facebook</button>
                                </div>

                                <div class="text-center mt-3">
                                    <p>Already have an account? <a href="{{ route('login') }}" class="text-danger">Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
/* Style adjustments */
.card {
    border-radius: 10px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.card-header {
    background-color: transparent;
}

.form-control {
    border: 1px solid #ced4da;
    border-radius: 30px;
    padding: 15px;
}

.btn-danger {
    background-color: #e3342f;
    color: white;
    border-radius: 30px;
    padding: 10px;
}

.btn-outline-primary {
    border-radius: 30px;
}

.input-group-text {
    border: none;
    background-color: transparent;
}

.bi-eye-slash, .bi-eye {
    cursor: pointer;
}

/* Additional styling */
.text-center {
    text-align: center;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    
    togglePassword.addEventListener('click', function(e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('bi-eye');
    });

    const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
    const passwordConfirmation = document.getElementById('password_confirmation');
    
    togglePasswordConfirmation.addEventListener('click', function(e) {
        const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmation.setAttribute('type', type);
        this.classList.toggle('bi-eye');
    });
});
</script>
