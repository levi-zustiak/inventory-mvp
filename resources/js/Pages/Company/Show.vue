<script setup>
    defineProps({ company: Object });
</script>

<template>
    <h1>{{ company.name }}</h1>
    <p>{{ JSON.stringify(company.campaigns, null, 2) }}</p>
</template>
