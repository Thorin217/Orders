<template>
    <div class="orders-component">
        <div class="container">
            
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                orders: []
            }
        },
        methods: {
            getOrders(){
                axios.get('/api/order').then(({data})=>{
                    this.orders = data.data
                })
            }
        },
        mounted() {
            this.getOrders()
        },
    }
</script>
