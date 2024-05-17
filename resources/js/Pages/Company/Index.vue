<script setup>
    defineProps({ companies: Array });
</script>

<template>
    <p>{{ JSON.stringify(companies, null, 2) }}</p>
</template>
