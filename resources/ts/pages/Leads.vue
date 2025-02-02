<template>
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-secondary-800">
                Leads Management
            </h1>
            <Button variant="primary" @click="openLeadModal(null)">
                <template #prefix>
                    <Icon class="px-1 mx-1" name="plus-solid" />
                </template>
                Add New Lead
            </Button>
        </div>

        <LeadsTable :leads="leads" @edit="openLeadModal" />

        <div class="flex justify-between items-center mt-6">
            <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1"
                class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 disabled:opacity-50">
                Previous
            </button>

            <span>Page {{ currentPage }} of {{ totalPages }}</span>

            <button @click="changePage(currentPage + 1)" :disabled="currentPage === totalPages"
                class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 disabled:opacity-50">
                Next
            </button>
        </div>
    </div>
    <LeadModal v-if="showLeadModal" @close="showLeadModal = false" @lead-saved="handleLeadSaved"
        :editData="selectedLead" />
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
            selectedLead: null as LeadForm | null,
            currentPage: 1,
            totalPages: 1,
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
            this.showLeadModal = true;
        },

        async fetchLeads(page: number = 1) {
            try {
                const response = await axios.get(`/api/leads?page=${page}`);
                this.leads = response.data?.data;
                this.currentPage = response.data.current_page;
                this.totalPages = response.data.last_page;
                this.$router.push({ query: { page: this.currentPage } });
            } catch (error) {
                toast.error(`Error fetching leads ${error?.message}`)
            }
        },

        async changePage(page: number) {
            if (page > 0 && page <= this.totalPages) {
                await this.fetchLeads(page);
            }
        }
    }
};
</script>
