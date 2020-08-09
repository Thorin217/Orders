<template>
    <div>
        <div class="flex justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Editar pedido</h3>
            </div>
        </div>

        <form class="submit-att-orders">
            <div class="flex flex-col shadow rounded bg-white">
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Cliente</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <v-select class="w-1/2" :value="selectCustomer"  :options="customers" label="contact_name" @input="updateSelectCustomer">
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                        No se encontraron resultados para <em>{{ search }}</em>.
                                    </template>
                                    <em style="opacity: 0.5;" v-else>Escribe para encontrar a un cliente.</em>
                                </template>
                            </v-select>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Dirección</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <textarea name="address" class="form-input w-1/2" id="address"  rows="5" placeholder="Dirección" :value="address" @input="updateAddress"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Descripción</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <textarea name="description" class="form-input w-1/2" id="description"  rows="5" placeholder="Descripción" :value="description" @input="updateDescription"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Tipo de pago</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <label class="cursor-pointer" :for="'type-payment' + index" v-for="(payment, index) in payments" :key="index">
                                <input type="radio" :checked="payment.id == selectPayment" class="form-radio" name="type_payment" :id="'type-payment' + index" :value="payment.id" @click="updateSelectPayment">
                                {{ payment.name }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Tipo de entrega</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <label class="cursor-pointer" :for="'type-delivery' + index" v-for="(delivery, index) in deliveries" :key="index">
                                <input type="radio" :checked="delivery.id === selectDelivery" class="form-radio" name="type_delivery" :id="'type-delivery' + index" :value="delivery.id" @click="updateSelectDelivery">
                                {{ delivery.name }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-end justify-end">
                        <router-link class="btn btn-gray-dark-outline mx-2" :to="{ name: 'orders' }">Cancelar</router-link>
                        <button type="button" class="btn btn-gray-dark border border-gray-800" @click="validateForm()">Agregar artículos</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import { mapState, mapActions } from 'vuex'

export default {
    props:['order'],
    data() {
        return {
           
        }
    },
    computed: mapState({
        customers: state => state.products.customers,
        payments: state => state.products.payments,
        deliveries: state => state.products.deliveries,
        selectPayment: state => state.products.selectPayment,
        selectDelivery: state => state.products.selectDelivery,
        selectCustomer: state => state.products.selectCustomer,
        address: state => state.products.address,
        description: state => state.products.description,
    }),
    methods: {
        getOrder(){
            axios
                .get('/api/order/'+ this.order)
                .then(response => {
                    const customer = this.customers.find(customer => customer.id === response.data.data.customer_id)
                    this.updateSelectCustomer(customer)
                    this.$store.commit('products/updateAddress', response.data.data.address)
                    this.$store.commit('products/updateDescription', response.data.data.description)
                    this.$store.commit('products/updateSelectPayment', response.data.data.payment_id)
                    this.$store.commit('products/updateSelectDelivery', response.data.data.delivery_id)
                })
        },
        updateSelectPayment(e){
            this.$store.commit('products/updateSelectPayment', e.target.value)
        },

        updateDescription(e) {
            this.$store.commit('products/updateDescription', e.target.value)
        },

        updateSelectCustomer(value) {
            this.$store.commit('products/updateSelectCustomer', value)
        },
        updateAddress(e){
            this.$store.commit('products/updateAddress', e.target.value)
        },
        updateSelectDelivery(e){
            this.$store.commit('products/updateSelectDelivery', e.target.value)
        },
        validateForm () {
            if(this.selectCustomer == null){
                toastr.warning('Debes seleccionar un cliente')
            }else if(this.address == null){
                toastr.warning('El pedido debe contener una dirección')
            }else{
                this.$router.push({ name: 'ordereditcart' , params:{ order: this.order }});
            }
        }
    },
    mounted() {
        this.$store.dispatch('products/getResources')
        this.$store.dispatch('products/getCustomers')
        this.getOrder()
    },
}
</script>