<template>
    <footer class="bg-secondary-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p class="text-secondary-200">
                &copy; {{ currentYear }} LearnWorlds. All rights reserved.
            </p>
        </div>
    </footer>
</template>

<script lang="ts">
export default {
    computed: {
        currentYear(): number {
            return new Date().getFullYear();
        }
    }
};
</script>
