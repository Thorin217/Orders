<template>
    <div>
        <div class="flex justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Detalle del artículo</h3>
            </div>
            <div class="flex-1">
                <div class="flex justify-end content-end">
                    <button type="button" class="btn bg-white hover:bg-gray-100 focus:outline-none shadow" @click="deleteInventory()"><span class="dripicons-trash" aria-hidden="true"></span></button>
                    <router-link :to="{ name: 'inventoryedit', params:{ inventory: inventory}}">
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
                    {{ article.id }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Descripción
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ article.description }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Cantidad
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ article.stock }}
                </div>
            </div>
            <div class="flex border-b  mb-2">
                <div class="flex-auto w-64 py-2">
                    Precio
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ '$ ' + article.price }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Porcentaje de comisión
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ article.commission }} %
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import Swal from 'sweetalert2'
export default {
    props:['inventory'],
    data() {
        return {
            article:[]
        }
    },
    methods: {
        getInventory(){
            axios
                .get('/api/inventory/' + this.inventory)
                .then(response =>{
                    this.article = response.data
                }).catch(error =>{
                    toastr.warning('Ocurrió un error inesperado')
                })
        },
        deleteInventory(){
            Swal.fire({
                    title: '¿Estas seguro?',
                    text: "Esta acción no puede deshacerse",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#2d3748',
                    confirmButtonText: 'Borrar',
                    cancelButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        axios
                            .delete('/api/inventory/' + this.inventory)
                            .then(response => {
                                toastr.success('El artículo ha sido eliminado correctamente')
                                this.$router.push({ name: 'inventories'});
                            }).catch(error =>{
                                toastr.warning('Ocurrió un error inesperado')
                            })
                    }
                })
        }

    },
    created() {
        this.getInventory()
    },
}
</script>
