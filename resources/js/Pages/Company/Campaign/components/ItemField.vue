<script setup>
const model = defineModel()
const { item } = defineProps({ item: Object })
console.log(item)
</script>

<template>
    <div>
        <label>{{ item.name }}</label>
        <input v-model="model" type="number" :max="item.available_quantity" min="1"/>
    </div>
</template>
