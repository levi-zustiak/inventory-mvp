<script setup>
import {reactive, ref} from "vue";

const { items, assignments } = defineProps({ items: Array, assignments: Array })

const dialogRef = ref();

const form = reactive({
    assignment_id: null,
    item_id: null,
    quantity: 0,
    method: '',
    image: null,
})

function returnItem() {

}

function submit() {

}
</script>

<template>
    <pre>{{ JSON.stringify(items, null, 2) }}</pre>
    <table>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Assigned</th>
            <th>Action</th>
        </tr>
        <tr v-for="item in items">
            <td>{{ item.name }}</td>
            <td>{{ item.quantity }}</td>
            <td>{{ item.assignments[0].created_at }}</td>
            <td><button @click="returnItem(item)">Return</button></td>
        </tr>
    </table>

    <dialog ref="dialogRef" @close="dialogRef.close" class="modal">
        <h2>Return Item</h2>
        <form @submit.prevent="returnItem">

        </form>
    </dialog>
</template>

<style scoped>
table {
    width: 50%;
    border-collapse: collapse;
    border-spacing: 0;
}

th, td {
    padding: 8px;
}

th {
    border: 1px solid lightgrey;
    text-align: left;
    border-spacing: 0;
}

td {
    border: 1px solid lightgrey;
}
</style>
