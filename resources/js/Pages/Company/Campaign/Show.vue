<script setup>
import {ref, reactive, watch, toRaw} from 'vue';
    import { router } from "@inertiajs/vue3";
    import ItemField from "./components/ItemField.vue";

    const { company, campaign } = defineProps({ company: Object, campaign: Object, staff: Array });

    const selecting = ref(false);
    const assignDialogRef = ref();
    const createDialogRef = ref();
    const form = reactive({
        name: '',
        description: '',
        quantity: 0,
    })

    const assignForm = reactive({
        assigned_to: null,
        items: [],
    })

    function select(item) {
        if (assignForm.items.some((selected) => selected.id === item.id)) {
            return
        }
        assignForm.items.push(structuredClone(toRaw(item)))
    }

    function cancel() {
        selecting.value = false;
        // selected.value = [];
        assignForm.items = [];
    }

    function submitAssignments() {
        router.post(`/companies/${company.id}/campaigns/${campaign.id}/assignments`, assignForm);
        assignDialogRef.value.close()
    }

    function submit() {
        router.post(`/companies/${company.id}/campaigns/${campaign.id}/items`, form);
        createDialogRef.value.close()
    }

    console.log(campaign);
</script>

<template>
    <h1>{{ company.name }}</h1>
    <h1>{{ campaign.name }}</h1>
    <button v-if="!selecting" @click="selecting = !selecting">Select</button>
    <button v-else @click="cancel">Cancel</button>
    <div class="item-container">
        <div v-if="campaign.items.length > 0" v-for="item in campaign.items" class="item-card">
            <h4>{{ item.name }}</h4>
            <p>{{ item.description }}</p>
            <p>Qty: {{ item.available_quantity }}</p>
            <button v-if="selecting" @click="select(item)">Select</button>
        </div>
        <p v-else>No items</p>
    </div>
    <button v-if="selecting" @click="assignDialogRef.showModal">Assign Items</button>
    <dialog ref="assignDialogRef" @close="assignDialogRef.close" class="modal">
        <h2>Assign Items</h2>
        <form @submit.prevent="submitAssignments" v-if="assignForm.items.length > 0">
            <select v-model="assignForm.assigned_to">
                <option v-for="user in staff" :value="user.id">{{ user.name }}</option>
            </select>
            <item-field
                v-for="(selectedItem, idx) in assignForm.items"
                :item="selectedItem"
                v-model="assignForm.items[idx].quantity"
            />
            <button type="submit">Assign</button>
        </form>
    </dialog>

    <button @click="createDialogRef.showModal">Create Item</button>
    <dialog ref="createDialogRef" @close="createDialogRef.close" class="modal">
        <button @click="createDialogRef.close">Close</button>
        <h3>Create Item</h3>
        <form @submit.prevent="submit">
            <label for="name">Name</label>
            <input id="name" v-model="form.name" />
            <label for="description">Description</label>
            <input id="description" v-model="form.description" />
            <label for="quantity">Quantity</label>
            <input id="quantity" v-model="form.quantity" type="number" />
            <button type="submit">Create</button>
        </form>
    </dialog>

    <pre>{{ JSON.stringify([...assignForm.items], null, 2) }}</pre>
</template>

<style scoped>
.item-container {
    display: flex;
    gap: 1rem;
}

.item-card {
    border: 1px solid #f1f1f1;
    width: 300px;
    padding: 1rem;
}

.modal {
    margin: auto;
    padding: 1rem;
    border: 1px solid black;
}
</style>
