<template>
    <div>
        <div class="flex justify-between mb-4 align-middle items-center content-center">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Detalle del pedido</h3>
            </div>
            <!--  Editar pedido  -->
            <!-- <div class="flex-1 text-right">
                <div class="flex justify-end content-end">
                    <router-link :to="{ name: 'orderedit', params:{ order: order}}">
                        <button class="btn ml-2 bg-gray-800 hover:bg-gray-900 text-white shadow"><span class="dripicons-document-edit" aria-hidden="true"></span></button>
                    </router-link>
                </div>
            </div> -->
        </div>

        <div class="bg-white shadow rounded px-4 py-6">
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    ID
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ item.id }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Cliente
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ item.customer }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Estado actual
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ item.status }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Dirección
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ item.address }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Tipo de entrega
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ item.delivery_type }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Descripción
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ item.description }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Tipo de pago
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ item.payment_type }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Vendedor
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ item.salesman }}
                </div>
            </div>
            <div class="flex border-b mb-2">
                <div class="flex-auto w-64 py-2">
                    Total
                </div>
                <div class="flex-auto w-full py-2 font-bold">
                    {{ item.total }} $
                </div>
            </div>
        </div>

        <div class="flex justify-between my-4 align-middle items-center content-center">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Artículos del pedido</h3>
            </div>
        </div>

        <div class="bg-white shadow rounded px-4 py-6">
            <div class="flex flex-wrap flex-col">
                <div class="flex-1 border-b py-2 px-4"  >
                    <div class="flex justify-between items-center align-middle content-center font-bold">
                        <p class="flex-1">Descripción</p>
                        <p class="flex-1 text-center">Cantidad</p>
                        <p  class="flex-1">Total</p>
                    </div>
                </div>
                <article-component v-for="(item, index)  in item.articles" :article="item" :key="index"></article-component>
            </div>
        </div>
    </div>
</template>
<script>
import ArticleComponent from './DetailArticle'
export default {
    components:{
        ArticleComponent
    },
    props:['order'],
    data() {
        return {
            item: Object,
        }
    },
    methods: {
        getOrder(){
            axios
                .get('/api/order/' + this.order)
                .then(response => {
                    this.item = response.data.data
                }).catch(error => {
                    toastr.error('Ocurrió un problema inesperado')
                })
        }
    },
    mounted() {
        this.getOrder()
    },
}
</script>
