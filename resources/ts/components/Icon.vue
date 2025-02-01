<template>
    <svg
        class="app-svg-icon"
        :class="[sizeClasses[size], $attrs.class]"
        @click="(...args) => $emit('click', ...args)"
        aria-hidden="true"
    >
        <use
            :xlink:href="symbolId"
            :color="color"
        />
    </svg>
</template>

<script lang="ts">
import { computed } from 'vue';

type IconSize = 'xs' | 'sm' | 'md' | 'lg' | 'xl' | 'custom';

export default {
    inheritAttrs: false,

    emits: ['click'],

    props: {
        prefix: {
            type: String,
            default: 'icon',
        },
        name: {
            type: String,
            required: true,
        },
        color: {
            type: String,
            default: null,
        },
        size: {
            type: String as () => IconSize,
            default: 'md',
            validator: (value: string) =>
                ['xs', 'sm', 'md', 'lg', 'xl', 'custom'].includes(value),
        },

        width: {
            type: [String, Number],
            default: null,
        },
        height: {
            type: [String, Number],
            default: null,
        },
    },

    setup(props) {
        const symbolId = computed(() => `#${props.prefix}-${props.name}`);

        const sizeClasses = {
            xs: 'w-[16px] h-[16px]',
            sm: 'w-[20px] h-[20px]',
            md: 'w-[25px] h-[25px]',
            lg: 'w-[30px] h-[30px]',
            xl: 'w-[40px] h-[40px]',
            custom: '',
        };

        return {
            symbolId,
            sizeClasses,
        };
    },
};
</script>

<style>
    .app-svg-icon {
        display: inline-block;
        vertical-align: middle;
        fill: currentColor;
    }

    .app-svg-icon.custom {
        width: var(--icon-width, 20px);
        height: var(--icon-height, 20px);
    }
</style>
