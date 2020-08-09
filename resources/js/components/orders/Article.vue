<template>
    <div>
        <div class="flex-1 border-b py-8 px-4"  >
            <div class="flex justify-between items-center align-middle content-center">
                <p class="flex-1">{{ article.description }}</p>
                <div class="flex-1 text-center">
                    <input type="number" class="w-32 shadow appearance-none border rounded-lg py-2 px-4 focus:shadow-outline focus:outline-none"
                        name="quantity" id="quantity"
                        step="1"
                        :value="article.quantity"
                        @input="updateQuantity"
                    >
                </div>
                <span  class="flex-1">{{ article.unit_total }} $</span>
                <span class="text-xl cursor-pointer" @click="deleteItem">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10"><path class="heroicon-ui" d="M16.24 14.83a1 1 0 0 1-1.41 1.41L12 13.41l-2.83 2.83a1 1 0 0 1-1.41-1.41L10.59 12 7.76 9.17a1 1 0 0 1 1.41-1.41L12 10.59l2.83-2.83a1 1 0 0 1 1.41 1.41L13.41 12l2.83 2.83z"/></svg>
                </span>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState } from 'vuex'
export default {
    props: ['id'],
    computed: mapState({
        article(state){
            return state.cart.items.find(element => element.inventory_id === this.id)
        }
    }),
    methods: {
        updateQuantity(e){
            this.$store.commit('cart/updateQuantity', { id: this.id, quantity: e.target.value})
        },
        deleteItem(){
            this.$store.commit('cart/delItem', this.article)
            toastr.success('El artículo ha sido removido')
        }
    },

}
</script>