<template>
    <div>
        <div class="flex justify-between">
            <div class="flex-1">
                <span class="absolute z-20 block w-6 h-6 text-center pointer-events-none text-gray-500 py-2 ml-1">
                    <svg class="svg-icon text-gray-200" viewBox="0 0 20 20" fill="#a0aec0">
                        <path d="M18.125,15.804l-4.038-4.037c0.675-1.079,1.012-2.308,1.01-3.534C15.089,4.62,12.199,1.75,8.584,1.75C4.815,1.75,1.982,4.726,2,8.286c0.021,3.577,2.908,6.549,6.578,6.549c1.241,0,2.417-0.347,3.44-0.985l4.032,4.026c0.167,0.166,0.43,0.166,0.596,0l1.479-1.478C18.292,16.234,18.292,15.968,18.125,15.804 M8.578,13.99c-3.198,0-5.716-2.593-5.733-5.71c-0.017-3.084,2.438-5.686,5.74-5.686c3.197,0,5.625,2.493,5.64,5.624C14.242,11.548,11.621,13.99,8.578,13.99 M16.349,16.981l-3.637-3.635c0.131-0.11,0.721-0.695,0.876-0.884l3.642,3.639L16.349,16.981z"></path>
                    </svg>
                </span>
                <input type="search" class="pl-8 shadow appearance-none border rounded-lg w-1/2 py-2 pr-2 focus:shadow-outline focus:outline-none" name="search-inventory" id="searchInventory" placeholder="Buscar">
            </div>
            <div class="flex-1 text-right h-full">
                <button class="self-center btn bg-gray-800 hover:bg-gray-900 text-white">Crear Inventario</button>
            </div>
        </div>

        <div class="bg-white w-full mt-4 rounded shadow py-4 px-0">
            <div class="flex justify-between mb-4 px-2">
                <div class="flex-1">
                    <input type="checkbox" class="form-checkbox text-xl text-gray-800 ml-2" name="select-item" id="selectItem">
                    <label for="selectItem" class="cursor-pointer pt-2 pl-2">Seleccionar todos</label>
                </div>
                <div class="flex-1 text-right">
                    <button class="btn bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold focus:outline-none border border-gray-400"><span class="text-xl dripicons-experiment" aria-hidden="true"></span><span class="pl-2 text-xs dripicons-chevron-down" aria-hidden="true"></span></button>
                    <button class="btn bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold focus:outline-none border border-gray-400"><span class="text-xl dripicons-trash" aria-hidden="true"></span></button>
                </div>
            </div>
            <table class="table-auto w-full mb-4">
                <thead class="bg-gray-200 text-left">
                    <tr class="uppercase text-base">
                        <th class="py-2"></th>
                        <th class="px-2 py-2">Description</th>
                        <th class="px-2 py-2">Price</th>
                        <th class="px-2 py-2">stock</th>
                        <th class="px-2 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in inventory" :key="index">
                        <td class="border-b px-2 py-4">
                            <input type="checkbox" class="form-checkbox text-xl text-gray-800" :id="index" value="item.id">
                        </td>
                        <td class="border-b px-2 py-4">{{ item.description }}</td>
                        <td class="border-b px-2 py-4">{{ item.price }}</td>
                        <td class="border-b px-2 py-4">{{ item.stock }}</td>
                        <th class="border-b px-2 py-4">
                            <div class="flex">
                                <button class="text-gray-500 px-2 focus:outline-none font-bold hover:text-gray-800"><span class="text-xl dripicons-preview" aria-hidden="true"></span></button>
                                <button class="text-gray-500 px-2 focus:outline-none font-bold hover:text-gray-800"><span class="text-xl dripicons-document-edit" aria-hidden="true"></span></button>
                                <button class="text-gray-500 px-2 focus:outline-none font-bold hover:text-gray-800"><span class="text-xl dripicons-trash" aria-hidden="true"></span></button>
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>
            <div class="flex justify-between mx-4">
                <div class="flex-1">
                    <p class="text-left font-black text-base">Anterior</p>
                </div>
                <div class="flex-1">
                    <p class="text-right font-black text-base">Siguiente</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                inventory: [],
            }
        },
        methods: {
            getInventory(){
                axios.get('/inventories/all').then(({data})=>{
                    this.inventory = data.data
                })
            }
        },
        created() {
            this.getInventory()
        },
    }
</script>
