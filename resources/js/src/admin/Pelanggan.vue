<template>
    <div class="container">
        <div class="row" justify-content-center>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Pelanggan</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-success" @click="addPelangganModal">
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
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>ID Pelanggan</th>
                                    <th>Alamat</th>
                                    <th>Golongan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pelanggan in daftarPelanggan.data" :key="pelanggan.id">
                                    <td>{{pelanggan.id}}</td>
                                    <td>{{pelanggan.nama}}</td>
                                    <td>{{pelanggan.id_pel}}</td>
                                    <td>{{pelanggan.alamat}}</td>
                                    <td>{{pelanggan.golongan[0].golongan}}</td>
                                    <td>
                                        <span v-if="pelanggan.status[0].status==='Aktif'"
                                            class="badge bg-success">Aktif</span>
                                        <span v-else class="badge bg-danger">Non Aktif</span>
                                    <td>
                                        <a href="#" class="btn bg-warning btn-flat btn-sm" title="Ubah"
                                            @click="editPelangganModal(pelanggan)">
                                            <i class="fa fa-user-edit icon-white"></i>
                                        </a>
                                        <a href="#" @click="deletePelanggan(pelanggan.id)"
                                            class="btn bg-danger btn-flat btn-sm" title="Hapus">
                                            <i class="fa fa-user-times icon-white"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="daftarPelanggan" @pagination-change-page="getResults">
                            <span slot="prev-nav">&lt; Sebelumnya</span>
                            <span slot="next-nav">Selanjutnya &gt;</span>
                        </pagination>
                    </div>
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
                        <h4 v-show="editMode" class="modal-title">Ubah Pelanggan</h4>
                        <h4 v-show="!editMode" class="modal-title">Tambah Pelanggan Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updatePelanggan() : createPelanggan()">
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
                                <select v-model="form.golonganId" type="text" class="form-control" name="golonganId"
                                    :class="{ 'is-invalid': form.errors.has('golongan') }">
                                    <option disabled value="">Pilih Golongan Pelanggan</option>
                                    <option v-for="golongan in jenis_golongan" :key="golongan.id"
                                        v-bind:value="golongan.id">
                                        {{ golongan.golongan }}</option>
                                </select>
                                <has-error :form="form" field="golongan"></has-error>
                            </div>

                            <div class="form-group">
                                <select v-model="form.statusId" v-show="editMode" type="text" class="form-control" name="statusId"
                                    :class="{ 'is-invalid': form.errors.has('status') }">
                                    <option disabled value="">Pilih Status Pelanggan</option>
                                    <option v-for="status in jenis_status" :key="status.id" v-bind:value="status.id">
                                        {{ status.status }}</option>
                                </select>
                                <has-error :form="form" field="status"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            <button v-show="editMode" type="submit" class="btn btn-warning">Perbaharui</button>
                            <button v-show="!editMode" type="submit" class="btn btn-primary">Tambahkan</button>
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
                editMode: false,
                jenis_golongan: [],
                jenis_status: {},
                daftarPelanggan: {},
                form: new Form({
                    id: '',
                    nama: '',
                    id_pel: '',
                    alamat: '',
                    golonganId: '',
                    statusId: ''
                })
            }
        },
        methods: {
            // Menggunakan metode untuk pagination
            getResults(page = 1) {
                axios.get('api/daftar-pelanggan?page=' + page)
                    .then(response => {
                        this.daftarPelanggan = response.data;
                    });
            },

            addPelangganModal() {
                this.editMode = false;
                this.form.reset();
                $("#TambahBaruModal").modal("show");
                this.form.statusId = "1";
            },
            editPelangganModal(pelanggan) {
                this.editMode = true;
                this.form.reset();
                this.form.clear();
                $("#TambahBaruModal").modal("show");
                this.form.fill(pelanggan);
                this.form.golonganId = pelanggan.golongan[0].id;
                this.form.statusId = pelanggan.status[0].id;
            },
            deletePelanggan(id) {
                // untuk menghapus Data Pelanggan
                Swal.fire({
                    title: 'Apakah Sudah Yakin Bosku?',
                    text: "Data tidak dapat dikembalikan",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus Bosku!'
                }).then((result) => {
                    //Send the request to the server
                    let url = "api/daftar-pelanggan/" + id;
                    this.form.delete(url).then(() => {
                            if (result.value) {
                                Swal.fire("Berhasil!", "Data berhasil dihapus Bosku.", "success");
                            }
                            Update.$emit("Updated");
                        })
                        .catch(() => {
                            Swal.fire("Gagal!", "Terjadi Kesalahan Bosku", "warning");
                        })
                })
            },

            updatePelanggan() {
                this.$Progress.start();
                let url = "api/daftar-pelanggan/" + this.form.id;
                this.form
                    .put(url)
                    .then(() => {
                        //succes
                        $("#TambahBaruModal").modal("hide");
                        Swal.fire("Berhasil!", "Data berhasil diubah Bosku.", "success");
                        this.$Progress.finish();
                        Update.$emit("Updated");
                    })
                    .catch(() => {
                        //failed
                        this.$Progress.fail();
                        Swal.fire("Gagal!", "Data gagal diubah Bosku.", "warning");
                    });
            },
            loadDaftarPelanggan() {
                // untuk menampilkan Daftar Pelanggan
                axios.get("api/daftar-pelanggan").then(({
                    data
                }) => (this.daftarPelanggan = data));
            },

            loadGolongan: function () {
                let url = "api/golongan";
                axios.get(url).then(({
                    data
                }) => (this.jenis_golongan = data));
            },
            loadStatus: function () {
                let url = "api/status";
                axios.get(url).then(({
                    data
                }) => {
                    //console.log(response)
                    // set your form data not sure of the correct form from above but same idea
                    this.jenis_status = data; // however the response is formatted from Laravel may differ
                });
            },

            createPelanggan() {
                // untuk menambahkan pelanggan baru
                this.$Progress.start();

                let url = "api/daftar-pelanggan";
                this.form
                    .post(url)
                    .then(() => {
                        $("#TambahBaruModal").modal("hide");
                        this.$Toast.fire({
                            icon: "success",
                            title: "Pengguna baru telah dibuat bosku..."
                        });

                        this.$Progress.finish();

                        Update.$emit("Updated");
                    })

                    .catch(() => {
                        this.$Progress.fail();
                        this.$Toast.fire({
                            icon: "warning",
                            title: "Terdapat kesalahan saat menyimpan data bosku..."
                        });
                    });
            }
        },
        created() {
            this.loadDaftarPelanggan();
            this.loadGolongan();
            this.loadStatus();

            Update.$on("Updated", () => {
                this.loadDaftarPelanggan();
            });
        }
    }
</script>
