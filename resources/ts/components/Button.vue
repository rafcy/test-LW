<template>
    <button :class="[
        'inline-flex items-center justify-center px-2 py-2 rounded-lg transition-all duration-200 font-medium focus:outline-none focus:ring-2 focus:ring-offset-2',
        variantClasses[variant],
        sizeClasses[size],
        { 'opacity-50 cursor-not-allowed': disabled }
    ]" :disabled="disabled" @click="$emit('click')">
        <slot name="prefix"></slot>
        <slot></slot>
        <slot name="suffix"></slot>
    </button>
</template>

<script lang="ts">
export default {
    name: 'Button',
    props: {
        variant: {
            type: String,
            default: 'primary',
            validator: (value: string) => ['primary', 'secondary', 'outline', 'danger'].includes(value)
        },
        size: {
            type: String,
            default: 'md',
            validator: (value: string) => ['sm', 'md', 'lg'].includes(value)
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        variantClasses(): Record<string, string> {
            return {
                primary: 'bg-primary-500 hover:bg-primary-600 text-white focus:ring-primary-500',
                secondary: 'bg-secondary-500 hover:bg-secondary-600 text-white focus:ring-secondary-500',
                outline: 'border-2 border-primary-500 text-primary-500 hover:bg-primary-50 focus:ring-primary-500',
                danger: 'bg-red-500 hover:bg-red-600 text-white focus:ring-red-500'
            };
        },
        sizeClasses(): Record<string, string> {
            return {
                sm: 'text-sm px-1 py-1',
                md: 'text-base px-2 py-2',
                lg: 'text-lg px-3 py-3'
            };
        }
    }
};
</script>
