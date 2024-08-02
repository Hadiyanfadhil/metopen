@extends('frontEnd.layouts.app')
@section('content')
    <section class="py-4">
        <div class="container">
            <div class="row my-5">
                <div class="col-md-6">
                    <img src="{{ asset('images/tahu-tiga-bola.png') }}" class="img-fluid" alt="Tahu Tiga Bola">
                    
                </div>
                <div class="col-md-6 d-flex flex-column justify-content-center">
                    <div class="card border-0 shadow" style="border-radius: 10px;">
                        <div class="card-header bg-transparent text-center">
                            <h3 class="mb-0 py-2">Login</h3>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('status') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email or Username</label>
                                    <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" required autocomplete="current-password">
                                        <span class="input-group-text">
                                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                                        </span>
                                    </div>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if (Route::has('password.request'))
                                <a class="text-secondary" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                                @endif
                                <div class="d-grid gap-2 mt-3">
                                    <button class="btn btn-danger text-white px-3">LOGIN</button>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <p>or login with</p>
                                    <button class="btn btn-outline-primary me-2"><i class="bi bi-google"></i> Google</button>
                                    <button class="btn btn-outline-primary"><i class="bi bi-facebook"></i> Facebook</button>
                                </div>
                                <div class="text-center mt-3">
                                    <p>Don't have an account yet? <a href="{{ route('register') }}" class="text-danger">Sign UP</a></p>
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
});
</script>
