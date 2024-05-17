<script setup>
import {ref, reactive, watch} from 'vue';
    import { router } from "@inertiajs/vue3";
    import ItemField from "./components/ItemField.vue";

    const { company, campaign } = defineProps({ company: Object, campaign: Object });

    const selecting = ref(false);
    const selected = ref(new Set());
    const assignDialogRef = ref();
    const createDialogRef = ref();
    const form = reactive({
        name: '',
        description: '',
        quantity: 0,
    })

    const assignForm = reactive({
        items: [...selected.value.values()],
    })

    // console.log([...selected.value.values()], assignForm)

    watch(selected, async (newSelected, oldSelected) => {
        console.log([...newSelected.values()], [...oldSelected.values()])
    })

    function select(item) {
        selected.value.add(item)
        // if (selected.value.some((selectedItem) => selectedItem.id === item.id)) return
        //
        // selected.value.push(item)
    }

    function cancel() {
        selecting.value = false;
        // selected.clear();
        selected.value.clear();
    }

    function submitAssignments() {
        console.log(assignForm)
    }

    function submit() {
        console.log('submitting')
        router.post(`/companies/${company.id}/campaigns/${campaign.id}/items`, form);
    }


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
            <p>Qty: {{ item.quantity }}</p>
            <button v-if="selecting" @click="select(item)">Select</button>
        </div>
        <p v-else>No items</p>
    </div>
    <button v-if="selecting" @click="assignDialogRef.showModal">Assign Items</button>
    <dialog ref="assignDialogRef" @close="assignDialogRef.close" class="modal">
        <h2>Assign Items</h2>
        <p>{{ selected.size }}</p>
        <form @submit.prevent="submitAssignments" v-if="selected.size > 0">
            <item-field
                v-for="(selectedItem, idx) in selected.values()"
                :item="selectedItem"
                v-model="assignForm.items[idx]"
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

    <p>{{ JSON.stringify([...selected.values()], null, 2) }}</p>
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
    border: 1px solid black;
}
</style>
