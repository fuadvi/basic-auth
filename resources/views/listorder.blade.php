@extends('template')

@section('konten')
    <table class="table table-bordered table-stripped">
        <thead>
            <th>No</th>
            <th>Tanggal</th>
            <th>Product</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Costumer</th>
        </thead>
        <tbody>

        </tbody>
    </table>

  <script src="{{ url('asset/listorder.js') }}"></script>
@endsection
