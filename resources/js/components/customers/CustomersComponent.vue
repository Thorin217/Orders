<template>
    <div>
        <div class="flex justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Clientes</h3>
            </div>
        </div>
        <data-table :columns="columns" :model="'cliente'" :link="'/customers/'" :source="'/api/customer'"></data-table>
    </div>
</template>
<script>
import DataTable from '../DataTableComponent'
export default {
    components: {
        DataTable
    },
    data() {
        return {
            columns:['id', 'nombre', 'entidad',  'nit', 'ncr', 'dui']
        }
    },
}
</script>
