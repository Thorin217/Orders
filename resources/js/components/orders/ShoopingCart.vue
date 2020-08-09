<template>
    <div>
        <div class="flex justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Agregar artículos</h3>
            </div>
        </div>

        <div class="flex flex-col shadow rounded bg-white">
            <div class="flex-1 border-b py-8 px-4">
                <div class="flex items-center align-middle content-center">
                    <p class="font-bold  w-32">Artículos</p>
                    <v-select class="w-full mx-2" :options="articles" label="description" v-model="selectArticle"></v-select>
                    <button class="btn btn-gray-dark-outline text-xs w-32" v-if="selectArticle != null" @click="addItem">Agregar</button>
                </div>
            </div>
                <article-component 
                    v-for="(item, index) in items"
                    :id="item.inventory_id"
                    :key="index"
                ></article-component>
            <div class="flex-1 border-b py-8 px-4" v-if="items.length">
                <div class="flex justify-between items-center align-middle content-center">
                    <div class="flex-1 font-bold">Total</div>
                    <div class="flex-1"></div>
                    <div class="flex-1"><span>{{ total.toFixed(2) }} $</span></div>
                    <div class="w-10"></div>
                </div>
            </div>
            <div class="flex-1 border-b py-4 px-4  bg-gray-200">
                <div class="flex items-end justify-end">
                    <button type="button" class="btn" >Cancelar</button>
                    <button type="button" class="btn btn-gray-dark ml-2" @click="saveOrder">Guardar pedido</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ArticleComponent from './Article'
import { mapState, mapActions, mapGetters } from 'vuex'
import Swal from 'sweetalert2'

export default {
    components:{
        ArticleComponent
    },
    data() {
        return {
            selectArticle: null
        }
    },
    computed: {
        ...mapState({
            articles: state => state.cart.articles,
            items: state => state.cart.items,
            selectCustomer: state => state.products.selectCustomer,
            selectDelivery: state => state.products.selectDelivery,
            address: state => state.products.address,
            selectPayment: state => state.products.selectPayment,
            description: state => state.products.description
        }),
        ...mapGetters('cart', {
            total: 'cartTotalPrice'
        })
    },
    methods:{
        addItem(){
            this.$router.push({ name: 'prearticle', params: { article: this.selectArticle.id }});
        },
        saveOrder(){
            if(!this.items.length){
                toastr.warning('No se ha agregado ningún artículo al pedido')
            }else if(this.selectCustomer == null) {
                toastr.warning('No has agregado ningun cliente para el pedido')
                this.$router.push({ name: 'ordersadd' });
            }else{
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "Una vez guardado el pedido no podras editarlo",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#2d3748',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        axios
                            .post('/api/order',{
                                customer: this.selectCustomer.id,
                                delivery_type: this.selectDelivery,
                                address: this.address,
                                payment_type: this.selectPayment,
                                description: this.description,
                                articles: this.items
                            })
                            .then(response => {
                                this.$store.commit('products/resetState')
                                this.$store.commit('cart/resetState')
                            toastr.success(response.data.message)
                            this.$router.push({ name: 'orders' });
                            }).catch(error => {
                                toastr.error('Ocurrió un error inesperado')
                            })
                    }
                })
            }
        }
    },
    mounted() {
        this.$store.dispatch('cart/getArticles')
    },
}
</script>