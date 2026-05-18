@if (session()->has('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif

@if (session()->has('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif

<form action="{{ route('login.create') }}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="email" class="form-control @error('email') is-invalid @enderror" 
               placeholder="Email" name="email" value="{{ old('email') }}">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="input-group mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror" 
               placeholder="Password" name="password">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                    Remember Me
                </label>
            </div>
        </div>
        <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        </div>
    </div>
</form>