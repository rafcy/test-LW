<template>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Leads List</h2>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3 border">ID</th>
                        <th class="p-3 border">Full Name</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Consent</th>
                        <th class="p-3 border">Updated</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="lead in leads" :key="lead.id" class="text-center hover:bg-gray-100">
                        <td class="p-3 border">{{ lead.id }}</td>
                        <td class="p-3 border">{{ lead.full_name }}</td>
                        <td class="p-3 border">{{ lead.email }}</td>
                        <td class="p-3 border">
                            <span v-if="lead.consent" class="text-green-600">✔</span>
                            <span v-else class="text-red-600">✖</span>
                        </td>
                        <td class="p-3 border">{{ formatDate(lead.updated_at) }}</td>
                        <td class="p-3 border">
                            <Button @click="edit(lead)" variant="secondary">
                                Edit
                            </Button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script lang="ts">
import { LeadForm } from '@/types/LeadForm.interfaces';
import { formatDate } from '@/helpers';

export default {
    props: {
        leads: {
            type: Array<LeadForm>,
            default: []
        }
    },

    data() {
        return {
            selectedLead: this.leads,
        }
    },

    methods: {
        edit(lead: LeadForm) {
            this.selectedLead = lead;
            this.isModalOpen = true;
            this.$emit('edit', this.selectedLead);
        },

        formatDate
    }
};
</script>

<style scoped>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 12px;
        border: 1px solid #ddd;
    }
</style>
