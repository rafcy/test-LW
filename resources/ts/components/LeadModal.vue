<template>
    <Transition enter-active-class="transition duration-200 ease-out" enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-200 ease-in"
        leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
        <div class="fixed inset-0 z-50 overflow-y-auto" @click="closeModal">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <div class="relative w-full max-w-md transform overflow-hidden rounded-lg bg-white shadow-xl transition-all"
                    @click.stop>
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-medium text-secondary-900">
                            {{ isEditing ? 'Edit Lead' : 'Add New Lead' }}
                        </h3>
                    </div>

                    <form @submit.prevent="handleSubmit" class="p-6">
                        <div class="space-y-4">
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-secondary-700">
                                    Full Name
                                </label>
                                <input id="full_name" v-model="form.full_name" type="text" required :class="[
                                    'mt-1 block w-full rounded-md border-gray-300 shadow-sm',
                                    'focus:border-primary-500 focus:ring-primary-500',
                                    { 'border-red-300': errors.full_name }
                                ]" placeholder="John Doe" />
                                <p v-if="errors.full_name" class="mt-1 text-sm text-red-600">
                                    {{ errors.full_name }}
                                </p>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-secondary-700">
                                    Email Address
                                </label>
                                <input id="email" v-model="form.email" type="email" required :class="[
                                    'mt-1 block w-full rounded-md border-gray-300 shadow-sm',
                                    'focus:border-primary-500 focus:ring-primary-500',
                                    { 'border-red-300': errors.email }
                                ]" placeholder="john@example.com" />
                                <p v-if="errors.email" class="mt-1 text-sm text-red-600">
                                    {{ errors.email }}
                                </p>
                            </div>

                            <div class="flex items-start">
                                <div class="flex h-5 items-center">
                                    <input id="consent" v-model="form.consent" type="checkbox" required
                                        class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500" />
                                </div>
                                <div class="ml-3">
                                    <label for="consent" class="text-sm text-secondary-700">
                                        I agree to receive marketing emails
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end space-x-3">
                            <Button variant="outline" @click="closeModal" :disabled="isSubmitting">
                                Cancel
                            </Button>
                            <Button type="submit" variant="primary" :disabled="isSubmitting">
                                <template #prefix v-if="isSubmitting">
                                    <Icon name="spinner" size="sm" class="animate-spin" />
                                </template>
                                {{ isSubmitting ? 'Saving...' : (this.isEditing ? 'Update' : 'Save') }}
                            </Button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script lang="ts">
import { useToast } from 'vue-toastification';
import axios from 'axios';
import { LeadForm } from '@/types/LeadForm.interfaces'
import { FormErrors } from '@/types/Errors.interfaces'

const toast = useToast();
const defaultForm: LeadForm = {
    full_name: '',
    email: '',
    consent: false
};

export default {
    props: {
        editData: {
            type: Object as () => LeadForm | null,
            default: null
        }
    },

    data() {
        return {
            isEditing: false,
            isSubmitting: false,
            errors: {} as FormErrors,
            form: {} as LeadForm
        }
    },

    emits: ['lead-saved', 'close'],

    methods: {
        closeModal() {
            this.resetForm();
            this.$emit('close');
        },

        resetForm() {
            Object.assign(this.form, defaultForm);
            Object.keys(this.errors).forEach(key => delete this.errors[key]);
        },

        validateForm(): boolean{
            Object.keys(this.errors).forEach(key => delete this.errors[key]);

            if (!this.form.full_name.trim()) {
                this.errors.full_name = 'Full name is required';
            }

            if (!this.form.email.trim()) {
                this.errors.email = 'Email is required';
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) {
                this.errors.email = 'Please enter a valid email address';
            }

            if (!this.form.consent) {
                this.errors.email = 'Consent must be accepted'
            }

            return Object.keys(this.errors).length === 0;
        },

        async handleSubmit() {
            if (!this.validateForm()) return;

            this.isSubmitting = true;

            try {
                let url = `/api/leads${this.editData?.id ? '/' + this.editData.id : ''}`;
                const response = await axios.post(url, this.form);
                toast.success('Lead successfully created!');
                this.$emit('lead-saved', response.data);
                this.closeModal();
            } catch (error: any) {
                if (error.response?.data?.errors) {
                    Object.assign(this.errors, error.response.data.errors);
                } else {
                    toast.error(error.response?.data?.message || 'An error occurred while saving the lead');
                }
            } finally {
                this.isSubmitting = false;
            }
        }
    },

    mounted() {
        if (this.editData) {
            Object.assign(this.form, this.editData);
            this.isEditing = true;
        }
    },

    watch: {
        editData(newValue) {
            console.log('test');
            if (newValue) {
                Object.assign(this.form, newValue);
            }
        }
    }
};
</script>
