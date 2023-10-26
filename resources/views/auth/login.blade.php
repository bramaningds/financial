<x-layout>
    <div class="d-flex align-items-center bg-body-tertiary" style="height: 100vh;">
        <div class="m-auto" style="max-width: 400px;">
            <h1 class="m-3 mt-1 text-center">AtBram</h1>
            <div class="card m-4 p-2">
                <div class="card-body">
                    <h3 class="text-center">L O G I N</h3>
    
                    @error('authentication')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
    
                    <form action="/login" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="col-12">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    autocomplete="off" value="{{ old('password') }}">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
    
                            <div class="col-6">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input"
                                    value="yes">
                                <label for="remember" class="form-check-label">Remember me</label>
                            </div>
    
                            <div class="col-6 text-end">
                                <a href="/forgot">Forgot password</a>
                            </div>
    
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</x-layout>