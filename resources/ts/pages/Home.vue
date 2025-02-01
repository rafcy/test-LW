<template>
    <div class="text-center max-w-4xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 text-secondary-800">
            Welcome to LearnWorlds Lead Management
        </h1>
        <p class="text-lg md:text-xl text-secondary-600 mb-8">
            Capture and manage your leads efficiently with our integrated solution.
        </p>
        <Button variant="primary" size="lg" @click="openLeadModal">
            <template #prefix>
                <Icon class="px-1 mx-1" name="plus-solid" />
            </template>
            Add New Lead
        </Button>
    </div>
    <LeadModal v-if="showLeadModal" @close="showLeadModal = false" />

</template>

<script lang="ts">
import { LeadForm } from '@/types/LeadForm.interfaces';

export default {
    data() {
        return {
            showLeadModal: false
        }
    },

    methods: {
        handleLeadSaved(lead: LeadForm) {

        },

        openLeadModal(): void {
            this.showLeadModal = true;
        },
    },
};
</script>

<style scoped>
    .icon {

    }
</style>
