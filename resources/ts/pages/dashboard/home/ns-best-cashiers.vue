<template>
    <div class="flex flex-auto flex-col shadow rounded-lg overflow-hidden">
        <div class="head bg-white flex-auto">
            <div class="head text-center bg-blue-600 font-semibold border-b border-gray-200 text-white w-full py-2">
                <h5>{{ __( 'Best Cashiers' ) }}</h5>
            </div>
            <div class="body">
                <table class="table w-full" v-if="cashiers.length > 0">
                    <thead>
                        <tr v-for="cashier of cashiers" :key="cashier.id" class="border-gray-300 border-b text-sm">
                            <th class="p-2">
                                <div class="-mx-1 flex justify-start items-center">
                                    <div class="px-1">
                                        <div class="rounded-full bg-gray-200 h-6 w-6 ">
                                            <img src="/images/user.png"/>
                                        </div>
                                    </div>
                                    <div class="px-1 justify-center">
                                        <h3 class="font-semibold text-gray-600 items-center">{{ cashier.username }}</h3>
                                    </div>
                                </div>
                            </th>
                            <th class="flex justify-end text-green-700 p-2">{{ cashier.total_sales | currency( 'abbreviate' ) }}</th>
                        </tr>
                        <tr v-if="cashiers.length === 0">
                            <th colspan="2">{{ __( 'No result to display.' ) }}</th>
                        </tr>
                    </thead>
                </table>
                <div class="h-56 flex items-center justify-center" v-if="! hasLoaded">
                    <ns-spinner size="8" border="4"></ns-spinner>
                </div>
                <div class="h-56 flex items-center justify-center flex-col" v-if="hasLoaded && cashiers.length === 0">
                    <i class="las la-dizzy text-6xl text-gray-600"></i>
                    <p class="text-gray-600 text-sm">{{ __( 'Well.. nothing to show for the meantime.' ) }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { __ } from '@/libraries/lang';
export default {
    name: 'ns-best-customers',
    data() {
        return {
            subscription: null,
            cashiers: [],
            hasLoaded: false,
        }
    },
    mounted() {
        this.hasLoaded      =   false;
        this.subscription    =   Dashboard.bestCashiers.subscribe( cashiers => {
            this.hasLoaded  =   true;
            this.cashiers   =   cashiers;
        });
    },
    methods: {
        __
    },
    destroyed() {
        this.subscription.unsubscribe();
    }
}
</script>