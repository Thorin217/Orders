<template>
    <div>
        <select :id="id" ref="input" v-model="selected" v-bind="$attrs" class="form-select w-1/2" >
            <slot />
        </select>
    </div>
</template>
<script>
export default {
    inheritAttrs: false,
    props:{
        id: {
            type: String,
            default() {
                return `select-input-${this._uid}`
            },
        },
        value: [String, Number, Boolean],
    },
     data() {
        return {
        selected: this.value,
        }
    },
    watch: {
        selected(selected) {
            this.$emit('input', selected)
        },
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
    },
}
</script>