<template>
    <div>
        <div class="flex justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Inventario</h3>
            </div>
        </div>
        <data-table 
            :columns="columns" 
            :model="'inventario'" 
            :link="'/inventories/'" 
            :source="'/api/inventory'"
        >
        </data-table>
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
            columns:['id', 'descripción', 'precio',  'stock', 'comisión']
        }
    },
}
</script>
