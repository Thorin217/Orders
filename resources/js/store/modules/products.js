import axios from 'axios'
import toastr from 'toastr'

//default state
const getDefaultState = () => {
    return {
        payments: [],
        customers: [],
        deliveries: [],
        description: null,
        address: null,
        selectPayment: 1,
        selectDelivery: 1,
        selectCustomer: null,
        isLoading: false
    }
}

// initial state
const state = getDefaultState()

// getters
const getters = {}

//actions
const actions = {
    getResources ({ commit }){
        axios
            .get('/api/resources')
            .then(response => {
                commit('setDeliveries', response.data.deliveries)
                commit('setPayments', response.data.payments)
            }).catch(error => {
                toastr.error('Ocurrió un problema inesperado!')
            })
    },
    getCustomers ({ commit }){
        axios
            .get('/api/customer')
            .then(response => {
                commit('setCustomers', response.data.data)
            })
    }
}

//mutations
const mutations = {

    setCustomers (state, customers) {
        state.customers = customers
    },
    resetState (state) {
        Object.assign(state, getDefaultState())
    },

    updateAddress (state, address) {
        state.address = address
    },

    setPayments (state, payments) {
        state.payments = payments
    },

    updateSelectPayment (state, payment) {
        state.selectPayment = payment
    },

    updateDescription (state, description) {
        state.description = description  
    },

    updateSelectCustomer (state, customer) {
        state.selectCustomer = customer
        state.address = customer.address
    },

    updateSelectDelivery (state, delivery) {
        state.selectDelivery = delivery
    },

    setDeliveries (state, deliveries) {
        state.deliveries = deliveries
    },

    decrementProductInventory (state, { id }) {
        const product = state.products.find(product => product.id === id)
        product.inventory--
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }