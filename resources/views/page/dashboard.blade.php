@extends('../layout.main')

@section('content')
{{-- BATAS --}}
<!-- Container Fluid-->
@php

@endphp
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item active" aria-current="page"><a href="/">Dashboard</a></li>
    </ol>
  </div>

  <div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total Barang Masuk (Monthly)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barangIn }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-circle-down fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total Barang Keluar (Monthly)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barangOut }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-arrow-circle-up fa-2x text-danger"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total Transaksi (Monthly)</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $transaksi }}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-shopping-cart fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Total Karyawan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- TRANSAKSI -->
    <div class="col-xl-12 col-lg-7 mb-4">
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru</h6>
          <a class="m-0 float-right btn btn-danger btn-sm" href="{{ route('table.show', ['link' => 'Transaksi']) }}">View More<i
              class="fas fa-chevron-right"></i></a>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Nama Kain</th>
                <th>Jumlah Kain</th>
                <th>Nama Kertas</th>
                <th>Jumlah Kertas</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach ($newestTransaksi as $temp)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $temp->nama_kain }}</td>
                    <td>{{ $temp->JUMLAH_KAIN }}</td>
                    <td>{{ $temp->nama_kertas }}</td>
                    <td>{{ $temp->JUMLAH_KERTAS }}</td>
                    <td>{{ $temp->TGL }}</td>
                    <td>{{ $temp->KETERANGAN }}</td>
                </tr>
                @php
                    $no++;
                @endphp
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
    <!-- TRANSAKSI -->
    <div class="col-xl-12 col-lg-7 mb-4">
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Riwayat Terbaru</h6>
          <a class="m-0 float-right btn btn-danger btn-sm" href="{{ route('table.show', ['link' => 'Riwayat']) }}">View More<i
              class="fas fa-chevron-right"></i></a>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>No</th>
                <th>Jenis Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach ($newestRiwayat as $temp)
              <tr>
                  <td>{{ $no }}</td>
                  <td>{{ $temp->JENIS_BARANG }}</td>
                  <td>{{ $temp->NAMA_BARANG }}</td>
                  <td>{{ $temp->JUMLAH_BARANG }}</td>
                  <td>
                    @if ($temp->STATUS == "Masuk")
                        <span class="badge badge-success">{{ $temp->STATUS }}</span>
                    @else
                        <span class="badge badge-danger">{{ $temp->STATUS }}</span>
                    @endif
                  </td>
              </tr>
              @php
                  $no++;
              @endphp
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
  </div>
  <!--Row-->
@endsection