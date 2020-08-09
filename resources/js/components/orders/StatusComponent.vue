<template>
    <div>
        <div class="w-full py-2">
            <div class="flex content-center justify-center" @click="editOrder(item)">
                <div class="w-1/5">
                    <div class="relative mb-2">
                        <div class="w-10 h-10 mx-auto border-2 border-gray-200 rounded-full text-lg text-white flex items-center" :class="allstatus.created ? 'bg-gray-800' : 'bg-white'">
                            <span class="text-center  w-full" :class="allstatus.created ? 'text-white' : 'text-gray-800'" v-if="allstatus.created">
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                                </svg>
                            </span>
                            <span class="text-center  w-full" :class="allstatus.created ? 'text-white' : 'text-gray-800'" v-else>
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="text-xs text-center">Creado</div>
                </div>
                <div class="w-1/5">
                    <div class="relative mb-2">
                        <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                <div class="w-0 bg-gray-700 py-1 rounded" :style="allstatus.processing ? 'width: 100%' : 'width: 0%'"></div>
                            </div>
                        </div>

                        <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center" :class="allstatus.processing ? 'bg-gray-800' : 'bg-white'">
                            <span class="text-center  w-full" :class="allstatus.processing ? 'text-white' : 'text-gray-800'" v-if="allstatus.processing">
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                                </svg>
                            </span>
                            <span class="text-center  w-full" :class="allstatus.processing ? 'text-white' : 'text-gray-800'" v-else>
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="text-xs text-center">En proceso</div>
                </div>
                <div class="w-1/5" v-if="typedelivery === 'Domicilio'">
                    <div class="relative mb-2">
                        <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                <div class="w-0 bg-gray-700 py-1 rounded" :style="allstatus.in_route ? 'width: 100%' : 'width: 0%'"></div>
                            </div>
                        </div>

                        <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center" :class="allstatus.in_route ? 'bg-gray-800' : 'bg-white'">
                            <span class="text-center  w-full" :class="allstatus.in_route ? 'text-white' : 'text-gray-800'" v-if="allstatus.in_route">
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                                </svg>
                            </span>
                            <span class="text-center  w-full" :class="allstatus.in_route ? 'text-white' : 'text-gray-800'" v-else>
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="text-xs text-center">En ruta</div>
                </div>
                <div class="w-1/5">
                    <div class="relative mb-2">
                        <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                <div class="w-0 bg-gray-700 py-1 rounded" :style="allstatus.delivered ? 'width: 100%' : 'width: 0%'"></div>
                            </div>
                        </div>

                        <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center" :class="allstatus.delivered ? 'bg-gray-800' : 'bg-white'">
                            <span class="text-center  w-full" :class="allstatus.delivered ? 'text-white' : 'text-gray-800'" v-if="allstatus.delivered">
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                                </svg>
                            </span>
                            <span class="text-center  w-full" :class="allstatus.delivered ? 'text-white' : 'text-gray-800'" v-else>
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="text-xs text-center">Entregado</div>
                </div>
                <div class="w-1/5">
                    <div class="relative mb-2">
                        <div class="absolute flex align-center items-center align-middle content-center" style="width: calc(100% - 2.5rem - 1rem); top: 50%; transform: translate(-50%, -50%)">
                            <div class="w-full bg-gray-200 rounded items-center align-middle align-center flex-1">
                                <div class="w-0 bg-gray-700 py-1 rounded" :style="allstatus.cancelled ? 'width: 100%' : 'width: 0%'"></div>
                            </div>
                        </div>

                        <div class="w-10 h-10 mx-auto bg-white border-2 border-gray-200 rounded-full text-lg text-white flex items-center" :class="allstatus.cancelled ? 'bg-gray-800' : 'bg-white'">
                            <span class="text-center  w-full" :class="allstatus.cancelled ? 'text-white' : 'text-gray-800'" v-if="allstatus.cancelled">
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/>
                                </svg>
                            </span>
                            <span class="text-center  w-full" :class="allstatus.cancelled ? 'text-white' : 'text-gray-800'" v-else>
                                <svg class="w-full fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="heroicon-ui" d="M4.93 19.07A10 10 0 1 1 19.07 4.93 10 10 0 0 1 4.93 19.07zm1.41-1.41A8 8 0 1 0 17.66 6.34 8 8 0 0 0 6.34 17.66zM13.41 12l1.42 1.41a1 1 0 1 1-1.42 1.42L12 13.4l-1.41 1.42a1 1 0 1 1-1.42-1.42L10.6 12l-1.42-1.41a1 1 0 1 1 1.42-1.42L12 10.6l1.41-1.42a1 1 0 1 1 1.42 1.42L13.4 12z"/>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="text-xs text-center">Cancelado</div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['status','item','typedelivery'],
    data() {
        return {
            allstatus: Object
        }
    },
    methods: {
        editOrder(item){
            this.$emit('update-order', item)
        }
    },
    mounted() {
            switch (this.status) {
                case 'en proceso':
                    this.allstatus = {
                        created: 1,
                        processing: 1,
                        in_route: 0,
                        delivered: 0,
                        cancelled: 0,
                    }
                    break;
                case 'en ruta':
                    this.allstatus = {
                        created: 1,
                        processing: 1,
                        in_route: 1,
                        delivered: 0,
                        cancelled: 0,
                    }
                    break;
                case 'entregado':
                    this.allstatus = {
                        created: 1,
                        processing: 1,
                        in_route: 1,
                        delivered: 1,
                        cancelled: 0,
                    }
                    break;
                case 'cancelado':
                    this.allstatus = {
                        created: 1,
                        processing: 1,
                        in_route: 1,
                        delivered: 1,
                        cancelled: 1,
                    }
                    break;
                default:
                    this.allstatus = {
                        created: 1,
                        processing: 0,
                        in_route: 0,
                        delivered: 0,
                        cancelled: 0,
                    }
                    break;
            }
    },
}
</script>
