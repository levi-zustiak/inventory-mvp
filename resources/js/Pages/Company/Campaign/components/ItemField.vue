<script setup>
const model = defineModel()
const { item } = defineProps({ item: Object })
console.log(item)
</script>

<template>
    <div>
<!--        <label for=""-->
        <h3>{{ item.name }}</h3>
        <input v-model="model" type="number"/>
    </div>
</template>
