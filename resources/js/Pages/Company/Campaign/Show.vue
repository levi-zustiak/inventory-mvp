<script setup>
import {ref, reactive, watch, toRaw, computed} from 'vue';
    import { router } from "@inertiajs/vue3";
    import ItemField from "./components/ItemField.vue";
import Item from "./components/Item.vue";

    const { company, campaign } = defineProps({ company: Object, campaign: Object, staff: Array });

    console.log(campaign);

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

    const selecting = computed(() => assignForm.items.length > 0)

    function select(item) {
        if (assignForm.items.some((selected) => selected.id === item.id)) {
            assignForm.items = assignForm.items.filter((selected) => selected.id !== item.id);
        } else {
            const selectedItem = structuredClone(toRaw(item));
            selectedItem.requested_quantity = selectedItem.available_quantity

            assignForm.items.push(selectedItem);
        }
    }

    function cancel() {
        selecting.value = false;
        // selected.value = [];
        assignForm.items = [];
    }

    async function submitAssignments() {
        await router.post(`/companies/${company.id}/campaigns/${campaign.id}/assignments`, assignForm);
        assignDialogRef.value.close()
        cancel();
    }

    function submit() {
        router.post(`/companies/${company.id}/campaigns/${campaign.id}/items`, form);
        createDialogRef.value.close()
    }
</script>

<template>
    <h1>{{ company.name }}</h1>
    <h1>{{ campaign.name }}</h1>
    <button v-if="selecting" @click="cancel">Cancel</button>
    <div class="item-container">
        <item v-if="campaign.items.length > 0"
              v-for="item in campaign.items"
              :item="item"
              @click="select(item)"
              :is-selected="assignForm.items.some((selected) => selected.id === item.id)"
        />
        <p v-else>No items</p>
    </div>
    <dialog ref="assignDialogRef" @close="assignDialogRef.close" class="modal">
        <div class="modal-container">
        <h2>Assign Items</h2>
        <form @submit.prevent="submitAssignments" v-if="assignForm.items.length > 0">
            <select v-model="assignForm.assigned_to">
                <option v-for="user in staff" :value="user.id">{{ user.name }}</option>
            </select>
            <item-field
                v-for="(selectedItem, idx) in assignForm.items"
                :item="selectedItem"
                v-model="assignForm.items[idx].requested_quantity"
            />
            <button type="submit" class="full-width">Assign</button>
        </form>
        </div>
    </dialog>

    <button @click="createDialogRef.showModal">Create Item</button>
    <dialog ref="createDialogRef" @close="createDialogRef.close" class="modal">
        <div class="modal-container">
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
        </div>
    </dialog>

    <div class="assign-action-container" v-if="selecting">
        <h6>Selected items: {{ assignForm.items.length }}</h6>
        <button @click="assignDialogRef.showModal">Assign</button>
    </div>
</template>

<style scoped>
.item-container {
    display: flex;
    gap: 1rem;
}

.modal {
    border-radius: 16px;
    margin: auto;
    padding: 1rem;
    border: none;
}

.modal-container {
    display: flex;
    flex-direction: column;
}

.assign-action-container {
    width: 360px;
    border: 2px solid lightgrey;
    border-radius: 10px;
    padding: 12px;
    position: fixed;
    bottom: 32px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem
}

.full-width {
    width: 100%;
}

button {
    padding: 8px 16px;
    border: none;
    border-radius: 8px;
    background-color: #282828;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    height: 40px;
    font-family: 'Poppins';
}

h6 {
    font-size: 16px;
    font-family: 'Poppins';
    font-weight: 600;
}
</style>
