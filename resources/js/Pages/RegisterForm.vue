<template>
    <TermAndPolicy ref="term" />
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img
            class="mx-auto h-16 w-auto rounded-full border-4 border-violet-500"
            :src="lineUser.avatar"
            alt="line profile image"
        >
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-slate-900">
            สวัสดี {{ lineUser.name }}
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <div class="space-y-6">
                <div class="flex items-center">
                    <input
                        id="employee"
                        name="employee"
                        type="checkbox"
                        class="h-4 w-4 rounded border-slate-300 text-violet-600 focus:ring-violet-500 cursor-pointer"
                        v-model="form.employee"
                    >
                    <label
                        for="employee"
                        class="ml-2 block text-sm text-slate-900 cursor-pointer"
                    >บุคลากรสาขาฯ</label>
                </div>
                <Transition name="slide-fade">
                    <div v-if="form.employee">
                        <div>
                            <label
                                for="sap_id"
                                class="block text-sm font-medium text-slate-700"
                            >SAP ID</label>
                            <div class="mt-1">
                                <input
                                    id="sap_id"
                                    name="sap_id"
                                    type="tel"
                                    autocomplete="sap_id"
                                    class="block w-full appearance-none rounded-md border border-slate-300 px-3 py-2 placeholder-slate-500 shadow-sm focus:border-violet-500 focus:outline-none focus:ring-violet-500 sm:text-sm"
                                    v-model="form.sap_id"
                                >
                            </div>
                        </div>
                        <small class="text-red-400">{{ $page.props.errors.sap_id }}</small>
                    </div>
                    <div
                        class="space-y-6"
                        v-else
                    >
                        <div>
                            <label
                                for="email"
                                class="block text-sm font-medium text-slate-700"
                            >อีเมล์</label>
                            <div class="mt-1">
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    v-model="form.email"
                                    class="block w-full appearance-none rounded-md border border-slate-300 px-3 py-2 placeholder-slate-500 placeholder:text-xs placeholder:italic shadow-sm focus:border-violet-500 focus:outline-none focus:ring-violet-500 sm:text-sm"
                                    placeholder="ใช้ข้อมูลที่ท่านลงทะเบียนเข้าร่วมงาน"
                                >
                            </div>
                        </div>
                        <small class="text-red-400">{{ $page.props.errors.email }}</small>

                        <div>
                            <label
                                for="tel_no"
                                class="block text-sm font-medium text-slate-700"
                            >หมายเลขโทรศัพท์</label>
                            <div class="mt-1">
                                <input
                                    id="tel_no"
                                    name="tel_no"
                                    type="tel"
                                    autocomplete="tel_no"
                                    v-model="form.tel_no"
                                    class="block w-full appearance-none rounded-md border border-slate-300 px-3 py-2 placeholder-slate-500 placeholder:text-xs placeholder:italic shadow-sm focus:border-violet-500 focus:outline-none focus:ring-violet-500 sm:text-sm"
                                    placeholder="ใช้ข้อมูลที่ท่านลงทะเบียนเข้าร่วมงาน ไม่มีขีดคั่น"
                                >
                            </div>
                        </div>
                        <small class="text-red-400">{{ $page.props.errors.tel_no }}</small>

                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-slate-300" />
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="bg-white px-2 text-slate-500">สอบถามโทร <a
                                    href="tel:024198383"
                                    class="underline text-violet-600"
                                >024198383</a> วันและเวลาราชการ</span>
                            </div>
                        </div>
                    </div>
                </Transition>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <input
                            id="accepted_terms"
                            name="accepted_terms"
                            type="checkbox"
                            class="h-4 w-4 rounded border-slate-300 text-violet-600 focus:ring-violet-500 cursor-pointer"
                            v-model="form.accepted_terms"
                        >
                        <label
                            for="accepted_terms"
                            class="ml-2 block text-sm text-slate-900 cursor-pointer"
                        >ยอมรับข้อตกลงการใช้งาน</label>
                    </div>

                    <small class="text-red-400">{{ $page.props.errors.status }}</small>

                    <div class="text-sm">
                        <button
                            @click="term.toggle"
                            class="text-xs md:text-sm font-medium text-violet-600"
                        >
                            อ่านข้อตกลงการใช้งานและนโยบายความเป็นส่วนตัว
                        </button>
                    </div>
                </div>

                <div>
                    <button
                        class="flex w-full justify-center rounded-md border border-transparent bg-violet-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:bg-violet-600/50"
                        :disabled="!fullFilled || form.process"
                        @click="form.post(routeRegisterStore)"
                    >
                        ลงทะเบียน
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {useForm} from '@inertiajs/vue3';
import TermAndPolicy from '../Components/TermAndPolicy.vue';
import {computed, ref} from 'vue';

defineProps({
    lineUser: { type: Object, required: true },
    routeRegisterStore: {type: String, required: true},
});

const term = ref(null);
const form = useForm({
    employee: false,
    sap_id: '',
    email: '',
    tel_no: '',
    accepted_terms: false,
});

const fullFilled = computed(function () {
    return form.accepted_terms && form.employee
        ? form.sap_id
        : form.email && form.tel_no;
});
</script>

<script>
import PageLayout from '../Components/Layouts/PageLayout.vue';
export default {
    layout: PageLayout,
};
</script>
