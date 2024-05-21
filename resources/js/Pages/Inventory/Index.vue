<script setup>
import {reactive, ref, toRaw} from "vue";
import {router} from "@inertiajs/vue3";

const { items, assignments } = defineProps({ items: Array, assignments: Array })

console.log(assignments);

const dialogRef = ref();

const form = reactive({
    assignment: null,
    return_quantity: 0,
    method: '',
    image: null,
});

function startReturn(selectedAssignment) {
    form.assignment = selectedAssignment;
    form.return_quantity = selectedAssignment.quantity;

    dialogRef.value.showModal();
}

function submit() {
    router.post(`/assignments/${form.assignment.id}`, form);
    dialogRef.value.close();
    form.assignment = null;
}
</script>

<template>
    <table>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Assigned</th>
            <th>Action</th>
        </tr>
        <tr v-for="assignment in assignments">
            <td>{{ assignment.item.name }}</td>
            <td>{{ assignment.quantity }}</td>
            <td>{{ assignment.created_at }}</td>
            <td><button @click="startReturn(assignment)">Return</button></td>
        </tr>
    </table>

    <dialog ref="dialogRef" @close="dialogRef.close" class="modal">
        <h2>Return Item</h2>
        <form @submit.prevent="submit" v-if="form.assignment">
            <label>Quantity</label>
            <input id="quantity" type="number" v-model="form.return_quantity"  min="1" :max="form.assignment.quantity"/>
            <button type="submit">Return</button>
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


dialog {
    margin: auto;
    padding: 1rem;
    border: 1px solid black;
}
</style>
