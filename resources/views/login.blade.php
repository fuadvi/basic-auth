@extends('template')

@section('konten')
  <div class="container-fluid col-md-3">
    <div class="row mt-5">
        <div class="card">
            <div class="card-body">
                <p class="card-text text-center">Masukan Ke sistem</p>

                <div class="mb-3">
                    <label for="email" class="form-label">Masukan Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" aria-describedby="helpId">
                    <small id="helpId" class="text-mute">Email</small>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Masukan password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="password" aria-describedby="helpPass">
                    <small id="helpPass" class="text-mute">password</small>
                </div>
                <button id="btn-login" class="btn btn-sm btn-info float-end">Login</button>
            </div>
        </div>
    </div>
  </div>

  <script src="{{ url('asset/login.js') }}"></script>
@endsection
