<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pelanggan</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#TambahBaruModal">
                                Tambah Baru
                                <i class="fa fa-user-edit icon-white"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Golongan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pelanggan in daftarPelanggan" :key="pelanggan.id">
                                    <td>{{pelanggan.id}}</td>
                                    <td>{{pelanggan.nama}}</td>
                                    <td>{{pelanggan.alamat}}</td>
                                    <td>{{pelanggan.golongan}}</td>
                                    <td>
                                        <a href="#" class="btn bg-warning btn-flat btn-sm" title="Ubah">
                                            <i class="fa fa-user-edit icon-white"></i>
                                        </a>
                                        <a href="#" class="btn bg-danger btn-flat btn-sm" title="Hapus">
                                            <i class="fa fa-user-times icon-white"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="TambahBaruModal" tabindex="-1" role="dialog" aria-labelledby="tambahBaruModalLabel"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahBaruModalLabel">Tambah Pelanggan Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="createPelanggan">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.nama" type="text" class="form-control" name="nama"
                                    placeholder="Masukkan Nama Pelanggan..."
                                    :class="{ 'is-invalid': form.errors.has('nama') }" />
                                <has-error :form="form" field="nama"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.alamat" type="text" class="form-control" name="alamat"
                                    placeholder="Masukkan Alamat Pelanggan..."
                                    :class="{ 'is-invalid': form.errors.has('alamat') }" />
                                <has-error :form="form" field="alamat"></has-error>
                            </div>

                            <div class="form-group">
                                <select v-model="form.golongan" type="text" class="form-control" name="golongan"
                                    :class="{ 'is-invalid': form.errors.has('alamat') }">
                                    <option value="">Pilih Golongan Pelanggan</option>
                                    <option value="Rumah Tangga">Rumah Tangga</option>
                                    <option value="Sosial">Sosial</option>
                                </select>
                                <has-error :form="form" field="golongan"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                daftarPelanggan :{},
                form: new Form({
                    nama: '',
                    alamat: '',
                    golongan: ''
                })
            }
        },
        methods: {
            // untuk menampilkan Daftar Pelanggan
            loadDaftarPelanggan(){
                axios.get("api/daftar-pelanggan").then(({ data }) => (this.daftarPelanggan = data.data));
            },

            // untuk menambahkan pelanggan baru
            createPelanggan() {
                this.form.post('api/daftar-pelanggan');
            }
        },
        created() {
            this.loadDaftarPelanggan();
        }
    }
</script>
