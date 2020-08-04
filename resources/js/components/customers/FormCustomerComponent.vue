<template>
    <div>
        <div class="flex justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">{{ customer != null ? 'Editar cliente' : 'Crear cliente' }}</h3>
            </div>
        </div>

        <form id="form-submit-customer">
            <div class="flex flex-col shadow bg-white rounded">
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Tipo de cliente</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <select class="block form-select w-1/2 rounded-lg shadow" :class="errors['type_customer'] != null ? 'border-red-500' : ''" id="grid-state" v-model="fields.type_customer">
                                <option value="seleccione" selected>Seleccione un tipo</option>
                                <option :value="item.id" v-for="(item, index) in types" :key="index">{{ item.name }}</option>
                            </select>
                            <div class="block mt-1" role="alert" v-if="errors['type_customer']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['type_customer']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Business name</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <input type="text" class="w-1/2 form-input  rounded-lg shadow"
                                name="business_name" id="business_name"
                                v-model="fields.business_name"
                                placeholder="Business name"
                            >
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Nombre</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <input type="text" class="w-1/2 form-input  rounded-lg shadow"
                                :class="errors['name'] != null ? 'border-red-500' : ''"
                                name="name" id="name"
                                v-model="fields.name"
                                placeholder="Nombre"
                            >
                            <div class="block mt-1" role="alert" v-if="errors['name']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['name']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">DUI</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <input type="text" class="w-1/2 form-input  rounded-lg shadow"
                                :class="errors['dui'] != null ? 'border-red-500' : ''"
                                name="dui" id="dui"
                                v-model="fields.dui"
                                placeholder="DUI"
                            >
                            <div class="block mt-1" role="alert" v-if="errors['dui']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['dui']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">NIT</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <input type="text" class="w-1/2 form-input  rounded-lg shadow"
                                :class="errors['nit'] != null ? 'border-red-500' : ''"
                                name="nit" id="nit"
                                v-model="fields.nit"
                                placeholder="NIT"
                            >
                            <div class="block mt-1" role="alert" v-if="errors['nit']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['nit']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">NCR</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <input type="text" class="w-1/2 form-input  rounded-lg shadow"
                                :class="errors['ncr'] != null ? 'border-red-500' : ''"
                                name="ncr" id="ncr"
                                v-model="fields.ncr"
                                placeholder="NCR"
                            >
                            <div class="block mt-1" role="alert" v-if="errors['ncr']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['ncr']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Telefono</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <input type="text" class="w-1/2 form-input  rounded-lg shadow"
                                :class="errors['telephone'] != null ? 'border-red-500' : ''"
                                name="telephone" id="telephone"
                                v-model="fields.telephone"
                                placeholder="Teléfono"
                            >
                            <div class="block mt-1" role="alert" v-if="errors['telephone']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['telephone']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Celular</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <input type="text" class="w-1/2 form-input  rounded-lg shadow"
                                :class="errors['cellphone'] != null ? 'border-red-500' : ''"
                                name="cellphone" id="cellphone"
                                v-model="fields.cellphone"
                                placeholder="Celular"
                            >
                            <div class="block mt-1" role="alert" v-if="errors['cellphone']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['cellphone']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Dirección</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <textarea name="address"
                                id="address" class="form-textarea w-1/2"
                                :class="errors['address'] != null ? 'border-red-500' : ''"
                                placeholder="Dirección" rows="5"
                                v-model="fields.address"
                            ></textarea>
                            <div class="block mt-1" role="alert" v-if="errors['address']">
                                <ul class="text-red-500">
                                    <li v-for="(error, index) in errors['address']" :key="index">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="flex-1 border-b py-8 px-4">
                    <div class="flex items-center align-middle content-center">
                        <div class="flex-auto w-1/4">
                            <strong class="text-base">Adjuntos</strong>
                        </div>
                        <div class="flex-auto w-3/4">
                            <input type="file" name="attached" id="attached" class="w-1/2 shadow rounded-lg form-input" >
                        </div>
                    </div>
                </div> -->
                <div class="flex-1 border-b py-4 px-4  bg-gray-200">
                    <div class="flex items-end justify-end">
                        <button v-if="customer != null" type="button" class="btn btn-gray-dark ml-2" @click="updateCustomer()">Actualizar cliente</button>
                        <button v-else type="button" class="btn btn-gray-dark ml-2" @click="addCustomer()">Crear cliente</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    props: ['customer'],
    data() {
        return {
            fields:{
                type_customer: null,
                business_name: null,
                name: null,
                telephone: null,
                cellphone: null,
                address: null,
                nit: null,
                ncr: null,
                dui: null,
                attached: null,
            },
            errors: [],
            types: []
        }
    },
    methods: {
        updateCustomer(){
            this.errors = []
            axios.put('/api/customer/' + this.customer,{
                type_customer: this.fields.type_customer,
                business_name: this.fields.business_name,
                name: this.fields.name,
                telephone: this.fields.telephone,
                cellphone: this.fields.cellphone,
                address: this.fields.address,
                ncr: this.fields.ncr,
                nit: this.fields.ncr,
                dui: this.fields.dui
            }).then(response =>{
                toastr.success(response.data.message)
                this.$router.push({ name: 'customers'});
            }).catch(error =>{
                if (error.response.status == 422) {
                    toastr.info('Al parecer algunos datos no son correctos')
                    this.errors = error.response.data.errors
                }else{
                    toastr.warning('Ocurrió un error inesperado')
                }
            })
        },
        addCustomer(){
            this.errors = []
            axios
                .post('/api/customer',{
                    type_customer: this.fields.type_customer,
                    business_name: this.fields.business_name,
                    name: this.fields.name,
                    telephone: this.fields.telephone,
                    cellphone: this.fields.cellphone,
                    address: this.fields.address,
                    ncr: this.fields.ncr,
                    nit: this.fields.ncr,
                    dui: this.fields.dui
                }).then(response =>{
                    toastr.success(response.data.message)
                    this.$router.push({ name: 'customers'});
                }).catch(error =>{
                    if (error.response.status == 422) {
                        toastr.info('Al parecer algunos datos no son correctos')
                        this.errors = error.response.data.errors
                    }else{
                        toastr.warning('Ocurrió un error inesperado')
                    }
                })
        },
        getCustomer(){
            axios
                .get('/api/customer/' + this.customer)
                .then(response => {
                    this.fields.address = response.data.address,
                    this.fields.business_name = response.data.business_name
                    this.fields.cellphone = response.data.cellphone
                    this.fields.telephone = response.data.telephone
                    this.fields.name = response.data.contact_name
                    this.fields.nit = response.data.nit
                    this.fields.dui = response.data.dui
                    this.fields.ncr = response.data.ncr
                    this.fields.type_customer = response.data.idtype
                }).catch(error => {
                    toastr.warning('Ocurrió un error inesperado')
                })
        },
        getTypeCustomers(){
            axios
                .get('/api/typecustomers')
                .then(response => {
                    this.types = response.data
                }).catch(error => {
                    toastr.warning('Ocurrió un error inesperado')
                })
        },
    },
    mounted() {
        this.getTypeCustomers()
        if ( this.customer != null ) {
            this.getCustomer()
        }else{
            this.fields.type_customer = 'seleccione'
        }
    },
}
</script>
