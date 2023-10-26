<x-layout>
    <div class="d-flex align-items-center bg-body-tertiary" style="height: 100vh;">
        <div class="m-auto" style="max-width: 400px;">
            <h1 class="m-3 mt-1 text-center">AtBram</h1>
            <div class="card m-4 p-2">
                <div class="card-body">
                    <form action="/register" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <h3 class="text-center">Register</h3>
                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label" for="name">Username</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ old('username') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    autocomplete="off" value="{{ old('password') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="password_confirmation">Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" autocomplete="off" value="">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Register</button>
                                <a href="/" role="button" class="btn btn-outline-primary w-100 mt-2">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
