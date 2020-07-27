import Vue from 'vue'
import Router from 'vue-router'

//components
import Inventories from './components/Inventory/InventoryComponent'
import Home from './components/DashboardComponent'
import DetailInventory from './components/Inventory/DetailComponent'
import EditInventory from './components/Inventory/FormInventoryComponent'
import Customers from './components/customers/CustomersComponent'
import DetailCustomers from './components/customers/DetailComponent'
import EditCustomers from './components/customers/FormCustomerComponent'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/inventories",
            name: "inventories",
            component: Inventories
        },
        {
            path: "/inventories/:inventory",
            name: "inventory",
            component: DetailInventory,
            props: true
        },
        {
            path: "/inventories/:inventory/edit",
            name: "inventoryedit",
            component: EditInventory,
            props: true
        },
        {
            path: "/inventories/create/item",
            name: "inventoryadd",
            component: EditInventory,
            props: false
        },
        {
            path: "/customers",
            name: "customers",
            component: Customers
        },
        {
            path: '/customers/:customer',
            name: 'customer',
            component: DetailCustomers,
            props: true
        },
        {
            path: '/customers/:customer/edit',
            name: 'customeredit',
            component: EditCustomers,
            props: true
        },
        {
            path: '/customers/create/item',
            name: 'customeradd',
            component: EditCustomers,
        }

    ]
})
