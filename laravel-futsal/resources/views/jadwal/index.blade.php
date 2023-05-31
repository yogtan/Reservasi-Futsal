@php
    use Carbon\Carbon;
@endphp
@extends('layouts/main')
@section('container')
  <!-- Herro Section -->
  <section class="heroSectionJadwal align-items-center" id="heroSection">
    <div class="container">
      <div class="wpo-section-title">
        <div class="row">
          <div class="col-md-12">
            <div class="wpo-section-title-left">
              <h1 class="text-red fw-bold text-GoeboexFutsal">Lapangan {{ $lapangan['nama'] }}</h1>
              <h5 class="text-white">Indoor Futsal Court</h5>
            </div>
            <div class="row d-flex justify-content-center images">
              <div class="col-lg-6 col-md-12 col-12 d-flex flex-column">
                <img src="../Img/izuddin-helmi-adnan-K5ChxJaheKI-unsplash.jpg" alt="Gambar 3" style="width: 100%;">
              </div>
              <div class="col-lg-6 col-md-12 col-12 d-flex flex-column">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-12 small_image">
                    <img src="../Img/izuddin-helmi-adnan-K5ChxJaheKI-unsplash.jpg" alt="Gambar 3" style="width: 100%;">
                  </div>
                  <div class="col-lg-6 col-md-6 col-12 small_image">
                    <img src="../Img/izuddin-helmi-adnan-K5ChxJaheKI-unsplash.jpg" alt="Gambar 3" style="width: 100%;">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="Room-details-area pb-120">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-12">
          <div class="room-description">
            <div class="room-title court-name">
              <div class="wpo-section-title-left">
                <h2>Lapangan {{ $lapangan['nama'] }}</h2>

                <hr style="margin-top: 50px;"">
              </div>
            </div>
            <div class=" court-details">
                <ul class="court-attributes">
                  <li class="operational_hours"><i class="fi ti-money"></i><strong>From Rp. {{ $lapangan['harga'] }} / Hour</strong></li>
                  <li class="operational_hours">Monday – Friday: 16:00 PM – 18:00 PM<br>Saturday - Sunday: 08:00 AM –
                    17:00 PM</li>
                </ul>
                <p class="text-white"><strong>Dimension:</strong><br>
                  Lebar : 16,8 m<br>
                  Panjang : 24,95 m<br>
                  <br>
                  <strong>Aturan Bermain:</strong>
                </p>
                <ul>
                  <li>Merokok tidak diperbolehkan di lapangan</li>
                  <li>Dilarang keras membawa makanan dan minuman dari luar di tempat</li>
                  <li>Bola disediakan</li>
                  <li>Untuk sebuah event, silakan hubungi goeboex@gmail.com</li>
                </ul>
                <p><strong>Kebijakan Booking:</strong></p>
                <ul>
                  <li>Booking secara online</li>
                  <li>Pembayaran secara offline</li>
                  <li>Booking maksimal 7 hari</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="mt-5 col-12">
            <div class="room-title court-name">
              <div class="wpo-section-title-left">
                <h2>Jadwal Lapangan</h2>
                <span>Silakan klik dan tahan waktu pemesanan yang diinginkan di kalender.</span>
                <hr>
              </div>
            </div>
          </div>
          <div class="col-12">
            @if(session()->has('sewaSuccess'))
        <div class="alert alert-success" role="alert">
            {{ session('sewaSuccess') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                @foreach ($jadwalLapangan as $jadwal)
                    <th>{{ $jadwal['dates'] }}<br>{{ $jadwal['day_name'] }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($jadwalLapangan as $index => $jadwal)
                    <td>
                        @foreach ($jadwal['jadwal'] as $waktu)
                        <form action="/menyewa" method="post">
                            @csrf
                            <input type="hidden" name="id_lapangan" value="{{ $jadwal['lapangan']->id }}">
                            <input type="hidden" name="harga_lapangan" value="{{ $jadwal['lapangan']->harga }}">
                            <input type="hidden" name="id_jadwal" value="{{ $waktu['id'] }}">
                            <input type="hidden" name="tanggal" value="{{ $jadwal['date'] }}">
                            @php
                                $isSewaExists = \App\Models\menyewa::isSewaExists($jadwal['lapangan']->id, $waktu['id'],$jadwal['date']);
                                $currentTime = Carbon::now();
                                $jadwalTime = Carbon::createFromFormat('H.i', substr($waktu['jam'], 0, 5));
                                
                            @endphp
                            @if ($jadwal['day_name'] === Carbon::now()->format('l') && $currentTime >= $jadwalTime)
                                <button class="mt-3 border-light" disabled>
                                {{ $waktu['jam'] }}
                                </button><br>
                            @else
                                <button class="mt-3 border-light" {{ $isSewaExists ? 'disabled' : '' }}>
                                    {{ $waktu['jam'] }}
                                </button><br>
                            @endif
                            </form>
                            @php
                                $isSewaExists = false;
                            @endphp
                        @endforeach
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>

          </div>
        </div>
      </div>
    </div>
    @endsection
