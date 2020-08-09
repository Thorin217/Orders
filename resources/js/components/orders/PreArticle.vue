<template>
    <div>
        <div class="flex justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Confirmar artículo</h3>
            </div>
        </div>

        <div class="flex flex-col shadow rounded bg-white">
            <div class="flex-1  border-b py-8 px-4">
                <div class="flex items-center align-middle content-center">
                    <p class="font-bold w-1/4">Descripción</p>
                    <p class="mx-2 w-3/4">{{ selectArticle.description }}</p>
                </div>
            </div>
            <div class="flex-1  border-b py-8 px-4">
                <div class="flex items-center align-middle content-center">
                    <p class="font-bold w-1/4">Precio</p>
                    <p class="mx-2 w-3/4">{{ selectArticle.price }} $</p>
                </div>
            </div>
            <div class="flex-1  border-b py-8 px-4">
                <div class="flex items-center align-middle content-center">
                    <p class="font-bold w-1/4">Stock</p>
                    <p class="mx-2 w-3/4">{{ selectArticle.stock }} </p>
                </div>
            </div>
            <div class="flex-1  border-b py-8 px-4">
                <div class="flex items-center align-middle content-center">
                    <p class="font-bold w-1/4">Cantidad</p>
                    <p class="mx-2 w-3/4">
                        <input type="number" class="w-32 shadow appearance-none border rounded-lg py-2 px-4 focus:shadow-outline focus:outline-none"
                                name="quantity" id="quantity"
                                step="1"
                                v-model="quantity"
                            >
                            <br>
                            <span class="text-red-500 block" v-if="this.quantity > this.selectArticle.stock">La cantidad introducida excede a la del inventario</span>
                    </p>
                </div>
            </div>
            <div class="flex-1  border-b py-8 px-4">
                <div class="flex items-center align-middle content-center">
                    <p class="font-bold w-1/4">Descuento</p>
                    <p class="mx-2 w-3/4">
                        <input type="number" class="w-32 shadow appearance-none border rounded-lg py-2 px-4 focus:shadow-outline focus:outline-none"
                                name="discount" id="discount"
                                step="0.01"
                                v-model="discount"
                            >
                    </p>
                </div>
            </div>
            <div class="flex-1  border-b py-8 px-4">
                <div class="flex items-center align-middle content-center">
                    <p class="font-bold w-1/4">Total</p>
                    <p class="mx-2 w-3/4">{{ total }} $</p>
                </div>
            </div>
            <div class="flex-1 border-b py-4 px-4  bg-gray-200">
                <div class="flex items-end justify-end">
                    <router-link class="btn" :to="{ name: 'shoppingcart' }">
                        <span >Cancelar</span>
                    </router-link>
                    <button type="button" class="btn btn-gray-dark ml-2" @click="addItem()" >Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['article'],
    data() {
        return {
            selectArticle: Object,
            quantity: 1,
            discount: 0.00,
        }
    },
    computed:{
        total(){
            let total = this.selectArticle.price * this.quantity
            let totalDis = total - this.discount
            return totalDis.toFixed(2)
        },
    },
    methods: {
        getArticle(){
            axios
                .get('/api/inventory/'+this.article)
                .then(response => {
                    this.selectArticle = response.data
                })
        },
        addItem(){
            let article = {
                inventory_id: this.selectArticle.id,
                description: this.selectArticle.description,
                price: this.selectArticle.price,
                discount: this.discount,
                quantity: this.quantity,
                unit_total: this.total
            }
            toastr.success('Artículo añadido con éxito')
            this.$store.commit('cart/setItem', article)
            this.$router.push({ name: 'shoppingcart'})
        }
    },
    mounted() {
        this.getArticle()
    },
}
</script>