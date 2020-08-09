<template>
    <div>
        <div class="flex justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Detalle del cliente</h3>
            </div>
            <div class="flex-1">
                <div class="flex justify-end content-end">
                    <button type="button" class="btn bg-white hover:bg-gray-100 focus:outline-none shadow" @click="deleteCustomer()"><span class="dripicons-trash" aria-hidden="true"></span></button>
                    <router-link :to="{ name: 'customeredit', params:{ customer: customer}}">
                        <button class="btn ml-2 bg-gray-800 hover:bg-gray-900 text-white shadow"><span class="dripicons-document-edit" aria-hidden="true"></span></button>
                    </router-link>
                </div>
            </div>
        </div>

        <div class="bg-white shadow rounded px-4 py-6">
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    ID
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.id }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Nombre
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.contact_name }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Business
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.business_name }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Tipo
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.type }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    DUI
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.dui }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    NIT
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.nit }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    NCR
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.ncr }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Telefono
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.telephone }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Celular
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.cellphone }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Dirección
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.address }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Fecha de creación
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ customerLocal.created_at }}
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import Swal from 'sweetalert2'
export default {
    props:['customer'],
    data() {
        return {
            customerLocal:[]
        }
    },
    methods: {
        getCustomer(){
            axios
                .get('/api/customer/' + this.customer)
                .then(response =>{
                    this.customerLocal = response.data
                }).catch(error =>{
                    toastr.warning('Ocurrió un error inesperado')
                })
        },
        deleteCustomer(){
            Swal.fire({
                    title: '¿Estas seguro?',
                    text: "Esta acción no puede deshacerse",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#2d3748',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Borrar'
                }).then((result) => {
                    if (result.value) {
                        axios
                            .delete('/api/customer/' + this.customer)
                            .then(response => {
                                toastr.success('El cliente ha sido eliminado correctamente')
                                this.$router.push({ name: 'customers'});
                            }).catch(error =>{
                                toastr.warning('Ocurrió un error inesperado')
                            })
                    }
                })
        }

    },
    created() {
        this.getCustomer()
    },
}
</script>
