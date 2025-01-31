<template>
    <div class="min-h-screen flex flex-col">
        <Header />
        <main class="flex-grow container mx-auto px-4 py-8">
            <router-view></router-view>
        </main>
        <Footer />
    </div>
</template>

<script lang="ts">

export default {
    name: 'App',

};
</script>
