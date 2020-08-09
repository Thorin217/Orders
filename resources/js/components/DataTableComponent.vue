<template>
    <div>
        <div class="flex justify-between">
            <div class="flex-1">
                <span class="absolute z-20 block w-6 h-6 text-center pointer-events-none text-gray-500 py-2 ml-1">
                    <svg class="svg-icon text-gray-200" viewBox="0 0 20 20" fill="#a0aec0">
                        <path d="M18.125,15.804l-4.038-4.037c0.675-1.079,1.012-2.308,1.01-3.534C15.089,4.62,12.199,1.75,8.584,1.75C4.815,1.75,1.982,4.726,2,8.286c0.021,3.577,2.908,6.549,6.578,6.549c1.241,0,2.417-0.347,3.44-0.985l4.032,4.026c0.167,0.166,0.43,0.166,0.596,0l1.479-1.478C18.292,16.234,18.292,15.968,18.125,15.804 M8.578,13.99c-3.198,0-5.716-2.593-5.733-5.71c-0.017-3.084,2.438-5.686,5.74-5.686c3.197,0,5.625,2.493,5.64,5.624C14.242,11.548,11.621,13.99,8.578,13.99 M16.349,16.981l-3.637-3.635c0.131-0.11,0.721-0.695,0.876-0.884l3.642,3.639L16.349,16.981z"></path>
                    </svg>
                </span>
                <input type="search"
                    class="pl-8 shadow appearance-none border rounded-lg w-1/2 py-2 pr-2 focus:shadow-outline focus:outline-none"
                    name="search-inventory"
                    v-model="query.search_input"
                    id="searchItem"
                    placeholder="Buscar"
                    @input="getData()"
                >
            </div>
            <div class="flex-1 text-right h-full">
                <router-link :to="link + 'create/item'">
                    <button class="self-center btn bg-gray-800 hover:bg-gray-900 text-white">Crear {{ model }}</button>
                </router-link>
            </div>
        </div>

        <div class="bg-white w-full mt-4 rounded shadow py-4 px-0">
            <div class="flex justify-between mb-4 px-2">
                <div class="flex-1">
                    <div class="flex h-full align-middle content-center items-center">
                        <input type="checkbox" :checked="isChecked" class="form-checkbox text-xl text-gray-800 ml-2" name="select-item" id="selectItem" @click="selectAll()">
                        <label for="selectItem" class="cursor-pointer pl-2">Seleccionar todos</label>
                    </div>
                </div>
                <div class="flex-1 text-right">
                    <div class="relative inline-block">
                        <dropdown
                            :items="options"
                            @update-table="updateTable"
                        >
                            <template v-slot:title-icon>
                                <span class="text-xl dripicons-experiment" aria-hidden="true"></span>
                            </template>
                        </dropdown>
                    </div>
                    <button
                        class="btn bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold focus:outline-none border border-gray-400"
                        v-if="itemsSelected.length > 0"
                        @click="deleteItems()"
                    >
                        <span class="text-xl dripicons-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </div>

            <div class="border-t">
                <div class="main-table" v-if="items.length > 0">
                    <table class="table-auto w-full mb-4">
                        <thead class="bg-gray-200 text-left">
                            <tr class="uppercase text-base">
                                <th class="px-2 py-2"></th>
                                <th class="px-2 py-2 cursor-pointer" v-for="(column, index) in columns" :key="index" @click="toggleOrder(column)">
                                    <div class="flex">{{ column }} <span class="pl-1" :class="query.column === column && query.direction === 'asc' ? 'text-gray-800' : 'text-gray-400'">&uarr;</span> <span class="pl-1" :class="query.column === column && query.direction === 'desc'? 'text-gray-800' : 'text-gray-400'">&darr;</span></div>
                                </th>
                                <th class="px-2 py-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in items" :key="index">
                                <td class="border-b px-2 py-4">
                                    <input type="checkbox"
                                        :checked="itemsSelected.includes(item.id)"
                                        class="form-checkbox text-xl text-gray-800"
                                        :id="index"
                                        value="item.id"
                                        @click="selectItem(item.id)"
                                    >
                                </td>
                                <td class="border-b px-2 py-4" v-for="(value, index) in item" :key="index">{{ value }}</td>
                                <th class="border-b px-2 py-4">
                                    <div class="flex">
                                        <router-link :to="link + item.id">
                                            <button class="text-gray-500 px-2 focus:outline-none font-bold hover:text-gray-800"><span class="text-xl dripicons-preview" aria-hidden="true"></span></button>
                                        </router-link>
                                        <router-link :to="link + item.id + '/edit'">
                                            <button class="text-gray-500 px-2 focus:outline-none font-bold hover:text-gray-800"><span class="text-xl dripicons-document-edit" aria-hidden="true"></span></button>
                                        </router-link>
                                    </div>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    <div class="flex justify-between mx-4">
                        <div class="flex-1">
                            <p class="text-left font-black text-base cursor-pointer hover:text-gray-800 text-gray-400" @click="prev()">Anterior</p>
                        </div>
                        <div class="flex-1">
                            <p class="text-right font-black text-base cursor-pointer hover:text-gray-800 text-gray-400" @click="next()">Siguiente</p>
                        </div>
                    </div>
                </div>
                <div class="no-data mt-2 w-1/2 mx-auto" v-else>
                    <div class="flex items-center justify-center flex-col" v-if="isLoading">
                        <div class="loader loader--style1" title="0">
                            <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            width="40px" height="40px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                            <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                                s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                                c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
                            <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                                C22.32,8.481,24.301,9.057,26.013,10.047z">
                                <animateTransform attributeType="xml"
                                attributeName="transform"
                                type="rotate"
                                from="0 20 20"
                                to="360 20 20"
                                dur="0.5s"
                                repeatCount="indefinite"/>
                                </path>
                            </svg>
                        </div>
                        <p>Cargando...</p>
                    </div>
                    <div class="p-0 m-0" v-else>
                        <img src="/images/empty.svg" class="object-fill  w-full h-64" alt="">
                        <p class="text-center font-bold ">ningún {{model}} coincide con los criterios dados</p>
                        <p class="text-center mt-4 text-xs">
                            <router-link :to="link + 'create/item'">
                                <button type="button" class="btn bg-white border border-gray-800 text-gray-800 hover:bg-gray-900 hover:text-white">Crear {{ model }}</button>
                            </router-link>
                        </p>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>
<script>
import Swal from 'sweetalert2'
import Dropdown from './DropdownComponent'
    export default {
        components: { dropdown: Dropdown},
        props:['columns', 'model','source', 'link'],
        data() {
            return {
                query:{
                    column: this.columns[0],
                    direction: 'asc',
                    search_input: '',
                    per_page: 10,
                    page: 1
                },
                isChecked:false,
                isLoading:false,
                itemsSelected:[],
                items:[],
                meta:[],
                links:[],
                options:[10,25,50,100]
            }
        },
        methods: {
            getData(){
                this.isLoading = true;
                axios
                    .get(this.source,{
                        params:{
                            column: this.query.column,
                            direction: this.query.direction,
                            per_page: this.query.per_page,
                            search_input: this.query.search_input,
                            page: this.query.page,
                            client: 'local'
                        }
                    }).then(({data})=>{
                        this.items = data.data
                        this.meta = data.meta
                        this.links = data.links
                    }).catch(error =>{
                        toastr.warning('Ocurrió un error inesperado')
                    }).finally(()=>{
                        this.isLoading = false
                    })
            },
            toggleOrder( column ){
                if( column == this.query.column )
                {
                    this.query.direction == 'asc' ? this.query.direction = 'desc' : this.query.direction = 'asc'
                }else{
                    this.query.column = column
                    this.query.direction = 'asc'
                }

                this.getData();
            },
            prev(){
                if ( this.links.prev )
                {
                    this.query.page--
                    this.getData()
                }
            },
            next(){
                if ( this.links.next )
                {
                    this.query.page++
                    this.getData()
                }
            },
            updateTable(e){
                this.query.per_page = e
                this.getData()
            },
            selectAll(){
                this.isChecked = true
                if ( this.itemsSelected.length )
                {
                    this.itemsSelected = []
                }else{
                    this.items.forEach(element =>{
                        this.itemsSelected.push(element.id)
                    })
                }
            },
            selectItem(item){
                const index = this.itemsSelected.indexOf(item);
                if (index > -1) {
                    this.itemsSelected.splice(index, 1);
                } else {
                    this.itemsSelected.push(item);
                }
            },
            deleteItems(){
                let vm = this
                  Swal.fire({
                        title: '¿Estas seguro?',
                        text: "Esta acción no puede deshacerse",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#2d3748',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Borrar'
                    }).then((result) => {
                        if (result.value) {
                            axios
                                .put(vm.source + '/delete/all', {
                                    items: vm.itemsSelected
                                }).then(({data})=>{
                                    vm.getData()
                                    toastr.success('Los elementos han sido eliminados')
                                    vm.itemsSelected = []
                                }).catch(error => {
                                    toastr.warning('Ocurrió un error inesperado')
                                })
                        }else{
                            vm.itemsSelected = []
                        }
                    })
            }
        },
        created() {
            this.getData()
        },
    }
</script>
<style>

</style>
