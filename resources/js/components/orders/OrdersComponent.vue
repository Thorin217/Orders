<template>
    <div>
        <div class="flex justify-between mb-4">
            <div class="flex-1">
                <h3 class="text-3xl font-bold leading-10">Ordenes</h3>
            </div>
        </div>

        <div class="orders">
            <div class="bg-white rounded-sm shadow border-l-2 border-gray-800 px-4 py-2" v-for="(order, index) in orders" :key="index">
                <div class="flex">
                    <div class="flex-1">
                        <h3 class="font-bold text-xl mb-2 capitalize">{{ order.customer }}</h3>
                        <div class="relative">
                            <div class="inline-block">
                                <div class="flex">
                                    <span class="dripicons-weight"></span>
                                    <span
                                        class="ml-2 text-sm text-gray-800
                                        dark:text-gray-800 font-bold">
                                        {{ order.total }} $
                                    </span>
                                </div>
                            </div>
                            <div class="inline-block pl-3">
                                <div class="flex">
                                    <span class="dripicons-user"></span>
                                    <span
                                        class="ml-2 text-sm text-gray-600
                                        dark:text-gray-300 capitalize">
                                        {{ order.salesman }}
                                    </span>
                                </div>
                            </div>
                            <div class="inline-block pl-3">
                               <div class="flex">
                                    <span class="dripicons-exit"></span>
                                    <span
                                        class="ml-2 text-sm text-gray-600
                                        dark:text-gray-300">
                                        {{ order.delivery_type }}
                                    </span>
                                </div>
                            </div>
                            <div class="inline-block pl-3">
                               <div class="flex">
                                    <span class="dripicons-calendar"></span>
                                    <span
                                        class="ml-2 text-sm text-gray-600
                                        dark:text-gray-300">
                                        {{ order.created_at }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <template v-if="order.delivery_type == 'Domicilio'">
                            <home-status :status="order.status"></home-status>
                        </template>
                        <template v-else>
                            <local-status :status="order.status"></local-status>
                        </template>
                        <p  class="ml-2 text-sm text-gray-600 dark:text-gray-300"><strong>Dirección: </strong>{{ order.address }}</p>
                    </div>
                </div>
            </div>

            <infinite-loading :identifier="infiniteId" @infinite="infiniteHandler">
                <div slot="no-more">No hay más ordenes</div>
            </infinite-loading>
        </div>

    </div>
</template>
<script>
import InfiniteLoading from 'vue-infinite-loading';
import HomeStatus from '../HomeStatusComponent'
import LocalStatus from '../LocalStatusComponent'
export default {
    components:{
        InfiniteLoading, HomeStatus, LocalStatus
    },
    data() {
        return {
            orders: [],
            page: 1,
            infiniteId: +new Date(),
        }
    },
    methods: {
        infiniteHandler($state) {
          axios
            .get('/api/order', {
                params: {
                    page: this.page,
                    client: 'local'
                },
            }).then(({ data }) => {
                if (data.data.length) {
                    this.page += 1;
                    this.orders.push(...data.data);
                    $state.loaded();
                } else {
                    $state.complete();
                }
            });
        },
    },
}
</script>
