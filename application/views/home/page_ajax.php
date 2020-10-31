<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="<?= base_url() . 'assets/js/node_modules/jquery/dist/jquery.min.js' ?>"></script>
</head>

<body>


    <div class="container">
        <h1>Data bArang</h1>

        <a href="" class="btn btn-success mb-4 mt-4" data-toggle="modal" data-target="#formModal" onclick="submit('tambah')">Tambah data</a>


        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Stock</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="target">

            </tbody>
        </table>

        <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="newUserLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newUserLabel">Tambah Data Barang</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <p id="pesan_html"></p>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Kode Barang</label>
                            <input type="text" class="form-control" id="kode_barang_input" name="kode_barang_input" placeholder="Name">
                            <input type="hidden" class="form-control" id="id_barang_input" value="" name="id_barang_input" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <input type="text" class="form-control" id="nama_barang_input" name="nama_barang_input" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="">Harga Barang</label>
                            <input type="number" class="form-control" id="harga_barang_input" name="harga_barang_input" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="">Stok Barang</label>
                            <input type="number" class="form-control" id="stok_barang_input" name="stok_barang_input" placeholder="Facebook">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="refreshInput()" data-dismiss="modal">Batal</button>
                            <button type="button" id="btn-simpan" onclick="tambahData()" class="btn btn-primary">Simpan</button>
                            <button type="button" id="btn-edit" onclick="updateData()" class="btn btn-primary">Edit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <!-- Java Script BootStrap -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- script ajax nya -->
    <script type="text/javascript">
        // untuk memanggil function ambil data yang sudah di buat di bawah
        ambilData();

        // Awal Pengambilan data atau get data
        function ambilData() {
            $.ajax({
                type: 'POST', //alamatnya adalah nama controller, lalu nama function
                url: '<?= base_url() . "page/ambildata" ?>',
                dataType: 'json',
                success: function(dataGet) {
                    var baris = '';
                    // dataGet.lenght maksudnya panjang dataGet dari variable"dataGet" yang ada di dalam kurung fucntion di atas
                    for (var i = 0; i < dataGet.length; i++) {
                        baris += '<tr>' +
                            '<td>' + (i + 1) + '</td>' +
                            '<td>' + dataGet[i].kode_barang + '</td>' +
                            '<td>' + dataGet[i].nama_barang + '</td>' +
                            '<td>' + dataGet[i].harga + '</td>' +
                            '<td>' + dataGet[i].stok + '</td>' +
                            '<td><a href="#formModal" data-toggle="modal" class="btn btn-primary" onclick="submit(' + dataGet[i].id + ')" id="">Ubah</a>' +
                            '<a  class="btn btn-danger ml-2 text-white" onclick="hapusData(' + dataGet[i].id + ')" >Hapus</a>' + '</td>' +
                            '</tr>';
                    }
                    $('#target').html(baris);

                }
            });
        } // akhir dari function ambil data ata get data




        // sc lengkap dan lebih bagus lung "https://github.com/techontech/codeigniter-ajax-crud"

        // Function untuk Refresh Inputan
        function refreshInput() {
            $("[name='kode_barang_input']").val('');
            $("[name='nama_barang_input']").val('');
            $("[name='harga_barang_input']").val('');
            $("[name='stok_barang_input']").val('');

        } // penutupan function refresh inputan


        // Pembukaan functionn tambahData
        function tambahData() {
            // di sini penjelasannya ada di 3. CodeIgniter + AJAX (Part 3) -  Menambah Data 05:00
            // intinya di setelah sama dengan ini di baca, ajax mengambil properti "name" di tag input, dan beri isikan di dalam name tersebut adalah "kode_barang_input", lalu ".val()" maksudnya mengambil value atau isi dari inputan dengan nama "kode_barang_input" tersebut
            // var id_barang_ajax = $("[name='id_barang_input']").val();
            var kode_barang_ajax = $("[name='kode_barang_input']").val();
            var nama_barang_ajax = $("[name='nama_barang_input']").val();
            var harga_barang_ajax = $("[name='harga_barang_input']").val();
            var stok_barang_ajax = $("[name='stok_barang_input']").val();

            $.ajax({
                type: 'POST',
                data: 'kode_barang_ajax_ci=' + kode_barang_ajax + '&nama_barang_ajax_ci=' + nama_barang_ajax + '&harga_barang_ajax_ci=' + harga_barang_ajax + '&stok_barang_ajax_ci=' + stok_barang_ajax,
                url: '<?= base_url() . 'Page/tambahDataCi' ?>',
                dataType: 'json',
                success: function(hasilAdd) {
                    $("#pesan_html").html(hasilAdd.pesan_json);

                    if (hasilAdd.pesan_json == '') {
                        $("#formModal").modal('hide');
                        ambilData();
                        refreshInput();

                    }
                }
            });
        } // end TambahData

        // pembukaan function tombol dinamis sesuai parameter onclick submit('parameter')
        function submit(x) {
            if (x == 'tambah') {
                $('#btn-simpan').show();
                $('#btn-edit').hide();
            } else {
                $('#btn-simpan').hide();
                $('#btn-edit').show();

                $.ajax({
                    type: "POST",
                    data: 'id_ajax_edit=' + x,
                    url: '<?= base_url() . "Page/GetId" ?>',
                    dataType: 'json',
                    success: function(dataGet) {
                        $('[name="id_barang_input"]').val(dataGet[0].id);
                        $('[name="kode_barang_input"]').val(dataGet[0].kode_barang);
                        $('[name="nama_barang_input"]').val(dataGet[0].nama_barang);
                        $('[name="harga_barang_input"]').val(dataGet[0].harga);
                        $('[name="stok_barang_input"]').val(dataGet[0].stok);
                    }
                });

            }
        }

        // penutupan function tombol dinamis sesuai parameter onclick submit('parameter')


        // Pembukaan UpdateData
        function updateData() {
            var id = $("[name='id_barang_input']").val();
            var kode_barang_ajax = $("[name='kode_barang_input']").val();
            var nama_barang_ajax = $("[name='nama_barang_input']").val();
            var harga_barang_ajax = $("[name='harga_barang_input']").val();
            var stok_barang_ajax = $("[name='stok_barang_input']").val();

            $.ajax({
                type: 'POST',
                data: 'id_ajax_edit=' + id + '&kode_barang_ajax_edit=' + kode_barang_ajax + '&nama_barang_ajax_edit=' + nama_barang_ajax + '&harga_barang_edit=' + harga_barang_ajax + '&stok_barang_edit=' + stok_barang_ajax,
                url: '<?= base_url() . 'Page/EditData' ?>',
                dataType: 'json',
                success: function(hasilEdit) {
                    $("#pesan_html").html(hasilEdit.pesan_json);

                    if (hasilEdit.pesan_json == '') {
                        $("#formModal").modal('hide');
                        ambilData();
                        refreshInput();
                    }
                }
            });
        } //penutup EditData

        // pembukaan HapusData
        function hapusData(id) {
            var tanya = confirm('Apakah Anda Yakin ingin menghapus data ini?');

            if (tanya) {
                $.ajax({
                    type: 'POST',
                    data: 'id_ajax_delete=' + id,
                    url: '<?= base_url() . 'Page/HapusData' ?>',
                    success: function() {
                        ambilData();
                    }
                });
            }
        }
    </script>
</body>

</html>