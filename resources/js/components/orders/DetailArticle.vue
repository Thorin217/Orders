<template>
    <div>
        <div class="flex-1 border-b py-8 px-4"  >
            <div class="flex justify-between items-center align-middle content-center">
                <p class="flex-1">{{ article.article }}</p>
                <div class="flex-1 text-center">
                    {{ article.quantity }}
                </div>
                <span  class="flex-1">{{ article.unit_total }} $</span>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['article']
}
</script>