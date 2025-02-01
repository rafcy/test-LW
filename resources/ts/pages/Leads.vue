<template>
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-secondary-800">
                Leads Management
            </h1>
            <Button variant="primary" @click="openLeadModal">
                <template #prefix>
                <Icon class="px-1 mx-1" name="plus-solid" />
                </template>

                Add New Lead
            </Button>
        </div>

        <LeadsTable :leads="leads" @edit="openLeadModal" />
    </div>
    <LeadModal v-if="showLeadModal" @close="showLeadModal = false" @lead-saved="handleLeadSaved" :editData="selectedLead" />
</template>

<script lang="ts">
import axios from "axios";
import { LeadForm } from '@/types/LeadForm.interfaces';
import { useToast } from 'vue-toastification';

const toast = useToast();

export default {
    data() {
        return {
            leads: [] as Array<LeadForm>,
            showLeadModal: false,
            selectedLead: null as LeadForm | null
        }
    },

    async mounted() {
        await this.fetchLeads();
    },

    methods: {
        async handleLeadSaved() {
            await this.fetchLeads();

        },

        openLeadModal(lead: null | LeadForm = null): void {
            this.selectedLead = lead ?? null;
            console.log(this.selectedLead);
            this.showLeadModal = true;
        },

        async fetchLeads() {
            try {
                const response = await axios.get("/api/leads");
                this.leads = response.data;
            } catch (error) {
                toast.error(`Error fetching leads ${error?.message}`)
            }

        }
    }
};
</script>
