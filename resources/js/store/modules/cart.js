import axios from 'axios'
import toastr from 'toastr'

//default state
const getDefaultState = () => {
    return {
        items:[],
        articles: [],
        status: 'empty'
    }
}

//initial state
const state = getDefaultState()

//getters
const getters = {
    cartTotalPrice: (state, getters) => {
        return state.items.reduce((total, product) => {
            return parseFloat(total) + parseFloat(product.unit_total)
        },0)
    }
}

//actions
const actions = {
    getArticles({ commit }){
        axios
            .get('/api/inventory')
            .then(response => {
                commit('setArticles', response.data.data)
            })
    }
}
//mutations
const mutations = {
    setArticles (state, articles) {
        state.articles = articles
    },

    resetState (state) {
        Object.assign(state, getDefaultState())
    },

    updateQuantity(state,  {id, quantity}){
        const item = state.articles.find(item => item.id === id)
        item.stock = item.stock - quantity
        const article = state.items.find(item => item.inventory_id === id)
        article.quantity = quantity
        const totalValue = quantity * item.price
        const total = totalValue - article.discount
        article.unit_total =  total.toFixed(2)
    },

    setItem (state, article) {
        state.items.push(article)
    },

    delItem (state, article) {
        const index = state.items.indexOf(article);
        if (index > -1) {
            state.items.splice(index, 1);
        }
    }
}


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }