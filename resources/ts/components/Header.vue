<template>
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <router-link to="/"
                        class="text-xl font-bold text-primary-600 hover:text-primary-700 transition-colors">
                        <Icon name="logo" size="custom" />
                    </router-link>
                </div>
                <div class="hidden md:flex space-x-4">
                    <router-link v-for="link in navLinks" :key="link.path" :to="link.path"
                        class="px-3 py-2 rounded-md text-sm font-medium transition-colors" :class="[
                            $route.path === link.path
                                ? 'text-primary-600 bg-primary-50'
                                : 'text-secondary-600 hover:text-primary-600 hover:bg-primary-50'
                        ]">
                        {{ link.name }}
                    </router-link>
                </div>
                <div class="md:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen"
                        class="text-secondary-600 hover:text-primary-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path v-if="!isMobileMenuOpen" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div v-show="isMobileMenuOpen" class="md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <router-link v-for="link in navLinks" :key="link.path" :to="link.path"
                        class="block px-3 py-2 rounded-md text-base font-medium transition-colors" :class="[
                            $route.path === link.path
                                ? 'text-primary-600 bg-primary-50'
                                : 'text-secondary-600 hover:text-primary-600 hover:bg-primary-50'
                        ]" @click="isMobileMenuOpen = false">
                        {{ link.name }}
                    </router-link>
                </div>
            </div>
        </nav>
    </header>
</template>

<script lang="ts">
export default {
    data() {
        return {
            isMobileMenuOpen: false,
            navLinks: [
                { name: 'Home', path: '/' },
                { name: 'Leads', path: '/leads' }
            ]
        };
    }
};
</script>
