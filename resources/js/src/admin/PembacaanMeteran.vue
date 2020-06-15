<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pembacaan Meteran</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-success" @click="addPembacaanMeteranModal">
                                Tambah Baru
                                <i class="fas fa-edit icon-white"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>ID Pelanggan</th>
                                    <th>Waktu Pembacaan</th>
                                    <th>Pembacaan Meteran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tr  v-for="pembacaan in daftar_pembacaan.data" :key="pembacaan.id">
                                <td>{{pembacaan.id}}</td>
                                <td>{{pembacaan.pelanggan[0].nama}}</td>
                                <td>{{pembacaan.pelanggan[0].id_pel}}</td>
                                <td>{{pembacaan.created_at}}</td>
                                <td>{{pembacaan.pembacaan}}</td>
                                <td>
                                    <a href="#" @click="editPembacaanMeteranModal" class="btn bg-warning btn-flat btn-sm" title="Ubah">
                                        <i class="fa fa-user-edit icon-white"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal -->
        <div class="modal fade" id="PembacaanMeteranModal" tabindex="-1" role="dialog" aria-labelledby="PembacaanMeteranModal"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 v-show="editMode" class="modal-title">Ubah Pembacaan</h4>
                        <h4 v-show="!editMode" class="modal-title">Tambah Pembacaan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updatePembacaan() : createPembacaan()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.nama" type="text" class="form-control" name="nama"
                                    placeholder="Nama Pelanggan..."
                                    :class="{ 'is-invalid': form.errors.has('nama') }" />
                                <has-error :form="form" field="nama"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.id_pel" type="text" class="form-control" name="id_pel"
                                    placeholder="ID Pelanggan..."
                                    :class="{ 'is-invalid': form.errors.has('id_pel') }" />
                                <has-error :form="form" field="id_pel"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.pembacaan" type="text" class="form-control" name="pembacaan"
                                    placeholder="Masukkan Pembacaan Meteran..."
                                    :class="{ 'is-invalid': form.errors.has('pembacaan') }" />
                                <has-error :form="form" field="pembacaan"></has-error>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editMode: false,
                daftar_pembacaan: {},
                form: new Form({
                    nama:'',
                    id_pel:'',
                    pembacaan: '',
                })
                }
        },
        methods: {
            updatePembacaan(){
                console.log('Ini Modal Edit')
            },
            createPembacaan(){
                console.log('Ini Modal Tambah')
            },
            addPembacaanMeteranModal() {
                this.editMode = false;
                this.form.reset();
                $("#PembacaanMeteranModal").modal("show");
            },
            editPembacaanMeteranModal(pembacaan) {
                this.editMode = true;
                this.form.reset();
                $("#PembacaanMeteranModal").modal("show");
            },
            loadDaftarPembacaan() {
                // untuk menampilkan Daftar Pelanggan
                axios.get("api/daftar-pembacaan").then(({
                    data
                }) => (this.daftar_pembacaan = data));
            },
        },
        created() {
            this.loadDaftarPembacaan();
        }
    }
</script>
