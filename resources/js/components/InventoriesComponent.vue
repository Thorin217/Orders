<template>
    <div>
        <div class="bg-white w-full mx-auto rounded shadow-lg py-6 px-4">
            <h5 class="text-base">
                Pedidos
            </h5>
            <div class="flex justify-between">
                <div>
                    Mostrar <select name="" id="">
                                <option value="0">10</option>
                            </select>
                    Artículos
                </div>
                <div class="text-right">
                    <input type="search" name="search" id="search-orders">
                    <button class=""><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
            <div>
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="px-4 py-2">Description</th>
                            <th class="px-4 py-2">Price</th>
                            <th class="px-4 py-2">stock</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in inventory" :key="index">
                            <td class="border px-4 py-2"></td>
                            <td class="border px-4 py-2">{{ item.description }}</td>
                            <td class="border px-4 py-2">{{ item.price }}</td>
                            <td class="border px-4 py-2">{{ item.stock }}</td>
                            <th>editar eliminard</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                inventory: []
            }
        },
        methods: {
            getInventory(){
                axios.get('/api/inventory').then(({data})=>{
                    this.inventory = data.data
                })
            }
        },
        created() {
            this.getInventory()
        },
    }
</script>
