<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Cek Ongkir</title>
</head>

<body>

    <div class="container">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Cek Ongkir</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-12 mt-3  d-flex justify-content-center">
            <div class="card" style="width: 48rem;">
                <div class="card-header">Cek Ongkir</div>
                <div class="card-body">
                    <form class="row g-3" method="get" action="{{ url('/') }}">
                        @csrf
                        <div class="col-12">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Anda" autofocus>
                        </div>
                        <div class="col-md-6">
                            <label for="dari" class="form-label">Kirim Dari</label>
                            <select id="dari" class="form-select" name="kirim_dari">
                                <option selected>Pilih Provinsi</option>
                                @foreach ($provinsi as $item)
                                    <option value="{{ $item->id }}">{{ $item->province }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="ke" class="form-label">Kirim Ke</label>
                            <select id="dari" class="form-select" name="kirim_ke">
                                <option selected>Pilih Provinsi</option>
                                @foreach ($provinsi as $item)
                                    <option value="{{ $item->id }}">{{ $item->province }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="kota" class="form-label">Dari Kota</label>
                            <select id="kota" class="form-select" name="origin">
                                <option selected>Pilih Kabupaten/kota</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="kota_ke" class="form-label">Ke Kota</label>
                            <select id="kota_ke" class="form-select" name="destination">
                                <option selected>Pilih Kabupaten/kota</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="berat" class="form-label">Berat</label>
                            <input type="number" class="form-control" id="berat" placeholder="Berat Barang"
                                name="berat">
                            <small>Dalam Gram Contoh 1700 = 1,7kg</small>
                        </div>
                        <div class="col-md-6">
                            <label for="kurir" class="form-label">Kurir</label>
                            <select id="kurir" class="form-select" name="kurir">
                                <option selected>Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="pos">Pos Indonesia</option>
                                <option value="tiki">Tiki</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="d-grid gap-2 mt-1">
                                <button class="btn btn-primary" type="submit">Cek Ongkir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if ($cek_ongkir)
            <div class="col">
                <div class="row justify-content-center">
                    <table class="table table-striped table-bordered table-hovered text-center" style="width: 48rem;">
                        <thead>
                            <tr>
                                <th>Kurir</th>
                                <th>Service</th>
                                <th>Description</th>
                                <th>Harga</th>
                                <th>Estimasi</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cek_ongkir as $item)
                                <tr>
                                    <td>{{ $kurir['name'] }} </td>
                                    <td>{{ $item['service'] }}</td>
                                    <td>{{ $item['description'] }}</td>
                                    <td>Rp. {{ number_format($item['cost'][0]['value']) }}</td>
                                    <td>{{ $item['cost'][0]['etd'] }} Hari</td>
                                    <td>-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('select[name="kirim_dari"]').on('change', function() {
                var city_id = $(this).val();
                if (city_id) {
                    $.ajax({
                        url: 'getCity/ajax/' + city_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="origin"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="origin"]').append(
                                    '<option value=" ' + key + ' ">' + value +
                                    '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="kirim_dari"]').empty();
                }
            });

            $('select[name="kirim_ke"]').on('change', function() {
                var city_id = $(this).val();
                if (city_id) {
                    $.ajax({
                        url: 'getCity/ajax/' + city_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('select[name="destination"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="destination"]').append(
                                    '<option value=" ' + key + ' ">' + value +
                                    '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('select[name="kirim_dari"]').empty();
                }
            });
        });

    </script>
</body>

</html>
