<template>
    <div>
        <div class="flex justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">{{ inventory != null ? 'Editar artículo' : 'Crear artículo' }}</h3>
            </div>
        </div>

        <form id="form-submit-article" >
            <div class="flex flex-col shadow bg-white rounded">
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Descripción</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <input type="text" class="w-1/2 shadow appearance-none border rounded-lg py-2 px-2 focus:shadow-outline focus:outline-none"
                                :class="errors['description'] != null ? 'border-red-500' : ''"
                                name="description" id="description"
                                v-model="fields.description"
                                placeholder="Descripción"
                            >
                            <div class="block mt-1" role="alert" v-if="errors['description']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['description']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Cantidad</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <input type="number" class="w-32 shadow appearance-none border rounded-lg py-2 px-2 focus:shadow-outline focus:outline-none"
                                :class="errors['quantity_stock'] != null ? 'border-red-500' : ''"
                                name="quantity_stock" id="quantity-stock"
                                v-model="fields.quantity_stock"
                            >
                            <div class="block mt-1" role="alert" v-if="errors['quantity_stock']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['quantity_stock']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Precio</strong>
                        </div>
                        <div class="flex-auto w-3/4 relative">
                            <span class="text-gray-500 absolute w-6 h-6 mt-2 ml-2 text-base">$</span>
                            <input type="number" class="w-32 shadow appearance-none border rounded-lg py-2 pl-6 pr-2 focus:shadow-outline focus:outline-none"
                                :class="errors['unit_price'] != null ? 'border-red-500' : ''"
                                name="unit_price" id="unit-price"
                                step="0.01"
                                v-model="fields.unit_price"
                            >
                            <div class="block mt-1" role="alert" v-if="errors['unit_price']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['unit_price']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Porcentaje de comisión</strong>
                        </div>
                        <div class="flex-auto w-3/4 relative">
                            <span class="text-gray-500 absolute w-6 h-6 mt-2 ml-2 text-base">%</span>
                            <input type="number" class="w-32 shadow appearance-none border rounded-lg py-2 pl-6 pr-2 focus:shadow-outline focus:outline-none"
                                :class="errors['percent_commission'] != null ? 'border-red-500' : ''"
                                name="percent_commission" id="percent-commission"
                                step="0.01"
                                v-model="fields.percent_commission"
                            >
                            <div class="block mt-1" role="alert" v-if="errors['percent_commission']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['percent_commission']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-4 px-4  bg-gray-200">
                    <div class="flex items-end justify-end">
                        <button v-if="inventory != null" type="button" class="btn btn-gray-dark ml-2" @click="updateArticle()">Actualizar artículo</button>
                        <button v-else type="button" class="btn btn-gray-dark ml-2" @click="addArticle()">Crear artículo</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    props:['inventory'],
    data() {
        return {
            fields:{
                description: null,
                quantity_stock:null,
                unit_price:null,
                percent_commission:null
            },
            errors:[],
            article:[]
        }
    },
    methods: {
        getArticle(){
            axios
                .get('/api/inventory/' + this.inventory)
                .then(response =>{
                    this.fields.description = response.data.description
                    this.fields.quantity_stock = response.data.stock
                    this.fields.unit_price = response.data.price
                    this.fields.percent_commission = response.data.commission
                }).catch(error =>{
                    toastr.warning('Ocurrió un error inesperado')
                })
        },
        addArticle(){
            this.errors = []
            axios.post('/api/inventory',{
                description: this.fields.description,
                quantity_stock: this.fields.quantity_stock,
                unit_price: this.fields.unit_price,
                percent_commission: this.fields.percent_commission
            }).then(({data})=>{
                    toastr.success(data.message)
                    this.$router.push({ name: 'inventories'});
            }).catch(error =>{
                if (error.response.status == 422) {
                    toastr.info('Al parecer algunos datos no son correctos')
                    this.errors = error.response.data.errors
                }else{
                    toastr.warning('Ocurrió un error inesperado')
                }
            })
        },
        updateArticle(){
            this.errors = []
            axios.put('/api/inventory/' + this.inventory,{
                description: this.fields.description,
                quantity_stock: this.fields.quantity_stock,
                unit_price: this.fields.unit_price,
                percent_commission: this.fields.percent_commission
            }).then(({data})=>{
                    toastr.success(data.message)
                    this.$router.push({ name: 'inventories'});
            }).catch(error =>{
                if (error.response.status == 422) {
                    toastr.info('Al parecer algunos datos no son correctos')
                    this.errors = error.response.data.errors
                }else{
                    toastr.warning('Ocurrión un error inesperado')
                }
            })
        }
    },
    mounted() {
        if(this.inventory != null){
            this.getArticle()
        }
    },
}
</script>
