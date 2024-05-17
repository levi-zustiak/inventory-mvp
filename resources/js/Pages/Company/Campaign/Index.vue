<script setup>
defineProps({ campaigns: Array });
</script>

<template>
    <p>{{ JSON.stringify(campaigns, null, 2) }}</p>
</template>
