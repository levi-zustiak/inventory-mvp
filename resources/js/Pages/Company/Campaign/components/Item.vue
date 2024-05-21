<script setup>
const { select } = defineProps({ item: Object, handleSelect: Function, isSelected: Boolean })

console.log(select)

</script>

<template>
    <div class="container" :class="{ selected: isSelected }">
        <h4>{{ item.name }}</h4>
        <p>{{ item.description }}</p>
        <p>Qty: {{ item.available_quantity }}</p>
    </div>
</template>

<style scoped>
.container {
    border: 2px solid lightgrey;
    border-radius: 8px;
    padding: 1rem;
    width: 300px;
}

.img {

}

.selected {
    border: 2px solid black;
}
</style>
