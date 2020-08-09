<template>
    <div>
        <input type="text" :name="name" :id="id">
    </div>
</template>
<script>
export default {
    inheritAttrs: false,
    props:{
        id: {
            type: String,
            default() {
                return `text-input-${this._uid}`
            },
        },
        name: String
    }
}
</script>