<template>
    <div>
        <div class="flex justify-between mb-4 align-middle items-center content-center">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Pedidos</h3>
            </div>
            <div class="flex-1 text-right">
                <router-link class="btn btn-gray-dark" :to="{ name: 'ordersadd' }">Crear pedido</router-link>
            </div>
        </div>

        <div class="orders">
            <div class="bg-white rounded-sm shadow border-l-2 border-gray-800 px-4 py-2" v-for="(order, index) in orders" :key="index">
                <div class="flex pb-2" :class="!orders[orders.length - 1] ? 'border-b' : ''">
                    <div class="flex-1">
                        <h3 class="font-bold text-xl mb-2 capitalize">{{ order.customer }}</h3>
                        <div class="relative">
                            <div class="inline-block">
                                <div class="flex">
                                    <span class="dripicons-weight"></span>
                                    <span
                                        class="ml-2 text-sm text-gray-800
                                        dark:text-gray-800 font-bold">
                                        {{ order.total }} $
                                    </span>
                                </div>
                            </div>
                            <div class="inline-block pl-3">
                                <div class="flex">
                                    <span class="dripicons-user"></span>
                                    <span
                                        class="ml-2 text-sm text-gray-600
                                        dark:text-gray-300 capitalize">
                                        {{ order.salesman }}
                                    </span>
                                </div>
                            </div>
                            <div class="inline-block pl-3">
                               <div class="flex">
                                    <span class="dripicons-exit"></span>
                                    <span
                                        class="ml-2 text-sm text-gray-600
                                        dark:text-gray-300">
                                        {{ order.delivery_type }}
                                    </span>
                                </div>
                            </div>
                            <div class="inline-block pl-3">
                               <div class="flex">
                                    <span class="dripicons-calendar"></span>
                                    <span
                                        class="ml-2 text-sm text-gray-600
                                        dark:text-gray-300">
                                        {{ order.created_at }}
                                    </span>
                                </div>
                            </div>
                            <div class="inline-block pl-3">
                               <div class="flex">
                                    <span class="dripicons-card"></span>
                                    <span
                                        class="ml-2 text-sm text-gray-600
                                        dark:text-gray-300">
                                        {{ order.payment_type }}
                                    </span>
                                </div>
                            </div>
                            <router-link :to="{ name: 'orderdetail' , params: { order: order.id }}" class="inline-block pl-3">
                               <div class="flex hover:text-blue-500">
                                    <span class="dripicons-preview"></span>
                                    <span
                                        class="ml-2 text-sm text-gray-600
                                        dark:text-gray-300">
                                        Detalles
                                    </span>
                                </div>
                            </router-link>
                        </div>
                        <status-component :status="order.status" :item="order" :typedelivery="order.delivery_type" @update-order="updateOrder"></status-component>
                        <p  class="ml-2 text-sm text-gray-600 dark:text-gray-300"><strong>Dirección: </strong>{{ order.address }}</p>
                    </div>
                </div>
            </div>

            <infinite-loading :identifier="infiniteId" @infinite="infiniteHandler">
                <div slot="no-more">No hay más pedidos</div>
                <div slot="no-results">
                    <img src="/images/empty.svg" class="object-fill  w-full h-64" alt="">
                    <p class="text-center font-bold ">No se encontro ningún registro</p>
                    <p class="text-center mt-4 text-xs">
                        <router-link :to="{ name: 'ordersadd'}">
                            <button type="button" class="btn bg-white border border-gray-800 text-gray-800 hover:bg-gray-900 hover:text-white">Crear pedido</button>
                        </router-link>
                    </p>
                </div>
            </infinite-loading>
        </div>

        <modal-state v-if="showModal" @close="showModal = false" @accept="changeState">
            <template v-slot:icon-modal>
                <span v-if="actualstate != 'cancelado'">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </span>
                <span v-else>
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                    </svg>
                </span>
                
            </template>
            <template v-slot:title-modal>
                <span v-if="actualstate != 'cancelado'">Cambiar estado</span>
                <span v-else>Estado actual del pedido</span>
            </template>
            <template v-slot:body-modal>
                <div v-if="actualstate != 'cancelado'">
                    <p>El pedido se encuentra <span class="font-bold">{{ actualstate }}</span> </p>
                    <p>Si aceptas cambiar de estado pasara a estar <span class="font-bold">{{ selectOrder }}</span> </p>
                </div>
                <div v-else>
                    <p>El pedido esta cancelado</p>
                </div>
            </template>
        </modal-state>
    </div>
</template>
<script>

import InfiniteLoading from 'vue-infinite-loading';
import StatusComponent from './StatusComponent'
import ModalState from '../ModalComponent'
import Swal from 'sweetalert2'

export default {
    components:{
        InfiniteLoading, StatusComponent, ModalState
    },
    data() {
        return {
            orders: [],
            page: 1,
            infiniteId: +new Date(),
            showModal: false,
            selectOrder: null,
            actualstate: null,
            actualorder: null
        }
    },
    methods: {
        infiniteHandler($state) {
          axios
            .get('/api/order', {
                params: {
                    page: this.page,
                    client: 'local'
                },
            }).then(({ data }) => {
                if (data.data.length) {
                    this.page += 1;
                    this.orders.push(...data.data);
                    $state.loaded();
                } else {
                    $state.complete();
                }
            });
        },

        updateOrder(e){
            this.showModal = true
            this.actualstate = e.status
            this.actualorder = e.id
            if(e.delivery_type == 'Domicilio'){
                switch (e.status) {
                    case 'en proceso':
                        this.selectOrder = 'en ruta'
                        break;
                    case 'en ruta':
                        this.selectOrder = 'entregado'
                        break;
                    case 'entregado':
                        this.selectOrder = 'cancelado'
                        break;
                    default:
                        this.selectOrder = 'en proceso'
                        break;
                }
            }else{
                switch (e.status) {
                    case 'en proceso':
                        this.selectOrder = 'entregado'
                        break;
                    case 'entregado':
                        this.selectOrder = 'cancelado'
                        break;
                    default:
                        this.selectOrder = 'en proceso'
                        break;
                }
            }
        },

        changeState(){
            if(this.actualstate == 'cancelado'){
                this.showModal = false
            }else{

                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "Esta acción no puede deshacerse",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#2d3748',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.value) {
                        axios
                            .put('/api/order-state/' + this.actualorder,{
                                status: this.selectOrder
                            })
                            .then(response => {
                                toastr.success(response.data.message)
                                this.showModal = false
                                this.actualstate = null
                                this.actualorder = null
                                this.selectOrder = null
                                this.orders = []
                                this.page = 1
                                this.infiniteId += 1
                            }).catch(error => {
                                toastr.error('Ocurrió un error inesperado')
                            })
                    }else{
                        this.showModal = false
                        this.actualstate = null,
                        this.actualorder = null,
                        this.selectOrder = null
                    }
                })
            }
        }
    },
}
</script>
