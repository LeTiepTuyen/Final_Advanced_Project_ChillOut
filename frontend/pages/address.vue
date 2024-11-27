<template>
    <MainLayout>
        <div id="AddressPage" class="mt-8 max-w-lg mx-auto px-4">
            <div class="mx-auto bg-white rounded-lg shadow-lg p-6 transform transition duration-500 hover:scale-105">
                <div class="text-3xl font-bold mb-4 text-gray-800 text-center">Address Details</div>

                <form @submit.prevent="submit">
                    <TextInput 
                        class="w-full mb-4 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-orange-400 focus:border-transparent"
                        placeholder="Contact Name"
                        v-model:input="contactName"
                        inputType="text"
                        :error="error && error.type == 'contactName' ? error.message : ''"
                    />

                    <TextInput 
                        class="w-full mb-4 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-orange-400 focus:border-transparent"
                        placeholder="Address"
                        v-model:input="address"
                        inputType="text"
                        :error="error && error.type == 'address' ? error.message : ''"
                    />

                    <TextInput 
                        class="w-full mb-4 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-orange-400 focus:border-transparent"
                        placeholder="Zip Code"
                        v-model:input="zipCode"
                        inputType="text"
                        :error="error && error.type == 'zipCode' ? error.message : ''"
                    />

                    <TextInput 
                        class="w-full mb-4 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-orange-400 focus:border-transparent"
                        placeholder="City"
                        v-model:input="city"
                        inputType="text"
                        :error="error && error.type == 'city' ? error.message : ''"
                    />

                    <TextInput 
                        class="w-full mb-4 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-orange-400 focus:border-transparent"
                        placeholder="Country"
                        v-model:input="country"
                        inputType="text"
                        :error="error && error.type == 'country' ? error.message : ''"
                    />

                    <button 
                        :disabled="isWorking"
                        type="submit"
                        class="
                            mt-6
                            bg-gradient-to-r 
                            from-orange-400 
                            to-orange-500
                            w-full 
                            text-white 
                            text-lg 
                            font-semibold 
                            py-3 
                            rounded-full
                            shadow-lg
                            transition duration-300
                            transform hover:scale-105 hover:from-orange-500 hover:to-orange-600
                            focus:outline-none focus:ring-4 focus:ring-orange-400 focus:ring-opacity-50
                            disabled:opacity-50
                        "
                    >
                        <span v-if="!isWorking">Update Address</span>
                        <Icon 
                            v-else
                            name="eos-icons:loading" 
                            size="25" 
                            class="animate-spin mx-auto"
                        />
                    </button>
                </form>
            </div>
        </div>
    </MainLayout>
</template>

<script setup>
import MainLayout from '~/layouts/MainLayout.vue';
import { useUserStore } from '~/stores/user';
const userStore = useUserStore()
const user = useSupabaseUser()

let contactName = ref(null)
let address = ref(null)
let zipCode = ref(null)
let city = ref(null)
let country = ref(null)

let currentAddress = ref(null)
let isUpdate = ref(false)
let isWorking = ref(false)
let error = ref(null)

watchEffect(async () => {
    currentAddress.value = await useFetch(`/api/prisma/get-address-by-user/${user.value.id}`)
    if (currentAddress.value.data) {
        contactName.value = currentAddress.value.data.name
        address.value = currentAddress.value.data.address
        zipCode.value = currentAddress.value.data.zipcode
        city.value = currentAddress.value.data.city
        country.value = currentAddress.value.data.country

        isUpdate.value = true
    }
    userStore.isLoading = false
})

const submit = async () => {
    isWorking.value = true
    error.value = null

    if (!contactName.value) {
        error.value = {
            type: 'contactName',
            message: 'A contact name is required'
        }
    } else if (!address.value) {
        error.value = {
            type: 'address',
            message: 'An address is required'
        }
    } else if (!zipCode.value) {
        error.value = {
            type: 'zipCode',
            message: 'A zip code is required'
        }
    } else if (!city.value) {
        error.value = {
            type: 'city',
            message: 'A city is required'
        }
    } else if (!country.value) {
        error.value = {
            type: 'country',
            message: 'A country is required'
        }
    }

    if (error.value) {
        isWorking.value = false
        return
    }

    if (isUpdate.value) {
        await useFetch(`/api/prisma/update-address/${currentAddress.value.data.id}`, {
            method: 'PATCH',
            body: {
                userId: user.value.id,
                name: contactName.value,
                address: address.value,
                zipCode: zipCode.value,
                city: city.value,
                country: country.value,
            }
        })

        isWorking.value = false

        return navigateTo('/checkout')
    }

    await useFetch(`/api/prisma/add-address/`, {
        method: 'POST',
        body: {
            userId: user.value.id,
            name: contactName.value,
            address: address.value,
            zipCode: zipCode.value,
            city: city.value,
            country: country.value,
        }
    })

    isWorking.value = false

    return navigateTo('/checkout')
}
</script>

<style scoped>
/* Add any additional styling if needed */
</style>
