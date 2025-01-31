<template>
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-secondary-800">
                Leads Management
            </h1>
            <Button variant="primary" @click="openLeadModal">
                <template #prefix>
                    <Icon name="plus-solid" size="xs" />
                </template>

                Add New Lead
            </Button>
        </div>
    </div>
</template>

<script lang="ts">

export default {
    name: 'Leads',

    methods: {
        openLeadModal(): void {
        }
    }
};
</script>
