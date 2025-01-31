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
                <PlusIcon class="h-5 w-5" />
            </template>

            Capture New Lead
        </Button>
    </div>
</template>

<script lang="ts">

export default {
    name: 'Home',
    methods: {
        openLeadModal(): void {

        }
    }
};
</script>
